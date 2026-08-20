<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
     
       <style>
        .done{
            color:green;
            font-weight: 600;
        }
       </style>


</head>
<body>
    <x-navbar/>

    <ul>
        <li>Display all available products.  </li> {{-- <p class="done">Done</p>--}} 
        <li>Each product should show:</li>          
        <ol>
            <li>Image  </li>                    
            <li>Name  </li>                     
            <li>Description  </li>              
        <li>Price  </li>                        
        </ol>
        <li><b>BUY NOW</b> Button</li>          
        
    </ul>
    <form action="{{route('test')}}">
    <button type="submit">Test Pivot</button>
    </form>

    <ul>
    @foreach ($products as $product)
        <li>
           {{-- <x-productui  
           title="{{$product->name}}"
           image="{{$product->image}}"
           description="{{$product->description}}"
           price="{{$product->price}}"
           /> --}}
            
           <x-productui :product='$product'/>
           
                
        </li>
    @endforeach
    </ul>
</body>
</html>