<?php

use App\Http\Controllers\Admins\AdminsAuthController;
use App\Http\Controllers\Admins\contactUsController;
use App\Http\Controllers\Admins\DashboardController;
use App\Http\Controllers\Admins\ProductController;
use App\Http\Controllers\Admins\ProductTaxController;
use App\Http\Controllers\Admins\ProductTypesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard'], function(){

     Route::group(['middleware'=> ['auth:admin', 'admincheckstatus']], function(){
 

Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard.index');

Route::resource('items' , ProductController::class)->names([
     'index' => 'admin.items.index',
     'create' => 'admin.items.create',
     'edit' => 'admin.items.edit',
     'update' => 'admin.items.update',
     'store' => 'admin.items.store',
     'destroy' => 'admin.items.destroy',
]);

Route::resource('itemtypes' , ProductTypesController::class)->names([
     'index' => 'admin.itemtypes.index',
     'create' => 'admin.itemtypes.create',
     'edit' => 'admin.itemtypes.edit',
     'update' => 'admin.itemtypes.update',
     'store' => 'admin.itemtypes.store',
     'destroy' => 'admin.itemtypes.destroy',
]);

Route::resource('itemtaxes' , ProductTaxController::class)->names([
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

////contact us settings 
Route::put('ContactUs/update', [contactUsController::class, 'update'])->name('ContactUs.update');
Route::get('ContactUs', [contactUsController::class, 'index'])->name('ContactUs.index');

Route::get('admin/inactive', [UserController::class, 'inactive'])->name('admin.inactive');



});

Route::get('login', [AdminsAuthController::class, 'showloginform'])->name('admin.showloginform');
Route::post('login', [AdminsAuthController::class, 'login'])->name('admin.login');
Route::post('logout', [AdminsAuthController::class, 'logout'])->name('admin.logout');



});
