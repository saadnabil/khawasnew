<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\AddAdressRequest;
use App\Models\Address;
use App\Models\Country;
use Illuminate\Http\Request;

class AddressesController extends Controller
{

    public function store(AddAdressRequest $request)
    {
        $countries = Country::all();
        // Get validated data
        $data = $request->validated();
        
        // Add user ID to the data
        $data['user_id'] = auth()->user()->id;
    
        // Create a new address record
        Address::create($data);
    
        // Fetch the latest address records for the user
        $address = Address::with(['country', 'city', 'state'])
        ->where('user_id', auth()->user()->id)
        ->latest()
        ->get();
        
    
        // Return the view with the address data
        return view('users.cart.addresses', compact('address','countries'));
    }
    

    public function destroy(Request $request , $id){

        Address::find($id)->delete();
        $address = Address::where('user_id', auth()->user()->id)->latest()->get();
        return view('users.cart.addresses',compact('address'));
    }
    //
}
