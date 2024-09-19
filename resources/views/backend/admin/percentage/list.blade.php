@extends('backend.admin.layout.app')
@section('content')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title bg-dark">
                    <h2 class="text-white">All Percentage</h2>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">

            <!-- table section -->
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30 " style="background-color:rgb(32, 32, 32);>
                    <div class="table_section padding_infor_info">
                        {{--  <a href="{{route('admin.investment_packages.create')}}" class="btn mb-2 text-white" style="background-color:black">Add New
                            Package</a>  --}}
                        <div class="table-responsive-sm">
                          @displayErrors
                            <table id="dataTable" class="table table-dark table-striped">
                                <thead>
                                    <tr style="font-weight: bold;">
                                        <th>ID</th>
                                        <th>First Profit</th>
                                        <th>Second Profit</th>
                                        <th>Third Profit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($percentages as $percentage)
                                    <tr>
                                        <td>{{$percentage->id}}</td>
                                        <td>{{$percentage->first_profit}}%</td>
                                        <td>{{$percentage->second_profit}}%</td>
                                        <td>{{$percentage->third_profit}}%</td>
                                        <td><a href="{{route('admin.percentage.edit', $percentage->id)}}"
                                                class="text-primary"><i class="fa fa-edit"></i></a>
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
