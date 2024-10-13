<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\users\AddressesController;
use App\Http\Controllers\users\CartUserController;
use App\Http\Controllers\users\changeImageUserController;
use App\Http\Controllers\Users\ChatController;
use App\Http\Controllers\users\CheckoutUserController;
use App\Http\Controllers\users\contactusUserController;
use App\Http\Controllers\users\CouponsUserController;
use App\Http\Controllers\users\ItemUserController;
use App\Http\Controllers\users\OrdersUserController;
use App\Http\Controllers\users\settingsController;
use App\Http\Controllers\users\userAuthController;
use App\Http\Controllers\Users\UsersAuthController;
use App\Http\Controllers\users\WishListUserController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/'], function(){

    Route::group(['middleware'=> ['auth:web','usercheckauth']], function(){


Route::get('items',[ItemUserController::class,'index'])->name('user.items.index');

// Route::get('confirmed/{thank}',[ItemUserController::class,'thankyou'])->name('user.thankyou');



Route::get('Settings',[settingsController::class,'ChangePassword'])->name('user.changePassword');
Route::get('Settings',[settingsController::class,'changeUserImage'])->name('user.changeUserImage.index');
Route::get('contactus',[contactusUserController::class,'index'])->name('user.contactUs.index');


Route::get('wishlist/favourite/{item}',[WishListUserController::class, 'favourite'])->name('wishlist.favourite');
Route::resource('wishlist', WishListUserController::class)->only('index','destroy');

Route::get('orders',[OrdersUserController::class,'index'])->name('user.orders.index');
Route::get('orders/track',[OrdersUserController::class,'track_order'])->name('user.orders.order_track');

Route::get('orders/{order}',[OrdersUserController::class,'orderDetails'])->name('user.orderDetails.index');


Route::get('/invoice', [OrdersUserController::class, 'generateInvoice']);


Route::get('support', [ChatController::class, 'chatform'])->name('user.support');
Route::post('support/openticket', [ChatController::class,'openticket'])->name('user.support.openticket');
Route::post('support/sendMessage/{ticket}', [ChatController::class, 'sendMessage'])->name('user.support.sendMessage');

Route::get('Coupons',[CouponsUserController::class,'index'])->name('user.Coupons.index');
route::post('carts/applycoupon', [CartUserController::class, 'applycoupon'])->name('carts.applycoupon');
route::get('carts/disapplycoupon', [CartUserController::class, 'disapplycoupon'])->name('carts.disapplycoupon');

Route::get('cart',[CartUserController::class,'index'])->name('user.cart.index');
Route::get('cart/checkout',[CheckoutUserController::class,'index'])->name('user.checkout.index');
route::get('carts/details', [CheckoutUserController::class, 'cartsdetails'])->name('carts.details');

route::get('carts/checkout', [CheckoutUserController::class, 'checkoutform'])->name('carts.checkoutform');
route::post('carts/add', [CartUserController::class, 'add'])->name('carts.add');

route::get('carts/plus/{id}', [CartUserController::class, 'plus'])->name('carts.plus');

route::get('carts/minus/{id}', [CartUserController::class, 'minus'])->name('carts.minus');

route::get('carts/remove/{id}', [CartUserController::class, 'remove'])->name('carts.remove');


        //////User change image
        route::get('user/showProfileImage', [changeImageUserController::class, 'showProfileImage'])->name('user.showProfileImage');

        route::post('profileImage', [changeImageUserController::class, 'UserChangeImage'])->name('user.UserChangeImage');
        //user change password
Route::get('Password', [userAuthController::class , 'UserShowPassword'])->name('user.UserShowPassword');
    Route::post('password/change', [userAuthController::class , 'UserChangePassword'])->name('user.UserChangePassword');

    Route::resource('adddress', AddressesController::class)->only('store','destroy')->names([
        'store' => 'user.addresses.store',
        'destroy' => 'user.addresses.destroy'
       ]);

       route::post('orders/checkout', [OrdersUserController::class, 'checkout'])->name('user.orders.checkout');
       Route::post('orders/{order}/cancel',[OrdersUserController::class, 'cancel'])->name('user.orders.cancel');




});

Route::group(['middleware'=> ['guest:web']], function(){
Route::get('/', [userAuthController::class , 'showloginform'])->name('user.showloginform');
    Route::post('login', [userAuthController::class , 'login'])->name('user.login');
    Route::get('inactive', [contactusUserController::class, 'inactiveDesign'])->name('user.inactive');

});
    Route::post('logout', [userAuthController::class , 'logout'])->name('user.logout');
    Route::get('change-lang', [LanguageController::class, 'change'])->name('changelang');




});











