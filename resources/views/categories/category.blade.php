
<x-layouts.Layout >
  <h1 class="mx-20 text-3xl font-bold">{{$category->name}}</h1>

  @if (count($products) == 0)
      <main class="w-full h-screen flex content-end justify-center items-center ">
        <div >
        <h1 class="text-2xl font-bold">No Products Added Yet</h1>    
       
        @can('create_product')
            <a href= "{{route('create-product')}}">
                <button class="w-full bg-cyan-500 hover:bg-cyan-800 rounded font-bold text-white min-h-13 my-5">
                    Create Product</button>    
            </a>
        @else
            <a href= "{{route('categories')}}">
                <button class="w-full bg-cyan-500 hover:bg-cyan-800 rounded font-bold text-white min-h-13 my-5">
                    Go Back </button>    
            </a>    
        @endcan
        
    </div>
</main>  

@else
    <main class="">
        <div class="flex place-content-center w-full">
    <aside class="grid grid-cols-2 gap-9  w-fit h-fit ">
    @foreach ($products as $product)
        
           
            
           <x-productui  :product='$product'/>
           
                
        
    @endforeach
    </aside>
        </div>
    </main>
@endif
</x-layouts.Layout>