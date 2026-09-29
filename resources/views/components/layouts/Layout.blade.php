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
    <x-navbar href="{{route('home')}}">Home</x-navbar>
    <x-navbar href="{{route('create-product')}}">Create Product</x-navbar>
    <x-navbar href="{{route('cart')}}">Cart</x-navbar>
    <x-navbar href="{{route('orders')}}">Orders Page</x-navbar>
    </nav>
    {{$slot}}
    
</body>
</html>