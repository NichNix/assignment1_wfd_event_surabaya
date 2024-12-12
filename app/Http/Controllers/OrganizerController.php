<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organizer;

class OrganizerController extends Controller
{
    
    public function index()
    {
        $organizers = Organizer::all();
        return view('organizers.index', compact('organizers'));
    }

    public function home()
    {
        // Check if the user is authenticated as an organizer
        if (!auth()->check() || !auth()->guard('organizer')->check()) {
            // Redirect to the login page if not authenticated as an organizer
            return redirect()->route('organizer.login');
        }
    
        // Retrieve events associated with the logged-in organizer
        $events = auth()->user()->events;
    
        // Pass the events to the view
        return view('organizers.home', compact('events'));
    }
    
    public function __construct()
    {
        $this->middleware('prevent.cache'); // Apply the prevent cache middleware
    }
    
    public function create()
    {
        return view('organizers.create');
    }

    
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8', // Ensure password is a string and has a minimum length
            'description' => 'nullable|string',  // Make description optional
            'facebook_link' => 'nullable|url', // Validate as URL but make it optional
            'x_link' => 'nullable|url',        // Validate as URL but make it optional
            'website_link' => 'nullable|url',  // Validate as URL but make it optional
        ]);
        
        // Creating the new Organizer
        Organizer::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']), // Hash the password
            'description' => $validated['description'] ?? null, // Handle nullable description
            'facebook_link' => $validated['facebook_link'] ?? null, // Nullable fields
            'x_link' => $validated['x_link'] ?? null,             // Nullable fields
            'website_link' => $validated['website_link'] ?? null, // Nullable fields
        ]);

        return redirect()->route('organizers.index');
    }

    
    public function edit($id)
    {
        $organizer = Organizer::findOrFail($id);
        return view('organizers.edit', compact('organizer'));
    }

    
    public function show($id) 
    {
        $organizer = Organizer::findOrFail($id);
        return view('organizers.show', compact('organizer'));
    }

    
    public function update(Request $request, $id)
    {
        $organizer = Organizer::findOrFail($id);
        $organizer->update($request->all());
        return redirect()->route('organizers.index');
    }

    
    public function destroy($id)
    {
        $organizer = Organizer::findOrFail($id);

        
        if ($organizer->events()->exists()) {
            return redirect()->route('organizers.index')->with('error', 'Cannot delete organizer with associated events.');
        }

        $organizer->delete();
        return redirect()->route('organizers.index')->with('success', 'Organizer deleted successfully!');
    }
}
