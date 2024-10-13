<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function index(){
        $user = auth()->user()->with('coupons')->first();
        $coupons = $user->coupons;
    
        foreach ($coupons as $coupon) {
            $coupon->is_expired = now()->gt($coupon->valid_to);
        }
    
        return view('users.coupons.coupons', compact('coupons'));
    }
   
    //
}
