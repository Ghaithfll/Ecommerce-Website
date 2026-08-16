<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>
</head>
<body>
    
    <div>
        name price quantity total image
        <form method="POST" action="">
            @csrf
        <h2>{{$product->name}}</h2>
       <?php 
        $quantity = 1;

       ?>
        <p>Price: {{$product->price}}</p>
       
        Quantity : 
        <input type="number" value="1" name="quantity"><br>
        Currency :<br>
        <select >
            <option name="currency" value="SAR">SAR</option>
            <option name="currency" value="jod">JOD</option>
            <option name="currency" value="usd">USD</option>
        </select>
        <h3>Total: {{$product->price}} &nbsp;&nbsp;&nbsp;&nbsp;<sub>But its only the price</sub></h3>

        <h3>Customer Info :<br>
            Name : {{$user->name}}<br>
            Email: {{$user->email}} 
        </h3>
        @error('error')
        <h2 style="color:red">{{$message}}</h2>    
        @enderror
        
        <button type="submit" >Buy Now</button>
        </form>
    </div>


</body>
</html>


