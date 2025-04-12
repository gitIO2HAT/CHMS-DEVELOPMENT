@extends('layouts.app')

@section('title', 'Update Event')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header Section -->
        <div class="p-6 bg-gradient-to-r from-purple-500 to-indigo-500">
            <h2 class="text-3xl font-bold text-center text-white">Edit Event</h2>
        </div>

        <!-- Scrollable Form Section -->
        <div class="overflow-y-auto max-h-[calc(100vh-250px)] p-6"> <!-- Adjust max-height as needed -->
            <!-- Display Errors -->
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline">There were some issues with your input.</span>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Event Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Event Name</label>
                        <input type="text" name="name" id="name" value="{{ $event->name }}" required
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <!-- Event Date -->
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Event Date</label>
                        <input type="date" name="date" id="date" value="{{ $event->date }}" required
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <!-- Event Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">Event Location</label>
                        <input type="text" name="location" id="location" value="{{ $event->location }}" required
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <!-- Event Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Event Category</label>
                        <input type="text" name="category" id="category" value="{{ $event->category }}" required
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <!-- Event Description -->
                    <div class="col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Event Description</label>
                        <textarea name="description" id="description" rows="5" required
                                  class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">{{ $event->description }}</textarea>
                    </div>

                    <!-- Event Image Upload -->
                    <div class="col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700">Upload Event Image</label>
                        <input type="file" name="image" id="image" accept="image/*"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-md hover:bg-purple-700 transition duration-300">
                        Update Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection