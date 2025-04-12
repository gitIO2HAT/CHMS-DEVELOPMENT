<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationEmail;
use App\Models\Notification;
use App\Models\User;
use App\Models\Event;

class SuperadminNotificationsController extends Controller
{
    // Display all notifications
    public function index()
    {
        $notifications = DB::table('notifications')
            ->leftJoin('events', 'notifications.event_id', '=', 'events.id')
            ->select(
                'notifications.id',
                'notifications.name',
                'notifications.date_time',
                'notifications.message',
                'events.name as event_name'
            )
            ->orderBy('notifications.date_time', 'desc')
            ->get();

        return view('superadmin.notifications', compact('notifications'));
    }

    // Display the form to create a new notification
    public function create()
    {
        // Fetch events to show as options in the form
        $events = Event::select('id', 'name')->get();

        // Fetch all users with the 'user' role
        $users = User::where('role', 'user')->get();

        return view('superadmin.create-notification', compact('events', 'users'));
    }

    // Store the new notification in the database and send email if needed
    public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'name' => 'required|string|max:255',
            'date_time' => 'required|date',
            'message' => 'required|string',
            'event_id' => 'nullable|exists:events,id',
        ]);

        // Insert the notification into the database using Eloquent
        $notification = Notification::create([
            'name' => $request->name,
            'date_time' => $request->date_time,
            'message' => $request->message,
            'event_id' => $request->event_id,
            'user_id' => auth()->user()->id, // Add the user ID from auth if needed
        ]);

        // Check the button action
        if ($request->input('action') === 'post_notification') {
            // Handle the posting of the notification (just saving to the database)
            return redirect()->route('superadmin.notifications.index')->with('success', 'Notification created successfully!');
        }

        // If there are user IDs selected, send email notifications
        if ($request->has('user_ids') && !empty($request->user_ids)) {
            $this->sendEmailNotifications($request->user_ids, $notification);
        }

        return redirect()->route('superadmin.notifications.index')->with('success', 'Notification created successfully!');
    }

}
