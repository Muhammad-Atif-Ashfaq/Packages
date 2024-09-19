<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use App\Models\User;

class ReferralController extends Controller
{
    public function index()
    {
        $userId=Auth::user()->id;
        $data=User::where('referred_by',$userId)->get();
        return view('backend.user.referrals.index',compact('data'));

    }

}