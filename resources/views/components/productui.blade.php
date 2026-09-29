@props(['product'])


    
    {{-- <a href="{{route('product-details',$product->id)}}"> --}}
    <div {{$attributes}} class="grid grid-cols-1 w-80 h-100">
<div class=" rounded-xl bg-amber-400  grid grid-cols-1 w-80 h-100 ">
    @if ($product->image != null)
    <img src="{{asset('storage/'.$product->image)}}" class="w-full h-30 rounded-t-xl" >
        
    @endif
    <div class="p-4">
    <h3 class="font-bold h-15">{{$product->name}}</h3>
   
    <p class="h-30 line-clamp-3 overflow-hidden ">Description: {{$product->description}}</p>
    
    <p class="text-lg font-bold"> $ {{$product->price}}&nbsp; USD</p><br>
    
    {{-- <a href="{{route('add_product_to_cart',['product' => $product])}}"> --}}
    </div>
        <div class="items-end">
    <a href="{{route('add_product_to_cart',['product' => $product])}}">
        
            <button class="w-full bg-blue-500 rounded-b-xl text-white hover:bg-blue-600 font-bold h-10 ">
        Add to Cart
        
    </button>
</a>      
</div>
    {{-- </a> --}}

</div>
    </div>
{{-- 

<img src="{{$product->image}}" width="200px" height="150px">
    <h3>{{$product->title}}</h3>
    <p>Description: {{$product->description}}</p>
    <p>{{$product->price}}</p><br>
    <button>Buy Now</button>


--}}