<?php
// app/Http/Controllers/VisitorController.php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisitorController extends Controller
{
    /**
     * Display a listing of visitors.
     */
    public function index(Request $request)
    {
        $query = Visitor::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('visitor_name', 'LIKE', "%{$search}%")
                  ->orWhere('phone_number', 'LIKE', "%{$search}%")
                  ->orWhere('student_name', 'LIKE', "%{$search}%")
                  ->orWhere('purpose_of_visit', 'LIKE', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $visitors = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Statistics
        $totalVisitors = Visitor::count();
        $totalActive = Visitor::where('status', 'active')->count();
        $totalCheckedOut = Visitor::where('status', 'checked_out')->count();
        $todayVisitors = Visitor::whereDate('created_at', today())->count();

        return view('Pages.Admin.vistors_records', compact(
            'visitors',
            'totalVisitors',
            'totalActive',
            'totalCheckedOut',
            'todayVisitors'
        ));
    }

    /**
     * Show the form for creating a new visitor.
     */
    public function create()
    {
        return view('Component.Admin.add_visitors');
    }

    /**
     * Store a newly created visitor.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'visitor_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'id_card_number' => 'nullable|string|max:50',
            'purpose_of_visit' => 'required|string|max:255',
            'room_no' => 'nullable|string|max:50',
            'student_name' => 'nullable|string|max:255',
            'student_room' => 'nullable|string|max:50',
            'check_in_time' => 'nullable|date',
            'remarks' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $visitor = Visitor::create([
                'visitor_name' => $request->visitor_name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'id_card_number' => $request->id_card_number,
                'purpose_of_visit' => $request->purpose_of_visit,
                'room_no' => $request->room_no,
                'student_name' => $request->student_name,
                'student_room' => $request->student_room,
                'check_in_time' => $request->check_in_time ?? now(),
                'status' => 'active',
                'remarks' => $request->remarks,
            ]);

            return redirect()->route('vistors_records')
                ->with('success', 'Visitor checked in successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to add visitor: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified visitor.
     */
    public function show($id)
    {
        try {
            $visitor = Visitor::findOrFail($id);
            return view('Component.Admin.view_visitors', compact('visitor'));
        } catch (\Exception $e) {
            return redirect()->route('vistors_records')
                ->with('error', 'Visitor record not found');
        }
    }

    /**
     * Show the form for editing the specified visitor.
     */
    public function edit($id)
    {
        try {
            $visitor = Visitor::findOrFail($id);
            return view('Component.Admin.edit_visitors', compact('visitor'));
        } catch (\Exception $e) {
            return redirect()->route('vistors_records')
                ->with('error', 'Visitor record not found');
        }
    }

    /**
     * Update the specified visitor.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'visitor_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'id_card_number' => 'nullable|string|max:50',
            'purpose_of_visit' => 'required|string|max:255',
            'room_no' => 'nullable|string|max:50',
            'student_name' => 'nullable|string|max:255',
            'student_room' => 'nullable|string|max:50',
            'status' => 'required|in:active,checked_out',
            'remarks' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $visitor = Visitor::findOrFail($id);
            
            $updateData = [
                'visitor_name' => $request->visitor_name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'id_card_number' => $request->id_card_number,
                'purpose_of_visit' => $request->purpose_of_visit,
                'room_no' => $request->room_no,
                'student_name' => $request->student_name,
                'student_room' => $request->student_room,
                'status' => $request->status,
                'remarks' => $request->remarks,
            ];

            // If status is checked_out and checkout time is not set
            if ($request->status == 'checked_out' && $visitor->check_out_time == null) {
                $updateData['check_out_time'] = now();
            }

            $visitor->update($updateData);

            return redirect()->route('vistors_records')
                ->with('success', 'Visitor record updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update visitor: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified visitor.
     */
    public function destroy($id)
    {
        try {
            $visitor = Visitor::findOrFail($id);
            $visitor->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Visitor record deleted successfully!'
                ]);
            }

            return redirect()->route('vistors_records')
                ->with('success', 'Visitor record deleted successfully!');

        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete visitor: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('vistors_records')
                ->with('error', 'Failed to delete visitor: ' . $e->getMessage());
        }
    }

    /**
     * Check-in a visitor.
     */
    public function checkIn(Request $request, $id)
    {
        try {
            $visitor = Visitor::findOrFail($id);
            
            if ($visitor->status == 'active') {
                return response()->json([
                    'success' => false,
                    'message' => 'Visitor is already checked in'
                ], 400);
            }

            $visitor->update([
                'status' => 'active',
                'check_in_time' => now(),
                'check_out_time' => null
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Visitor checked in successfully!',
                'data' => $visitor
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to checkin visitor: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Checkout a visitor.
     */
    public function checkOut($id)
    {
        try {
            $visitor = Visitor::findOrFail($id);
            
            if ($visitor->status == 'checked_out') {
                return response()->json([
                    'success' => false,
                    'message' => 'Visitor already checked out'
                ], 400);
            }

            $visitor->update([
                'status' => 'checked_out',
                'check_out_time' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Visitor checked out successfully!',
                'data' => $visitor
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to checkout visitor: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search visitors.
     */
    public function search(Request $request)
    {
        $query = Visitor::query();

        if ($request->has('q') && !empty($request->q)) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('visitor_name', 'LIKE', "%{$search}%")
                  ->orWhere('phone_number', 'LIKE', "%{$search}%")
                  ->orWhere('student_name', 'LIKE', "%{$search}%")
                  ->orWhere('purpose_of_visit', 'LIKE', "%{$search}%");
            });
        }

        $visitors = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $visitors
        ]);
    }

    /**
     * Export visitors.
     */
    public function export()
    {
        // You can implement Excel export here
        return redirect()->route('vistors_records')
            ->with('info', 'Export functionality coming soon!');
    }
}