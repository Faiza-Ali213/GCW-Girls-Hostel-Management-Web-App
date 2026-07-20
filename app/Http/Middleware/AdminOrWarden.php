<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrWarden
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Get the authenticated user
        $user = Auth::user();

        // Check if user is admin or warden using the model methods
        if ($user->isAdmin() || $user->isWarden()) {
            return $next($request);
        }

        // If not admin or warden, redirect to homepage with error message
        return redirect('/')->with('error', 'You do not have permission to access the dashboard.');
    }
}