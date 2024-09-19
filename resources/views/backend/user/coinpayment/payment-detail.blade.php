@extends('backend.user.layout.app')
@section('content')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title bg-dark mt-4">
                    <h2 class="text-white">Payments</h2>
                </div>
            </div>
        </div>
            <div class="row">
                @if(!isset($data))
                <div><h3 class="text-white text-center">No data found</h3></div>
                @endif

                 @forelse($data ?? [] as $item)
                <div class="card col-md-4 mt-2 bg-dark">
                    <div class="card-header">
                        <h5 class="text-white">Date: {{ $item->created_at }}</h5>
                    </div>
                    <div class="card-body">
                        <h4 class="text-white">Amount: </h4>
                        <h6 class="text-white">$ {{ $item->amount }}</h6>
                        <h4 class="text-white">Source: </h4>
                        <h6 class="text-white"> {{ $item->source }}</h6>
                    </div>
                    <div class="card-footer">
                        <h5 class="text-white">Status: {{ $item->status }}</h5>
                     </div>
                </div>
                 @empty
            <div class="col-md-12">
                <div class="alert bg-dark text-center mt-4">
                    <h3 class="text-white">No data found</h3>
                </div>
            </div>
            @endforelse
            </div>
    </div>
</div>

@endsection
