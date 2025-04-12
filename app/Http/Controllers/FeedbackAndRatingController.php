<?php

namespace App\Http\Controllers;

use App\Models\FeedbackRating;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log; // Import Log facade for debugging

class FeedbackAndRatingController extends Controller
{
    // Ensure only authenticated users can access these methods
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Store or update feedback and rating
    public function storeFeedback(Request $request, $eventId)
    {
        // Validate input
        $validated = $request->validate([
            'feedback_text' => 'required|string|max:1000', // Feedback can be optional
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Check if event exists
        $event = Event::find($eventId);
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        // Check if the user already submitted feedback for this event
        $feedback = FeedbackRating::updateOrCreate(
            [
                'events_id' => $eventId,
                'users_id' => auth()->id(),
            ],
            [
                'feedback_text' => $validated['feedback_text'] ?? null, // Null if not provided
                'rating' => $validated['rating'],
            ]
        );

        $message = $feedback->wasRecentlyCreated ? 'Feedback submitted successfully!' : 'Feedback updated successfully!';

        // Redirect back to the participation history page with success message
         return redirect()->route('user.history')->with('success', 'Feedback submitted successfully!');
    }

    // Calculate and return the average rating for an event
    public function getAverageRating($eventId)
    {
        // Check if event exists
        $event = Event::find($eventId);
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        // Calculate the average rating
        $averageRating = FeedbackRating::where('events_id', $eventId)->avg('rating');

        return response()->json([
            'events_id' => $eventId,
            'average_rating' => $averageRating ? round($averageRating, 2) : 'No ratings yet',
        ]);
    }

        public function viewFeedbacks($eventId)
    {
        // Check if event exists
        $event = Event::find($eventId);
        if (!$event) {
            return redirect()->back()->with('error', 'Event not found');
        }

        // Fetch feedbacks with user details
        $feedbacks = FeedbackRating::where('events_id', $eventId)->with('user')->get();

        // Return a view with event and feedback data
        return view('admin.feedbacks', compact('event', 'feedbacks'));
    }


    // Relationship: FeedbackRating belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // Relationship: User has many FeedbackRatings
    public function feedbackRatings()
    {
        return $this->hasMany(FeedbackRating::class, 'users_id');
    }
}