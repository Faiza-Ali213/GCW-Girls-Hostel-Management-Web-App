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
        
        // Get user's complaints - Fresh data
        $complaints = Complaint::where(function($query) use ($user) {
            $query->where('student_name', $user->name)
                  ->orWhere('complaint_by', $user->name)
                  ->orWhere('student_email', $user->email);
        })
        ->orderBy('created_at', 'desc')
        ->get();
        
        // Also find by student table
        $student = Student::where('email', $user->email)->first();
        if ($student) {
            $studentComplaints = Complaint::where('student_name', $student->student_name)
                                          ->orderBy('created_at', 'desc')
                                          ->get();
            $complaints = $complaints->merge($studentComplaints)->unique('id');
        }
        
        // Sort by created_at
        $complaints = $complaints->sortByDesc('created_at');
        
        // Debug log
        \Log::info('Profile Complaints Data:', [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'complaint_count' => $complaints->count(),
            'complaints' => $complaints->map(function($c) {
                return [
                    'id' => $c->id,
                    'title' => $c->title,
                    'status' => $c->status,
                    'status_label' => $c->status_label,
                ];
            })
        ]);
        
        $data = [
            'totalStudents' => \App\Models\Student::count() ?? 0,
            'totalRooms' => \App\Models\Room::count() ?? 0,
            'totalStaff' => \App\Models\Staff::count() ?? 0,
            'complaints' => $complaints,
        ];
        
        return view('Pages.profile', $data);
    }

    public function edit()
    {
        return view('Pages.profile-edit');
    }

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

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('profile')
            ->with('success', 'Password updated successfully!');
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $path = $request->file('profile_photo')->store('profile_photos', 'public');

        $user->update([
            'profile_photo' => $path,
        ]);

        return redirect()->route('profile')
            ->with('success', 'Profile photo updated successfully!');
    }
}