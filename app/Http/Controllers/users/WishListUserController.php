<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Wishlist;
use App\Models\Wislist;
use Illuminate\Http\Request;

class WishListUserController extends Controller
{

    public function index()
    {
        $wishlists = Wislist::with('item')->where('user_id',auth()->user()->id)->with('item')->latest()->get();
        return view('users.wishlist.wishlist',compact('wishlists'));
    }

    public function favourite($id){
        $item = Item::find($id);



        $wishlist = Wislist::where([
            'user_id' => auth()->user()->id,
            'item_id' => $item->id
        ])->first();

        if (!$wishlist) {
            // Create the wishlist item if it doesn't exist
            $wishlist = Wislist::create([
                'user_id' => auth()->user()->id,
                'item_id' => $item->id
            ]);
            $data['status'] = 1;
        } else {
            // Delete the wishlist item if it already exists
            $wishlist->delete();
            $data['status'] = 0;
        }

        if(request()->has('wishlist')){
            $wishlists = Wislist::with('item')->where('user_id',auth()->user()->id)->with('item')->latest()->get();
            $data['view'] = view('users.wishlist.wishlist-items',compact('wishlists'))->render();
        }

        return $data;

    }
 public function destroy(string $id)
    {
        //
        Wislist::find($id)->delete();
        $wishlists = Wislist::where('user_id',auth()->user()->id)->with('item')->latest()->get();
        return view('users.wishlist.wishlist-items',compact('wishlists'));
    }
    //
}
