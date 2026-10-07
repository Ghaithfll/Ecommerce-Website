
@props(['categ'])
 
<a {{$attributes}} >
    <div class="border rounded-xl h-52 w-52 justify-center items-center flex text-lg text-white font-bold bg-cyan-500 hover:bg-cyan-700">
        {{$categ->name}}
   
    </div>
</a> 


