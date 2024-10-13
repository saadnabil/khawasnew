<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductTaxRequest;
use App\Models\ItemTax;
use App\Models\ProductTax;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class ItemTaxController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:item-tax-list', ['only' => ['index']]);
         $this->middleware('permission:item-tax-create', ['only' => ['create','store']]);
         $this->middleware('permission:item-tax-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:item-tax-delete', ['only' => ['destroy']]);
         $this->middleware('permission:item-tax-export', ['only' => ['export']]);
    }

    public function index()
    {
        $itemtaxes = ItemTax::latest()->get();
        return view('admins.itemtaxes.index',compact('itemtaxes'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $itemtax = new ItemTax();
        $action = route('admin.itemtaxes.store');
        return view('admins.itemtaxes.form',compact('itemtax','action'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductTaxRequest $request)
    {
        $data = $request->validated();
        ItemTax::create($data);
        Alert::toast(__('translation.Item Tax created successfully'),'success');
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
    public function edit(ItemTax $itemtax)
    {
        $action = route('admin.itemtaxes.update', $itemtax);
        $method = true;
        return view('admins.itemtaxes.form',compact('itemtax','action','method'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductTaxRequest $request, ItemTax $itemtax)
    {
        $data = $request->validated();
        $itemtax->update($data);
        Alert::toast(__('translation.Item Type Updated successfully'),'success');
        return redirect()->route('admin.itemtaxes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemTax $itemtax)
    {
        //
        $itemtax->delete();
        Alert::toast(__('translation.Item Tax  Deleted successfully'),'success');
        return redirect()->route('admin.itemtaxes.index');
    }
    //
}
