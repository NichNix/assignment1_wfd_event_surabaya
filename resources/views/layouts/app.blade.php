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

        .navbar {
            background: linear-gradient(135deg, #6e7bff, #9b4dff);
            border-radius: 10px 10px 0 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: sticky; /* Make the navbar sticky */
            top: 0; /* Stick to the top of the viewport */
            z-index: 1030; /* Ensure it stays above other content */
        }

        .navbar-brand {
            font-size: 1.75rem;
            font-weight: bold;
            color: #fff !important;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: #fff !important;
        }

        .navbar-nav .nav-link:hover {
            color: #ffd700 !important;
        }

        .dropdown-menu {
            background-color: #fff;
            border-radius: 5px;
            border: 1px solid #ddd;
            left: auto !important;
            right: 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            font-weight: 500;
            color: #333;
        }

        .dropdown-item:hover {
            background-color: #f1f1f1;
        }

        .container {
            margin-top: 40px;
        }

        footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 0 0 10px 10px;
            position: relative;
        }

        footer p {
            margin: 0;
        }

        .navbar-toggler {
            border-color: #fff;
        }

        .navbar-toggler-icon {
            background-color: #fff;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand " href="{{ url('/') }}">Eventku</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth('admin')
                    <!-- Admin Dropdown if logged in -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Master Data
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('categories.index') }}">Master Event Category</a></li>
                            <li><a class="dropdown-item" href="{{ route('organizers.index') }}">Master Organizer</a></li>
                            <li><a class="dropdown-item" href="{{ route('events.masterIndex') }}">Master Event</a></li>
                            <li><a href="{{ route('bookings.index') }}" class="dropdown-item">Manage Bookings</a></li>
                        </ul>
                    </li>
                    <!-- Logout Form for Admin -->
                    <li class="nav-item">
                        <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link" style="color: white;">Logout</button>
                        </form>
                    </li>
                @else
                    <!-- Login Link if not logged in -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login') }}">Admin Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

    <!-- Content -->
    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
