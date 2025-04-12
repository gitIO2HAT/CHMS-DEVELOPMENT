<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Participation;
use App\Models\Notification; // Make sure to import the Notification model

class UserController extends Controller
{
    // Show events for users
    public function viewEvents(Request $request)
    {
        try {
            $searchTerm = $request->input('search'); // Get the search term if any

            // Fetch events, apply search filtering if provided
            $events = Event::query()
                ->when($searchTerm, function ($query, $searchTerm) {
                    return $query->where('name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('location', 'like', '%' . $searchTerm . '%')
                        ->orWhere('category', 'like', '%' . $searchTerm . '%');
                })
                ->get();

            // Pass events and searchTerm to the view
            return view('user.events', compact('events', 'searchTerm'));
        } catch (\Exception $e) {
            \Log::error('Error fetching events for users: ' . $e->getMessage());
            return redirect()->route('user.dashboard')->with('error', 'Unable to retrieve events.');
        }
    }
        public function dashboard()
    {
        try {
            // Count upcoming events
            $upcomingEventsCount = Event::where('date', '>', now())->count();

            // Count pending requests
            $pendingRequestsCount = Participation::where('users_id', Auth::id()) // Get requests for the logged-in user
                ->where('status', 'pending') // Check for pending requests
                ->count();

            // Count new notifications (assuming 'created_at' field exists in the Notification model)
            $newNotificationsCount = Notification::where('created_at', '>=', now()->subDays(7))->count();

            // Fetch the participation requests for the logged-in user
            $participationRequests = Participation::where('users_id', Auth::id())
                ->whereIn('status', ['approved', 'rejected']) // Only fetch approved and rejected requests
                ->orderBy('updated_at', 'desc') // Sort by most recent
                ->limit(6) // Limit to 6 requests
                ->with('event') // Eager load the related Event model
                ->get();

            // Return the view with the necessary data
            return view('user.dashboard', compact('upcomingEventsCount', 'pendingRequestsCount', 'newNotificationsCount', 'participationRequests'));
        } catch (\Exception $e) {
            \Log::error('Error loading dashboard: ' . $e->getMessage());
            return redirect()->route('user.dashboard')->with('error', 'Unable to load dashboard.');
        }
    }
    public function eventsIndex()
    {
        // Fetch events from the database and pass them to the view
        $events = \App\Models\Event::all(); // Replace with your query logic
        $userParticipationRequests = Participation::where('users_id', auth()->id())->get();
        return view('user.event-user', compact('events', 'userParticipationRequests'));
    }

    public function participationHistory()
    {
        // Fetch approved past events the user has participated in
        $events = \App\Models\Event::whereHas('participations', function ($query) {
            $query->where('users_id', auth()->id())->where('status', 'approved');
        })
        ->where('date', '<', \Carbon\Carbon::now())  // Get past events
        ->get();

        // Pass events to the participation-history view
        return view('user.participation-history', compact('events')); // Use 'events' instead of 'approvedEvents'
    }
}
