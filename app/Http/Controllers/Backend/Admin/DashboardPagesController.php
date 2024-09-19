<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class DashboardPagesController extends Controller
{
    public function totalInvestments()
    {
        $users=User::all();
        return view('backend.admin.dashboard-pages.total_investments',compact('users'));

    }

    public function totalUsersProfit()
    {
        $users=User::all();
        return view('backend.admin.dashboard-pages.total_users_profit',compact('users'));
    }

    public function totalReferrals()
    {
        $users=User::all();
        return view('backend.admin.dashboard-pages.total_referrals',compact('users'));
    }
}