@extends('Layout.admin')

@section('page_title', 'Notifications')
@section('page_subtitle', 'View and manage all system notifications')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header with Stats -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div>
                    <h4 class="mb-1 fw-bold" style="color: #0b1a33; letter-spacing: -0.02em;">
                        <i class="bi bi-bell-fill me-2" style="color: #4f46e5;"></i>Notifications
                    </h4>
                    <p class="text-muted mb-0" style="font-size: 0.9rem;">View and manage all system notifications</p>
                </div>
                <div class="d-flex gap-2 mt-2 mt-sm-0">
                    @if($unreadCount > 0)
                        <form action="{{ route('notifications.mark-all-as-read') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm px-3">
                                <i class="bi bi-check2-all me-1"></i> Mark All Read
                            </button>
                        </form>
                    @endif
                    <form action="{{ route('notifications.clear-all') }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-secondary btn-sm px-3" onclick="return confirm('Clear all read notifications?')">
                            <i class="bi bi-trash3 me-1"></i> Clear Read
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-primary-soft">
                    <i class="bi bi-inbox"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">{{ $totalCount ?? $notifications->count() }}</span>
                    <span class="stat-label">Total</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-warning-soft">
                    <i class="bi bi-envelope"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">{{ $unreadCount }}</span>
                    <span class="stat-label">Unread</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-success-soft">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">{{ ($totalCount ?? $notifications->count()) - $unreadCount }}</span>
                    <span class="stat-label">Read</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-info-soft">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">{{ $notifications->where('created_at', '>=', now()->subDay())->count() }}</span>
                    <span class="stat-label">Today</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters - Only All, Read, Unread -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="filter-wrapper">
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <span class="filter-label"><i class="bi bi-funnel me-1"></i> Filter:</span>
                    <a href="{{ route('notifications.index') }}" class="filter-btn {{ !request('status') ? 'active' : '' }}">
                        All
                    </a>
                    <a href="{{ route('notifications.index', ['status' => 'unread']) }}" class="filter-btn {{ request('status') == 'unread' ? 'active' : '' }}">
                        <span class="dot unread"></span> Unread
                    </a>
                    <a href="{{ route('notifications.index', ['status' => 'read']) }}" class="filter-btn {{ request('status') == 'read' ? 'active' : '' }}">
                        <i class="bi bi-check-circle"></i> Read
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications Timeline -->
    <div class="row">
        <div class="col-12">
            <div class="notification-timeline">
                @if($notifications->count() > 0)
                    @foreach($notifications as $notification)
                        <div class="timeline-item {{ !$notification->is_read ? 'unread' : '' }}">
                            <div class="timeline-badge {{ $notification->type }}">
                                <i class="{{ $notification->icon ?? ($notification->type == 'success' ? 'bi-check-circle' : ($notification->type == 'warning' ? 'bi-exclamation-triangle' : ($notification->type == 'error' ? 'bi-x-circle' : 'bi-info-circle'))) }}"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-header">
                                    <div class="d-flex flex-wrap align-items-center gap-2">
                                        <h6 class="timeline-title {{ !$notification->is_read ? 'fw-bold' : '' }}">
                                            {{ $notification->title }}
                                        </h6>
                                        @if(!$notification->is_read)
                                            <span class="badge-new">New</span>
                                        @endif
                                        <span class="badge-type {{ $notification->type }}">
                                            {{ ucfirst($notification->type) }}
                                        </span>
                                    </div>
                                    <span class="timeline-time">
                                        <i class="bi bi-clock me-1"></i> {{ $notification->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <p class="timeline-message">{{ $notification->message }}</p>
                                <div class="timeline-actions-wrapper">
                                    <div class="timeline-actions">
                                        @if($notification->link)
                                            <a href="{{ $notification->link }}" class="btn-action view">
                                                <i class="bi bi-eye me-1"></i> View Details
                                            </a>
                                        @endif
                                        @if(!$notification->is_read)
                                            <form action="{{ route('notifications.mark-as-read', $notification) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn-action mark-read">
                                                    <i class="bi bi-check2 me-1"></i> Mark as Read
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('notifications.destroy', $notification) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action delete" onclick="return confirm('Delete this notification?')">
                                                <i class="bi bi-trash3 me-1"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="bi bi-bell-slash"></i>
                        </div>
                        <h5>No notifications found</h5>
                        <p>All notifications will appear here</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if(method_exists($notifications, 'links'))
        <div class="row mt-4">
            <div class="col-12">
                <div class="pagination-wrapper">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    /* ===== STAT CARDS ===== */
    .stat-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
        transition: all 0.25s ease;
        border: 1px solid #f0f2f5;
        height: 100%;
    }
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }
    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }
    .stat-icon.bg-primary-soft { background: #EEF2FF; color: #4F46E5; }
    .stat-icon.bg-warning-soft { background: #FFFBEB; color: #F59E0B; }
    .stat-icon.bg-success-soft { background: #ECFDF5; color: #10B981; }
    .stat-icon.bg-info-soft { background: #E0F2FE; color: #0EA5E9; }
    .stat-content {
        display: flex;
        flex-direction: column;
    }
    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0b1a33;
        line-height: 1.2;
    }
    .stat-label {
        font-size: 0.75rem;
        color: #94a3b8;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    /* ===== FILTERS ===== */
    .filter-wrapper {
        background: #ffffff;
        border-radius: 14px;
        padding: 0.75rem 1.25rem;
        border: 1px solid #f0f2f5;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }
    .filter-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: #64748b;
        margin-right: 0.5rem;
    }
    .filter-btn {
        padding: 0.35rem 1rem;
        border-radius: 30px;
        font-size: 0.8rem;
        font-weight: 500;
        color: #64748b;
        text-decoration: none;
        transition: all 0.2s ease;
        background: transparent;
        border: 1px solid transparent;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .filter-btn:hover {
        color: #4F46E5;
        background: #F8FAFF;
        text-decoration: none;
    }
    .filter-btn.active {
        color: #ffffff;
        background: #4F46E5;
        border-color: #4F46E5;
        box-shadow: 0 2px 8px rgba(79, 70, 229, 0.25);
    }
    .filter-btn .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }
    .filter-btn .dot.unread {
        background: #4F46E5;
    }

    /* ===== TIMELINE ===== */
    .notification-timeline {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid #f0f2f5;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        overflow: hidden;
    }
    .timeline-item {
        display: flex;
        gap: 1.25rem;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f1f4f9;
        transition: background 0.2s ease;
        position: relative;
    }
    .timeline-item:last-child {
        border-bottom: none;
    }
    .timeline-item:hover {
        background: #fafbff;
    }
    .timeline-item.unread {
        background: #f8faff;
        border-left: 3px solid #4F46E5;
    }
    .timeline-item.unread:hover {
        background: #f0f4ff;
    }

    .timeline-badge {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
        margin-top: 2px;
    }
    .timeline-badge.info { background: #EEF2FF; color: #4F46E5; }
    .timeline-badge.success { background: #ECFDF5; color: #10B981; }
    .timeline-badge.warning { background: #FFFBEB; color: #F59E0B; }
    .timeline-badge.error { background: #FEF2F2; color: #EF4444; }

    .timeline-content {
        flex: 1;
        min-width: 0;
    }
    .timeline-header {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 0.5rem;
        margin-bottom: 0.35rem;
    }
    .timeline-title {
        font-size: 0.95rem;
        color: #0b1a33;
        margin: 0;
        font-weight: 500;
    }
    .timeline-item.unread .timeline-title {
        font-weight: 600;
    }
    .badge-new {
        background: linear-gradient(135deg, #4F46E5, #7C3AED);
        color: #ffffff;
        font-size: 0.6rem;
        font-weight: 600;
        padding: 0.2rem 0.6rem;
        border-radius: 30px;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    .badge-type {
        font-size: 0.6rem;
        font-weight: 600;
        padding: 0.2rem 0.6rem;
        border-radius: 30px;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    .badge-type.info { background: #EEF2FF; color: #4F46E5; }
    .badge-type.success { background: #ECFDF5; color: #10B981; }
    .badge-type.warning { background: #FFFBEB; color: #F59E0B; }
    .badge-type.error { background: #FEF2F2; color: #EF4444; }

    .timeline-time {
        font-size: 0.75rem;
        color: #94a3b8;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .timeline-message {
        font-size: 0.9rem;
        color: #475569;
        margin: 0.25rem 0 0.75rem;
        line-height: 1.5;
    }

    /* ===== TIMELINE ACTIONS - RIGHT ALIGNED ===== */
    .timeline-actions-wrapper {
        display: flex;
        justify-content: flex-end;
        width: 100%;
    }
    .timeline-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 0.5rem;
        justify-content: flex-end;
    }
    .btn-action {
        padding: 0.25rem 0.75rem;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 500;
        border: 1px solid transparent;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: transparent;
        cursor: pointer;
    }
    .btn-action.view {
        color: #4F46E5;
        border-color: #E0E7FF;
        background: #F8FAFF;
    }
    .btn-action.view:hover {
        background: #4F46E5;
        color: #ffffff;
        border-color: #4F46E5;
    }
    .btn-action.mark-read {
        color: #10B981;
        border-color: #D1FAE5;
        background: #F0FDF4;
    }
    .btn-action.mark-read:hover {
        background: #10B981;
        color: #ffffff;
        border-color: #10B981;
    }
    .btn-action.delete {
        color: #EF4444;
        border-color: #FEE2E2;
        background: #FEF2F2;
        padding: 0.25rem 0.6rem;
    }
    .btn-action.delete:hover {
        background: #EF4444;
        color: #ffffff;
        border-color: #EF4444;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }
    .empty-icon {
        font-size: 3.5rem;
        color: #d1d5db;
        margin-bottom: 1rem;
    }
    .empty-state h5 {
        color: #0b1a33;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    .empty-state p {
        color: #94a3b8;
        margin: 0;
    }

    /* ===== PAGINATION ===== */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 1rem;
    }
    .pagination-wrapper .pagination {
        margin: 0;
    }
    .pagination-wrapper .page-link {
        border: none;
        color: #64748b;
        font-weight: 500;
        padding: 0.5rem 0.9rem;
        border-radius: 8px;
        margin: 0 2px;
        transition: all 0.2s ease;
    }
    .pagination-wrapper .page-link:hover {
        background: #EEF2FF;
        color: #4F46E5;
    }
    .pagination-wrapper .page-item.active .page-link {
        background: #4F46E5;
        color: #ffffff;
        border-radius: 8px;
    }
    .pagination-wrapper .page-item.disabled .page-link {
        color: #cbd5e1;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .stat-card {
            padding: 0.75rem 1rem;
        }
        .stat-number {
            font-size: 1.25rem;
        }
        .timeline-item {
            padding: 1rem 1.25rem;
            flex-direction: column;
            gap: 0.75rem;
        }
        .timeline-badge {
            width: 36px;
            height: 36px;
            font-size: 0.9rem;
        }
        .timeline-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .timeline-time {
            white-space: normal;
        }
        .filter-wrapper {
            padding: 0.5rem 0.75rem;
        }
        .filter-btn {
            padding: 0.25rem 0.6rem;
            font-size: 0.7rem;
        }
        .filter-label {
            font-size: 0.7rem;
        }
        .timeline-actions-wrapper {
            justify-content: flex-start;
        }
        .timeline-actions {
            justify-content: flex-start;
        }
    }
    @media (max-width: 576px) {
        .stat-card {
            flex-direction: column;
            text-align: center;
            padding: 0.75rem;
        }
        .stat-number {
            font-size: 1.1rem;
        }
        .stat-label {
            font-size: 0.65rem;
        }
        .timeline-actions {
            flex-wrap: wrap;
        }
        .btn-action {
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
        }
    }
</style>
@endsection