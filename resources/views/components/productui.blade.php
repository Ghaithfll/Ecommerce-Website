{{-- @props([ // or u can just send the product model instance
    'title' => 'title',
    'description' => 'description',
    'price' => '0.00',
    'image'
    ]) --}}
@props(['product'])
<fieldset>
    
    <a href="{{route('product-details',$product->id)}}">
    <legend>{{$product->name}}</legend>
<div style="color: black">
    @if ($product->image != null)
    <img src="{{asset('storage/'.$product->image)}}" width="150px" height="100px">
        
    @endif
    <h3>{{$product->name}}</h3>
    <p>Description: {{$product->description}}</p>
    <p>{{$product->price}}</p><br>
    <a href="{{route('checkout',['product' => $product])}}">
    <button>Buy Now</button>
    </a>
</div></a>
</fieldset>
{{-- 

<img src="{{$product->image}}" width="200px" height="150px">
    <h3>{{$product->title}}</h3>
    <p>Description: {{$product->description}}</p>
    <p>{{$product->price}}</p><br>
    <button>Buy Now</button>


--}}