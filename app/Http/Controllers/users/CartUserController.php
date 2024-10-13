<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\AddCartRequest;
use App\Http\Requests\Users\applyCouponsUserRequsest;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;



class CartUserController extends Controller
{
    //
    public function index(){
        return view('users.cart.cartDetails');
    }

    public function add(AddCartRequest $request)
    {
        $data = $request->validated();

        $item = Item::find($data['item_id']);

        // Check if item exists
        if (!$item) {
            return response()->json(['error' => __('translation.Item_not_found')], 404);
        }

        // Check if the requested quantity exceeds available stock
        if ($data['quantity'] > $item->quantity) {
            return response()->json(['error' => __('translation.Quantity_requested_exceeds_available_stock')], 422);
        }

        // Check if the requested quantity respects the min and max constraints
        if ($item->min > 0 && $data['quantity'] < $item->min) {
            return response()->json(['error' => __('translation.The_quantity_must_be_at_least') .' '. $item->min], 422);
        }

        // Check if the item is already in the cart
        $ItemInCart = Cart::where([
            'user_id' => auth()->user()->id,
            'item_id' => $data['item_id'],
        ])->first();

        $newQuantity = $data['quantity'];
        if ($ItemInCart) {
            $newQuantity += $ItemInCart->quantity;
        }

        // Check if the new quantity exceeds the available stock
        if ($newQuantity > $item->quantity) {
            return response()->json(['error' => __('translation.Quantity_requested_exceeds_available_stock')], 422);
        }

        // Check if the new quantity respects the max constraint
        if ($item->max > 0 && $newQuantity > $item->max) {
            $maxOrderable = $item->max - ($ItemInCart ? $ItemInCart->quantity : 0);
            return response()->json(['error' => __('translation.You_can_only_order') . $maxOrderable . __('more of this item')], 422);
        }

        if (!$ItemInCart) {
            Cart::create([
                'user_id' => auth()->user()->id,
                'item_id' => $data['item_id'],
                'quantity' => $data['quantity'],
            ]);
        } else {
            $ItemInCart->update([
                'quantity' => $newQuantity,
            ]);
        }

        return view('layout.usercart');
    }





    public function plus($id){
        $route = request('route');
        /**get item */

        $cart = Cart::where([
            'user_id' => auth()->user()->id,
            'id' => $id,
        ])->firstorfail();

        $item = Item::find($cart->item_id);

        /**check item quantity */
        if($cart->quantity + 1 > $item->quantity){
            return response()->json(['error' => __('translation.Quantity requested exceeds available stock.')], 422);
        }

        $cart->update([
            'quantity' => $cart->quantity + 1,
        ]);
        if($route == 'cartsidebar'){
            return [
                'route' => $route,
                'view' => view('layout.usercart')->render()
            ];
        }elseif($route=='cartpagedetails'){
            return [
                'route' => $route,
                'view' => view('users.cart.cartDetails')->render()
            ];
        }
    }



    public function minus($id){
        $route = request('route');
        $cart = Cart::where([
            'user_id' => auth()->user()->id,
            'id' => $id,
        ])->firstorfail();
        if($cart->quantity == 1){ //must delete becuase element will be negative
            $cart->delete();
        }else{
            $cart->update([
                'quantity' => $cart->quantity - 1,
            ]);
        }
        if($route == 'cartsidebar'){
            return [
                'route' => $route,
                'view' => view('layout.usercart')->render()
            ];
        }elseif($route=='cartpagedetails'){
            return [
                'route' => $route,
                'view' => view('users.cart.cartDetails')->render()
            ];
        }
    }

    public function remove($id){
        $route = request('route');
        Cart::where([
            'user_id' => auth()->user()->id,
            'id' => $id,
        ])->delete();

        if($route == 'cartsidebar'){
            return [
                'route' => $route,
                'view' => view('layout.usercart')->render()
            ];
        }elseif($route=='cartpagedetails'){
            return [
                'route' => $route,
                'view' => view('users.cart.cartDetails')->render()
            ];
        }
    }


    public function applyCoupon(applyCouponsUserRequsest $request) {
        $data = $request->validated();

        $user = auth()->user()->load('coupons.couponusers');
        $currentDateTime = Carbon::now();

        $coupon = $user->coupons()
                        ->where('code', $data['code'])
                        ->where(function ($q) use ($currentDateTime) {
                            $q->where('valid_from', '<=', $currentDateTime)
                              ->where('valid_to', '>=', $currentDateTime);
                        })
                        ->whereHas('couponusers', function($query) {
                            $query->where('is_used', 0)
                                  ->where('user_id', auth()->user()->id);
                        })
                        ->first();

        if (!$coupon) {
            return response()->json([
                'message' => __('translation.Invalid Coupon'),
                'errors' => [
                    'code' => [__('translation.Invalid Coupon')]
                ]
            ], 422);
        }

        $user->update([
            'coupon_id' => $coupon->id,
        ]);

        return view('users.cart.cartDetails');
    }

    public function disapplycoupon(){
        $user = auth()->user();
        $user->update([
            'coupon_id' => null,
        ]);
        return view('users.cart.cartDetails');



    }


    public function checkoutform(){
        $addresses = Address::where('user_id', auth()->user()->id)->latest()->get();
        $cartitems = Cart::with('item')->where('user_id', auth()->user()->id)->get();
        return view('user.cart.checkout',compact('addresses','cartitems'));
    }



    public function cartsdetails(){
        $cartitems = Cart::with('item')->where('user_id', auth()->user()->id)->get();
        return view('user.cart.cartdetails',compact('cartitems'));
    }





}
