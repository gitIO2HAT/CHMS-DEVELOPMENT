@extends('layouts.app')

@section('title', 'Visitor Registration')

@section('content')
<div class="h-screen mb-20 overflow-auto">
    <!-- Success Notification -->
    @if(session('success'))
    <div id="success-notification" class="fixed top-6 right-6 z-50">
        <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-xl flex items-center space-x-2 animate-fade-in-out">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <!-- Main Form Content -->
    <div class="p-5">
        <form action="{{ route('admin.visitors.store') }}" method="POST" class="space-y-8">
            @csrf

            <!-- Personal Information Section -->
            <div class="space-y-6 mt-1">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-2">Personal Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- First Name -->
                    <div class="space-y-2">
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name <span class="text-red-500">*</span></label>
                        <input type="text" name="first_name" id="first_name" placeholder="John" value="{{ old('first_name') }}" 
                               class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                        @error('first_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div class="space-y-2">
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name <span class="text-red-500">*</span></label>
                        <input type="text" name="last_name" id="last_name" placeholder="Doe" value="{{ old('last_name') }}" 
                               class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                        @error('last_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Suffix -->
                    <div class="space-y-2">
                        <label for="suffix" class="block text-sm font-medium text-gray-700">Suffix</label>
                        <select name="suffix" id="suffix" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                            <option value="">Select Suffix</option>
                            <option value="N/A" {{ old('suffix') == 'N/A' ? 'selected' : '' }}>N/A</option>
                            <option value="Jr." {{ old('suffix') == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                            <option value="Sr." {{ old('suffix') == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                            <option value="I" {{ old('suffix') == 'I' ? 'selected' : '' }}>I</option>
                            <option value="II" {{ old('suffix') == 'II' ? 'selected' : '' }}>II</option>
                            <option value="III" {{ old('suffix') == 'III' ? 'selected' : '' }}>III</option>
                        </select>
                        @error('suffix')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div class="space-y-2">
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender <span class="text-red-500">*</span></label>
                        <select name="gender" id="gender" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                            <option value="">Select Gender</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Non-binary" {{ old('gender') == 'Non-binary' ? 'selected' : '' }}>Non-binary</option>
                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Birth Date -->
                    <div class="space-y-2">
                        <label for="birth_date" class="block text-sm font-medium text-gray-700">Birth Date <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" 
                                   class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                                   onchange="calculateAge()">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        @error('birth_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Age (Auto-calculated) -->
                    <div class="space-y-2">
                        <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                        <input type="number" name="age" id="age" value="{{ old('age') }}" placeholder="Auto-calculated" 
                               class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" readonly>
                        @error('age')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Age Group -->
                    <div class="space-y-2">
                        <label for="age_group" class="block text-sm font-medium text-gray-700">Age Group <span class="text-red-500">*</span></label>
                        <select name="age_group" id="age_group" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                            <option value="">Select Age Group</option>
                            <option value="Child(0-12)" {{ old('age_group') == 'Child(0-12)' ? 'selected' : '' }}>Child (0-12)</option>
                            <option value="Teen(13-19)" {{ old('age_group') == 'Teen(13-19)' ? 'selected' : '' }}>Teen (13-19)</option>
                            <option value="Young_Adult(20-29)" {{ old('age_group') == 'Young_Adult(20-29)' ? 'selected' : '' }}>Young Adult (20-29)</option>
                            <option value="Adult(30-59)" {{ old('age_group') == 'Adult(30-59)' ? 'selected' : '' }}>Adult (30-59)</option>
                            <option value="Senior(60+)" {{ old('age_group') == 'Senior(60+)' ? 'selected' : '' }}>Senior (60+)</option>
                        </select>
                        @error('age_group')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Contact Information Section -->
            <div class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-2">Contact Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Address -->
                    <div class="space-y-2">
                        <label for="address" class="block text-sm font-medium text-gray-700">Address <span class="text-red-500">*</span></label>
                        <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="123 Main St, City" 
                               class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="space-y-2">
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">+63</span>
                            </div>
                            <input type="tel" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" placeholder="9123456789" 
                                   class="block w-full pl-12 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                                   maxlength="10" oninput="validatePhoneNumber(this)">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Format: 9123456789 (10 digits)</p>
                        @error('phone_number')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="john.doe@example.com" 
                               class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contact Preference -->
                    <div class="space-y-2">
                        <label for="contact_preference" class="block text-sm font-medium text-gray-700">Contact Preference <span class="text-red-500">*</span></label>
                        <select name="contact_preference" id="contact_preference" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                            <option value="">Select Preference</option>
                            <option value="Email" {{ old('contact_preference') == 'Email' ? 'selected' : '' }}>Email</option>
                            <option value="Phone" {{ old('contact_preference') == 'Phone' ? 'selected' : '' }}>Phone</option>
                            <option value="No_Preference" {{ old('contact_preference') == 'No_Preference' ? 'selected' : '' }}>No Preference</option>
                        </select>
                        @error('contact_preference')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Additional Information Section -->
            <div class="space-y-6 mb-50">
                <h2 class="text-xl font-semibold text-gray-800 border-b pb-2">Additional Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Interests -->
                    <div class="space-y-2">
                        <label for="interests" class="block text-sm font-medium text-gray-700">Interests <span class="text-red-500">*</span></label>
                        <input type="text" name="interests" id="interests" value="{{ old('interests') }}" placeholder="Sports, Music, Technology" 
                               class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                        @error('interests')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Interaction History -->
                    <div class="space-y-2">
                        <label for="interaction_history" class="block text-sm font-medium text-gray-700">Interaction History <span class="text-red-500">*</span></label>
                        <select name="interaction_history" id="interaction_history" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                            <option value="">Select Interaction</option>
                            <option value="Event" {{ old('interaction_history') == 'Event' ? 'selected' : '' }}>Event</option>
                            <option value="Church_Service" {{ old('interaction_history') == 'Church_Service' ? 'selected' : '' }}>Church Service</option>
                            <option value="Online" {{ old('interaction_history') == 'Online' ? 'selected' : '' }}>Online</option>
                            <option value="In_Person" {{ old('interaction_history') == 'In_Person' ? 'selected' : '' }}>In Person</option>
                        </select>
                        @error('interaction_history')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Invitation Source -->
                    <div class="space-y-2">
                        <label for="invitation_source" class="block text-sm font-medium text-gray-700">Invitation Source <span class="text-red-500">*</span></label>
                        <select name="invitation_source" id="invitation_source" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                            <option value="">Select Source</option>
                            <option value="Friend" {{ old('invitation_source') == 'Friend' ? 'selected' : '' }}>Friend</option>
                            <option value="Social_Media" {{ old('invitation_source') == 'Social_Media' ? 'selected' : '' }}>Social Media</option>
                            <option value="Website" {{ old('invitation_source') == 'Website' ? 'selected' : '' }}>Website</option>
                            <option value="Flyer" {{ old('invitation_source') == 'Flyer' ? 'selected' : '' }}>Flyer</option>
                        </select>
                        @error('invitation_source')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                        <!-- Form Submission -->
                    <div class="pt-6 mb-20">
                        <button type="submit" class="w-full md:w-auto px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Register Visitor
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<style>
    /* Animation for the notification */
    .animate-fade-in-out {
        animation: fadeInOut 2s ease-in-out forwards;
    }
    
    @keyframes fadeInOut {
        0% { opacity: 0; transform: translateY(-20px); }
        10% { opacity: 1; transform: translateY(0); }
        80% { opacity: 1; transform: translateY(0); }
        100% { opacity: 0; transform: translateY(-20px); }
    }

    /* Custom styling for select dropdown arrow */
    select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.75rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }
</style>

<script>
    // Auto-remove success notification after animation completes
    document.addEventListener('DOMContentLoaded', function() {
        const successNotification = document.getElementById('success-notification');
        if (successNotification) {
            setTimeout(() => {
                successNotification.remove();
            }, 2000); // Matches animation duration
        }

        // Calculate age if birth_date exists on page load
        if (document.getElementById('birth_date').value) {
            calculateAge();
        }
    });

    function calculateAge() {
        const birthDateInput = document.getElementById("birth_date");
        const ageInput = document.getElementById("age");

        if (!birthDateInput.value) {
            ageInput.value = '';
            return;
        }

        const birthDate = new Date(birthDateInput.value);
        const today = new Date();

        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        ageInput.value = age;
    }

    // Update age group based on calculated age
    function updateAgeGroup(age) {
        const ageGroupSelect = document.getElementById('age_group');
        let ageGroup = '';
        
        if (age <= 12) ageGroup = 'Child(0-12)';
        else if (age <= 19) ageGroup = 'Teen(13-19)';
        else if (age <= 29) ageGroup = 'Young_Adult(20-29)';
        else if (age <= 59) ageGroup = 'Adult(30-59)';
        else ageGroup = 'Senior(60+)';
        
        for (let i = 0; i < ageGroupSelect.options.length; i++) {
            if (ageGroupSelect.options[i].value === ageGroup) {
                ageGroupSelect.selectedIndex = i;
                break;
            }
        }
    }

    // Validate phone number to only allow digits and limit to 10 characters
    function validatePhoneNumber(input) {
        input.value = input.value.replace(/\D/g, ''); // Remove non-digit characters
        if (input.value.length > 10) {
            input.value = input.value.slice(0, 10); // Limit to 10 digits
        }
    }
</script>
@endsection
