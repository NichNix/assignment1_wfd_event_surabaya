@extends('layouts.app')

@section('title', 'Master Event')

@section('content')
    <h2>Master Event</h2>
    <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Create Event</a>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Event Name</th>
                <th>Date</th>
                <th>Location</th>
                <th>Organizer</th>
                <th>About</th>
                <th>Tags</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->date }}</td>
                    <td>{{ $event->venue }}</td>
                    <td>{{ $event->organizer->name ?? 'N/A' }}</td>
                    <td>{{ Str::limit($event->description, 50) }}</td>
                    <td>{{ $event->tags }}</td>
                    <td>
                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
