<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Services\Admins\AdminAuthService;
use App\Services\Users\UserAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class ResetPasswordController extends Controller
{
    protected $adminAuthService;
    protected $userAuthService;

    public function __construct(AdminAuthService $adminAuthService, UserAuthService $userAuthService)
    {
        $this->adminAuthService = $adminAuthService;
        $this->userAuthService = $userAuthService;
    }

    
    public function showResetForm(Request $request, $token = null)
    {
        
        return view('layout.auth.recovey-pass')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
     
        
        
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:8|confirmed',
            'token' => 'required',
        ]);


       $isUser = User::where('email', $request->email)->exists();
        $isAdmin = Admin::where('email', $request->email)->exists();
    
        if ($isUser) {
            $status = Password::broker('users')->reset(
                [
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'password_confirmation' => $request->password_confirmation,
                    'token' => $request->token,
                ],
                function ($user, $password) {
                    $user->forceFill([
                        'password' => $password,
                        'remember_token' => Str::random(60),
                    ])->save();
                }
            );
    
            return $status === Password::PASSWORD_RESET
                ? redirect()->route('user.login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
        } elseif ($isAdmin) {
            $status = Password::broker('admins')->reset(
                [
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'password_confirmation' => $request->password_confirmation,
                    'token' => $request->token,
                ],
                function ($admin, $password) {
                    $admin->forceFill([
                        'password' => $password,
                        'remember_token' => Str::random(60),
                    ])->save();
                }
            );
        
    
            return $status === Password::PASSWORD_RESET
                ? redirect()->route('admin.login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
        } else {
            return back()->withErrors(['email' => __('Email not found.')]);
        }
        
        
    }
    //
}
