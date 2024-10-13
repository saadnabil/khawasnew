<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Helpers\FileHelper;
use App\Http\Requests\ProductTypeRequest;
use App\Models\ItemType;
use RealRashid\SweetAlert\Facades\Alert;


class ItemTypesController extends Controller
{


    function __construct()
    {
         $this->middleware('permission:item-type-list', ['only' => ['index']]);
         $this->middleware('permission:item-type-create', ['only' => ['create','store']]);
         $this->middleware('permission:item-type-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:item-type-delete', ['only' => ['destroy']]);
         $this->middleware('permission:item-type-export', ['only' => ['export']]);
    }
    
    public function index()
    {
        $itemtypes = ItemType::latest()->get();
        return view('admins.itemtype.index',compact('itemtypes'));

    }

    public function create()
    {
        $itemtype = new ItemType();
        $langs = availableLanguages();
        $action = route('admin.itemtypes.store');
        return view('admins.itemtype.form',compact('itemtype','action','langs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductTypeRequest $request)
    {
        $data = $request->validated();
        ItemType::create($data);
        Alert::toast(__('translation.Item Type created successfully'),'success');
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
    public function edit(ItemType $itemtype)
    {
        $langs = availableLanguages();
        $action = route('admin.itemtypes.update', $itemtype);
        $method = true;
        return view('admins.itemtype.form',compact('itemtype','action','method','langs'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductTypeRequest $request, ItemType $itemtype)
    {
        $data = $request->validated();
        $itemtype->update($data);
        Alert::toast(__('translation.Item Type Updated successfully'),'success');
        return redirect()->route('admin.itemtypes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemType $itemtype)
    {
        //
        $itemtype->delete();
        Alert::toast(__('translation.Item Type Deleted successfully'),'success');
        return redirect()->route('admin.itemtypes.index');
    }
    //
}
