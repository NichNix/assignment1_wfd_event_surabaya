@extends('layouts.app')

@section('title', 'Organizer Details')

@section('content')
    <h2>{{ $organizer->name }}</h2>

    <p><strong>Facebook:</strong> 
        @if($organizer->facebook_link)
            <a href="{{ $organizer->facebook_link }}" target="_blank">{{ $organizer->facebook_link }}</a>
        @else
            N/A
        @endif
    </p>

    <p><strong>X (Twitter):</strong> 
        @if($organizer->x_link)
            <a href="{{ $organizer->x_link }}" target="_blank">{{ $organizer->x_link }}</a>
        @else
            N/A
        @endif
    </p>

    <p><strong>Website:</strong> 
        @if($organizer->website_link)
            <a href="{{ $organizer->website_link }}" target="_blank">{{ $organizer->website_link }}</a>
        @else
            N/A
        @endif
    </p>

    <p><strong>About the Organizer:</strong> {{ $organizer->description ?? 'N/A' }}</p>

    <a href="{{ route('organizers.index') }}" class="btn btn-secondary">Back to Organizers</a>
@endsection

