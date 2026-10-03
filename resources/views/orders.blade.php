
<x-layouts.Layout>

    <main class="px-20 ">
    <h1 class="text-2xl font-bold ">All Orders :</h1>
<table class="border rounded-2xl mt-10 w-full overflow-hidden">
    @if (count($orders)!=0)
        
    

 <tr class="h-15 text-lg bg-cyan-500">
    <th>Order ID</th>
    <th>Customer_ID</th>
    <th>Total_Price</th>
    <th>Payment_ID</th>
    <th>Status</th>
 </tr>
 @endif
 {{-- @foreach ($collection as $item)
     
 @endforeach --}}
     @forelse ($orders as $order)
 <tr class="text-lg h-10 text-center odd:bg-cyan-300 even:bg-cyan-200">
    <td >{{$order->id}}</td>
    <td >{{$order->user_id}}</td>
    <td >{{$order->amount}}</td>
    <td >{{$order->payment_id}}</td>
    <td >{{$order->status}}</td>
 </tr>


     @empty
        <h1>No orders currently</h1>
    @endforelse



</table>


</main>
</x-layouts.Layout>
