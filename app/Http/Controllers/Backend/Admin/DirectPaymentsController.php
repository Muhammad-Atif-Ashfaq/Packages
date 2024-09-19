<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use App\Models\Withdraw;
use Carbon\Carbon;
use App\Models\DirectWithdraw;
use Illuminate\Support\Str;

class DirectPaymentsController extends Controller
{
    public function deposit(Request $request,$id)
    {

        $request->validate([
            'amount'=>'required',
        ]);

        $amount = $request->input('amount');
        $user = User::find($id);
        $token = Str::random(40);

        // Create a new payment record
        $payment = Payment::create([
            'token'=>$token,
            'user_id' => $id,
            'amount' => $amount,
            'source'=>'Admin',
            'status' => true,
        ]);

        if ($payment) {
            // Add the amount to the user's deposit_amount column
            $user->deposit_amount += $amount;
            $user->save();

            // Redirect to a success page or route
            return back()->with('success', 'Amount Is Deposited Successfully');
        } else {

            return back()->with('error', 'Payment creation failed. Please try again.');
        }

    }

    public function profitWithdraw(Request $request,$id)
    {

        $user = User::findOrFail($id);
        $request->validate([
            'amount'=>'required',
        ]);
        $amount=$request->input('amount');

        if ($user->available_balance < $amount) {
            return back()->with('error', 'Not enough balance for withdrawal');
        }


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
                'source'=>'Admin',
                'type'=>'Profit Withdraw',
                'user_id' => $user->id,
            ]);

            DirectWithdraw::create([
                'amount' => $amount,
                'status' => 'Pending',
                'user_id' => $user->id,
            ]);


            return back()->with('success', 'Withdrawal successful payable amount= '.($amount));
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

    public function directWithdrawPage()
    {

        $data=DirectWithdraw::all();
        return view('backend.admin.direct-withdraw.index',compact('data'));
    }

    public function pay($id)
    {
        $data=DirectWithdraw::findOrFail($id);
        $data->update([
            'status'=>'Paid',
        ]);
        return back()->with('success','Status changed successfully');

    }


    public function withdraw(Request $request,$id)
    {

        $user = User::findOrFail($id);
        $request->validate([
            'amount'=>'required',
        ]);
        $amount=$request->input('amount');

        if ($user->deposit_amount < $amount) {
            return back()->with('error', 'Not enough balance for withdrawal');
        }


        $admin = User::where('role', 'admin')->first();
        $latestPaymentDate = $user->payments()->latest()->first()->created_at;
        $feePercentage = $this->getFeePercentage($latestPaymentDate);
        $fee = ($amount * $feePercentage) / 100;
        $totalWithdrawalAmount = $amount;

        if ($totalWithdrawalAmount <= $user->deposit_amount) {
            $balance = $user->deposit_amount - $totalWithdrawalAmount;
            $withdrawalAmount = $user->total_withdrawals + $totalWithdrawalAmount;

            $user->update([
                'deposit_amount' => $balance,
                'total_withdrawals' => $withdrawalAmount,
            ]);

            Withdraw::create([
                'amount' => $amount - $fee,
                'status' => 'success',
                'source'=>'Admin',
                'type'=>'Balance Withdraw',
                'user_id' => $user->id,
            ]);

            DirectWithdraw::create([
                'amount' => $amount - $fee,
                'status' => 'Pending',
                'user_id' => $user->id,
            ]);

            $totalBalanceAdmin = $admin->available_balance + $fee;
            $admin->update([
                'available_balance' => $totalBalanceAdmin,
                'total_profit' => $totalBalanceAdmin,
            ]);

            return back()->with('success', 'Withdrawal successful payable amount= '.($amount-$fee));
        }

    }
}