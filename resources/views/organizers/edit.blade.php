@extends('layouts.app')

@section('title', 'Edit Organizer')

@section('content')
    <h2>Edit Organizer</h2>

    <form action="{{ route('organizers.update', $organizer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Organizer Name</label>
            <input type="text" class="form-control" name="name" value="{{ $organizer->name }}" required>
        </div>

        <div class="mb-3">
            <label for="facebook_link" class="form-label">Facebook URL</label>
            <input type="url" class="form-control" name="facebook_link" value="{{ $organizer->facebook_link }}">
        </div>

        <div class="mb-3">
            <label for="x_link" class="form-label">X (Twitter) URL</label>
            <input type="url" class="form-control" name="x_link" value="{{ $organizer->x_link }}">
        </div>

        <div class="mb-3">
            <label for="website_link" class="form-label">Website URL</label>
            <input type="url" class="form-control" name="website_link" value="{{ $organizer->website_link }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">About the Organizer</label>
            <textarea class="form-control" name="description" rows="4">{{ $organizer->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Organizer</button>
        <a href="{{ route('organizers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection

