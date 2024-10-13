<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\CouponUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponsUserController extends Controller
{


    public function index() {
        $user = auth()->user()->with('coupons')->first();
        $coupons = $user->coupons;
    
        foreach ($coupons as $coupon) {
            if ($coupon->valid_from && $coupon->valid_to) {
                $valid_from = Carbon::parse($coupon->valid_from);
                $valid_to = Carbon::parse($coupon->valid_to);
                $current_date = Carbon::now();
    
                $coupon->is_expired = $current_date->gt($valid_to);
                $coupon->remaining_days = $valid_to->diffInDays($current_date, false);
            } else {
                $coupon->is_expired = true; // اعتبر الكوبونات بدون تواريخ صالحة على أنها منتهية
                $coupon->remaining_days = 0;
            }
        }
    
        return view('users.coupons.coupons', compact('coupons'));
    }
    
    
    
}
