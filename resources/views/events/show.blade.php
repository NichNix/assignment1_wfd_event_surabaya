@extends('layouts.app')

@section('title', $event->title)

@section('content')
    <h2>{{ $event->title }}</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="img-placeholder" style="width:100%; height:300px; border:1px solid #000;"></div>
        </div>
        <div class="col-md-6">
            <p><strong>Organizer:</strong> {{ $event->organizer->name }}</p>
            <p><strong>Date and Time:</strong> {{ $event->date }} at {{ $event->start_time }}</p>
            <p><strong>Location:</strong> {{ $event->venue }}</p>
            <p><strong>About:</strong> {{ $event->description }}</p>
            <p><strong>Tags:</strong> {{ $event->tags }}</p>
            <a href="{{ $event->booking_url }}" class="btn btn-primary">Book Now</a>
        </div>
    </div>
@endsection

