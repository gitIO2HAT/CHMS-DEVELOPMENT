<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserLog;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('login'); // Ensure this matches resources/views/login.blade.php
    }

    // Handle login submission with validation
    public function login(Request $request)
    {
        // Validate login inputs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Retrieve credentials from the request
        $credentials = $request->only('email', 'password');

        // Find the user by email
        $user = \App\Models\User::where('email', $credentials['email'])->first();

        // Attempt to log the user in with "remember me" functionality
        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Log the user in with "remember me" functionality
            Auth::login($user, $request->filled('remember'));

            // Check if there's an existing log for this user
            $userLog = UserLog::where('users_id', $user->id)->where('action', 'Logged_in')->first();

            if ($userLog) {
                // If there's an existing login log, we don't create a new one but update it
                $userLog->update([
                    'action' => 'Logged_in', // Ensure the action is 'Login'
                    'ip_address' => $request->ip(),
                    'updated_at' => now(),
                ]);
            } else {
                // Create a new log entry for the login
                UserLog::create([
                    'users_id' => $user->id, // Store the user ID
                    'action' => 'Logged_in', // Log the action as 'Login'
                    'ip_address' => $request->ip(), // Record the IP address of the login attempt
                    'created_at' => now(), // Store the login time
                    'updated_at' => now(), // You can keep the update time the same as created
                ]);
            }

            // Redirect the user to their dashboard based on their role
            if (strtolower($user->role) === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif (strtolower($user->role) === 'superadmin') {
                return redirect()->intended('/superadmin/dashboard');
            } else {
                return redirect()->intended('/user/dashboard');
            }
        }

        // If credentials are invalid, redirect back with error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Handle logout
    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            // Find the last login log entry for this user
            $userLog = UserLog::where('users_id', $user->id)->where('action', 'Logged_in')->latest()->first();

            // If there's a login log entry, update the action to 'Logout'
            if ($userLog) {
                $userLog->update([
                    'action' => 'Logged_out', // Change action to 'Logout'
                    'ip_address' => $request->ip(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Log the user out
        Auth::logout();

        // Redirect to login page
        return redirect('/');
    }
}
