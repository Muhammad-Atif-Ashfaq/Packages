<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Payment};
use Http;
use DB;
class PaymentController extends Controller
{
    public function deposit(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $amount =$request->input('amount');
        $currency =$request->input('currency');
        $currency_name = $request->currency_name;

        // Get the CoinPayments Merchant ID from the .env file
        $merchantId = env('COINPAYMENTS_MERCHANT_ID');

        // Generate a random token
        $token = bin2hex(random_bytes(16));

        // Encode the token for URL safety
        $encodedToken = urlencode($token);

        // Include the token, user ID, and package ID in the success URL
        $successUrl = [
            'token' => $encodedToken,
            'user_id' => $user->id,
            'amount' => $amount,
            'currency' => $currency,
            'currency_name' => $currency_name
        ];
        $cancelUrl = [
            'token' => $encodedToken,
            'user_id' => $user->id,
            'amount' => $amount,
            'currency' => $currency,
        ];

        return view('backend.user.coinpayment.index', compact('amount', 'successUrl', 'cancelUrl', 'merchantId', 'currency'));

    }
    public function success(Request $request)
    {
        $token = $request->input('token');
        $userId = $request->input('user_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $currency_name = strtolower(($request->input('currency_name')));
        $user = User::find($userId);


            $response = Http::get('https://api.coingecko.com/api/v3/simple/price', [
                'ids' => $currency_name,
                'vs_currencies' => 'usd',
            ]);

            // dd($response->json());
            $data = $response->json();



            if (isset($data[$currency_name]['usd'])) {

                $usdRate = $data[$currency_name]['usd'];
                $amountUsd = $amount * $usdRate;
                // Create a new payment record with 'success' status
                $payment = Payment::create([
                    'token' => $token,
                    'user_id' => $userId,
                    'amount' => $amountUsd, // Store the amount in USD
                    'status' => 'success',
                ]);
                // Update the user's deposit_amount column with the converted amount
                $user->deposit_amount += $amountUsd;
                $user->save();
                // Redirect to a success page or route
                return redirect()->route('user.coin.payment')->with('success', 'Amount Is Deposited Successfully');
            }


    }


    public function cancel(Request $request){

        $token = $request->input('token');
        $userId = $request->input('user_id');
        $amount = $request->input('amount');
        $user=User::find($userId);

        // Create a new payment record
        $payment = Payment::create([
            'token' => $token,
            'user_id' => $userId,
            'amount' => $amount,
            'status' => false,
        ]);
        return redirect()->route('user.packages')->with('success','Amount Is Not Deposit');


    }

    public function payment(){
        $user = auth()->user();
        $data = Payment::where('user_id', $user->id)->get();
        return view('backend.user.coinpayment.payment-detail', compact('data'));
    }

}
