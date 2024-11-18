<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Ensure that the user is logged in and is an admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // If the user is not an admin, redirect them to the home page
        return redirect('/');
    }
}
