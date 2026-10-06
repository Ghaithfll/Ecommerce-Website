<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\CategoryController;
use App\Models\Order;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

Route::get('/',[ProductController::class,'home'])->name('home');

Route::middleware('auth')->group(function(){

    Route::delete('cart/{product}',[cartController::class,'removeProduct'])->name('removeProduct');
    Route::get('/checkout/{product}',[ProductController::class,'checkout'])->name('checkout');// might need deletion

    Route::post('/checkout/{product}',[ProductController::class,'checkout_submit']);

    Route::get('/payment',[ProductController::class,'payment_get'])->name('payment');
    //    should be '/payment/{order}'
    Route::get('paymentResult',[ProductController::class,'payment_result'])->name('payment_result');

    Route::get('cart',[cartController::class,'index'])->name('cart');

    Route::post('cart',[cartController::class,'submit_checkout'])->name('cart_submit');

    //*************************** These Need Authorization */
    Route::get('/products/create',[ProductController::class,'create'])->name('create-product');
    Route::post('/products/create',[ProductController::class,'store']);
    Route::get('cart/{product}',[cartController::class,'AddProduct'])->name('add_product_to_cart');


    Route::get('/orders',function(){
        Gate::authorize('view_orders',Order::class);
        $orders = Order::all();
        return view('orders',['orders' => $orders]);
    })->name('orders');

    
    Route::get('Logout',[AuthController::class,'Logout'])->name('Logout');

    Route::get('categories/create',[CategoryController::class,'create'])->name('create_categ');
    Route::post('categories/create',[CategoryController::class,'store']);

    Route::get('categories/management',[CategoryController::class,'get_manage'])->name('management');

    Route::get('categories/management/{categ}/edit',[CategoryController::class,'edit'])->name('edit_categ');
    Route::patch('categories/management/{categ}/edit',[CategoryController::class,'update']);
    Route::delete('categories/management/{categ}/edit',[CategoryController::class,'delete']);
    
});

Route::get('/categories/{category}', [CategoryController::class,'show'])->name('category');
Route::get('/categories', [CategoryController::class,'index'])->name('categories');


Route::get('/products/{product}',[ProductController::class,'details'])->name('product-details');

//**************************** */
Route::middleware('guest')->group(function(){

    Route::get('Login',[AuthController::class,'Open_Login'])->name('login');
    Route::post('Login',[AuthController::class,'Login']);
    Route::get('Signup',[AuthController::class,'Open_Signup'])->name('Signup');
    Route::post('Signup',[AuthController::class,'Signup']);
});

//Route::get('test',[ProductController::class,'TestPivot'])->name('test');




//    Edit / Delete / Products
//    Edit / Delete / Categories 