@extends('Layout.admin')

@section('content')
<style>
    /* Font Awesome CDN - Add this to your layout if not already included */
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

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
    .stat-card.total { border-left-color: #0B2E33; }
    .stat-card.paid { border-left-color: #28a745; }
    .stat-card.unpaid { border-left-color: #dc3545; }
    .stat-card.partial { border-left-color: #ffc107; }
    .stat-card.total .stat-number { color: #0B2E33; }
    .stat-card.paid .stat-number { color: #28a745; }
    .stat-card.unpaid .stat-number { color: #dc3545; }
    .stat-card.partial .stat-number { color: #e8a317; }
    
    /* Statistic Card Icons Colors */
    .stat-card.total .stat-icon { color: #0B2E33; }
    .stat-card.paid .stat-icon { color: #28a745; }
    .stat-card.unpaid .stat-icon { color: #dc3545; }
    .stat-card.partial .stat-icon { color: #e8a317; }

    /* Modern Table */
    .modern-table {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        background: white;
    }
    .modern-table thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    .modern-table thead th {
        border: none;
        padding: 15px 20px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.8px;
        color: #FFFFFF !important;
        text-shadow: 0 1px 2px rgba(0,0,0,0.3);
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
        color: #2c3e50;
    }
    .modern-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Status Badges */
    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .status-badge i {
        font-size: 0.7rem;
    }
    .status-paid { background: #d4edda; color: #155724; }
    .status-unpaid { background: #f8d7da; color: #721c24; }
    .status-partial { background: #fff3cd; color: #856404; }

    /* Room Badge */
    .room-badge {
        display: inline-block;
        padding: 4px 12px;
        background: #f1f3f5;
        border-radius: 4px;
        font-size: 13px;
        color: #0B2E33;
        font-weight: 600;
    }

    /* Action Buttons - Now with proper visibility */
    .action-group {
        display: flex;
        gap: 8px;
        justify-content: center;
        align-items: center;
    }
    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
        background: transparent;
        border: 2px solid #e0e0e0;
        color: #333 !important;
        cursor: pointer;
    }
    .action-btn i {
        font-size: 16px;
        color: #333 !important;
        transition: all 0.3s ease;
    }
    .action-btn:hover {
        transform: translateY(-2px);
        text-decoration: none;
    }
    .action-btn:hover i {
        color: #667eea !important;
    }
    
    /* View Button */
    .action-btn.view {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.05);
    }
    .action-btn.view i {
        color: #667eea !important;
    }
    .action-btn.view:hover {
        background: rgba(102, 126, 234, 0.15);
        border-color: #764ba2;
        box-shadow: 0 0 20px rgba(102, 126, 234, 0.2);
    }
    .action-btn.view:hover i {
        color: #764ba2 !important;
    }

    /* Edit Button */
    .action-btn.edit {
        border-color: #f5576c;
        background: rgba(245, 87, 108, 0.05);
    }
    .action-btn.edit i {
        color: #f5576c !important;
    }
    .action-btn.edit:hover {
        background: rgba(245, 87, 108, 0.15);
        border-color: #f093fb;
        box-shadow: 0 0 20px rgba(245, 87, 108, 0.2);
    }
    .action-btn.edit:hover i {
        color: #f5576c !important;
    }

    /* Delete Button */
    .action-btn.delete {
        border-color: #dc3545;
        background: rgba(220, 53, 69, 0.05);
    }
    .action-btn.delete i {
        color: #dc3545 !important;
    }
    .action-btn.delete:hover {
        background: rgba(220, 53, 69, 0.15);
        border-color: #fa709a;
        box-shadow: 0 0 20px rgba(220, 53, 69, 0.2);
    }
    .action-btn.delete:hover i {
        color: #dc3545 !important;
    }

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
    .page-header .sub-title {
        color: #6c757d;
        font-size: 0.9rem;
        margin-top: 4px;
        font-weight: 400;
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
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        color: white;
        text-decoration: none;
    }
    .btn-add i {
        font-size: 1rem;
    }

    /* Search and Filter */
    .filter-section {
        background: white;
        border-radius: 12px;
        padding: 15px 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        display: flex;
        gap: 15px;
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
    }
    .search-box input {
        width: 100%;
        padding: 10px 16px 10px 44px;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }
    .search-box input:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    .filter-select {
        padding: 10px 16px;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        font-size: 14px;
        background: #f8f9fa;
        min-width: 150px;
        transition: all 0.3s ease;
    }
    .filter-select:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    /* Amount Formatting */
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

    /* Student Avatar */
    .student-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(102, 126, 234, 0.15);
        color: #667eea;
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

    /* Pagination */
    .pagination-wrapper {
        padding: 16px 20px;
        background: white;
        border-radius: 0 0 12px 12px;
        border-top: 1px solid #e9ecef;
    }
    .pagination-wrapper .pagination {
        margin: 0;
        justify-content: flex-end;
    }
    .pagination-wrapper .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-color: #667eea;
        color: white;
    }
    .pagination-wrapper .page-link {
        color: #667eea;
        border-radius: 8px;
        margin: 0 3px;
        border: none;
        padding: 8px 14px;
    }
    .pagination-wrapper .page-link:hover {
        background: #f1f3f5;
        color: #667eea;
    }

    /* Modal */
    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    }
    .modal-header {
        border-bottom: 10px solid #235b93;
        padding: 18px 24px;
        background: #f8f9fa;
        border-radius: 15px 15px 0 0;
    }
    .modal-title {
        font-size: 18px;
        font-weight: 700;
        color: #2c3e50 !important;
    }
    .modal-body {
        padding: 24px;
    }
    .modal-footer {
        border-top: 1px solid #e9ecef;
        padding: 15px 24px;
        background: #f8f9fa;
        border-radius: 0 0 15px 15px;
    }
    .modal .btn-danger {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border: none;
        border-radius: 10px;
        padding: 8px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: #495057;
    }
    .modal .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(245, 87, 108, 0.3);
        color: #fff;
    }
    .modal .btn-secondary {
        background: #f1f3f5;
        border: none;
        color: #495057;
        border-radius: 10px;
        padding: 8px 24px;
        font-weight: 600;
    }
    .modal .btn-secondary:hover {
        background: #e9ecef;
        color: #2c3e50;
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
            justify-content: center;
        }
        .filter-section {
            flex-direction: column;
            align-items: stretch;
        }
        .filter-select {
            width: 100%;
        }
        .action-btn {
            width: 32px;
            height: 32px;
            font-size: 14px;
        }
        .action-btn i {
            font-size: 14px;
        }
    }
    @media (max-width: 576px) {
        .action-btn {
            width: 28px;
            height: 28px;
            font-size: 12px;
        }
        .action-btn i {
            font-size: 12px;
        }
        .action-group {
            gap: 4px;
        }
        /* Make table scrollable on mobile */
        .modern-table {
            overflow-x: auto;
        }
        .modern-table table {
            min-width: 600px;
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
                    <span class="font-weight-bold">{{ $index + 1 }}</span>
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
                <p class="mb-0">Are you sure you want to delete this fee record?</p>
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