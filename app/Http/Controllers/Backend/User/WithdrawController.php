<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Withdraw;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;

class WithdrawController extends Controller
{

    public function index()
    {
        $data=Auth::user()->withdrawals;
        return view('backend.user.withdrawls.index',compact('data'));

    }
    // public function withdraw(Request $request)
    // {
    //     $admin=User::where('role','admin')->first();
    //     $user = Auth::user();
    //     $subscription = $user->subscription;

    //     $feePercentage = $this->getFeePercentage($subscription->created_at);

    //     $fee = ($amount * $feePercentage) / 100;
    //     $totalWithdrawalAmount = $amount;


    //     if ($totalWithdrawalAmount <= $user->available_balance) {
    //         $balance = $user->available_balance - $totalWithdrawalAmount;
    //         $withdrawalAmount = $user->total_withdrawals + $totalWithdrawalAmount;

    //         $user->update([
    //             'available_balance' => $balance,
    //             'total_withdrawals' => $withdrawalAmount,
    //         ]);

    //         Withdraw::create([
    //             'amount'=>$amount-$fee,
    //             'user_id'=>$user->id,
    //         ]);

    //         $totalBalanceAdmin=$admin->available_balance+$fee;
    //         $admin->update([
    //             'available_balance'=>$totalBalanceAdmin,
    //             'total_profit'=>$totalBalanceAdmin,
    //         ]);

    //         return redirect()->route('user.wallet')->with('success', 'Withdrawal successful');
    //     } else {
    //         return redirect()->route('user.wallet')->with('error', 'You do not have sufficient balance');
    //     }
    // }

    // private function getFeePercentage($subscriptionDate)
    // {
    //     $now = Carbon::now();
    //     $subscriptionDuration = $now->diffInMonths($subscriptionDate);

    //     if ($subscriptionDuration < 6) {
    //         return 27;
    //     } elseif ($subscriptionDuration >= 6 && $subscriptionDuration <= 12) {
    //         return 21.6;
    //     } elseif ($subscriptionDuration > 12 && $subscriptionDuration <= 24) {
    //         return 13.5;
    //     } elseif ($subscriptionDuration > 24 && $subscriptionDuration <= 36) {
    //         return 5.4;
    //     } else {
    //         return 0;
    //     }

    // }
}