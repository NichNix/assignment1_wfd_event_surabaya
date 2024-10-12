@extends('layouts.app')

@section('title', 'Events in Surabaya')

@section('content')
    <h2>Events in Surabaya</h2>
    <p>Below is a list of upcoming events happening in Surabaya:</p>

    <div class="row">
        @foreach($events as $event)
            <div class="col-md-4">
                <div class="event-box" style="border: 1px solid #000; padding: 20px; margin-bottom: 20px;">
                    <h3>{{ $event->title }}</h3>
                    <p><strong>Location:</strong> {{ $event->venue }}</p>
                    <p><strong>Date:</strong> {{ $event->date }}</p>
                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        @endforeach
    </div>

    <style>
        
        .row {
            display: flex;
            flex-wrap: wrap;
        }
        .col-md-4 {
            width: 30%;
            margin-right: 5%;
        }
        .col-md-4:nth-child(3n) {
            margin-right: 0;
        }
        .event-box {
            text-align: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection
