<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductUserController extends Controller
{

        public function index()
        {
            $items = Product::latest();

            // $items = Product::with('wishlisted')->latest();

           
            $items = $items->paginate(5);
    
            // //check if request is from ajax request ?
            // if(request()->ajax()){
            //     return view('user.items.itemscomponent', compact('items'));
            // }
            return response()->view('users.products.productView',compact('items'));
    
        }
       
    }

    //

