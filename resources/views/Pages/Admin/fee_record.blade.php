@extends('Layout.admin')

@section('content')
<style>
    /* ============================================ */
    /* FEE RECORDS - BLUE THEME */
    /* ============================================ */
    
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
        background: #10B981;
    }
    .toast-error {
        background: #EF4444;
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
    .status-badge i {
        font-size: 0.7rem;
    }
    .status-paid { 
        background: #ECFDF5; 
        color: #10B981; 
    }
    .status-unpaid { 
        background: #FEF2F2; 
        color: #EF4444; 
    }
    .status-partial { 
        background: #FFFBEB; 
        color: #F59E0B; 
    }

    .stat-card {
        background: white;
        border-radius: 14px;
        padding: 20px 24px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        transition: all 0.2s ease;
        border: 1px solid #f0f2f5;
        position: relative;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-3px);
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
    .stat-card.total .stat-icon { color: #4F46E5; }
    .stat-card.paid .stat-icon { color: #10B981; }
    .stat-card.unpaid .stat-icon { color: #EF4444; }
    .stat-card.partial .stat-icon { color: #F59E0B; }
    
    .stat-card.total { border-top: 3px solid #4F46E5; }
    .stat-card.paid { border-top: 3px solid #10B981; }
    .stat-card.unpaid { border-top: 3px solid #EF4444; }
    .stat-card.partial { border-top: 3px solid #F59E0B; }

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
        font-size: 0.9rem;
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

    .student-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #4F46E5 0%, #4338CA 100%);
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
        color: #0b1a33;
        font-size: 0.9rem;
    }

    .room-badge {
        display: inline-block;
        padding: 4px 14px;
        background: #EEF2FF;
        border-radius: 6px;
        font-size: 0.82rem;
        color: #4F46E5;
        font-weight: 600;
    }

    .amount-fee { font-weight: 600; color: #0b1a33; }
    .amount-paid { font-weight: 600; color: #10B981; }
    .amount-pending { font-weight: 600; color: #EF4444; }

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
    .empty-state .btn-add {
        display: inline-flex;
        margin-top: 15px;
    }

    .modal-content {
        border-radius: 16px;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }
    .modal-header {
        border-bottom: 1px solid #f1f3f5;
        padding: 16px 24px;
        background: #fafbfc;
        border-radius: 16px 16px 0 0;
    }
    .modal-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #0b1a33 !important;
    }
    .modal-body {
        padding: 24px;
    }
    .modal-footer {
        border-top: 1px solid #f1f3f5;
        padding: 14px 24px;
        background: #fafbfc;
        border-radius: 0 0 16px 16px;
    }
    .modal .btn-danger {
        background: #EF4444;
        border: none;
        border-radius: 8px;
        padding: 8px 24px;
        font-weight: 600;
        transition: all 0.2s ease;
        color: #fff;
        font-size: 0.9rem;
    }
    .modal .btn-danger:hover {
        background: #DC2626;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
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

    .delete-form {
        display: inline;
    }

    /* Alerts */
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

    /* Responsive */
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
                    <span class="font-weight-bold" style="color: #4F46E5;">{{ $feeRecords->firstItem() + $index }}</span>
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