
@props(['product'])
{{-- <fieldset {{$attributes}}>
    
    <a href="{{route('product-details',$product->id)}}">
    <legend>{{$product->name}}</legend>
<div >
    @if ($product->image != null)
    <img src="{{asset('storage/'.$product->image)}}" width="150px" height="100px">
        
    @endif
    <h3>{{$product->name}}</h3>
    <p>Description: {{$product->description}}</p>
    <p>{{$product->price}}</p><br>
    
    <a href="{{route('add_product_to_cart',['product' => $product])}}">
    <button class="btn btn-active">Add to Cart</button>
    </a>
</div></a>
</fieldset> --}}

<div class="card  border border-primary w-96 h-90 rounded  shadow-sm"> {{--bg-gray-800 --}}
  <figure>
     @if ($product->image != null)
    <img 
    height="100px"
    width="150px"
      src="{{asset('storage/'.$product->image)}}"
      alt="Product" />
     @endif

  </figure>
  <div class="card-body">
    <h2 class="card-title">{{$product->name}}</h2>
    <p>{{$product->description}}</p><br>
    <p >${{$product->price}} USD</p>
    <div class="card-actions justify-end">
            <a href="{{route('add_product_to_cart',['product' => $product])}}">

      <button class="btn btn-primary" >Add To Cart</button>
            </a>
    </div>
  </div>
</div>