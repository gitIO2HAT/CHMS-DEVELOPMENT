@extends('layouts.superadminlayout')

@section('title', 'Visitor Registration')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-y-auto px-4 py-0 h-[538px]">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-6">Visitor Registration</h1>

    <!-- Success message -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    <form action="{{ route('superadmin.visitors.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Visitor Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" name="first_name" id="first_name" placeholder="Enter First Name" value="{{ old('first_name') }}" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('first_name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" name="last_name" id="last_name" placeholder="Enter Last Name" value="{{ old('last_name') }}" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('last_name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="suffix" class="block text-sm font-medium text-gray-700">Suffix</label>
                <select name="suffix" id="suffix" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="">Select Suffix</option>
                    <option value="N/A" {{ old('suffix') == 'N/A' ? 'selected' : '' }}>N/A</option>
                    <option value="Jr." {{ old('suffix') == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                    <option value="Sr." {{ old('suffix') == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                    <option value="I" {{ old('suffix') == 'I' ? 'selected' : '' }}>I</option>
                    <option value="II" {{ old('suffix') == 'II' ? 'selected' : '' }}>II</option>
                    <option value="III" {{ old('suffix') == 'III' ? 'selected' : '' }}>III</option>
                    <option value="IV" {{ old('suffix') == 'IV' ? 'selected' : '' }}>IV</option>
                    <option value="V" {{ old('suffix') == 'V' ? 'selected' : '' }}>V</option>
                </select>
                @error('suffix')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select name="gender" id="gender" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="">Select Gender</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Non-binary" {{ old('gender') == 'Non-binary' ? 'selected' : '' }}>Non-binary</option>
                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                    <option value="Prefer_not_to_say" {{ old('gender') == 'Prefer_not_to_say' ? 'selected' : '' }}>Prefer not to say</option>
                </select>
                @error('gender')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="birth_date" class="block text-sm font-medium text-gray-700">Birth Date</label>
                <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('birth_date')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                <input type="number" name="age" id="age" value="{{ old('age') }}" placeholder="Enter Age" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('age')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="age_group" class="block text-sm font-medium text-gray-700">Age Group</label>
                <select name="age_group" id="age_group" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="">Select Age Group</option>
                    <option value="Child(0-12)" {{ old('age_group') == 'Child(0-12)' ? 'selected' : '' }}>Child (0-12)</option>
                    <option value="Teen(13-19)" {{ old('age_group') == 'Teen(13-19)' ? 'selected' : '' }}>Teen (13-19)</option>
                    <option value="Young_Adult(20-29)" {{ old('age_group') == 'Young_Adult(20-29)' ? 'selected' : '' }}>Young Adult (20-29)</option>
                    <option value="Adult(30-59" {{ old('age_group') == 'Adult(30-59' ? 'selected' : '' }}>Adult (30-59)</option>
                    <option value="Senior(60+)" {{ old('age_group') == 'Senior(60+)' ? 'selected' : '' }}>Senior (60+)</option>
                </select>
                @error('age_group')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Contact Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="Enter Address" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('address')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" placeholder="Enter Phone Number" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('phone_number')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Enter Email" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="contact_preference" class="block text-sm font-medium text-gray-700">Contact Preference</label>
                <select name="contact_preference" id="contact_preference" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="">Select Preference</option>
                    <option value="Email" {{ old('contact_preference') == 'Email' ? 'selected' : '' }}>Email</option>
                    <option value="Phone" {{ old('contact_preference') == 'Phone' ? 'selected' : '' }}>Phone</option>
                    <option value="No_Preference" {{ old('contact_preference') == 'No_Preference' ? 'selected' : '' }}>No Preference</option>
                </select>
                @error('contact_preference')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <!--additional information-->
            <div>
                <label for="interests" class="block text-sm font-medium text-gray-700">Interests</label>
                <input type="interests" name="interests" id="interests" value="{{ old('interests') }}" placeholder="Enter Interests" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('interests')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="interaction_history" class="block text-sm font-medium text-gray-700">Interaction History</label>
                <select name="interaction_history" id="interaction_history" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="">Select interaction</option>
                    <option value="Event" {{ old('interaction_history') == 'Event' ? 'selected' : '' }}>Event</option>
                    <option value="Church_Service" {{ old('interaction_history') == 'Church_Service' ? 'selected' : '' }}>Church Service</option>
                    <option value="Online" {{ old('interaction_history') == 'Online' ? 'selected' : '' }}>Online</option>
                    <option value="In_Person" {{ old('interaction_history') == 'In_Person' ? 'selected' : '' }}>In Person</option>
                </select>
                @error('interaction_history')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="invitation_source" class="block text-sm font-medium text-gray-700">Invitation Source</label>
                <select name="invitation_source" id="invitation_source" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="">Select invitation</option>
                    <option value="Friend" {{ old('invitation_source') == 'Friend' ? 'selected' : '' }}>Friend</option>
                    <option value="Social_Media" {{ old('invitation_source') == 'Social_Media' ? 'selected' : '' }}>Social Media</option>
                    <option value="Website" {{ old('invitation_source') == 'Website' ? 'selected' : '' }}>Website</option>
                    <option value="Flyer" {{ old('invitation_source') == 'Flyer' ? 'selected' : '' }}>Flyer</option>
                </select>
                @error('invitation_source')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="flex justify-center mt-6">
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Register Visitor</button>
        </div>
    </form>
</div>
@endsection
