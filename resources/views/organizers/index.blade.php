@extends('layouts.app')

@section('title', 'Organizers')

@section('content')
    <h2>Organizers</h2>
    <a href="{{ route('organizers.create') }}" class="btn btn-primary mb-3">Create Organizer</a>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Organizer Name</th>
                <th>About</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($organizers as $organizer)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('organizers.show', $organizer->id) }}">{{ $organizer->name }}</a>
                    </td>
                    <td>{{ $organizer->description }}</td>
                    <td>
                        <a href="{{ route('organizers.edit', $organizer->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('organizers.destroy', $organizer->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
