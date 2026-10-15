<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categories </title>
</head>
<body>
    
<x-layouts.Layout>

<main class="   w-full flex items-center justify-center">

<aside class="grid grid-cols-2 w-fit h-fit justify-center gap-5 items-center place-content-center " >
<h1 class="text-3xl  font-bold col-span-2 flex justify-center pb-10">Categories Management</h1>

 
    <a href="{{route('create_categ')}}" >
    <div class="border rounded-xl h-52 w-52 justify-center items-center flex text-lg text-white font-bold bg-amber-500 hover:bg-amber-700">
        New Category
   
    </div>
    </a> 

    @forelse ($categs as $categ)
    <div>
        <x-category href="{{route('edit_categ',['categ'=> $categ ])}}" :categ='$categ'/>  {{-- provide the link urself --}}
        
    </div>
        
    @empty
        <h1>No Categories Available</h1>

        @can('create_category')
        <button>Create Category</button>    
        
        @endcan
        
    @endforelse 
 
</aside>
</main>
</x-layouts.Layout>
</body>
</html>