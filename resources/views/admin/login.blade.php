@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Admin Login</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-lg">Login</button>
        </div>
    </form>
</div>
@endsection
