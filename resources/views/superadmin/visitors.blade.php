@extends('layouts.superadminlayout')

@section('title', 'Visitor List')

@section('content')
    <div id="visitor-content" class="min-h-screen flex-1 flex-col items-center shadow-md transition-all duration-300 ease-in-out py-8 mt-0">
        <div class="max-w-6xl w-full px-6 py-6 bg-white rounded-lg shadow-md">
            <!-- Header with Visitor List and Add Visitor button -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-semibold text-gray-800">Visitor List</h1>
                <div class="flex space-x-4">
                    <a href="{{ route('superadmin.visitors.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200">
                        Add Visitor
                    </a>
                    <a href="javascript:void(0)" onclick="showLink()" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition duration-200">
                        Share Form
                    </a>
                    
                    <form method="GET" action="{{ route('superadmin.visitors.index') }}" class="flex space-x-2">
                        <input type="text" name="search" placeholder="Search by name..." value="{{ request()->search }}" class="p-2 border border-gray-300 rounded-md w-full">
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Search</button>
                    </form>
                </div>
            </div>

            <!-- Success message -->
            @if(session('success'))
                <div class="mb-4 text-green-600 p-3 border border-green-200 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Visitor Registration Form Link -->
            <div id="visitorFormLink" class="mt-4 hidden">
                <input type="text" id="visitorLink" value="{{ route('visitor_registration') }}" readonly class="p-2 border border-gray-300 rounded-md w-full">
                <button onclick="copyLink()" class="mt-2 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Copy Link</button>
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

    <script>
        // Show the visitor registration form link
        function showLink() {
            document.getElementById('visitorFormLink').classList.remove('hidden');
        }

        // Copy the visitor form link to clipboard using Clipboard API
        function copyLink() {
            const copyText = document.getElementById("visitorLink");
            navigator.clipboard.writeText(copyText.value)
                .then(() => {
                    alert("Link copied to clipboard: " + copyText.value);
                })
                .catch(err => {
                    console.error("Failed to copy text: ", err);
                });
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
