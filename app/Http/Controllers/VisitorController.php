<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\Student;
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

        // Search
        if ($request->has('search') && !empty($request->search)) {
            $query->search($request->search);
        }

        // Filter by date
        if ($request->has('date') && !empty($request->date)) {
            $query->whereDate('created_at', $request->date);
        }

        $visitors = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistics
        $totalVisitors = Visitor::count();
        $todayVisitors = Visitor::whereDate('created_at', today())->count();
        $totalVisitorsCount = Visitor::sum('number_of_visitors');

        return view('Pages.Admin.vistors_records', compact(
            'visitors',
            'totalVisitors',
            'todayVisitors',
            'totalVisitorsCount'
        ));
    }

    /**
     * Show form to create new visitor with students list.
     */
    public function create(Request $request)
    {
        $students = Student::orderBy('student_name')->get(['id', 'student_name', 'father_name', 'room_number', 'phone_number', 'cnic_number']);
        
        // Check if we need to add more visitors
        if ($request->has('add_more')) {
            $visitorCount = old('visitor_count', 1) + 1;
            return redirect()->back()->withInput(['visitor_count' => $visitorCount]);
        }
        
        // Check if we need to remove a visitor
        if ($request->has('remove_visitor')) {
            $removeIndex = $request->remove_visitor;
            $visitors = old('visitors', []);
            if (isset($visitors[$removeIndex])) {
                unset($visitors[$removeIndex]);
                $visitors = array_values($visitors);
            }
            $visitorCount = count($visitors);
            return redirect()->back()->withInput(['visitors' => $visitors, 'visitor_count' => $visitorCount]);
        }
        
        return view('Component.Admin.add_visitors', compact('students'));
    }

    /**
     * Store a newly created visitor.
     */
    public function store(Request $request)
    {
        // Check if this is an "Add More" request
        if ($request->has('add_more')) {
            return redirect()->back()->withInput();
        }
        
        // Check if this is a "Remove" request
        if ($request->has('remove_visitor')) {
            return redirect()->back()->withInput();
        }

        // Log incoming data for debugging
        \Log::info('Visitor Store Request:', $request->all());

        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'visitors' => 'required|array|min:1',
            'visitors.*.visitor_name' => 'required|string|max:255',
            'visitors.*.relationship' => 'required|string|max:50',
            'visitors.*.cnic_number' => 'nullable|string|max:20',
            'visitors.*.phone_number' => 'nullable|string|max:20',
            'remarks' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            \Log::error('Validation failed:', $validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $visitorsData = $request->visitors;
            $numberOfVisitors = count($visitorsData);
            
            $student = Student::find($request->student_id);
            
            if (!$student) {
                return redirect()->back()
                    ->with('error', 'Student not found.')
                    ->withInput();
            }

            // Create visitor record with JSON data
            $visitor = Visitor::create([
                'student_name' => $student->student_name,
                'student_phone' => $student->phone_number,
                'student_room' => $student->room_number,
                'student_cnic' => $student->cnic_number,
                'number_of_visitors' => $numberOfVisitors,
                'visitor_details_json' => json_encode($visitorsData), // Store all visitors as JSON
                'check_in_time' => now(),
                'check_in_by' => auth()->user()->name ?? 'System',
                'remarks' => $request->remarks,
                'purpose_of_visit' => $request->purpose_of_visit ?? null,
            ]);

            \Log::info('Visitor saved successfully:', ['id' => $visitor->id]);

            return redirect()->route('visitors_records')
                ->with('success', $numberOfVisitors . ' visitor(s) checked in successfully for ' . $student->student_name);

        } catch (\Exception $e) {
            \Log::error('Error storing visitor:', ['error' => $e->getMessage()]);
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
            $visitorDetails = json_decode($visitor->visitor_details_json, true) ?? [];
            return view('Component.Admin.view_visitor', compact('visitor', 'visitorDetails'));
        } catch (\Exception $e) {
            return redirect()->route('visitors_records')
                ->with('error', 'Visitor not found');
        }
    }

    /**
     * Show the form for editing the specified visitor.
     */
    public function edit($id)
    {
        try {
            $visitor = Visitor::findOrFail($id);
            $visitorDetails = json_decode($visitor->visitor_details_json, true) ?? [];
            return view('Component.Admin.edit_visitor', compact('visitor', 'visitorDetails'));
        } catch (\Exception $e) {
            return redirect()->route('visitors_records')
                ->with('error', 'Visitor not found');
        }
    }

    /**
     * Update the specified visitor.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'student_name' => 'required|string|max:255',
            'student_phone' => 'nullable|string|max:20',
            'student_room' => 'nullable|string|max:50',
            'student_cnic' => 'nullable|string|max:20',
            'number_of_visitors' => 'required|integer|min:1',
            'purpose_of_visit' => 'nullable|string',
            'relationship_with_student' => 'nullable|string',
            'remarks' => 'nullable|string',
            'id_proof_type' => 'nullable|string|max:50',
            'id_proof_number' => 'nullable|string|max:50',
            'visitor_details.*.visitor_name' => 'required|string|max:255',
            'visitor_details.*.relationship' => 'required|string|max:50',
            'visitor_details.*.cnic_number' => 'nullable|string|max:20',
            'visitor_details.*.phone_number' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $visitor = Visitor::findOrFail($id);
            
            // Update main visitor record
            $visitor->update([
                'student_name' => $request->student_name,
                'student_phone' => $request->student_phone,
                'student_room' => $request->student_room,
                'student_cnic' => $request->student_cnic,
                'number_of_visitors' => $request->number_of_visitors,
                'purpose_of_visit' => $request->purpose_of_visit,
                'relationship_with_student' => $request->relationship_with_student,
                'remarks' => $request->remarks,
                'id_proof_type' => $request->id_proof_type,
                'id_proof_number' => $request->id_proof_number,
            ]);

            // Update visitor details JSON
            if ($request->has('visitor_details')) {
                $visitor->update([
                    'visitor_details_json' => json_encode($request->visitor_details)
                ]);
            }

            return redirect()->route('visitors_records')
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
            $visitorDetails = json_decode($visitor->visitor_details_json, true) ?? [];
            $visitorName = $visitorDetails[0]['visitor_name'] ?? 'Unknown';
            $visitor->delete();

            return redirect()->route('visitors_records')
                ->with('success', 'Visitor record deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->route('visitors_records')
                ->with('error', 'Failed to delete visitor: ' . $e->getMessage());
        }
    }

    /**
     * Get visitor statistics (AJAX).
     */
    public function getStats()
    {
        $stats = [
            'total' => Visitor::count(),
            'today' => Visitor::whereDate('created_at', today())->count(),
            'total_visitors' => Visitor::sum('number_of_visitors'),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }
}