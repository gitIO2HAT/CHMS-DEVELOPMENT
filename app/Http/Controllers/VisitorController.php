<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    // Publicly accessible: Display the public visitor registration form
    public function showForm()
    {
        return view('visitor_registration'); // Public registration form
    }

    // Publicly accessible: Store a new visitor from the public form
    public function storePublic(Request $request)
    {
        // Validate the request data
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

        // If the user is logged in, associate them with the visitor (user_id)
        if (auth()->check()) {
            $validatedData['user_id'] = auth()->user()->id; // Store the logged-in user's ID
        }

        try {
            // Store the validated visitor data, including user_id if available
            Visitor::create($validatedData);
            return redirect()->route('visitor_registration')->with('success', 'Thank you for registering!');
        } catch (\Exception $e) {
           // \Log::error('Error storing public visitor: ' . $e->getMessage());
            return redirect()->route('visitor_registration')->with('error', 'An error occurred while processing your request.');
        }
    }

    // Admin-only: Display the form to add a new visitor
    public function create()
    {
        return view('admin.form'); // Admin registration form
    }

    // Admin-only: Store a new visitor added by the admin
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

        if (auth()->check()) {
            $validatedData['user_id'] = auth()->user()->id; // Associate the visitor with the logged-in admin
        }

       // try {
            Visitor::create($validatedData);
            return redirect()->route('admin.visitors.index')->with('success', 'Visitor added successfully!');
        //} catch (\Exception $e) {
          // \Log::error('Error storing admin visitor: ' . $e->getMessage());
           // return redirect()->route('admin.visitors.index')->with('error', 'An error occurred while adding the visitor.');
        //}
    }

    // Admin-only: Generate a shareable link for the public visitor form
    public function shareFormLink()
    {
        $formLink = route('visitor_registration');
        return view('admin.visitors', compact('formLink'));
    }

    // Admin-only: List all visitors, with optional search query
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
    
            return view('admin.visitors', compact('visitors', 'gender'));
        } catch (\Exception $e) {
            \Log::error('Error fetching visitors: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')->with('error', 'Unable to retrieve visitors.');
        }
    }
    // Admin-only: Display the edit form for a visitor
    public function edit($id)
    {
        try {
            $visitor = Visitor::findOrFail($id);
            return view('admin.edit', compact('visitor'));
        } catch (\Exception $e) {
            \Log::error('Error finding visitor: ' . $e->getMessage());
            return redirect()->route('admin.visitors.index')->with('error', 'Visitor not found.');
        }
    }


    // Admin-only: Update a visitor's details
    public function update(Request $request, $id)
    {
        $visitor = Visitor::findOrFail($id);
        $request->validate([
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
             // Explicitly update the visitor model with the validated data
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

            return redirect()->route('admin.visitors.index')->with('success', 'Visitor updated successfully.');
    }

    // Admin-only: Delete a visitor
    public function destroy($id)
    {
        try {
            $visitor = Visitor::findOrFail($id);
            $visitor->delete();

            return redirect()->route('admin.visitors.index')->with('success', 'Visitor deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Error deleting visitor: ' . $e->getMessage());
            return redirect()->route('admin.visitors.index')->with('error', 'An error occurred while deleting the visitor.');
        }
    }
}
