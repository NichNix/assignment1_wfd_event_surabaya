<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Organizer; // Make sure this model exists

class OrganizerAuthController extends Controller
{
    // Show the organizer login form
    public function showLoginForm()
    {
        return view('organizers.login');
    }

    // Handle the organizer login
    public function login(Request $request)
    {
        // Redirect to home if the user is already authenticated
        if (Auth::guard('organizer')->check()) {
            return redirect()->route('organizers.home');
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log in the organizer
        if (Auth::guard('organizer')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Store organizer-specific data in the session
            $organizer = Auth::guard('organizer')->user();
            Session::put('organizer_id', $organizer->id);
            Session::put('organizer_name', $organizer->name);

            // Redirect to organizer dashboard
            return redirect()->route('organizers.home');
        }

        return back()->withErrors(['email' => 'Invalid credentials or you are not authorized to access the organizer panel']);
    }

    public function __construct()
    {
        $this->middleware('prevent.cache'); // Apply the prevent cache middleware
    }

    // Log out the organizer user
    public function logout(Request $request)
    {
        Auth::guard('organizer')->logout();
        session()->flush(); // Clear all session data
        return redirect()->route('events.index')->with('success', 'You have logged out successfully.');
    }
}
