<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserForgotPasswordRequest;
use App\Models\Admin;
use App\Models\User;
use App\Services\Admins\AdminAuthService;
use App\Services\Users\UserAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{


    protected $adminAuthService;
    protected $userAuthService;

    public function __construct(AdminAuthService $adminAuthService, UserAuthService $userAuthService)
    {
        $this->adminAuthService = $adminAuthService;
        $this->userAuthService = $userAuthService;
    }

    
    public function showLinkRequestForm(Request $request)
    {
        
        $route = route('password.request');
        return view('layout.auth.forgotpassword',compact('route'));
       
    }


   



    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['phone' => 'required']);

        $phone = $request->input('phone');
        $isUser = User::where('phone', $phone)->exists();
        $isAdmin = Admin::where('phone', $phone)->exists();
    
        if ($isUser) {
            $status = Password::broker('users')->sendResetLink(
                $request->only('phone')
            );
        } elseif ($isAdmin) {
            $status = Password::broker('admins')->sendResetLink(
                $request->only('phone')
            );
        } else {
            return back()->withErrors(['phone' => 'Phone number not found.']);
        }
    
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['phone' => __($status)]);
    }
    //
}
