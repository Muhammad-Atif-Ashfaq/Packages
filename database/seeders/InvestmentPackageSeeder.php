<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InvestmentPackage;

class InvestmentPackageSeeder extends Seeder
{
    public function run(): void
    {
        $user = InvestmentPackage::create([
            'name' => 'Bronze',
            'investment_start_range'=> 0,
            'investment_end_range'=> 2500,
            'monthly_return' => 1,
        ]);
        $user = InvestmentPackage::create([
            'name' => 'Silver',
            'investment_start_range'=> 2501,
            'investment_end_range'=> 10000,
            'monthly_return' => 1.25,
        ]);
        $user = InvestmentPackage::create([
            'name' => 'Gold',
            'investment_start_range'=> 10001,
            'investment_end_range' => 25000,
            'monthly_return' => 1.5,
        ]);
        
        $user = InvestmentPackage::create([
            'name' => 'Platinum',
            'investment_start_range'=> 25001,
            'investment_end_range' => 50000,
            'monthly_return' => 1.75,
        ]);
        
        $user = InvestmentPackage::create([
            'name' => 'Diamond',
            'investment_start_range'=> 50001,
            'investment_end_range' => 100000,
            'monthly_return' => 2,
        ]);
        
        $user = InvestmentPackage::create([
            'name' => 'Emerald',
            'investment_start_range'=> 100001,
            'investment_end_range' => 250000,
            'monthly_return' => 2.125,
        ]);
        
        $user = InvestmentPackage::create([
            'name' => 'Ruby',
            'investment_start_range'=> 250001,
            'investment_end_range' => 500000,
            'monthly_return' => 2.25,
        ]);
        
        $user = InvestmentPackage::create([
            'name' => 'Sapphire',
            'investment_start_range'=> 500001,
            'investment_end_range' => 750000,
            'monthly_return' => 2.375,
        ]);
        
        $user = InvestmentPackage::create([
            'name' => 'Black Diamond',
            'investment_start_range'=> 750001,
            'investment_end_range' => 1000000,
            'monthly_return' => 2.5,
        ]);
    }
}
