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

         if(!auth()->check()){
            return redirect()->route('user.showloginform');
        }
        if (Auth::user()->status == 0) {
            Auth::logout(); // Logout the user if inactive
            return redirect()->route('user.deacivatedAccount')->with('error', 'Your account is inactive. Please contact the administrator.');
        }
        return $next($request);
    }
}
