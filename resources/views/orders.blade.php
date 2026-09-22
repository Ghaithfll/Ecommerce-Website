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

  @vite('resources/css/app.css')
</head>
<body>
<x-navbar/>

    <h1 class="text-3xl font-bold mx-10 mb-30">Orders History:</h1>

@if (count($orders)!=0)
        
    



<div class="overflow-x-auto m-10">
  <table class="table">
    <!-- head -->
    <thead>
      <tr>
    <th>Order ID</th>
    <th>Customer_ID</th>
    <th>Total_Price</th>
    <th>Payment_ID</th>
    <th>Status</th>
 </tr>
    </thead>
    <tbody>
      <!-- row 1 -->
      
          @forelse ($orders as $order)
 <tr class="bg-base-200">
    <td>{{$order->id}}</td>
    <td>{{$order->user_id}}</td>
    <td>{{$order->amount}}</td>
    <td>{{$order->payment_id}}</td>
    <td>{{$order->status}}</td>
 </tr>


     @empty
        <h1>No orders currently</h1>
    @endforelse
      
    </tbody>
  </table>
</div>
 
     
 @else
  <div class=" w-screen flex justify-center ">
  <h1 class="text-3xl font-bold"> No Orders Yet </h1>    
  </div>
  @endif

</body>
</html>