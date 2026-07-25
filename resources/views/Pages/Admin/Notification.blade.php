@extends('Layout.admin')

@section('page_title', 'Notifications')
@section('page_subtitle', 'View and manage all notifications')

@section('content')
<div class="container-fluid px-4 py-3">
    <!-- Header -->
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-0 fw-bold" style="color: #0b1a33;">
                <i class="bi bi-bell-fill me-2" style="color: #4f46e5;"></i>Notifications
            </h4>
            <p class="text-muted mt-1" style="font-size: 0.9rem;">View and manage all system notifications</p>
        </div>
        <div class="d-flex gap-2">
            @if($unreadCount > 0)
                <form action="{{ route('notifications.mark-all-as-read') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-check2-all me-1"></i> Mark All as Read
                    </button>
                </form>
            @endif
            <form action="{{ route('notifications.clear-all') }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Clear all read notifications?')">
                    <i class="bi bi-trash me-1"></i> Clear Read
                </button>
            </form>
        </div>
    </div>

    <!-- Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('notifications.index') }}" class="btn btn-sm {{ !request('status') && !request('type') ? 'btn-primary' : 'btn-outline-secondary' }}">
                    All
                </a>
                <a href="{{ route('notifications.index', ['status' => 'unread']) }}" class="btn btn-sm {{ request('status') == 'unread' ? 'btn-primary' : 'btn-outline-secondary' }}">
                    <i class="bi bi-circle-fill me-1" style="color: #4f46e5; font-size: 10px;"></i> Unread
                </a>
                <a href="{{ route('notifications.index', ['status' => 'read']) }}" class="btn btn-sm {{ request('status') == 'read' ? 'btn-primary' : 'btn-outline-secondary' }}">
                    <i class="bi bi-check-circle-fill me-1"></i> Read
                </a>
                <div class="vr"></div>
                <a href="{{ route('notifications.index', ['type' => 'info']) }}" class="btn btn-sm {{ request('type') == 'info' ? 'btn-primary' : 'btn-outline-secondary' }}">
                    <i class="bi bi-info-circle me-1"></i> Info
                </a>
                <a href="{{ route('notifications.index', ['type' => 'success']) }}" class="btn btn-sm {{ request('type') == 'success' ? 'btn-primary' : 'btn-outline-secondary' }}">
                    <i class="bi bi-check-circle me-1"></i> Success
                </a>
                <a href="{{ route('notifications.index', ['type' => 'warning']) }}" class="btn btn-sm {{ request('type') == 'warning' ? 'btn-primary' : 'btn-outline-secondary' }}">
                    <i class="bi bi-exclamation-triangle me-1"></i> Warning
                </a>
                <a href="{{ route('notifications.index', ['type' => 'error']) }}" class="btn btn-sm {{ request('type') == 'error' ? 'btn-primary' : 'btn-outline-secondary' }}">
                    <i class="bi bi-x-circle me-1"></i> Error
                </a>
            </div>
        </div>
    </div>

    <!-- Notifications List -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    @if($notifications->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($notifications as $notification)
                                <div class="list-group-item p-3 {{ !$notification->is_read ? 'bg-light' : '' }}">
                                    <div class="d-flex align-items-start gap-3">
                                        <!-- Icon -->
                                        <div class="flex-shrink-0">
                                            <div class="rounded-circle p-2 d-flex align-items-center justify-content-center" 
                                                 style="width: 44px; height: 44px; 
                                                        background: {{ $notification->type == 'success' ? '#ECFDF5' : ($notification->type == 'warning' ? '#FFFBEB' : ($notification->type == 'error' ? '#FEF2F2' : '#EEF2FF')) }};">
                                                <i class="{{ $notification->icon ?? ($notification->type == 'success' ? 'bi-check-circle' : ($notification->type == 'warning' ? 'bi-exclamation-triangle' : ($notification->type == 'error' ? 'bi-x-circle' : 'bi-info-circle'))) }}"
                                                   style="font-size: 20px; color: {{ $notification->type == 'success' ? '#10B981' : ($notification->type == 'warning' ? '#F59E0B' : ($notification->type == 'error' ? '#EF4444' : '#4F46E5')) }};"></i>
                                            </div>
                                        </div>
                                        
                                        <!-- Content -->
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <h6 class="mb-0 fw-semibold {{ !$notification->is_read ? 'text-dark' : 'text-secondary' }}">
                                                    {{ $notification->title }}
                                                </h6>
                                                @if(!$notification->is_read)
                                                    <span class="badge bg-primary">New</span>
                                                @endif
                                                <span class="badge bg-light text-muted small">
                                                    {{ ucfirst($notification->type) }}
                                                </span>
                                            </div>
                                            <p class="mb-1 text-secondary" style="font-size: 0.95rem;">
                                                {{ $notification->message }}
                                            </p>
                                            <div class="d-flex flex-wrap align-items-center gap-3 mt-2">
                                                <span class="text-muted" style="font-size: 0.8rem;">
                                                    <i class="bi bi-clock me-1"></i> {{ $notification->created_at->diffForHumans() }}
                                                </span>
                                                @if($notification->link)
                                                    <a href="{{ $notification->link }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye me-1"></i> View Details
                                                    </a>
                                                @endif
                                                <div class="ms-auto">
                                                    @if(!$notification->is_read)
                                                        <form action="{{ route('notifications.mark-as-read', $notification) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-success">
                                                                <i class="bi bi-check2 me-1"></i> Mark as Read
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <form action="{{ route('notifications.destroy', $notification) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this notification?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-bell-slash" style="font-size: 48px; color: #d1d5db;"></i>
                            <h5 class="mt-3 text-muted">No notifications found</h5>
                            <p class="text-muted">All notifications will appear here</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="row mt-4">
        <div class="col-12">
            {{ $notifications->withQueryString()->links() }}
        </div>
    </div>
</div>

<style>
    .list-group-item {
        border-left: none !important;
        border-right: none !important;
    }
    .list-group-item:first-child {
        border-top: none !important;
    }
    .list-group-item:last-child {
        border-bottom: none !important;
    }
    .list-group-item:hover {
        background-color: #f8fafc !important;
    }
    .btn-outline-primary:hover {
        background-color: #4f46e5 !important;
        color: white !important;
    }
    .badge {
        font-weight: 500;
    }
</style>
@endsection