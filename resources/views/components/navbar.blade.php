
{{-- 
<nav {{$attributes}}>
    <a href="{{route('home')}}">Home</a>
    <a href="{{route('create-product')}}">Create Product</a>
    <a href="{{route('cart')}}">Cart</a>
    <a href="{{route('orders')}}">Orders Page</a>
    
</nav> --}}

<div class="max-lg:collapse bg-base-200 mb-20 shadow-sm w-full rounded-md ">

    
    <div class="navbar-center hidden lg:flex justify-center ">
      <ul class="menu menu-horizontal ">
        <li>    <a href="{{route('home')}}">Home</a>
</li>
        <li>
        </li>
        <li>    <a href="{{route('create-product')}}">Create Product</a>
</li>
<li>    <a href="{{route('cart')}}">Cart</a>
</li>      
<li>    <a href="{{route('orders')}}">Orders Page</a>
</li>
</ul>
    
  </div>

</div>