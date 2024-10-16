<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
{
    $guards = empty($guards) ? [null] : $guards;

    foreach ($guards as $guard) {
        if ($guard === 'admin' && Auth::guard($guard)->check()) {
            return redirect()->route('admin.showloginform');
        } elseif ($guard === 'web' && Auth::guard($guard)->check()) {
            return redirect()->route('user.showloginform');
        }
    }

    // If the user is not authenticated, store the intended URL and redirect to login
    if (!$request->expectsJson()) {
        $request->session()->put('url.intended', $request->url());
    }

    return $next($request);
}

}
