<!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Your loader HTML here -->
<div id="loader" class="d-flex justify-content-center align-items-center" style="display: none; height: 100vh; background-color: white;">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<form id="coinpayments-form" action="https://www.coinpayments.net/index.php?cmd=acct_home" method="post" target="_top">
    @csrf
    <input type="hidden" name="cmd" value="_pay">
    <input type="hidden" name="reset" value="1">
    <input type="hidden" name="want_shipping" value="0">
    <input type="hidden" name="merchant" value="{{ $merchantId }}">
    <input type="hidden" name="currency" value="{{$currency}}">
    @if(isset($amount))
    <input type="hidden" name="amountf" value="{{$amount}}">
    @endif
    <input type="hidden" name="item_name" value="Test Item">
    <input type="hidden" name="allow_extra" value="1">
    <!-- Append session data as query parameters to the success URL -->
    <input type="hidden" name="success_url" value="{{ route('user.coin.success') }}?{{ http_build_query($successUrl) }}">
    <input type="hidden" name="cancel_url" value="{{ route('user.coin.cancel') }}?{{ http_build_query($cancelUrl) }}">
    <input type="image" src="https://www.coinpayments.net/images/pub/buynow-white.png" alt="Buy Now with CoinPayments.net" style="display:none;">
</form>

<script>
    // Submit the form on page load
    window.onload = function() {
        document.getElementById('loader').style.display = 'block';
        document.getElementById('coinpayments-form').submit();
    };

    // Redirect to success or cancel URLs after form submission
    document.getElementById('coinpayments-form').addEventListener('submit', function() {
        // Define the success and cancel URLs
        var successUrl = '{{ route('user.coin.success') }}';
        var cancelUrl = '{{ route('user.coin.cancel') }}';

        // Add query parameters to the URLs if needed
        var queryParams = window.location.search;

        // Check if the form submission was successful
        // For demonstration purposes, let's assume it's successful after a timeout
        // Simulate receiving a successful payment response after a delay
        setTimeout(function() {
            // Simulated successful payment response
            var paymentStatus = 'success'; // Change this to 'success' for simulation

            // Define the success URL
            var successUrl = '{{ route('user.coin.success') }}';
            var queryParams = window.location.search;

            if (paymentStatus === 'success') {
                window.location.href = successUrl + queryParams;
            }
        }, 3000); // Simulate a delay of 3 seconds (adjust as needed)

    });
</script>
