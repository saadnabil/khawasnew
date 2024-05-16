<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutUserController extends Controller
{

    public function index(){
        return view('users.cart.checkoutCart');
    }
    //
}
