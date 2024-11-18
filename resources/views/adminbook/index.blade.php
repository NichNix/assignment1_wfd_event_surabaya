@extends('layouts.app')  <!-- Assuming you have a base layout -->

@section('title', 'Master Bookings')

@section('content')
<div class="container">
    <h1>Master Bookings</h1>
    
    <!-- Table for displaying bookings -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Event</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Nomor HP</th>
                <th>Actions</th> <!-- Add an Actions column -->
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>
                        @if ($booking->event) 
                            {{ $booking->event->title }}  <!-- Event name from related Event model -->
                        @else
                            No event found  <!-- If no related event exists -->
                        @endif
                    </td>
                    <td>{{ $booking->nama }}</td>
                    <td>{{ $booking->alamat }}</td>
                    <td>{{ $booking->nomor_hp }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
