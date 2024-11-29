@extends('layouts.app')

@section('title', 'Master Bookings')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Master Bookings</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('bookings.search') }}" class="mb-4">
        <div class="flex items-center">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name..." class="p-2 border rounded-l-md focus:outline-none">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white p-2 rounded-r-md focus:outline-none">Search</button>
        </div>
    </form>
 

    <div class="mt-6 overflow-x-auto shadow-md rounded-lg">
        <table class="w-full table-auto border-collapse">
            <thead class="bg-gray-200 text-gray-800">
                <tr>
                    <th class="py-2 px-4 text-left">ID</th>
                    <th class="py-2 px-4 text-left">Event</th>
                    <th class="py-2 px-4 text-left">Name</th>
                    <th class="py-2 px-4 text-left">Address</th>
                    <th class="py-2 px-4 text-left">Phone Number</th>
                    <th class="py-2 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4">{{ $booking->id }}</td>
                        <td class="py-2 px-4">
                            @if ($booking->event)
                                {{ $booking->event->title }}
                            @else
                                No event found
                            @endif
                        </td>
                        <td class="py-2 px-4">{{ $booking->nama }}</td>
                        <td class="py-2 px-4">{{ $booking->alamat }}</td>
                        <td class="py-2 px-4">{{ $booking->nomor_hp }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
