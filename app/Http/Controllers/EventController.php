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

    // ... rest of the controller methods ...
}
