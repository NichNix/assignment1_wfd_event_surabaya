@extends('layouts.app')

@section('title', 'Edit Booking')

@section('content')
<div class="container mx-auto mt-5 p-4">

    <h2 class="text-2xl font-bold text-center mb-4">Edit Booking</h2>

    @if(auth()->guard('admin')->check())
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <!-- Display Errors -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <ul class="mt-1 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Booking Edit Form -->
            <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="nama" class="block text-gray-700 font-bold mb-2">Your Name</label>
                        <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama" name="nama" value="{{ $booking->nama }}" required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-gray-700 font-bold mb-2">Your Email</label>
                        <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" value="{{ $booking->email }}" required>
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="alamat" class="block text-gray-700 font-bold mb-2">Your Address</label>
                        <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="alamat" name="alamat" value="{{ $booking->alamat }}" required>
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="nomor_hp" class="block text-gray-700 font-bold mb-2">Phone Number</label>
                        <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nomor_hp" name="nomor_hp" value="{{ $booking->nomor_hp }}" required>
                    </div>
                </div>

                <div class="flex justify-center mt-6">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Update Booking
                    </button>
                </div>
            </form>
        </div>
    @else
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">You do not have permission to edit this booking.</span>
        </div>
    @endif

</div>
@endsection
