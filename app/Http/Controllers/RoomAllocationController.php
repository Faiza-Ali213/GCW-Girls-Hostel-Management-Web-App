<?php

namespace App\Http\Controllers;

use App\Models\RoomAllocation;
use App\Models\Student;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

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
        
        // Statistics
        $totalRooms = RoomAllocation::count();
        $totalStudents = Student::count();
        $totalAllocations = RoomAllocation::count();
        $availableRooms = Room::where('status', 'available')->count();

        return view('Pages.Admin.Room_allocation', compact(
            'roomAllocations', 
            'totalRooms', 
            'totalStudents',
            'totalAllocations',
            'availableRooms'
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
        
        // Get available rooms - Check if available_beds column exists
        if (Schema::hasColumn('rooms', 'available_beds')) {
            $rooms = Room::where('status', 'available')
                         ->where('available_beds', '>', 0)
                         ->orderBy('room_number', 'asc')
                         ->get();
        } else {
            // If available_beds doesn't exist, get all available rooms
            $rooms = Room::where('status', 'available')
                         ->orderBy('room_number', 'asc')
                         ->get();
        }
        
        // Get all rooms for statistics
        $allRooms = Room::all();
        $totalRoomsCount = $allRooms->count();
        $availableRoomsCount = Room::where('status', 'available')->count();
        $occupiedRoomsCount = Room::where('status', 'occupied')->count();
        
        return view('Component.Admin.add_room', compact(
            'students', 
            'rooms',
            'allRooms',
            'totalRoomsCount',
            'availableRoomsCount',
            'occupiedRoomsCount'
        ));
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

        // Check if room has available beds
        if (Schema::hasColumn('rooms', 'available_beds') && $room->available_beds <= 0) {
            return redirect()->back()
                             ->with('error', 'This room is full. Please select another room.')
                             ->withInput();
        }

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

        // Update room occupancy if columns exist
        if (Schema::hasColumn('rooms', 'occupied_beds') && Schema::hasColumn('rooms', 'available_beds')) {
            $room->occupied_beds += 1;
            $room->available_beds -= 1;
            $room->save();
        }

        return redirect()->route('room-allocation.index')
                         ->with('success', 'Room allocated successfully to ' . $student->student_name . '!');
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
        
        // Get current room details
        $currentRoom = Room::find($allocation->room_id);
        
        return view('Pages.Admin.edit_room_allocation', compact(
            'allocation', 
            'students', 
            'rooms',
            'currentRoom'
        ));
    }

    /**
     * Update a room allocation.
     */
    public function update(Request $request, $id)
    {
        $allocation = RoomAllocation::findOrFail($id);

        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'room_id' => 'required|exists:rooms,id',
            'allocation_date' => 'nullable|date',
        ]);

        // Get new student and room
        $newStudent = Student::findOrFail($validated['student_id']);
        $newRoom = Room::findOrFail($validated['room_id']);

        // Get old student and room
        $oldStudent = Student::where('student_name', $allocation->student_name)->first();
        $oldRoom = Room::find($allocation->room_id);

        // Update allocation
        $allocation->update([
            'student_id' => $newStudent->id,
            'student_name' => $newStudent->student_name,
            'phone' => $newStudent->phone_number,
            'room_id' => $newRoom->id,
            'room_no' => $newRoom->room_number,
            'allocation_date' => $validated['allocation_date'] ?? $allocation->allocation_date,
        ]);

        // Update old student - remove room
        if ($oldStudent) {
            $oldStudent->room_number = null;
            $oldStudent->save();
        }

        // Update new student - assign room
        $newStudent->room_number = $newRoom->room_number;
        $newStudent->save();

        // Update room occupancy if columns exist
        if (Schema::hasColumn('rooms', 'occupied_beds') && Schema::hasColumn('rooms', 'available_beds')) {
            // Remove from old room
            if ($oldRoom) {
                $oldRoom->occupied_beds -= 1;
                $oldRoom->available_beds += 1;
                $oldRoom->save();
            }
            
            // Add to new room
            $newRoom->occupied_beds += 1;
            $newRoom->available_beds -= 1;
            $newRoom->save();
        }

        return redirect()->route('room-allocation.index')
                         ->with('success', 'Room allocation updated successfully!');
    }

    /**
     * Delete a room allocation.
     */
    public function destroy($id)
    {
        $allocation = RoomAllocation::findOrFail($id);
        
        // Get student and room
        $student = Student::where('student_name', $allocation->student_name)->first();
        $room = Room::find($allocation->room_id);
        
        // Update student - remove room
        if ($student) {
            $student->room_number = null;
            $student->save();
        }
        
        // Update room occupancy if columns exist
        if ($room && Schema::hasColumn('rooms', 'occupied_beds') && Schema::hasColumn('rooms', 'available_beds')) {
            $room->occupied_beds -= 1;
            $room->available_beds += 1;
            $room->save();
        }
        
        $allocation->delete();

        return redirect()->route('room-allocation.index')
                         ->with('success', 'Room allocation deleted successfully!');
    }

    /**
     * Deallocate a room.
     */
    public function deallocate($id)
    {
        $allocation = RoomAllocation::findOrFail($id);
        
        // Get student and room
        $student = Student::where('student_name', $allocation->student_name)->first();
        $room = Room::find($allocation->room_id);
        
        // Update student - remove room
        if ($student) {
            $student->room_number = null;
            $student->save();
        }
        
        // Update room occupancy if columns exist
        if ($room && Schema::hasColumn('rooms', 'occupied_beds') && Schema::hasColumn('rooms', 'available_beds')) {
            $room->occupied_beds -= 1;
            $room->available_beds += 1;
            $room->save();
        }
        
        $allocation->delete();

        return redirect()->route('room-allocation.index')
                         ->with('success', 'Room deallocated successfully for ' . ($student ? $student->student_name : 'student') . '!');
    }

    /**
     * Search room allocations (AJAX).
     */
    public function search(Request $request)
    {
        $search = $request->get('search');
        
        $allocations = RoomAllocation::where('student_name', 'LIKE', "%{$search}%")
                                     ->orWhere('room_no', 'LIKE', "%{$search}%")
                                     ->orWhere('phone', 'LIKE', "%{$search}%")
                                     ->limit(10)
                                     ->get();
        
        return response()->json($allocations);
    }

    /**
     * Get available students (AJAX).
     */
    public function getAvailableStudents()
    {
        $students = Student::whereNull('room_number')
                          ->orWhere('room_number', '')
                          ->orWhere('room_number', 'N/A')
                          ->orderBy('student_name', 'asc')
                          ->get(['id', 'student_name', 'phone_number']);
        
        return response()->json($students);
    }

    /**
     * Get room data (AJAX).
     */
    public function getRoomData()
    {
        $totalRooms = Room::count();
        $availableRooms = Room::where('status', 'available')->count();
        $occupiedRooms = Room::where('status', 'occupied')->count();
        
        return response()->json([
            'total' => $totalRooms,
            'available' => $availableRooms,
            'occupied' => $occupiedRooms
        ]);
    }

    /**
     * Show room allocation details.
     */
    public function show($id)
    {
        $allocation = RoomAllocation::with(['student', 'room'])->findOrFail($id);
        
        return view('Pages.Admin.show_room_allocation', compact('allocation'));
    }
}