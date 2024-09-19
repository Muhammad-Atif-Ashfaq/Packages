<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['token', 'user_id', 'package_id', 'package_name', 'amount', 'status','source'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}