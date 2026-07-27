@extends('Layout.admin')

@section('content')
<style>
    /* ============================================ */
    /* VISITOR RECORDS - BLUE THEME */
    /* ============================================ */
    
    /* Page Header */
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

    /* Statistics Cards */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 28px;
    }
    .stat-card {
        background: white;
        border-radius: 14px;
        padding: 20px 24px;
        border: 1px solid #f0f2f5;
        transition: all 0.3s ease;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        border-color: #4F46E5;
    }
    .stat-card .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #0b1a33;
        line-height: 1.2;
        letter-spacing: -0.3px;
    }
    .stat-card .stat-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #94a3b8;
        font-weight: 600;
        margin-top: 2px;
    }
    .stat-card .stat-number.active {
        color: #10B981;
    }
    .stat-card .stat-number.today {
        color: #4F46E5;
    }
    .stat-card .stat-icon {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 2.8rem;
        opacity: 0.06;
        color: #4F46E5;
    }

    /* Search and Filter */
    .filter-section {
        background: white;
        border-radius: 14px;
        padding: 16px 20px;
        margin-bottom: 24px;
        border: 1px solid #f0f2f5;
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
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

    /* Table */
    .table-wrapper {
        background: white;
        border-radius: 16px;
        border: 1px solid #f0f2f5;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    }
    .table-wrapper thead {
        background: #f8fafc;
        border-bottom: 2px solid #eef2f6;
    }
    .table-wrapper thead th {
        padding: 14px 20px;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        font-weight: 700;
        border-bottom: none;
    }
    .table-wrapper tbody td {
        padding: 12px 20px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f5;
        font-size: 0.9rem;
        color: #0b1a33;
    }
    .table-wrapper tbody tr:hover {
        background: #f8faff;
    }
    .table-wrapper tbody tr:last-child td {
        border-bottom: none;
    }

    /* Badges */
    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    .badge-status.active {
        background: #ECFDF5;
        color: #10B981;
    }
    .badge-status.checked_out {
        background: #F1F5F9;
        color: #64748b;
    }
    .badge-status i {
        font-size: 0.6rem;
    }

    .badge-room {
        display: inline-block;
        padding: 3px 12px;
        background: #EEF2FF;
        color: #4F46E5;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
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
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        color: #64748b;
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
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        text-decoration: none;
    }
    .action-btn.view:hover {
        border-color: #4F46E5;
        color: #4F46E5;
        background: #EEF2FF;
    }
    .action-btn.edit:hover {
        border-color: #F59E0B;
        color: #F59E0B;
        background: #FFFBEB;
    }
    .action-btn.delete:hover {
        border-color: #EF4444;
        color: #EF4444;
        background: #FEF2F2;
    }

    /* Delete Form Styles */
    .delete-form {
        display: inline;
        margin: 0;
        padding: 0;
    }
    .delete-form .action-btn {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        color: #64748b;
    }
    .delete-form .action-btn:hover {
        border-color: #EF4444;
        color: #EF4444;
        background: #FEF2F2;
    }

    /* Pagination */
    .pagination-wrapper {
        padding: 15px 20px;
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
        border: none;
        padding: 6px 14px;
        border-radius: 8px;
        margin: 0 2px;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .pagination-wrapper .page-link:hover {
        background: #EEF2FF;
        color: #4F46E5;
        border-radius: 8px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 50px 20px;
    }
    .empty-state i {
        font-size: 3.5rem;
        color: #d1d5db;
        margin-bottom: 15px;
        display: block;
    }
    .empty-state h5 {
        color: #0b1a33;
        font-weight: 600;
        margin-bottom: 4px;
    }
    .empty-state p {
        color: #94a3b8;
    }

    /* Footer */
    .footer-info {
        text-align: center;
        color: #94a3b8;
        font-size: 0.8rem;
        margin-top: 15px;
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
        .stat-card .stat-number {
            font-size: 1.5rem;
        }
    }
    @media (max-width: 576px) {
        .stat-grid {
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .stat-card {
            padding: 14px 16px;
        }
        .stat-card .stat-number {
            font-size: 1.3rem;
        }
        .stat-card .stat-icon {
            font-size: 2rem;
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
        <div class="stat-icon"><i class="fas fa-users"></i></div>
        <div class="stat-number">{{ $totalVisitors ?? 0 }}</div>
        <div class="stat-label">Total Visitors</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-user-check"></i></div>
        <div class="stat-number active">{{ $totalActive ?? 0 }}</div>
        <div class="stat-label">Active Visitors</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-calendar-day"></i></div>
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
                        <div style="width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,#4F46E5,#4338CA);color:white;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;flex-shrink:0;">
                            {{ substr($visitor->visitor_name, 0, 2) }}
                        </div>
                        <div>
                            <div style="font-weight:600;color:#0b1a33;">{{ $visitor->visitor_name }}</div>
                            @if($visitor->student_name)
                                <small style="color:#94a3b8;font-size:0.75rem;">
                                    <i class="fas fa-user-graduate"></i> {{ $visitor->student_name }}
                                </small>
                            @endif
                        </div>
                    </div>
                </td>
                <td>{{ $visitor->phone_number }}</td>
                <td>
                    <span style="font-size:0.85rem;color:#0b1a33;">{{ $visitor->purpose_of_visit }}</span>
                    @if($visitor->student_name)
                        <br><small style="color:#94a3b8;font-size:0.7rem;">
                            <i class="fas fa-user"></i> {{ $visitor->student_name }}
                        </small>
                    @endif
                </td>
                <td>
                    @if($visitor->room_no)
                        <span class="badge-room">{{ $visitor->room_no }}</span>
                    @else
                        <span style="color:#94a3b8;">-</span>
                    @endif
                </td>
                <td>
                    <div style="font-size:0.85rem;color:#0b1a33;">{{ $visitor->check_in_time ? $visitor->check_in_time->format('d M Y') : 'N/A' }}</div>
                    <small style="color:#94a3b8;font-size:0.7rem;">{{ $visitor->check_in_time ? $visitor->check_in_time->format('h:i A') : '' }}</small>
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