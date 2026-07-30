@extends('Layout.admin')

@section('content')
<style>
    /* ===== PAGE CONTAINER ===== */
    .complaint-details-container {
        padding: 1.5rem 0;
    }

    /* ===== BREADCRUMB ===== */
    .breadcrumb-custom {
        background: transparent;
        padding: 0 0 1.5rem 0;
        margin: 0;
        font-size: 0.9rem;
    }
    .breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before {
        content: "›";
        color: #94a3b8;
        font-size: 1.2rem;
    }
    .breadcrumb-custom .breadcrumb-item a {
        color: #1a2a4a;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
    }
    .breadcrumb-custom .breadcrumb-item a:hover {
        color: #0f1a2e;
    }
    .breadcrumb-custom .breadcrumb-item.active {
        color: #64748b;
        font-weight: 500;
    }

    /* ===== TOP ACTION BAR ===== */
    .top-action-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .btn-back-top {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.6rem 1.8rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        background: #1a2a4a;
        color: #ffffff;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(26, 42, 74, 0.2);
    }
    .btn-back-top:hover {
        background: #0f1a2e;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(26, 42, 74, 0.3);
        text-decoration: none;
    }
    .btn-back-top i {
        font-size: 0.95rem;
    }

    /* ===== MAIN CARD ===== */
    .detail-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06), 0 2px 10px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(226, 232, 240, 0.6);
        overflow: hidden;
        transition: transform 0.2s ease, box-shadow 0.3s ease;
    }
    .detail-card:hover {
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
    }

    /* ===== HEADER ===== */
    .detail-header {
        background: linear-gradient(135deg, #1a2a4a 0%, #0f1a2e 100%);
        padding: 2rem 2.5rem;
        position: relative;
        overflow: hidden;
    }
    .detail-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 50%;
        pointer-events: none;
    }
    .detail-header::after {
        content: '';
        position: absolute;
        bottom: -40%;
        left: -5%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.02);
        border-radius: 50%;
        pointer-events: none;
    }
    .detail-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        z-index: 1;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .detail-header-left {
        display: flex;
        align-items: center;
        gap: 1.2rem;
    }
    .detail-id-badge {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        font-weight: 700;
        color: #ffffff;
        border: 2px solid rgba(255, 255, 255, 0.15);
        flex-shrink: 0;
    }
    .detail-title h2 {
        color: #ffffff;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
        letter-spacing: -0.3px;
    }
    .detail-title .sub-info {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.85rem;
        margin-top: 4px;
    }
    .detail-title .sub-info i {
        margin-right: 6px;
    }
    .detail-header-right {
        display: flex;
        gap: 0.8rem;
        align-items: center;
        flex-wrap: wrap;
    }

    /* Status & Priority Badges in Header */
    .badge-header {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 0.5rem 1.2rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        color: #ffffff;
    }
    .badge-header i {
        font-size: 0.7rem;
    }
    .badge-header.priority-high {
        background: rgba(239, 68, 68, 0.2);
        border-color: rgba(239, 68, 68, 0.2);
        color: #fca5a5;
    }
    .badge-header.priority-medium {
        background: rgba(251, 191, 36, 0.15);
        border-color: rgba(251, 191, 36, 0.15);
        color: #fcd34d;
    }
    .badge-header.priority-low {
        background: rgba(34, 197, 94, 0.15);
        border-color: rgba(34, 197, 94, 0.15);
        color: #86efac;
    }
    .badge-header.status-pending {
        background: rgba(251, 191, 36, 0.15);
        border-color: rgba(251, 191, 36, 0.15);
        color: #fcd34d;
    }
    .badge-header.status-in_progress {
        background: rgba(96, 165, 250, 0.15);
        border-color: rgba(96, 165, 250, 0.15);
        color: #93c5fd;
    }
    .badge-header.status-resolved {
        background: rgba(34, 197, 94, 0.15);
        border-color: rgba(34, 197, 94, 0.15);
        color: #86efac;
    }
    .badge-header.status-rejected {
        background: rgba(239, 68, 68, 0.15);
        border-color: rgba(239, 68, 68, 0.15);
        color: #fca5a5;
    }
    .badge-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        animation: pulse-dot 2s infinite;
    }
    .badge-dot.active {
        background: #22c55e;
    }
    .badge-dot.pending {
        background: #fbbf24;
    }
    .badge-dot.in-progress {
        background: #60a5fa;
    }
    @keyframes pulse-dot {
        0% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.6; transform: scale(0.9); }
        100% { opacity: 1; transform: scale(1); }
    }

    /* ===== BODY ===== */
    .detail-body {
        padding: 2rem 2.5rem 2.5rem;
    }

    /* ===== INFO GRID ===== */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.2rem 2rem;
        margin-bottom: 2rem;
    }
    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        .detail-header-content {
            flex-direction: column;
            text-align: center;
        }
        .detail-header-left {
            flex-direction: column;
            text-align: center;
        }
        .detail-header-right {
            justify-content: center;
        }
        .detail-body {
            padding: 1.5rem;
        }
        .detail-header {
            padding: 1.5rem;
        }
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
        padding: 0.75rem 1rem;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #f1f5f9;
        transition: all 0.2s ease;
    }
    .info-item:hover {
        background: #f1f5f9;
        border-color: #e2e8f0;
    }
    .info-item .label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .info-item .label i {
        font-size: 0.8rem;
        color: #1a2a4a;
        width: 16px;
    }
    .info-item .value {
        font-size: 1rem;
        font-weight: 500;
        color: #0f172a;
        padding-left: 1.8rem;
        word-wrap: break-word;
    }
    .info-item .value .text-muted {
        color: #94a3b8;
        font-weight: 400;
    }

    /* Full width items */
    .info-item.full-width {
        grid-column: 1 / -1;
    }

    /* Description special styling */
    .info-item.description {
        background: #f8fafc;
        border-color: #e2e8f0;
    }
    .info-item.description .value {
        line-height: 1.6;
        font-weight: 400;
        color: #334155;
    }

    /* Admin remark highlight */
    .info-item.remark {
        background: #f0fdf4;
        border-color: #bbf7d0;
    }
    .info-item.remark .label i {
        color: #22c55e;
    }
    .info-item.remark .value {
        color: #15803d;
        font-style: italic;
    }

    /* Complaint By badge in info grid */
    .complaint-by-badge-detail {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 3px 14px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        background: #eef2ff;
        color: #4f46e5;
    }
    .complaint-by-badge-detail.student {
        background: #ecfdf5;
        color: #059669;
    }
    .complaint-by-badge-detail.user {
        background: #eff6ff;
        color: #2563eb;
    }

    /* ===== FOOTER INFO ===== */
    .detail-footer {
        margin-top: 1.5rem;
        padding: 1rem 2.5rem;
        border-top: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    .detail-footer .meta-info {
        color: #94a3b8;
        font-size: 0.8rem;
    }
    .detail-footer .meta-info i {
        margin-right: 4px;
    }
    .detail-footer .meta-info strong {
        color: #0f172a;
        font-weight: 600;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 576px) {
        .detail-id-badge {
            width: 50px;
            height: 50px;
            font-size: 1rem;
        }
        .detail-title h2 {
            font-size: 1.2rem;
        }
        .badge-header {
            font-size: 0.65rem;
            padding: 0.3rem 0.8rem;
        }
        .detail-footer {
            flex-direction: column;
            text-align: center;
            padding: 1rem 1.5rem;
        }
        .top-action-bar {
            flex-direction: column;
            align-items: stretch;
        }
        .btn-back-top {
            justify-content: center;
        }
    }
</style>

<div class="complaint-details-container">
    <div class="container-fluid px-0">
        <!-- Top Action Bar -->
        <div class="top-action-bar">
            <a href="{{ route('complaints.index') }}" class="btn-back-top">
                <i class="fas fa-arrow-left"></i> Back to Complaints
            </a>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="breadcrumb-custom">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('complaints.index') }}">
                        <i class="fas fa-clipboard-list"></i> Complaints
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    #{{ $complaint->id }} - {{ $complaint->title }}
                </li>
            </ol>
        </nav>

        <!-- Detail Card -->
        <div class="detail-card">
            <!-- Header -->
            <div class="detail-header">
                <div class="detail-header-content">
                    <div class="detail-header-left">
                        <div class="detail-id-badge">
                            #{{ $complaint->id }}
                        </div>
                        <div class="detail-title">
                            <h2>{{ $complaint->title }}</h2>
                            <div class="sub-info">
                                <i class="fas fa-user"></i> {{ $complaint->student_name }}
                                @if($complaint->room_number)
                                    <span class="mx-2">|</span>
                                    <i class="fas fa-door-open"></i> Room {{ $complaint->room_number }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="detail-header-right">
                        <span class="badge-header priority-{{ $complaint->priority }}">
                            <i class="fas fa-flag"></i> {{ ucfirst($complaint->priority) }}
                        </span>
                        <span class="badge-header status-{{ $complaint->status }}">
                            <span class="badge-dot {{ $complaint->status }}"></span>
                            {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="detail-body">
                <!-- Info Grid -->
                <div class="info-grid">
                    <!-- Full width: Description -->
                    <div class="info-item description full-width">
                        <span class="label">
                            <i class="fas fa-align-left"></i> Description
                        </span>
                        <span class="value">{{ $complaint->description }}</span>
                    </div>

                    <!-- Student Name -->
                    <div class="info-item">
                        <span class="label">
                            <i class="fas fa-user-circle"></i> Student Name
                        </span>
                        <span class="value">{{ $complaint->student_name }}</span>
                    </div>

                    <!-- Room Number -->
                    <div class="info-item">
                        <span class="label">
                            <i class="fas fa-door-open"></i> Room Number
                        </span>
                        <span class="value">{{ $complaint->room_number ?? '<span class="text-muted">Not provided</span>' }}</span>
                    </div>

                    <!-- Contact Number -->
                    <div class="info-item">
                        <span class="label">
                            <i class="fas fa-phone"></i> Contact Number
                        </span>
                        <span class="value">{{ $complaint->contact_number ?? '<span class="text-muted">Not provided</span>' }}</span>
                    </div>

                    <!-- Complaint By -->
                    <div class="info-item">
                        <span class="label">
                            <i class="fas fa-user-tag"></i> Complaint By
                        </span>
                        <span class="value">
                            @if($complaint->complaint_by)
                                <span class="complaint-by-badge-detail {{ strtolower($complaint->complaint_by) }}">
                                    <i class="fas fa-user-{{ strtolower($complaint->complaint_by) == 'student' ? 'graduate' : 'circle' }}"></i>
                                    {{ ucfirst($complaint->complaint_by) }}
                                </span>
                            @else
                                <span class="text-muted">Not specified</span>
                            @endif
                        </span>
                    </div>

                    <!-- Submitted Date -->
                    <div class="info-item">
                        <span class="label">
                            <i class="fas fa-calendar-alt"></i> Submitted Date
                        </span>
                        <span class="value">{{ $complaint->created_at->format('d-m-Y h:i A') }}</span>
                    </div>

                    <!-- Resolved Date (if resolved) -->
                    @if($complaint->resolved_at)
                    <div class="info-item">
                        <span class="label">
                            <i class="fas fa-check-circle" style="color:#22c55e;"></i> Resolved Date
                        </span>
                        <span class="value">{{ $complaint->resolved_at->format('d-m-Y h:i A') }}</span>
                    </div>
                    @endif

                    <!-- Admin Remark (full width) -->
                    <div class="info-item remark full-width">
                        <span class="label">
                            <i class="fas fa-comment"></i> Admin Remark
                        </span>
                        <span class="value">{{ $complaint->admin_remark ?? 'No remarks yet' }}</span>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="detail-footer">
                <div class="meta-info">
                    <i class="fas fa-info-circle"></i> 
                    Created: <strong>{{ $complaint->created_at->diffForHumans() }}</strong>
                </div>
                <div class="meta-info">
                    <i class="fas fa-clock"></i> 
                    Last updated: <strong>{{ $complaint->updated_at->format('d-m-Y h:i A') }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        console.log('✅ Complaint details page loaded successfully');
    });
</script>
@endpush