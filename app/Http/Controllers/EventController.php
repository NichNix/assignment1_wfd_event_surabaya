<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Organizer;
use Illuminate\Http\Request;

class EventController extends Controller
{
    
    public function index()
    {
        
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function list()
    {
        $events = Event::where('venue', 'like', '%Surabaya%')->get();
        return view('events.list', compact('events')); 
    }

    
    public function masterIndex()
    {
        
        $events = Event::with('organizer')->get();
        return view('events.masterIndex', compact('events'));
    }


    
    public function show($id)
    {
        $event = Event::with('organizer')->findOrFail($id);
        return view('events.show', compact('event'));
    }

    
    public function create()
    {
        $organizers = Organizer::all(); 
        $eventCategories = EventCategory::all();
        return view('events.create', compact('organizers', 'eventCategories')); 
    }


    
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required',
            'organizer_id' => 'required|exists:organizers,id', 
            'event_category_id' => 'required|exists:event_categories,id', 
        ]);

        
        Event::create($request->all());
        
    
        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }


    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $organizers = Organizer::all();
        return view('events.edit', compact('event', 'organizers'));
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required',
            'organizer_id' => 'required|exists:organizers,id',
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }
}
