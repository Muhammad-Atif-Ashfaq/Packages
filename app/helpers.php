<?php
use Illuminate\Support\Facades\Auth;
use App\Models\User;


function totalReferrel()
{
    $count = User::where('referred_by', auth()->user()->id)->count();
    return $count;
}

function totalUserReferrels($userId)
{
    $count = User::where('referred_by', $userId)->count();
    return $count;
}

function counts()
{
    $count['users'] = User::where('id', '!=', 1)->count();
    $count['investment'] = User::sum('total_investment');
    $count['profit'] = User::where('role', '!=', 'admin')->sum('total_profit');
    $count['withdrawal_profit_admin'] = User::where('role', 'admin')->pluck('total_profit')->first();
    $count['referrel'] = User::where('referred_by', '!=', null)->count();
    return $count;
}