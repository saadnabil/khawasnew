<?php

use App\Http\Controllers\Admins\AdminsAuthController;
use App\Http\Controllers\Admins\AdminsController;
use App\Http\Controllers\Admins\ChatController;
use App\Http\Controllers\Admins\contactUsController;
use App\Http\Controllers\Admins\CouponsController;
use App\Http\Controllers\Admins\DashboardController;
use App\Http\Controllers\Admins\ItemController;
use App\Http\Controllers\Admins\ItemTaxController;
use App\Http\Controllers\Admins\ItemTypesController;
use App\Http\Controllers\Admins\OrderController;
use App\Http\Controllers\Admins\OrdersController;
use App\Http\Controllers\Admins\RoleController;
use App\Http\Controllers\Admins\RolesController;
use App\Http\Controllers\Admins\TicketController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\users\addCouponsToUserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard'], function(){

     Route::group(['middleware'=> ['auth:admin', 'admincheckstatus','check.license']], function(){

Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard.index');



 Route::get('/licenses', [LicenseController::class, 'index'])->name('licenses.index');
 Route::get('/licenses/create', [LicenseController::class, 'create'])->name('licenses.create');
 Route::post('/licenses', [LicenseController::class, 'store'])->name('licenses.store');
 Route::get('/licenses/edit/{id}', [LicenseController::class, 'edit'])->name('licenses.edit');
 Route::put('/licenses/update/{id}', [LicenseController::class, 'update'])->name('licenses.update'); 
 Route::delete('/licenses/destroy/{id}', [LicenseController::class, 'destroy'])->name('licenses.destroy');
 Route::resource('media', MediaController::class);
 

 Route::get('item/duplicate/{id}' , [ItemController::class , 'ShowDuplicate'])->name('admin.showDupliacte');
 Route::put('item/create/duplicate' , [ItemController::class , 'DuplicateItem'])->name('admin.duplicateItem');


Route::post('items/upload-excel',  [ItemController::class, 'import'])->name('admins.itemsexcelimport');

Route::get('items/export', [ItemController::class, 'export'])->name('admin.items.export');
Route::post('item-types', [ItemController::class, 'CreateItemType'])->name('admin.items.CreateItemType');


Route::get('items/export-admin', [AdminsController::class, 'exportAdmins'])->name('admin.exportAdmins');
Route::get('items/export-user', [UserController::class, 'exportUsers'])->name('users.exportUsers');

// Route::patch('/admin/items/recover/{id}', [ItemController::class, 'recover'])->name('items.recover');

Route::patch('items/{id}/recover', [ItemController::class, 'recover'])->name('item.recover');


Route::get('items/view/{details}', [ItemController::class, 'viewItem'])->name('admin.items.viewItem');

///for notification order
Route::get('/pending-orders', [OrderController::class, 'getPendingOrders'])->name('admin.pending-orders');
////

Route::resource('items' , ItemController::class)->names([
     'index' => 'admin.items.index',
     'create' => 'admin.items.create',
     'edit' => 'admin.items.edit',
     'update' => 'admin.items.update',
     'store' => 'admin.items.store',
     'destroy' => 'admin.items.destroy',
]);

Route::get('support/{ticket}', [ChatController::class, 'chatform'])->name('dashboard.support');
Route::post('support/sendMessage/{ticket}', [ChatController::class, 'sendMessage'])->name('dashboard.support.sendMessage');

route::get('tickets/me',[TicketController::class, 'mytickets'])->name('tickets.me');
route::get('tickets/{ticket}/close',[TicketController::class, 'close'])->name('tickets.close');
route::resource('tickets', TicketController::class)->only('index','edit','update');




Route::resource('itemtypes' , ItemTypesController::class)->names([
     'index' => 'admin.itemtypes.index',
     'create' => 'admin.itemtypes.create',
     'edit' => 'admin.itemtypes.edit',
     'update' => 'admin.itemtypes.update',
     'store' => 'admin.itemtypes.store',
     'destroy' => 'admin.itemtypes.destroy',
]);

Route::resource('itemtaxes' , ItemTaxController::class)->names([
     'index' => 'admin.itemtaxes.index',
     'create' => 'admin.itemtaxes.create',
     'edit' => 'admin.itemtaxes.edit',
     'update' => 'admin.itemtaxes.update',
     'store' => 'admin.itemtaxes.store',
     'destroy' => 'admin.itemtaxes.destroy',
]);


Route::resource('users' , UserController::class)->names([
     'index' => 'admin.users.index',
     'create' => 'admin.users.create',
     'edit' => 'admin.users.edit',
     'update' => 'admin.users.update',
     'store' => 'admin.users.store',
     'destroy' => 'admin.users.destroy',
]);

Route::resource('coupons', CouponsController::class)->except('show')->names([
     'index' => 'admin.coupons.index',
     'create' => 'admin.coupons.create',
     'store' => 'admin.coupons.store',
     'edit' => 'admin.coupons.edit',
     'update' => 'admin.coupons.update',
     'destroy' => 'admin.coupons.destroy',
]);


Route::resource('coupons/user', addCouponsToUserController::class)->except('show')->names([
     'index' => 'admin.addcoupons.index',
     'create' => 'admin.addcoupons.create',
     'store' => 'admin.addcoupons.store',
     'edit' => 'admin.addcoupons.edit',
     'update' => 'admin.addcoupons.update',
     'destroy' => 'admin.addcoupons.destroy',
]);

         Route::put('/orders/{order}/update-address', [OrdersController::class, 'updateAddress'])->name('orders.updateAddress');
         Route::put('/orders/{order}/update-discount', [OrdersController::class, 'updateDiscount'])->name('orders.updateDiscount');

Route::post('orders/sendinvoice', [OrdersController::class, 'sendInvoice'])->name('admin.orders.sendinvoice');
Route::post('orders/update/status', [OrdersController::class, 'updateStatus'])->name('admin.orders.updatestatus');
Route::get('orders/track-order/details/{order}', [OrdersController::class, 'trackorderdetails'])->name('admin.orders.trackorderdetails');
Route::post('orders/sendinvoice', [OrdersController::class, 'sendInvoice'])->name('admin.orders.sendinvoice');
Route::delete('orders/delete/{order}', [OrdersController::class, 'deleteOrder'])->name('admin.orders.deleteOrder');



Route::resource('orders', OrdersController::class)->only('index','show','edit')->names([
    'index' => 'admin.orders.index',
    'show' => 'admin.orders.show',
    'edit' => 'admin.orders.edit',
]);

////contact us settings
Route::put('ContactUs/update', [contactUsController::class, 'update'])->name('ContactUs.update');
Route::get('ContactUs', [contactUsController::class, 'index'])->name('ContactUs.index');


Route::resource('admins', AdminsController::class)->except('show');

Route::resource('roles', RoleController::class);







});


Route::get('forgot', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');


Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');



Route::get('/offline', function () {
     return view('offline');
 });
 

// Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot.password.form');
// Route::post('/admin/forgot-password', [ForgotPasswordController::class, 'adminForgotPassword'])->name('admin.forgot.password');
// Route::post('/user/forgot-password', [ForgotPasswordController::class, 'userForgotPassword'])->name('user.forgot.password');

// Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('password.reset.form');
// Route::post('/admin/reset-password', [ResetPasswordController::class, 'adminResetPassword'])->name('admin.reset.password');
// Route::post('/user/reset-password', [ResetPasswordController::class, 'userResetPassword'])->name('user.reset.password');


Route::post('logout', [AdminsAuthController::class, 'logout'])->name('admin.logout');
Route::get('change-lang', [LanguageController::class, 'change'])->name('changelang');



Route::get('/license-expired', function () {
     return '<h1 style="text-align:center">Your license has expired. Please contact the manager</h1>.';
 })->name('license.expired');



Route::group(['middleware'=> ['guest:admin']], function(){
Route::get('login', [AdminsAuthController::class, 'showloginform'])->name('admin.showloginform');
Route::post('login', [AdminsAuthController::class, 'login'])->name('admin.login');
Route::get('inactive', [contactUsController::class, 'inactiveDesign'])->name('admin.inactive');

});





});
