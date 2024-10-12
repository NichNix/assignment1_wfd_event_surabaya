@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
    <h2>Edit Event</h2>

    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Event Title</label>
            <input type="text" class="form-control" name="title" value="{{ $event->title }}" required>
        </div>

        <div class="mb-3">
            <label for="venue" class="form-label">Venue</label>
            <input type="text" class="form-control" name="venue" value="{{ $event->venue }}" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" name="date" value="{{ $event->date }}" required>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="time" class="form-control" name="start_time" value="{{ $event->start_time }}" required>
        </div>

        <div class="mb-3">
            <label for="organizer_id" class="form-label">Organizer</label>
            <select name="organizer_id" class="form-select" required>
                @foreach($organizers as $organizer)
                    <option value="{{ $organizer->id }}" {{ $event->organizer_id == $organizer->id ? 'selected' : '' }}>
                        {{ $organizer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Event Description</label>
            <textarea class="form-control" name="description" rows="4" required>{{ $event->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <input type="text" class="form-control" name="tags" value="{{ $event->tags }}">
        </div>

        <div class="mb-3">
            <label for="booking_url" class="form-label">Booking URL</label>
            <input type="url" class="form-control" name="booking_url" value="{{ $event->booking_url }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Event</button>
        <a href="{{ route('events.masterIndex') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection

