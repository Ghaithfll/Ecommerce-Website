
<x-layouts.Layout >

    <h1 >All Orders :</h1>

<table >
 <tr>
    <th>Order ID</th>
    <th>Customer_ID</th>
    <th>Product_ID</th>
    <th>Product_Name</th>
    <th>Product_Price</th>
    <th>Payment_ID</th>
    <th>Status</th>
 </tr>
 {{-- @foreach ($collection as $item)
     
 @endforeach --}}
     @forelse ($orders as $order)
 <tr>
    <td>{{$order->id}}</td>
    <td>{{$order->user_id}}</td>
    <td>{{$order->product_id}}</td>
    <td>{{$order->product->name}}</td> {{-- i need the product obj to get its name here!! --}}
    <td>{{$order->product->price}}</td>
    <td>{{$order->payment_id}}</td>
    <td>{{$order->status}}</td>
 </tr>


     @empty
        <p>No orders currently</p>
    @endforelse



</table>



</x-layouts.Layout>