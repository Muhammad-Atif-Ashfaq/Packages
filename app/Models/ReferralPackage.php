<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralPackage extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'min_amount',
        'max_amount',
        'bonus_for_reaching_tier',
        'second_profit',
        'third_profit',
        'fourth_profit',
        'fifth_profit',
        'monthly_downline_return',
        'fixed_bonus_for_recruits_tier',
    ];
}