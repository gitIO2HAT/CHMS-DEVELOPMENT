@extends('layouts.app')

@section('title', 'Email Users')

@section('content')
    <div class="p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Send Email to Users</h1>
        <p class="text-gray-600">Compose your message before selecting recipients.</p>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-3 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-200 text-red-800 p-3 rounded-md mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Email Composition Form -->
        <form id="emailForm" action="{{ route('admin.notifications.send-email') }}" method="POST">
            @csrf

            <label class="block text-gray-700">Subject:</label>
            <input type="text" name="title" id="emailSubject" class="w-full p-2 border border-gray-300 rounded-md mb-3" required>

            <label class="block text-gray-700">Message:</label>
            <textarea name="message" id="emailMessage" class="w-full p-2 border border-gray-300 rounded-md mb-3" required></textarea>

            <button type="button" id="openUserModal" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Send To
            </button>
        </form>
    </div>

    <!-- Overlay Modal for User Selection -->
    <div id="userModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-bold mb-3">Select Recipients</h2>

            <div class="mb-3">
                <input type="checkbox" id="selectAll" class="mr-2">
                <label for="selectAll" class="font-semibold">Select All</label>
            </div>

            <div class="max-h-60 overflow-y-auto border border-gray-300 p-2 rounded-md">
                @foreach ($users as $user)
                    <div>
                        <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" class="user-checkbox mr-2">
                        <label>{{ $user->name }} ({{ $user->email }})</label>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-end mt-4">
                <button type="button" id="closeUserModal" class="mr-2 px-4 py-2 border border-gray-400 rounded-md hover:bg-gray-200">
                    Cancel
                </button>
                <button type="button" id="sendEmail" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                    Send
                </button>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('openUserModal').addEventListener('click', function() {
            document.getElementById('userModal').classList.remove('hidden');
        });

        document.getElementById('closeUserModal').addEventListener('click', function() {
            document.getElementById('userModal').classList.add('hidden');
        });

        document.getElementById('selectAll').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('.user-checkbox');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });
        document.getElementById('sendEmail').addEventListener('click', function() {
         document.getElementById('emailForm').submit();
        });

    </script>
@endsection
