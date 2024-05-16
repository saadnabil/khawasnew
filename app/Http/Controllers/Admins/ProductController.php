<?php

namespace App\Http\Controllers\Admins;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductTax;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::latest()->get();
        return view('admins.products.Product_List',compact('products'));
    }

    public function create()
    {
        $langs = availableLanguages();
        $item = new Product();
        $types = ProductType::get();
        $taxes = ProductTax::orderBy('tax','asc')->get();
        $action = route('admin.items.store');
        return view('admins.products.form',compact('types','taxes','langs','item','action'));
    }

    public function store(ProductRequest $request)
    {
        // dd($request);
        $data = $request->validated();
       
        if(isset($data['image'])){
            $data['image'] = FileHelper::upload_file('items', $data['image']);
        }
        $total_price = $data['units_number'] * $data['unit_price'];
        $data['total_price'] =  $total_price +  ($total_price * $data['tax'] / 100);
        Product::create($data);
        session()->flash('success', __('translation.Item created successfully'));
        return redirect()->route('admin.items.index');
    }


    public function edit(Product $item)
    {
        $langs = availableLanguages();
        $action = route('admin.items.update', $item);
        $types = ProductType::get();
        $item = new Product();
        $taxes = ProductTax::orderBy('tax','asc')->get();
        $method = true;
        return view('admins.products.form',compact('types','taxes','langs','item','action','method'));
    }

    public function update(ProductRequest $request, Product $item)
    {
        $data = $request->validated();
        if(isset($data['image'])){
            $data['image'] = FileHelper::update_file('items', $data['image'],$item->image);
        }
        $total_price = $data['units_number'] * $data['unit_price'];
        $data['total_price'] =  $total_price +  ($total_price * $data['tax'] / 100);
        $item->update($data);
        session()->flash('success', __('translation.Item updated successfully'));
        return redirect()->route('admin.items.index');
   
    }

    public function destroy(Product $item)
    {
        $item->delete();
        session()->flash('success', __('translation.Item deleted successfully'));
        return redirect()->route('admin.items.index');
    }

    //
}
