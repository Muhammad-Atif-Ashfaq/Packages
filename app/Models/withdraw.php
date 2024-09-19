<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class withdraw extends Model
{
    use HasFactory;
    protected $fillable=['amount','status','user_id','source','type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}