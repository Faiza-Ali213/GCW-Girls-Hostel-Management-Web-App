@extends('Layout.admin')

@section('content')
<style>
    /* Page Header */
    .page-header {
        background: white;
        border-radius: 12px;
        padding: 18px 24px;
        margin-bottom: 25px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        border-bottom: 2px solid #f0f0f0;
    }
    .page-header h4 {
        margin: 0;
        font-weight: 600;
        color: #1a1a1a;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.2rem;
    }
    .page-header h4 i {
        color: #0B2E33;
    }
    .page-header .sub-title {
        color: #888;
        font-size: 0.85rem;
        margin-top: 2px;
        font-weight: 400;
    }
    .btn-add {
        background: #0B2E33;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.85rem;
    }
    .btn-add:hover {
        background: #1a4a52;
        color: white;
        text-decoration: none;
    }

    /* Statistics Cards */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }
    .stat-card {
        background: white;
        border-radius: 10px;
        padding: 16px 20px;
        border: 1px solid #f0f0f0;
        transition: all 0.2s ease;
    }
    .stat-card:hover {
        border-color: #0B2E33;
        transform: translateY(-2px);
    }
    .stat-card .stat-number {
        font-size: 1.6rem;
        font-weight: 700;
        color: #1a1a1a;
        line-height: 1.2;
    }
    .stat-card .stat-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #999;
        font-weight: 500;
        margin-top: 2px;
    }
    .stat-card .stat-number.active {
        color: #2e7d32;
    }
    .stat-card .stat-number.today {
        color: #0B2E33;
    }

    /* Search and Filter */
    .filter-section {
        background: white;
        border-radius: 10px;
        padding: 12px 18px;
        margin-bottom: 20px;
        border: 1px solid #f0f0f0;
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
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #bbb;
    }
    .search-box input {
        width: 100%;
        padding: 8px 14px 8px 38px;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        background: #fafafa;
    }
    .search-box input:focus {
        outline: none;
        border-color: #0B2E33;
        background: white;
    }
    .filter-select {
        padding: 8px 14px;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        font-size: 0.9rem;
        background: #fafafa;
        min-width: 140px;
        transition: all 0.2s ease;
    }
    .filter-select:focus {
        outline: none;
        border-color: #0B2E33;
        background: white;
    }

    /* Table */
    .table-wrapper {
        background: white;
        border-radius: 10px;
        border: 1px solid #f0f0f0;
        overflow: hidden;
    }
    .table-wrapper thead {
        background: #f8f9fa;
    }
    .table-wrapper thead th {
        padding: 12px 16px;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #888;
        font-weight: 600;
        border-bottom: 2px solid #f0f0f0;
    }
    .table-wrapper tbody td {
        padding: 10px 16px;
        vertical-align: middle;
        border-bottom: 1px solid #f5f5f5;
        font-size: 0.9rem;
        color: #333;
    }
    .table-wrapper tbody tr:hover {
        background: #fafbfc;
    }
    .table-wrapper tbody tr:last-child td {
        border-bottom: none;
    }

    /* Badges */
    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    .badge-status.active {
        background: #e8f5e9;
        color: #2e7d32;
    }
    .badge-status.checked_out {
        background: #f5f5f5;
        color: #888;
    }
    .badge-status i {
        font-size: 0.6rem;
    }

    .badge-room {
        display: inline-block;
        padding: 2px 10px;
        background: #f5f5f5;
        border-radius: 4px;
        font-size: 12px;
        color: #333;
        font-weight: 500;
    }

    /* Action Buttons */
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
        border-radius: 6px;
        border: 1px solid #e0e0e0;
        background: #ffffff;
        color: #555;
        font-size: 14px;
        transition: all 0.2s ease;
        text-decoration: none;
        cursor: pointer;
        line-height: 1;
        padding: 0;
    }
    .action-btn i {
        font-size: 14px;
        line-height: 1;
        color: inherit;
    }
    .action-btn:hover {
        background: #f5f5f5;
        border-color: #0B2E33;
        color: #0B2E33;
        text-decoration: none;
        transform: scale(1.05);
    }
    .action-btn.view:hover {
        border-color: #0B2E33;
        color: #0B2E33;
        background: #e8f0f1;
    }
    .action-btn.edit:hover {
        border-color: #f57c00;
        color: #f57c00;
        background: #fff3e0;
    }
    .action-btn.delete:hover {
        border-color: #dc3545;
        color: #dc3545;
        background: #fbe9eb;
    }

    /* Delete Form Styles */
    .delete-form {
        display: inline;
        margin: 0;
        padding: 0;
    }
    .delete-form .action-btn {
        background: #ffffff;
        border: 1px solid #e0e0e0;
        color: #555;
    }
    .delete-form .action-btn:hover {
        border-color: #dc3545;
        color: #dc3545;
        background: #fbe9eb;
    }

    /* Pagination */
    .pagination-wrapper {
        padding: 14px 18px;
        border-top: 1px solid #f0f0f0;
    }
    .pagination-wrapper .pagination {
        margin: 0;
        justify-content: flex-end;
    }
    .pagination-wrapper .page-item.active .page-link {
        background: #0B2E33;
        border-color: #0B2E33;
        color: white;
    }
    .pagination-wrapper .page-link {
        color: #333;
        border: none;
        padding: 6px 14px;
        border-radius: 4px;
        margin: 0 2px;
    }
    .pagination-wrapper .page-link:hover {
        background: #f5f5f5;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
    }
    .empty-state i {
        font-size: 3rem;
        color: #ddd;
        margin-bottom: 15px;
    }
    .empty-state h5 {
        color: #888;
        margin-bottom: 4px;
        font-weight: 500;
    }
    .empty-state p {
        color: #aaa;
    }

    /* Footer */
    .footer-info {
        text-align: center;
        color: #999;
        font-size: 0.8rem;
        margin-top: 15px;
    }

    /* Alert Messages */
    .alert {
        padding: 12px 20px;
        border-radius: 8px;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .alert-success {
        background: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #c8e6c9;
    }
    .alert-danger {
        background: #fbe9eb;
        color: #c62828;
        border: 1px solid #f5c6cb;
    }
    .alert i {
        font-size: 1.2rem;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .stat-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
        .page-header .btn-add {
            width: 100%;
            justify-content: center;
        }
        .filter-section {
            flex-direction: column;
            align-items: stretch;
        }
        .filter-select {
            width: 100%;
        }
        .stat-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
    @media (max-width: 576px) {
        .stat-grid {
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .stat-card {
            padding: 12px 14px;
        }
        .stat-card .stat-number {
            font-size: 1.3rem;
        }
        .table-wrapper {
            overflow-x: auto;
        }
        .table-wrapper table {
            min-width: 700px;
        }
        .action-group {
            gap: 4px;
        }
        .action-btn {
            width: 30px;
            height: 30px;
            font-size: 12px;
        }
        .action-btn i {
            font-size: 12px;
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
    <div>
        <h4>
            <i class="fas fa-users"></i>
            Visitors Records
        </h4>
        <div class="sub-title">Manage all visitor entries</div>
    </div>
    <a href="{{ route('visitor.create') }}" class="btn-add">
        <i class="fas fa-plus-circle"></i> Add Visitor
    </a>
</div>

<!-- Statistics -->
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-number">{{ $totalVisitors ?? 0 }}</div>
        <div class="stat-label">Total Visitors</div>
    </div>
    <div class="stat-card">
        <div class="stat-number active">{{ $totalActive ?? 0 }}</div>
        <div class="stat-label">Active Visitors</div>
    </div>
    <div class="stat-card">
        <div class="stat-number today">{{ $todayVisitors ?? 0 }}</div>
        <div class="stat-label">Today's Visitors</div>
    </div>
</div>

<!-- Search and Filter -->
<div class="filter-section">
    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" id="searchInput" placeholder="Search by name, phone, student..." value="{{ request('search') }}">
    </div>
    <select id="statusFilter" class="filter-select">
        <option value="">All Status</option>
        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
        <option value="checked_out" {{ request('status') == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
    </select>
</div>

<!-- Table -->
<div class="table-wrapper">
    <table class="table">
        <thead>
            <tr>
                <th style="width:50px;">#</th>
                <th>Visitor</th>
                <th>Phone</th>
                <th>Purpose</th>
                <th>Room</th>
                <th>Check In</th>
                <th>Status</th>
                <th style="width:120px;" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($visitors ?? [] as $index => $visitor)
            <tr id="visitor-row-{{ $visitor->id }}">
                <td>{{ $visitors->firstItem() + $index }}</td>
                <td>
                    <div style="display:flex;align-items:center;gap:8px;">
                        <div style="width:30px;height:30px;border-radius:50%;background:#0B2E33;color:white;display:flex;align-items:center;justify-content:center;font-weight:600;font-size:12px;flex-shrink:0;">
                            {{ substr($visitor->visitor_name, 0, 2) }}
                        </div>
                        <div>
                            <div style="font-weight:500;color:#1a1a1a;">{{ $visitor->visitor_name }}</div>
                            @if($visitor->student_name)
                                <small style="color:#999;font-size:0.75rem;">
                                    <i class="fas fa-user-graduate"></i> {{ $visitor->student_name }}
                                </small>
                            @endif
                        </div>
                    </div>
                </td>
                <td>{{ $visitor->phone_number }}</td>
                <td>
                    <span style="font-size:0.85rem;">{{ $visitor->purpose_of_visit }}</span>
                    @if($visitor->student_name)
                        <br><small style="color:#999;font-size:0.7rem;">
                            <i class="fas fa-user"></i> {{ $visitor->student_name }}
                        </small>
                    @endif
                </td>
                <td>
                    @if($visitor->room_no)
                        <span class="badge-room">{{ $visitor->room_no }}</span>
                    @else
                        <span style="color:#bbb;">-</span>
                    @endif
                </td>
                <td>
                    <div style="font-size:0.85rem;">{{ $visitor->check_in_time ? $visitor->check_in_time->format('d M Y') : 'N/A' }}</div>
                    <small style="color:#999;font-size:0.7rem;">{{ $visitor->check_in_time ? $visitor->check_in_time->format('h:i A') : '' }}</small>
                </td>
                <td>
                    <span class="badge-status {{ $visitor->status }}">
                        @if($visitor->status == 'active')
                            <i class="fas fa-circle" style="font-size:0.5rem;"></i>
                        @else
                            <i class="fas fa-check-circle"></i>
                        @endif
                        {{ $visitor->status == 'active' ? 'Active' : 'Checked Out' }}
                    </span>
                </td>
                <td>
                    <div class="action-group">
                        <a href="{{ route('visitor.show', $visitor->id) }}" class="action-btn view" title="View Details">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('visitor.edit', $visitor->id) }}" class="action-btn edit" title="Edit Visitor">
                            <i class="fas fa-edit"></i>
                        </a>
                        <!-- DELETE FORM -->
                        <form action="{{ route('visitor.destroy', $visitor->id) }}" method="POST" class="delete-form" onsubmit="return confirm('Are you sure you want to delete this visitor: {{ addslashes($visitor->visitor_name) }}? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete" title="Delete Visitor">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h5>No Visitors Found</h5>
                        <p>Start by adding your first visitor record.</p>
                        <a href="{{ route('visitor.create') }}" class="btn-add" style="display:inline-flex;margin-top:10px;">
                            <i class="fas fa-plus"></i> Add Visitor
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if(isset($visitors) && $visitors->count() > 0)
    <div class="pagination-wrapper">
        {{ $visitors->appends(request()->query())->links() }}
    </div>
    @endif
</div>

<!-- Footer -->
<div class="footer-info">
    <i class="fas fa-info-circle"></i> 
    Showing {{ isset($visitors) ? $visitors->count() : 0 }} visitor(s) 
    | Total: {{ $totalVisitors ?? 0 }}
    | Last updated: {{ now()->format('d-m-Y H:i:s') }}
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
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

        function performSearch() {
            const search = $('#searchInput').val();
            const status = $('#statusFilter').val();
            let url = '{{ route("vistors_records") }}';
            let params = [];
            if (search) params.push('search=' + encodeURIComponent(search));
            if (status) params.push('status=' + encodeURIComponent(status));
            if (params.length > 0) {
                url += '?' + params.join('&');
            }
            window.location.href = url;
        }

        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);

        console.log('✅ Visitor Records page loaded successfully');
        console.log('📍 Delete route: /visitor/{id}');
    });
</script>
@endpush