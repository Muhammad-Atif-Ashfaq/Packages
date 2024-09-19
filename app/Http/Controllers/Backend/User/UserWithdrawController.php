<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Models\Withdraw; // Assuming Withdraw model exists in this namespace
use Illuminate\Support\Facades\Http;


class UserWithdrawController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://www.coinpayments.net/api.php',
            'timeout' => 10,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);
    }

    public function index(Request $request, $id)
    {

        $request->validate([
            'amount' => 'required',
            'address' => 'required',
            'withdrawcurrency_name' => 'required',


        ]);

        $user = User::findOrFail($id);
        $apiKey = '45327769b1bc939528090dc5dab68be35f0d467811ae7e00dd21dadbeb11306d';
        $apiSecret = '921cC94B0e3659cae398d339e33dEB83405dd4A6DFd14A285d4575A3155F5cB4';
        $amount = $request->input('amount'); // Amount to withdraw
        $currency = $request->input('withdrawcurrency'); // Currency code
        $currency_name = strtolower($request->input('withdrawcurrency_name')); // Currency code
        $address = $request->input('address'); // Recipient wallet address


        if ($user->deposit_amount < $amount) {
            return back()->with('error', 'Not enough balance for withdrawal');
        }

        $latestPaymentDate = $user->payments()->latest()->first()->created_at;
        $feePercentage = $this->getFeePercentage($latestPaymentDate);
        $fee = ($amount * $feePercentage) / 100;
        $deductedAmount=$amount-$fee;
        // Make a request to the CoinGecko API to get the conversion rate from USD to the selected cryptocurrency
        $response = Http::get('https://api.coingecko.com/api/v3/simple/price', [
            'ids' => $currency_name,
            'vs_currencies' => 'usd',
        ]);
        $data = $response->json();

        if (isset($data[$currency_name]['usd'])) {

            $conversionRate = $data[$currency_name]['usd'];

            $convertedAmount = $deductedAmount / $conversionRate;

            // Create a new payment record with 'success' status
        }
        // Generate HMAC signature
        $payload = [
            'version' => '1',
            'key' => $apiKey,
            'cmd' => 'create_withdrawal',
            'amount' => $convertedAmount,
            'currency' => $currency,
            'address' => $address,
            'auto_confirm' => 1, // Set auto_confirm to 1 for no email confirmation
        ];

        // Sort the payload by key
        ksort($payload);

        // Concatenate the payload key-value pairs
        $payloadString = http_build_query($payload);

        // Generate HMAC signature
        $hmac = hash_hmac('sha512', $payloadString, $apiSecret);

        $response = $this->client->post('', [
            'headers' => [
                'HMAC' => $hmac,
            ],
            'form_params' => $payload,
        ]);
        $body = $response->getBody()->getContents();
        $responseData = json_decode($body, true);

        // Success payment
        if ($responseData['error'] === 'ok' && isset($responseData['result']['status']) && $responseData['result']['status'] === 1) {
            $admin = User::where('role', 'admin')->first();
            $totalWithdrawalAmount = $amount;

            if ($totalWithdrawalAmount <= $user->deposit_amount) {
                $balance = $user->deposit_amount - $totalWithdrawalAmount;
                $withdrawalAmount = $user->total_withdrawals + $totalWithdrawalAmount;

                $user->update([
                    'deposit_amount' => $balance,
                    'total_withdrawals' => $withdrawalAmount,
                ]);

                Withdraw::create([
                    'amount' => $deductedAmount,
                    'status' => 'success',
                    'type'=>'Balance Withdraw',
                    'user_id' => $user->id,
                ]);

                $totalBalanceAdmin = $admin->available_balance + $fee;
                $admin->update([
                    'available_balance' => $totalBalanceAdmin,
                    'total_profit' => $totalBalanceAdmin,
                ]);

                return back()->with('success', 'Withdrawal successful.');
            }
        } else {
            Withdraw::create([

                'amount' => $amount,
                'status' => 'failed',
                'user_id' => $user->id,
            ]);
            // Handle other errors or unexpected responses
            return back()->with('error', 'Withdrawal failed');
        }
    }

    private function getFeePercentage($subscriptionDate)
    {
        $now = Carbon::now();
        $subscriptionDuration = $now->diffInMonths($subscriptionDate);

        if ($subscriptionDuration < 6) {
            return 27;
        } elseif ($subscriptionDuration >= 6 && $subscriptionDuration <= 12) {
            return 21.6;
        } elseif ($subscriptionDuration > 12 && $subscriptionDuration <= 24) {
            return 13.5;
        } elseif ($subscriptionDuration > 24 && $subscriptionDuration <= 36) {
            return 5.4;
        } else {
            return 0;
        }
    }


    public function withdrawFees()
    {
        return view('backend.user.withdraw-fees.index');
    }


    public function profitWithdraw(Request $request, $id)
    {


        $request->validate([
            'amount' => 'required',
            'address' => 'required',
            'withdrawcurrency_name2' => 'required',


        ]);

        $user = User::findOrFail($id);
        $apiKey = '45327769b1bc939528090dc5dab68be35f0d467811ae7e00dd21dadbeb11306d';
        $apiSecret = '921cC94B0e3659cae398d339e33dEB83405dd4A6DFd14A285d4575A3155F5cB4';
        $amount = $request->input('amount'); // Amount to withdraw
        $currency = $request->input('withdrawcurrency2'); // Currency code
        $currency_name = strtolower($request->input('withdrawcurrency_name2')); // Currency code
        $address = $request->input('address'); // Recipient wallet address


        if ($user->available_balance < $amount) {
            return back()->with('error', 'Not enough balance for withdrawal');
        }
        // Make a request to the CoinGecko API to get the conversion rate from USD to the selected cryptocurrency
        $response = Http::get('https://api.coingecko.com/api/v3/simple/price', [
            'ids' => $currency_name,
            'vs_currencies' => 'usd',
        ]);
        $data = $response->json();

        if (isset($data[$currency_name]['usd'])) {

            $conversionRate = $data[$currency_name]['usd'];

            $convertedAmount = $amount / $conversionRate;

            // Create a new payment record with 'success' status
        }
        // Generate HMAC signature
        $payload = [
            'version' => '1',
            'key' => $apiKey,
            'cmd' => 'create_withdrawal',
            'amount' => $convertedAmount,
            'currency' => $currency,
            'address' => $address,
            'auto_confirm' => 1, // Set auto_confirm to 1 for no email confirmation
        ];

        // Sort the payload by key
        ksort($payload);

        // Concatenate the payload key-value pairs
        $payloadString = http_build_query($payload);

        // Generate HMAC signature
        $hmac = hash_hmac('sha512', $payloadString, $apiSecret);

        $response = $this->client->post('', [
            'headers' => [
                'HMAC' => $hmac,
            ],
            'form_params' => $payload,
        ]);
        $body = $response->getBody()->getContents();
        $responseData = json_decode($body, true);


        // Success payment
        if ($responseData['error'] === 'ok' && isset($responseData['result']['status']) && $responseData['result']['status'] === 1) {


            if ($amount <= $user->available_balance) {
                $balance = $user->available_balance - $amount;
                $withdrawalAmount = $user->total_withdrawals + $amount;

                $user->update([
                    'available_balance' => $balance,
                    'total_withdrawals' => $withdrawalAmount,
                ]);

                Withdraw::create([
                    'amount' => $amount,
                    'status' => 'success',
                    'type'=>'Profit Withdraw',
                    'user_id' => $user->id,
                ]);

                return back()->with('success', 'Withdrawal successful.');
            }
        } else {
            Withdraw::create([

                'amount' => $amount,
                'status' => 'failed',
                'type'=>'Profit Withdraw',
                'user_id' => $user->id,
            ]);
            // Handle other errors or unexpected responses
            return back()->with('error', 'Withdrawal failed');
        }

    }
}