<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $query->search($request->search);
        }

        // Filter by role
        if ($request->has('role') && !empty($request->role)) {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Get statistics
        $totalUsers = User::count();
        $activeUsers = User::active()->count();
        $inactiveUsers = User::inactive()->count();
        $adminUsers = User::admins()->count();
        $wardenUsers = User::wardens()->count();
        $regularUsers = User::regularUsers()->count();

        return view('Pages.Admin.user-management', compact(
            'users', 
            'totalUsers', 
            'activeUsers', 
            'inactiveUsers',
            'adminUsers',
            'wardenUsers',
            'regularUsers'
        ));
    }

    /**
     * Show form to create new user.
     */
    public function create()
    {
        return view('Component.Admin.add-user-modal');
    }

    /**
     * Store a new user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,warden,user',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')
                         ->with('success', 'User created successfully!');
    }

    /**
     * Show a specific user.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('Component.Admin.view-user-modal', compact('user'));
    }

    /**
     * Show form to edit user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Component.Admin.edit-user-modal', compact('user'));
    }

    /**
     * Update a user.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'role' => 'required|in:admin,warden,user',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle password update only if provided
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()->route('users.index')
                         ->with('success', 'User updated successfully!');
    }

    /**
     * Delete a user.
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            
            // Prevent deleting self
            if ($user->id === auth()->id()) {
                return redirect()->route('users.index')
                                 ->with('error', 'You cannot delete your own account!');
            }

            $user->delete();

            return redirect()->route('users.index')
                             ->with('success', 'User "' . $user->name . '" deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->route('users.index')
                             ->with('error', 'Failed to delete user: ' . $e->getMessage());
        }
    }

    /**
     * Update user status.
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            
            $request->validate([
                'status' => 'required|in:active,inactive'
            ]);

            $user->update(['status' => $request->status]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'User status updated successfully!',
                    'status' => $user->status
                ]);
            }

            return redirect()->route('users.index')
                             ->with('success', 'User status updated successfully!');

        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update status: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->route('users.index')
                             ->with('error', 'Failed to update status: ' . $e->getMessage());
        }
    }

    /**
     * Export users to CSV (optional).
     */
    public function export()
    {
        $users = User::all();
        // Implement CSV export logic
        return redirect()->back()->with('success', 'Export started!');
    }
}