<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersUserController extends Controller
{
    public function index(){
        return view('users.orders.order_list');
    }

    public function orderDetails(){
        return view('users.orders.order_view');
    }
    //
}
