<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // If the admin is authenticated, redirect them to the admin dashboard or another page
        if (Auth::guard('admin')->check()) {
            return redirect()->route('events.index'); // Redirect to the admin dashboard or main page
        }

        return $next($request);
    }
}
