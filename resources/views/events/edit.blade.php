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
            <div class="mb-3">
                <label for="title" class="block text-gray-700 font-bold mb-2">Event Name</label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="title" value="{{ old('title', $event->title) }}" required>
            </div>

            <!-- ... rest of the form fields (date, venue, etc.) similarly styled ... -->
            <div class="mb-3">
                <label for="date" class="block text-gray-700 font-bold mb-2">Date</label>
                <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="date" value="{{ old('date', $event->date) }}" required>
            </div>

            <!-- ... remaining fields styled similarly ... -->

            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Event</button>
                <a href="{{ route('events.masterIndex') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">Cancel</a>
            </div>
        </form>
    </div>
@endsection
