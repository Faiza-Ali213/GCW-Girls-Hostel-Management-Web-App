<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::orderBy('id', 'desc')->get();
        return view('staff.index', compact('staff'));
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'phone' => 'required',
            'duty_shift' => 'required',
        ]);

        Staff::create($request->all());
        return redirect()->route('staff.index')->with('success', 'Staff added!');
    }

    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'phone' => 'required',
            'duty_shift' => 'required',
        ]);

        $staff = Staff::findOrFail($id);
        $staff->update($request->all());
        return redirect()->route('staff.index')->with('success', 'Staff updated!');
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Staff deleted!');
    }
}