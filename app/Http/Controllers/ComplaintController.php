<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'student_id' => 'nullable|exists:students,id',
            'student_name' => 'required|string|max:255',
            'room_number' => 'nullable|string|max:50',
            'contact_number' => 'nullable|string|max:20',
            'priority' => 'required|in:low,medium,high',
            'category' => 'nullable|string|max:100',
        ]);

        // Set default status
        $validated['status'] = 'pending';
        
        // If student_id is provided, fetch student details
        if ($request->filled('student_id')) {
            $student = Student::find($request->student_id);
            if ($student) {
                $validated['student_name'] = $student->name;
                $validated['room_number'] = $student->room_number ?? $validated['room_number'];
                $validated['contact_number'] = $student->phone ?? $validated['contact_number'];
            }
        }

        // Create the complaint
        $complaint = Complaint::create($validated);

        // Send notification - Fixed: Check if class exists
        if (class_exists('App\Http\Controllers\NotificationController')) {
            \App\Http\Controllers\NotificationController::notifyComplaintSubmitted($complaint);
        }

        return redirect()->route('complaints.index')
            ->with('success', 'Complaint #' . $complaint->id . ' submitted successfully!');
    }

    /**
     * Show a specific complaint.
     */
    public function show($id)
    {
        try {
            $complaint = Complaint::findOrFail($id);
            return view('Component.Admin.view_complain', compact('complaint'));
        } catch (\Exception $e) {
            return redirect()->route('complaints.index')->with('error', 'Complaint not found!');
        }
    }

    /**
     * Show form to edit complaint.
     */
    public function edit($id)
    {
        try {
            $complaint = Complaint::findOrFail($id);
            return view('Component.Admin.edit_complaint', compact('complaint'));
        } catch (\Exception $e) {
            return redirect()->route('complaints.index')->with('error', 'Complaint not found!');
        }
    }

    /**
     * Update a complaint.
     */
    public function update(Request $request, $id)
    {
        try {
            $complaint = Complaint::findOrFail($id);
            $oldStatus = $complaint->status;
            
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
                $validated['resolved_by'] = Auth::id();
            }

            $complaint->update($validated);

            // Send notification for status change
            if (isset($validated['status']) && $oldStatus != $validated['status']) {
                if (class_exists('App\Http\Controllers\NotificationController')) {
                    \App\Http\Controllers\NotificationController::notifyComplaintUpdated($complaint);
                }
            }

            return redirect()->route('complaints.index')->with('success', 'Complaint updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update complaint: ' . $e->getMessage());
        }
    }

    /**
     * Delete a complaint.
     */
    public function destroy($id)
    {
        try {
            $complaint = Complaint::findOrFail($id);
            $complaint->delete();

            return redirect()->route('complaints.index')->with('success', 'Complaint deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('complaints.index')->with('error', 'Failed to delete complaint: ' . $e->getMessage());
        }
    }

    /**
     * Alternative method for complaint requests page.
     */
    public function Complain_request()
    {
        $complaints = Complaint::orderBy('created_at', 'desc')->get();
        $pendingCount = Complaint::where('status', 'pending')->count();
        $inProgressCount = Complaint::where('status', 'in_progress')->count();
        $resolvedCount = Complaint::where('status', 'resolved')->count();
        
        return view('Pages.Admin.Complain_request', compact('complaints', 'pendingCount', 'inProgressCount', 'resolvedCount'));
    }
}