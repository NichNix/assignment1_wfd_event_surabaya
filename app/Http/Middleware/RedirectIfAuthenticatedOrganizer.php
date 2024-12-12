<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedOrganizer
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
        // If the organizer is already authenticated, redirect to their home page
        if (Auth::guard('organizer')->check()) {
            return redirect()->route('organizers.home'); // Redirect to organizer home page
        }

        return $next($request);
    }
}
