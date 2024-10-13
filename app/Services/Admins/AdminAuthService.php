<?php
namespace App\Services\Admins;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminAuthService{
    public function makeLogin(array $credentials)
    {
        $loginField = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $credentials[$loginField] = $credentials['login'];
        unset($credentials['login']);
    
        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            $lastFailedLoginAt = $admin->last_failed_login_at;
            $admin->last_failed_login_at = null; // Reset failed login time
            $admin->save();
    
            return [
                'success' => true,
                'last_failed_login_at' => $lastFailedLoginAt
            ];
        } else {
            $admin = Admin::where($loginField, $credentials[$loginField])->first();
            if ($admin) {
                $admin->last_failed_login_at = Carbon::now();
                $admin->save();
            }
            return ['error' => 'Invalid email or phone number or password. Please try again'];
        }
    }




}
