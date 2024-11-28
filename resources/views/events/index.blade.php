@extends('layouts.app')

@section('title', 'Events in Surabaya')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4 text-uppercase font-weight-bold" style="font-family: 'Poppins', sans-serif; color: #4e73df;">Upcoming Events in Indonesia</h2>
    <p class="text-center mb-5" style="font-family: 'Lora', serif; color: #555; font-size: 1.2rem;">Discover exciting events happening all across Indonesia! Find what interests you and make plans to join!</p>

    <!-- Filter Section -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-10 col-lg-8">
            <form action="{{ route('events.index') }}" method="GET" class="d-flex flex-wrap gap-2">
                <!-- Province Dropdown -->
                <select id="province" name="province" class="form-control custom-select mb-2 mb-md-0">
                    <option value="">Select Province</option>
                    @foreach($provinces as $province)
                    <option value="{{ $province->id }}" {{ request('province') == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                    @endforeach
                </select>

                <!-- Regency Dropdown -->
                <select id="regency" name="regency" class="form-control custom-select mb-2 mb-md-0">
                    <option value="">Select Regency</option>
                    @if(request('province') && $regencies)
                    @foreach($regencies as $regency)
                    <option value="{{ $regency->id }}" {{ request('regency') == $regency->id ? 'selected' : '' }}>{{ $regency->name }}</option>
                    @endforeach
                    @endif
                </select>

                <!-- Category Dropdown -->
                <select name="category" class="form-control custom-select mb-2 mb-md-0">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>

                <!-- Filter Button -->
                <button type="submit" class="btn btn-gradient">Filter</button>
            </form>
        </div>
    </div>
    <!-- Events Listing -->
    <div class="row">
        @foreach($events as $event)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="event-box">
                <div class="p-3">
                    <h3 class="event-title">{{ $event->title}} || {{ $event->status }}</h3>
                    <p class="event-location">
                        <i class="fas fa-map-marker-alt"></i> {{ $event->venue }}, {{ $event->regency->name }}, {{ $event->province->name }}
                    </p>
                    <p><i class="fas fa-calendar-alt"></i> {{ $event->date }}</p>
                    <p><i class="fas fa-clock"></i> {{ $event->start_time }}</p>
                    <p><i class="fas fa-tag"></i> {{ $event->category->name }}</p>
                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary mt-3">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .event-box {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .event-box:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }

    .event-image {
        height: 180px;
        background-size: cover;
        background-position: center;
    }

    .event-title {
        font-size: 1.5rem;
        color: #4e73df;
        font-weight: bold;
        margin-bottom: 10px;
        font-family: 'Roboto', sans-serif;
    }

    .event-location,
    .event-box p {
        font-size: 0.9rem;
        color: #555;
    }

    .btn-primary {
        background-color: #4e73df;
        border: none;
        padding: 10px 20px;
        font-weight: bold;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #375acb;
        transform: scale(1.05);
    }

    .btn-gradient {
        background: linear-gradient(45deg, #ff6f61, #ff6347);
        color: white;
        padding: 10px 20px;
        font-weight: 600;
        border-radius: 5px;
        transition: background 0.3s ease, transform 0.3s ease;
    }

    .btn-gradient:hover {
        background: linear-gradient(45deg, #ff6347, #ff6f61);
        transform: scale(1.05);
    }
</style>

<script>
    // When the province changes, fetch related regencies
    document.addEventListener('DOMContentLoaded', function() {
        // When the province changes, fetch related regencies
        document.getElementById('province').addEventListener('change', function() {
            var provinceId = this.value;
            var regencySelect = document.getElementById('regency');

            // Clear previous options
            regencySelect.innerHTML = '<option value="">Select Regency</option>';

            if (provinceId) {
                fetch(`/api/regencies/${provinceId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Populate regency dropdown
                        data.forEach(function(regency) {
                            regencySelect.innerHTML += `<option value="${regency.id}">${regency.name}</option>`;
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching regencies:', error);
                    });
            }
        });
    });
</script>

@endsection