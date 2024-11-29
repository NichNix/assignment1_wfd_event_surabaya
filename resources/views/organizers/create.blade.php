@extends('layouts.app')

@section('title', 'Create Organizer')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Create New Organizer</h2>
        <form action="{{ route('organizers.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Organizer Name</label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="name" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email Address</label>
                <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="email">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="password">
            </div>

            <div class="mb-4">
                <label for="facebook_link" class="block text-gray-700 font-bold mb-2">Facebook URL</label>
                <input type="url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="facebook_link">
            </div>

            <div class="mb-4">
                <label for="x_link" class="block text-gray-700 font-bold mb-2">X (Twitter) URL</label>
                <input type="url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="x_link">
            </div>

            <div class="mb-4">
                <label for="website_link" class="block text-gray-700 font-bold mb-2">Website URL</label>
                <input type="url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="website_link">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">About the Organizer</label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="description" rows="4"></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Save Organizer</button>
                <a href="{{ route('organizers.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Cancel</a>
            </div>
        </form>
    </div>
@endsection
