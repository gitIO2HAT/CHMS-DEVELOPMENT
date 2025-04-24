@extends('layouts.userlayout')

@section('content')
<div class="container mx-auto p-6">
    <!-- Header with Search Bar -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-purple-600">Events</h1>

        <!-- Search Form -->
        <form method="GET" class="flex items-center space-x-3">
            <input 
                type="text" 
                name="search" 
                value="{{ $searchTerm ?? '' }}" 
                placeholder="Search events..." 
                class="px-4 py-2 rounded-lg border border-gray-300"
            />
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Search
            </button>
        </form>
    </div>

    <!-- Scrollable Events List (two columns) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-h-96 overflow-y-auto">
        @forelse($events as $event)
            @php
                // Check the participation status for the current user
                $participation = $event->participations->where('users_id', auth()->id())->first();
                // Check if the event date has passed
                $eventDate = \Carbon\Carbon::parse($event->date);
                $isExpired = $eventDate->isPast();
            @endphp

            <div class="bg-white rounded-lg shadow-lg p-4 flex flex-col md:flex-row">
                <!-- Event Image -->
                <div class="md:w-1/3 mb-4 md:mb-0">
                    <img 
                        src="{{ asset('storage/' . $event->image) }}" 
                        alt="{{ $event->name }} Image" 
                        class="w-full h-32 object-cover rounded-lg"
                    />
                </div>

                <!-- Event Details -->
                <div class="md:w-2/3 md:pl-6">
                    <h2 class="text-xl font-bold text-gray-800">{{ $event->name }}</h2>
                    <p class="text-gray-600">Location: {{ $event->location }}</p>
                    <p class="text-gray-600">Category: {{ $event->category }}</p>
                    <p class="text-gray-600">Date: {{ \Carbon\Carbon::parse($event->date)->format('F d, Y') }}</p>

                    <!-- Participate Button -->
                    <form method="POST" action="{{ $participation && $participation->status === 'pending' ? route('user.participation.cancel', $participation->id) : route('user.participation.store') }}">
                        @csrf

                        @if($participation)
                            @if($participation->status === 'pending')
                                <!-- Pending request: Allow cancellation -->
                                @method('DELETE')
                                <button 
                                    type="submit" 
                                    class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-300 mt-2">
                                    Cancel Request
                                </button>
                            @elseif($participation->status === 'approved')
                                <!-- Approved request: Show "Approved" -->
                                <button 
                                    type="button" 
                                    class="bg-green-500 text-white px-6 py-2 rounded-lg cursor-not-allowed w-full">
                                    Approved ✅
                                </button>
                            @elseif($participation->status === 'rejected')
                                <!-- Rejected request: Show "Not Available" -->
                                <button 
                                    type="button" 
                                    class="bg-red-500 text-white px-6 py-2 rounded-lg cursor-not-allowed w-full">
                                    Not Available ❌
                                </button>
                            @endif
                        @else
                            <!-- No request yet: Check if the event is expired or not -->
                            @if ($isExpired)
                                <!-- Event Expired -->
                                <button 
                                    type="button" 
                                    class="bg-red-400 text-white px-4 py-2 rounded-lg cursor-not-allowed mt-2 w-full">
                                    Event Expired ❌
                                </button>
                            @else
                                <!-- Event Upcoming: Allow participation -->
                                <input type="hidden" name="events_id" value="{{ $event->id }}">
                                <button 
                                    type="submit" 
                                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mt-2">
                                    Participate
                                </button>
                            @endif
                        @endif
                    </form>
                </div>
            </div>
        @empty
        <p class="text-gray-600 col-span-full text-center">No events found.</p>
        @endforelse
    </div>
</div>
@endsection
