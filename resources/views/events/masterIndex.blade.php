@extends('layouts.app')

@section('title', 'Master Event')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Master Event</h2>
        <a href="{{ route('events.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Event</a>

        <div class="mt-6 overflow-x-auto shadow-md rounded-lg">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-800">
                        <th class="py-2 px-4 text-left">No</th>
                        <th class="py-2 px-4 text-left">Event Name</th>
                        <th class="py-2 px-4 text-left">Date</th>
                        <th class="py-2 px-4 text-left">Location</th>
                        <th class="py-2 px-4 text-left">Organizer</th>
                        <th class="py-2 px-4 text-left">About</th>
                        <th class="py-2 px-4 text-left">Tags</th>
                        <th class="py-2 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4">{{ $event->title }}</td>
                            <td class="py-2 px-4">{{ $event->date }}</td>
                            <td class="py-2 px-4">{{ $event->venue }}</td>
                            <td class="py-2 px-4">{{ $event->organizer->name ?? 'N/A' }}</td>
                            <td class="py-2 px-4">{{ Str::limit($event->description, 50) }}</td>
                            <td class="py-2 px-4">{{ $event->tags }}</td>
                            <td class="py-2 px-4">
                                <a href="{{ route('events.edit', $event->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded">Edit</a>
                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
