<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Percentage;

class PercentageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $percentage=Percentage::create([
                'first_profit'=>'0',
                'second_profit'=>'0',
                'third_profit'=>'0'
        ]);
    }
}