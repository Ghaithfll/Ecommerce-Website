@props(['product'])


{{-- <fieldset>
  <legend>{{$product}}</legend> --}}
<div>
  <?php 
    use App\Models\Product;
    $product1 = Product::findorFail($product);
    $product = $product1;
    ?>
    @if ($product->image != null)
    <img src="{{asset('storage/'.$product->image)}}" width="150px" height="100px">
        
    @endif    
    
  <h2>{{$product->name}}</h2>
      
       <p>Price: {{$product->price}}</p>
       
        {{-- Quantity : 
        <input type="number" value="1" name="quantity" min="1">
        <br> --}}
         <p>Description: {{$product->description}}</p>
        <p> Unit price : {{$product->price}}</p><br>
    

        {{-- <br><br>
        <form action="{{route('removeProduct',['product' => $product])}}">
          @csrf
          @method('DELETE')
        <button type="submit">Remove From Cart</button>
        </form> --}}
      </div>

    {{-- </fieldset> --}}