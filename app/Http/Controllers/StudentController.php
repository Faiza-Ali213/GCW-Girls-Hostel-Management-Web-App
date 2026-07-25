<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of students.
     */
    public function index(Request $request)
    {
        $query = Student::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $query->search($request->search);
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('hostel_status', $request->status);
        }

        $students = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Get statistics
        $totalStudents = Student::count();
        $activeStudents = Student::active()->count();
        $totalRooms = Student::distinct('room_number')->count();

        return view('Pages.Admin.student_records', compact('students', 'totalStudents', 'activeStudents', 'totalRooms'));
    }

    /**
     * Show form to create new student.
     */
    public function create()
    {
        return view('Component.Admin.add_student');
    }

    /**
     * Store a new student.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'cnic_number' => 'required|string|max:20|unique:students',
            'address' => 'required|string',
            'email' => 'nullable|email|max:255|unique:students',
            'room_number' => 'nullable|string|max:50',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'hostel_status' => 'nullable|in:active,inactive,graduated,left',
            'guardian_contact' => 'nullable|string|max:20',
            'emergency_contact' => 'nullable|string|max:20',
            'admission_date' => 'nullable|date',
            'medical_conditions' => 'nullable|string',
            'remarks' => 'nullable|string',
            'profile_picture' => 'nullable|image|max:2048'
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('student_profiles', 'public');
            $validated['profile_picture'] = $path;
        }

        Student::create($validated);

        return redirect()->route('student-records')
                         ->with('success', 'Student added successfully!');
    }

    /**
     * Show a specific student.
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('Component.Admin.view_student', ['student' => $student]);
    }

    /**
     * Show form to edit student.
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('Component.Admin.edit_student', compact('student'));
    }

    /**
     * Update a student.
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'student_name' => 'sometimes|required|string|max:255',
            'father_name' => 'sometimes|required|string|max:255',
            'phone_number' => 'sometimes|required|string|max:20',
            'cnic_number' => 'sometimes|required|string|max:20|unique:students,cnic_number,' . $id,
            'address' => 'sometimes|required|string',
            'email' => 'nullable|email|max:255|unique:students,email,' . $id,
            'room_number' => 'nullable|string|max:50',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'hostel_status' => 'nullable|in:active,inactive,graduated,left',
            'guardian_contact' => 'nullable|string|max:20',
            'emergency_contact' => 'nullable|string|max:20',
            'admission_date' => 'nullable|date',
            'medical_conditions' => 'nullable|string',
            'remarks' => 'nullable|string',
            'profile_picture' => 'nullable|image|max:2048'
        ]);

        // Handle profile picture update
        if ($request->hasFile('profile_picture')) {
            // Delete old picture
            if ($student->profile_picture) {
                Storage::disk('public')->delete($student->profile_picture);
            }
            $path = $request->file('profile_picture')->store('student_profiles', 'public');
            $validated['profile_picture'] = $path;
        }

        $student->update($validated);

        return redirect()->route('student-records')
                         ->with('success', 'Student updated successfully!');
    }

    /**
     * Delete a student.
     */
    public function destroy($id)
    {
        try {
            $student = Student::findOrFail($id);
            
            // Delete profile picture if exists
            if ($student->profile_picture) {
                Storage::disk('public')->delete($student->profile_picture);
            }
            
            $student->delete();

            // Redirect with success message
            return redirect()->route('student-records')
                             ->with('success', 'Student "' . $student->student_name . '" deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->route('student-records')
                             ->with('error', 'Failed to delete student: ' . $e->getMessage());
        }
    }

    /**
     * Export students to CSV (optional).
     */
    public function export()
    {
        $students = Student::all();
        // Implement CSV export logic
        return redirect()->back()->with('success', 'Export started!');
    }

    /**
     * Get students by room number.
     */
    public function getByRoom($roomNumber)
    {
        $students = Student::byRoom($roomNumber)->get();
        return response()->json($students);
    }
}