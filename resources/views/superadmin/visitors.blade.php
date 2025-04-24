@extends('layouts.superadminlayout')

@section('title', 'Visitor List')

@section('content')
    <div id="visitor-content" class="min-h-screen flex-1 flex-col items-center shadow-md transition-all duration-300 ease-in-out py-2 mt-0">
        <div class="max-w-6xl w-full px-6 py-6 bg-white rounded-lg shadow-md">
            <!-- Header with Visitor List and Add Visitor button -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-semibold text-gray-800">Visitor List</h1>
                <div class="flex space-x-4">
                    <a href="{{ route('superadmin.visitors.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200">
                        Add Visitor
                    </a>
                    <button onclick="showLink()" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition duration-200">
                        Share Form
                    </button>
                    
                    <form method="GET" action="{{ route('superadmin.visitors.index') }}" class="flex flex-wrap gap-2 items-center">
                    <!-- Filter by Gender -->
                    <select name="gender" class="p-2 border border-gray-300 rounded-md">
                        <option value="">All Genders</option>
                        <option value="Male" {{ request()->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ request()->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    <!-- Search by Name -->
                    <input type="text" name="search" placeholder="Search by name..." value="{{ request()->search }}" class="p-2 border border-gray-300 rounded-md">
                    <!-- Submit Button -->
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Search</button>
                </form>
                </div>
            </div>

             <!-- Floating Success Notification (positioned fixed) -->
            @if(session('success'))
            <div id="success-notification" class="fixed top-4 right-4 z-50">
                <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2 animate-fade-in-out">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            @endif

            <!-- Toast Notification (hidden by default) -->
            <div id="toast" class="fixed bottom-4 right-4 hidden">
                <div class="bg-green-500 text-white px-4 py-2 rounded-md shadow-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span>Link copied to clipboard!</span>
                </div>
            </div>

            <!-- Visitor Registration Form Link -->
            <div id="visitorFormLink" class="mt-4 hidden">
                <div class="flex items-center space-x-2">
                    <input type="text" id="visitorLink" value="{{ route('visitor_registration') }}" readonly class="p-2 border border-gray-300 rounded-md w-full">
                    <button onclick="copyLink()" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                        </svg>
                        Copy
                    </button>
                </div>
            </div>

            <!-- Visitor Table -->
            <div class="overflow-x-auto overflow-y-auto max-h-[calc(89vh-150px)] bg-white rounded-lg shadow-md mt-6">
                <table class="min-w-full text-sm text-left text-gray-700">
                    <thead class="bg-gray-200 sticky top-0 z-10">
                        <tr>
                            <th class="px-6 py-3 text-center">ID</th>
                            <th class="px-6 py-3 text-center">First Name</th>
                            <th class="px-6 py-3 text-center">Last Name</th>
                            <th class="px-6 py-3 text-center">Suffix</th>
                            <th class="px-6 py-3 text-center">Gender</th>
                            <th class="px-6 py-3 text-center">Birth Date</th>
                            <th class="px-6 py-3 text-center">Age</th>
                            <th class="px-6 py-3 text-center">Age Group</th>
                            <th class="px-6 py-3 text-center">Address</th>
                            <th class="px-6 py-3 text-center">Phone Number</th>
                            <th class="px-6 py-3 text-center">Email</th>
                            <th class="px-6 py-3 text-center">Contact Preference</th>
                            <th class="px-6 py-3 text-center">Interests</th>
                            <th class="px-6 py-3 text-center">Interaction History</th>
                            <th class="px-6 py-3 text-center">Invitation Source</th>
                            <th class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visitors as $visitor)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4 text-center">{{ $visitor->id }}</td>
                                <td class="px-6 py-4 text-center">{{ $visitor->first_name }}</td>
                                <td class="px-6 py-4 text-center">{{ $visitor->last_name }}</td>
                                <td class="px-6 py-4 text-center">{{ $visitor->suffix }}</td>
                                <td class="px-6 py-4 text-center">{{ $visitor->gender }}</td>
                                <td class="px-6 py-4 text-center">{{ $visitor->birth_date }}</td>
                                <td class="px-6 py-4 text-center">{{ $visitor->age }}</td>
                                <td class="px-6 py-4 text-center">{{ $visitor->age_group }}</td>
                                <td class="px-6 py-4 text-center">{{ $visitor->address }}</td>
                                <td class="px-6 py-4 text-center">{{ $visitor->phone_number }}</td>
                                <td class="px-6 py-4 text-center">{{ $visitor->email }}</td>
                                <td class="px-6 py-4 text-center">{{ $visitor->contact_preference }}</td>
                                <td class="px-6 py-4 text-center">{{ $visitor->interests }}</td>
                                <td class="px-6 py-4 text-center">{{ $visitor->interaction_history }}</td>
                                <td class="px-6 py-4 text-center">{{ $visitor->invitation_source }}</td>
                                <td class="px-6 py-4 text-center flex justify-center space-x-2">
                                    <a href="{{ route('superadmin.visitors.edit', $visitor->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                                    <form action="{{ route('superadmin.visitors.destroy', $visitor->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this visitor?')" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <style>
        /* Animation for the notification */
        .animate-fade-in-out {
            animation: fadeInOut 1.5s ease-in-out forwards;
        }
        
        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateY(-20px); }
            10% { opacity: 1; transform: translateY(0); }
            90% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-20px); }
        }
    </style>

    <script>
        // Auto-hide success message after 2 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.opacity = '0';
                    setTimeout(() => {
                        successMessage.remove();
                    }, 300); // Wait for fade out before removing
                }, 15000); // 1.5 seconds
            }
            
            adjustVisitorContentPosition();
        });

        // Show the visitor registration form link
        function showLink() {
            document.getElementById('visitorFormLink').classList.toggle('hidden');
        }

        // Copy the visitor form link to clipboard
        function copyLink() {
            const copyText = document.getElementById("visitorLink");
            navigator.clipboard.writeText(copyText.value)
                .then(() => {
                    showToast();
                })
                .catch(err => {
                    console.error("Failed to copy text: ", err);
                    alert("Failed to copy link. Please try again.");
                });
        }

        // Show toast notification
        function showToast() {
            const toast = document.getElementById('toast');
            toast.classList.remove('hidden');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000);
        }

        // Get sidebar and visitor content
        const sidebar = document.getElementById('sidebar');
        const visitorContent = document.getElementById('visitor-content');
        const sidebarToggle = document.getElementById('sidebar-toggle');

        // Function to adjust the content position based on the sidebar state
        function adjustVisitorContentPosition() {
            if (sidebar.classList.contains('collapsed')) {
                visitorContent.style.marginLeft = "0.3%"; // Adjust to the collapsed sidebar width
            } else {
                visitorContent.style.marginLeft = "0.3%"; // Adjust to the expanded sidebar width
            }
        }

        // Listen for sidebar toggle button clicks
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            adjustVisitorContentPosition();
        });

        // Initial adjustment
        adjustVisitorContentPosition();
    </script>
@endsection
