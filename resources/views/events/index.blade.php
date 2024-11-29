@extends('layouts.app')

@section('title', 'Events in Surabaya')

@section('content')
<div class="container mx-auto my-5">
    <h2 class="text-center mb-4 text-3xl font-bold uppercase text-indigo-600">Upcoming Events in Indonesia</h2>
    <p class="text-center mb-5 text-gray-600 text-lg">Discover exciting events happening all across Indonesia! Find what interests you and make plans to join!</p>

    <!-- Filter Section -->
    <form action="{{ route('events.index') }}" method="GET">
        @csrf
        <div class="flex flex-col md:flex-row justify-center items-center mb-5 space-y-4 md:space-y-0 md:space-x-4">
            <div class="w-full md:w-1/3">
                <label for="province" class="block text-gray-700 font-bold mb-2">Province</label>
                <select id="province" name="province" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Select Province</option>
                    @foreach($provinces as $province)
                    <option value="{{ $province->id }}" {{ request('province') == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full md:w-1/3">
                <label for="regency" class="block text-gray-700 font-bold mb-2">Regency</label>
                <select id="regency" name="regency" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Select Regency</option>
                    @if(request('province') && $regencies)
                    @foreach($regencies as $regency)
                    <option value="{{ $regency->id }}" {{ request('regency') == $regency->id ? 'selected' : '' }}>{{ $regency->name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>

            <div class="w-full md:w-1/3">
                <label for="category" class="block text-gray-700 font-bold mb-2">Category</label>
                <select name="category" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-center items-center mb-5 space-y-4 md:space-y-0 md:space-x-4">
            <div class="w-full md:w-1/2">
                <label for="start_date" class="block text-gray-700 font-bold mb-2">Start Date</label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="w-full md:w-1/2">
                <label for="end_date" class="block text-gray-700 font-bold mb-2">End Date</label>
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
        </div>


        <div class="flex justify-center">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Filter</button>
        </div>
    </form>

    <!-- Events Listing -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
    @foreach($events as $event)
        <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-gray-200 hover:border-indigo-600">
            <div class="p-6">
                <!-- Event Title with Status -->
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-semibold text-indigo-600">
                        {{ $event->title }}
                    </h3>
                    <span class="text-sm font-medium px-3 py-1 rounded-full bg-indigo-100 text-indigo-600">
                        {{ $event->status }}
                    </span>
                </div>

<!-- Event Date and Time -->
<div class="mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-2">Event Date and Time</h3>
    <div class="flex items-center text-gray-600 text-sm mb-3">
    <span class="text-gray-800 text-lg font-semibold bg-gray-100 px-3 py-1 rounded-md mr-4">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</span>
    <span class="text-indigo-600 text-lg font-semibold">{{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}</span>
</div>

</div>

<!-- Event Location -->
<div class="mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-2">Event Location</h3>
    <div class="flex items-center text-gray-600 text-sm mb-6">
    <span class="text-gray-700 text-sm font-medium bg-gray-50 px-3 py-1 rounded-md">{{ $event->venue }}, {{ $event->regency->name }}, {{ $event->province->name }}</span>
    </div>
</div>

<!-- Event Category -->
<div class="mb-6">
    <h3 class="text-xl font-semibold text-gray-800 mb-3">Event Category</h3>
    <div class="flex items-center text-gray-600 text-sm">
    <span class="text-white bg-indigo-600 font-medium text-sm px-3 py-1 rounded-md">{{ $event->category->name }}</span>
    </div>
</div>



                <!-- View Details Button -->
                <a href="{{ route('events.show', $event->id) }}" class="w-full inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    View Details
                </a>
            </div>
        </div>
    @endforeach
</div>


</div>

</div>

<script>
    // When the province changes, fetch related regencies
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('province').addEventListener('change', function() {
            var provinceId = this.value;
            var regencySelect = document.getElementById('regency');
            regencySelect.innerHTML = '<option value="">Select Regency</option>';

            if (provinceId) {
                fetch(`/api/regencies/${provinceId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(function(regency) {
                            regencySelect.innerHTML += `<option value="${regency.id}">${regency.name}</option>`;
                        });
                    });
            }
        });
    });
</script>

@endsection