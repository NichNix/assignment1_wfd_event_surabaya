@extends('layouts.app')

@section('title', 'Organizers')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Organizers</h2>
        <a href="{{ route('organizers.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Create Organizer</a>
        <div class="mt-6 overflow-x-auto shadow-md rounded-lg">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-800">
                        <th class="py-2 px-4 text-left">No</th>
                        <th class="py-2 px-4 text-left">Organizer Name</th>
                        <th class="py-2 px-4 text-left">About</th>
                        <th class="py-2 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($organizers as $organizer)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4">
                                <a href="{{ route('organizers.show', $organizer->id) }}" class="text-blue-500 hover:underline">{{ $organizer->name }}</a>
                            </td>
                            <td class="py-2 px-4">
                                {{ $organizer->description }}
                            </td>
                            <td class="py-2 px-4">
                                <a href="{{ route('organizers.edit', $organizer->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded mr-2">Edit</a>
                                <form action="{{ route('organizers.destroy', $organizer->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded mt-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
