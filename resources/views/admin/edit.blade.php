@extends('layouts.app')

@section('title', 'Update Visitor')
@section('content')
<div class="container mx-auto px-4 py-0">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg overflow-y-auto h-[538px]">
        <h2 class="text-xl font-semibold text-center text-gray-800 mb-6">Edit Visitor Information</h2>

        <!-- Display validation errors -->
        @if ($errors->any())
        <div class="mb-4">
            <div class="alert alert-danger p-4 bg-red-100 text-red-700 border border-red-400 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <!-- Edit visitor form -->
        <form action="{{ route('admin.visitors.update', $visitor->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Use PUT method for updates -->
            
            <!-- First Name -->
            <div class="mb-4">
                <label for="first_name" class="block text-xs font-medium text-gray-700">First Name</label>
                <input type="text" name="first_name" id="first_name" class="w-full px-3 py-2 mt-1 text-sm border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" value="{{ old('first_name', $visitor->first_name) }}" required>
            </div>

            <!-- Last Name -->
            <div class="mb-4">
                <label for="last_name" class="block text-xs font-medium text-gray-700">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="w-full px-3 py-2 mt-1 text-sm border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" value="{{ old('last_name', $visitor->last_name) }}" required>
            </div>

            <!-- Suffix -->
            <div class="mb-4">
                <label for="suffix" class="block text-xs font-medium text-gray-700">Suffix</label>
                <select name="suffix" id="suffix" class="w-full px-3 py-2 mt-1 text-sm border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option value="" >Select Suffix</option>
                    <option value="N/A" {{ $visitor->suffix === 'N/A' ? 'selected' : '' }}>N/A</option>
                    <option value="Jr." {{ $visitor->suffix === 'Jr.' ? 'selected' : '' }}>Jr</option>
                    <option value="Sr." {{ $visitor->suffix === 'Sr.' ? 'selected' : '' }}>Sr</option>
                    <option value="I" {{ $visitor->suffix === 'I' ? 'selected' : '' }}>I</option>
                    <option value="II" {{ $visitor->suffix === 'II' ? 'selected' : '' }}>II</option>
                    <option value="III" {{ $visitor->suffix === 'III' ? 'selected' : '' }}>III</option>
                    <option value="IV" {{ $visitor->suffix === 'IV' ? 'selected' : '' }}>IV</option>
                    <option value="V" {{ $visitor->suffix === 'V' ? 'selected' : '' }}>V</option>
                </select>
            </div>

            <!-- Birth Date -->
            <div class="mb-4">
                <label for="birth_date" class="block text-xs font-medium text-gray-700">Birth Date</label>
                <input type="date" name="birth_date" id="birth_date" class="w-full px-3 py-2 mt-1 text-sm border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" value="{{ old('birth_date', $visitor->birth_date) }}" required>
            </div>

            <!-- Gender -->
            <div class="mb-4">
                <label for="gender" class="block text-xs font-medium text-gray-700">Gender</label>
                <select name="gender" id="gender" class="w-full px-3 py-2 mt-1 text-sm border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                    <option value="" >Select Gender</option>
                    <option value="Male" {{ $visitor->gender === 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ $visitor->gender === 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Non-binary" {{ $visitor->gender === 'Non-binary' ? 'selected' : '' }}>Non-binary</option>
                    <option value="Other" {{ $visitor->gender === 'Other' ? 'selected' : '' }}>Other</option>
                    <option value="Prefer_not_to_say" {{ $visitor->gender === 'Prefer_not_to_say' ? 'selected' : '' }}>Prefer not to say</option>
                </select>
            </div>

            <!-- Address -->
            <div class="mb-4">
                <label for="address" class="block text-xs font-medium text-gray-700">Address</label>
                <input type="text" name="address" id="address" class="w-full px-3 py-2 mt-1 text-sm border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" value="{{ old('address', $visitor->address) }}" required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-xs font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full px-3 py-2 mt-1 text-sm border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" value="{{ old('email', $visitor->email) }}" required>
            </div>

            <!-- Phone Number -->
            <div class="mb-4">
                <label for="phone_number" class="block text-xs font-medium text-gray-700">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="w-full px-3 py-2 mt-1 text-sm border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" value="{{ old('phone_number', $visitor->phone_number) }}">
            </div>

            <!-- Age -->
            <div class="mb-4">
                <label for="age" class="block text-xs font-medium text-gray-700">Age</label>
                <input type="number" name="age" id="age" class="w-full px-3 py-2 mt-1 text-sm border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" value="{{ old('age', $visitor->age) }}" required>
            </div>

            <!-- Age Group -->
            <div class="mb-4">
                <label for="age_group" class="block text-xs font-medium text-gray-700">Age Group</label>
                <select name="age_group" id="age_group" class="w-full px-3 py-2 mt-1 text-sm border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                    <option value="" >Select Age Group</option>
                    <option value="Child(0-12)" {{ $visitor->age_group === 'Child(0-12)' ? 'selected' : '' }}>Child (0-12)</option>
                    <option value="Teen(13-19)" {{ $visitor->age_group === 'Teen(13-19)' ? 'selected' : '' }}>Teen (13-19)</option>
                    <option value="Young_Adult(20-29)" {{ $visitor->age_group === 'Young_Adult(20-29)' ? 'selected' : '' }}>Young Adult (20-29)</option>
                    <option value="Adult(30-59)" {{ $visitor->age_group === 'Adult(30-59)' ? 'selected' : '' }}>Adult (30-59)</option>
                    <option value="Senior(60+)" {{ $visitor->age_group === 'Senior(60+)' ? 'selected' : '' }}>Senior (60+)</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow-md hover:bg-blue-700 transition-all duration-300">
                    Update Visitor
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
