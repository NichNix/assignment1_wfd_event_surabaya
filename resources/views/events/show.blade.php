@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="container mx-auto mt-10">
    <h2 class="text-center text-2xl font-bold mb-6">
        {{ $event->title }} || {{ $event->status }}
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
        <!-- Image Section -->
        <div class="rounded shadow overflow-hidden flex justify-center items-center h-80">
            <img
                src="{{ asset(path: $event->image ?? 'assets/event/default.png') }}"
                alt="Event Image"
                class="w-full rounded-lg shadow-md">
        </div>

        <!-- Event Details -->
        <div class="p-4 bg-white shadow rounded-lg">
            <p class="mb-2"><strong>Organizer:</strong> {{ $event->organizer->name }}</p>
            <p class="mb-2">
                <strong>Date and Time:</strong>
                {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}
                at {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}
            </p>
            <p class="mb-2"><strong>Location:</strong> {{ $event->venue }}</p>

            <!-- Location with Province and Regency -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <p><strong>Province:</strong> {{ $event->province->name ?? 'Not Available' }}</p>
                </div>
                <div>
                    <p><strong>Kabupaten:</strong> {{ $event->regency->name ?? 'Not Available' }}</p>
                </div>
            </div>

            <p class="mb-4"><strong>About:</strong> {{ $event->description }}</p>

            <p class="mb-4">
                <strong>Category:</strong>
                @if($event->category)
                <span class="inline-block bg-blue-500 text-white text-sm py-1 px-3 rounded shadow">
                    {{ $event->category->name }}
                </span>
                @else
                <span class="text-red-500">No Category</span>
                @endif
            </p>

            <p class="mb-4">
                <strong>Price:</strong>
                @if($event->price)
                Rp.{{ number_format($event->price, 2) }}
                @else
                <span class="text-green-500">Free</span>
                @endif
            </p>

            <!-- Ticket Availability -->
            <p class="mb-6">
                <strong>Tickets:</strong>
                {{ $event->sold_tickets }} / {{ $event->max_tickets }} sold
                @if($event->sold_tickets < $event->max_tickets)
                    <span class="text-green-500">(Tickets Available)</span>
                    @else
                    <span class="text-red-500">(Sold Out)</span>
                    @endif
            </p>

            <!-- Booking Button -->
            @if($event->status === 'Selesai' || $event->status === 'Sedang berlangsung' || $event->sold_tickets >= $event->max_tickets)
            <button
                class="w-full py-3 px-6 bg-gray-400 text-white font-semibold text-lg rounded-lg cursor-not-allowed opacity-60 hover:bg-gray-500 transition-all duration-300 ease-in-out"
                disabled>
                No Booking Available
            </button>
            @else
            <a
                href="{{ route('bookings.create', ['event_id' => $event->id]) }}"
                class="w-full py-3 px-6 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-lg rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105">
                Book Now
            </a>

            @endif
        </div>
    </div>
</div>
@endsection