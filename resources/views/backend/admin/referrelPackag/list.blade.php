@extends('backend.admin.layout.app')
@section('content')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title bg-dark">
                    <h2 class="text-white">All Referral Packages</h2>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">

            <!-- table section -->
            <div class="col-md-12">
                <!-- <a href="{{route('admin.investment_packages.create')}}" class="btn cur-p btn-outline-primary">Add New
                    Package</a> -->
                <div class="white_shd full margin_bottom_30" style="background-color:rgb(32, 32, 32);>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                           @displayErrors
                            <table id="dataTable" class="table table-dark table-striped">
                                <thead>
                                    <tr style=" font-weight: bold;">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Min Amount</th>
                                        <th>Max Amount</th>
                                        <th>Bonus</th>
                                        <th>First Profit</th>
                                        <th>Second Profit</th>
                                        <th>Third Profit</th>
                                        <th>Fourth Profit</th>
                                        <th>Fifth Profit</th>
                                        <th>Bonus for Recruits Tier</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($package as $packages)
                                    <tr>
                                        <td>{{$packages->id}}</td>
                                        <td>{{$packages->name}}</td>
                                        <td>${{$packages->min_amount}}</td>
                                        <td>{{$packages->max_amount}}</td>
                                        <td>{{$packages->bonus_for_reaching_tier}}</td>
                                        <td>{{$packages->monthly_downline_return}}%</td>
                                        <td>{{($packages->second_profit == null ? 0:$packages->second_profit)}}%</td>
                                        <td>{{($packages->third_profit == null ? 0:$packages->third_profit)}}%</td>
                                        <td>{{($packages->fourth_profit == null ? 0:$packages->fourth_profit)}}%</td>
                                        <td>{{($packages->fifth_profit == null ? 0:$packages->fifth_profit)}}%</td>
                                        <td>{{$packages->fixed_bonus_for_recruits_tier}}</td>
                                        <td><a href="{{route('admin.referrel_packages.edit', $packages->id)}}"
                                                class="text-primary"><i class="fa fa-edit"></i></a>
                                            <!-- <a href="{{route('admin.investment_packages.destroy', $packages->id)}}"
                                                class="text-danger"><i class="fa fa-trash"></i></a> -->
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5">No data found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
