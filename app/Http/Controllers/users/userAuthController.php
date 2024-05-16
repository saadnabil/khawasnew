<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserAuthRequest;
use App\Services\Users\UserAuthService;
use Illuminate\Http\Request;

class userAuthController extends Controller
{

    protected $userAuthService;

    public function __construct(UserAuthService $userAuthService)
    {
        $this->userAuthService = $userAuthService;
    }

    public function showloginform(){
        $route = route('user.login');
        return view('layout.auth.login', compact('route'));
    }

    public function login(UserAuthRequest $request){
        $credentials = $request->validated();
        $response = $this->userAuthService->makeLogin($credentials);
        // Authentication failed...
        if(isset($response['error'])){
            return redirect()->route('user.showloginform')->withErrors(['login' => $response['error']])->withInput($request->only('login'));
        }
        return redirect()->route('user.products.index');
    }




    public function logout(Request $request){
        auth()->logout();
        return redirect()->route('user.showloginform');
    }
    //
}
