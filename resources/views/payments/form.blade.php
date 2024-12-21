<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset("css/bootstrap.min.css") }}">
    <title>Payment Form</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h1>Pay {{$totalPrice}}$</h1>
    
    <form id="payment-form" action="{{ route('payment.process') }}" method="POST">
        @csrf
        <input type="hidden" name="totalPrice" value="{{$totalPrice}}">
        <div id="card-element" class="form-control"></div>
        
        <button type="submit" id="submit-button" class="btn btn-primary">Pay Now</button>
    </form>

    <script>
        const stripe = Stripe('{{ config("services.stripe.key") }}');
        const elements = stripe.elements();

        const cardElement = elements.create('card');
        
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit-button');

        form.addEventListener('submit', async (event) => {
            event.preventDefault(); 
            submitButton.disabled = true;

            const { paymentMethod, error } = await stripe.createPaymentMethod('card', cardElement);

            if (error) {
                alert(error.message);
                submitButton.disabled = false;
            } else {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'payment_method_id';
                hiddenInput.value = paymentMethod.id;
                form.appendChild(hiddenInput);
                form.submit();
            }
        });
    </script>
</body>
</html>
