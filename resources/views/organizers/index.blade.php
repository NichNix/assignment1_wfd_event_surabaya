@extends('layouts.app')

@section('title', 'Organizers')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Organizers</h2>
        <a href="{{ route('organizers.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Create Organizer</a>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg mt-4">
            <table class="w-full text-sm text-left bg-white border border-gray-200">
                <thead class="text-xs text-gray-700 uppercase bg-white ">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            No
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Organizer Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            About
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($organizers as $organizer)
                        <tr class="bg-white border-b ">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration }}
                            </th>
                            <td class="py-4 px-6">
                                <a href="{{ route('organizers.show', $organizer->id) }}" class="text-blue-500 hover:underline">{{ $organizer->name }}</a>
                            </td>
                            <td class="py-4 px-6">
                                {{ $organizer->description }}
                            </td>
                            <td class="py-4 px-6">
                                <a href="{{ route('organizers.edit', $organizer->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">Edit</a>
                                <form action="{{ route('organizers.destroy', $organizer->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
