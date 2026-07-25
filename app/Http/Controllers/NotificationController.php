<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Display all notifications
    public function index(Request $request)
    {
        $query = Notification::query()
            ->when(!$request->show_all, function($q) {
                return $q->where(function($sub) {
                    $sub->where('is_global', true)
                        ->orWhere('user_id', Auth::id());
                });
            })
            ->active();

        // Filter by status
        if ($request->status == 'unread') {
            $query->unread();
        } elseif ($request->status == 'read') {
            $query->read();
        }

        // Filter by type
        if ($request->type && in_array($request->type, ['info', 'success', 'warning', 'error'])) {
            $query->where('type', $request->type);
        }

        $notifications = $query->latest()->paginate(15);
        
        // Count unread for badge
        $unreadCount = Notification::unread()
            ->forUser(Auth::id())
            ->active()
            ->count();

        return view('Pages.Admin.Notification', compact('notifications', 'unreadCount'));
    }

    // Show create form
    public function create()
    {
        return view('notifications.create');
    }

    // Store new notification
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:info,success,warning,error',
            'icon' => 'nullable|string|max:100',
            'link' => 'nullable|url|max:255',
            'user_id' => 'nullable|exists:users,id',
            'is_global' => 'boolean',
            'expires_at' => 'nullable|date|after:now',
        ]);

        $validated['is_global'] = $request->has('is_global') && !$request->user_id;
        $validated['user_id'] = $request->is_global ? null : $request->user_id;

        Notification::create($validated);

        return redirect()->route('notifications.index')
            ->with('success', 'Notification created successfully!');
    }

    // Show single notification
    public function show(Notification $notification)
    {
        // Mark as read when viewed
        if (!$notification->is_read) {
            $notification->markAsRead();
        }

        return view('notifications.show', compact('notification'));
    }

    // Show edit form
    public function edit(Notification $notification)
    {
        return view('notifications.edit', compact('notification'));
    }

    // Update notification
    public function update(Request $request, Notification $notification)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:info,success,warning,error',
            'icon' => 'nullable|string|max:100',
            'link' => 'nullable|url|max:255',
            'user_id' => 'nullable|exists:users,id',
            'is_global' => 'boolean',
            'expires_at' => 'nullable|date|after:now',
        ]);

        $validated['is_global'] = $request->has('is_global') && !$request->user_id;
        $validated['user_id'] = $request->is_global ? null : $request->user_id;

        $notification->update($validated);

        return redirect()->route('notifications.index')
            ->with('success', 'Notification updated successfully!');
    }

    // Delete notification
    public function destroy(Notification $notification)
    {
        $notification->delete();

        return redirect()->route('notifications.index')
            ->with('success', 'Notification deleted successfully!');
    }

    // Mark notification as read (AJAX)
    public function markAsRead(Request $request, Notification $notification)
    {
        $notification->markAsRead();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Notification marked as read!');
    }

    // Mark notification as unread (AJAX)
    public function markAsUnread(Request $request, Notification $notification)
    {
        $notification->markAsUnread();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Notification marked as unread!');
    }

    // Mark all as read
    public function markAllAsRead(Request $request)
    {
        Notification::forUser(Auth::id())
            ->unread()
            ->active()
            ->update([
                'is_read' => true,
                'read_at' => now()
            ]);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'All notifications marked as read!');
    }

    // Clear all read notifications
    public function clearAll(Request $request)
    {
        Notification::forUser(Auth::id())
            ->read()
            ->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'All read notifications cleared!');
    }

    // Get unread notifications count (AJAX)
    public function getUnreadCount(Request $request)
    {
        if (Auth::check()) {
            $count = Notification::unread()
                ->forUser(Auth::id())
                ->active()
                ->count();

            return response()->json(['count' => $count]);
        }

        return response()->json(['count' => 0]);
    }

    // Get latest notifications for AJAX
    public function getLatest(Request $request)
    {
        $limit = $request->limit ?? 5;
        
        $notifications = Notification::forUser(Auth::id())
            ->active()
            ->latest()
            ->limit($limit)
            ->get();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => Notification::unread()
                ->forUser(Auth::id())
                ->active()
                ->count()
        ]);
    }
}