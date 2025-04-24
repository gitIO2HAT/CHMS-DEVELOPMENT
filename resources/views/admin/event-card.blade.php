@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div 
        id="event-content" 
        class="flex-1 bg-gray-50 p-8 rounded-lg shadow-lg transition-all duration-300 ease-in-out">
                
        <!-- Header with Create Event Button and Search Bar -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 space-y-4 sm:space-y-0">
            <h1 class="text-3xl font-bold text-purple-700">Events</h1>
            
            <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4">
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('admin.events.create') }}" class="bg-blue-600 text-white px-4 py-2 text-sm rounded-md hover:bg-blue-700 transition duration-300 ease-in-out flex items-center">
                        <i class="fas fa-plus mr-2"></i>Create Event
                    </a>
                @endif

                <!-- Search Form -->
                <form method="GET" action="{{ route('admin.events.index') }}" class="flex items-center space-x-3">
                    <div class="relative">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ $searchTerm ?? '' }}" 
                            placeholder="Search events..." 
                            class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600 w-64"
                        />
                        <button type="submit" class="absolute right-2 top-2 text-gray-500 hover:text-blue-600 transition duration-300 ease-in-out">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Scrollable Event Cards Wrapper -->
        <div class="event-cards-wrapper flex-1 overflow-y-auto max-h-[calc(100vh-180px)]">
            <!-- Event Cards Section -->
            @foreach ($events as $event)
                <div class="event-container flex flex-col sm:flex-row space-y-4 sm:space-x-6 p-6 border rounded-lg bg-white shadow-md hover:shadow-lg transition-shadow duration-300 ease-in-out w-full mb-6">
                    <!-- Event Image -->
                    <div class="w-full sm:w-1/3">
                        <img alt="{{ $event->name }}" class="w-full h-72 rounded-lg object-cover"  src="{{ asset('storage/' . $event->image) }}"/>
                    </div>

                    <!-- Event Details -->
                    <div class="flex-1 flex flex-col space-y-4">
                        <!-- Name and Admin Icons (Edit/Delete) -->
                        <div class="flex justify-between items-center">
                            <h4 class="text-2xl font-bold text-gray-800">{{ $event->name }}</h4>
                            @if(auth()->check() && auth()->user()->role === 'admin')
                                <div class="space-x-4">
                                    <a href="{{ route('admin.events.edit', $event->id) }}" class="text-yellow-500 cursor-pointer hover:text-yellow-600 transition duration-300 ease-in-out">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this event?');" class="text-red-500 cursor-pointer hover:text-red-600 transition duration-300 ease-in-out">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>

                        <!-- Event Information -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600"><i class="fas fa-tag mr-2"></i>{{ $event->category }}</p>
                                <p class="text-sm text-gray-600"><i class="fas fa-calendar-day mr-2"></i>{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600"><i class="fas fa-clock mr-2"></i>{{ $event->time }}</p>
                                <p class="text-sm text-gray-600"><i class="fas fa-map-marker-alt mr-2"></i>{{ $event->location }}</p>
                            </div>
                        </div>

                        <!-- Event Description -->
                        <div class="flex-1 overflow-hidden">
                            <p class="text-sm text-gray-700">{{ Str::limit($event->description, 150) }}</p>
                        </div>

                        <!-- Rating and Feedback Section -->
                        <div class="flex flex-col sm:flex-row items-center justify-between space-x-3 mt-4">
                            @if(auth()->check() && auth()->user()->role === 'user')
                                <div class="flex items-center space-x-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star cursor-pointer text-yellow-400 hover:text-yellow-500 transition duration-300 ease-in-out" id="star-{{ $event->id }}-{{ $i }}" onclick="rateEvent({{ $event->id }}, {{ $i }})"></i>
                                    @endfor
                                </div>
                                <i onclick="showFeedbackForm({{ $event->id }})" class="fas fa-comment-dots cursor-pointer text-blue-600 hover:text-blue-700 transition duration-300 ease-in-out"></i>
                            @elseif(auth()->check() && auth()->user()->role === 'admin')
                                <div class="flex items-center space-x-4">
                                    <span class="text-gray-700">
                                        <i class="fas fa-star text-yellow-400"></i> Rating: 
                                        @php $avgRating = $event->average_rating ?: 0; @endphp
                                        {{ number_format($avgRating, 1) }}/5
                                    </span>
                                    <span 
                                        class="text-gray-700 cursor-pointer hover:text-blue-600 transition duration-300 ease-in-out"
                                        onclick="showFeedbacks({{ $event->id }})">
                                        <i class="fas fa-comment text-blue-600"></i> Feedback: {{ $event->feedbackRatings ? $event->feedbackRatings->count() : 0 }} reviews
                                    </span>
                                    <a href="{{ route('admin.events.feedbacks', $event->id) }}" class="btn btn-info text-white px-2 py-1 text-sm rounded-md hover:bg-blue-700 transition duration-300 ease-in-out flex items-center">View Feedbacks</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Feedback Modal -->
    <div id="feedbackModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Feedbacks</h3>
                <button onclick="closeFeedbackModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="feedbackContent" class="space-y-4 max-h-96 overflow-y-auto">
                <!-- Feedback content will be dynamically loaded here -->
            </div>
        </div>
    </div>

    <script>
        // Function to show feedbacks in a modal
        function showFeedbacks(eventId) {
            console.log(`Fetching feedbacks for event ID: ${eventId}`); // Debugging

            fetch(`/events/${eventId}/feedbacks`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Feedbacks fetched:', data); // Debugging

                    const feedbackContent = document.getElementById('feedbackContent');
                    feedbackContent.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(feedback => {
                            const feedbackItem = `
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-gray-700"><span class="font-semibold">User:</span> ${feedback.user.name}</p>
                                    <p class="text-gray-700"><span class="font-semibold">Feedback:</span> ${feedback.feedback_text}</p>
                                    <p class="text-gray-700"><span class="font-semibold">Rating:</span> ${feedback.rating}/5</p>
                                </div>
                            `;
                            feedbackContent.innerHTML += feedbackItem;
                        });
                    } else {
                        feedbackContent.innerHTML = '<p class="text-gray-600">No feedbacks available for this event.</p>';
                    }

                    // Show the modal
                    const modal = document.getElementById('feedbackModal');
                    modal.classList.remove('hidden');
                    console.log('Modal shown'); // Debugging
                })
                .catch(error => {
                    console.error('Error fetching feedbacks:', error);
                    alert('Failed to load feedbacks. Please check the console for details.');
                });
        }

        // Function to close the feedback modal
        function closeFeedbackModal() {
            const modal = document.getElementById('feedbackModal');
            modal.classList.add('hidden');
            console.log('Modal hidden'); // Debugging
        }

        // Adjust content position based on sidebar state
        const sidebar = document.getElementById('sidebar');
        const eventContent = document.getElementById('event-content');
        const sidebarToggle = document.getElementById('sidebar-toggle');

        function adjustEventContentPosition() {
            if (sidebar.classList.contains('collapsed')) {
                eventContent.style.marginLeft = "0.3%";
            } else {
                eventContent.style.marginLeft = "0.3%";
            }
        }

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            adjustEventContentPosition();
        });

        adjustEventContentPosition();
    </script>
@endsection
