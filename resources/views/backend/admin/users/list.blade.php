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
                    <h2 class="text-white">All Users</h2>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <!-- table section -->
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30" style="background-color:rgb(32, 32, 32);">
                    <div class="table_section padding_infor_info">
                        <input type="text" id="searchInput" class="form-control mt-3 mb-3" style="width: 300px;"
                            placeholder="Search...">
                        <div class="table-responsive-sm">
                            @displayErrors
                            <table id="dataTable" class="table table-dark table-striped">
                                <thead>
                                    <tr style=" font-weight: bold;">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Investment</th>
                                        <th>Balance</th>
                                        <th>Total Profit</th>
                                        <th>Profit</th>
                                        <th>Total Withdrawals</th>
                                        <th>Total Referrals</th>
                                        <th colspan="4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>${{$user->total_investment}}</td>
                                        <td>${{$user->deposit_amount}}</td>
                                        <td>${{$user->total_profit}}</td>
                                        <td>${{$user->available_balance}}</td>
                                        <td>${{$user->total_withdrawals}}</td>
                                        <td>{{totalUserReferrels($user->id)}}</td>
                                        <td>
                                            <a href="#" type="button" data-toggle="modal"
                                                data-target="#deposit{{ $user->id }}"
                                                class="btn btn-sm btn-primary">Deposit</a>
                                        </td>
                                        <td><a href="#" type="button" data-toggle="modal"
                                                data-target="#withdrawBalance{{ $user->id }}"
                                                data-user-id="{{ $user->id }}" class="btn btn-sm btn-warning">Withdraw
                                                Balance</a></td>
                                        <td><a href="#" type="button" data-toggle="modal"
                                                data-target="#withdrawProfit{{ $user->id }}"
                                                data-user-id="{{ $user->id }}" class="btn btn-sm btn-warning">Withdraw
                                                Profit</a></td>
                                        <td> <a href="{{ route('admin.user.destroy', ['id' => $user->id]) }}"
                                                data-user-id="{{ $user->id }}" class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>

                                    <!-- Deposit Modal -->
                                    <div id="deposit{{ $user->id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content -->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn btn-close"
                                                        data-dismiss="modal">x</button>
                                                    <h4 class="modal-title">Deposit</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Your deposit form -->
                                                    <form action="{{ route('admin.deposit', $user->id ) }}"
                                                        method="post">
                                                        @csrf
                                                        <label for="depositAmount">Enter Amount</label>
                                                        <input type="number" class="form-control" name="amount"
                                                            id="depositAmount">
                                                        <input type="submit" class="btn btn-dark mt-2" value="Deposit">
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Withdraw Modal -->
                                    <div id="withdrawBalance{{ $user->id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content -->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn btn-close"
                                                        data-dismiss="modal">x</button>
                                                    <h4 class="modal-title">Balance Withdraw</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Your deposit form -->
                                                    <form action="{{ route('admin.withdraw', $user->id ) }}"
                                                        method="post">
                                                        @csrf
                                                        <label for="withdrawBalanceAmount">Enter Amount</label>
                                                        <input type="number" class="form-control" name="amount"
                                                            id="withdrawBalanceAmount">
                                                        <input type="submit" class="btn btn-dark mt-2" value="Withdraw">
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Withdraw Profit Modal -->
                                    <div id="withdrawProfit{{ $user->id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content -->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn btn-close"
                                                        data-dismiss="modal">x</button>
                                                    <h4 class="modal-title">Profit Withdraw</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Your deposit form -->
                                                    <form action="{{ route('admin.withdrawProfit', $user->id ) }}"
                                                        method="post">
                                                        @csrf
                                                        <label for="withdrawProfitAmount">Enter Amount</label>
                                                        <input type="number" class="form-control" name="amount"
                                                            id="withdrawProfitAmount">
                                                        <input type="submit" class="btn btn-dark mt-2" value="Withdraw">
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @empty
                                    <tr>
                                        <td colspan="5">No data found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="container mt-2">
                            <h4 class="text-white ">Total Investment: <span
                                    class="text-white font-weight-bold">{{ $count['investment'] }}</span></h4>
                            <h4 class="text-white">Total Profit: <span
                                    class="text-white font-weight-bold">{{ $count['profit'] }}</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function searchUsers() {
    var term = $('#searchInput').val();
    $.ajax({
        url: "{{ route('admin.users.search') }}",
        type: 'GET',
        data: {
            term: term
        },
        success: function(response) {
            // Clear previous results
            $('#dataTable tbody').empty();

            // Populate table with new results
            response.forEach(function(user) {
                $('#dataTable tbody').append('<tr><td>' + user.id + '</td><td>' + user.name +
                    '</td><td>' + user.email + '</td><td>' + '$' + user.total_investment +
                    '</td><td>' + '$' + user.deposit_amount + '</td><td>' + '$' + user.total_profit +
                    '</td><td>' + '$' + user.available_balance + '</td><td>' + '$' + user.total_withdrawals +
                    '</td><td>' + user.total_referrels +
                    '</td><td><a href="#" type="button" data-toggle="modal" data-target="#deposit' + user.id + '" class="btn btn-sm btn-primary">Deposit</a></td><td><a href="#"  type="button" data-toggle="modal" data-target="#withdrawBalance' + user.id + '" class="btn btn-sm btn-warning">Withdraw Balance</a></td><td><a href="#"  type="button" data-toggle="modal" data-target="#withdrawProfit' + user.id + '" class="btn btn-sm btn-warning">Withdraw Profit</a></td><td><a href="{{ route("admin.user.destroy", ["id" => " + user.id + "]) }}" class="btn btn-sm btn-danger">Delete</a></td></tr>');
            });
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
}

// Trigger search on input change
$('#searchInput').on('input', function() {
    searchUsers();
});
</script>



@endsection