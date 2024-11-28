@extends('layouts.app')

@section('title', 'Master Bookings')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Master Bookings</h1>

    <div class="overflow-x-auto shadow-md rounded-lg">
        <table class="w-full table-auto bg-white">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Event</th>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Address</th>
                    <th class="px-4 py-2 text-left">Phone Number</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2">{{ $booking->id }}</td>
                        <td class="px-4 py-2">
                            @if ($booking->event)
                                {{ $booking->event->title }}
                            @else
                                No event found
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $booking->nama }}</td>
                        <td class="px-4 py-2">{{ $booking->alamat }}</td>
                        <td class="px-4 py-2">{{ $booking->nomor_hp }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
