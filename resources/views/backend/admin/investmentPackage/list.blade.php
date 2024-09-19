@extends('backend.admin.layout.app')
@section('content')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title bg-dark">
                    <h2 class="text-white">All Packages</h2>
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
                                        <th>Name</th>
                                        <th>Investment Range</th>
                                        <th>Monthly Return</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($package as $packages)
                                    <tr>
                                        <td>{{$packages->id}}</td>
                                        <td>{{$packages->name}}</td>
                                        <td>${{$packages->investment_start_range}} to ${{$packages->investment_end_range}}</td>
                                        <td>{{$packages->monthly_return}}%</td>
                                        <td><a href="{{route('admin.investment_packages.edit', $packages->id)}}"
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
