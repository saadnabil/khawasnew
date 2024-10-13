<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CheckoutRequest;
// use App\Jobs\PrintOrderJob;
use App\Jobs\SendEmailJob;
use App\Models\Cart;
use App\Models\Order;
use App\Models\order_details;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Services\PrintService;



class OrdersUserController extends Controller
{
   

    public function orderDetails(order $order){
        
        $order = $order->load('order_details.item','address','coupon','user');
        $user = auth()->user();
        return view('users.orders.order_view',compact('order','user'));
    }

    public function index()
    {
        $orders = Order::withTrashed()->where('user_id', auth()->user()->id)->latest();
    
        if (request()->has('status')) {
            $orders = $orders->where('status', request('status'));
        }
    
        $orders = $orders->get();
        $status = request()->has('status') ? request('status') : 'all';
    
        return view('users.orders.order_list', compact('orders', 'status'));
    }
    

    public function show(Order $order){
        $order = $order->load('order_details.item','address','coupon');
        $user = auth()->user();
        return view('users.orders.order_view',compact('order','user'));
    }

    public function cancel(Request $request, Order $order){
        $order->update(['status' => 'canceled']);
        session()->flash('success', __('translation.Order canceled successfully'));
        return redirect()->back();
    }



    
    public function checkout(CheckoutRequest $request ,PrintService $printService)
    {
        $data = $request->validated();
        $cartitems = Cart::with('item')->where('user_id', auth()->user()->id)->get();
    
        /** check cart is empty */
        if (count($cartitems) == 0) {
            session()->flash('error', __('translation.Oops! It seems like your cart is empty. Please add items to your cart before proceeding.'));
            return redirect()->back();
        }
    
        /** load user with applied coupon and coupon users */
        $user = auth()->user()->load('appliedcoupon.couponusers');
    
        /**store order with initial data */
        $data['user_id'] = $user->id;
        $data['order_id'] = generate_code_unique();
        if ($user->appliedcoupon) {
            $data['coupon_id'] = $user->appliedcoupon->id;
        }
    
        $order = Order::create($data);
    
        /** store order details */
        $result = 0;
        foreach ($cartitems as $cartitem) {
            $total_price = $cartitem->quantity * $cartitem->item->total_price;
            $orderDetail = order_details::create([
                'item_id' => $cartitem->item_id,
                'order_id' => $order->id,
                'quantity' => $cartitem->quantity,
                'total_price' => $total_price,
            ]);
            $result += $total_price;
    
            /**reset user cart */
            $cartitem->delete();
    
            /**load item */
            $orderDetail = $orderDetail->load('item');
    
            /**minus quantity */
            $orderDetail->item->update([
                'quantity' => $orderDetail->item->quantity - $cartitem->quantity
            ]);
        }
    
        //update order if coupon is applied
        $updatedData = [
            'total_price' => $result,
            'subtotal' => $result
        ];
    
        if ($user->appliedcoupon) {
            $updatedData['coupon_id'] = $user->appliedcoupon->id;
            $updatedData['total_price'] = $result - ($result * $user->appliedcoupon->discount / 100);
        }
        $order->update($updatedData);

         // Print the order invoice
    $printSuccess = $printService->printOrder($order);
    if (!$printSuccess) {
        session()->flash('error', __('translation.Failed to print the order. Please contact support.'));
        return redirect()->back();
    }
    
        
        //reset applied coupon
        $user->update(['coupon_id' => null]);
    
        //mark this coupon as used
        if ($user->appliedcoupon) {
            $user->appliedcoupon->couponusers()->where(['user_id' => auth()->user()->id])->update(['is_used' => 1]);
        }
    
        //Send Mail With Job
        $details['email'] = $user->email;
        $order = $order->load('order_details.item', 'coupon');
        $details['order'] = $order;
        dispatch(new SendEmailJob($details));
    
        session()->flash('success', __('translation.Your order has been completed successfully. Thank you for your purchase'));
        return redirect()->route('user.orders.index');
    }


 




    public function track_order(){
        return view('users.orders.order_track');
    }


    //
}
