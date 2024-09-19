@extends('backend.admin.layout.app')
@section('content')
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title bg-dark">
                <h2 class="text-white">Profile</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white_shd full margin_bottom_30 bg-dark text-white" >
                <div class="table_section padding_infor_info">
                    <div class="table-responsive-sm">
                      @displayErrors
                        <form action="{{route('admin.update.profile')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Update Name:</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                                    value="{{auth()->user()->name}}" >
                            </div>
                            <div class="form-group">
                                <label for="monthly_return">Update Password:</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter New Password" >
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection