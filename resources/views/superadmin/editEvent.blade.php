@extends('layouts.superadminlayout')


@section('title', 'Update Event')
@section('content')


  <div class="container mx-auto px-4 py-0">
    <div class="overflow-y-auto bg-gray-50 p-6 rounded-lg shadow-md max-h-[538px] ">  <!-- Set max-height and overflow here -->
      <h2 class="text-3xl font-bold text-center text-purple-600 mb-6">Edit Event</h2>
      <!--  Display Error-->
@if($errors->any())
    <div class="alert alert-danger text-center">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form action="{{ route('superadmin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
           @csrf
           @method('PUT')
            <div class="form-group grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                  <label for="name" class="form-label block text-lg font-semibold">Event Name</label>
                  <input type="text" name="name" id="name" class="form-control w-full px-4 py-2 rounded-lg shadow-md" value="{{ $event->name }}" required>
                </div>
        
                <div>
                  <label for="date" class="form-label block text-lg font-semibold">Event Date</label>
                  <input type="date" name="date" id="date" class="form-control w-full px-4 py-2 rounded-lg shadow-md" value="{{ $event->date }}" required>
                </div>
        
                <div>
                  <label for="location" class="form-label block text-lg font-semibold">Event Location</label>
                  <input type="text" name="location" id="location" class="form-control w-full px-4 py-2 rounded-lg shadow-md" value="{{ $event->location }}" required>
                </div>
        
                <div>
                  <label for="category" class="form-label block text-lg font-semibold">Event Category</label>
                  <input type="text" name="category" id="category" class="form-control w-full px-4 py-2 rounded-lg shadow-md" value="{{ $event->category }}" required>
                </div>
        
                <div>
                  <label for="description" class="form-label block text-lg font-semibold">Event Description</label>
                  <textarea name="description" id="description" class="form-control w-full px-4 py-2 rounded-lg shadow-md" rows="5" required>{{ $event->description }}</textarea>
                </div>

                <div class="col-span-2">
                  <label for="image" class="block text-sm font-semibold">Upload Event Image</label>
                  <input type="file" name="image" id="image" accept="image/*" class="w-full p-2 border rounded-md">
                </div>
            
                <div class="col-span-2">
                    <button type="submit" class="bg-purple-600 text-white py-2 px-4 rounded hover:bg-purple-500 w-full sm:w-auto">Update Event</button>
                </div>
            </div>
        </form>
    </div>
  </div>
@endsection
