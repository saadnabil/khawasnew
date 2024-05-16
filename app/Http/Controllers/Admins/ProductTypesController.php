<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Helpers\FileHelper;
use App\Http\Requests\ProductTypeRequest;

class ProductTypesController extends Controller
{

    public function index()
    {
        $itemtypes = ProductType::latest()->get();
        return view('admins.productTypes.Product_type',compact('itemtypes'));

    }

    public function create()
    {
        $itemtype = new ProductType();
        $langs = availableLanguages();
        $action = route('admin.itemtypes.store');
        return view('admins.productTypes.form',compact('itemtype','action','langs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductTypeRequest $request)
    {
        $data = $request->validated();
        ProductType::create($data);
        session()->flash('success', __('translation.Item created successfully'));
        return redirect()->route('admin.itemtypes.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductType $itemtype)
    {
        $langs = availableLanguages();
        $action = route('admin.itemtypes.update', $itemtype);
        $method = true;
        return view('admins.productTypes.form',compact('itemtype','action','method','langs'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductTypeRequest $request, ProductType $itemtype)
    {
        $data = $request->validated();
        $itemtype->update($data);
        session()->flash('success', __('translation.Item updated successfully'));
        return redirect()->route('admin.itemtypes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductType $itemtype)
    {
        //
        $itemtype->delete();
        session()->flash('success', __('translation.Item deleted successfully'));
        return redirect()->route('admin.itemtypes.index');
    }
    //
}
