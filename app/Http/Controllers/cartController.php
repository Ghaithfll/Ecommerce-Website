<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\requestHyperpayCheckout;
use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class cartController extends Controller
{
    public function index(){
        
        $cart = Cart::where('user_id', 1)->get();
       
        return view('cart',['cart' => $cart,'user' => User::findorFail(1)]);
    }
    public function submit_checkout(Request $request){
     
   
    try {
            
    $cart = Cart::where('user_id', 1)->get();
       
    //dd($request->all());
        // quantity_prod_Id , currency
        // display total (calculate each prod price*quantity)
        $total = 0;
        $product = "";
        //**************************************** */
        
        $order = session()->get('order');
    
       // dd(session()->get('order'));
        if ($order == null) {
                    
            
            $order = Order::create([
                'amount' => $total,// Total Price
                'user_id' => 1,  //               user id is hardcoded
                'currency' => 'SAR',
                'status' => 'pending'
            ]);
           
        //**************************************** */
       // dd('hnnn');
        foreach ($cart as $record ) {
        //    dd($record);
           $product = Product::findorFail(($record->product_id));// $product
          // dd($product,$record->product_id);
           $quant_field_name = 'quantity_'.$product->id;
           $quantity = $request->$quant_field_name;
           $total += $quantity*($product->price);
           //add the product to the pivot table;
           
           AddProductToPivot($order, $product,$quantity*($product->price),$quantity);
           
           
        }
        
      
        $order->amount = $total;
        $order->currency = $product->currency;
        $order->save();
        
        session()->put('order', $order);
            // todo: add the products to the pivot table
            }
        
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
        Log::error("checkout Api failed", ['error' => $err->getMessage()]);
            return back()->withErrors(['error' => 'Prepare The Checkout Failed!, try again']);
        }
        }
        // public function removeProduct(Product $product,Cart $cart){

        // dd($cart,$product);
        // // remove product from cart
        
        // // redirect back

        // }

    public function AddProduct(Product $product){
    // add product to cart
    $cart = Cart::where('user_id',1)->get();// get the cart of this user
    
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
        'user_id' => 1,
        'product_id' => $product->id,
    ]);
    // redirect back    
    
    return redirect()->back();
    }


    public function cart_submit(product $product)
    {
        try {
            // calculate total
            $total = 0;  // calculate toatl THEn call the hyperpay
                        // get the version of the OTHER branch
            $responseData  =   requestHyperpayCheckout($total); // this is copied from the hyperpay request()



            //session()->put('order' , $order);
            $order = Order::create([
                'amount' => $product->price,// Total Price
                'user_id' => 1,  //               user id is hardcoded
                'currency' => $product->currency,
                'status' => 'pending'
            ]);
            
            session()->put('order', $order);
          
            $responseData = json_decode($responseData);
            if ($responseData != null) {


                return redirect()->route('payment', [

                    'integrity' => $responseData->integrity, // these 2 are NOT sent by the url (payment/{order}) 
                    'checkoutId' => $responseData->id, // so u should request them from the other function (payment_get)
                ]);
            }
            throw new Exception("Null Response");
        } catch (Exception $err) {
            Log::error("checkout Api failed", ['error' => $err->getMessage()]);
            return back()->withErrors(['error' => 'Prepare The Checkout Failed!, try again']);
        }

        // dd($order);


    }
}



function requestHyperpayCheckout($total)
{

    $url = "https://eu-test.oppwa.com/v1/checkouts";

    $responseData = Http::asForm()->withHeaders([
        'Authorization' => "Bearer OGE4Mjk0MTc0ZDA1OTViYjAxNGQwNWQ4MjllNzAxZDF8bk49a3NvQ3ROZjJacW9nOWYla0o="
    ])->post($url, [
        'entityId' => '8a8294174d0595bb014d05d829cb01cd',
        'amount'   => number_format($total, 2),// total
        'currency' => 'EUR',
        'paymentType' => 'DB',
        'integrity' => true

    ]);
    if ($responseData->failed()) {
       // dd($responseData);
        $responseData->throw();
    }


    return $responseData;
}



function AddProductToPivot($order, $product,$total,$quantity)
{

    $order->products()->attach($product->id, [
        'quantity' => $quantity,
        'unit_price' => $product->price,
        'total' => $total,
    ]);
    //dd($newPivotRecord);

    }

     function DeleteOrderAllPivotRecords($order_id){
        DB::table('order_product_pivot')->where('order_id',$order_id)->delete();
    }  
