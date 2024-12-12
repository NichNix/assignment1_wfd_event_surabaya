@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="container mx-auto mt-10">
    <div class="max-w-sm mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Organizer Login</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">
                    @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span><br>
                    @endforeach
                </span>
            </div>
        @endif

        <form action="{{ route('organizer.login') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" name="email" id="email" class="shadow-sm appearance-none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('email') }}" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" name="password" id="password" class="shadow-sm appearance-none border border-gray-300 rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div class="flex items-center justify-center">
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
