<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EventApp')</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-b-lg shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <a class="text-3xl font-bold text-white" href="{{ url('/') }}">Eventku</a>
                <button class="lg:hidden text-white focus:outline-none" type="button">
                    <!-- Hamburger menu icon -->
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div class="hidden lg:flex space-x-6">
                    @auth('admin')
                        <!-- Admin Dropdown if logged in -->
                        <div class="relative inline-block text-left">
                            <button type="button" class="text-white font-medium hover:text-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400" id="options-menu" aria-haspopup="true" aria-expanded="true">
                                Master Data
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1" id="options-menu-list">
                                <a href="{{ route('categories.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Master Event Category</a>
                                <a href="{{ route('organizers.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Master Organizer</a>
                                <a href="{{ route('events.masterIndex') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Master Event</a>
                                <a href="{{ route('bookings.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Manage Bookings</a>
                            </div>
                        </div>
                        <!-- Logout Form for Admin -->
                        <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-white font-medium hover:text-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">Logout</button>
                        </form>
                    @else
                        <!-- Login Link if not logged in -->
                        <a href="{{ route('admin.login') }}" class="text-white font-medium hover:text-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400">Admin Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mx-auto mt-12">
        @yield('content')
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}
</body>
</html>
