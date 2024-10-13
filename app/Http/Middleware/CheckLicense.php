<?php

namespace App\Http\Middleware;

use App\Models\License;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLicense
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $admin = auth()->user(); // Assuming you use Laravel's auth system
        $license = License::where('admin_id', $admin->id)->first();

        if (!$license || Carbon::now()->isAfter(Carbon::parse($license->end_date))) {
            return redirect()->route('license.expired');
        }
        return $next($request);
    }
}
