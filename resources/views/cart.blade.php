<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
      @vite('resources/css/app.css')
</head>
<body>
    <x-navbar/>
    <main class="m-15">
    <h1 class=" text-3xl font-bold">Cart Page</h1>
    
    @if (count($cart) == 0)
            <div class="w-screen h-100 flex justify-center items-center pr-15">
                <div>
        <h2 class="text-3xl font-bold ">Cart Is Empty</h2><br>
        <a  href="{{route('home')}}">
            <button class="btn btn-neutral">
            Browse Products
            </button>    
        </a>
        </div></div>
    
    @else
    <br>
    <br>
    <h2 class="text-3xl font-bold">Products in my cart :</h2>
    <br>
        <form method="POST" action="" id="submit_checkout">
        @csrf
        </form>
<div class="grid grid-cols-2 ">
    <div class="">
    @foreach ($cart as $cartRecord)
    
    
        <fieldset class="fieldset bg-base-300 w-150 p-5 border-base-300 rounded-box ">
  <legend>Prod. id: {{$cartRecord->product_id}}</legend>   
    <x-cartProduct class="text-2xl " :product='$cartRecord->product_id'>
     class="btn btn-neutral"
    </x-cartProduct>
            Quantity : 
        <input class="input" type="number" form="submit_checkout" value="1"
         name="quantity_{{$cartRecord->product_id}}" min="1">
    </fieldset>
            
        @endforeach    
        <br><br>
    </div>
        <div id="total_info " class="text-2xl font-bold">
               <label for="currency" class="label "> Currency :</label><br>
            <select class="select" name="currency" id="currency" form="submit_checkout">
                <option  value="SAR">SAR</option>
                <option  value="JOD">JOD</option>
                <option  value="USD">USD</option>
            </select><br>
            <h3>Total: $ 125 
                    </h3>

                    
            <h3>Customer Info :</h3>
                <div class="text-xl p-5">
                Name : {{$user->name}}<br>
                Email: {{$user->email}} 
                </div>
            @error('error')
            <h2 style="color:red">{{$message}}</h2>    
            @enderror
            
            <button class="btn btn-primary text-1xl font-bold my-4 " type="submit" form="submit_checkout" style="width:150px;height:60px">Buy Now</button>
        </div>
    </div>
        <br><br><br><br><br><br><br>
    
    
        @endif
    
    </main>
            
</body>
</html>