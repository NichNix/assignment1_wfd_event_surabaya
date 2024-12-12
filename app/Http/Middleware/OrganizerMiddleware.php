<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated as an organizer
        if (Auth::guard('organizer')->check()) {
            // If authenticated, allow the request to proceed
            return $next($request);

        }

        // If not authenticated as an organizer, redirect them to the login page or home
        return redirect()->route('organizers.login');         
    }
}
