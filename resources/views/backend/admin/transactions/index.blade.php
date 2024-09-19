@extends('backend.admin.layout.app')
@section('content')

<div class="middle_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title bg-dark">
                    <h2 class="text-white">Transaction History</h2>
                </div>
            </div>
        </div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs mt-4" id="myTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="deposit-tab" data-toggle="tab" href="#deposit" role="tab" aria-controls="deposit" aria-selected="true">Deposit History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="withdraw-tab" data-toggle="tab" href="#withdraw" role="tab" aria-controls="withdraw" aria-selected="false">Withdraw History</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content mt-4" id="myTabsContent">
            <!-- Deposit History -->
            <div class="tab-pane fade show active" id="deposit" role="tabpanel" aria-labelledby="deposit-tab">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Source</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deposits as $deposit)
                                <tr>
                                    <td>{{ $deposit->user->name }}</td>
                                    <td>{{ $deposit->user->email }}</td>
                                    <td>{{ $deposit->source }}</td>
                                    <td>{{ $deposit->created_at }}</td>
                                    <td>{{ $deposit->amount }}</td>
                                    <td>{{ $deposit->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Withdraw History -->
            <div class="tab-pane fade" id="withdraw" role="tabpanel" aria-labelledby="withdraw-tab">
                <div class="table-responsive">
                    <table id="dataTable2" class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Source</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($withdraws as $withdraw)
                                <tr>
                                    <td>{{ $withdraw->user->name }}</td>
                                    <td>{{ $withdraw->user->email }}</td>
                                    <td>{{ $withdraw->source }}</td>
                                    <td>{{ $withdraw->type }}</td>
                                    <td>{{ $withdraw->created_at }}</td>
                                    <td>{{ $withdraw->amount }}</td>
                                    <td>{{ $withdraw->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#dataTable2').DataTable();
    });

  </script>
@endsection
