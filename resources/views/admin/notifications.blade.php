@extends('layouts.app')

@section('title', 'Admin Notifications')

@section('content')
    <div 
        id="notifications-content"
        class="flex-1 p-6 bg-white shadow-md rounded-lg transition-all duration-300 ease-in-out">
        <h1 class="text-2xl font-bold mb-4">Notifications</h1>

        <!-- Add Announcement and Email Users Buttons -->
        <div class="mb-4 flex space-x-2">
            <a href="{{ route('admin.notifications.create') }}" 
               class="inline-block px-4 py-2 border border-pink-700 text-pink-700 font-semibold rounded-lg hover:bg-pink-700 hover:text-white transition">
                Add Announcement
            </a>
            <a href="{{ route('admin.notifications.email') }}" 
               class="inline-block px-4 py-2 border border-blue-700 text-blue-700 font-semibold rounded-lg hover:bg-blue-700 hover:text-white transition">
                Email Users
            </a>
        </div>

        @if($notifications->isEmpty())
            <p class="text-gray-500">No notifications to display.</p>
        @else
            <div class="overflow-x-auto max-h-[400px]"> <!-- Added scroll container -->
                <table class="table-auto w-full border-collapse border border-gray-200 rounded-lg shadow-md">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 p-2 text-left font-semibold text-gray-700">Title</th>
                            <th class="border border-gray-300 p-2 text-left font-semibold text-gray-700">Schedule</th>
                            <th class="border border-gray-300 p-2 text-left font-semibold text-gray-700">Message</th>
                            <th class="border border-gray-300 p-2 text-left font-semibold text-gray-700">Event</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifications as $notification)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="border border-gray-300 p-2">{{ $notification->name }}</td>
                                <td class="border border-gray-300 p-2">{{ $notification->date_time }}</td>
                                <td class="border border-gray-300 p-2">{{ $notification->message }}</td>
                                <td class="border border-gray-300 p-2">{{ $notification->event_name ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <script>
        // Get sidebar and dashboard content
        const sidebar = document.getElementById('sidebar');
        const notificationsContent = document.getElementById('notifications-content');
        const sidebarToggle = document.getElementById('sidebar-toggle');

        // Function to adjust the content position based on the sidebar state
        function adjustNotificationsPosition() {
            if (sidebar.classList.contains('collapsed')) {
                notificationsContent.style.marginLeft = "0.3%"; // Adjust to the collapsed sidebar width
            } else {
                notificationsContent.style.marginLeft = "0.3%"; // Adjust to the expanded sidebar width
            }
        }

        // Listen for sidebar toggle button clicks
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            adjustNotificationsPosition();
        });

        // Initial adjustment
        adjustNotificationsPosition();
    </script>
@endsection
