@extends('layouts.app')

@section('title', 'Event Booking')

@section('content')

<div class="container mt-5">

    <!-- Page Title -->
    <h2 class="text-center mb-4">Book Your Event: {{ $event->title }}</h2>
    <p class="text-center mb-4"><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</p>
    <p class="text-center mb-4"><strong>Location:</strong> {{ $event->location }}</p>

    <!-- Display Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Booking Form -->
    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_event" value="{{ $event->id }}">

        <!-- Name -->
        <div class="mb-3">
            <label for="nama" class="form-label">Your Name</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Your Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <!-- Address -->
        <div class="mb-3">
            <label for="alamat" class="form-label">Your Address</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>

        <!-- Phone Number -->
        <div class="mb-3">
            <label for="nomor_hp" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" required>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">Book Now</button>
            
        </div>
    </form>



</div>

@endsection
