<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Event;

class BookingController extends Controller
{

    public function index()
    {
        // Fetch all bookings from the database
         // Fetch all bookings from the database
         $bookings = Book::with('event')->get(); // Eager load the 'event' relation

         // Return the 'adminbook.index' view with the bookings data
         return view('adminbook.index', compact('bookings'));
    }
    public function create($event_id)
    {
        // Retrieve a single event by its ID (or throw a 404 error if not found)
        $event = Event::findOrFail($event_id);
    
        // Pass the event to the view
        return view('bookings.create', compact('event'));
    }
    



    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'alamat' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15',
            'id_event' => 'required|exists:events,id',
        ]);

        // Create a new booking entry in the 'book' table
        $booking = new Book();
        $booking->nama = $validated['nama'];
        $booking->email = $validated['email'];
        $booking->alamat = $validated['alamat'];
        $booking->nomor_hp = $validated['nomor_hp'];
        $booking->id_event = $validated['id_event'];
        $booking->save();

        // Update the sold_tickets count for the event
        $event = Event::findOrFail($validated['id_event']);
        $event->sold_tickets = $event->sold_tickets + 1; // Increment sold tickets by 1
        $event->save();

        // Redirect with a success message
        return redirect()->route('events.show', $validated['id_event'])->with('success', 'Booking successful!');
    }

    public function __construct()
    {
        // Only allow authenticated admins to access these methods
        $this->middleware('auth:admin')->only(['edit', 'update']);
    }

    public function edit($id)
    {
        // Find the booking by ID
        $booking = Book::findOrFail($id);

        // Return the edit view with the booking data
        return view('adminbook.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'alamat' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15',
        ]);

        // Find the booking and update the data
        $booking = Book::findOrFail($id);
        $booking->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'nomor_hp' => $request->nomor_hp,
        ]);

        // Redirect back to the booking list with success message
        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
    }

}
