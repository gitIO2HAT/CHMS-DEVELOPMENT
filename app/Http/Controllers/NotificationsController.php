<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationEmail;
use App\Models\Notification;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Log;

class NotificationsController extends Controller
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
            ->orderByDesc('notifications.date_time')
            ->get();

        return view('admin.notifications', compact('notifications'));
    }

    // Display the form to create a new notification
    public function create()
    {
        $events = Event::select('id', 'name')->get();
        $users = User::select('id', 'name')->get(); // Fetch all users for selection

        return view('admin.create-notification', compact('events', 'users'));
    }

    // Store a new notification and send emails
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'date_time' => 'required|date|after:now',
            'message'   => 'required|string',
            'event_id'  => 'nullable|exists:events,id',
        ]);

        // Ensure user is authenticated before proceeding
        $validated['user_id'] = auth()->id();

        // Create the notification
        $notification = Notification::create($validated);

        // Log the notification creation
        Log::info("Notification created successfully", [
            'id'       => $notification->id,
            'name'     => $notification->name,
            'date_time'=> $notification->date_time,
        ]);

        // Send emails to all users
        Log::info("Sending notification emails to all users...");
        $this->sendEmailNotifications($notification);

        return redirect()->route('admin.notifications.index')
            ->with('success', 'Notification created and emails sent successfully!');
    }

    // Send emails to all users
    protected function sendEmailNotifications($notification)
    {
        $users = User::all(); // Fetch all users

        if ($users->isEmpty()) {
            Log::warning("No users found for email notification.");
            return;
        }

        try {
            foreach ($users as $user) {
                Mail::to($user->email)->queue(new NotificationEmail($notification, $user));            
            }
            Log::info("Emails queued successfully for all users.", ['user_count' => $users->count()]);
        } catch (\Exception $e) {
            Log::error("Failed to send email notifications: " . $e->getMessage());
        }
    }

        public function sendEmail(Request $request)
    {
        $validated = $request->validate([
            'user_ids'  => 'required|array',
            'user_ids.*'=> 'exists:users,id',
            'title'     => 'required|string|max:255',
            'message'   => 'required|string',
        ]);

        Log::info("Manual email sending requested.", ['users' => $validated['user_ids']]);

        $users = User::whereIn('id', $validated['user_ids'])->get();
        if ($users->isEmpty()) {
            Log::warning("No users found for manual email sending.");
            return back()->with('error', 'No users selected.');
        }

        try {
            foreach ($users as $user) {
                Mail::to($user->email)->send(new NotificationEmail((object) [
                    'name'    => $validated['title'],
                    'message' => $validated['message']
                ], $user));
            }
            Log::info("Emails sent successfully.", ['user_count' => $users->count()]);
            return redirect()->route('admin.notifications.index')->with('success', 'Emails sent successfully.');
        } catch (\Exception $e) {
            Log::error("Failed to send emails: " . $e->getMessage());
            return back()->with('error', 'Failed to send emails.');
        }
    }

    // Display notifications for users
    public function userNotifications()
    {
        $notifications = Notification::orderByDesc('date_time')->get();
        return view('user.notifications', compact('notifications'));
    }

    // Display email form with user selection
    public function emailUsers()
    {
        $users = User::select('id', 'name', 'email')->get(); // Fetch all users
        return view('admin.email-users', compact('users'));
    }
}