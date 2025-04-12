@extends('layouts.app')

@section('title', 'Add New Event - Admin Dashboard')

@section('content')
 <!-- Success Message Display -->
 @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container mx-auto px-4 py-0">
    <!-- Scrollable Content Container -->
    <div class="overflow-y-auto bg-gray-50 p-6 rounded-lg shadow-md max-h-[538px] ">
       <h2 class="text-3xl font-bold text-center text-purple-600 mb-6">Add New Event</h2>
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-lg font-semibold">Event Name</label>
                    <input type="text" name="name" id="name" class="w-full px-4 py-2 rounded-lg shadow-md" required>
                </div>
                <div>
                    <label for="date" class="block text-lg font-semibold">Event Date</label>
                    <input type="date" name="date" id="date" class="w-full px-4 py-2 rounded-lg shadow-md" required>
                </div>
                <div>
                    <label for="location" class="block text-lg font-semibold">Event Location</label>
                    <input type="text" name="location" id="location" class="w-full px-4 py-2 rounded-lg shadow-md" required>
                </div>
                <div>
                    <label for="category" class="block text-lg font-semibold">Event Category</label>
                    <input type="text" name="category" id="category" class="w-full px-4 py-2 rounded-lg shadow-md" required>
                </div>

                <div class="col-span-2">
                    <label for="description" class="block text-lg font-semibold">Event Description</label>
                    <textarea name="description" id="description" rows="5" class="w-full px-4 py-2 rounded-lg shadow-md" required></textarea>
                </div>

                <div class="col-span-2">
                    <label for="image" class="block text-sm font-semibold">Upload Event Image</label>
                    <input type="file" name="image" id="image" class="w-full p-2 border rounded-md">
                </div>

                <div class="col-span-2">
                    <button type="submit" class="bg-purple-600 text-white py-2 px-4 rounded hover:bg-purple-500 w-full sm:w-auto">Save Event</button>
                </div>
            </div>
        </form>
    </div>
  </div>
@endsection
