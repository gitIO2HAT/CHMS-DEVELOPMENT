<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Visitor;
use App\Models\Participation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function Dashboard()
    {
        $totalVisitors = Visitor::count();
        $recentEvents = Event::latest()->take(3)->get();
        $recentVisitors = Visitor::latest()->take(4)->get();
        $upcomingEventsCount = Event::where('date', '>', now())->count();
        $newVisitorsThisWeek = Visitor::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();

        return view('admin.dashboard', compact('totalVisitors', 'recentEvents', 'recentVisitors', 'upcomingEventsCount', 'newVisitorsThisWeek'));
    }

    public function showParticipationRequests()
    {
        $requests = Participation::where('status', 'pending')->with('user', 'event')->get();
        return view('admin.participation-requests', compact('requests'));
    }

    public function approveParticipationRequest($id)
    {
        $participation = Participation::findOrFail($id);
        $participation->status = 'approved';
        $participation->save();
        return redirect()->route('admin.participation-requests.requests')->with('success', 'Participation request approved.');
    }

    public function rejectParticipationRequest($id)
    {
        $participation = Participation::findOrFail($id);
        $participation->status = 'rejected';
        $participation->save();
        return redirect()->route('admin.participation-requests.requests')->with('success', 'Participation request rejected.');
    }

    public function listParticipants()
    {
        $events = Event::whereHas('participants', function ($query) {
            $query->where('status', 'approved');
        })->get();
        return view('admin.participants-list', compact('events'));
    }

    // User Management
    public function index(Request $request)
    {
        // Add search functionality
        $search = $request->query('search');
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('role', 'like', "%{$search}%");
        })->paginate(10); // Use paginate() instead of all()

        return view('admin.index', compact('users'));
    }

    public function create()
    {
        return view('admin.create'); // Updated to match "users.create" route
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User added successfully!');
    }

    public function edit_user($id)
    {
        $user = User::findOrFail($id);
        return view('admin.useredit', compact('user')); // Updated to match "users.edit" route
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
}