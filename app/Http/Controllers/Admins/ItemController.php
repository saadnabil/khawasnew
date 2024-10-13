<?php

namespace App\Http\Controllers\Admins;

use App\Exports\Exports\ExportsItems;
use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\ImportItemsRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductTypeRequest;
use App\Imports\ItemsImport;
use App\Models\Admin;
use App\Models\Item;
use App\Models\ItemTax;
use App\Models\ItemType;
use App\Models\Media;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:item-list', ['only' => ['index']]);
        $this->middleware('permission:item-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:item-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:item-delete', ['only' => ['destroy']]);
        $this->middleware('permission:item-export', ['only' => ['export']]);
    }

     // $products = cache()->remember('items', 60, function () {

        // });

        public function index(Request $request)
        {
            // Fetch trashed items with related admin and editor
            $delete_item = Item::onlyTrashed()->with('admin', 'editor')->get();
            
            // Get the authenticated admin
            $admin = auth('admin')->user();
        
            // Get search query from request
            $query = $request->input('search');
        
            // Build the query for products with search functionality
            $products = Item::latest()
                ->with('admin', 'editor')
                ->when($query, function($queryBuilder) use ($query) {
                    return $queryBuilder->where('title', 'like', '%' . $query . '%')
                        ->orWhere('barcode', 'like', '%' . $query . '%');
                })
                ->paginate(8);
        
            // Check if no products were found
            $noResults = $products->isEmpty();
        
            // Pass variables to the view
            return view('admins.items.index', compact('query','products', 'admin', 'delete_item', 'noResults'));
        }
        


 




    public function recover($id)
    {
        $item = Item::withTrashed()->find($id);
        
        if ($item) {
            $item->restore();
            return response()->json(['message' => 'Item recovered successfully.']);
        } else {
            return response()->json(['message' => 'Item not found.'], 404);
        }
    }
    






    public function viewItem($details)
    {
        $products = Item::with('admin', 'editor')->findOrFail($details);
        $admin = auth('admin')->user();
        return view('admins.items.ItemDetails', compact('products', 'admin'));
    }


    public function CreateItemType(ProductTypeRequest $request)
    {
        $data = $request->validated();
        ItemType::create($data);
        Alert::toast(__('translation.Item Type created successfully'), 'success');
        return redirect()->route('admin.items.create');
    }


    public function create()
    {
        $langs = availableLanguages();
        $item = new Item();
        $types = ItemType::get();
        $taxes = ItemTax::orderBy('tax', 'asc')->get();
        $action = route('admin.items.store');
        $images = Media::all();
        // Add admin_id to the $item object
        $item->admin_id = auth('admin')->user()->id;

        return view('admins.items.form', 
        compact('types', 'taxes', 'langs', 'item', 'action', 'images'));
    }



    public function store(ProductRequest $request)
    {
        // Validate the request data
        $data = $request->validated();

        // Handle image upload or selection
        if ($request->filled('selected_image')) {
            $data['image'] = str_replace(url('storage/') . '/', '', $request->input('selected_image'));
        } elseif ($request->hasFile('image')) {
            $data['image'] = FileHelper::upload_file('items', $data['image']);
        }

        // Calculate total price
        $total_price = $data['units_number'] * $data['unit_price'];
        $data['total_price'] = $total_price + ($total_price * $data['tax'] / 100);

        // Validate min and max values
        $min = $data['min'] ?? 0;
        $max = $data['max'] ?? 0;

        if ($min > 0 && $max > 0 && $min > $max) {
            return back()->withErrors(['min' => 'Min value cannot be greater than Max value.']);
        }

        // Set the admin_id and editor_id
        $data['admin_id'] = auth('admin')->user()->id;
        $data['editor_id'] = auth('admin')->user()->id;

        // Generate barcode image
        $data['barcodeimage'] = generate_barcode($data['barcode']);

        // Create the item
        Item::create($data);

        // Show success message
        Alert::toast(__('translation.Item created successfully'), 'success');
        return redirect()->route('admin.items.index');
    }


    public function ShowDuplicate(Item $item)
    {


        $langs = availableLanguages();
        $action = route('admin.duplicateItem', $item);
        $types = ItemType::get();
        $taxes = ItemTax::orderBy('tax', 'asc')->get();
        $method = true;
        $images = Media::all();
        return view('admins.items.form', compact('types', 'taxes', 'langs', 'item', 'action', 'method', 'images'));
    }



    public function DuplicateItem(ProductRequest $request)
    {
        // Validate the request data
        $data = $request->validated();

        // Handle image upload or selection
        if ($request->filled('selected_image')) {
            $data['image'] = str_replace(url('storage/') . '/', '', $request->input('selected_image'));
        } elseif ($request->hasFile('image')) {
            $data['image'] = FileHelper::upload_file('items', $data['image']);
        }

        // Calculate total price
        $total_price = $data['units_number'] * $data['unit_price'];
        $data['total_price'] = $total_price + ($total_price * $data['tax'] / 100);

        // Validate min and max values
        $min = $data['min'] ?? 0;
        $max = $data['max'] ?? 0;

        if ($min > 0 && $max > 0 && $min > $max) {
            return back()->withErrors(['min' => 'Min value cannot be greater than Max value.']);
        }

        // Set the admin_id and editor_id
        $data['admin_id'] = auth('admin')->user()->id;
        $data['editor_id'] = auth('admin')->user()->id;

        // Generate barcode image
        $data['barcodeimage'] = generate_barcode($data['barcode']);

        // Create the item
        Item::create($data);

        // Show success message
        Alert::toast(__('translation.Item created successfully'), 'success');
        return redirect()->route('admin.items.index');
    }



    public function edit(Item $item)
    {

        $langs = availableLanguages();
        $action = route('admin.items.update', $item);
        $types = ItemType::get();
        $taxes = ItemTax::orderBy('tax', 'asc')->get();
        $method = true;
        $images = Media::all();
        return view('admins.items.form', compact('types', 'taxes', 'langs', 'item', 'action', 'method', 'images'));
    }

    public function update(ProductRequest $request, Item $item)
    {
        $data = $request->validated();

        // Handle image upload or selection
        if ($request->filled('selected_image')) {
            $data['image'] = str_replace(url('storage/') . '/', '', $request->input('selected_image'));
        } elseif ($request->hasFile('image')) {
            $data['image'] = FileHelper::update_file('items', $data['image'], $item->image);
        }

        // Validate 'min' and 'max'
        $min = $data['min'] ?? 0;
        $max = $data['max'] ?? 0;

        if ($min > 0 && $max > 0 && $min > $max) {
            return back()->withErrors(['min' => 'Min value cannot be greater than Max value.']);
        }

        $total_price = $data['units_number'] * $data['unit_price'];
        $data['total_price'] = $total_price + ($total_price * $data['tax'] / 100);

        $data['barcodeimage'] = generate_barcode($data['barcode']);

        $item->update($data);

        Alert::toast(__('translation.Item Updated successfully'), 'success');
        return redirect()->route('admin.items.index');
    }


    public function import(ImportItemsRequest $request)
    {
        $data = $request->validated();
        Excel::import(new ItemsImport,  $data['file']);
        Alert::toast(__('translation.Imported Items Successfully'), 'success');
        return redirect()->route('admin.items.index');
    }

    public function export()
    {
        Alert::toast(__('translation.Exported Items Successfully'), 'success');
        return Excel::download(new ExportsItems, 'items.xlsx');
    }


    public function destroy(Item $item)
    {
        $item->delete();
        Alert::toast(__('translation.Item Deleted successfully'), 'success');
        return redirect()->route('admin.items.index');
    }

    //
}
