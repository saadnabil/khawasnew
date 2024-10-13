<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\AdminAuthRequest;
use App\Models\Order;
use App\Services\Admins\AdminAuthService;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function getPendingOrders(Request $request)
    {
        $query = Order::with('order_details.item', 'address', 'coupon', 'user')
            ->where('status', 'pending')->latest();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(7);

        $status = $request->has('status') ? $request->status : 'all';

        $html = view('layout.adminNav-orders', compact('orders', 'status'))->render();

        return response()->json([
            'total' => $orders->total(),
            'html' => $html
        ]);

    }
}

    //

