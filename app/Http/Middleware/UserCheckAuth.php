<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserCheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('user.showloginform');
        }
    
        // Check if the authenticated user's status is inactive
        if (Auth::guard('web')->user()->status == 0) {
            Auth::logout(); // Logout the user if inactive
            return redirect()->route('user.inactive')->with('error', 'Your account is inactive. Please contact the administrator.');
        }
    
        return $next($request);
    }
    
}
