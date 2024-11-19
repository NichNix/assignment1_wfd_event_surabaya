<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    // Show the admin login form
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Handle the admin login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        // Attempt to log in the admin
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Store admin-specific data in the session
            $admin = Auth::guard('admin')->user();
            Session::put('admin_id', $admin->id);
            Session::put('admin_name', $admin->name);
    
            return redirect()->route('events.index');
        }
    
        return back()->withErrors(['email' => 'Invalid credentials or you are not authorized to access the admin panel']);
    }

    public function __construct()
    {
        $this->middleware('prevent.cache'); // Apply the prevent cache middleware
    }
    
    // Log out the admin user
    public function logout()
    {
        // Clear the session
        Session::flush();
    
        // Log out the admin user
        Auth::guard('admin')->logout();
    
        // Redirect to login page after logout
        return redirect()->route('events.index')->with('success', 'You have logged out successfully.');
    }
}
