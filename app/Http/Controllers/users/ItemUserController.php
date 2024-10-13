<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
use App\Models\order_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemUserController extends Controller
{

    public function index(Request $request)
    {
        $query = $request->input('search');

        // Fetch items, filter by search query if provided, and eager load 'wishlisted' relationship
        $items = Item::with('wishlisted')
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%')
                    ->orWhere('barcode', 'like', '%' . $query . '%');
            })
            ->latest()
            ->paginate(16);

        // Check if no products were found
        $noResults = $items->isEmpty();

        return view('users.items.index', compact('items', 'query', 'noResults'));
    }


    public function thankyou(Order $order)
    {
        // $cartitems = Cart::with('item')->where('user_id', auth()->user()->id)->get();



        $cartitems = order_details::query()
            ->join('orders', 'orders.id', '=', 'order_details.order_id')
            ->join('items', 'items.id', '=', 'order_details.item_id')
            ->where('orders.user_id', Auth::id())
            ->get();
        // dd($cartitems);
        return view('users.items.thankyou', compact('cartitems'));
    }
}

    //
