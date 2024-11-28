@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
    <div class="container mx-auto p-4">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <ul>
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-bold mb-2">Event Name</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="date" class="block text-gray-700 font-bold mb-2">Date</label>
                    <input type="date" id="date" name="date" value="{{ old('date', $event->date) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="venue" class="block text-gray-700 font-bold mb-2">Location</label>
                    <input type="text" id="venue" name="venue" value="{{ old('venue', $event->venue) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="organizer_id" class="block text-gray-700 font-bold mb-2">Organizer</label>
                    <select name="organizer_id" id="organizer_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        @foreach($organizers as $organizer)
                            <option value="{{ $organizer->id }}" {{ $event->organizer_id == $organizer->id ? 'selected' : '' }}>{{ $organizer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="event_category_id" class="block text-gray-700 font-bold mb-2">Event Category</label>
                    <select name="event_category_id" id="event_category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        @foreach($eventCategories as $category)
                            <option value="{{ $category->id }}" {{ $event->event_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="start_time" class="block text-gray-700 font-bold mb-2">Start Time</label>
                    <input type="time" id="start_time" name="start_time" value="{{ old('start_time', $event->start_time) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="end_time" class="block text-gray-700 font-bold mb-2">End Time</label>
                    <input type="time" id="end_time" name="end_time" value="{{ old('end_time', $event->end_time) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold mb-2">About the Event</label>
                    <textarea id="description" name="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description', $event->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="booking_url" class="block text-gray-700 font-bold mb-2">Booking URL</label>
                    <input type="url" id="booking_url" name="booking_url" value="{{ old('booking_url', $event->booking_url) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-4">
                    <label for="max_tickets" class="block text-gray-700 font-bold mb-2">Maximum Tickets</label>
                    <input type="number" id="max_tickets" name="max_tickets" value="{{ old('max_tickets', $event->max_tickets) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="sold_tickets" class="block text-gray-700 font-bold mb-2">Sold Tickets</label>
                    <input type="number" id="sold_tickets" name="sold_tickets" value="{{ old('sold_tickets', $event->sold_tickets) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-gray-700 font-bold mb-2">Event Status</label>
                    <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="available" {{ $event->status == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="sold-out" {{ $event->status == 'sold-out' ? 'selected' : '' }}>Sold Out</option>
                        <option value="cancelled" {{ $event->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-bold mb-2">Event Image</label>
                    <input type="file" id="image" name="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @if($event->image)
                        <p class="mt-2">Current Image:</p>
                        <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" class="img-fluid max-w-full max-h-48 object-contain">
                    @endif
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-bold mb-2">Ticket Price</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $event->price) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="province_id" class="block text-gray-700 font-bold mb-2">Province</label>
                    <select name="province_id" id="province" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        @foreach($provinces as $province)
                            <option value="{{ $province->id }}" {{ $event->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="regency_id" class="block text-gray-700 font-bold mb-2">Regency</label>
                    <select name="regency_id" id="regency" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="{{ $event->regency_id }}">{{ $event->regency ? $event->regency->name : 'Select Regency' }}</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Event</button>
                <a href="{{ route('events.masterIndex') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">Cancel</a>
            </div>
        </form>

        <script>
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
