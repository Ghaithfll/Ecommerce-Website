<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
     @vite('resources/css/app.css')
</head>
<body>

    <h1 class="text-3xl m-15 font-bold">Payment page</h1>

    <div class="text-black">
       
<script
    src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$checkoutId}}"
    integrity={{$integrity}}
    crossorigin="anonymous">
</script>
<form
    action="{{ route('payment_result',['checkoutId' => $checkoutId]) }}"
    class="paymentWidgets"
    data-brands="VISA MASTER AMEX">
</form>
    </div>


@error('error')
    
<h2 style="color:red">{{$message}}</h2>

@enderror

{{-- 
<h3>checkout id: {{$checkoutId}}</h3>
<h3>integrity id: {{$integrity}}</h3> --}}

</body>
</html>


