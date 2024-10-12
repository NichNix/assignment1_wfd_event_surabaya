@extends('layouts.app')

@section('title', 'Create Event')

@section('content')
    <h2>Create New Event</h2>

    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Event Name</label>
            <input type="text" class="form-control" name="title" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" name="date" required>
        </div>

        <div class="mb-3">
            <label for="venue" class="form-label">Location</label>
            <input type="text" class="form-control" name="venue" required>
        </div>

        <div class="mb-3">
            <label for="organizer_id" class="form-label">Organizer</label>
            <select name="organizer_id" class="form-select" required>
                @foreach($organizers as $organizer)
                    <option value="{{ $organizer->id }}">{{ $organizer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="event_category_id" class="form-label">Event Category</label>
            <select name="event_category_id" class="form-select" required>
                @foreach($eventCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="time" class="form-control" name="start_time" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">About the Event</label>
            <textarea class="form-control" name="description" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <input type="text" class="form-control" name="tags">
        </div>

        <button type="submit" class="btn btn-primary">Save Event</button>
        <a href="{{ route('events.masterIndex') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
