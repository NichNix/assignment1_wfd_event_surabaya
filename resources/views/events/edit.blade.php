@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<h2>Edit Event</h2>

<form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="title" class="form-label">Event Name</label>
        <input type="text" class="form-control" name="title" value="{{ old('title', $event->title) }}" required>
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" name="date" value="{{ old('date', $event->date) }}" required>
    </div>

    <div class="mb-3">
        <label for="venue" class="form-label">Location</label>
        <input type="text" class="form-control" name="venue" value="{{ old('venue', $event->venue) }}" required>
    </div>

    <div class="mb-3">
        <label for="organizer_id" class="form-label">Organizer</label>
        <select name="organizer_id" class="form-select" required>
            @foreach($organizers as $organizer)
            <option value="{{ $organizer->id }}" {{ $event->organizer_id == $organizer->id ? 'selected' : '' }}>{{ $organizer->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="event_category_id" class="form-label">Event Category</label>
        <select name="event_category_id" class="form-select" required>
            @foreach($eventCategories as $category)
            <option value="{{ $category->id }}" {{ $event->event_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="start_time" class="form-label">Start Time</label>
        <input type="time" class="form-control" name="start_time" value="{{ old('start_time', $event->start_time) }}" required>
    </div>

    <div class="mb-3">
        <label for="end_time" class="form-label">End Time</label>
        <input type="time" class="form-control" name="end_time" value="{{ old('end_time', $event->end_time) }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">About the Event</label>
        <textarea class="form-control" name="description" rows="4">{{ old('description', $event->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="booking_url" class="form-label">Booking URL</label>
        <input type="url" class="form-control" name="booking_url" value="{{ old('booking_url', $event->booking_url) }}">
    </div>

    <div class="mb-3">
        <label for="max_tickets" class="form-label">Maximum Tickets</label>
        <input type="number" class="form-control" name="max_tickets" value="{{ old('max_tickets', $event->max_tickets) }}" required>
    </div>

    <div class="mb-3">
        <label for="sold_tickets" class="form-label">Sold Tickets</label>
        <input type="number" class="form-control" name="sold_tickets" value="{{ old('sold_tickets', $event->sold_tickets) }}" required>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Event Status</label>
        <select name="status" class="form-select" required>
            <option value="available" {{ $event->status == 'available' ? 'selected' : '' }}>Available</option>
            <option value="sold-out" {{ $event->status == 'sold-out' ? 'selected' : '' }}>Sold Out</option>
            <option value="cancelled" {{ $event->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Event Image</label>
        <input type="file" class="form-control" name="image">
        @if($event->image)
        <p>Current Image:</p>
        <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" class="img-fluid" style="max-width: 100%; max-height: 100%; object-fit: contain;">
        @endif
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Ticket Price</label>
        <input type="number" class="form-control" name="price" value="{{ old('price', $event->price) }}" required>
    </div>

    <div class="mb-3">
        <label for="province_id" class="form-label">Province</label>
        <select name="province_id" class="form-select" id="province" required>
            @foreach($provinces as $province)
            <option value="{{ $province->id }}" {{ $event->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="regency_id" class="form-label">Regency</label>
        <select name="regency_id" class="form-select" id="regency" required>
            <option value="{{ $event->regency_id }}">{{ $event->regency ? $event->regency->name : 'Select Regency' }}</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Event</button>
    <a href="{{ route('events.masterIndex') }}" class="btn btn-secondary">Cancel</a>
</form>

<script>
    // When the province changes, fetch related regencies
    document.getElementById('province').addEventListener('change', function() {
        var provinceId = this.value;
        var regencySelect = document.getElementById('regency');

        if (provinceId) {
            fetch(`/api/regencies/${provinceId}`)
                .then(response => response.json())
                .then(data => {
                    regencySelect.innerHTML = '<option value="">Select Regency</option>';
                    data.forEach(function(regency) {
                        regencySelect.innerHTML += `<option value="${regency.id}">${regency.name}</option>`;
                    });
                });
        } else {
            regencySelect.innerHTML = '<option value="">Select Regency</option>';
        }
    });
</script>

@endsection
