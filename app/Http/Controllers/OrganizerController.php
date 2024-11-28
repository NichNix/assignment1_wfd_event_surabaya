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
        Organizer::create($request->all());
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
