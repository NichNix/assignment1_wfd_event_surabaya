@extends('layouts.app')

@section('title', 'Create Event')

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

<h2>Create New Event</h2>

<form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
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
        <label for="booking_url" class="form-label">Booking URL</label>
        <input type="url" class="form-control" name="booking_url">
    </div>

    <div class="mb-3">
        <label for="max_tickets" class="form-label">Maximum Tickets</label>
        <input type="number" class="form-control" name="max_tickets" required>
    </div>

    <div class="mb-3">
        <label for="sold_tickets" class="form-label">Sold Tickets</label>
        <input type="number" class="form-control" name="sold_tickets" value="0" required>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Event Status</label>
        <select name="status" class="form-select" required>
            <option value="available">Available</option>
            <option value="sold-out">Sold Out</option>
            <option value="cancelled">Cancelled</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Event Image</label>
        <input type="file" class="form-control" name="image">
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Ticket Price</label>
        <input type="number" class="form-control" name="price" required>
    </div>

    <div class="mb-3">
        <label for="province_id" class="form-label">Province</label>
        <select name="province_id" class="form-select" id="province" required>
            @foreach($provinces as $province)
            <option value="{{ $province->id }}">{{ $province->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="regency_id" class="form-label">Regency</label>
        <select name="regency_id" class="form-select" id="regency" required>
            <option value="">Select Regency</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Save Event</button>
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