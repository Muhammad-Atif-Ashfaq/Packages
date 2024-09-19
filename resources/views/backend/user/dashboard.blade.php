@extends('backend.user.layout.app')
@section('content')
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title bg-dark shadow ">
                <h2 class="text-white">Dashboard</h2>
            </div>
        </div>
    </div>
    <div class="row column1">
        <div class="col-md-6 col-lg-3">
            <div class="full counter_section margin_bottom_30 bg-dark shadow">
                <div class="couter_icon">
                    <div>
                        <i class="fa fa-retweet yellow_color"></i>
                    </div>
                </div>
                <div class="counter_no">
                    <div>
                        <p class="total_no text-white">{{ (auth()->user()->total_investment == 0) ? '0' : ('$' . auth()->user()->total_investment) }}</p>
                        <p class="head_couter text-white">Total Investment</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="full counter_section margin_bottom_30 bg-dark">
                <div class="couter_icon">
                    <div>
                        <i class="fa fa-money blue1_color"></i>
                    </div>
                </div>
                <div class="counter_no">
                    <div>
                        <p class="total_no text-white">{{ (auth()->user()->monthly_profit == 0) ? '0' : ('$' . auth()->user()->monthly_profit) }}</p>
                        <p class="head_couter text-white">Monthly Profit</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="full counter_section margin_bottom_30 bg-dark">
                <div class="couter_icon">
                    <div>
                        <i class="fa fa-users green_color"></i>
                    </div>
                </div>
                <div class="counter_no">
                    <div>
                        @php
                        $referrelAccount = totalReferrel();
                        @endphp
                        <p class="total_no text-white">{{$referrelAccount}}</p>
                        <p class="head_couter text-white">Total Referrals </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="full counter_section margin_bottom_30 bg-dark">
                <div class="couter_icon">
                    <div>
                        <i class="fa fa-money red_color"></i>
                    </div>
                </div>
                <div class="counter_no">
                    <div>
                        <p class="total_no text-white">{{ (auth()->user()->referral_profit == 0) ? '0' : ('$' . auth()->user()->referral_profit) }}</p>
                        <p class="head_couter text-white">Referral Profit</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
