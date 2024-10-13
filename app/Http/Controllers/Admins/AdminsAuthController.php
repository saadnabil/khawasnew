<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\AdminAuthRequest;
use App\Services\Admins\AdminAuthService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

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

  
    
    public function login(AdminAuthRequest $request)
    {
        $credentials = $request->validated();
        $response = $this->adminAuthService->makeLogin($credentials);

        if (isset($response['error'])) {
            Alert::error('Login Failed', $response['error']);
            return redirect()->route('admin.showloginform')->withErrors(['login' => $response['error']])->withInput($request->only('login'));
        }

        $lastFailedLoginAt = $response['last_failed_login_at'];
        $successfulLoginAlert = Alert::success(__('translation.Login'), 'Login successful');

        if ($lastFailedLoginAt) {
            $failedLoginAlert = Alert::info(__('اخر تسجيل دخول'), __('اخر تسجيل دخول خاطئ كان في: ') . Carbon::parse($lastFailedLoginAt)->format('Y-m-d H:i:s'));
        }

        if (session()->has('last_visited_url')) {
            return redirect(session()->get('last_visited_url'));
        }

        return redirect()->intended('admin.dashboard.index');
    }

     
   


    public function logout(Request $request){
        auth('admin')->logout();
        return redirect()->route('admin.showloginform');
    }
}

    //

