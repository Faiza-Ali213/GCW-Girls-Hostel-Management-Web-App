<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('Pages.Auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Get the authenticated user
            $user = Auth::user();
            
            // Check if user is admin or warden
            if ($user->isAdmin() || $user->isWarden()) {
                // Redirect to dashboard for admin/warden
                return redirect()->intended('/dashboard');
            }
            
            // Redirect to homepage for regular users
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Show signup form
    public function showSignupForm()
    {
        return view('Pages.Auth.signup');
    }

    // Handle signup
    public function signup(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the user with default role 'user'
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role for new users
            'status' => 'active', // Default status
        ]);

        // Log the user in automatically
        Auth::login($user);

        // Redirect to homepage with success message
        return redirect('/')->with('success', 'Account created successfully! Welcome to GCW Hostel.');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}