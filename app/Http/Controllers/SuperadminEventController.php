<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\FeedbackRating; // Using FeedbackRating model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperadminEventController extends Controller
{
    // Show the list of events with average rating
        public function index(Request $request)
    {
        try {
            // Get the search term from the query string
            $searchTerm = $request->input('search');

            // Fetch events based on the search term
            $events = Event::with('feedbackRatings')  // Eager load feedback ratings
                ->when($searchTerm, function ($query, $searchTerm) {
                    return $query->where('name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('location', 'like', '%' . $searchTerm . '%')
                        ->orWhere('category', 'like', '%' . $searchTerm . '%');
                })
                ->get()
                ->map(function ($event) {
                    // Calculate average rating if feedbackRatings exists
                    $event->average_rating = $event->feedbackRatings->avg('rating');
                    return $event;
                });

            // Return to events view, passing in the events and search term
            return view('superadmin.events', compact('events', 'searchTerm'));
        } catch (\Exception $e) {
            \Log::error('Error fetching events: ' . $e->getMessage());
            return redirect()->route('superadmin.dashboard')->with('error', 'Unable to retrieve events.');
        }
    }


    // Show form to create a new event
    public function create()
    {
        return view('superadmin.add-event'); // This will load the add event form (add-event.blade.php)
    }

    // Store a new event
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:200',
            'category' => 'required|string|max:150',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Allow nullable images
        ]);

        // Handle file upload and update $validatedData
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('event_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Create the event in the database
        Event::create($validatedData);

        // Redirect back to event index with a success message
        return redirect()->route('superadmin.events.index')->with('success', 'Event created successfully!');
    }

    // Show form to edit an existing event
    public function edit($id)
    {
        $event = Event::findOrFail($id); // Fetch the event by its ID
        return view('superadmin.editEvent', compact('event')); // Pass the event data to the edit form
    }

    // Update event details
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id); // Fetch the event to update

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:200',
            'category' => 'required|string|max:150',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // CHANGED: Make image optional
        ]);

        // Handle file upload only if a new image is uploaded
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('event_images', 'public');
            $validatedData['image'] = $imagePath;
        } else {
            // Retain the current image if no new image is uploaded
            $validatedData['image'] = $event->image;
        }

        // Update the event in the database
        $event->update($validatedData);

        return redirect()->route('superadmin.events.index')->with('success', 'Event updated successfully!');
    }

    // Delete an event
    public function destroy($id)
    {
        $event = Event::findOrFail($id); // Fetch the event to delete
        $event->delete(); // Delete the event
        return redirect()->route('superadmin.events.index')->with('success', 'Event deleted successfully!');
    }

    // Show event details with feedback
    public function show($id)
    {
        $event = Event::with('feedbackRatings.user')->findOrFail($id); // Get event with feedbacks
        return view('superadmin.event_details', compact('event')); // Pass event data to the view
    }


    // Retrieve feedbacks for a specific event (if needed separately)
    public function getFeedbacks($eventId)
    {
        $event = Event::with('feedbackRatings.user')->findOrFail($eventId); // Load feedback with user details
        $feedbacks = $event->feedbackRatings; // Access feedbacks from the event

        return response()->json($feedbacks); // Return the feedbacks as JSON
    }
    
    
}
