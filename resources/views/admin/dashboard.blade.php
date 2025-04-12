@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<!-- Dashboard Content -->
<div id="dashboard-content" class="flex-1 bg-white p-8 rounded-lg shadow-lg transition-all duration-300 ease-in-out" style="width: 100%; height: calc(100vh - 100px); overflow-y: auto;">

    <!-- Welcoming Section -->
    <div class="mb-8 text-center">
        <h1 class="text-4xl font-bold text-purple-800">Welcome back, {{ auth()->user()->name }}!</h1>
        <p class="text-lg text-gray-600 mt-2">Here’s a quick overview of your dashboard.</p>
    </div>

    <!-- Metrics Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Visitors Card -->
        <div class="bg-gradient-to-r from-green-400 to-green-500 text-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-1">
            <div class="flex items-center">
                <i class="fas fa-users text-4xl mr-4 animate-bounce"></i>
                <div>
                    <h3 class="text-xl font-bold">Total Visitors</h3>
                    <p class="text-2xl">{{ $totalVisitors }}</p>
                </div>
            </div>
        </div>

        <!-- Upcoming Events Card -->
        <div class="bg-gradient-to-r from-blue-400 to-blue-500 text-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-1">
            <div class="flex items-center">
                <i class="fas fa-calendar-alt text-4xl mr-4 animate-pulse"></i>
                <div>
                    <h3 class="text-xl font-bold">Upcoming Events</h3>
                    <p class="text-2xl">{{ $upcomingEventsCount }}</p>
                </div>
            </div>
        </div>

        <!-- New Visitors This Week Card -->
        <div class="bg-gradient-to-r from-orange-400 to-orange-500 text-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-1">
            <div class="flex items-center">
                <i class="fas fa-user-plus text-4xl mr-4 animate-bounce"></i>
                <div>
                    <h3 class="text-xl font-bold">New Visitors This Week</h3>
                    <p class="text-2xl">{{ $newVisitorsThisWeek }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Events & Recently Added Visitors Sections -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Upcoming Events Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-1">
            <h3 class="text-xl font-bold text-purple-800 mb-4">Upcoming Events</h3>
            <div class="space-y-4">
                @forelse ($recentEvents as $event)
                    @if (\Carbon\Carbon::parse($event->date)->isFuture())
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                            <div class="flex items-center">
                                <img
                                    alt="Event Image"
                                    class="rounded-full w-10 h-10 mr-4"
                                    src="{{ $event->image_url ?? 'default-image.jpg' }}"
                                    width="40"
                                    height="40" />
                                <div>
                                    <p class="font-medium text-gray-900">{{ $event->name }}</p>
                                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($event->date)->format('F jS, Y') }}</p>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400 hover:text-purple-500 transition-colors duration-200"></i>
                        </div>
                    @endif
                @empty
                    <p class="text-center text-gray-600">No upcoming events found.</p>
                @endforelse
            </div>
        </div>

        <!-- Recently Added Visitors Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-1">
            <h3 class="text-xl font-bold text-purple-800 mb-4">Recently Added Visitors</h3>
            <div class="space-y-4">
                @forelse ($recentVisitors as $visitor)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                {{ substr($visitor->first_name, 0, 1) }}{{ substr($visitor->last_name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $visitor->first_name }} {{ $visitor->last_name }}</p>
                                <p class="text-sm text-gray-500">{{ $visitor->created_at->format('F jS, Y') }}</p>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 hover:text-purple-500 transition-colors duration-200"></i>
                    </div>
                @empty
                    <p class="text-center text-gray-600">No recent visitors found.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Script for Sidebar Toggle -->
<script>
    // Get sidebar and dashboard content
    const sidebar = document.getElementById('sidebar');
    const dashboardContent = document.getElementById('dashboard-content');
    const sidebarToggle = document.getElementById('sidebar-toggle');

    // Function to adjust the content position based on the sidebar state
    function adjustContentPosition() {
        if (sidebar.classList.contains('collapsed')) {
            dashboardContent.style.marginLeft = "0.3%"; // Adjust to the collapsed sidebar width
        } else {
            dashboardContent.style.marginLeft = "0.3%"; // Adjust to the expanded sidebar width
        }
    }

    // Listen for sidebar toggle button clicks
    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        adjustContentPosition();
    });

    // Initial adjustment
    adjustContentPosition();
</script>
@endsection