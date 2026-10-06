<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title ?? "E Commerce"}}</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <nav class="flex justify-center gap-x-8 items-center min-h-15 bg-cyan-500 fixed  min-w-screen  text-white font-bold">
    
        
    @auth
    <x-navbar href="{{route('Logout')}}">Logout<sub>change location
        </sub></x-navbar>
        
    @else
    <x-navbar href="{{route('login')}}">Login</x-navbar>
    
    @endauth
    
    <x-navbar href="{{route('categories')}}">Home</x-navbar>
   
    @can('create_product')
    <x-navbar href="{{route('create-product')}}">Create Product</x-navbar>
        
    @endcan
    <x-navbar href="{{route('cart')}}">Cart</x-navbar>
    
    @can('create_product')
    
    <x-navbar href="{{route('orders')}}">Orders Page</x-navbar>
    
    @endcan
    </nav>
    <div class="pt-35">
    {{$slot}}
    </div>
</body>
</html>