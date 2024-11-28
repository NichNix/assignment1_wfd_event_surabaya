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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-8">
        @foreach($events as $event)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4">
                    <h3 class="text-xl font-bold text-indigo-600 mb-2">{{ $event->title }} || {{ $event->status }}</h3>
                    <p class="text-gray-600 mb-2"><i class="fas fa-map-marker-alt"></i> {{ $event->venue }}, {{ $event->regency->name }}, {{ $event->province->name }}</p>
                    <p class="text-gray-600 mb-2"><i class="fas fa-calendar-alt"></i> {{ $event->date }}</p>
                    <p class="text-gray-600 mb-2"><i class="fas fa-clock"></i> {{ $event->start_time }}</p>
                    <p class="text-gray-600 mb-2"><i class="fas fa-tag"></i> {{ $event->category->name }}</p>
                    <a href="{{ route('events.show', $event->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">View Details</a>
                </div>
            </div>
        @endforeach
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
