<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Organizer;
use App\Models\EventCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('prevent.cache'); // Apply the prevent cache middleware
    }

    

    public function index(Request $request)
    {

        if (auth()->guard('organizer')->check()) {
            // If the user is an organizer, redirect them to the organizer's home page
            return redirect()->route('organizers.home');
        }
        // Fetch all provinces and regencies
        $provinces = Province::all();
        $regencies = Regency::all();
        $categories = EventCategory::all();

        // Start the query for events
        $events = Event::with(['province', 'regency', 'category'])
            ->when($request->province, function ($query) use ($request) {
                return $query->where('province_id', $request->province);
            })
            ->when($request->regency, function ($query) use ($request) {
                return $query->where('regency_id', $request->regency);
            })
            ->when($request->category, function ($query) use ($request) {
                return $query->where('event_category_id', $request->category);
            })
            ->when($request->start_date, function ($query) use ($request) {
                return $query->whereDate('date', '>=', Carbon::parse($request->start_date)->toDateString());
            })
            ->when($request->end_date, function ($query) use ($request) {
                return $query->whereDate('date', '<=', Carbon::parse($request->end_date)->toDateString());
            })
            ->get();


        // Return the view with events, provinces, and regencies
        return view('events.index', compact('events', 'provinces', 'regencies', 'categories'));
    }

    public function list()
    {
        $events = Event::where('venue', 'like', '%Surabaya%')->get();
        return view('events.list', compact('events'));
    }

    public function masterIndex()
    {
        if (auth()->guard('admin')->check()) {
            // If logged in as an admin, show the event master index
            $events = Event::with('organizer')->get();
            return view('events.masterIndex', compact('events'));
        }
    
        if (auth()->guard('organizer')->check()) {
            // If logged in as an organizer, redirect to their home page
            return redirect()->route('organizers.home');
        }
    
        // Optionally, redirect if the user is not authenticated
        return redirect()->route('login');
    }
    

    public function show($id)
    {
        $event = Event::with(['organizer', 'province', 'regency', 'category'])->findOrFail($id);
        return view('events.show', compact('event'));
    }

    public function create()
    {
        $organizers = Organizer::all();
        $provinces = Province::all();
        $regencies = Regency::all();
        $eventCategories = EventCategory::all();
        return view('events.create', compact('provinces', 'regencies', 'organizers', 'eventCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'venue' => 'required|string|max:255',
            'organizer_id' => 'required|exists:organizers,id', // Ensure organizer_id is valid
            'event_category_id' => 'required|exists:event_categories,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'description' => 'nullable|string',
            'booking_url' => 'nullable|url',
            'max_tickets' => 'required|integer',
            'sold_tickets' => 'required|integer',
            'status' => 'required|in:available,sold-out,cancelled',
            'image' => 'nullable|image',
            'price' => 'required|numeric',
            'province_id' => 'required|exists:provinces,id',
            'regency_id' => 'required|exists:regencies,id',
        ]);
    
        // Store the event with the selected or logged-in organizer's ID
        $event = new Event();
        $event->title = $request->title;
        $event->date = $request->date;
        $event->venue = $request->venue;
        $event->organizer_id = $request->organizer_id ?? auth()->user()->id;  // If organizer_id is not provided (for organizer), use the logged-in user
        $event->event_category_id = $request->event_category_id;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->description = $request->description;
        $event->booking_url = $request->booking_url;
        $event->max_tickets = $request->max_tickets;
        $event->sold_tickets = $request->sold_tickets;
        $event->status = $request->status;
        $event->price = $request->price;
        $event->province_id = $request->province_id;
        $event->regency_id = $request->regency_id;
    
        if ($request->hasFile('image')) {
            $event->image = $request->file('image')->store('events', 'public');
        }
    
        $event->save();
    
        return redirect()->route('events.masterIndex')->with('success', 'Event created successfully!');
    }
    


    public function edit($id)
    {
        $event = Event::findOrFail($id); 
        $organizers = Organizer::all(); 
        $provinces = Province::all(); 
        $regencies = Regency::all(); 
        $eventCategories = EventCategory::all();

        // Return the 'edit' view with event, organizers, and event categories
        return view('events.edit', compact('event', 'organizers', 'provinces', 'eventCategories')); // Pass provinces to the view
    }


    public function update(Request $request, $id)
{
    // Validate the request
        $validated = $request->validate([
        'title' => 'required|string|max:255',
        'venue' => 'required|string|max:255',
        'date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required',
        'organizer_id' => 'required|exists:organizers,id',
        'event_category_id' => 'required|exists:event_categories,id',
        'province_id' => 'required|exists:provinces,id',
        'regency_id' => 'required|exists:regencies,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'description' => 'required',
        'booking_url' => 'nullable|url',
        'max_tickets' => 'required|integer',
        'price' => 'required|integer',
        'sold_tickets' => 'required|integer',
        'status' => 'required|string',
    ]);

    // Handle the image upload (if any)
    $imagePath = $request->hasFile('image') ? 
        $request->file('image')->storeAs('events', $request->file('image')->getClientOriginalName(), 'public') : 
        null;

    // Retrieve the event
    $event = Event::findOrFail($id);

    // Update the event's attributes
    $event->title = $request->input('title');
    $event->venue = $request->input('venue');
    $event->date = $request->input('date');
    $event->start_time = $request->input('start_time');
    $event->end_time = $request->input('end_time');
    $event->organizer_id = $request->input('organizer_id');
    $event->event_category_id = $request->input('event_category_id');
    $event->province_id = $request->input('province_id');
    $event->regency_id = $request->input('regency_id');
    $event->description = $request->input('description');
    $event->booking_url = $request->input('booking_url');
    $event->max_tickets = $request->input('max_tickets');
    $event->price = $request->input('price');
    $event->sold_tickets = $request->input('sold_tickets');
    $event->status = $request->input('status');

    // Save the updated event
    $event->save();

    // Redirect back with a success message
    return redirect()->route('events.masterIndex')->with('success', 'Event created successfully!');
}


public function destroy($id)
{
    // Ensure the user is authenticated as either admin or organizer
    if (auth()->guard('admin')->check()) {
        // If logged in as an admin, allow the deletion
        $event = Event::findOrFail($id);
        $event->delete();

        // Redirect to the admin event index after deletion
        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }

    if (auth()->guard('organizer')->check()) {
        // If logged in as an organizer, redirect to their home page
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('organizers.home')->with('error', 'You cannot delete events as an organizer.');
    }

    // If neither admin nor organizer, redirect to login
}


}