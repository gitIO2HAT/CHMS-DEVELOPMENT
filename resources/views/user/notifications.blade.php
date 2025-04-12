@extends('layouts.userlayout')

@section('content')

    @if($notifications->isEmpty())
        <p class="text-gray-600 text-center">You have no notifications.</p>
    @else
        <!-- Scrollable Notifications Container -->
        <div style="max-height: 550px; overflow-y: auto; border: 1px solid #ccc; border-radius: 8px; padding: 16px; background-color: #f9fafb; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); margin-bottom: 20px;">
            <h1 class="text-3xl font-bold text-purple-600 mb-6">Notifications</h1>
            @foreach($notifications as $notification)
                <div class="bg-white rounded-lg shadow p-4 mb-4">
                    <!-- Notification Title -->
                    <h2 class="text-xl font-bold text-gray-800">{{ $notification->name }}</h2>

                    <!-- Notification Details -->
                    <p class="text-gray-600">{{ $notification->message }}</p>
                    <p class="text-sm text-gray-500 mt-2">
                        Event ID: {{ $notification->event_id ?? 'N/A' }} 
                        | Sent at: {{ \Carbon\Carbon::parse($notification->date_time)->format('F d, Y h:i A') }}
                    </p>

                    <!-- Link to Event Details (optional) -->
                    @if($notification->event_id)
                        <a href="{{ route('user.event-user', $notification->event_id) }}" 
                           class="text-blue-500 hover:underline mt-2 block">
                            View Event Details
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

@endsection
