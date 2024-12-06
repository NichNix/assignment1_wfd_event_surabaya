@extends('layouts.app')

@section('title', 'Organizer Home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold text-indigo-600">Welcome, {{ auth()->user()->name }}</h1>

    <h3 class="text-xl mt-6 mb-4">Your Events</h3>

    <!-- Create Event Button -->
    <div class="mb-6">
        <a href="{{ route('events.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
            Create New Event
        </a>
    </div>

    <!-- Check if the organizer has any events -->
    @if($events->isEmpty())
    <p class="text-gray-500">You don't have any events yet. Please create one!</p>
    @else
    <!-- Events Listing -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
        @foreach($events as $event)
        <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-gray-200 hover:border-indigo-600">
            <div class="p-6">
                <!-- Event Title with Status -->
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-semibold text-indigo-600">
                        {{ $event->title }}
                    </h3>
                    <span class="text-sm font-medium px-3 py-1 rounded-full bg-indigo-100 text-indigo-600">
                        {{ $event->status }}
                    </span>
                </div>

                <!-- Event Date and Time -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Event Date and Time</h3>
                    <div class="flex items-center text-gray-600 text-sm mb-3">
                        <span class="text-gray-800 text-lg font-semibold bg-gray-100 px-3 py-1 rounded-md mr-4">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</span>
                        <span class="text-indigo-600 text-lg font-semibold">{{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}</span>
                    </div>
                </div>

                <!-- Event Location -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Event Location</h3>
                    <div class="flex items-center text-gray-600 text-sm mb-6">
                        <span class="text-gray-700 text-sm font-medium bg-gray-50 px-3 py-1 rounded-md">{{ $event->venue }}, {{ $event->regency->name }}, {{ $event->province->name }}</span>
                    </div>
                </div>

                <!-- Event Category -->
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Event Category</h3>
                    <div class="flex items-center text-gray-600 text-sm">
                        <span class="text-white bg-indigo-600 font-medium text-sm px-3 py-1 rounded-md">{{ $event->category->name }}</span>
                    </div>
                </div>

                <!-- View Details Button -->
                <a href="{{ route('events.show', $event->id) }}" class="w-full inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    View Details
                </a>
            </div>

            <!-- Edit and Delete Buttons -->
            <div class="p-3">
                <!-- Grouping all buttons together in a flex container -->
                <div class="flex space-x-4">
                    <!-- Edit Button (Anchor Tag) -->
                    <a href="{{ route('events.edit', $event->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105 w-full text-center">
                        Edit
                    </a>

                    <!-- Delete Button (Form with Button inside) -->
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105 w-full text-center">
                            Delete
                        </button>
                    </form>

                    <!-- Bookings Button (Standard Button) -->
                    <button id="seeBookingsBtn" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105 w-full text-center" data-event-id="{{ $event->id }}">
                        Bookings
                    </button>
                </div>
            </div>


        </div>
        @endforeach
    </div>
    @endif
</div>
<!-- Bookings Modal (Card style) -->
<div id="bookingsModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-3/4 md:w-1/2 lg:w-1/3">
        <!-- Event Title -->
        <h2 id="eventTitle" class="text-2xl font-semibold text-center mb-4">Bookings for Event</h2>

        <!-- Bookings List -->
        <div id="bookingsList" class="mb-4">
            <!-- Booking items will be dynamically loaded here -->
        </div>

        <!-- Pagination Controls -->
        <div class="flex justify-between items-center">
            <button id="prevPage" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg disabled:opacity-50" disabled>
                Previous
            </button>
            <span id="currentPage" class="text-gray-700">Page 1</span>
            <button id="nextPage" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg disabled:opacity-50">
                Next
            </button>
        </div>

        <!-- Close Button -->
        <button id="closeModalBtn" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg mt-4 w-full">
            Close
        </button>
    </div>
</div>




@endsection

<script>
document.addEventListener("DOMContentLoaded", function () {
    const seeBookingsBtn = document.querySelectorAll("#seeBookingsBtn");
    const bookingsModal = document.getElementById("bookingsModal");
    const closeModalBtn = document.getElementById("closeModalBtn");
    const bookingsList = document.getElementById("bookingsList");
    const eventTitle = document.getElementById("eventTitle");
    const prevPageBtn = document.getElementById("prevPage");
    const nextPageBtn = document.getElementById("nextPage");
    const currentPageSpan = document.getElementById("currentPage");

    let currentPage = 1;
    const itemsPerPage = 5;
    let bookings = [];

    // Fetch and render bookings for the selected event
    const renderBookings = () => {
        bookingsList.innerHTML = "";

        // Calculate start and end index for the current page
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = Math.min(startIndex + itemsPerPage, bookings.length);

        // Check if there are any bookings
        if (bookings.length > 0) {
            for (let i = startIndex; i < endIndex; i++) {
                const booking = bookings[i];

                // Create a booking card
                const bookingItem = document.createElement("div");
                bookingItem.classList.add(
                    "mb-4",
                    "p-4",
                    "border",
                    "border-gray-300",
                    "rounded-lg",
                    "shadow-sm"
                );
                bookingItem.innerHTML = `
                    <p><strong>Name:</strong> ${booking.user_name}</p>
                    <p><strong>Email:</strong> ${booking.user_email}</p>
                    <p><strong>Phone:</strong> ${booking.tickets_booked}</p>
                    <p><strong>Booked On:</strong> ${new Date(
                        booking.created_at
                    ).toLocaleString()}</p>
                `;
                bookingsList.appendChild(bookingItem);
            }
        } else {
            bookingsList.innerHTML = "<p>No bookings yet for this event.</p>";
        }

        // Update pagination controls
        currentPageSpan.textContent = `Page ${currentPage}`;
        prevPageBtn.disabled = currentPage === 1;
        nextPageBtn.disabled = endIndex >= bookings.length;
    };

    // Event listener for "See Bookings" button
    seeBookingsBtn.forEach((button) => {
        button.addEventListener("click", function () {
            const eventId = this.getAttribute("data-event-id");

            // Show the modal
            bookingsModal.classList.remove("hidden");

            // Fetch bookings for the event
            fetch(`/events/${eventId}/bookings`)
                .then((response) => response.json())
                .then((data) => {
                    bookings = data.bookings || [];
                    currentPage = 1;

                    // Update the modal title with the event name
                    eventTitle.textContent = `Bookings for Event: ${data.event.title}`;

                    // Render bookings for the first page
                    renderBookings();
                })
                .catch((error) => {
                    console.error("Error fetching bookings:", error);
                    bookingsList.innerHTML =
                        "<p>Error loading bookings. Please try again later.</p>";
                });
        });
    });

    // Close the modal
    closeModalBtn.addEventListener("click", function () {
        bookingsModal.classList.add("hidden");
    });

    // Pagination controls
    prevPageBtn.addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            renderBookings();
        }
    });

    nextPageBtn.addEventListener("click", () => {
        if (currentPage * itemsPerPage < bookings.length) {
            currentPage++;
            renderBookings();
        }
    });
});

</script>