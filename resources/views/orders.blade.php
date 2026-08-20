<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders</title>
    <style>
        table,th,td{
            border:2px solid;
        }
    </style>


</head>
<body>
<x-navbar/>

    <h1>All Orders :</h1>
<table>
    @if (count($orders)!=0)
        
    

 <tr>
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
 <tr>
    <td>{{$order->id}}</td>
    <td>{{$order->user_id}}</td>
    <td>{{$order->amount}}</td>
    <td>{{$order->payment_id}}</td>
    <td>{{$order->status}}</td>
 </tr>


     @empty
        <h1>No orders currently</h1>
    @endforelse



</table>



</body>
</html>