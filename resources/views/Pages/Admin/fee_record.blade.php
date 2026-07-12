@extends('Layout.admin')

@section('content')
<style>
    /* Your existing styles... */
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
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        color: #6c757d !important;
        cursor: pointer;
    }
    .action-btn i {
        font-size: 0.9rem;
        color: #6c757d !important;
        transition: all 0.2s ease;
    }
    .action-btn:hover {
        transform: translateY(-2px);
        text-decoration: none;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .action-btn.delete:hover {
        border-color: #dc3545;
        background: white;
    }
    .action-btn.delete:hover i {
        color: #dc3545 !important;
    }

    /* Toast Notification */
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
    }
    .toast {
        padding: 15px 25px;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        margin-bottom: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        animation: slideIn 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 300px;
    }
    .toast-success {
        background: #28a745;
    }
    .toast-error {
        background: #dc3545;
    }
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .status-badge i {
        font-size: 0.7rem;
    }
    .status-paid { 
        background: #e6f4ea; 
        color: #1e7e34; 
    }
    .status-unpaid { 
        background: #fce8e6; 
        color: #b71c1c; 
    }
    .status-partial { 
        background: #fff3e0; 
        color: #e65100; 
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 20px 24px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        transition: all 0.2s ease;
        border: 1px solid #f0f0f0;
        position: relative;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .stat-card .stat-icon {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 2.8rem;
        opacity: 0.06;
        color: #0B2E33;
    }
    .stat-card .stat-number {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 4px;
        letter-spacing: -0.3px;
    }
    .stat-card .stat-label {
        color: #7a8a9e;
        font-size: 0.82rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .stat-card.total .stat-number { color: #0B2E33; }
    .stat-card.paid .stat-number { color: #28a745; }
    .stat-card.unpaid .stat-number { color: #dc3545; }
    .stat-card.partial .stat-number { color: #e8a317; }
    
    .stat-card.total { border-top: 3px solid #0B2E33; }
    .stat-card.paid { border-top: 3px solid #28a745; }
    .stat-card.unpaid { border-top: 3px solid #dc3545; }
    .stat-card.partial { border-top: 3px solid #e8a317; }

    .page-header {
        background: white;
        border-radius: 12px;
        padding: 22px 28px;
        margin-bottom: 28px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        border: 1px solid #f0f0f0;
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
        font-size: 1.3rem;
    }
    .page-header h4 i {
        color: #0B2E33;
        font-size: 1.4rem;
    }
    .btn-add {
        background: #0B2E33;
        color: white !important;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
    }
    .btn-add:hover {
        background: #0a262a;
        color: white !important;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(11, 46, 51, 0.2);
    }

    .filter-section {
        background: white;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
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
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #adb5bd;
        font-size: 0.9rem;
    }
    .search-box input {
        width: 100%;
        padding: 9px 16px 9px 42px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        background: #fafbfc;
        color: #2c3e50;
    }
    .search-box input:focus {
        outline: none;
        border-color: #0B2E33;
        background: white;
        box-shadow: 0 0 0 3px rgba(11, 46, 51, 0.06);
    }
    .filter-select {
        padding: 9px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.9rem;
        background: #fafbfc;
        min-width: 150px;
        transition: all 0.2s ease;
        color: #2c3e50;
        cursor: pointer;
    }
    .filter-select:focus {
        outline: none;
        border-color: #0B2E33;
        background: white;
        box-shadow: 0 0 0 3px rgba(11, 46, 51, 0.06);
    }

    .modern-table {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        background: white;
        border: 1px solid #f0f0f0;
    }
    .modern-table thead {
        background: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
    }
    .modern-table thead th {
        border: none !important;
        padding: 14px 18px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        font-size: 0.78rem !important;
        letter-spacing: 0.5px !important;
        color: #4a5a6e !important;
        background: transparent !important;
    }
    .modern-table tbody tr {
        transition: all 0.15s ease;
        border-left: 3px solid transparent;
    }
    .modern-table tbody tr:hover {
        background: #f8fafc;
        border-left-color: #0B2E33;
    }
    .modern-table tbody td {
        padding: 12px 18px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f5;
        color: #2c3e50;
        font-size: 0.9rem;
    }

    .student-avatar {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #0B2E33;
        color: white !important;
        font-weight: 700;
        font-size: 13px;
        flex-shrink: 0;
    }
    .student-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .student-name {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.9rem;
    }

    .room-badge {
        display: inline-block;
        padding: 4px 12px;
        background: #f1f3f5;
        border-radius: 6px;
        font-size: 0.82rem;
        color: #0B2E33;
        font-weight: 600;
    }

    .amount-fee { font-weight: 600; color: #0B2E33; }
    .amount-paid { font-weight: 600; color: #28a745; }
    .amount-pending { font-weight: 600; color: #dc3545; }

    .pagination-wrapper {
        padding: 16px 20px;
        background: white;
        border-radius: 0 0 12px 12px;
        border-top: 1px solid #f1f3f5;
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
        color: #0B2E33;
        border-radius: 6px;
        margin: 0 3px;
        border: 1px solid transparent;
        padding: 6px 14px;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .pagination-wrapper .page-link:hover {
        background: #f1f3f5;
        color: #0B2E33;
        border-color: #e9ecef;
    }

    .empty-state {
        text-align: center;
        padding: 50px 20px;
    }
    .empty-state i {
        font-size: 4rem;
        color: #dee2e6;
        margin-bottom: 16px;
    }
    .empty-state h5 {
        color: #2c3e50;
        margin-bottom: 8px;
        font-weight: 600;
        font-size: 1.1rem;
    }
    .empty-state p {
        color: #adb5bd;
        font-size: 0.95rem;
    }

    .modal-content {
        border-radius: 12px;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }
    .modal-header {
        border-bottom: 1px solid #f1f3f5;
        padding: 16px 24px;
        background: #fafbfc;
        border-radius: 12px 12px 0 0;
    }
    .modal-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #2c3e50 !important;
    }
    .modal-body {
        padding: 24px;
    }
    .modal-footer {
        border-top: 1px solid #f1f3f5;
        padding: 14px 24px;
        background: #fafbfc;
        border-radius: 0 0 12px 12px;
    }
    .modal .btn-danger {
        background: #dc3545;
        border: none;
        border-radius: 8px;
        padding: 8px 24px;
        font-weight: 600;
        transition: all 0.2s ease;
        color: #fff;
        font-size: 0.9rem;
    }
    .modal .btn-danger:hover {
        background: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
        color: #fff;
    }
    .modal .btn-secondary {
        background: #f1f3f5;
        border: none;
        color: #495057;
        border-radius: 8px;
        padding: 8px 24px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .modal .btn-secondary:hover {
        background: #e9ecef;
        color: #2c3e50;
    }

    /* Delete Form Styles */
    .delete-form {
        display: inline;
    }
</style>

<!-- Toast Container -->
<div class="toast-container" id="toastContainer"></div>

<!-- Page Header -->
<div class="page-header">
    <div>
        <h4>
            <i class="fas fa-money-bill-wave"></i>
            Fee Records
        </h4>
        <div class="sub-title">Manage student fee payments and track pending balances</div>
    </div>
    <a href="{{ route('fee-record.create') }}" class="btn-add">
        <i class="fas fa-plus-circle"></i> Add Fee Record
    </a>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stat-card total">
            <div class="stat-icon"><i class="fas fa-receipt"></i></div>
            <div class="stat-number">{{ $totalRecords ?? 0 }}</div>
            <div class="stat-label">Total Records</div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stat-card paid">
            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            <div class="stat-number">{{ $totalPaid ?? 0 }}</div>
            <div class="stat-label">Paid</div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stat-card unpaid">
            <div class="stat-icon"><i class="fas fa-times-circle"></i></div>
            <div class="stat-number">{{ $totalUnpaid ?? 0 }}</div>
            <div class="stat-label">Unpaid</div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stat-card partial">
            <div class="stat-icon"><i class="fas fa-clock"></i></div>
            <div class="stat-number">{{ $totalPartial ?? 0 }}</div>
            <div class="stat-label">Partial</div>
        </div>
    </div>
</div>

<!-- Search and Filter -->
<div class="filter-section">
    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" id="searchInput" placeholder="Search by student name, room or phone..." value="{{ request('search') }}">
    </div>
    <select id="statusFilter" class="filter-select">
        <option value="">All Status</option>
        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
        <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
        <option value="partial" {{ request('status') == 'partial' ? 'selected' : '' }}>Partial</option>
    </select>
</div>

<!-- Fee Records Table -->
<div class="modern-table">
    <table class="table table-hover" id="feeTable">
        <thead>
            <tr>
                <th style="width:50px;">#</th>
                <th>Student</th>
                <th style="width:80px;">Room</th>
                <th>Phone</th>
                <th style="width:110px;">Fee</th>
                <th style="width:110px;">Paid</th>
                <th style="width:110px;">Pending</th>
                <th style="width:100px;">Status</th>
                <th style="width:130px;" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($feeRecords ?? [] as $index => $record)
            <tr id="record-{{ $record->id }}" data-id="{{ $record->id }}">
                <td>
                    <span class="font-weight-bold" style="color: #0B2E33;">{{ $feeRecords->firstItem() + $index }}</span>
                </td>
                <td>
                    <div class="student-info">
                        <div class="student-avatar">
                            {{ substr($record->student_name, 0, 2) }}
                        </div>
                        <div>
                            <div class="student-name">{{ $record->student_name }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="room-badge">{{ $record->room_no }}</span>
                </td>
                <td>{{ $record->phone_number }}</td>
                <td class="amount-fee">PKR {{ number_format($record->fee_amount, 2) }}</td>
                <td class="amount-paid">PKR {{ number_format($record->paid_amount, 2) }}</td>
                <td class="amount-pending">PKR {{ number_format($record->pending_amount, 2) }}</td>
                <td>
                    <span class="status-badge status-{{ $record->fee_status }}">
                        @if($record->fee_status == 'paid')
                            <i class="fas fa-check-circle"></i>
                        @elseif($record->fee_status == 'unpaid')
                            <i class="fas fa-times-circle"></i>
                        @else
                            <i class="fas fa-clock"></i>
                        @endif
                        {{ ucfirst($record->fee_status) }}
                    </span>
                </td>
                <td class="text-center">
                    <div class="action-group">
                        <a href="{{ route('fee-record.show', $record->id) }}" class="action-btn view" title="View Details">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('fee-record.edit', $record->id) }}" class="action-btn edit" title="Edit Record">
                            <i class="fas fa-edit"></i>
                        </a>
                        <!-- Delete Form -->
                        <form action="{{ route('fee-record.destroy', $record->id) }}" method="POST" class="delete-form" onsubmit="return confirm('Are you sure you want to delete this record for {{ $record->student_name }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete" title="Delete Record">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9">
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h5>No Fee Records Found</h5>
                        <p>Start by adding your first fee record using the "Add Fee Record" button above.</p>
                        <a href="{{ route('fee-record.create') }}" class="btn-add" style="display:inline-flex;margin-top:15px;">
                            <i class="fas fa-plus"></i> Add First Record
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if(isset($feeRecords) && $feeRecords->count() > 0)
<div class="pagination-wrapper">
    {{ $feeRecords->links() }}
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

<!-- Footer Info -->
<div class="mt-3 text-muted text-center">
    <small>
        <i class="fas fa-info-circle"></i> 
        Showing {{ isset($feeRecords) ? $feeRecords->count() : 0 }} record(s) 
        | Last updated: {{ now()->format('d-m-Y H:i:s') }}
    </small>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    console.log('✅ Fee Record page loaded successfully');

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
        let url = '{{ route("fee-record.index") }}?';
        if (search) url += 'search=' + encodeURIComponent(search) + '&';
        if (status) url += 'status=' + encodeURIComponent(status);
        window.location.href = url;
    }

    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
});
</script>
@endpush