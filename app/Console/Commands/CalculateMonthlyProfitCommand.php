<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Subscription;
use App\Models\InvestmentPackage;
use App\Models\ReferralPackage;
use Carbon\Carbon;

class CalculateMonthlyProfitCommand extends Command
{
    protected $signature = 'calculate:monthly-profit';
    protected $description = 'Calculate and add monthly profit to users\' accounts';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $subscriptions = Subscription::all();
        foreach ($subscriptions as $subscription) {
            $currentDate = Carbon::now();
            $subscriptionCreatedAt = Carbon::parse($subscription->monthly_reward_date);
            if ($currentDate->diffInMonths($subscriptionCreatedAt) >= 1) {
                $user = User::find($subscription->user_id);
                if (!$user) {
                    continue;
                }

                $package = InvestmentPackage::find($subscription->investment_package_id);
                if (!$package) {
                    continue;
                }

                $return = $package->monthly_return;
                $totalInvestment = $user->total_investment;
                $profit = $totalInvestment / 100 * $return;

                if ($user->referred_by) {
                    $parentUser = User::find($user->referred_by);
                    if ($parentUser) {
                        $referralPackage = ReferralPackage::find($parentUser->referral_package_id);
                        if ($referralPackage) {
                            $parentProfit = $profit / 100 * $referralPackage->monthly_downline_return;
                            $parentUser->referral_profit += $parentProfit;
                            $parentUser->total_profit += $parentProfit;
                            $parentUser->available_balance += $parentProfit;
                            $parentUser->expected_referral_earning -= $parentProfit;
                            $parentUser->save();
                
                            $newProfit = $profit - $parentProfit;
                            $user->monthly_profit += $newProfit;
                            $user->total_profit += $newProfit;
                            $user->available_balance += $newProfit;
                            $user->save();
                
                            if ($parentUser->referred_by) {
                                $secondUser = User::find($parentUser->referred_by);
                                if ($secondUser) {
                                    if ($referralPackage) {
                                        $secondUserProfit = $profit / 100 * $referralPackage->second_profit;
                                        $secondUser->referral_profit += $secondUserProfit;
                                        $secondUser->total_profit += $secondUserProfit;
                                        $secondUser->available_balance += $secondUserProfit;
                                        $secondUser->expected_referral_earning -= $secondUserProfit;
                                        $secondUser->save();
                
                                        $newProfit = $profit - $secondUserProfit;
                                        $user->monthly_profit += $newProfit;
                                        $user->total_profit += $newProfit;
                                        $user->available_balance += $newProfit;
                                        $user->save();
                
                                        if ($secondUser->referred_by) {
                                            $thirdUser = User::find($secondUser->referred_by);
                                            if ($thirdUser) {
                                                if ($referralPackage) {
                                                    $thirdUserProfit = $profit / 100 * $referralPackage->third_profit;
                                                    $thirdUser->referral_profit += $thirdUserProfit;
                                                    $thirdUser->total_profit += $thirdUserProfit;
                                                    $thirdUser->available_balance += $thirdUserProfit;
                                                    $thirdUser->expected_referral_earning -= $thirdUserProfit;
                                                    $thirdUser->save();
                
                                                    $newProfit = $profit - $thirdUserProfit;
                                                    $user->monthly_profit += $newProfit;
                                                    $user->total_profit += $newProfit;
                                                    $user->available_balance += $newProfit;
                                                    $user->save();
                
                                                    if ($thirdUser->referred_by) {
                                                        $fourthUser = User::find($thirdUser->referred_by);
                                                        if ($fourthUser) {
                                                            if ($referralPackage) {
                                                                $fourthUserProfit = $profit / 100 * $referralPackage->fourth_profit;
                                                                $fourthUser->referral_profit += $fourthUserProfit;
                                                                $fourthUser->total_profit += $fourthUserProfit;
                                                                $fourthUser->available_balance += $fourthUserProfit;
                                                                $fourthUser->expected_referral_earning -= $fourthUserProfit;
                                                                $fourthUser->save();
                
                                                                $newProfit = $profit - $fourthUserProfit;
                                                                $user->monthly_profit += $newProfit;
                                                                $user->total_profit += $newProfit;
                                                                $user->available_balance += $newProfit;
                                                                $user->save();
                
                                                                if ($fourthUser->referred_by) {
                                                                    $fifthUser = User::find($fourthUser->referred_by);
                                                                    if ($fifthUser) {
                                                                        if ($referralPackage) {
                                                                            $fifthUserProfit = $profit / 100 * $referralPackage->fifth_profit;
                                                                            $fifthUser->referral_profit += $fifthUserProfit;
                                                                            $fifthUser->total_profit += $fifthUserProfit;
                                                                            $fifthUser->available_balance += $fifthUserProfit;
                                                                            $fifthUser->expected_referral_earning -= $fifthUserProfit;
                                                                            $fifthUser->save();
                
                                                                            $newProfit = $profit - $fifthUserProfit;
                                                                            $user->monthly_profit += $newProfit;
                                                                            $user->total_profit += $newProfit;
                                                                            $user->available_balance += $newProfit;
                                                                            $user->save();
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
                            }
                        }
                    }
                }else
                {
                    $user->monthly_profit += $profit;
                    $user->total_profit += $profit;
                    $user->available_balance += $profit;
                    $user->save();
                }
                $subscription->monthly_reward_date=now();
                $subscription->save();
            }
        }

        $this->info('Monthly profits calculated and added successfully.');
    }

    
}