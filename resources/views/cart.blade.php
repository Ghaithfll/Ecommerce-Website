<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
</head>
<body>
    <h1>Cart Page</h1>
    
    @if (count($cart) == 0)
        <h2>Cart Empty</h2>
        <a href="{{route('home')}}">Browse Products</a>
    
    @else
    <h2>Products in my cart :</h2>
        <form method="POST" action="">
        @csrf

    @foreach ($cart as $cartRecord)
    <fieldset>
  <legend>{{$cartRecord->product_id}}</legend>   
    <x-cartProduct :product='$cartRecord->product_id'/>
            Quantity : 
        <input type="number" value="1" name="quantity_{{$cartRecord->product_id}}" min="1">
    </fieldset>
            
        @endforeach    
        <br>

        Currency :<br>
        <select name="currency" id="currency">
            <option  value="SAR">SAR</option>
            <option  value="JOD">JOD</option>
            <option  value="USD">USD</option>
        </select>
        <h3>Total: HERE IS THE TOTAL WHICH IS HARD TO CALCULATE WITHOUT JS 
            {{-- &nbsp;&nbsp;&nbsp;&nbsp;<sub>But its only the price</sub>
         --}}
        </h3>

        <h3>Customer Info :<br>
            Name : {{$user->name}}<br>
            Email: {{$user->email}} 
        </h3>
        @error('error')
        <h2 style="color:red">{{$message}}</h2>    
        @enderror
        
        <button type="submit" style="width:150px;height:60px">Buy Now</button>
        <br><br><br><br><br><br><br>
    </form>
    
    
        @endif
    

            
</body>
</html>