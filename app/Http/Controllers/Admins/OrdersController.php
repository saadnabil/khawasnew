<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\UpdateOrderStatusRequest;
use App\Jobs\SendEmailJob;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class OrdersController extends Controller
{


    public function __construct()
    {
        $this->middleware('permission:order-list', ['only' => ['index']]);
        $this->middleware('permission:order-show', ['only' => ['show']]);
        $this->middleware('permission:order-export', ['only' => ['export']]);
        $this->middleware('permission:order-send-invoice', ['only' => ['sendInvoice']]);
        $this->middleware('permission:order-edit-status', ['only' => ['updateStatus']]);


    }


    public function index(){
        $query = Order::with('order_details.item', 'address', 'coupon', 'user')->latest();

        if (request()->has('status')) {
            $query->where('status', request('status'));
        }

        $orders = $query->paginate(7);
        $status = request()->has('status') ? request('status') : 'all';

        return view('admins.orders.index', compact('orders', 'status'));
    }


    public function show(Order $order)
    {
        $order = $order->load('item.tax', 'address', 'coupon', 'user');
        $user = auth()->user();
        return view('admins.orders.show', compact('order', 'user'));
    }
    
    public function sendInvoice(Request $request){
        $order = Order::with('order_details.item','coupon')->findorfail($request->order_id);
        $details['order'] = $order;
        $details['email'] = $request->email;
        dispatch(new SendEmailJob($details));
        session()->flash('success', __('translation.Order send successfully'));
        return redirect()->back();

    }

    public function updateStatus(UpdateOrderStatusRequest $request){
        $data = $request->validated();
        $order = Order::findorfail($data['order_id']);
        unset($data['order_id']);
        if($order->status == 'pending'){
            $data['pending_date'] = $data['date'];
        }elseif($order->status == 'delivered'){
            $data['delivered_date'] = $data['date'];
        }elseif($order->status == 'shipped'){
            $data['shipped_date'] = $data['date'];
        }elseif($order->status == 'canceled'){
            $data['canceled_date'] = $data['date'];
        }
        $email = $request->input('email');
        $orderId = $request->input('order_id');
        unset($data['date']);
        $order->update($data);
        Alert::toast('Order status updated successfully', 'success');

        return redirect()->back();
    }

    public function trackorderdetails(Order $order){
        $users = User::all();
        $order = $order->load('order_details.item','address','coupon','user');
        return view('admins.orders.track-orders-details',compact('order','users'));
    }

    public function edit(Order $order){

        $order = $order->load('order_details.item','address','coupon','user');
        $user = auth()->user();
        return view('admins.orders.edit-order',compact('order','user'));

    }

    public function updateAddress(Request $request, Order $order)
    {
        $request->validate([
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
        ]);

        $order->address->update([
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
        ]);

        return redirect()->back()->with('success', 'Address updated successfully');
    }

    public function updateDiscount(Request $request, Order $order)
    {
        $request->validate([
            'discount' => 'required|numeric|min:0',
        ]);

        $discount = $request->discount;
        $order->discount = $discount;
        $order->total_price = $order->subtotal - $discount;
        $order->save();

        return response()->json([
            'success' => true,
            'new_total' => $order->total_price,
        ]);
    }

  public function deleteOrder(Order $order)
{
    if ($order->delete()) {
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    } else {
        return redirect()->route('admin.orders.index')->with('error', 'Failed to delete the order.');
    }
}



}
