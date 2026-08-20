<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\Log;

class cartController extends Controller
{
    public function index(){
        
        $cart = Cart::where('user_id', 1)->get();
       
        return view('cart',['cart' => $cart,'user' => User::findorFail(1)]);
    }
    public function submit_checkout(Request $request){
        
    dd($request->all());
        // display total (calculate each prod price*quantity)
        // display the checkout and the Card form

        
    }

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
            $responseData  =   requestHyperpayCheckout($product); // this is copied from the hyperpay request()



            //session()->put('order' , $order);
            $order = Order::create([
                'amount' => $product->price,// Total Price
                'user_id' => 1,  //               user id is hardcoded
                'product_id' => $product->id,
                'currency' => $product->currency,
                'status' => 'pending'
            ]);
            session()->put('order', $order);
             /* [
                'amount' => $product->price,
                'user_id' => 1,
                'product_id' => $product->id,
                'currency' => $product->currency,
                'status' => 'pending',
            ]*/ 
            //dd($order);


            
            //dd($order);
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
