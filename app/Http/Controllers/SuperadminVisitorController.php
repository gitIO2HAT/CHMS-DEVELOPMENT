<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class SuperadminVisitorController extends Controller
{
    public function index(Request $request)
    {
        try { 
            $searchTerm = $request->input('search');
            $gender = $request->input('gender');

            $visitors = Visitor::query()
                ->when($searchTerm, function ($query, $searchTerm) {
                    $query->where(function ($subQuery) use ($searchTerm) {
                        $subQuery->where('first_name', 'like', '%' . $searchTerm . '%')
                                 ->orWhere('last_name', 'like', '%' . $searchTerm . '%');
                    });
                })
                ->when($gender, function ($query, $gender) {
                    return $query->where('gender', $gender);
                })
                ->orderBy('created_at', 'desc')
                ->get();

            return view('superadmin.visitors', compact('visitors', 'gender'));
        } catch (\Exception $e) {
            \Log::error('Error fetching visitors: ' . $e->getMessage());
            return redirect()->route('superadmin.dashboard')->with('error', 'Unable to retrieve visitors.');
        }
    }

    public function create()
    {
        return view('superadmin.form');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'nullable|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'suffix' => 'nullable|in:N/A,Jr.,Sr.,I,II,III,IV,V',
            'birth_date' => 'nullable|date',
            'gender' => 'required|in:Male,Female,Non-binary,Other,Prefer_not_to_say',
            'age' => 'nullable|integer|min:0|max:120',
            'age_group' => 'required|in:Child(0-12),Teen(13-19),Young_Adult(20-29),Adult(30-59),Senior(60+)',
            'address' => 'nullable|string|max:100',
            'invitation_source' => 'required|in:Friend,Social_Media,Website,Flyer',
            'phone_number' => 'nullable|string|max:20',
            'interests' => 'nullable|string|max:200',
            'email' => 'nullable|email|max:100',
            'contact_preference' => 'required|in:Email,Phone,No_Preference',
            'interaction_history' => 'required|in:Event,Church_Service,Online,In_Person',
        ]);

        Visitor::create($validatedData);

        return redirect()->route('superadmin.visitors.index')->with('success', 'Visitor created successfully.');
    }

    public function edit($id)
    {
        try {
            $visitor = Visitor::findOrFail($id);
            return view('superadmin.edit', compact('visitor'));
        } catch (\Exception $e) {
            \Log::error('Error finding visitor: ' . $e->getMessage());
            return redirect()->route('superadmin.visitors.index')->with('error', 'Visitor not found.');
        }
    }

    public function update(Request $request, $id)
    {
        $visitor = Visitor::findOrFail($id);
        $validatedData = $request->validate([
            'first_name' => 'nullable|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'suffix' => 'nullable|in:N/A,Jr.,Sr.,I,II,III,IV,V', // Ensure valid suffix value
            'birth_date' => 'nullable|date',
            'gender' => 'required|in:Male,Female,Non-binary,Other,Prefer_not_to_say',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone_number' => 'nullable|string|max:15',
            'age' => 'nullable|integer|min:0',
            'age_group' => 'required|in:Child(0-12),Teen(13-19),Young_Adult(20-29),Adult(30-59),Senior(60+)',
        ]);
        $visitor->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'suffix' => $request->suffix,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'address' => $request->address,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'age' => $request->age,
            'age_group' => $request->age_group,
        ]);

        return redirect()->route('superadmin.visitors.index')->with('success', 'Visitor updated successfully.');
    }

    public function destroy($id)
    {
        try {
            $visitor = Visitor::findOrFail($id);
            $visitor->delete();

            return redirect()->route('superadmin.visitors.index')->with('success', 'Visitor deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Error deleting visitor: ' . $e->getMessage());
            return redirect()->route('superadmin.visitors.index')->with('error', 'An error occurred while deleting the visitor.');
        }
    }
}
