<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\AdminAuthRequest;
use App\Services\Admins\AdminAuthService;
use Illuminate\Http\Request;

class AdminsAuthController extends Controller
{

    protected $adminAuthService;
    public function __construct(AdminAuthService $adminAuthService)
    {
        $this->adminAuthService = $adminAuthService;
    }
    public function showloginform(){
        $route = route('admin.login');
        return view('layout.auth.login', compact('route'));
    }
    public function login(AdminAuthRequest $request){
        $credentials = $request->validated();
        $response = $this->adminAuthService->makeLogin($credentials);
        // Authentication failed...
        if(isset($response['error'])){
            return redirect()->route('admin.showloginform')->withErrors(['login' => $response['error']])->withInput($request->only('login'));
        }

        session()->flash('success','Login sucsessfully');
        return redirect()->route('admin.dashboard.index');
    }


   


    public function logout(Request $request){
        auth('admin')->logout();
        return redirect()->route('admin.showloginform');
    }
}

    //

