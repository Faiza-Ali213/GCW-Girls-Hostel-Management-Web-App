@extends('Layout.admin')

@section('content')
<div class="student-container">
    
    <div class="page-header-section">
        <h2>Student Records</h2>
        <p class="text-muted">Database of all residents currently staying in GCW Hostel.</p>
    </div>

    <!-- Display Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px;">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" style="margin-right: 10px; vertical-align: middle;">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 10px;">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" style="margin-right: 10px; vertical-align: middle;">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
            </svg>
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Simple Search Bar Only -->
    <div class="action-row">
        <div class="search-container">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="#adb5bd" style="margin-right:10px;">
                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
            </svg>
            <form action="{{ route('student-records') }}" method="GET" class="search-form">
                <input type="text" name="search" class="custom-search" 
                       placeholder="Search by name, father name, or CNIC..." 
                       value="{{ request('search') }}">
                <button type="submit" class="btn-search">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="margin-right:4px;">
                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                    </svg>
                    Search
                </button>
                @if(request('search'))
                    <a href="{{ route('student-records') }}" class="btn-clear">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="margin-right:4px;">
                            <path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z"/>
                        </svg>
                        Clear
                    </a>
                @endif
            </form>
        </div>
        
        <a href="{{ route('student.create') }}" class="btn-add-student">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" style="margin-right:6px;">
                <path d="M15 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-9-2V7H4v3H1v2h3v3h2v-3h3v-2H6zm9 4c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
            Add Student Record
        </a>
    </div>

    <!-- Data Table -->
    <div class="data-table-card">
        <div class="table-responsive">
            <table class="table student-table align-middle">
                <thead>
                    <tr>
                        <th width="60px">#</th>
                        <th>Student Name</th>
                        <th>Father Name</th>
                        <th>Phone</th>
                        <th>CNIC</th>
                        <th>Room</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students ?? [] as $student)
                    <tr>
                        <td class="text-muted fw-bold">{{ ($students->currentPage() - 1) * $students->perPage() + $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($student->profile_picture)
                                    <img src="{{ asset('storage/' . $student->profile_picture) }}" 
                                         alt="{{ $student->student_name }}" 
                                         class="rounded-circle me-2" 
                                         width="35" height="35">
                                @else
                                    <div class="avatar-placeholder me-2">
                                        {{ substr($student->student_name, 0, 1) }}
                                    </div>
                                @endif
                                <span class="student-name">{{ $student->student_name }}</span>
                            </div>
                        </td>
                        <td>{{ $student->father_name }}</td>
                        <td>{{ $student->phone_number }}</td>
                        <td>{{ $student->cnic_number }}</td>
                        <td>
                            @if($student->room_number)
                                <span class="room-badge">Room {{ $student->room_number }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="status-badge status-{{ $student->hostel_status }}">
                                {{ ucfirst($student->hostel_status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="action-buttons">
                                <a href="{{ route('student.show', $student->id) }}" class="action-btn view-btn" title="View Details">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('student.edit', $student->id) }}" class="action-btn edit-btn" title="Edit">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                    </svg>
                                </a>
                                <!-- Delete Form with Enhanced Confirmation -->
                                <form action="{{ route('student.destroy', $student->id) }}" method="POST" class="delete-form" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="action-btn delete-btn delete-trigger" title="Delete" data-student-name="{{ $student->student_name }}" data-student-id="{{ $student->id }}">
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <svg viewBox="0 0 24 24" width="48" height="48" fill="#dee2e6" style="margin-bottom:15px;">
                                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zM7 10h10v2H7zm0 4h6v2H7z"/>
                                </svg>
                                <h5>No Students Found</h5>
                                <p>Start by adding your first student record.</p>
                                <a href="{{ route('student.create') }}" class="btn btn-primary btn-sm mt-3">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" style="margin-right:4px;">
                                        <path d="M15 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-9-2V7H4v3H1v2h3v3h2v-3h3v-2H6zm9 4c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                    Add First Student
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if(isset($students) && $students->hasPages())
            <div class="pagination-container">
                {{ $students->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>

<style>
    /* Page Header */
    .page-header-section {
        margin-bottom: 25px;
    }
    .page-header-section h2 {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 5px;
        font-size: 1.8rem;
    }
    .page-header-section .text-muted {
        font-size: 0.95rem;
        color: #6c757d;
    }

    /* Alerts */
    .alert {
        border: none;
        padding: 15px 20px;
        margin-bottom: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .alert-success {
        background: #d4edda;
        color: #155724;
        border-left: 4px solid #28a745;
    }
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border-left: 4px solid #dc3545;
    }
    .alert .close {
        color: inherit;
        opacity: 0.5;
    }
    .alert .close:hover {
        opacity: 1;
    }

    /* Search & Action Row */
    .action-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 20px;
    }

    .search-container {
        flex: 1;
        min-width: 350px;
        display: flex;
        align-items: center;
        background: white;
        border-radius: 12px;
        padding: 6px 15px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }
    .search-container:focus-within {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .search-form {
        display: flex;
        align-items: center;
        width: 100%;
        gap: 8px;
    }

    .custom-search {
        border: none;
        padding: 10px 0;
        flex: 1;
        outline: none;
        background: transparent;
        font-size: 0.95rem;
        color: #2c3e50;
    }
    .custom-search::placeholder {
        color: #adb5bd;
    }

    .btn-search {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 6px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .btn-search:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        color: white;
    }

    .btn-clear {
        background: #f1f3f5;
        color: #6c757d;
        border: none;
        padding: 6px 14px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        text-decoration: none;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .btn-clear:hover {
        background: #e9ecef;
        color: #495057;
    }

    .btn-add-student {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }
    .btn-add-student:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    /* Data Table */
    .data-table-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .student-table {
        margin-bottom: 0;
    }
    .student-table thead {
        background: #f8f9fa;
    }
    .student-table thead th {
        border: none;
        padding: 14px 18px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 0.5px;
        color: #495057;
    }
    .student-table tbody td {
        padding: 12px 18px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f5;
    }
    .student-table tbody tr:last-child td {
        border-bottom: none;
    }
    .student-table tbody tr:hover {
        background: #f8f9fa;
    }

    /* Avatar Placeholder */
    .avatar-placeholder {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.9rem;
        flex-shrink: 0;
        text-transform: uppercase;
    }

    .student-name {
        font-weight: 600;
        color: #2c3e50;
    }

    /* Room Badge */
    .room-badge {
        background: #e3f2fd;
        color: #1976d2;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Status Badges */
    .status-badge {
        padding: 5px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }
    .status-active { background: #d4edda; color: #155724; }
    .status-inactive { background: #fff3cd; color: #856404; }
    .status-graduated { background: #d1ecf1; color: #0c5460; }
    .status-left { background: #f8d7da; color: #721c24; }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        text-decoration: none;
        cursor: pointer;
        font-size: 0.9rem;
        background: transparent;
        color: inherit;
    }
    .action-btn svg {
        width: 16px;
        height: 16px;
        display: inline-block;
        vertical-align: middle;
    }
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .view-btn {
        background: #e3f2fd;
        color: #1976d2;
    }
    .view-btn:hover {
        background: #1976d2;
        color: white;
    }

    .edit-btn {
        background: #fff3e0;
        color: #f57c00;
    }
    .edit-btn:hover {
        background: #f57c00;
        color: white;
    }

    .delete-btn {
        background: #fbe9e7;
        color: #d32f2f;
        cursor: pointer;
        border: none;
    }
    .delete-btn:hover {
        background: #d32f2f;
        color: white;
    }

    /* Pagination */
    .pagination-container {
        padding: 15px 20px;
        border-top: 1px solid #e9ecef;
    }
    .pagination-container .pagination {
        margin-bottom: 0;
        justify-content: flex-end;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 50px 20px;
    }
    .empty-state svg {
        margin-bottom: 15px;
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
        .action-row {
            flex-direction: column;
            align-items: stretch;
        }
        .search-container {
            min-width: auto;
        }
        .search-form {
            flex-wrap: wrap;
        }
        .btn-search, .btn-clear {
            flex: 1;
            justify-content: center;
        }
        .btn-add-student {
            justify-content: center;
        }
        .action-buttons {
            flex-wrap: wrap;
        }
    }
</style>

@endsection

@push('scripts')
<script>
console.log('SweetAlert script loaded');

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded');
    
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            var closeButton = alert.querySelector('.close');
            if (closeButton) {
                closeButton.click();
            }
        });
    }, 5000);

    // SweetAlert2 Delete Confirmation
    var deleteButtons = document.querySelectorAll('.sweet-delete');
    console.log('Found ' + deleteButtons.length + ' delete buttons');
    
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            console.log('Delete button clicked');
            e.preventDefault();
            e.stopPropagation();
            
            // Get the form element
            var form = this.closest('.delete-form');
            console.log('Form found:', form);
            
            var studentName = form ? form.getAttribute('data-student-name') : 'this student';
            console.log('Student name:', studentName);
            
            // Show SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to delete '" + studentName + "'. This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                console.log('SweetAlert result:', result);
                if (result.isConfirmed) {
                    console.log('Form submitted');
                    form.submit();
                }
            });
        });
    });
});
</script>
@endpush
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            var closeButton = alert.querySelector('.close');
            if (closeButton) {
                closeButton.click();
            }
        });
    }, 5000);

    // Delete confirmation functionality
    document.querySelectorAll('.delete-trigger').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            var studentName = this.getAttribute('data-student-name');
            var studentId = this.getAttribute('data-student-id');
            var form = this.closest('.delete-form');
            
            // Show confirmation dialog
            if (confirm('Are you sure you want to delete "' + studentName + '"? This action cannot be undone!')) {
                form.submit();
            }
        });
    });
});
</script>
