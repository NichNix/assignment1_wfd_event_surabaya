@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
<div class="container mx-auto p-4">
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

    <h2 class="text-2xl font-bold mb-4">Edit Event</h2>

    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">Event Name</label>
            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="title" value="{{ old('title', $event->title) }}" required>
        </div>

        <div class="mb-4">
            <label for="date" class="block text-gray-700 font-bold mb-2">Date</label>
            <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="date" value="{{ old('date', $event->date) }}" required>
        </div>

        <div class="mb-4">
            <label for="venue" class="block text-gray-700 font-bold mb-2">Location</label>
            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="venue" value="{{ old('venue', $event->venue) }}" required>
        </div>

        <div class="mb-4">
            <label for="organizer_id" class="block text-gray-700 font-bold mb-2">Organizer</label>
            <select name="organizer_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @foreach($organizers as $organizer)
                <option value="{{ $organizer->id }}" {{ $event->organizer_id == $organizer->id ? 'selected' : '' }}>{{ $organizer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="event_category_id" class="block text-gray-700 font-bold mb-2">Event Category</label>
            <select name="event_category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @foreach($eventCategories as $category)
                <option value="{{ $category->id }}" {{ $event->event_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="start_time" class="block text-gray-700 font-bold mb-2">Start Time</label>
            <input type="time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="start_time" value="{{ old('start_time', $event->start_time) }}" required>
        </div>

        <div class="mb-4">
            <label for="end_time" class="block text-gray-700 font-bold mb-2">End Time</label>
            <input type="time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="end_time" value="{{ old('end_time', $event->end_time) }}" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">About the Event</label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="description" rows="4">{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="booking_url" class="block text-gray-700 font-bold mb-2">Booking URL</label>
            <input type="url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="booking_url" value="{{ old('booking_url', $event->booking_url) }}">
        </div>

        <div class="mb-4">
            <label for="max_tickets" class="block text-gray-700 font-bold mb-2">Maximum Tickets</label>
            <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="max_tickets" value="{{ old('max_tickets', $event->max_tickets) }}" required>
        </div>

        <div class="mb-4">
            <label for="sold_tickets" class="block text-gray-700 font-bold mb-2">Sold Tickets</label>
            <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="sold_tickets" value="{{ old('sold_tickets', $event->sold_tickets) }}" required>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-gray-700 font-bold mb-2">Event Status</label>
            <select name="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="available" {{ $event->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="sold-out" {{ $event->status == 'sold-out' ? 'selected' : '' }}>Sold Out</option>
                <option value="cancelled" {{ $event->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-bold mb-2">Event Image</label>
            <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="image">
            @if($event->image)
            <p class="mt-2">Current Image:</p>
            <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" class="img-fluid max-w-full max-h-full object-contain">
            @endif
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-bold mb-2">Ticket Price</label>
            <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="price" value="{{ old('price', $event->price) }}" required>
        </div>

        <div class="mb-4">
            <label for="province_id" class="block text-gray-700 font-bold mb-2">Province</label>
            <select name="province_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="province" required>
                @foreach($provinces as $province)
                <option value="{{ $province->id }}" {{ $event->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="regency_id" class="block text-gray-700 font-bold mb-2">Regency</label>
            <select name="regency_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="regency" required>
                <option value="{{ $event->regency_id }}">{{ $event->regency ? $event->regency->name : 'Select Regency' }}</option>
            </select>
        </div>

        <div class="flex justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Event</button>
            <a href="{{ route('events.masterIndex') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancel</a>
        </div>
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
</div>
@endsection
