@extends('backend.admin.layout.app')
@section('content')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title bg-dark">
                    <h2 class="text-white">Add Investment Package</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30 txet-white" style="background-color:rgb(32, 32, 32);>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            @displayErrors
                            <form action="{{route('admin.investment_packages.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter name" required>
                                </div>
                                <div class="form-group">
                                    <label for="investment">Investment:</label>
                                    <input type="number" class="form-control" id="investment" name="investment"
                                        placeholder="Enter investment amount" required>
                                </div>
                                <div class="form-group">
                                    <label for="monthly_return">Monthly Return:</label>
                                    <input type="number" step="0.01" class="form-control" id="monthly_return"
                                        name="monthly_return" placeholder="Enter monthly return" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
