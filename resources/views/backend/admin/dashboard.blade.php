@extends('backend.admin.layout.app')
@section('content')
@php
$count = counts();
@endphp
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title bg-dark">
                <h2 class="text-white">Dashboard</h2>
            </div>
        </div>
    </div>
    <div class="row column1">
         <div class="col-md-6 col-lg-3">
            <a href="{{ route('admin.users') }}"> <div class="full counter_section margin_bottom_30 bg-dark">
                <div class="couter_icon">
                    <div>
                        <i class="fa fa-user yellow_color"></i>
                    </div>
                </div>
                <div class="counter_no">
                    <div>
                        <p class="total_no text-white">{{$count['users']}}</p>
                        <p class="head_couter text-white">Total Users</p>
                    </div>
                </div>
            </div></a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('admin.totalInvestments') }}"><div class="full counter_section margin_bottom_30 bg-dark">
                <div class="couter_icon">
                    <div>
                        <i class="fa fa-clock-o blue1_color"></i>
                    </div>
                </div>
                <div class="counter_no">
                    <div>
                        <p class="total_no text-white">$ {{$count['investment']}}</p>
                        <p class="head_couter text-white">Total Investments</p>
                    </div>
                </div>
            </div></a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('admin.totalUsersProfit') }}"> <div class="full counter_section margin_bottom_30 bg-dark">
                <div class="couter_icon">
                    <div>
                        <i class="fa fa-money green_color"></i>
                    </div>
                </div>
                <div class="counter_no">
                    <div>
                        <p class="total_no text-white">$ {{$count['profit']}}</p>
                        <p class="head_couter text-white">Total Users Profit</p>
                    </div>
                </div>
            </div></a>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="full counter_section margin_bottom_30 bg-dark">
                <div class="couter_icon">
                    <div>
                        <i class="fa fa-money yellow_color"></i>
                    </div>
                </div>
                <div class="counter_no">
                    <div>
                        <p class="total_no text-white">$ {{$count['withdrawal_profit_admin']}}</p>
                        <p class="head_couter text-white">Total Withdrawal Profit (admin)</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('admin.totalReferrals') }}"><div class="full counter_section margin_bottom_30 bg-dark">
                <div class="couter_icon">
                    <div>
                        <i class="fa fa-users red_color"></i>
                    </div>
                </div>
                <div class="counter_no">
                    <div>
                        <p class="total_no text-white">{{$count['referrel']}}</p>
                        <p class="head_couter text-white">Total Referrals</p>
                    </div>
                </div>
            </div></a>
        </div>
    </div>
</div>
@endsection
