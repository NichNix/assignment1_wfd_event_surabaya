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
        $events = Event::with('organizer')->get();
        return view('events.masterIndex', compact('events'));
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

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Generate a unique file name or use the original file name
            $imagePath = $image->storeAs('events', $image->getClientOriginalName(), 'public');
        }


        Event::create([
            'title' => $validated['title'],
            'venue' => $validated['venue'],
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'description' => $validated['description'],
            'booking_url' => $validated['booking_url'],
            'max_tickets' => $validated['max_tickets'],
            'sold_tickets' => $validated['sold_tickets'],
            'status' => $validated['status'],
            'image' => $validated['image'] ?? null,  // Handle image properly
            'price' => $validated['price'],
            'province_id' => $validated['province_id'],
            'regency_id' => $validated['regency_id'],
            'organizer_id' => $validated['organizer_id'],
            'event_category_id' => $validated['event_category_id'],
            'active' => 1,
        ]);


        return redirect()->route('events.index')->with('success', 'Event created successfully!');
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
    return redirect()->route('events.index')->with('success', 'Event updated successfully!');
}


    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }
}