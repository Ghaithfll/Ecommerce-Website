
<x-layouts.Layout>


<main class="   w-full flex items-center justify-center">

<aside class="grid grid-cols-2 w-fit h-fit justify-center gap-5 items-center place-content-center " id="categories">
<h1 class="text-3xl  font-bold col-span-2 flex justify-center pb-10">Categories</h1>

 
    
        @foreach ($categs as $categ)
          
     <x-category  :categ='$categ'/> 
   
 
        @endforeach
    </aside>
</main>
</x-layouts.Layout>