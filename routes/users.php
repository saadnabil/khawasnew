<?php

use App\Http\Controllers\users\CartUserController;
use App\Http\Controllers\users\CheckoutUserController;
use App\Http\Controllers\users\contactusUserController;
use App\Http\Controllers\users\CouponsUserController;
use App\Http\Controllers\users\OrdersUserController;
use App\Http\Controllers\users\ProductUserController;
use App\Http\Controllers\users\settingsController;
use App\Http\Controllers\users\userAuthController;
use App\Http\Controllers\users\WishListUserController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'user'], function(){

    Route::group(['middleware'=> ['auth:web','usercheckauth']], function(){


Route::get('products',[ProductUserController::class,'index'])->name('user.products.index');

Route::get('Settings',[settingsController::class,'ChangePassword'])->name('user.changePassword');
Route::get('Settings',[settingsController::class,'changeUserImage'])->name('user.changeUserImage.index');
Route::get('contactus',[contactusUserController::class,'index'])->name('user.contactUs.index');

Route::get('wishlist',[WishListUserController::class,'index'])->name('user.wishlist.index');

Route::get('orders',[OrdersUserController::class,'index'])->name('user.orders.index');
Route::get('orders/view',[OrdersUserController::class,'orderDetails'])->name('user.orderDetails.index');

Route::get('Coupons',[CouponsUserController::class,'index'])->name('user.Coupons.index');

Route::get('cart',[CartUserController::class,'index'])->name('user.cart.index');
Route::get('cart/checkout',[CheckoutUserController::class,'index'])->name('user.checkout.index');

// Route::get('account/deactivated', [UsersAuthController::class , 'deactivatedAccount'])->name('user.deacivatedAccount');


});


Route::get('login', [userAuthController::class , 'showloginform'])->name('user.showloginform');
    Route::post('login', [userAuthController::class , 'login'])->name('user.login');
    Route::post('logout', [userAuthController::class , 'logout'])->name('user.logout');



});











