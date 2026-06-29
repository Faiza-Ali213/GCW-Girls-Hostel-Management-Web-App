<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    /**
     * Display a listing of complaints.
     */
    public function index()
    {
        $complaints = Complaint::orderBy('created_at', 'desc')->get();
        $pendingCount = Complaint::where('status', 'pending')->count();
        $inProgressCount = Complaint::where('status', 'in_progress')->count();
        $resolvedCount = Complaint::where('status', 'resolved')->count();
        
        return view('Pages.Admin.Complain_request', compact('complaints', 'pendingCount', 'inProgressCount', 'resolvedCount'));
    }

    /**
     * Show form to create new complaint.
     */
    public function create()
    {
        return view('Component.Admin.add_complaint');
    }

    /**
     * Store a new complaint.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'student_name' => 'required|string|max:255',
            'room_number' => 'nullable|string|max:50',
            'contact_number' => 'nullable|string|max:20',
            'priority' => 'required|in:low,medium,high',
        ]);

        $validated['status'] = 'pending';
        
        Complaint::create($validated);

        return redirect()->route('complaints.index')->with('success', 'Complaint submitted successfully!');
    }

    /**
     * Show a specific complaint.
     */
    public function show($id)
    {
        $complaint = Complaint::findOrFail($id);
        return view('Component.Admin.view_complaint', compact('complaint'));
    }

    /**
     * Show form to edit complaint.
     */
    public function edit($id)
    {
        $complaint = Complaint::findOrFail($id);
        return view('Component.Admin.edit_complaint', compact('complaint'));
    }

    /**
     * Update a complaint.
     */
    public function update(Request $request, $id)
    {
        $complaint = Complaint::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:pending,in_progress,resolved,rejected',
            'priority' => 'sometimes|required|in:low,medium,high',
            'admin_remark' => 'nullable|string',
            'student_name' => 'sometimes|required|string|max:255',
            'room_number' => 'nullable|string|max:50',
            'contact_number' => 'nullable|string|max:20',
        ]);

        if (isset($validated['status']) && $validated['status'] == 'resolved' && $complaint->status != 'resolved') {
            $validated['resolved_at'] = now();
        }

        $complaint->update($validated);

        return redirect()->route('complaints.index')->with('success', 'Complaint updated successfully!');
    }

    /**
     * Delete a complaint.
     */
    public function destroy($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->delete();

        return redirect()->route('complaints.index')->with('success', 'Complaint deleted successfully!');
    }
}