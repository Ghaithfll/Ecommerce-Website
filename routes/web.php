<?php

use App\Http\Controllers\cartController;
use App\Models\Order;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/',[ProductController::class,'home'])->name('home');


Route::get('/products/create',[ProductController::class,'create'])->name('create-product');
Route::post('/products/create',[ProductController::class,'store']);

Route::get('/products/{product}',[ProductController::class,'details'])->name('product-details');

Route::get('/checkout/{product}',[ProductController::class,'checkout'])->name('checkout');

Route::post('/checkout/{product}',[ProductController::class,'checkout_submit']);

Route::get('/payment',[ProductController::class,'payment_get'])->name('payment');
//    should be '/payment/{order}'
Route::get('paymentResult',[ProductController::class,'payment_result'])->name('payment_result');

Route::get('cart',[cartController::class,'index'])->name('cart');

Route::post('cart',[cartController::class,'submit_checkout'])->name('cart_submit');

Route::delete('cart/{product}',[cartController::class,'removeProduct'])->name('removeProduct');

Route::get('cart/{product}',[cartController::class,'AddProduct'])->name('add_product_to_cart');

Route::get('/orders',function(){
    $orders = Order::all();
   // $orders = [];
    return view('orders',['orders' => $orders]);
})->name('orders');



Route::get('test',[ProductController::class,'TestPivot'])->name('test');

