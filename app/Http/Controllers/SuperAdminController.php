<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Visitor;
use App\Models\Participation;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SuperAdminController extends Controller
{
    public function Dashboard()
    {
        // ** Data Analytics **

        // Count Admins and Users
        $adminCount = User::where('role', 'admin')->count();
        $userCount = User::where('role', 'user')->count();

        // Fetch user logs (latest 10)
        $userLogs = UserLog::latest()->limit(10)->get();

        // Visitor Growth Rate per Month
        $visitorGrowthData = Visitor::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(id) as count'))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get()
            ->map(function ($item) {
                return [
                    'month' => Carbon::create()->month($item->month)->format('F'), // Convert month number to name (e.g., 1 => "January")
                    'count' => $item->count,
                ];
            });

        // Event Participation Trends
        $participationData = Participation::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(id) as count'))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get()
            ->map(function ($item) {
                return [
                    'month' => Carbon::create()->month($item->month)->format('F'), // Convert month number to name (e.g., 1 => "January")
                    'count' => $item->count,
                ];
            });

        // Visitor Profile Data
        $visitorProfileData = Visitor::select('gender', DB::raw('count(id) as count'))
            ->groupBy('gender')
            ->get();

        return view('superadmin.dashboard', compact(
            'adminCount',
            'userCount',
            'userLogs',
            'visitorGrowthData',
            'participationData',
            'visitorProfileData'
        ));
    }

    public function showParticipationRequests()
    {
        $requests = Participation::where('status', 'pending')->with('user', 'event')->get();
        return view('superadmin.participation-requests', compact('requests'));
    }

    public function approveParticipationRequest($id)
    {
        $participation = Participation::findOrFail($id);
        $participation->status = 'approved';
        $participation->save();

        return redirect()->route('superadmin.participation-requests.requests')->with('success', 'Participation request approved.');
    }

    public function rejectParticipationRequest($id)
    {
        $participation = Participation::findOrFail($id);
        $participation->status = 'rejected';
        $participation->save();

        return redirect()->route('superadmin.participation-requests.requests')->with('success', 'Participation request rejected.');
    }

    public function listParticipants()
    {
        $events = Event::whereHas('participants', function ($query) {
            $query->where('status', 'approved');
        })->get();

        return view('superadmin.participants-list', compact('events'));
    }

    // Export Report Method
    public function exportReport()
    {
        $visitorGrowthData = Visitor::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(id) as count'))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get()
            ->map(function ($item) {
                return [
                    'month' => Carbon::create()->month($item->month)->format('F'),
                    'count' => $item->count,
                ];
            });

        $fileName = 'visitor_growth_report.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
        ];

        $callback = function () use ($visitorGrowthData) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Month', 'Visitor Count']); // CSV headers

            foreach ($visitorGrowthData as $data) {
                fputcsv($file, [$data['month'], $data['count']]); // Add data rows
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Refresh Data Method (AJAX)
    public function refreshData()
    {
        // Fetch updated data
        $visitorGrowthData = Visitor::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(id) as count'))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get()
            ->map(function ($item) {
                return [
                    'month' => Carbon::create()->month($item->month)->format('F'),
                    'count' => $item->count,
                ];
            });

        $participationData = Participation::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(id) as count'))
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get()
            ->map(function ($item) {
                return [
                    'month' => Carbon::create()->month($item->month)->format('F'),
                    'count' => $item->count,
                ];
            });

        $visitorProfileData = Visitor::select('gender', DB::raw('count(id) as count'))
            ->groupBy('gender')
            ->get();

        return response()->json([
            'visitorGrowthData' => $visitorGrowthData,
            'participationData' => $participationData,
            'visitorProfileData' => $visitorProfileData,
        ]);
    }
}