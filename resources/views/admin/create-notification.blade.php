@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-0">
    <div class="bg-white shadow-lg rounded-lg p-6 ">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Create Notification</h2>

        <!-- Scrollable Form -->
        <div class="overflow-y-auto max-h-[61vh] p-4 border border-gray-300 rounded-lg">
            <form action="{{ route('admin.notifications.store') }}" method="POST">
                @csrf

                <!-- Title -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Title</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name') }}" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date & Time -->
                <div class="mb-4">
                    <label for="date_time" class="block text-sm font-semibold text-gray-700 mb-2">Date & Time</label>
                    <input 
                        type="datetime-local" 
                        name="date_time" 
                        id="date_time" 
                        value="{{ old('date_time') }}" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        required>
                    @error('date_time')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Message -->
                <div class="mb-4">
                    <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
                    <textarea 
                        name="message" 
                        id="message" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                        rows="6" 
                        required>{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Event (Optional) -->
                <div class="mb-6">
                    <label for="event_id" class="block text-sm font-semibold text-gray-700 mb-2">Event (Optional)</label>
                    <select 
                        name="event_id" 
                        id="event_id" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- None --</option>
                        @forelse ($events as $event)
                            <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>{{ $event->name }}</option>
                        @empty
                            <option value="" disabled>No events available</option>
                        @endforelse
                    </select>
                    @error('event_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-between items-center">
                    <button 
                    type="submit" 
                    name="action" 
                    value="post_notification"
                    class="px-6 py-3 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    Post Notification
                    </button>

                    <!-- Email Notification Button -->
                    <button 
                        type="button" 
                        data-bs-toggle="modal" 
                        data-bs-target="#sendEmailModal" 
                        class="px-6 py-3 text-white bg-green-600 rounded-lg shadow-md hover:bg-green-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-green-600">
                        Send Notification via Email
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="sendEmailModal" tabindex="-1" aria-labelledby="sendEmailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendEmailModalLabel">Select Users to Send Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.notifications.sendEmail') }}" method="POST">
                        @csrf
                        <!-- Include the composed announcement details -->
                        <input type="hidden" name="title" value="{{ old('name') }}">
                        <input type="hidden" name="message" value="{{ old('message') }}">
                        <input type="hidden" name="date_time" value="{{ old('date_time') }}">

                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Select Users</label>
                            <div class="form-check mb-3">
                                <input type="checkbox" id="select_all" class="form-check-input">
                                <label for="select_all" class="form-check-label">Select All Users</label>
                            </div>
                            <div class="overflow-y-auto max-h-48 border border-gray-300 p-2 rounded-lg">
                                @foreach ($users as $user)
                                    <div class="form-check">
                                        <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" id="user_{{ $user->id }}" class="form-check-input">
                                        <label class="form-check-label" for="user_{{ $user->id }}">{{ $user->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="px-6 py-3 text-white bg-green-600 rounded-lg shadow-md hover:bg-green-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-green-600">
                            Send Email
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectAllCheckbox = document.getElementById('select_all');
        const userCheckboxes = document.querySelectorAll('input[name="user_ids[]"]');

        // Toggle all checkboxes when "Select All" is clicked
        selectAllCheckbox.addEventListener('change', function () {
            userCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        // Uncheck "Select All" if any user checkbox is unchecked
        userCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                if (!this.checked) {
                    selectAllCheckbox.checked = false;
                }
            });
        });
    });
</script>
@endsection
