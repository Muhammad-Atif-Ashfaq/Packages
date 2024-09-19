@extends('backend.user.layout.app')
@section('content')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12 mt-4">
                <div class="page_title bg-dark">
                    <h2 class="text-white">Wallet</h2>
                </div>
            </div>
        </div>
        <div class="row column1">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30 bg-dark">
                    <div class="full price_table padding_infor_info">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="wallet_info">
                                    @displayErrors
                                    <ul class="wallet-details  text-white">
                                        <li class="display-4 text-white">Balance: <b>${{ auth()->user()->deposit_amount  }}</b></li>
                                        <li class="display-4 text-white">Profit: <b>${{ auth()->user()->available_balance }}</b></li>

                                        <li><span class=" text-white">Total Investment:</span>
                                            ${{ auth()->user()->total_investment  }}</li>
                                        <li><span class=" text-white">Total Profit:</span>
                                            ${{ auth()->user()->total_profit  }}</li>
                                        <li><span class=" text-white">Total Withdrawals:</span>
                                            ${{ auth()->user()->total_withdrawals }}</li>
                                    </ul>
                                </div>
                                <!-- Button to trigger deposit modal -->
                                <button type="button" class="btn btn-secondary shadow" data-toggle="modal" data-target="#depositModal">Deposit</button>
                                <button type="button" class="btn btn-secondary shadow"  data-toggle="modal" data-target="#balanceWithdraw">Withdraw Balance</button>
                                <button type="button" class="btn btn-secondary shadow"  data-toggle="modal" data-target="#profitWithdraw">Withdraw Profit</button>
                            </div>
                            <div class="col-md-6 mt-2" style="float:right;">
                                <a href="{{ route('user.coin.payment') }}"><button class="btn text-white"
                                        style="background-color:black;">Deposit Details</button></a>
                                <a href="{{ route('user.withdrawDetails') }}"><button class="btn text-white ml-2"
                                        style="background-color:black;">Withdraw Details</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Deposit Modal -->
<div id="depositModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-close" data-dismiss="modal">x</button>
                <h4 class="modal-title">Deposit</h4>
            </div>
            <div class="modal-body">
                <!-- Your deposit form -->
                <form action="{{ route('user.deposit', auth()->user()->id ) }}" method="post">
                    @csrf
                    <label for="depositAmount">Enter Amount</label>
                    <input type="number" class="form-control" name="amount" id="depositAmount">
                    <label for="currency">Currency</label>
                    <select class="form-control" name="currency" id="currency">
                        <option>Select Currency</option>
                        <option value="BTC" data-name="Bitcoin">Bitcoin (BTC)</option>
                        <option value="BTC.BEP20" data-name="Bitcoin/BTCB Token (BSC Chain)">Bitcoin/BTCB Token (BSC
                            Chain)</option>
                        <option value="BCH" data-name="Bitcoin Cash">Bitcoin Cash (BCH)</option>
                        <option value="BCH.BEP2" data-name="Bitcoin Cash Token (BC Chain)">Bitcoin Cash Token (BC Chain)
                        </option>
                        <option value="BCH.BEP20" data-name="Bitcoin Cash Token (BSC Chain)">Bitcoin Cash Token (BSC
                            Chain)</option>
                        <option value="VLX" data-name="Velas">Velas (EVM)</option>
                        <option value="LTCT" data-name="Litecoin">Litecoin Testnet (LTCT)</option>
                        <!-- Add more cryptocurrency options as needed -->
                    </select>
                    <input type="hidden" name="currency_name" id="currency_name" value="">
                    <input type="submit" class="btn btn-dark mt-2" value="Deposit">
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="balanceWithdraw" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-close" data-dismiss="modal">x</button>
                <h4 class="modal-title">Withdraw</h4>
            </div>
            <div class="modal-body">
            <form action="{{ route('user.withdraw', auth()->user()->id) }}" method="post">
                @csrf
                <label for="address">Enter Account Address</label>
                <input type="text" class="form-control" name="address" id="address">

                <label for="amount">Enter Amount</label>
                <input type="number" class="form-control" name="amount" id="amount">

                <label for="withdrawcurrency">Currency</label>
                <select class="form-control" name="withdrawcurrency" id="withdrawcurrency">
                    <option>Select Currency</option>
                    <option value="BTC" data-name="Bitcoin">Bitcoin (BTC)</option>
                    <option value="BTC.BEP20" data-name="Bitcoin/BTCB Token (BSC Chain)">Bitcoin/BTCB Token (BSC Chain)</option>
                    <option value="BCH" data-name="Bitcoin Cash">Bitcoin Cash (BCH)</option>
                    <option value="BCH.BEP2" data-name="Bitcoin Cash Token (BC Chain)">Bitcoin Cash Token (BC Chain)</option>
                    <option value="BCH.BEP20" data-name="Bitcoin Cash Token (BSC Chain)">Bitcoin Cash Token (BSC Chain)</option>
                    <option value="VLX" data-name="Velas">Velas (EVM)</option>
                    <option value="LTCT" data-name="Litecoin">Litecoin Testnet (LTCT)</option>
                    <!-- Add more cryptocurrency options as needed -->
                </select>
                <input type="hidden" name="withdrawcurrency_name" id="withdrawcurrency_name" value="">
                <input type="submit" class="btn btn-dark mt-2" value="Withdraw">
            </form>

                <h3>Withdraw Fees</h3>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>



    </div>
</div>



<div id="profitWithdraw" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn btn-close" data-dismiss="modal">x</button>
          <h4 class="modal-title">Withdraw</h4>
        </div>
        <div class="modal-body">
          <form action="{{ route('user.withdrawProfit',auth()->user()->id) }}" method="post">
            @csrf
            <label for="address">Enter Account Address</label>
            <input type="text" class="form-control" name="address" id="address">
            <label for="amount">Enter Amount</label>
            <input type="number" class="form-control" name="amount" id="amount">
            <label for="withdrawcurrency">Currency</label>
            <select class="form-control" name="withdrawcurrency2" id="withdrawcurrency2">
                <option>Select Currency</option>
                <option value="BTC" data-name2="Bitcoin">Bitcoin (BTC)</option>
                <option value="BTC.BEP20" data-name2="Bitcoin/BTCB Token (BSC Chain)">Bitcoin/BTCB Token (BSC Chain)</option>
                <option value="BCH" data-name2="Bitcoin Cash">Bitcoin Cash (BCH)</option>
                <option value="BCH.BEP2" data-name2="Bitcoin Cash Token (BC Chain)">Bitcoin Cash Token (BC Chain)</option>
                <option value="BCH.BEP20" data-name2="Bitcoin Cash Token (BSC Chain)">Bitcoin Cash Token (BSC Chain)</option>
                <option value="VLX" data-name2="Velas">Velas (EVM)</option>
                <option value="LTCT" data-name2="Litecoin">Litecoin Testnet (LTCT)</option>
                <!-- Add more cryptocurrency options as needed -->
            </select>
            <input type="hidden" name="withdrawcurrency_name2" id="withdrawcurrency_name2" value="">
            <input type="submit" class="btn btn-dark mt-2" value="withdraw">
          </form>

          <h3>Withdraw Fees</h3>
        <p>No fees for profit withdrawls</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <script>
    document.getElementById('currency').addEventListener('change', function() {
        var currencySelect = document.getElementById('currency');
        var currencyNameInput = document.getElementById('currency_name');
        console.log(currencySelect, currencyNameInput);
        var selectedOption = currencySelect.options[currencySelect.selectedIndex];
        currencyNameInput.value = selectedOption.getAttribute('data-name');
    });
    document.getElementById('withdrawcurrency').addEventListener('change', function() {
        var currencySelect = document.getElementById('withdrawcurrency');
        var currencyNameInput = document.getElementById('withdrawcurrency_name');
        var selectedOption = currencySelect.options[currencySelect.selectedIndex];
        currencyNameInput.value = selectedOption.getAttribute('data-name');
    });
    document.getElementById('withdrawcurrency2').addEventListener('change', function() {
        var currencySelect = document.getElementById('withdrawcurrency2');
        var currencyNameInput = document.getElementById('withdrawcurrency_name2');
        var selectedOption = currencySelect.options[currencySelect.selectedIndex];
        currencyNameInput.value = selectedOption.getAttribute('data-name2');
    });
    </script>

@endsection




