
<x-layouts.Layout>
    <main class="pl-15">
    <h1 class="font-bold text-3xl">Cart Page</h1>
    
    @if (count($cart) == 0)
    <div class="flex w-full h-full mt-30  justify-center items-center">    
    <div class="grid grid-cols-1 justify-center content-center items-center">
        <h2 class="text-2xl font-bold text-center w-fit">Cart Empty</h2>
        <a href="{{route('home')}}">
            <button class="bg-cyan-500 hover:bg-cyan-800 rounded font-bold text-white min-h-13 my-5 w-50">
            Browse Products
        </button>
        </a>
    </div>
    </div>
    @else
    

 <h2 class="text-3xl font-bold">Products in my cart :</h2>
    <br>
    

        <form method="POST" action="" id="submit_checkout">
        @csrf
        </form>

<div class="flex overflow-hidden h-120">
    <div class="w-1/2 h-full overflow-y-auto scrollbar-none">
    @foreach ($cart as $cartRecord)
    
    
        <fieldset class=" w-150 p-5 border-cyan-500 border-4 rounded-xl ">
            <legend>Prod. id: {{$cartRecord->product_id}}</legend>   
                <x-cartProduct class="text-2xl " :product='$cartRecord->product_id'>
                    class="btn btn-neutral"
                </x-cartProduct>
                    Quantity : 
            <input class="rounded-xl text-xl border-cyan-500 border-3 px-2" type="number" form="submit_checkout" value="1"
            name="quantity_{{$cartRecord->product_id}}" min="1">

            
            </fieldset>
            
        @endforeach    
        <br><br>
    </div>
    
        <div id="total_info " class="text-2xl font-bold h-full w-1/2 ">
            <aside class="grid grid-cols-2 px-5">
               <label for="currency" class=" "> Currency :</label> 
            <select class=" rounded-xl text-xl border-cyan-500 border-5" name="currency" id="currency" form="submit_checkout">
                <option  value="SAR">SAR</option>
                <option  value="JOD">JOD</option>
                <option  value="USD">USD</option>
            </select>
            <h3>Total:  
                    </h3>
                        <h3>$ 125</h3>
                    
            <h3 class="col-span-2">Customer Info :</h3>
                <div class="text-xl p-5 col-span-2">
                Name : {{$user->name}}<br>
                Email: {{$user->email}} 
                </div>
            @error('error')
            <h2 style="color:red">{{$message}}</h2>    
            @enderror
            
            <button class="w-full bg-cyan-500 hover:bg-cyan-800 rounded font-bold text-white min-h-13 my-5" type="submit" form="submit_checkout" style="width:150px;height:60px">Buy Now</button>
            </aside>
    </div>
</div>
        @endif
    

            
</main>
</x-layouts.Layout>
