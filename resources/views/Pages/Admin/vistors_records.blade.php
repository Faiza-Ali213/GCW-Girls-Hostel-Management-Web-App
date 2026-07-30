@extends('Layout.admin')

@section('content')
<style>
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
        font-size: 1.4rem;
    }
    .page-header .sub-title {
        color: #94a3b8;
        font-size: 0.9rem;
        margin-top: 2px;
        font-weight: 400;
    }
    .btn-add {
        background: linear-gradient(135deg, #4F46E5 0%, #4338CA 100%);
        color: white !important;
        border: none;
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.25);
    }
    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(79, 70, 229, 0.35);
        color: white !important;
        text-decoration: none;
    }

    .stat-card {
        background: white;
        border-radius: 14px;
        padding: 18px 22px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        border: 1px solid #f0f2f5;
        transition: all 0.2s ease;
        position: relative;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    }
    .stat-card .stat-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 2.5rem;
        opacity: 0.08;
    }
    .stat-card .stat-number {
        font-size: 1.8rem;
        font-weight: 700;
        color: #0b1a33;
        line-height: 1.2;
    }
    .stat-card .stat-label {
        color: #94a3b8;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .stat-card.total { border-top: 3px solid #4F46E5; }
    .stat-card.active { border-top: 3px solid #10B981; }
    .stat-card.today { border-top: 3px solid #F59E0B; }
    .stat-card.total-visitors { border-top: 3px solid #8B5CF6; }

    .filter-section {
        background: white;
        border-radius: 14px;
        padding: 16px 20px;
        margin-bottom: 24px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        border: 1px solid #f0f2f5;
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
    }
    .search-box {
        flex: 1;
        min-width: 200px;
        position: relative;
    }
    .search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }
    .search-box input {
        width: 100%;
        padding: 9px 16px 9px 42px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        background: #fafbfc;
        color: #0b1a33;
    }
    .search-box input:focus {
        outline: none;
        border-color: #4F46E5;
        background: white;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.06);
    }
    .filter-select {
        padding: 9px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.9rem;
        background: #fafbfc;
        min-width: 150px;
        transition: all 0.2s ease;
        color: #0b1a33;
        cursor: pointer;
    }
    .filter-select:focus {
        outline: none;
        border-color: #4F46E5;
        background: white;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.06);
    }

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
        border: none !important;
        padding: 14px 18px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        font-size: 0.7rem !important;
        letter-spacing: 0.5px !important;
        color: #64748b !important;
        background: transparent !important;
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
        padding: 12px 18px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f5;
        color: #0b1a33;
        font-size: 0.9rem;
    }

    .status-badge {
        padding: 4px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .status-active { background: #ECFDF5; color: #10B981; }
    .status-checked_out { background: #EFF6FF; color: #3B82F6; }
    .status-cancelled { background: #FEF2F2; color: #EF4444; }

    .action-group {
        display: flex;
        gap: 6px;
        justify-content: center;
        align-items: center;
    }
    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 8px;
        transition: all 0.2s ease;
        text-decoration: none;
        background: #f8fafc;
        border: 1px solid #e9ecef;
        color: #64748b !important;
        cursor: pointer;
    }
    .action-btn i {
        font-size: 0.9rem;
        color: #64748b !important;
        transition: all 0.2s ease;
    }
    .action-btn:hover {
        transform: translateY(-2px);
        text-decoration: none;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .action-btn.view:hover {
        border-color: #4F46E5;
        background: #EEF2FF;
    }
    .action-btn.view:hover i {
        color: #4F46E5 !important;
    }
    .action-btn.edit:hover {
        border-color: #F59E0B;
        background: #FFFBEB;
    }
    .action-btn.edit:hover i {
        color: #F59E0B !important;
    }
    .action-btn.delete:hover {
        border-color: #EF4444;
        background: #FEF2F2;
    }
    .action-btn.delete:hover i {
        color: #EF4444 !important;
    }

    .pagination-wrapper {
        padding: 16px 20px;
        background: white;
        border-radius: 0 0 16px 16px;
        border-top: 1px solid #f1f3f5;
    }
    .pagination-wrapper .pagination {
        margin: 0;
        justify-content: flex-end;
    }
    .pagination-wrapper .page-item.active .page-link {
        background: #4F46E5;
        border-color: #4F46E5;
        color: white;
        border-radius: 8px;
    }
    .pagination-wrapper .page-link {
        color: #4F46E5;
        border-radius: 8px;
        margin: 0 3px;
        border: none;
        padding: 6px 14px;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .pagination-wrapper .page-link:hover {
        background: #EEF2FF;
        color: #4F46E5;
        border-radius: 8px;
    }

    .visitor-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: white !important;
        font-weight: 700;
        font-size: 13px;
        flex-shrink: 0;
    }

    .visitor-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .visitor-name {
        font-weight: 600;
        color: #0b1a33;
        font-size: 0.9rem;
    }

    .empty-state {
        text-align: center;
        padding: 50px 20px;
    }
    .empty-state i {
        font-size: 4rem;
        color: #d1d5db;
        margin-bottom: 16px;
        display: block;
    }
    .empty-state h5 {
        color: #0b1a33;
        margin-bottom: 8px;
        font-weight: 600;
        font-size: 1.1rem;
    }
    .empty-state p {
        color: #94a3b8;
        font-size: 0.95rem;
    }

    .alert {
        border: none;
        padding: 15px 20px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
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
    .alert .close {
        margin-left: auto;
        color: inherit;
        opacity: 0.5;
    }
    .alert .close:hover {
        opacity: 1;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        .page-header .btn-add {
            width: 100%;
            justify-content: center;
        }
        .filter-section {
            flex-direction: column;
        }
        .search-box {
            width: 100%;
        }
        .filter-select {
            width: 100%;
        }
        .modern-table {
            font-size: 0.85rem;
        }
        .modern-table thead th,
        .modern-table tbody td {
            padding: 8px 10px !important;
        }
        .action-group {
            gap: 3px;
        }
        .action-btn {
            width: 28px;
            height: 28px;
        }
        .action-btn i {
            font-size: 0.75rem;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div>
        <h4>
            <i class="fas fa-user-friends"></i>
            Visitor Records
        </h4>
        <div class="sub-title">Manage student visitor entries and track visitors</div>
    </div>
    <a href="{{ route('visitor.create') }}" class="btn-add">
        <i class="fas fa-plus-circle"></i> Add Visitor
    </a>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stat-card total">
            <div class="stat-icon"><i class="fas fa-users"></i></div>
            <div class="stat-number">{{ $totalVisitors ?? 0 }}</div>
            <div class="stat-label">Total Entries</div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stat-card active">
            <div class="stat-icon"><i class="fas fa-user-check"></i></div>
            <div class="stat-number">{{ $activeVisitors ?? 0 }}</div>
            <div class="stat-label">Active</div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stat-card today">
            <div class="stat-icon"><i class="fas fa-calendar-day"></i></div>
            <div class="stat-number">{{ $todayVisitors ?? 0 }}</div>
            <div class="stat-label">Today</div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stat-card total-visitors">
            <div class="stat-icon"><i class="fas fa-people-arrows"></i></div>
            <div class="stat-number">{{ $totalVisitorsCount ?? 0 }}</div>
            <div class="stat-label">Total Visitors</div>
        </div>
    </div>
</div>

<!-- Search and Filter -->
<div class="filter-section">
    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" id="searchInput" placeholder="Search by visitor name, student name, phone..." value="{{ request('search') }}">
    </div>
    <select id="statusFilter" class="filter-select">
        <option value="">All Status</option>
        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
        <option value="checked_out" {{ request('status') == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
    </select>
    <input type="date" id="dateFilter" class="filter-select" value="{{ request('date') }}" style="min-width:150px;">
</div>

<!-- Visitors Table -->
<div class="modern-table">
    <table class="table table-hover">
        <thead>
            <tr>
                <th style="width:50px;">#</th>
                <th>Visitor</th>
                <th>Contact</th>
                <th>Student</th>
                <th>Visitors</th>
                <th>Status</th>
                <th style="width:140px;" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($visitors ?? [] as $index => $visitor)
            <tr>
                <td>
                    <span class="font-weight-bold" style="color: #4F46E5;">{{ $visitors->firstItem() + $index }}</span>
                </td>
                <td>
                    <div class="visitor-info">
                        <div class="visitor-avatar">
                            {{ substr($visitor->visitor_name, 0, 2) }}
                        </div>
                        <div>
                            <div class="visitor-name">{{ $visitor->visitor_name }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <div>
                        <div><i class="fas fa-phone" style="color:#94a3b8;font-size:0.75rem;"></i> {{ $visitor->phone_number ?? 'N/A' }}</div>
                        <div><i class="fas fa-id-card" style="color:#94a3b8;font-size:0.75rem;"></i> {{ $visitor->cnic_number ?? 'N/A' }}</div>
                    </div>
                </td>
                <td>
                    <div>
                        <div><strong>{{ $visitor->student_name }}</strong></div>
                        @if($visitor->student_room)
                            <div><i class="fas fa-door-open" style="color:#94a3b8;font-size:0.75rem;"></i> Room {{ $visitor->student_room }}</div>
                        @endif
                    </div>
                </td>
                <td>
                    <span class="badge" style="background:#EEF2FF;color:#4F46E5;padding:4px 12px;border-radius:12px;font-weight:600;">
                        {{ $visitor->number_of_visitors }}
                    </span>
                </td>
                <td>
                    <span class="status-badge status-{{ $visitor->status }}">
                        @if($visitor->status == 'active')
                            <i class="fas fa-circle" style="font-size:0.5rem;"></i>
                        @elseif($visitor->status == 'checked_out')
                            <i class="fas fa-check-circle"></i>
                        @else
                            <i class="fas fa-times-circle"></i>
                        @endif
                        {{ ucfirst(str_replace('_', ' ', $visitor->status)) }}
                    </span>
                </td>
                <td class="text-center">
                    <div class="action-group">
                        <a href="{{ route('visitor.show', $visitor->id) }}" class="action-btn view" title="View Details">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('visitor.edit', $visitor->id) }}" class="action-btn edit" title="Edit Visitor">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('visitor.destroy', $visitor->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete" title="Delete" 
                                    onclick="return confirm('Delete visitor {{ $visitor->visitor_name }}?');">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">
                    <div class="empty-state">
                        <i class="fas fa-user-friends"></i>
                        <h5>No Visitor Records Found</h5>
                        <p>Start by adding your first visitor entry using the "Add Visitor" button above.</p>
                        <a href="{{ route('visitor.create') }}" class="btn-add" style="display:inline-flex;margin-top:15px;">
                            <i class="fas fa-plus"></i> Add First Visitor
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if(isset($visitors) && $visitors->count() > 0)
<div class="pagination-wrapper">
    {{ $visitors->links() }}
</div>
@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    console.log('✅ Visitor Records page loaded');

    // ========== SEARCH AND FILTER ==========
    let searchTimeout;
    
    $('#searchInput').on('keyup', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            performSearch();
        }, 500);
    });

    $('#statusFilter').on('change', function() {
        performSearch();
    });

    $('#dateFilter').on('change', function() {
        performSearch();
    });

    function performSearch() {
        const search = $('#searchInput').val();
        const status = $('#statusFilter').val();
        const date = $('#dateFilter').val();
        let url = '{{ route("visitors_records") }}?';
        if (search) url += 'search=' + encodeURIComponent(search) + '&';
        if (status) url += 'status=' + encodeURIComponent(status) + '&';
        if (date) url += 'date=' + encodeURIComponent(date);
        window.location.href = url;
    }

    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
});
</script>
@endpush