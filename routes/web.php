<?php

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


Route::get('/orders',function(){
    $orders = Order::all();
    return view('orders',['orders' => $orders]);
})->name('orders');