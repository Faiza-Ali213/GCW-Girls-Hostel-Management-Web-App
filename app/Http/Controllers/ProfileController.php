<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Complaint;
use App\Models\Student;

class ProfileController extends Controller
{
    // Show profile page
    public function show()
    {
        $user = Auth::user();
        
        // Get user's complaints - Multiple ways to match
        $complaints = Complaint::where(function($query) use ($user) {
            // Match by student_name (user's name)
            $query->where('student_name', $user->name)
                  // Match by complaint_by (user's name)
                  ->orWhere('complaint_by', $user->name)
                  // Match by student_email (user's email)
                  ->orWhere('student_email', $user->email);
        })
        ->orderBy('created_at', 'desc')
        ->get();
        
        // Also try to find complaints by student name in students table
        $student = Student::where('email', $user->email)->first();
        if ($student) {
            $studentComplaints = Complaint::where('student_name', $student->student_name)
                                          ->orderBy('created_at', 'desc')
                                          ->get();
            // Merge with existing complaints
            $complaints = $complaints->merge($studentComplaints)->unique('id');
        }
        
        // Get statistics for profile
        $data = [
            'totalStudents' => \App\Models\Student::count() ?? 0,
            'totalRooms' => \App\Models\Room::count() ?? 0,
            'totalStaff' => \App\Models\Staff::count() ?? 0,
            'complaints' => $complaints,
        ];
        
        return view('Pages.profile', $data);
    }

    // Show edit profile page
    public function edit()
    {
        return view('Pages.profile-edit');
    }

    // Update profile
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('profile')
            ->with('success', 'Profile updated successfully!');
    }

    // Update password
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('profile')
            ->with('success', 'Password updated successfully!');
    }

    // Upload profile photo
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Delete old photo if exists
        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        // Store new photo
        $path = $request->file('profile_photo')->store('profile_photos', 'public');

        $user->update([
            'profile_photo' => $path,
        ]);

        return redirect()->route('profile')
            ->with('success', 'Profile photo updated successfully!');
    }
}