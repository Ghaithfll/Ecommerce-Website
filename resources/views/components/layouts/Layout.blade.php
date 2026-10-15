<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title ?? "E Commerce"}}</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    @vite(['resources/css/app.css'])
</head>
@inject('Categ', 'App\Models\Category')
{{-- give me an instance of the model Category,
 and name this instance 'Categ' so i can use it in view(blade or even use it in php code within the view) --}}
@php
    $categories = $Categ::limit(5)->get();
    // get only the first five categs to load to the navbar 
@endphp

<body class="flex flex-col">
    <div id="navbar" class="fixed ">
        <div id="upper_navbar" class="h-27 bg-white flex">
            
          <img src="{{asset('images/ecommerce_logo.png')}}" alt="Ecommerce" class=" pl-5">
          <div class="flex items-center justify-around h-full w-full ">
            <form method="GET" action="" class="w-1/2">
                {{-- <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" 
                     d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                </svg> --}}
                <input type="text" name="search" placeholder="Search" 
                class="w-full px-3 bg-cyan-200 rounded-2xl h-10">
            </form>

            @auth
              {{-- <a  href="{{route('login')}}"> --}}
            <img src="{{asset('images/user.svg')}}" alt="profile" class="w-13 h-13" >
        
            {{-- </a> --}}
            @else
            <a  href="{{route('login')}}">
            <img src="{{asset('images/user.svg')}}" alt="login" class="w-13 h-13">
        
            </a>
            @endauth
            

            <a href="{{route('cart')}}">
            <img src="{{asset('images/cart.svg')}}" alt="cart" class="w-13 h-13">
        
            </a>
            <a href="{{route('orders')}}">
            <img src="{{asset('images/orders.svg')}}" alt="orders" class="w-13 h-13">
        
            </a>

          </div>

        </div>
  
    <nav id="lower_navbar" class="flex justify-center gap-x-8 items-center min-h-15 bg-gradient-to-b from-cyan-500 to-cyan-700   min-w-screen  text-white font-bold">
    
          
      @auth
        <x-navbar href="{{route('Logout')}}">Logout<sub>change location
          </sub></x-navbar>
          
      @else
        <x-navbar href="{{route('login')}}">Login</x-navbar>
      
      @endauth
      
        <x-navbar href="{{route('categories')}}">All Categories</x-navbar>
    
      @can('create_product')
        <x-navbar href="{{route('create-product')}}">Create Product</x-navbar>
          
      @endcan
      @foreach ($categories as $categ)
        
      <x-navbar href="{{route('category',['category'=>$categ])}}">{{$categ->name ?? 'category'}}</x-navbar>
      @endforeach
      
      {{-- @can('create_product')
      
        <x-navbar href="{{route('orders')}}">Orders Page</x-navbar>
      
      @endcan --}}
    </nav>
    </div>


    <div class="pt-50  min-h-screen">
    {{$slot}}
    </div>


    <footer class=" pt-10">
   <aside class="flex items-center px-7 text-white justify-between bg-cyan-700 h-30 w-full mt-10 ">
    <div class="justify-start">
    2026	&#169;&#174; Made with perfection	&#8482;
  </div>
  
  <p class="justify-center">All Rights Reserved</p>
  
  <address class="flex-col ">
    <span>
      Contact Me:
    </span>
      <div class="flex gap-x-5">
        <a href="https://github.com/Ghaithfll" target="/blank">
        <img src="{{asset('images/github.svg')}}" alt="github" class="w-13 h-13">
        </a>      
        <a href="https://www.linkedin.com/in/gaith-alfilali-760191349" target="/blank">
        <img src="{{asset('images/linkedin.svg')}}" alt="linkedin" class="w-13 h-13">
        </a>      
        
        
        <a href="mailto:gaithalfilali@gmail.com"  >
        <img src="{{asset('images/email.svg')}}" alt="email" class="w-13 h-13">  
        </a>
      </div>
  </address>
   </aside>
</footer>

</body>
</html>