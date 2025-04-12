@extends('layouts.userlayout')

@section('title', 'User Dashboard')

@section('content')
<!-- Main Container with Fixed Height and Scrollable Content -->
<div id="dashboard-content" class="h-screen flex-1 bg-white p-8 rounded-lg shadow-xl transition-all duration-300 ease-in-out overflow-y-auto">
    <!-- Welcoming Section -->
    <div class="mb-8 text-center">
        <h1 class="text-4xl font-bold text-pink-800 mb-2">Welcome back, {{ auth()->user()->name }}!</h1>
        <p class="text-lg text-gray-600">Here’s an overview of your activities.</p>
    </div>

    <!-- Metrics Section -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <!-- Upcoming Events Metric -->
        <a href="{{ route('user.event-user') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white shadow-lg rounded-lg p-4 transition-all duration-300 ease-in-out transform hover:scale-105 flex flex-col items-center justify-center">
            <div class="bg-white/20 p-2 rounded-full mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-1">Upcoming Events</h3>
            <p class="text-3xl font-semibold mb-1">{{ $upcomingEventsCount }}</p>
            <p class="text-xs text-blue-200">View all events</p>
        </a>

        <!-- Pending Requests Metric -->
        <a href="{{ route('user.history') }}" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white shadow-lg rounded-lg p-4 transition-all duration-300 ease-in-out transform hover:scale-105 flex flex-col items-center justify-center">
            <div class="bg-white/20 p-2 rounded-full mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-1">Pending Requests</h3>
            <p class="text-3xl font-semibold mb-1">{{ $pendingRequestsCount }}</p>
            <p class="text-xs text-green-200">Check your requests</p>
        </a>

        <!-- New Announcements Metric -->
        <a href="{{ route('user.notifications') }}" class="bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white shadow-lg rounded-lg p-4 transition-all duration-300 ease-in-out transform hover:scale-105 flex flex-col items-center justify-center">
            <div class="bg-white/20 p-2 rounded-full mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-1">New Announcements</h3>
            <p class="text-3xl font-semibold mb-1">{{ $newNotificationsCount }}</p>
            <p class="text-xs text-purple-200">See all announcements</p>
        </a>
    </div>

    <!-- Participation Requests Section -->
    <div class="bg-gray-50 shadow-lg rounded-lg p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            Recent Participation Requests
        </h3>
        <div class="space-y-4">
            @forelse ($participationRequests as $request)
                <div class="flex items-center justify-between bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 ease-in-out">
                    <div>
                        <p class="text-lg font-semibold text-gray-800">{{ $request->event->title }}</p>
                        <p class="text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($request->updated_at)->format('F jS, Y') }} <!-- Use updated_at for recent activity -->
                        </p>
                    </div>
                    <span 
                        class="px-3 py-1 text-sm font-semibold rounded-full 
                        {{ $request->status === 'approved' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                        {{ ucfirst($request->status) }}
                    </span>
                </div>
            @empty
                <p class="text-gray-600 text-center py-4">No recent participation requests found.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection