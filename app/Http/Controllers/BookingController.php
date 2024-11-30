<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;
use Midtrans\Snap;
class BookingController extends Controller
{

    public function getBookings($eventId)
    {
        // Fetch the event along with its bookings
        $event = Event::with('bookings')->findOrFail($eventId);

        // Format the bookings data to include the fields you need
        $bookings = $event->bookings->map(function ($booking) {
            return [
                'user_name' => $booking->nama,
                'user_email' => $booking->email,
                'tickets_booked' => $booking->nomor_hp, // Adjust this to actual field for tickets booked
                'created_at' => $booking->created_at,
            ];
        });

        // Return the bookings as a JSON response
        return response()->json([
            'event' => $event,
            'bookings' => $bookings
        ]);
    }




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
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string',
            'nomor_hp' => 'required|string',
            'id_event' => 'required|exists:events,id',
        ]);

        // Simpan booking
        $booking = Book::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'nomor_hp' => $request->nomor_hp,
            'id_event' => $request->id_event,
            'status_bayar' => 'unpaid',
        ]);

        // Ambil detail event
        $event = Event::find($request->id_event);

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Parameter transaksi
        $transactionDetails = [
            'order_id' => 'BOOK-' . $booking->id,
            'gross_amount' => $event->price, // Harga event
        ];

        $customerDetails = [
            'first_name' => $request->nama,
            'email' => $request->email,
            'phone' => $request->nomor_hp,
        ];

        $params = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
        ];

        // Dapatkan token Snap
        $snapToken = Snap::getSnapToken($params);

        return view('bookings.payment', [
            'snapToken' => $snapToken,
            'booking' => $booking,
        ]);
    }

   

    public function search(Request $request)
    {
        $events = Event::all();  // Fetch all events for the dropdown

        $query = Book::query();

        // Filter by name
        if ($request->has('search') && $request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Filter by event if selected
        if ($request->has('event_id') && $request->event_id) {
            $query->where('id_event', $request->event_id);
        }

        // Get the filtered bookings
        $bookings = $query->get();

        return view('adminbook.index', compact('bookings', 'events'));
    }


    public function __construct()
    {
        // Only allow authenticated admins to access these methods
        $this->middleware('auth:admin')->only(['edit', 'update']);
        $this->middleware('prevent.cache'); // Apply the prevent cache middleware
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
