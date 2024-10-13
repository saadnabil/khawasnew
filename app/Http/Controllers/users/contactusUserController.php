<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class contactusUserController extends Controller
{
    //
    public function index(){
        $contact = ContactUs::orderBy('id','ASC')->first();

        return response()->view('users.settings.contactUs',compact('contact'));
    }
    public function inactiveDesign(){
        return view('admins.settings.inActive_Admin');
    }
}
