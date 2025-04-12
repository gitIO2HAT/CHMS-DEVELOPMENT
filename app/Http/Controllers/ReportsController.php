<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Barryvdh\Snappy\Facades\SnappyPdf;
use App\Models\Event;
use App\Models\FeedbackRating;
use Illuminate\Http\Request;


class ReportsController extends Controller
{
    public function generateVisitorReport()
    {
        // Fetch visitors grouped by gender and age_group
        $visitors = DB::table('visitors')
            ->select('gender', 'age_group', DB::raw('COUNT(*) as total'))
            ->groupBy('gender', 'age_group')
            ->get();
        $events = Event::all(); 

        // Pass the data to the reports view
        return view('admin.reports', compact('visitors', 'events'));
    }

    public function exportVisitorReport()
    {
        // Fetch data from the visitors table
        $visitors = DB::table('visitors')
            ->select('gender', 'age_group', DB::raw('COUNT(*) as total'))
            ->groupBy('gender', 'age_group')
            ->get();

        // Define the CSV headers
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=visitor_report.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        // Callback function to write the CSV
        $callback = function () use ($visitors) {
            $file = fopen('php://output', 'w');
            // Add header row
            fputcsv($file, ['Gender', 'Age Group', 'Total Visitors']);

            // Add data rows
            foreach ($visitors as $visitor) {
                fputcsv($file, [$visitor->gender, $visitor->age_group, $visitor->total]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    
    public function generateEventPDF(Request $request)
    {
        try {
            // Step 1: Get the selected event ID from the request
            $eventId = $request->input('events_id');
            if (!$eventId) {
                return redirect()->back()->with('error', 'Event ID is missing.');
            }
    
            // Step 2: Fetch the event name along with feedback details and user name
            $feedbacks = DB::table('feedback_ratings')
                ->join('events', 'feedback_ratings.events_id', '=', 'events.id')
                ->join('users', 'feedback_ratings.users_id', '=', 'users.id')
                ->select('events.name as event_name', 'feedback_ratings.feedback_text', 'feedback_ratings.rating', 'users.name as user_name')
                ->where('feedback_ratings.events_id', $eventId)
                ->get();
    
            // Step 3: Generate the PDF view with event name and user name
            $pdf = SnappyPdf::loadView('admin.event_pdf', [
                'feedbacks' => $feedbacks,
            ]);
    
            return $pdf->download('event_report.pdf');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
}
