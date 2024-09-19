@extends('backend.admin.layout.app')
@section('content')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title bg-dark">
                    <h2 class="text-white">Update Referral Package</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30 text-white" style="background-color:rgb(32, 32, 32);>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            @displayErrors
                            <form action="{{route('admin.referrel_packages.update', $package->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter name" value="{{$package->name}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="min_amount">Minimum Amount</label>
                                    <input type="number" class="form-control" id="min_amount" name="min_amount"
                                         value="{{$package->min_amount}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="max_amount">Maximum Amount</label>
                                    <input type="number" class="form-control" id="max_amount" name="max_amount"
                                         value="{{$package->max_amount}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="bonus_for_reaching_tier">Bonus for Reaching Tier</label>
                                    <input type="number" class="form-control" id="bonus_for_reaching_tier" name="bonus_for_reaching_tier"
                                         value="{{$package->bonus_for_reaching_tier}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="fixed_bonus_for_recruits_tier">Fixed Bonus for Recruit's Tier Advancement</label>
                                    <input type="number" class="form-control" id="fixed_bonus_for_recruits_tier" name="fixed_bonus_for_recruits_tier"
                                         value="{{$package->fixed_bonus_for_recruits_tier}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="monthly_downline_return">Monthly Downline Return Share</label>
                                    <input type="number" step="0.01" class="form-control" id="monthly_downline_return"
                                        name="monthly_downline_return" value="{{$package->monthly_downline_return}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="monthly_downline_return">Second Profit</label>
                                    <input type="number" step="0.01" class="form-control" id="second_profit"
                                        name="second_profit" value="{{$package->second_profit}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="monthly_downline_return">Third Profit</label>
                                    <input type="number" step="0.01" class="form-control" id="third_profit"
                                        name="third_profit" value="{{$package->third_profit}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="monthly_downline_return">Fourth Profit</label>
                                    <input type="number" step="0.01" class="form-control" id="fourth_profit"
                                        name="fourth_profit" value="{{$package->fourth_profit}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="monthly_downline_return">Fifth Profit</label>
                                    <input type="number" step="0.01" class="form-control" id="fifth_profit"
                                        name="fifth_profit" value="{{$package->fifth_profit}}" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
