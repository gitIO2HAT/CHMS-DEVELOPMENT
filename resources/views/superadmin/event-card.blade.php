@extends('layouts.superadminlayout')

@section('title', 'Superadmin Dashboard')

@section('content')
    <div 
        id="event-content" 
        class="flex-1 bg-gray-50 p-6 rounded-lg shadow-md transition-all duration-300 ease-in-out">
                
        <!-- Header with Create Event Button and Search Bar -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 space-y-4 sm:space-y-0">
            <h1 class="text-3xl font-bold text-purple-700">Events</h1>
            <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4">
                @if(auth()->check() && auth()->user()->role === 'superadmin')
                    <a href="{{ route('superadmin.events.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out">
                        Create Event
                    </a>
                @endif
                <!-- Search Form -->
                <form method="GET" action="{{ route('superadmin.events.index') }}" class="flex items-center space-x-3">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ $searchTerm ?? '' }}" 
                        placeholder="Search events..." 
                        class="px-4 py-2 rounded-lg border border-gray-300"
                    />
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out">
                        Search
                    </button>
                </form>
            </div>
        </div>


        <!-- Scrollable Event Cards Wrapper -->
        <div class="event-cards-wrapper flex-1 overflow-y-auto max-h-[calc(100vh-180px)]">
            <!-- Event Cards Section -->
            @foreach ($events as $event)
                <div class="event-container flex flex-col sm:flex-row space-y-4 sm:space-x-4 p-6 border rounded-lg bg-white shadow-md w-full bg-gray-50 mb-4">
                    <!-- Event Image -->
                    <div class="w-full sm:w-1/3">
                        <img alt="{{ $event->name }}" class="w-full h-72 rounded-lg object-cover" src="{{ asset('storage/' . $event->image) }}"/>
                    </div>

                    <!-- Event Details -->
                    <div class="flex-1 flex flex-col space-y-3">
                        <!-- Name and SuperAdmin Icons (Edit/Delete) -->
                        <div class="flex justify-between items-center">
                            <h4 class="text-xl font-bold text-gray-800">{{ $event->name }}</h4>
                            @if(auth()->check() && auth()->user()->role === 'superadmin')
                                <div class="space-x-3">
                                    <a href="{{ route('superadmin.events.edit', $event->id) }}" class="text-yellow-500 cursor-pointer">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('superadmin.events.destroy', $event->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this event?');" class="text-red-500 cursor-pointer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>

                        <!-- Event Information -->
                        <p class="text-sm text-gray-500">{{ $event->category }}</p>
                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</p>
                        <p class="text-sm text-gray-500">{{ $event->time }}</p>
                        <p class="text-sm text-gray-500">{{ $event->location }}</p>

                        <!-- Event Description -->
                        <div class="flex-1 overflow-hidden">
                            <p class="text-sm mt-2 text-gray-600">{{ Str::limit($event->description, 100) }}</p>
                        </div>

                        <!-- Rating and Feedback Section -->
                        <div class="flex flex-col sm:flex-row items-center justify-between space-x-3 mt-4">
                            @if(auth()->check() && auth()->user()->role === 'user')
                                <span class="star text-yellow-400">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star cursor-pointer" id="star-{{ $event->id }}-{{ $i }}" onclick="rateEvent({{ $event->id }}, {{ $i }})"></i>
                                    @endfor
                                </span>
                                <i onclick="showFeedbackForm({{ $event->id }})" class="fas fa-comment-dots cursor-pointer text-blue-500"></i>
                            @elseif(auth()->check() && auth()->user()->role === 'superadmin')
                                <div class="space-x-3">
                                    <span>Rating: 
                                        @php $avgRating = $event->average_rating ?: 0; @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                             <i class="fas fa-star {{ $i <= $avgRating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                        @endfor
                                    </span>
                                    <span>Feedback: {{ $event->feedbackRatings ? $event->feedbackRatings->count() : 0 }} reviews</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        // Get sidebar and event content
        const sidebar = document.getElementById('sidebar');
        const eventContent = document.getElementById('event-content');
        const sidebarToggle = document.getElementById('sidebar-toggle');

        // Function to adjust the content position based on the sidebar state
        function adjustEventContentPosition() {
            if (sidebar.classList.contains('collapsed')) {
                eventContent.style.marginLeft = "0.3%"; // Adjust to the collapsed sidebar width
            } else {
                eventContent.style.marginLeft = "0.3%"; // Adjust to the expanded sidebar width
            }
        }

        // Listen for sidebar toggle button clicks
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            adjustEventContentPosition();
        });

        // Initial adjustment
        adjustEventContentPosition();
    </script>
@endsection
