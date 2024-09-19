@extends('backend.admin.layout.app')
@section('content')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title bg-dark">
                    <h2 class="text-white">Update Percentage</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30 text-white" style="background-color:rgb(32, 32, 32);>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            @displayErrors
                            <form action="{{route('admin.percentage.update', $percentage->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">First Profit:</label>
                                    <input type="text" class="form-control" id="first_name" name="first_profit"
                                        placeholder="" value="{{$percentage->first_profit}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="investment">Second Profit:</label>
                                    <input type="number" class="form-control" id="first_name" name="second_profit"
                                        placeholder="" value="{{$percentage->second_profit}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="investment">Third Profit:</label>
                                    <input type="number" class="form-control" id="third_name" name="third_profit"
                                        placeholder="" value="{{$percentage->third_profit}}" required>
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
