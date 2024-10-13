<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Users\UserAuthService;
use Illuminate\Http\Request;

class UserForgetpasswordController extends Controller
{

    protected $userAuthService;

    public function __construct(UserAuthService $userAuthService)
    {
        $this->userAuthService = $userAuthService;
    }

    //
    public function userforgtshowform(Request $request)
    {
        
        $route = route('user.password.request');
        return view('layout.auth.forgotpassword',compact('route'));
       
    }
}
