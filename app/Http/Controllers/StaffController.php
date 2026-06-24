<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    /**
     * Display a listing of the staff.
     */
    public function index()
    {
        $staff = Staff::orderBy('id', 'desc')->paginate(10);
        return view('staff_records', compact('staff'));
    }

    /**
     * Show the form for creating a new staff.
     */
    public function create()
    {
        return view('Component.Admin.add_staff');
    }

    /**
     * Store a newly created staff in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'duty_shift' => 'required|string',
            'email' => 'nullable|email|unique:staff,email',
            'joining_date' => 'nullable|date',
            'salary' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive'
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $staff = Staff::create($request->all());
        
        if ($request->ajax()) {
            return response()->json(['success' => true, 'staff' => $staff]);
        }
        
        return redirect()->route('staff.index')->with('success', 'Staff added successfully!');
    }

    /**
     * Display the specified staff.
     */
    public function show($id)
    {
        $staff = Staff::findOrFail($id);
        return view('staff_show', compact('staff'));
    }

    /**
     * Show the form for editing the specified staff.
     */
    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        return view('staff_edit', compact('staff'));
    }

    /**
     * Update the specified staff in storage.
     */
    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'duty_shift' => 'required|string',
            'email' => 'nullable|email|unique:staff,email,' . $id,
            'joining_date' => 'nullable|date',
            'salary' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive'
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $staff->update($request->all());
        
        if ($request->ajax()) {
            return response()->json(['success' => true, 'staff' => $staff]);
        }
        
        return redirect()->route('staff.index')->with('success', 'Staff updated successfully!');
    }

    /**
     * Remove the specified staff from storage.
     */
    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();
        
        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Staff deleted successfully!']);
        }
        
        return redirect()->route('staff.index')->with('success', 'Staff deleted successfully!');
    }

    /**
     * Search staff members.
     */
    public function search(Request $request)
    {
        $search = $request->get('search');
        
        $staff = Staff::where('name', 'like', "%{$search}%")
            ->orWhere('role', 'like', "%{$search}%")
            ->orWhere('phone_number', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orderBy('id', 'desc')
            ->paginate(10);
        
        if ($request->ajax()) {
            return response()->json($staff);
        }
        
        return view('staff_records', compact('staff'));
    }
}