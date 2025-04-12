@extends('layouts.app')

@section('title', 'Visitor Registration')

@section('content')

<div id="feedback-overlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 backdrop-blur-sm transition-opacity duration-300">
    <div class="bg-white rounded-lg shadow-2xl p-6 w-full max-w-2xl transform transition-transform duration-300 scale-95 hover:scale-100">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h3 class="text-2xl font-semibold text-gray-800">Feedbacks for {{ $event->name }}</h3>
            <button onclick="closeFeedbackOverlay()" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Feedback List (Scrollable) -->
        <div class="space-y-4 max-h-96 overflow-y-auto pr-4 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200">
            @forelse($feedbacks as $feedback)
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-blue-500"></i>
                        </div>
                        <p class="text-gray-700 font-semibold">{{ $feedback->user->name }}</p>
                    </div>
                    <p class="text-gray-700 mb-2"><span class="font-semibold">Feedback:</span> {{ $feedback->feedback_text }}</p>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-700 font-semibold">Rating:</span>
                        <div class="flex space-x-1">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $feedback->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                            @endfor
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <i class="fas fa-comment-slash text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-600">No feedbacks available for this event.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- JavaScript to Close the Feedback Overlay -->
<script>
    function closeFeedbackOverlay() {
        const overlay = document.getElementById('feedback-overlay');
        overlay.classList.add('opacity-0');
        setTimeout(() => {
            overlay.remove(); // Remove the overlay
            window.location.href = "{{ route('admin.events.index', $event->id) }}"; // Redirect to event-card view
        }, 300); // Match the duration of the transition
    }
</script>

@endsection
