@extends('layouts.app')

@section('title', 'Organizer Details')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-3xl font-bold mb-4">{{ $organizer->name }}</h2>

        <div class="mb-4">
            <p class="font-medium text-gray-700">Facebook:</p>
            @if($organizer->facebook_link)
                <a href="{{ $organizer->facebook_link }}" target="_blank" class="text-blue-500 hover:underline">{{ $organizer->facebook_link }}</a>
            @else
                <p class="text-gray-500">N/A</p>
            @endif
        </div>

        <div class="mb-4">
            <p class="font-medium text-gray-700">X (Twitter):</p>
            @if($organizer->x_link)
                <a href="{{ $organizer->x_link }}" target="_blank" class="text-blue-500 hover:underline">{{ $organizer->x_link }}</a>
            @else
                <p class="text-gray-500">N/A</p>
            @endif
        </div>

        <div class="mb-4">
            <p class="font-medium text-gray-700">Website:</p>
            @if($organizer->website_link)
                <a href="{{ $organizer->website_link }}" target="_blank" class="text-blue-500 hover:underline">{{ $organizer->website_link }}</a>
            @else
                <p class="text-gray-500">N/A</p>
            @endif
        </div>

        <div class="mb-4">
            <p class="font-medium text-gray-700">About the Organizer:</p>
            <p class="text-gray-800">{{ $organizer->description ?? 'N/A' }}</p>
        </div>

        <a href="{{ route('organizers.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Back to Organizers</a>
    </div>
@endsection
