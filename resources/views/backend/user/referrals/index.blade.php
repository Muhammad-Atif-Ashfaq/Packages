@extends('backend.user.layout.app')
@section('content')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                @php
                $userId = auth()->user()->id;
                $shortId = base64_encode($userId);
                @endphp
                <div class="page_title bg-dark">
                    <h2 class="text-white">Your referral link is:
                        <strong>{{ route('user.register', $shortId)}}</strong> <button class="btn text-white ml-4"
                            id="copyReferralLink" style="background-color:black;">Copy</button>
                    </h2>
                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">

            <!-- table section -->
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30 " style="background-color:rgb(32, 32, 32);">
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            @displayErrors
                            <table id="dataTable" class="table table-striped table-dark text-white">
                                <thead>
                                    <tr style=" font-weight: bold;">
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Expected Referal Earnings</th>
                                        <th>Profit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{auth()->user()->expected_referral_earning}}</td>
                                        <td>{{auth()->user()->referral_profit}}</td>
                                    </tr>
                                    @empty

                                    {{--  <div><h3>No data found</h3></div>  --}}

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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const copyReferralLinkBtn = document.getElementById('copyReferralLink');

    copyReferralLinkBtn.addEventListener('click', function() {
        const referralLink = document.querySelector('strong').innerText;

        // Create a temporary input element to hold the referral link
        const tempInput = document.createElement('input');
        tempInput.value = referralLink;
        document.body.appendChild(tempInput);

        // Select the text inside the input element
        tempInput.select();
        tempInput.setSelectionRange(0, 99999); /* For mobile devices */

        // Copy the text inside the input element to clipboard
        document.execCommand('copy');

        // Remove the temporary input element
        document.body.removeChild(tempInput);

        // Show a notification or alert
        alert('Referral link copied to clipboard!');
    });
});
</script>

@endsection
