<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Student;
use App\Models\RoomAllocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoomAllocationController extends Controller
{
    /**
     * Display a listing of room allocations
     */
    public function index(Request $request)
    {
        $query = RoomAllocation::with(['student', 'room'])
            ->where('status', 'active');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('student', function ($q2) use ($search) {
                    $q2->where('name', 'LIKE', "%{$search}%")
                       ->orWhere('phone', 'LIKE', "%{$search}%");
                })->orWhereHas('room', function ($q2) use ($search) {
                    $q2->where('room_number', 'LIKE', "%{$search}%");
                });
            });
        }

        $allocations = $query->orderBy('created_at', 'desc')->paginate(15);
        $rooms = Room::orderBy('room_number')->get();
        $students = Student::unallocated()->orderBy('name')->get();

        return view('Room_allocation', compact('allocations', 'rooms', 'students'));
    }

    /**
     * Get room data for dashboard
     */
    public function getRoomData()
    {
        $rooms = Room::withCount(['allocations as active_allocations' => function ($query) {
            $query->where('status', 'active');
        }])->get();

        $stats = [
            'total_rooms' => $rooms->count(),
            'total_beds' => $rooms->sum('total_beds'),
            'occupied_beds' => $rooms->sum('occupied_beds'),
            'available_beds' => $rooms->sum('total_beds') - $rooms->sum('occupied_beds'),
            'full_rooms' => $rooms->where('status', 'full')->count(),
            'available_rooms' => $rooms->where('status', 'available')->count(),
        ];

        return response()->json([
            'rooms' => $rooms,
            'stats' => $stats
        ]);
    }

    /**
     * Store a newly created allocation
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'room_id' => 'required|exists:rooms,id',
            'allocation_date' => 'required|date',
            'remarks' => 'nullable|string|max:500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $room = Room::findOrFail($request->room_id);
            
            // Check if room has available beds
            if (!$room->hasAvailableBeds()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Room is full. No beds available.'
                ], 422);
            }

            // Check if student is already allocated
            if (Student::find($request->student_id)->hasActiveAllocation()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student already has an active room allocation.'
                ], 422);
            }

            // Create allocation
            $allocation = RoomAllocation::create([
                'student_id' => $request->student_id,
                'room_id' => $request->room_id,
                'allocation_date' => $request->allocation_date,
                'remarks' => $request->remarks,
                'status' => 'active'
            ]);

            // Update room occupied beds
            $room->increment('occupied_beds');
            $room->updateStatus();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Room allocated successfully!',
                'allocation' => $allocation->load(['student', 'room'])
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to allocate room: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Deallocate a student from room
     */
    public function deallocate($id)
    {
        try {
            DB::beginTransaction();

            $allocation = RoomAllocation::with('room')->findOrFail($id);
            
            if (!$allocation->isActive()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Room already deallocated.'
                ], 422);
            }

            $allocation->deallocate();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Room deallocated successfully!',
                'allocation' => $allocation->fresh(['student', 'room'])
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to deallocate room: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified allocation
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'room_id' => 'required|exists:rooms,id',
            'remarks' => 'nullable|string|max:500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $allocation = RoomAllocation::with(['student', 'room'])->findOrFail($id);
            
            // If changing room
            if ($allocation->room_id != $request->room_id) {
                // Remove from old room
                $oldRoom = $allocation->room;
                $oldRoom->decrement('occupied_beds');
                $oldRoom->updateStatus();

                // Add to new room
                $newRoom = Room::findOrFail($request->room_id);
                if (!$newRoom->hasAvailableBeds()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'New room is full.'
                    ], 422);
                }

                $allocation->room_id = $request->room_id;
                $newRoom->increment('occupied_beds');
                $newRoom->updateStatus();
            }

            $allocation->remarks = $request->remarks;
            $allocation->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Allocation updated successfully!',
                'allocation' => $allocation->fresh(['student', 'room'])
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update allocation: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified allocation
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $allocation = RoomAllocation::with('room')->findOrFail($id);
            
            // If active, decrement bed count
            if ($allocation->isActive()) {
                $room = $allocation->room;
                $room->decrement('occupied_beds');
                $room->updateStatus();
            }

            $allocation->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Allocation deleted successfully!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete allocation: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search allocations
     */
    public function search(Request $request)
    {
        $search = $request->search;
        
        $allocations = RoomAllocation::with(['student', 'room'])
            ->where('status', 'active')
            ->where(function ($query) use ($search) {
                $query->whereHas('student', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('phone', 'LIKE', "%{$search}%");
                })->orWhereHas('room', function ($q) use ($search) {
                    $q->where('room_number', 'LIKE', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()->json($allocations);
    }

    /**
     * Get available students for allocation
     */
    public function getAvailableStudents()
    {
        $students = Student::unallocated()
            ->select('id', 'name', 'phone', 'email')
            ->orderBy('name')
            ->get();

        return response()->json($students);
    }

    /**
     * Get room details with allocation info
     */
    public function getRoomDetails($id)
    {
        $room = Room::with(['activeAllocations.student'])->findOrFail($id);
        
        return response()->json([
            'room' => $room,
            'allocated_students' => $room->activeAllocations->map(function ($allocation) {
                return [
                    'student_id' => $allocation->student_id,
                    'student_name' => $allocation->student->name,
                    'allocation_date' => $allocation->allocation_date,
                ];
            }),
            'available_beds' => $room->available_beds
        ]);
    }

    /**
     * Bulk deallocate students
     */
    public function bulkDeallocate(Request $request)
    {
        $request->validate([
            'allocation_ids' => 'required|array',
            'allocation_ids.*' => 'exists:room_allocations,id'
        ]);

        try {
            DB::beginTransaction();

            $allocations = RoomAllocation::whereIn('id', $request->allocation_ids)
                ->where('status', 'active')
                ->get();

            foreach ($allocations as $allocation) {
                $allocation->deallocate();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Successfully deallocated ' . $allocations->count() . ' students.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to deallocate students: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get allocation statistics
     */
    public function getStats()
    {
        $stats = [
            'total_allocations' => RoomAllocation::count(),
            'active_allocations' => RoomAllocation::active()->count(),
            'deallocated' => RoomAllocation::deallocated()->count(),
            'total_students' => Student::count(),
            'allocated_students' => Student::allocated()->count(),
            'unallocated_students' => Student::unallocated()->count(),
            'total_rooms' => Room::count(),
            'full_rooms' => Room::full()->count(),
            'available_rooms' => Room::available()->count(),
        ];

        return response()->json($stats);
    }
}