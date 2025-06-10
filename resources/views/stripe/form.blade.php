<!DOCTYPE html>
<html>
<head>
    <title>Stripe Payment</title>
</head>
<body>
@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<form action="{{ route('stripe.payment') }}" method="POST">
    @csrf
    <script src="https://checkout.stripe.com/checkout.js"
            class="stripe-button"
            data-key="{{ config('services.stripe.key') }}"
            data-amount="1000"
            data-name="Laravel Stripe"
            data-description="Test Payment"
            data-currency="usd">
    </script>
</form>
</body>
</html>
