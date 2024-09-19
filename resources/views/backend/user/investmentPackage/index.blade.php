@extends('backend.user.layout.app')
@section('content')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title bg-dark">
                    <h2 class="text-white">Investment Packages</h2>
                </div>
            </div>
        </div>
        <div class="row column1">
            <div class="col-md-12">
             @displayErrors
                <div class="white_shd full margin_bottom_30" style="background-color: rgb(32, 32, 32);">
                    <div class="full price_table padding_infor_info">
                        <div class="row">
                            @foreach($data as $package)
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <div class="table_price full border-0">
                                    <div class="inner_table_price">
                                        <div class="price_table_head green_bg">
                                            <h2>{{$package->name}}</h2>
                                        </div>
                                        <div class="price_table_inner">
                                            <div class="cont_table_price_blog bg-dark">
                                                <p class="text-white">${{ number_format($package->investment_start_range, 0) }} to ${{ number_format($package->investment_end_range, 0) }}</p>
                                            </div>
                                            <div class="cont_table_price">
                                                <ul class="bg-dark">
                                                    <li><a href="#" class="text-white">{{$package->monthly_return}}% Monthly Return</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="price_table_bottom bg-dark pb-4">
                                            <div class="center">
                                                @php
                                                $subscription = auth()->user()->subscription()->first();
                                                @endphp
                                                @if($subscription && $subscription->investment_package_id == $package->id)
                                                <button class="btn cur-p btn-success" style="margin-right: 10px;">Current</button>
                                                <a onclick="return confirm('Are you sure?')" href="{{route('user.cancel_package', [$package->id])}}" class="btn cur-p btn-danger">Cancel</a>
                                                @else
                                                <a class="main_bt buyNow" href="#" data-toggle="modal" data-target="#buyModal" data-package="{{ $package }}" data-range-start="{{ $package->investment_start_range }}" data-range-end="{{ $package->investment_end_range }}">Buy Now</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buyModalLabel">Enter Amount</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.buy_package') }}" method="post">
                    @csrf
                    <label for="amount">Amount</label>
                    <input type="number" class="form-control" name="amount" id="amount" min="0">
                    <button type="submit" class="main_bt mt-2">Buy</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.buyNow').on('click', function(event) {
            event.preventDefault();
            var package = $(this).data('package');
            var rangeStart = $(this).data('range-start');
            var rangeEnd = $(this).data('range-end');
            $('#buyModal').find('#amount').attr('min', rangeStart).attr('max', rangeEnd).val(rangeStart);
            $('#buyModal').modal('show');
        });
    });
</script>
@endsection
