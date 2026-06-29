@extends('Layout.admin')

@section('content')
<style>
    /* Modern Statistics Cards */
    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border-left: 4px solid;
        position: relative;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }
    .stat-card .stat-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 2.5rem;
        opacity: 0.15;
    }
    .stat-card .stat-number {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 5px;
    }
    .stat-card .stat-label {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .stat-card.pending { border-left-color: #ffc107; }
    .stat-card.in-progress { border-left-color: #17a2b8; }
    .stat-card.resolved { border-left-color: #28a745; }
    .stat-card.total { border-left-color: #dc3545; }

    /* Modern Table */
    .modern-table {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .modern-table thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    .modern-table thead th {
        border: none;
        padding: 15px 20px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    .modern-table tbody tr {
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
    }
    .modern-table tbody tr:hover {
        background: #f8f9fa;
        border-left-color: #667eea;
        transform: scale(1.01);
    }
    .modern-table tbody td {
        padding: 12px 20px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f5;
    }
    .modern-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Priority Badges */
    .priority-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .priority-high { background: #fee; color: #dc3545; }
    .priority-medium { background: #fff3cd; color: #ffc107; }
    .priority-low { background: #d4edda; color: #28a745; }

    /* Status Badges */
    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .status-pending { background: #fff3cd; color: #856404; }
    .status-in-progress { background: #d1ecf1; color: #0c5460; }
    .status-resolved { background: #d4edda; color: #155724; }
    .status-rejected { background: #f8d7da; color: #721c24; }

    /* Action Buttons */
    .action-btn {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        transition: all 0.2s ease;
        margin: 0 2px;
    }
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    .action-btn.view { background: #e3f2fd; color: #1976d2; }
    .action-btn.edit { background: #fff3e0; color: #f57c00; }
    .action-btn.delete { background: #fbe9e7; color: #d32f2f; }

    /* Header Section */
    .page-header {
        background: white;
        border-radius: 15px;
        padding: 20px 25px;
        margin-bottom: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }
    .page-header h4 {
        margin: 0;
        font-weight: 700;
        color: #2c3e50;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .page-header h4 i {
        color: #667eea;
    }
    .btn-add {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }
    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        color: white;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 50px 20px;
    }
    .empty-state i {
        font-size: 4rem;
        color: #dee2e6;
        margin-bottom: 20px;
    }
    .empty-state h5 {
        color: #6c757d;
        margin-bottom: 10px;
    }
    .empty-state p {
        color: #adb5bd;
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
        .page-header .btn-add {
            width: 100%;
            text-align: center;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <h4>
        <i class="fas fa-clipboard-list"></i>
        Complaint Management
    </h4>
    <a href="{{ route('complaints.create') }}" class="btn-add">
        <i class="fas fa-plus-circle"></i> Add New Complaint
    </a>
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
                    <span class="font-weight-bold">#{{ $complaint->id }}</span>
                </td>
                <td>
                    <strong>{{ $complaint->title }}</strong>
                    <div class="text-muted small">{{ Str::limit($complaint->description, 50) }}</div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="avatar-circle mr-2" style="width:32px;height:32px;border-radius:50%;background:#667eea20;display:flex;align-items:center;justify-content:center;color:#667eea;font-weight:bold;">
                            {{ substr($complaint->student_name, 0, 2) }}
                        </div>
                        <div>
                            <div>{{ $complaint->student_name }}</div>
                            @if($complaint->room_number)
                                <small class="text-muted"><i class="fas fa-door-open"></i> Room {{ $complaint->room_number }}</small>
                            @endif
                        </div>
                    </div>
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
                    <div>{{ $complaint->created_at->format('d-m-Y') }}</div>
                    <small class="text-muted">{{ $complaint->created_at->diffForHumans() }}</small>
                </td>
                <td class="text-center">
                    <a href="{{ route('complaints.show', $complaint->id) }}" class="action-btn view" data-toggle="tooltip" title="View Details">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('complaints.edit', $complaint->id) }}" class="action-btn edit" data-toggle="tooltip" title="Edit Complaint">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('complaints.destroy', $complaint->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn delete" data-toggle="tooltip" title="Delete Complaint" onclick="return confirm('Are you sure you want to delete this complaint?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h5>No Complaints Found</h5>
                        <p>Start by adding your first complaint using the "Add New Complaint" button above.</p>
                        <a href="{{ route('complaints.create') }}" class="btn btn-primary btn-sm mt-3">
                            <i class="fas fa-plus"></i> Add First Complaint
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Footer Info -->
<div class="mt-3 text-muted text-center">
    <small>
        <i class="fas fa-info-circle"></i> 
        Showing {{ isset($complaints) ? $complaints->count() : 0 }} complaint(s) 
        | Last updated: {{ now()->format('d-m-Y H:i:s') }}
    </small>
</div>

@endsection

@push('scripts')
<script>
    // Initialize tooltips
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endpush