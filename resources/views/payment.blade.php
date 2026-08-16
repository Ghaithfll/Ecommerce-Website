<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
</head>
<body>

    <h1>Payment page</h1>

<script
    src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$checkoutId}}"
    integrity={{$integrity}}
    crossorigin="anonymous">
</script>
<form
    action="{{ route('payment_result',['order' => $order,'checkoutId' => $checkoutId]) }}"
    class="paymentWidgets"
    data-brands="VISA MASTER AMEX">
</form>


@error('error')
    <h1>ERRORRRRRRRRR</h1>    
<h2 style="color:red">{{$message}}</h2>

@enderror

{{-- 
<h3>checkout id: {{$checkoutId}}</h3>
<h3>integrity id: {{$integrity}}</h3> --}}

</body>
</html>


