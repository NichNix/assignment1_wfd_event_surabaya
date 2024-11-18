@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">{{ $event->title }} || {{ $event->status }} </h2>
    <div class="row g-4 align-items-center">
        <!-- Image Section -->
        <div class="col-md-6">
            <div class="border rounded shadow" style="overflow: hidden; height: 300px; display: flex; justify-content: center; align-items: center;">
                <img src="{{ asset($event->image) }}" alt="Event Image" class="img-fluid" style="max-width: 100%; max-height: 100%; object-fit: contain;">
            </div>
        </div>

        <!-- Event Details -->
        <div class="col-md-6">
            <div class="p-3">
                <p><strong>Organizer:</strong> {{ $event->organizer->name }}</p>
                <p><strong>Date and Time:</strong> {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }} at {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}</p>

                <!-- Location with Province and Regency -->
                <p><strong>Location:</strong> {{ $event->venue }}</p>

                <div class="row">
                    @if($event->province)
                    <div class="col-6">
                        <p><strong>Province:</strong> {{ $event->province->name }}</p>
                    </div>
                    @else
                    <div class="col-6">
                        <p><strong>Provinsi:</strong> Not Available</p>
                    </div>
                    @endif

                    @if($event->regency)
                    <div class="col-6">
                        <p><strong>kabupaten:</strong> {{ $event->regency->name }}</p>
                    </div>
                    @else
                    <div class="col-6">
                        <p><strong>kabupaten:</strong> Not Available</p>
                    </div>
                    @endif
                </div>

                <p><strong>About:</strong> {{ $event->description }}</p>
                <p class="mt-4 text-lg font-semibold">
                    <strong>Category:</strong>
                    @if($event->category)
                    <span class="badge bg-primary py-1 px-3 rounded-3 shadow-sm hover:bg-primary-subtle transition duration-300">
                        {{ $event->category->name }}
                    </span>
                    @else
                    <span class="text-danger fw-semibold">No Category</span>
                    @endif
                </p>

                <p><strong>Price:</strong>
                    @if($event->price)
                    Rp.{{ number_format($event->price, 2) }}
                    @else
                    <span class="text-success">Free</span>
                    @endif
                </p>

                <!-- Ticket Availability -->
                <p><strong>Tickets:</strong>
                    {{ $event->sold_tickets }} / {{ $event->max_tickets }} sold
                    @if($event->sold_tickets < $event->max_tickets)
                        <span class="text-success">(Tickets Available)</span>
                        @else
                        <span class="text-danger">(Sold Out)</span>
                        @endif
                </p>

                @if($event->status != 'Selesai' && $event->status != 'Sedang berlangsung' && $event->sold_tickets < $event->max_tickets)
                    <a href="{{ route('bookings.create', ['event_id' => $event->id]) }}" class="btn btn-primary w-100">Book Now</a>
                    @else
                    <button class="btn btn-secondary w-100" disabled>No Booking Available</button>
                    @endif




            </div>
        </div>
    </div>
</div>
@endsection