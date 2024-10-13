<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\CouponUser;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\Coupons;

class addCouponsToUserController extends Controller
{
    //
    public function index()
    {
        
        $addcoupons = CouponUser::with('user', 'coupon')->get();
        $coupons = Coupon::with('user')->get();
        return view('users.coupons.coupons', compact('addcoupons', 'coupons'));
    }
   

    public function create()
    {
        $coupon = new CouponUser();
        $action = route('admin.coupons.store');
        return view('users.coupons.coupons',compact('coupon','action'));
    }
}
