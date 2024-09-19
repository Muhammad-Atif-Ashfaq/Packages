<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'investment_package_id',
        'monthly_reward_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function investmentPackage()
    {
        return $this->belongsTo(InvestmentPackage::class);
    }
}