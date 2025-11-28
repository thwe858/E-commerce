<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;


Route::get('/test-email', function () {
    Mail::raw("This is a test email from Laravel.", function($message) {
        $message->to("thwethweoo858@gmail.com")->subject("Laravel SMTP Test");
    });

    return "Test email sent!";
});
Route::get('/',[App\Http\Controllers\FrontController::class,'shop'])->name('shop');
Route::get('/shop-item/{id}',[App\Http\Controllers\FrontController::class,'shopItem'])->name('shop-item');

Auth::routes();
Route::get('item-carts', [App\Http\Controllers\FrontController::class, 'carts'])->name('item-carts.carts');
Route::post('order-now', [App\Http\Controllers\FrontController::class, 'orderNow'])->name('order-now');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('item-categories/{cateogory_id}',[App\Http\Controllers\FrontController::class,'itemCategory'])->name('item.categories');
Route::group(['middleware'=>['auth','role:super admin|admin'],'prefix'=>'backend','as'=>'backend.'],function(){
    Route::get('/',[App\Http\Controllers\Admin\DashboardController::class,'index'])->name('dashboard');
    Route::resource('items',App\Http\Controllers\Admin\ItemController::class);
    Route::resource('categories',App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('payments',App\Http\Controllers\Admin\PaymentController::class);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->middleware('role:super admin');
    Route::get('orders',[App\Http\Controllers\Admin\OrderController::class,'orders'])->name('orders');
    Route::get('orderAccept',[App\Http\Controllers\Admin\OrderController::class,'orderAccept'])->name('orderAccept');
     Route::get('orderComplete',[App\Http\Controllers\Admin\OrderController::class,'orderComplete'])->name('orderComplete');
    Route::get('orders/{voucher}',[App\Http\Controllers\Admin\OrderController::class,'orderDetail'])->name('orders.detail');
    Route::put('orders/{voucher}',[App\Http\Controllers\Admin\OrderController::class,'status'])->name('orders.status');
});