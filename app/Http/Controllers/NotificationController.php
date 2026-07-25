<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use App\Models\Visitor;
use App\Models\Complaint;
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

        // Get total count before pagination
        $totalCount = $query->count();
        
        $notifications = $query->latest()->paginate(15);
        
        // Count unread for badge
        $unreadCount = Notification::unread()
            ->forUser(Auth::id())
            ->active()
            ->count();

        return view('Pages.Admin.Notification', compact('notifications', 'unreadCount', 'totalCount'));
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

    // ============================================
    // USER NOTIFICATIONS
    // ============================================

    /**
     * Create notification for new user registration
     */
    public static function notifyUserCreated(User $user)
    {
        $roleLabels = [
            'admin' => 'Administrator',
            'warden' => 'Warden',
            'user' => 'User'
        ];
        $roleLabel = $roleLabels[$user->role] ?? ucfirst($user->role);
        
        Notification::create([
            'title' => 'New User Registered',
            'message' => "A new user '{$user->name}' has been registered as '{$roleLabel}'",
            'type' => 'success',
            'icon' => 'bi-person-plus',
            'link' => route('users.show', $user->id),
            'is_global' => true,
            'expires_at' => now()->addDays(7),
        ]);
    }

    /**
     * Create notification for user status change
     */
    public static function notifyUserStatusChanged(User $user)
    {
        $statusLabel = ucfirst($user->status);
        
        Notification::create([
            'title' => 'User Status Updated',
            'message' => "User '{$user->name}' status has been changed to '{$statusLabel}'",
            'type' => $user->status == 'active' ? 'success' : 'warning',
            'icon' => $user->status == 'active' ? 'bi-person-check' : 'bi-person-x',
            'link' => route('users.show', $user->id),
            'is_global' => true,
            'expires_at' => now()->addDays(7),
        ]);
    }

    /**
     * Create notification for user role change
     */
    public static function notifyUserRoleChanged(User $user)
    {
        $roleLabels = [
            'admin' => 'Administrator',
            'warden' => 'Warden',
            'user' => 'User'
        ];
        $roleLabel = $roleLabels[$user->role] ?? ucfirst($user->role);
        
        Notification::create([
            'title' => 'User Role Updated',
            'message' => "User '{$user->name}' role has been changed to '{$roleLabel}'",
            'type' => 'info',
            'icon' => 'bi-person-badge',
            'link' => route('users.show', $user->id),
            'is_global' => true,
            'expires_at' => now()->addDays(7),
        ]);
    }

    // ============================================
    // VISITOR NOTIFICATIONS
    // ============================================

    /**
     * Create notification for new visitor
     */
    public static function notifyVisitorAdded(Visitor $visitor)
    {
        $message = "New visitor '{$visitor->visitor_name}' has checked in";
        
        if ($visitor->student_name) {
            $message .= " to meet '{$visitor->student_name}'";
        }
        
        if ($visitor->purpose_of_visit) {
            $message .= " (Purpose: {$visitor->purpose_of_visit})";
        }

        Notification::create([
            'title' => 'New Visitor Arrived',
            'message' => $message,
            'type' => 'info',
            'icon' => 'bi-person-check',
            'link' => route('visitor.show', $visitor->id),
            'is_global' => true,
            'expires_at' => now()->addDays(3),
        ]);
    }

    /**
     * Create notification for visitor checkout
     */
    public static function notifyVisitorCheckedOut(Visitor $visitor)
    {
        $duration = 'N/A';
        if ($visitor->check_in_time && $visitor->check_out_time) {
            $duration = $visitor->check_in_time->diffForHumans($visitor->check_out_time);
        } elseif ($visitor->check_in_time) {
            $duration = $visitor->check_in_time->diffForHumans(now());
        }
        
        Notification::create([
            'title' => 'Visitor Checked Out',
            'message' => "Visitor '{$visitor->visitor_name}' has checked out. Duration: {$duration}",
            'type' => 'info',
            'icon' => 'bi-person-check',
            'link' => route('visitor.show', $visitor->id),
            'is_global' => true,
            'expires_at' => now()->addDays(3),
        ]);
    }

    // ============================================
    // COMPLAINT NOTIFICATIONS
    // ============================================

    /**
     * Create notification for new complaint
     */
    public static function notifyComplaintSubmitted(Complaint $complaint)
    {
        $studentName = $complaint->student ? $complaint->student->name : $complaint->student_name;
        $priorityLabels = [
            'low' => 'Low',
            'medium' => 'Medium',
            'high' => 'High'
        ];
        $priorityLabel = $priorityLabels[$complaint->priority] ?? ucfirst($complaint->priority);
        
        Notification::create([
            'title' => 'New Complaint Submitted',
            'message' => "Complaint #{$complaint->id} submitted by '{$studentName}' with {$priorityLabel} priority",
            'type' => $complaint->priority == 'high' ? 'warning' : 'info',
            'icon' => $complaint->priority == 'high' ? 'bi-exclamation-triangle' : 'bi-file-earmark-text',
            'link' => route('complaints.show', $complaint->id),
            'is_global' => true,
            'expires_at' => now()->addDays(7),
        ]);
    }

    /**
     * Create notification for complaint status update
     */
    public static function notifyComplaintUpdated(Complaint $complaint)
    {
        $statusLabels = [
            'pending' => 'Pending Review',
            'processing' => 'In Progress',
            'resolved' => 'Resolved',
            'rejected' => 'Rejected'
        ];
        
        $statusLabel = $statusLabels[$complaint->status] ?? ucfirst($complaint->status);
        $studentName = $complaint->student ? $complaint->student->name : $complaint->student_name;
        
        $type = 'info';
        $icon = 'bi-arrow-repeat';
        
        if ($complaint->status == 'resolved') {
            $type = 'success';
            $icon = 'bi-check-circle';
        } elseif ($complaint->status == 'rejected') {
            $type = 'error';
            $icon = 'bi-x-circle';
        }
        
        Notification::create([
            'title' => 'Complaint Status Updated',
            'message' => "Complaint #{$complaint->id} from '{$studentName}' is now '{$statusLabel}'",
            'type' => $type,
            'icon' => $icon,
            'link' => route('complaints.show', $complaint->id),
            'is_global' => true,
            'expires_at' => now()->addDays(7),
        ]);
    }

    // ============================================
    // GENERIC NOTIFICATION HELPER
    // ============================================

    /**
     * Create a custom notification
     */
    public static function createNotification($title, $message, $type = 'info', $icon = null, $link = null, $userId = null, $expiresAt = null)
    {
        return Notification::create([
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'icon' => $icon,
            'link' => $link,
            'user_id' => $userId,
            'is_global' => is_null($userId),
            'expires_at' => $expiresAt ?? now()->addDays(7),
        ]);
    }
}