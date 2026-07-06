<?php

namespace App\Http\Controllers;

use App\Models\RoomAllocation;
use App\Models\Student;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomAllocationController extends Controller
{
    /**
     * Display a listing of room allocations.
     */
    public function index(Request $request)
    {
        $query = RoomAllocation::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('student_name', 'LIKE', "%{$search}%")
                  ->orWhere('room_no', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        $roomAllocations = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // ✅ FIXED: Removed 'available_space' from statistics
        $totalRooms = RoomAllocation::count();
        $totalStudents = Student::count();

        return view('Pages.Admin.Room_allocation', compact(
            'roomAllocations', 
            'totalRooms', 
            'totalStudents'
        ));
    }

    /**
     * Show form to create new room allocation.
     */
    public function create()
    {
        // Get unallocated students
        $students = Student::whereNull('room_number')
                          ->orWhere('room_number', '')
                          ->orWhere('room_number', 'N/A')
                          ->orderBy('student_name', 'asc')
                          ->get();
        
        // Get available rooms
        $rooms = Room::where('status', 'available')
                     ->where('available_beds', '>', 0)
                     ->orderBy('room_number', 'asc')
                     ->get();
        
        return view('Component.Admin.add_room', compact('students', 'rooms'));
    }

    /**
     * Store a new room allocation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'room_id' => 'required|exists:rooms,id',
            'allocation_date' => 'nullable|date',
        ]);

        // Get student and room
        $student = Student::findOrFail($validated['student_id']);
        $room = Room::findOrFail($validated['room_id']);

        // Create allocation
        $allocation = RoomAllocation::create([
            'student_id' => $student->id,
            'student_name' => $student->student_name,
            'phone' => $student->phone_number,
            'room_id' => $room->id,
            'room_no' => $room->room_number,
            'allocation_date' => $validated['allocation_date'] ?? now(),
        ]);

        // Update student room
        $student->room_number = $room->room_number;
        $student->save();

        // Update room occupancy
        $room->occupied_beds += 1;
        $room->available_beds -= 1;
        $room->save();

        return redirect()->route('room_allocation')
                         ->with('success', 'Room allocated successfully!');
    }

    /**
     * Show form to edit room allocation.
     */
    public function edit($id)
    {
        $allocation = RoomAllocation::findOrFail($id);
        $students = Student::orderBy('student_name', 'asc')->get();
        $rooms = Room::where('status', 'available')
                     ->orderBy('room_number', 'asc')
                     ->get();
        return view('Pages.Admin.edit_room_allocation', compact('allocation', 'students', 'rooms'));
    }

    /**
     * Update a room allocation.
     */
    public function update(Request $request, $id)
    {
        $allocation = RoomAllocation::findOrFail($id);

        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'room_no' => 'required|string|max:50',
        ]);

        $allocation->update($validated);

        return redirect()->route('room_allocation')
                         ->with('success', 'Room allocation updated successfully!');
    }

    /**
     * Delete a room allocation.
     */
    public function destroy($id)
    {
        $allocation = RoomAllocation::findOrFail($id);
        
        // Update student - remove room
        $student = Student::where('student_name', $allocation->student_name)->first();
        if ($student) {
            $student->room_number = null;
            $student->save();
        }
        
        $allocation->delete();

        return redirect()->route('room_allocation')
                         ->with('success', 'Room allocation deleted successfully!');
    }

    /**
     * Deallocate a room.
     */
    public function deallocate($id)
    {
        $allocation = RoomAllocation::findOrFail($id);
        
        // Update student - remove room
        $student = Student::where('student_name', $allocation->student_name)->first();
        if ($student) {
            $student->room_number = null;
            $student->save();
        }
        
        $allocation->delete();

        return redirect()->route('room_allocation')
                         ->with('success', 'Room deallocated successfully!');
    }
}