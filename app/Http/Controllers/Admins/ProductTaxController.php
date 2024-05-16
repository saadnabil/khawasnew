<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductTaxRequest;
use App\Models\ProductTax;
use Illuminate\Http\Request;

class ProductTaxController extends Controller
{

    public function index()
    {
        $itemtaxes = ProductTax::latest()->get();
        return view('admins.productTaxes.products_tax',compact('itemtaxes'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $itemtax = new ProductTax();
        $action = route('admin.itemtaxes.store');
        return view('admins.productTaxes.form',compact('itemtax','action'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductTaxRequest $request)
    {
        $data = $request->validated();
        ProductTax::create($data);
        session()->flash('success', 'Item created successfully');
        return redirect()->route('admin.itemtaxes.index');
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
    public function edit(ProductTax $itemtax)
    {
        $action = route('admin.itemtaxes.update', $itemtax);
        $method = true;
        return view('admins.productTaxes.form',compact('itemtax','action','method'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductTaxRequest $request, ProductTax $itemtax)
    {
        $data = $request->validated();
        $itemtax->update($data);
        session()->flash('success', 'Item Tax updated Successfully');
        return redirect()->route('admin.itemtaxes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductTax $itemtax)
    {
        //
        $itemtax->delete();
        session()->flash('success', 'Item Tax Deleted Successfully');
        return redirect()->route('admin.itemtaxes.index');
    }
    //
}
