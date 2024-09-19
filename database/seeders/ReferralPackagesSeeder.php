<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReferralPackage;

class ReferralPackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $package1=ReferralPackage::create([
                'name'=>'Bronze Tier',
                'min_amount'=>'10000',
                'max_amount'=>'49999',
                'bonus_for_reaching_tier'=>'400',
                'monthly_downline_return'=>'2',
                'fixed_bonus_for_recruits_tier'=>'100',
        ]);

        $package2=ReferralPackage::create([
            'name'=>'Silver Tier',
            'min_amount'=>'50000',
            'max_amount'=>'199999',
            'bonus_for_reaching_tier'=>'1000',
            'monthly_downline_return'=>'3',
            'fixed_bonus_for_recruits_tier'=>'250',
        ]);

        $package3=ReferralPackage::create([
            'name'=>'Gold Tier',
            'min_amount'=>'200000',
            'max_amount'=>'499999',
            'bonus_for_reaching_tier'=>'2000',
            'monthly_downline_return'=>'4',
            'fixed_bonus_for_recruits_tier'=>'500',
        ]);

        $package4=ReferralPackage::create([
            'name'=>'Platinum Tier',
            'min_amount'=>'500000 ',
            'max_amount'=>'999999',
            'bonus_for_reaching_tier'=>'4000',
            'monthly_downline_return'=>'5',
            'fixed_bonus_for_recruits_tier'=>'1000',
        ]);

        // $package5=ReferralPackage::create([
        //     'name'=>'Diamond Tier',
        //     'min_amount'=>'1000000',
        //     'max_amount'=>'',
        //     'bonus_for_reaching_tier'=>'8000',
        //     'monthly_downline_return'=>'6',
        //     'fixed_bonus_for_recruits_tier'=>'2000',
        // ]);

        $package6=ReferralPackage::create([
            'name'=>'Executive',
            'min_amount'=>'100000',
            'max_amount'=>'499999',
            'bonus_for_reaching_tier'=>'4000',
            'monthly_downline_return'=>'5',
            'fixed_bonus_for_recruits_tier'=>'1000',
        ]);

        $package7=ReferralPackage::create([
            'name'=>'VIP Executive',
            'min_amount'=>'500000',
            'max_amount'=>'999999',
            'bonus_for_reaching_tier'=>'8000',
            'monthly_downline_return'=>'6',
            'fixed_bonus_for_recruits_tier'=>'2000',
        ]);


        $package8=ReferralPackage::create([
            'name'=>'Global Ambassador',
            'min_amount'=>'1000000',
            'max_amount'=>'4999999',
            'bonus_for_reaching_tier'=>'10000',
            'monthly_downline_return'=>'7',
            'fixed_bonus_for_recruits_tier'=>'2500',
        ]);

        $package9=ReferralPackage::create([
            'name'=>'Supreme Leader',
            'min_amount'=>'5000000',
            'max_amount'=>'',
            'bonus_for_reaching_tier'=>'20000',
            'monthly_downline_return'=>'8',
            'fixed_bonus_for_recruits_tier'=>'5,000',
        ]);


    }
}