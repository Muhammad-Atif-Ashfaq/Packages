@extends('backend.user.layout.app')
@section('content')
@php
$count = counts();
@endphp
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title bg-dark">
                    <h2 class="text-white">Withdraw Fees</h2>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <!-- table section -->
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30" style="background-color:rgb(32, 32, 32);>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                           @displayErrors
                            <table  class="table table-dark table-striped">
                                <thead>
                                    <tr style=" font-weight: bold;">
                                        <th><b>Duration</b></th>
                                        <th><b>Fees</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Less than 6 months</td>
                                        <td>27%</td>
                                    </tr>
                                    <tr>
                                        <td>6-12 months</td>
                                        <td>21.6%</td>
                                    </tr>
                                    <tr>
                                        <td>12-24 months</td>
                                        <td>13.5%</td>
                                    </tr>
                                    <tr>
                                        <td>More than 24 months</td>
                                        <td>5.4%</td>
                                    </tr>

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
