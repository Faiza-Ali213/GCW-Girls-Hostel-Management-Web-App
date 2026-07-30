<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        $query = Visitor::with('student');

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('student', function($q) use ($search) {
                $q->where('student_name', 'LIKE', "%{$search}%")
                  ->orWhere('room_number', 'LIKE', "%{$search}%");
            });
        }

        $visitors = $query->orderBy('created_at', 'desc')->paginate(10);

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

    public function create()
    {
        $students = Student::orderBy('student_name')->get(['id', 'student_name', 'father_name', 'room_number', 'phone_number', 'cnic_number']);
        return view('Component.Admin.add_visitors', compact('students'));
    }

    public function store(Request $request)
    {
        // Handle Add Visitor action
        if ($request->action == 'add') {
            // Get current visitors
            $visitors = $request->visitors ?? [];
            $visitorCount = count($visitors) + 1;
            
            // Add empty visitor data
            $visitors[] = [
                'visitor_name' => '',
                'relationship' => '',
                'cnic_number' => '',
                'phone_number' => ''
            ];
            
            return redirect()->back()
                ->withInput([
                    'visitors' => $visitors,
                    'visitor_count' => $visitorCount,
                    'student_id' => $request->student_id,
                    'remarks' => $request->remarks
                ]);
        }
        
        // Handle Remove Visitor action
        if (strpos($request->action, 'remove_') !== false) {
            $removeIndex = str_replace('remove_', '', $request->action);
            $visitors = $request->visitors ?? [];
            
            if (isset($visitors[$removeIndex])) {
                unset($visitors[$removeIndex]);
                $visitors = array_values($visitors); // Reindex
            }
            
            $visitorCount = count($visitors);
            
            return redirect()->back()
                ->withInput([
                    'visitors' => $visitors,
                    'visitor_count' => $visitorCount,
                    'student_id' => $request->student_id,
                    'remarks' => $request->remarks
                ]);
        }
        
        // Handle Save action
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

            $visitor = Visitor::create([
                'student_id' => $student->id,
                'student_name' => $student->student_name,
                'student_room' => $student->room_number,
                'number_of_visitors' => $numberOfVisitors,
                'visitor_details_json' => json_encode($visitorsData),
                'check_in_time' => now(),
                'check_in_by' => auth()->user()->name ?? 'System',
                'remarks' => $request->remarks,
            ]);

            return redirect()->route('visitors_records')
                ->with('success', $numberOfVisitors . ' visitor(s) added for ' . $student->student_name);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to add visitor: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        try {
            $visitor = Visitor::with('student')->findOrFail($id);
            $visitorDetails = json_decode($visitor->visitor_details_json, true) ?? [];
            return view('Component.Admin.view_visitor', compact('visitor', 'visitorDetails'));
        } catch (\Exception $e) {
            return redirect()->route('visitors_records')
                ->with('error', 'Visitor not found');
        }
    }

    public function destroy($id)
    {
        try {
            $visitor = Visitor::findOrFail($id);
            $visitor->delete();

            return redirect()->route('visitors_records')
                ->with('success', 'Visitor record deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->route('visitors_records')
                ->with('error', 'Failed to delete visitor: ' . $e->getMessage());
        }
    }
}