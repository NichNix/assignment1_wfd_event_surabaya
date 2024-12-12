@extends('layouts.app')

@section('title', 'Event Booking')

@section('content')

<div class="container mx-auto mt-10 px-4">

    <!-- Page Title -->
    <h2 class="text-3xl font-bold text-center mb-6">Book Your Event: {{ $event->title }}</h2>
    <p class="text-center text-gray-600 mb-2"><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</p>
    <p class="text-center text-gray-600 mb-6"><strong>Location:</strong> {{ $event->venue }}</p>

    <!-- Display Errors -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Booking Form -->
    <form action="{{ route('bookings.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <input type="hidden" name="id_event" value="{{ $event->id }}">

        <!-- Name -->
        <div class="mb-4">
            <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Your Name</label>
            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama" name="nama" required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Your Email</label>
            <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" required>
        </div>

        <!-- Address -->
        <div class="mb-4">
            <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Your Address</label>
            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="alamat" name="alamat" required>
        </div>

        <!-- Phone Number -->
        <div class="mb-4">
            <label for="nomor_hp" class="block text-gray-700 text-sm font-bold mb-2">Phone Number</label>
            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nomor_hp" name="nomor_hp" required>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Book Now</button>
        </div>
    </form>
</div>

@endsection
