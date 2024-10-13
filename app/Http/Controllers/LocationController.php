<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    //
    public function index()
    {
        $countries = Country::all();
        return view('country.index',compact('countries'));
    }
    

    public function show($iso)
    {
        $country = Country::where('iso_3166_!_alpha2',$iso)->firstOrFail();
        $cities = $country->cities();

        return view('admins.country.showCountyry',compact('country','cities'));
      
    }

   
}
