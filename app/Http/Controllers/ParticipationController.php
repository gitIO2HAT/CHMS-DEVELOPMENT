<?php

namespace App\Http\Controllers;

use App\Models\Participation;
use App\Models\Event;
use Illuminate\Http\Request;

class ParticipationController extends Controller
{
    // Store participation request
    // In ParticipationController

    // Store participation
    public function store(Request $request)
    {
        $user = auth()->user();
        $event = Event::findOrFail($request->events_id);

        // Check if the user is already participating
        if ($user->participations()->where('events_id', $event->id)->exists()) {
            return redirect()->back()->with('error', 'You are already participating in this event.');
        }

        // Add participation
        $user->participations()->create([
            'events_id' => $event->id,
        ]);

        return redirect()->back()->with('success', 'You have successfully participated in the event!');
    }

    // Cancel participation
    public function cancel($id)
    {
        $participation = Participation::findOrFail($id);

        // Ensure the participation belongs to the authenticated user
        if ($participation->users_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You cannot cancel this participation.');
        }

        // Delete the participation record
        $participation->delete();

        return redirect()->back()->with('success', 'Your participation has been cancelled.');
    }

}

