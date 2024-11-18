@extends('layouts.app')

@section('title', 'Edit Booking')

@section('content')
<div class="container mt-5">

    <h2 class="text-center mb-4">Edit Booking</h2>

    @if(auth()->guard('admin')->check())  <!-- Check if the user is an authenticated admin -->
    
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

        <!-- Booking Edit Form -->
        <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- HTTP method override for PUT request -->

            <!-- Name -->
            <div class="mb-3">
                <label for="nama" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $booking->nama }}" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Your Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $booking->email }}" required>
            </div>

            <!-- Address -->
            <div class="mb-3">
                <label for="alamat" class="form-label">Your Address</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $booking->alamat }}" required>
            </div>

            <!-- Phone Number -->
            <div class="mb-3">
                <label for="nomor_hp" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="{{ $booking->nomor_hp }}" required>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">Update Booking</button>
            </div>
        </form>
    
    @else
        <!-- If not an admin, show a message -->
        <div class="alert alert-danger">
            You do not have permission to edit this booking.
        </div>
    @endif

</div>
@endsection
