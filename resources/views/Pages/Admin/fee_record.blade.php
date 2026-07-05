@extends('Layout.admin')

@section('content')
<style>
    /* Font Awesome CDN */
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

    /* ===== STATISTICS CARDS ===== */
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
    
    .stat-card.total .stat-icon { color: #0B2E33; }
    .stat-card.paid .stat-icon { color: #28a745; }
    .stat-card.unpaid .stat-icon { color: #dc3545; }
    .stat-card.partial .stat-icon { color: #e8a317; }

    /* ===== PAGE HEADER ===== */
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
    .page-header .sub-title {
        color: #7a8a9e;
        font-size: 0.9rem;
        margin-top: 4px;
        font-weight: 400;
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
    .btn-add i {
        font-size: 1rem;
    }

    /* ===== FILTER SECTION ===== */
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

    /* ===== TABLE ===== */
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
    .modern-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* ===== STATUS BADGES ===== */
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

    /* ===== ROOM BADGE ===== */
    .room-badge {
        display: inline-block;
        padding: 4px 12px;
        background: #f1f3f5;
        border-radius: 6px;
        font-size: 0.82rem;
        color: #0B2E33;
        font-weight: 600;
    }

    /* ===== ACTION BUTTONS ===== */
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
    
    .action-btn.view:hover {
        border-color: #0B2E33;
        background: white;
    }
    .action-btn.view:hover i {
        color: #0B2E33 !important;
    }

    .action-btn.edit:hover {
        border-color: #f5576c;
        background: white;
    }
    .action-btn.edit:hover i {
        color: #f5576c !important;
    }

    .action-btn.delete:hover {
        border-color: #dc3545;
        background: white;
    }
    .action-btn.delete:hover i {
        color: #dc3545 !important;
    }

    /* ===== STUDENT AVATAR ===== */
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

    /* ===== AMOUNT FORMATTING ===== */
    .amount-fee { 
        font-weight: 600; 
        color: #0B2E33; 
    }
    .amount-paid { 
        font-weight: 600; 
        color: #28a745; 
    }
    .amount-pending { 
        font-weight: 600; 
        color: #dc3545; 
    }

    /* ===== EMPTY STATE ===== */
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

    /* ===== PAGINATION ===== */
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

    /* ===== MODAL ===== */
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
    .modal .close {
        font-size: 1.5rem;
        font-weight: 400;
        color: #6c757d;
        opacity: 0.7;
        transition: all 0.2s ease;
    }
    .modal .close:hover {
        opacity: 1;
        transform: rotate(90deg);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .page-header {
            padding: 18px 20px;
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
            padding: 14px 16px;
        }
        .filter-select {
            width: 100%;
        }
        .stat-card .stat-number {
            font-size: 1.6rem;
        }
        .action-btn {
            width: 30px;
            height: 30px;
        }
        .action-btn i {
            font-size: 0.8rem;
        }
        .modern-table {
            overflow-x: auto;
        }
        .modern-table table {
            min-width: 700px;
        }
    }
    @media (max-width: 576px) {
        .stat-card {
            padding: 16px 18px;
        }
        .stat-card .stat-icon {
            font-size: 2.2rem;
        }
        .action-btn {
            width: 28px;
            height: 28px;
        }
        .action-group {
            gap: 4px;
        }
        .pagination-wrapper .pagination {
            justify-content: center;
        }
    }
</style>

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
        <input type="text" id="searchInput" placeholder="Search by student name, room or phone...">
    </div>
    <select id="statusFilter" class="filter-select">
        <option value="">All Status</option>
        <option value="paid">Paid</option>
        <option value="unpaid">Unpaid</option>
        <option value="partial">Partial</option>
    </select>
</div>

<!-- Fee Records Table -->
<div class="modern-table">
    <table class="table table-hover">
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
            <tr>
                <td>
                    <span class="font-weight-bold" style="color: #0B2E33;">{{ $index + 1 }}</span>
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
                        <button class="action-btn delete delete-btn" data-id="{{ $record->id }}" title="Delete Record">
                            <i class="fas fa-trash"></i>
                        </button>
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

<!-- Footer Info -->
<div class="mt-3 text-muted text-center">
    <small>
        <i class="fas fa-info-circle"></i> 
        Showing {{ isset($feeRecords) ? $feeRecords->count() : 0 }} record(s) 
        | Last updated: {{ now()->format('d-m-Y H:i:s') }}
    </small>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-exclamation-triangle" style="font-size:3rem;color:#dc3545;margin-bottom:15px;"></i>
                <p class="mb-0" style="font-weight:600;">Are you sure you want to delete this fee record?</p>
                <small class="text-muted">This action cannot be undone.</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete Record</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();

        let deleteId = null;

        // Delete button click
        $(document).on('click', '.delete-btn', function() {
            deleteId = $(this).data('id');
            $('#deleteModal').modal('show');
        });

        // Confirm delete
        $('#confirmDelete').on('click', function() {
            if (deleteId) {
                $.ajax({
                    url: '/fee-records/' + deleteId,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#deleteModal').modal('hide');
                            location.reload();
                        }
                    },
                    error: function() {
                        alert('Failed to delete record');
                    }
                });
            }
        });

        // Search with delay
        let searchTimeout;
        $('#searchInput').on('keyup', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                performSearch();
            }, 500);
        });

        // Status filter
        $('#statusFilter').on('change', function() {
            performSearch();
        });

        function performSearch() {
            const search = $('#searchInput').val();
            const status = $('#statusFilter').val();
            window.location.href = '{{ route("fee_record") }}?search=' + encodeURIComponent(search) + '&status=' + encodeURIComponent(status);
        }
    });
</script>
@endpush