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
            <div class="md:grid md:grid-cols-2 md:gap-6">
                <div class="mb-3">
                    <label for="title" class="block text-gray-700 font-bold mb-2">Event Name</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="title" value="{{ old('title', $event->title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="date" class="block text-gray-700 font-bold mb-2">Date</label>
                    <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="date" value="{{ old('date', $event->date) }}" required>
                </div>

                <div class="mb-3">
                    <label for="start_time" class="block text-gray-700 font-bold mb-2">Start Time</label>
                    <input type="time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="start_time" value="{{ old('start_time', $event->start_time) }}" required>
                </div>

                <div class="mb-3">
                    <label for="venue" class="block text-gray-700 font-bold mb-2">Location</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="venue" value="{{ old('venue', $event->venue) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="description" rows="5" required>{{ old('description', $event->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="organizer_id" class="block text-gray-700 font-bold mb-2">Organizer</label>
                    <select name="organizer_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        @foreach($organizers as $organizer)
                            <option value="{{ $organizer->id }}" {{ $event->organizer_id == $organizer->id ? 'selected' : '' }}>{{ $organizer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="block text-gray-700 font-bold mb-2">Category</label>
                    <select name="category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        @foreach($eventCategories as $category)
                            <option value="{{ $category->id }}" {{ $event->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tags" class="block text-gray-700 font-bold mb-2">Tags</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="tags" value="{{ old('tags', $event->tags) }}" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="block text-gray-700 font-bold mb-2">Image</label>
                    <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="image">
                </div>

                <div class="mb-3">
                    <label for="price" class="block text-gray-700 font-bold mb-2">Price</label>
                    <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="price" value="{{ old('price', $event->price) }}" required>
                </div>

                <div class="mb-3">
                    <label for="max_tickets" class="block text-gray-700 font-bold mb-2">Max Tickets</label>
                    <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="max_tickets" value="{{ old('max_tickets', $event->max_tickets) }}" required>
                </div>

                <div class="mb-3">
                    <label for="province_id" class="block text-gray-700 font-bold mb-2">Province</label>
                    <select name="province_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @foreach($provinces as $province)
                            <option value="{{ $province->id }}" {{ $event->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="regency_id" class="block text-gray-700 font-bold mb-2">Regency</label>
                    <select name="regency_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @foreach($regencies as $regency)
                            <option value="{{ $regency->id }}" {{ $event->regency_id == $regency->id ? 'selected' : '' }}>{{ $regency->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Event</button>
                <a href="{{ route('events.masterIndex') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">Cancel</a>
            </div>
        </form>
    </div>
@endsection
