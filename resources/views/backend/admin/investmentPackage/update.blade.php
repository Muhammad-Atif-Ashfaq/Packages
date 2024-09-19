@extends('backend.admin.layout.app')
@section('content')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title bg-dark">
                    <h2 class="text-white">Update Investment Package</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30 text-white" style="background-color:rgb(32, 32, 32);>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            @displayErrors
                            <form action="{{route('admin.investment_packages.update', $package->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter name" value="{{$package->name}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="investment">Investment Start:</label>
                                    <input type="number" class="form-control" id="investment" name="investment_start_range"
                                        placeholder="Enter investment amount" value="{{$package->investment_start_range}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="investment">Investment End:</label>
                                    <input type="number" class="form-control" id="investment" name="investment_end_range"
                                        placeholder="Enter investment amount" value="{{$package->investment_end_range}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="monthly_return">Monthly Return:</label>
                                    <input type="number" step="0.01" class="form-control" id="monthly_return"
                                        name="monthly_return" placeholder="Enter monthly return" value="{{$package->monthly_return}}" required>
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
