
<x-layouts.Layout>


<main class="   w-full flex items-center justify-center">

<aside class="grid grid-cols-2 w-fit h-fit justify-center gap-5 items-center place-content-center " id="categories">
<h1 class="text-3xl  font-bold col-span-2 flex justify-center pb-10">Categories</h1>

    
        @foreach ($categs as $categ)
        <a href="{{route('category',['category'=> $categ ])}}">
            <div class="border rounded-xl h-50 w-50 justify-center items-center flex text-lg text-white font-bold bg-cyan-500 hover:bg-cyan-700">
                {{$categ->name}}</div></a>

        @endforeach
    </aside>
</main>
</x-layouts.Layout>