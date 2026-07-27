@extends('Layout.admin')

@section('content')
<div class="student-container">
    
    <!-- Page Header -->
    <div class="page-header-section">
        <h2><i class="bi bi-people-fill me-2" style="color: #4F46E5;"></i>Student Records</h2>
        <p class="text-muted">Database of all residents currently staying in GCW Hostel.</p>
    </div>

    <!-- Display Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon bg-primary-soft">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-info">
                <h5>{{ $totalStudents ?? 0 }}</h5>
                <p>Total Students</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-success-soft">
                <i class="bi bi-person-check-fill"></i>
            </div>
            <div class="stat-info">
                <h5>{{ $activeStudents ?? 0 }}</h5>
                <p>Active Students</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-warning-soft">
                <i class="bi bi-door-open-fill"></i>
            </div>
            <div class="stat-info">
                <h5>{{ $totalRooms ?? 0 }}</h5>
                <p>Total Rooms</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-info-soft">
                <i class="bi bi-person-plus-fill"></i>
            </div>
            <div class="stat-info">
                <h5>{{ $recentStudents ?? 0 }}</h5>
                <p>New This Month</p>
            </div>
        </div>
    </div>

    <!-- Action Row -->
    <div class="action-row">
        <div class="search-container">
            <i class="bi bi-search search-icon"></i>
            <form action="{{ route('student-records') }}" method="GET" class="search-form">
                <input type="text" name="search" class="custom-search" 
                       placeholder="Search by name, father name, or CNIC..." 
                       value="{{ request('search') }}">
                <button type="submit" class="btn-search">
                    <i class="bi bi-search"></i> Search
                </button>
                @if(request('search'))
                    <a href="{{ route('student-records') }}" class="btn-clear">
                        <i class="bi bi-x-circle"></i> Clear
                    </a>
                @endif
            </form>
        </div>
        
        <a href="{{ route('student.create') }}" class="btn-add-student">
            <i class="bi bi-plus-circle"></i> Add Student Record
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
                                <span class="room-badge">{{ $student->room_number }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="status-badge status-{{ $student->hostel_status ?? 'active' }}">
                                {{ ucfirst($student->hostel_status ?? 'Active') }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="action-buttons">
                                <a href="{{ route('student.show', $student->id) }}" class="action-btn view-btn" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('student.edit', $student->id) }}" class="action-btn edit-btn" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('student.destroy', $student->id) }}" method="POST" class="delete-form" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="action-btn delete-btn delete-trigger" title="Delete" data-student-name="{{ $student->student_name }}" data-student-id="{{ $student->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <i class="bi bi-inbox-empty"></i>
                                <h5>No Students Found</h5>
                                <p>Start by adding your first student record.</p>
                                <a href="{{ route('student.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> Add First Student
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
            <div class="pagination-wrapper">
                {{ $students->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>

<style>
/* ============================================ */
/* STUDENT RECORDS - BLUE THEME */
/* ============================================ */

.student-container {
    padding: 20px 0;
}

/* Page Header */
.page-header-section {
    margin-bottom: 25px;
}

.page-header-section h2 {
    font-weight: 700;
    color: #0b1a33;
    font-size: 1.8rem;
    margin-bottom: 5px;
}

.page-header-section h2 i {
    color: #4F46E5;
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
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    display: flex;
    align-items: center;
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

.alert .btn-close {
    margin-left: auto;
}

/* Stats Cards */
.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 18px;
    margin-bottom: 25px;
}

.stat-card {
    background: white;
    padding: 18px 22px;
    border-radius: 14px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    display: flex;
    align-items: center;
    gap: 16px;
    border: 1px solid #f0f2f5;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.3rem;
    flex-shrink: 0;
}

.bg-primary-soft {
    background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
    color: #4F46E5;
}

.bg-success-soft {
    background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
    color: #10B981;
}

.bg-warning-soft {
    background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
    color: #F59E0B;
}

.bg-info-soft {
    background: linear-gradient(135deg, #E0F2FE 0%, #BAE6FD 100%);
    color: #0EA5E9;
}

.stat-info h5 {
    margin: 0;
    font-weight: 700;
    font-size: 1.4rem;
    color: #0b1a33;
}

.stat-info p {
    margin: 0;
    color: #94a3b8;
    font-size: 0.85rem;
    font-weight: 500;
}

/* Action Row */
.action-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 25px;
}

.search-container {
    flex: 1;
    min-width: 300px;
    display: flex;
    align-items: center;
    background: white;
    border-radius: 12px;
    padding: 0 15px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}

.search-container:focus-within {
    border-color: #4F46E5;
    box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.08);
}

.search-icon {
    color: #94a3b8;
    font-size: 1.1rem;
    margin-right: 10px;
}

.search-form {
    display: flex;
    align-items: center;
    width: 100%;
    gap: 8px;
}

.custom-search {
    border: none;
    padding: 12px 0;
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
    background: linear-gradient(135deg, #4F46E5 0%, #4338CA 100%);
    color: white;
    border: none;
    padding: 6px 18px;
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
    box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
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
    background: linear-gradient(135deg, #4F46E5 0%, #4338CA 100%);
    color: white;
    border: none;
    padding: 11px 28px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    text-decoration: none;
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 15px rgba(79, 70, 229, 0.25);
}

.btn-add-student:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(79, 70, 229, 0.35);
    color: white;
}

/* Data Table */
.data-table-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    overflow: hidden;
    border: 1px solid #f0f2f5;
}

.student-table {
    margin-bottom: 0;
}

.student-table thead {
    background: #f8fafc;
}

.student-table thead th {
    border: none;
    padding: 14px 20px;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.7rem;
    letter-spacing: 0.5px;
    color: #64748b;
    border-bottom: 2px solid #eef2f6;
}

.student-table tbody td {
    padding: 14px 20px;
    vertical-align: middle;
    border-bottom: 1px solid #f1f3f5;
}

.student-table tbody tr:last-child td {
    border-bottom: none;
}

.student-table tbody tr:hover {
    background: #f8faff;
}

/* Avatar Placeholder */
.avatar-placeholder {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4F46E5 0%, #4338CA 100%);
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
    color: #0b1a33;
}

/* Room Badge */
.room-badge {
    background: #EEF2FF;
    color: #4F46E5;
    padding: 4px 14px;
    border-radius: 20px;
    font-size: 0.85rem;
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

.status-active {
    background: #ECFDF5;
    color: #10B981;
}

.status-inactive {
    background: #FEF3C7;
    color: #F59E0B;
}

.status-graduated {
    background: #EEF2FF;
    color: #4F46E5;
}

.status-left {
    background: #FEF2F2;
    color: #EF4444;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
}

.action-btn {
    width: 34px;
    height: 34px;
    border-radius: 8px;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    text-decoration: none;
    cursor: pointer;
    font-size: 0.95rem;
    background: transparent;
    color: inherit;
}

.action-btn i {
    font-size: 1rem;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.view-btn {
    background: #EEF2FF;
    color: #4F46E5;
}

.view-btn:hover {
    background: #4F46E5;
    color: white;
}

.edit-btn {
    background: #FFFBEB;
    color: #F59E0B;
}

.edit-btn:hover {
    background: #F59E0B;
    color: white;
}

.delete-btn {
    background: #FEF2F2;
    color: #EF4444;
    cursor: pointer;
    border: none;
}

.delete-btn:hover {
    background: #EF4444;
    color: white;
}

/* Pagination */
.pagination-wrapper {
    padding: 15px 20px;
    border-top: 1px solid #f1f3f5;
    display: flex;
    justify-content: flex-end;
}

.pagination-wrapper .pagination {
    margin: 0;
}

.pagination-wrapper .page-link {
    border: none;
    color: #64748b;
    font-weight: 500;
    padding: 0.4rem 0.9rem;
    border-radius: 8px;
    margin: 0 2px;
    transition: all 0.2s ease;
}

.pagination-wrapper .page-link:hover {
    background: #EEF2FF;
    color: #4F46E5;
}

.pagination-wrapper .page-item.active .page-link {
    background: #4F46E5;
    color: white;
    border-radius: 8px;
}

.pagination-wrapper .page-item.disabled .page-link {
    color: #cbd5e1;
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

.empty-state .btn-primary {
    background: linear-gradient(135deg, #4F46E5, #4338CA);
    border: none;
    padding: 10px 25px;
    border-radius: 10px;
    font-weight: 600;
}

.empty-state .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(79, 70, 229, 0.3);
    color: white;
}

/* Responsive */
@media (max-width: 992px) {
    .stats-row {
        grid-template-columns: repeat(2, 1fr);
    }
}

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
    
    .stats-row {
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }
    
    .stat-card {
        padding: 14px 16px;
    }
    
    .stat-icon {
        width: 42px;
        height: 42px;
        font-size: 1.1rem;
    }
    
    .stat-info h5 {
        font-size: 1.2rem;
    }
    
    .student-table thead th,
    .student-table tbody td {
        padding: 10px 12px;
        font-size: 0.85rem;
    }
    
    .action-buttons {
        flex-wrap: wrap;
    }
}

@media (max-width: 576px) {
    .student-container {
        padding: 10px 0;
    }
    
    .stats-row {
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }
    
    .stat-card {
        padding: 12px 14px;
        flex-direction: column;
        text-align: center;
    }
    
    .stat-icon {
        width: 38px;
        height: 38px;
        font-size: 1rem;
    }
    
    .stat-info h5 {
        font-size: 1rem;
    }
    
    .stat-info p {
        font-size: 0.75rem;
    }
    
    .page-header-section h2 {
        font-size: 1.4rem;
    }
    
    .custom-search {
        font-size: 0.85rem;
        padding: 10px 0;
    }
    
    .btn-add-student {
        font-size: 0.85rem;
        padding: 9px 18px;
    }
}
</style>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            var closeButton = alert.querySelector('.btn-close');
            if (closeButton) {
                closeButton.click();
            }
        });
    }, 5000);

    // Delete confirmation with SweetAlert
    document.querySelectorAll('.delete-trigger').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            var studentName = this.getAttribute('data-student-name');
            var form = this.closest('.delete-form');
            
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
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endpush