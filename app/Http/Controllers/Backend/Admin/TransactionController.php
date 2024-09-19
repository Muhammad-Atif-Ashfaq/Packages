<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Withdraw;
use App\Models\Payment;

class TransactionController extends Controller
{
    public function index()
    {
        $deposits=Payment::all();
        $withdraws=Withdraw::all();
        return view('backend.admin.transactions.index',compact('deposits','withdraws'));
    }

}