@extends('Layout.admin')

@section('content')
<style>
    /* ============================================ */
    /* COMPLAINT MANAGEMENT - BLUE THEME */
    /* ============================================ */
    
    /* Statistics Cards */
    .stat-card {
        background: white;
        border-radius: 14px;
        padding: 22px 24px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        border-top: 4px solid;
        position: relative;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    }
    .stat-card .stat-icon {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 2.8rem;
        opacity: 0.06;
    }
    .stat-card .stat-number {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 4px;
        letter-spacing: -0.3px;
        color: #0b1a33;
    }
    .stat-card .stat-label {
        color: #94a3b8;
        font-size: 0.82rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .stat-card.pending { 
        border-top-color: #F59E0B; 
    }
    .stat-card.pending .stat-icon { 
        color: #F59E0B; 
    }
    .stat-card.in-progress { 
        border-top-color: #0EA5E9; 
    }
    .stat-card.in-progress .stat-icon { 
        color: #0EA5E9; 
    }
    .stat-card.resolved { 
        border-top-color: #10B981; 
    }
    .stat-card.resolved .stat-icon { 
        color: #10B981; 
    }
    .stat-card.total { 
        border-top-color: #4F46E5; 
    }
    .stat-card.total .stat-icon { 
        color: #4F46E5; 
    }

    /* Modern Table */
    .modern-table {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        background: white;
        border: 1px solid #f0f2f5;
    }
    .modern-table thead {
        background: #f8fafc;
        border-bottom: 2px solid #eef2f6;
    }
    .modern-table thead th {
        border: none;
        padding: 14px 20px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 0.5px;
        color: #64748b;
    }
    .modern-table tbody tr {
        transition: all 0.15s ease;
        border-left: 3px solid transparent;
    }
    .modern-table tbody tr:hover {
        background: #f8faff;
        border-left-color: #4F46E5;
    }
    .modern-table tbody td {
        padding: 12px 20px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f5;
        color: #0b1a33;
    }
    .modern-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Priority Badges */
    .priority-badge {
        padding: 4px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .priority-high { 
        background: #FEF2F2; 
        color: #EF4444; 
    }
    .priority-medium { 
        background: #FFFBEB; 
        color: #F59E0B; 
    }
    .priority-low { 
        background: #ECFDF5; 
        color: #10B981; 
    }

    /* Status Badges */
    .status-badge {
        padding: 4px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .status-pending { 
        background: #FFFBEB; 
        color: #F59E0B; 
    }
    .status-in_progress { 
        background: #E0F2FE; 
        color: #0EA5E9; 
    }
    .status-resolved { 
        background: #ECFDF5; 
        color: #10B981; 
    }
    .status-rejected { 
        background: #FEF2F2; 
        color: #EF4444; 
    }

    /* Complaint By Badge */
    .complaint-by-badge {
        padding: 4px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .complaint-by-student {
        background: #ECFDF5;
        color: #10B981;
    }
    .complaint-by-user {
        background: #E0F2FE;
        color: #0EA5E9;
    }

    /* Action Buttons */
    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
        transition: all 0.2s ease;
        margin: 0 2px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        gap: 4px;
    }
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        text-decoration: none;
    }
    .action-btn.view { 
        background: #EEF2FF; 
        color: #4F46E5; 
    }
    .action-btn.view:hover { 
        background: #4F46E5; 
        color: white; 
    }

    /* Header Section */
    .page-header {
        background: white;
        border-radius: 16px;
        padding: 22px 28px;
        margin-bottom: 28px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        border: 1px solid #f0f2f5;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }
    .page-header h4 {
        margin: 0;
        font-weight: 700;
        color: #0b1a33;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.3rem;
    }
    .page-header h4 i {
        color: #4F46E5;
    }

    /* Avatar Circle */
    .avatar-circle {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4F46E5;
        font-weight: 700;
        font-size: 13px;
        flex-shrink: 0;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 50px 20px;
    }
    .empty-state i {
        font-size: 3.5rem;
        color: #d1d5db;
        display: block;
        margin-bottom: 15px;
    }
    .empty-state h5 {
        color: #0b1a33;
        font-weight: 600;
        margin-bottom: 5px;
    }
    .empty-state p {
        color: #94a3b8;
        margin-bottom: 15px;
    }

    /* Alert Messages */
    .alert {
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        border: none;
    }
    .alert-success {
        background: #ECFDF5;
        color: #065F46;
        border-left: 4px solid #10B981;
    }
    .alert-danger {
        background: #FEF2F2;
        color: #991B1B;
        border-left: 4px solid #EF4444;
    }
    .alert i {
        font-size: 1.2rem;
    }
    .alert .close {
        margin-left: auto;
        color: inherit;
        opacity: 0.5;
    }
    .alert .close:hover {
        opacity: 1;
    }

    /* Footer Info */
    .footer-info {
        text-align: center;
        color: #94a3b8;
        font-size: 0.8rem;
        margin-top: 15px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .stat-card .stat-number {
            font-size: 1.5rem;
        }
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        .modern-table {
            overflow-x: auto;
        }
        .modern-table table {
            min-width: 800px;
        }
        .action-btn {
            padding: 4px 10px;
            font-size: 0.7rem;
        }
    }

    @media (max-width: 576px) {
        .stat-card {
            padding: 16px 18px;
        }
        .stat-card .stat-number {
            font-size: 1.3rem;
        }
        .stat-card .stat-icon {
            font-size: 2rem;
        }
    }
</style>

<!-- Display Flash Messages -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<!-- Page Header -->
<div class="page-header">
    <h4>
        <i class="fas fa-clipboard-list"></i>
        Complaint Management
    </h4>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stat-card pending">
            <div class="stat-icon"><i class="fas fa-clock"></i></div>
            <div class="stat-number">{{ $pendingCount ?? 0 }}</div>
            <div class="stat-label">Pending Complaints</div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stat-card in-progress">
            <div class="stat-icon"><i class="fas fa-spinner"></i></div>
            <div class="stat-number">{{ $inProgressCount ?? 0 }}</div>
            <div class="stat-label">In Progress</div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stat-card resolved">
            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            <div class="stat-number">{{ $resolvedCount ?? 0 }}</div>
            <div class="stat-label">Resolved</div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stat-card total">
            <div class="stat-icon"><i class="fas fa-clipboard"></i></div>
            <div class="stat-number">{{ isset($complaints) ? $complaints->count() : 0 }}</div>
            <div class="stat-label">Total Complaints</div>
        </div>
    </div>
</div>

<!-- Complaints Table -->
<div class="modern-table">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Title</th>
                <th>Student</th>
                <th>Complaint By</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Submitted</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($complaints ?? [] as $complaint)
            <tr>
                <td>
                    <span class="font-weight-bold" style="color: #4F46E5;">#{{ $complaint->id }}</span>
                </td>
                <td>
                    <strong style="color: #0b1a33;">{{ $complaint->title }}</strong>
                    <div class="text-muted small" style="color: #94a3b8 !important;">{{ Str::limit($complaint->description, 50) }}</div>
                </td>
                <td>
                    <div class="d-flex align-items-center" style="gap: 8px;">
                        <div class="avatar-circle">
                            {{ substr($complaint->student_name, 0, 2) }}
                        </div>
                        <div>
                            <div style="font-weight: 500; color: #0b1a33;">{{ $complaint->student_name }}</div>
                            @if($complaint->room_number)
                                <small style="color: #94a3b8;"><i class="fas fa-door-open"></i> Room {{ $complaint->room_number }}</small>
                            @endif
                        </div>
                    </div>
                </td>
                <td>
                    <span class="complaint-by-badge complaint-by-{{ strtolower($complaint->complaint_by ?? 'user') }}">
                        <i class="fas fa-user-{{ strtolower($complaint->complaint_by ?? 'user') == 'student' ? 'graduate' : 'circle' }}"></i>
                        {{ ucfirst($complaint->complaint_by ?? 'User') }}
                    </span>
                </td>
                <td>
                    <span class="priority-badge priority-{{ $complaint->priority }}">
                        <i class="fas fa-flag"></i> {{ ucfirst($complaint->priority) }}
                    </span>
                </td>
                <td>
                    <span class="status-badge status-{{ $complaint->status }}">
                        @if($complaint->status == 'pending')
                            <i class="fas fa-clock"></i>
                        @elseif($complaint->status == 'in_progress')
                            <i class="fas fa-spinner fa-spin"></i>
                        @elseif($complaint->status == 'resolved')
                            <i class="fas fa-check"></i>
                        @else
                            <i class="fas fa-times"></i>
                        @endif
                        {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                    </span>
                </td>
                <td>
                    <div style="color: #0b1a33;">{{ $complaint->created_at->format('d-m-Y') }}</div>
                    <small style="color: #94a3b8;">{{ $complaint->created_at->diffForHumans() }}</small>
                </td>
                <td class="text-center">
                    <a href="{{ route('complaints.show', $complaint->id) }}" class="action-btn view" data-toggle="tooltip" title="View Details">
                        <i class="fas fa-eye"></i> View
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h5>No Complaints Found</h5>
                        <p>No complaints have been submitted yet.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Footer Info -->
<div class="footer-info">
    <i class="fas fa-info-circle"></i> 
    Showing {{ isset($complaints) ? $complaints->count() : 0 }} complaint(s) 
    | Last updated: {{ now()->format('d-m-Y H:i:s') }}
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
        
        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);

        console.log('✅ Complaint page loaded successfully');
    });
</script>
@endpush