@props(['product'])


<div>
  <?php 
    use App\Models\Product;
    $product1 = Product::findorFail($product);
    $product = $product1;
    ?>
    <aside class="w-full flex justify-end h-fit">
<form id='remove_product_{{$product->id}}' action="{{route('removeProduct',['product' => $product])}}" method="POST">
          @csrf
          @method('DELETE')
        <button type="submit" class="bg-red-500 hover:bg-red-700 rounded-2xl my-4 h-fit text-white font-bold w-fit px-4"  form="remove_product_{{$product->id}}">Remove From Cart {{$product->id}}</button>
        </form>
    </aside>
    @if ($product->image != null)
    <img src="{{asset('storage/'.$product->image)}}" width="150px" height="100px">
        
    @endif    
    
  <h2 class="font-bold h-15">{{$product->name}}</h2>
      
  
       
      
       {{-- <p class="h-20 line-clamp-1 overflow-hidden">Description: {{$product->description}}</p>
     --}}
       <p class="text-lg font-bold"> Unit price : $ {{$product->price}}</p><br>
    
      
      </div>

    