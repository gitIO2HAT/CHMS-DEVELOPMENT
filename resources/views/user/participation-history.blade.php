@extends('layouts.userlayout')

@section('content')
<div class="container mx-auto p-6">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-purple-600 mb-2">Your Participation History</h1>
        <p class="text-lg text-gray-600">Here’s a list of events you’ve participated in.</p>
    </div>

    <!-- Events Grid -->
    <div class="overflow-y-auto max-h-[calc(100vh-300px)] pb-8"> <!-- Adjusted height and added padding -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($events as $event)
                @if(\Carbon\Carbon::parse($event->date)->lt(\Carbon\Carbon::today()))  <!-- Only show past events -->
                    <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out overflow-hidden">
                        <!-- Event Image -->
                        <div class="w-full h-48 overflow-hidden">
                            <img 
                                src="{{ asset('storage/' . $event->image) }}" 
                                alt="{{ $event->name }} Image" 
                                class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-300"
                            />
                        </div>

                        <!-- Event Details -->
                        <div class="p-6">
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $event->name }}</h2>
                            <div class="space-y-2 text-gray-600">
                                <p><span class="font-semibold">Location:</span> {{ $event->location }}</p>
                                <p><span class="font-semibold">Category:</span> {{ $event->category }}</p>
                                <p><span class="font-semibold">Date:</span> {{ \Carbon\Carbon::parse($event->date)->format('F d, Y') }}</p>
                            </div>

                            <!-- Feedback Section -->
                            @php
                                $feedback = $event->feedbackRatings->where('users_id', auth()->id())->first();
                            @endphp

                            @if($feedback)
                                <!-- Display Feedback and Rating -->
                                <div class="mt-4">
                                    <p class="text-gray-600"><span class="font-semibold">Your Feedback:</span> {{ $feedback->feedback }}</p>
                                    <div class="flex items-center mt-2">
                                        <span class="font-semibold text-gray-600">Your Rating:</span>
                                        <div class="flex space-x-1 ml-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span class="text-yellow-500">{{ $i <= $feedback->rating ? '★' : '☆' }}</span>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Feedback and Rating Form -->
                                <form method="POST" action="{{ route('user.events.feedback_rating', $event->id) }}" class="mt-4">
                                    @csrf

                                    <!-- Feedback Textarea -->
                                    <textarea 
                                        name="feedback_text" 
                                        placeholder="Leave your feedback..." 
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                        rows="3"
                                    ></textarea>

                                    <!-- Rating System -->
                                    <div class="mt-3">
                                        <label class="block text-gray-600 font-semibold mb-1">Rating:</label>
                                        <div class="flex space-x-1" id="rating-stars-{{ $event->id }}">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span 
                                                    class="text-2xl cursor-pointer text-gray-300 hover:text-yellow-500 transition-colors duration-200"
                                                    data-value="{{ $i }}"
                                                    onclick="selectRating({{ $event->id }}, {{ $i }})"
                                                >&#9733;</span>
                                            @endfor
                                        </div>
                                        <input type="hidden" name="rating" id="selected-rating-{{ $event->id }}" required>
                                    </div>

                                    <!-- Submit Button -->
                                    <button 
                                        type="submit" 
                                        class="bg-purple-500 text-white px-6 py-2 rounded-lg hover:bg-purple-600 transition-all duration-300 w-full mt-4"
                                    >
                                        Submit Feedback
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endif
            @empty
                <!-- Empty State -->
                <div class="col-span-full text-center py-8">
                    <p class="text-gray-600">You have no past events with approved participation.</p>
                    <a href="{{ route('user.events') }}" class="text-purple-500 hover:text-purple-600 font-semibold mt-2">
                        Explore Upcoming Events →
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- JavaScript for Rating System -->
<script>
    function selectRating(eventId, rating) {
        // Update the hidden input value for the selected rating
        document.getElementById(`selected-rating-${eventId}`).value = rating;

        // Update the star colors dynamically
        const stars = document.querySelectorAll(`#rating-stars-${eventId} span`);
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-500');
            } else {
                star.classList.remove('text-yellow-500');
                star.classList.add('text-gray-300');
            }
        });
    }
</script>
@endsection