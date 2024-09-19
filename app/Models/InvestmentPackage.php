<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'investment',
        'investment_start_range',
        'investment_end_range',
        'monthly_return',
    ];

    public function subscription()
    {
        return $this->hasMany(Subscription::class);
    }
}
