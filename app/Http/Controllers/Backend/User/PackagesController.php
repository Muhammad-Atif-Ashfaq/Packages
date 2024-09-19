<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{InvestmentPackage, Subscription, User, ReferralPackage};

class PackagesController extends Controller
{
    private $investmentPackage;
    private $subscription;
    private $user;


    public function __construct() {

        $this->investmentPackage = new InvestmentPackage;
        $this->subscription = new Subscription;
        $this->user = new User;
    }
    public function index()
    {
        $data=InvestmentPackage::all();
        return view('backend.user.investmentPackage.index',compact('data'));
    }

    public function buy_package(Request $request)
    {
        $user = auth()->user();
        if($user->subscription)
        {
            return back()->with('error','Cancel previous package first');
        }
       
        $investmentPackage = $this->investmentPackage::where('investment_start_range', '<=', $request->amount)
                             ->where('investment_end_range', '>=', $request->amount)
                             ->first();

        if($user->deposit_amount<$request->amount)
        {
            return redirect()->back()->with('error','Not enough amount in wallet to buy that package');
        }

        if ($investmentPackage)
        {

                $subscription = $this->subscription::updateOrCreate([
                    'user_id' =>$user->id],
                    ['investment_package_id' => $investmentPackage->id,
                    'monthly_reward_date'=>now(),

                ]);

                if ($subscription) {
                    $user->total_investment += $request->amount;
                    $user->deposit_amount -= $request->amount;
                    $user->save();

                    $return = $investmentPackage->monthly_return;
                    $totalInvestment = $user->total_investment;
                    $profit = $totalInvestment / 100 * $return;
                }else
                {
                    return redirect()->route('user.packages')->with('error','Soomething went wrong');
                }
            }
            $parentUser = $this->user::find($user->referred_by);
            if($parentUser)
            {
                $total_reffered_investment = $this->user::where('referred_by', $user->referred_by)
                                            ->sum('total_investment');

                $referral_package = ReferralPackage::where(function($q) use ($total_reffered_investment){
                        $q->where('min_amount', '<', (int)$total_reffered_investment)
                        ->where('max_amount', '>', (int)$total_reffered_investment);
                })
                ->orWhere('min_amount', '=', (int)$total_reffered_investment)
                ->orWhere('max_amount', '=', (int)$total_reffered_investment)
                ->first();


                if($total_reffered_investment >= ReferralPackage::first()->min_amount){
                    if($parentUser->referral_package_id != $referral_package->id || empty($parentUser->referral_package_id))
                    {
                        $parentUser->referral_package_id = $referral_package->id ?? null;
                        $parentUser->referral_profit += $referral_package->bonus_for_reaching_tier;
                        $parentUser->total_profit += $referral_package->bonus_for_reaching_tier;
                        $parentUser->available_balance += $referral_package->bonus_for_reaching_tier;
                        $parentUser->expected_referral_earning += $profit / 100 * $referral_package->monthly_downline_return;
                        $parentUser->save();

                        if ($parentUser->referred_by) {
                            $secondUser = $this->user::find($parentUser->referred_by);
                            if ($secondUser) {
                                $secondUser->referral_profit += $referral_package->fixed_bonus_for_recruits_tier;
                                $secondUser->total_profit += $referral_package->fixed_bonus_for_recruits_tier;
                                $secondUser->available_balance += $referral_package->fixed_bonus_for_recruits_tier;
                                $secondUser->expected_referral_earning += $profit / 100 * $referral_package->second_profit;
                                $secondUser->save();

                                if ($secondUser->referred_by) {
                                    $thirdUser = $this->user::find($secondUser->referred_by);
                                    if ($thirdUser) {
                                        $thirdUser->expected_referral_earning += $profit / 100 * $referral_package->third_profit;
                                        $thirdUser->save();

                                        if ($thirdUser->referred_by) {
                                            $fourthUser = $this->user::find($thirdUser->referred_by);
                                            if ($fourthUser) {
                                                $fourthUser->expected_referral_earning += $profit / 100 * $referral_package->fourth_profit;
                                                $fourthUser->save();

                                                if ($fourthUser->referred_by) {
                                                    $fifthUser = $this->user::find($fourthUser->referred_by);
                                                    if ($fifthUser) {
                                                        $fifthUser->expected_referral_earning += $profit / 100 * $referral_package->fifth_profit;
                                                        $fifthUser->save();
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

        }

            return redirect()->route('user.packages')->with('success','Investment Package Purchased Successfully');
    }

    public function cancel_package($id)
    {
        $user = auth()->user();
        $subscription = Subscription::where('user_id', $user->id)->first();
        $package = InvestmentPackage::find($subscription->investment_package_id);
        $userProfit = $user->total_investment / 100 * $package->monthly_return;
        if ($subscription->delete()) {
            $user->deposit_amount += $user->total_investment;
            $user->expected_referral_earning = 0;
            $user->save();
        }
        if ($user->referred_by) {
            $parentUser = $this->user::find($user->referred_by);
            $refferal_package = ReferralPackage::find($parentUser->referral_package_id);
            if ($refferal_package) {
                $parentUser->expected_referral_earning -= $userProfit / 100 * $refferal_package->monthly_downline_return;
                $parentUser->referral_package_id  = null;
                $parentUser->save();
            }
            if ($parentUser->referred_by) {
                $secondUser = $this->user::find($parentUser->referred_by);
                $secondUser->expected_referral_earning -= $userProfit / 100 * $refferal_package->second_profit;
                $secondUser->referral_package_id  = null;
                $secondUser->save();

                if ($secondUser->referred_by) {
                    $thirdUser = $this->user::find($secondUser->referred_by);
                    $thirdUser->expected_referral_earning -= $userProfit / 100 * $refferal_package->third_profit;
                    $thirdUser->referral_package_id  = null;
                    $thirdUser->save();

                    if ($thirdUser->referred_by) {
                        $fourthUser = $this->user::find($thirdUser->referred_by);
                        $fourthUser->expected_referral_earning -= $userProfit / 100 * $refferal_package->fourth_profit;
                        $fourthUser->referral_package_id  = null;
                        $fourthUser->save();

                        if ($fourthUser->referred_by) {
                            $fifthUser = $this->user::find($fourthUser->referred_by);
                            $fifthUser->expected_referral_earning -= $userProfit / 100 * $refferal_package->fifth_profit;
                            $fifthUser->referral_package_id  = null;
                            $fifthUser->save();
                        }
                    }
                }
            }
        }
        $user->total_investment = 0;
        $user->save();
        return redirect()->back()->with('success', 'package unsubscribed');
    }

}