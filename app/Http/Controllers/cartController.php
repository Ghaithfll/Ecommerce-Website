<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\requestHyperpayCheckout;
use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class cartController extends Controller
{
    public function index(){
        // #no 1
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->get();
          
      //  $cart = [];
        return view('cart',['cart' => $cart,'user' => $user]);// #no 7
    }
    public function submit_checkout(Request $request){
     $user = Auth::user();
   
    try {
     // #no 2       
    $cart = Cart::where('user_id', $user->id)->get();
       
    //dd($request->all());
        // quantity_prod_Id , currency
        // display total (calculate each prod price*quantity)
        $total = 0;
      
        //**************************************** */
        
        $order = session()->get('order');
    
       // dd(session()->get('order'));
        if ($order == null) {
                    
            // #no 3
            $order = Order::create([
                'amount' => $total,// Total Price
                'user_id' => $user->id,  //               user id is hardcoded
                'currency' => 'SAR',
                'status' => 'pending'
            ]);
           session()->put('order', $order);
           
           }
            else{
                $order = Order::findorFail($order['id']);
            }
        
        /*   foreach ($cart as $record ) {
           //    dd($record);
           $product = Product::findorFail(($record->product_id));// $product
           // dd($product,$record->product_id);
           $quant_field_name = 'quantity_'.$product->id;
           $quantity = $request->$quant_field_name;
           $total += $quantity*($product->price);
           //add the product to the pivot table;
           

           // use array_sum or Arr::sum etc to calculate total
           
           AddProductToPivot($order, $product,$quantity*($product->price),$quantity);
           
        }   
        */
       
       $total= AddProductToPivot($order,$cart);
      
        $order->amount = $total;
       //              $order->currency = $product->currency;
        $order->save();
        session()->put('order', $order);
            
        
            
            $responseData  =   requestHyperpayCheckout($total); // this is copied from the hyperpay request()

   
            $responseData = json_decode($responseData);
            if ($responseData != null) {

              
            return redirect()->route('payment', [

                    'integrity' => $responseData->integrity, // these 2 are NOT sent by the url (payment/{order}) 
                    'checkoutId' => $responseData->id, // so u should request them from the other function (payment_get)
                ]);
            }
            dd($responseData,'before throwing exception (try: submit checkout)');
            throw new Exception("Null Response");
        } catch (Exception $err) {

        if ($order !=null) {
            
        
        DeleteOrderAllPivotRecords($order?->id);  
        Order::where('id',$order?->id)->delete();
        }
        session()->forget('order');
        // maybe we should delete the pivot records as well?
        Log::error("checkout Api failed", ['error' => $err->getMessage()]);
            return back()->withErrors(['error' => 'Prepare The Checkout Failed!, try again']);
        }
        }


        public function removeProduct(Product $product){
         // get the cart
         $user = Auth::user();
            // #no 4
                $cart = Cart::where('user_id', $user->id)->get();
                
                $model = $cart->firstWhere('product_id' , $product->id);
            // dd($model->product_id,$product->id);
            
            if ($model != null) {
                    $model->delete();
                }
                return redirect()->back();
                // remove product from cart
                
                // redirect back

                }

    
        
        public function AddProduct(Product $product){
    // add product to cart
    $user = Auth::user();
    // #no 5
    $cart = Cart::where('user_id',$user->id)->get();// get the cart of this user
    
    $isexist = false;
    foreach ($cart as $record) {
    if ($record->product_id == $product->id) { // product is not already in the cart
        $isexist = true;
        break;
    }    
    }
    if ($isexist) {
        return back();
    }
    
    cart::create([
        'user_id' => $user->id,// #no 6
        'product_id' => $product->id,
    ]);
    // redirect back    
    
    return redirect()->back();
    }


}



function requestHyperpayCheckout($total)
{

    $url = "https://eu-test.oppwa.com/v1/checkouts";
    
    $responseData = Http::asForm()->withHeaders([
        'Authorization' => "Bearer OGE4Mjk0MTc0ZDA1OTViYjAxNGQwNWQ4MjllNzAxZDF8bk49a3NvQ3ROZjJacW9nOWYla0o="
    ])->post($url, [
        'entityId' => '8a8294174d0595bb014d05d829cb01cd',
        'amount'   => number_format($total, 2,'.',''),// total
        'currency' => 'EUR',
        'paymentType' => 'DB',
        'integrity' => true

    ]);
   
    if ($responseData->failed()) {
    dd($responseData);    
    $responseData->throw();
    }


    return $responseData;
}



function AddProductToPivot($order, $carts)
{

    $pivotData = []; 
    //dd($carts);
    
   $total = $carts->reduce(function (int $totalCarry ,$item) use(&$pivotData){  // pass the array by refrence, or else it will be pass by val (we lose all the data)
 
    
   $product = Product::findorFail($item->product_id);
   $unit_price = $product->price;
   $quant_name = "quantity_". $product->id;
   $unit_quantity = Request($quant_name); 
   $totalCarry += $unit_price*$unit_quantity;

    $pivotData[$product->id] = [
        'quantity' => $unit_quantity,
        'unit_price' => $unit_price,
        'total' => $unit_price * $unit_quantity,
        ];
       // dd($pivotData);
        
       return $totalCarry;

   }, 0);

   // now we have all the data we need , each product_id with its data
//dd($pivotData);
   $order->products()->sync($pivotData);
   
   
   return $total;

//    // dd($order->products());
//     $order->products()->attach($product->id, [
//         'quantity' => $quantity,
//         'unit_price' => $product->price,
//         'total' => $total,
//     ]);
    
}

     function DeleteOrderAllPivotRecords($order_id){
        DB::table('order_product_pivot')->where('order_id',$order_id)->delete();
    }  



    function sumProducts($total,$unit_price,$quantity){
        $total += $unit_price*$quantity;
        return $total; 
    }




