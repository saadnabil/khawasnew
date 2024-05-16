<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            // Get the segments of the URL
            $segments = $request->segments();
            // Check if the URL has at least two segments and the second segment is "dashboard"
            if (count($segments) >= 1 && $segments[0] === 'dashboard') {
                return route('admin.showloginform'); // Redirect to the admin login page
            }elseif(count($segments) >= 1 && $segments[0] === 'user'){
                return route('user.showloginform'); // Redirect to the user login page
            }
        }

        return null;
    }
}
