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
    .stat-card.pending { border-top-color: #F59E0B; }
    .stat-card.pending .stat-icon { color: #F59E0B; }
    .stat-card.in-progress { border-top-color: #0EA5E9; }
    .stat-card.in-progress .stat-icon { color: #0EA5E9; }
    .stat-card.resolved { border-top-color: #10B981; }
    .stat-card.resolved .stat-icon { color: #10B981; }
    .stat-card.total { border-top-color: #4F46E5; }
    .stat-card.total .stat-icon { color: #4F46E5; }

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
    .priority-high { background: #FEF2F2; color: #EF4444; }
    .priority-medium { background: #FFFBEB; color: #F59E0B; }
    .priority-low { background: #ECFDF5; color: #10B981; }

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
    .status-pending { background: #FFFBEB; color: #F59E0B; }
    .status-in_progress { background: #E0F2FE; color: #0EA5E9; }
    .status-resolved { background: #ECFDF5; color: #10B981; }
    .status-rejected { background: #FEF2F2; color: #EF4444; }

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
    .complaint-by-student { background: #ECFDF5; color: #10B981; }
    .complaint-by-user { background: #E0F2FE; color: #0EA5E9; }

    /* Status Dropdown in Table */
    .status-selector {
        padding: 4px 8px;
        border-radius: 6px;
        border: 2px solid #e2e8f0;
        font-weight: 600;
        font-size: 0.75rem;
        background: #ffffff;
        color: #0f172a;
        cursor: pointer;
        transition: all 0.2s ease;
        min-width: 120px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .status-selector:focus {
        border-color: #1a2a4a;
        outline: none;
        box-shadow: 0 0 0 3px rgba(26, 42, 74, 0.1);
    }
    .status-selector option.pending { color: #F59E0B; }
    .status-selector option.in_progress { color: #0EA5E9; }
    .status-selector option.resolved { color: #10B981; }
    .status-selector option.rejected { color: #EF4444; }

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
    .action-btn.view { background: #EEF2FF; color: #4F46E5; }
    .action-btn.view:hover { background: #4F46E5; color: white; }

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
    .page-header h4 i { color: #4F46E5; }

    .page-header .header-actions {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    /* Save Button */
    .btn-save-status {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: #ffffff !important;
        border: none;
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.25);
        text-decoration: none;
    }
    .btn-save-status:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.35);
        color: #ffffff !important;
    }
    .btn-save-status:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none !important;
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
    .alert-success { background: #ECFDF5; color: #065F46; border-left: 4px solid #10B981; }
    .alert-danger { background: #FEF2F2; color: #991B1B; border-left: 4px solid #EF4444; }
    .alert i { font-size: 1.2rem; }
    .alert .close { margin-left: auto; color: inherit; opacity: 0.5; }
    .alert .close:hover { opacity: 1; }

    /* Footer Info */
    .footer-info {
        text-align: center;
        color: #94a3b8;
        font-size: 0.8rem;
        margin-top: 15px;
    }

    /* Status Selector Container - Fix Alignment */
    .status-selector-wrapper {
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }
    .status-selector-wrapper select {
        width: 100%;
        max-width: 140px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .stat-card .stat-number { font-size: 1.5rem; }
        .page-header { flex-direction: column; align-items: flex-start; gap: 15px; }
        .page-header .header-actions { width: 100%; }
        .btn-save-status { width: 100%; justify-content: center; }
        .modern-table { overflow-x: auto; }
        .modern-table table { min-width: 900px; }
        .action-btn { padding: 4px 10px; font-size: 0.7rem; }
        .status-selector { min-width: 100px; font-size: 0.65rem; }
    }

    @media (max-width: 576px) {
        .stat-card { padding: 16px 18px; }
        .stat-card .stat-number { font-size: 1.3rem; }
        .stat-card .stat-icon { font-size: 2rem; }
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
    <div class="header-actions">
        <button type="button" class="btn-save-status" id="saveAllStatusBtn">
            <i class="fas fa-save"></i> Save Status Changes
        </button>
    </div>
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
    <table class="table table-hover" id="complaintsTable">
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
            <tr id="complaint-row-{{ $complaint->id }}">
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
                    <div class="status-selector-wrapper">
                        <select class="status-selector status-select" data-id="{{ $complaint->id }}" data-current="{{ $complaint->status }}" data-original="{{ $complaint->status }}">
                            <option value="pending" class="pending" {{ $complaint->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                            <option value="in_progress" class="in_progress" {{ $complaint->status == 'in_progress' ? 'selected' : '' }}>🔄 In Progress</option>
                            <option value="resolved" class="resolved" {{ $complaint->status == 'resolved' ? 'selected' : '' }}>✅ Resolved</option>
                            <option value="rejected" class="rejected" {{ $complaint->status == 'rejected' ? 'selected' : '' }}>❌ Rejected</option>
                        </select>
                    </div>
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

    var changedStatuses = {};

    // ============================================
    // TRACK STATUS CHANGES
    // ============================================
    $('.status-select').on('change', function() {
        var select = $(this);
        var complaintId = select.data('id');
        var newStatus = select.val();
        var originalStatus = select.data('original');
        
        if (newStatus !== originalStatus) {
            // Store the changed status
            changedStatuses[complaintId] = newStatus;
            
            // Add visual indicator (highlight row)
            var row = $('#complaint-row-' + complaintId);
            row.css('background-color', '#fffbeb');
            row.css('border-left', '3px solid #F59E0B');
            
            // Update the badge temporarily
            updateStatusBadge(row, newStatus);
            
            // Enable save button
            $('#saveAllStatusBtn').prop('disabled', false);
            $('#saveAllStatusBtn').html('<i class="fas fa-save"></i> Save Changes (' + Object.keys(changedStatuses).length + ')');
        } else {
            // Remove from changed statuses
            delete changedStatuses[complaintId];
            
            var row = $('#complaint-row-' + complaintId);
            row.css('background-color', '');
            row.css('border-left', '');
            
            // Revert the badge
            updateStatusBadge(row, originalStatus);
            
            if (Object.keys(changedStatuses).length === 0) {
                $('#saveAllStatusBtn').prop('disabled', true);
                $('#saveAllStatusBtn').html('<i class="fas fa-save"></i> Save Status Changes');
            } else {
                $('#saveAllStatusBtn').html('<i class="fas fa-save"></i> Save Changes (' + Object.keys(changedStatuses).length + ')');
            }
        }
    });

    // ============================================
    // SAVE ALL STATUS CHANGES
    // ============================================
    $('#saveAllStatusBtn').on('click', function() {
        var btn = $(this);
        var changes = Object.keys(changedStatuses);
        
        if (changes.length === 0) {
            showToast('info', 'No changes to save');
            return;
        }

        // Disable button and show loading
        btn.prop('disabled', true);
        btn.html('<i class="fas fa-spinner fa-spin"></i> Saving...');

        var completed = 0;
        var total = changes.length;
        var errors = [];

        // Process each change
        changes.forEach(function(complaintId) {
            var newStatus = changedStatuses[complaintId];
            var select = $('#complaint-row-' + complaintId).find('.status-select');
            var oldStatus = select.data('original');

            // Get CSRF token
            var token = $('meta[name="csrf-token"]').attr('content');
            if (!token) {
                token = '{{ csrf_token() }}';
            }

            // Build URL
            var updateUrl = '{{ route("complaints.update", ":id") }}';
            updateUrl = updateUrl.replace(':id', complaintId);

            // Send AJAX request
            $.ajax({
                url: updateUrl,
                method: 'POST',
                data: {
                    _token: token,
                    _method: 'PUT',
                    status: newStatus,
                    admin_remark: 'Status updated from ' + oldStatus + ' to ' + newStatus
                },
                dataType: 'json',
                success: function(response) {
                    completed++;
                    
                    if (response.success) {
                        // Update the original status on the select
                        select.data('original', newStatus);
                        select.data('current', newStatus);
                        
                        // Remove from changed statuses
                        delete changedStatuses[complaintId];
                        
                        // Update row styling
                        var row = $('#complaint-row-' + complaintId);
                        row.css('background-color', '#ecfdf5');
                        row.css('border-left', '3px solid #10B981');
                        
                        setTimeout(function() {
                            row.css('background-color', '');
                            row.css('border-left', '');
                        }, 2000);
                        
                        // Update statistics
                        updateStatistics(oldStatus, newStatus);
                    } else {
                        errors.push('#' + complaintId + ': ' + (response.message || 'Unknown error'));
                    }
                    
                    // Check if all done
                    if (completed === total) {
                        finalizeSave(btn, errors);
                    }
                },
                error: function(xhr) {
                    completed++;
                    errors.push('#' + complaintId + ': Server error');
                    
                    if (completed === total) {
                        finalizeSave(btn, errors);
                    }
                }
            });
        });
    });

    function finalizeSave(btn, errors) {
        var successCount = Object.keys(changedStatuses).length === 0 ? 
            Object.keys($('.status-select')).length : 0;
        
        if (errors.length === 0) {
            showToast('success', '✅ All status changes saved successfully!');
            btn.html('<i class="fas fa-save"></i> Save Status Changes');
            btn.prop('disabled', true);
        } else {
            var errorMsg = '⚠️ Some changes failed: ' + errors.join(', ');
            showToast('error', errorMsg);
            btn.html('<i class="fas fa-save"></i> Save Changes (' + Object.keys(changedStatuses).length + ')');
            btn.prop('disabled', false);
        }
        
        // Update save button text
        if (Object.keys(changedStatuses).length === 0) {
            btn.html('<i class="fas fa-save"></i> Save Status Changes');
            btn.prop('disabled', true);
        } else {
            btn.html('<i class="fas fa-save"></i> Save Changes (' + Object.keys(changedStatuses).length + ')');
            btn.prop('disabled', false);
        }
    }

    // ============================================
    // UPDATE STATUS BADGE
    // ============================================
    function updateStatusBadge(row, status) {
        var statusCell = row.find('td:eq(5)'); // Status column index
        var icon = '';
        var label = status.replace('_', ' ');
        
        switch(status) {
            case 'pending':
                icon = '<i class="fas fa-clock"></i>';
                break;
            case 'in_progress':
                icon = '<i class="fas fa-spinner fa-spin"></i>';
                break;
            case 'resolved':
                icon = '<i class="fas fa-check"></i>';
                break;
            case 'rejected':
                icon = '<i class="fas fa-times"></i>';
                break;
            default:
                icon = '';
        }
        
        var badgeHtml = '<span class="status-badge status-' + status + '">' + icon + ' ' + label.charAt(0).toUpperCase() + label.slice(1) + '</span>';
        statusCell.html(badgeHtml);
    }

    // ============================================
    // UPDATE STATISTICS
    // ============================================
    function updateStatistics(oldStatus, newStatus) {
        var oldStatusClass = oldStatus.replace('_', '-');
        var newStatusClass = newStatus.replace('_', '-');
        
        // Decrement old status count
        var oldCard = $('.stat-card.' + oldStatusClass);
        if (oldCard.length) {
            var oldCount = parseInt(oldCard.find('.stat-number').text());
            if (oldCount > 0) {
                oldCard.find('.stat-number').text(oldCount - 1);
            }
        }
        
        // Increment new status count
        var newCard = $('.stat-card.' + newStatusClass);
        if (newCard.length) {
            var newCount = parseInt(newCard.find('.stat-number').text());
            newCard.find('.stat-number').text(newCount + 1);
        }
    }

    // ============================================
    // TOAST NOTIFICATION
    // ============================================
    function showToast(type, message) {
        var toastHtml = '<div class="alert alert-' + (type === 'success' ? 'success' : (type === 'info' ? 'info' : 'danger')) + ' alert-dismissible fade show" role="alert" style="position:fixed;top:20px;right:20px;z-index:9999;min-width:300px;box-shadow:0 4px 12px rgba(0,0,0,0.15);">';
        toastHtml += '<i class="fas fa-' + (type === 'success' ? 'check-circle' : (type === 'info' ? 'info-circle' : 'exclamation-circle')) + '"></i> ';
        toastHtml += message;
        toastHtml += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        toastHtml += '<span aria-hidden="true">&times;</span>';
        toastHtml += '</button>';
        toastHtml += '</div>';
        
        $('body').append(toastHtml);
        
        setTimeout(function() {
            $('.alert:last').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 4000);
    }
});
</script>
@endpush