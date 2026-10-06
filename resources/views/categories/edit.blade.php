
<x-layouts.empty_layout>
    
    <main class=" h-screen w-full flex justify-center items-center">
    <div>
        <h1 class=" text-3xl font-bold text-center">Manage Category</h1>

        <div class="grid grid-cols-1 w-fit content-between h-100 rounded-2xl border-b-cyan-600 border-4 p-5">
        
    <form action="" method="POST" id="edit">
        @csrf @method('PATCH')
        <div class="pt-30"> {{-- Drop this class when u add the <img> --}}
        <label for="name">Category name </label><br>
        <input class="rounded-xl text-xl border-cyan-500 border-3 px-2" type="text" name="name" id="name" value="{{$categ->name}}">
        {{-- Maybe an img later --}}
        <x-formError field='name' />
        </div>
    </form>
    <div> 
        <button form="edit" class="w-full bg-cyan-500 hover:bg-cyan-800 rounded font-bold text-white min-h-13 " type="submit">Save</button>
        <button form="delete" class="w-full my-3 bg-red-500 hover:bg-red-800 rounded font-bold text-white min-h-13 " type="submit">Delete</button>    
    </div>
</div>
    </div>
    </main>
    <form action="" method="POST" id="delete">
        @csrf @method('DELETE')
    </form>
</x-layouts.empty_layout>