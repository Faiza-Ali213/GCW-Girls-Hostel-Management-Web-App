<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of rooms.
     */
    public function index(Request $request)
    {
        $query = Room::query();

        // Search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('room_number', 'LIKE', "%{$search}%")
                  ->orWhere('room_type', 'LIKE', "%{$search}%")
                  ->orWhere('block', 'LIKE', "%{$search}%")
                  ->orWhere('floor', 'LIKE', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Filter by block
        if ($request->has('block') && !empty($request->block)) {
            $query->where('block', $request->block);
        }

        $rooms = $query->orderBy('block')->orderBy('room_number')->paginate(10);

        // Statistics
        $totalRooms = Room::count();
        $availableRooms = Room::where('status', 'available')->count();
        $fullRooms = Room::where('status', 'full')->count();
        $maintenanceRooms = Room::where('status', 'maintenance')->count();
        $totalBeds = Room::sum('capacity');
        $occupiedBeds = Room::sum('current_occupancy');
        $availableBeds = $totalBeds - $occupiedBeds;

        return view('Pages.Admin.room_allocation', compact(
            'rooms',
            'totalRooms',
            'availableRooms',
            'fullRooms',
            'maintenanceRooms',
            'totalBeds',
            'occupiedBeds',
            'availableBeds'
        ));
    }

    /**
     * Show the form for creating a new room.
     */
    public function create()
    {
        return view('Component.Admin.add_room');
    }

    /**
     * Store a newly created room.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_number' => 'required|string|max:50|unique:rooms',
            'room_type' => 'required|string|in:double,triple,quad',
            'block' => 'required|string|max:50',
            'floor' => 'required|string|max:50',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Auto-set capacity based on room type
            $capacityMap = [
                'double' => 2,
                'triple' => 3,
                'quad' => 4,
            ];
            
            $capacity = $capacityMap[$request->room_type] ?? 2;

            $room = Room::create([
                'room_number' => $request->room_number,
                'room_type' => $request->room_type,
                'capacity' => $capacity,
                'current_occupancy' => 0,
                'block' => $request->block,
                'floor' => $request->floor,
                'status' => 'available',
                'notes' => $request->notes,
            ]);

            return redirect()->route('room-allocation.index')
                ->with('success', 'Room ' . $room->room_number . ' created successfully! (Capacity: ' . $capacity . ' beds)');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to create room: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified room.
     */
    public function show($id)
    {
        try {
            $room = Room::with('students')->findOrFail($id);
            return view('Component.Admin.view_room', compact('room'));
        } catch (\Exception $e) {
            return redirect()->route('room-allocation.index')
                ->with('error', 'Room not found');
        }
    }

    /**
     * Show the form for editing the specified room.
     */
    public function edit($id)
    {
        try {
            $room = Room::findOrFail($id);
            return view('Component.Admin.edit_room', compact('room'));
        } catch (\Exception $e) {
            return redirect()->route('room-allocation.index')
                ->with('error', 'Room not found');
        }
    }

    /**
     * Update the specified room.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'room_number' => 'required|string|max:50|unique:rooms,room_number,' . $id,
            'room_type' => 'nullable|string|max:50',
            'capacity' => 'required|integer|min:1',
            'floor' => 'nullable|string|max:50',
            'block' => 'nullable|string|max:50',
            'status' => 'nullable|in:available,full,maintenance',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $room = Room::findOrFail($id);
            
            // Check if capacity is less than current occupancy
            if ($request->capacity < $room->current_occupancy) {
                return redirect()->back()
                    ->with('error', 'Capacity cannot be less than current occupancy (' . $room->current_occupancy . ' students)')
                    ->withInput();
            }

            $room->update([
                'room_number' => $request->room_number,
                'room_type' => $request->room_type,
                'capacity' => $request->capacity,
                'floor' => $request->floor,
                'block' => $request->block,
                'status' => $request->status ?? 'available',
                'notes' => $request->notes,
            ]);

            return redirect()->route('room-allocation.index')
                ->with('success', 'Room ' . $room->room_number . ' updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update room: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified room.
     */
    public function destroy($id)
    {
        try {
            $room = Room::findOrFail($id);
            
            // Check if room has students
            if ($room->current_occupancy > 0) {
                return redirect()->route('room-allocation.index')
                    ->with('error', 'Cannot delete room with ' . $room->current_occupancy . ' students assigned. Please remove all students first.');
            }

            $roomNumber = $room->room_number;
            $room->delete();

            return redirect()->route('room-allocation.index')
                ->with('success', 'Room ' . $roomNumber . ' deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->route('room-allocation.index')
                ->with('error', 'Failed to delete room: ' . $e->getMessage());
        }
    }

    /**
     * Get room details for AJAX.
     */
    public function getRoomDetails($id)
    {
        try {
            $room = Room::with('students')->findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $room
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Room not found'
            ], 404);
        }
    }

    /**
     * Get available rooms for dropdown.
     */
    public function getAvailableRooms(Request $request)
    {
        $query = Room::available();
        
        if ($request->has('block') && !empty($request->block)) {
            $query->where('block', $request->block);
        }
        
        $rooms = $query->get();
        
        return response()->json([
            'success' => true,
            'data' => $rooms
        ]);
    }

    /**
     * Update room status (AJAX).
     */
    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:available,full,maintenance',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $room = Room::findOrFail($id);
            $room->status = $request->status;
            $room->save();

            return response()->json([
                'success' => true,
                'message' => 'Room status updated successfully!',
                'data' => $room
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status: ' . $e->getMessage()
            ], 500);
        }
    }
}