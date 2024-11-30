@extends('layouts.app')

@section('title', 'Payment')

@section('content')
<div class="container mx-auto mt-10 px-4 text-center">
    <h2 class="text-2xl font-bold mb-6">Complete Your Payment</h2>
    <button id="pay-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Pay Now
    </button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert('Payment successful!');
                window.location.href = "/payment-success/{{ $booking->id }}";
            },
            onPending: function(result) {
                alert('Waiting for payment!');
            },
            onError: function(result) {
                alert('Payment failed!');
            },
            onClose: function() {
                alert('You closed the payment popup!');
            }
        });
    };
</script>
@endsection
