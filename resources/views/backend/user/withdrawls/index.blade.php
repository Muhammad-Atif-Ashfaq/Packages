@extends('backend.user.layout.app')
@section('content')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12 mt-4">
                <div class="page_title bg-dark">
                    <h2 class="text-white">Withdrawls</h2>
                </div>
            </div>
        </div>
            <div class="row">
                @forelse($data ?? [] as $item)
                <div class="card col-md-4 mt-2 bg-dark">
                    <div class="card-header ">
                        <h5 class="text-white">Date: {{ $item->created_at }}</h5>
                    </div>
                    <div class="card-body">
                        <h4 class="text-white">Amount: <b>$ {{ $item->amount }}</b></h4>
                        <h4 class="text-white">Source: <b>{{ $item->source }}</b></h4>
                        <h4 class="text-white">Type: <b>{{ $item->type }}</b></h4>
                    </div>
                    <div class="card-footer">
                        <h5 class="text-white">Status: <b>{{ $item->status }}</b></h5>
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


