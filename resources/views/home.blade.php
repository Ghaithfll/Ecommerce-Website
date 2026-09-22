<!DOCTYPE html>
<html lang="en">
<head>
    {{-- <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <meta charset="UTF-8"> --}}
       @vite('resources/css/app.css')
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
    <x-navbar />

    <div class="grid grid-cols-2 w-fit mx-auto gap-10 ">
    @foreach ($products as $product)
        
           <x-productui  :product='$product'/>
               
        
    @endforeach
    </div>
</body>
</html>