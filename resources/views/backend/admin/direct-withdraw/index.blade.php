@extends('backend.admin.layout.app')
@section('content')
@php
$count = counts();
@endphp
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title bg-dark">
                    <h2 class="text-white">Direct Withdrawls Details</h2>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <!-- table section -->
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30" style="background-color:rgb(32, 32, 32);">
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                           @displayErrors
                            <table id="dataTable" class="table table-dark table-striped">
                                <thead>
                                    <tr style=" font-weight: bold;">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Payable Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->user->name}}</td>
                                        <td>{{$item->user->email}}</td>
                                        <td>{{$item->amount}}</td>
                                        <td>{{$item->status}}</td>
                                        <td>
                                            <a href="{{ route('admin.pay',$item->id) }}"
                                                class="btn btn-sm btn-primary">Pay</a>
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
