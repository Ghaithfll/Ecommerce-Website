@props(['product'])


{{-- <fieldset>
  <legend>{{$product}}</legend> --}}
<div {{$attributes}}>
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
    

        <br><br>
        <form id='remove_product_{{$product->id}}' action="{{route('removeProduct',['product' => $product])}}" method="POST">
          @csrf
          @method('DELETE')
        <button type="submit" {{$slot}} form="remove_product_{{$product->id}}">Remove From Cart {{$product->id}}</button>
        </form>
      </div>

    {{-- </fieldset> --}}