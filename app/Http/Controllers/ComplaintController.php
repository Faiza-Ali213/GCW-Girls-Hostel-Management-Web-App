<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{
    /**
     * Display a listing of complaints (Admin Panel).
     */
    public function index(Request $request)
    {
        $query = Complaint::query();

        // Search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('student_name', 'LIKE', "%{$search}%")
                  ->orWhere('title', 'LIKE', "%{$search}%")
                  ->orWhere('complaint_by', 'LIKE', "%{$search}%")
                  ->orWhere('room_number', 'LIKE', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Filter by priority
        if ($request->has('priority') && !empty($request->priority)) {
            $query->where('priority', $request->priority);
        }

        $complaints = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistics
        $totalComplaints = Complaint::count();
        $pendingComplaints = Complaint::pending()->count();
        $inProgressComplaints = Complaint::inProgress()->count();
        $resolvedComplaints = Complaint::resolved()->count();
        $rejectedComplaints = Complaint::where('status', 'rejected')->count();

        return view('Pages.Admin.Complain_request', compact(
            'complaints',
            'totalComplaints',
            'pendingComplaints',
            'inProgressComplaints',
            'resolvedComplaints',
            'rejectedComplaints'
        ));
    }

    /**
     * Show complaint registration form.
     */
    public function create()
    {
        return view('Pages.complaint_registration');
    }

    /**
     * Store a newly created complaint.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'room_number' => 'nullable|string|max:50',
            'contact_number' => 'nullable|string|max:20',
            'complaint_by' => 'nullable|string|max:255',
            'priority' => 'nullable|in:low,medium,high',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Complaint::create([
                'student_name' => $request->student_name,
                'title' => $request->title,
                'description' => $request->description,
                'room_number' => $request->room_number,
                'contact_number' => $request->contact_number,
                'complaint_by' => $request->complaint_by ?? $request->student_name,
                'priority' => $request->priority ?? 'medium',
                'status' => 'pending',
            ]);

            return redirect()->route('complaint.registration')
                ->with('success', 'Your complaint has been submitted successfully! We will review it shortly.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to submit complaint: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified complaint.
     */
    public function show($id)
    {
        try {
            $complaint = Complaint::findOrFail($id);
            return view('Component.Admin.view_complain', compact('complaint'));
        } catch (\Exception $e) {
            return redirect()->route('complaints.index')
                ->with('error', 'Complaint not found');
        }
    }

    /**
     * Show form to update complaint status.
     */
    public function edit($id)
    {
        try {
            $complaint = Complaint::findOrFail($id);
            return view('Component.Admin.edit_complaint', compact('complaint'));
        } catch (\Exception $e) {
            return redirect()->route('complaints.index')
                ->with('error', 'Complaint not found');
        }
    }

    /**
     * Update the specified complaint.
     * Supports both AJAX and traditional form submission.
     */
    public function update(Request $request, $id)
    {
        // Log the request for debugging
        \Log::info('Complaint Update Request:', [
            'id' => $id,
            'status' => $request->status,
            'admin_remark' => $request->admin_remark,
            'all' => $request->all()
        ]);

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,in_progress,resolved,rejected',
            'admin_remark' => 'nullable|string',
            'priority' => 'nullable|in:low,medium,high',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $complaint = Complaint::findOrFail($id);
            
            $updateData = [
                'status' => $request->status,
            ];

            // Only update admin_remark if provided
            if ($request->has('admin_remark')) {
                $updateData['admin_remark'] = $request->admin_remark;
            }

            if ($request->has('priority')) {
                $updateData['priority'] = $request->priority;
            }

            if ($request->status == 'resolved') {
                $updateData['resolved_at'] = now();
            }

            $complaint->update($updateData);

            // Refresh the model to get updated data
            $complaint->refresh();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Complaint status updated successfully!',
                    'data' => $complaint
                ]);
            }

            return redirect()->route('complaints.index')
                ->with('success', 'Complaint updated successfully!');

        } catch (\Exception $e) {
            \Log::error('Complaint Update Error:', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update complaint: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()
                ->with('error', 'Failed to update complaint: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified complaint.
     */
    public function destroy($id)
    {
        try {
            $complaint = Complaint::findOrFail($id);
            $complaint->delete();

            return redirect()->route('complaints.index')
                ->with('success', 'Complaint deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->route('complaints.index')
                ->with('error', 'Failed to delete complaint: ' . $e->getMessage());
        }
    }
}