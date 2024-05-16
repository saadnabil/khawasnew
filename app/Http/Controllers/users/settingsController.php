<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class settingsController extends Controller
{

    public function ChangePassword(){
        return view('users.settings.changePassword');
    }

    public function changeUserImage(){
        return response()->view('users.settings.ChangeProfileImage');
    }
    //
}
