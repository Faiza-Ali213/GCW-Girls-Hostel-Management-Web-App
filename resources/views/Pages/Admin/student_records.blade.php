@extends('Layout.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/student_records.css') }}">

<div class="student-container">
    
    <div class="page-header-section">
        <h2>Student Records</h2>
        <p class="text-muted">Database of all residents currently staying in GCW Hostel.</p>
    </div>

    <!-- Simple Search Bar Only -->
    <div class="action-row">
        <div class="search-container">
            <i class="bi bi-search"></i>
            <form action="{{ route('student-records') }}" method="GET" style="width: 100%;">
                <input type="text" name="search" class="custom-search shadow-sm" 
                       placeholder="Search by name, father name, or CNIC..." 
                       value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-primary ms-2">
                    <i class="bi bi-search"></i> Search
                </button>
                @if(request('search'))
                    <a href="{{ route('student_records') }}" class="btn btn-sm btn-secondary ms-1">
                        <i class="bi bi-x-circle"></i> Clear
                    </a>
                @endif
            </form>
        </div>
        
        <a href="{{ route('student.create') }}" class="btn-add-student shadow-sm">
            <i class="bi bi-person-plus"></i> Add Student Record
        </a>
    </div>

    <!-- Data Table -->
    <div class="data-table-card">
        <div class="table-responsive">
            <table class="table student-table align-middle">
                <thead>
                    <tr>
                        <th width="70px">#</th>
                        <th>Student Name</th>
                        <th>Father Name</th>
                        <th>Phone</th>
                        <th>CNIC</th>
                        <th>Room</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
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
                                    <div class="avatar-circle me-2">
                                        {{ substr($student->student_name, 0, 2) }}
                                    </div>
                                @endif
                                <span class="fw-bold text-dark">{{ $student->student_name }}</span>
                            </div>
                        </td>
                        <td>{{ $student->father_name }}</td>
                        <td>{{ $student->phone_number }}</td>
                        <td>{{ $student->cnic_number }}</td>
                        <td>
                            @if($student->room_number)
                                <span class="badge bg-info">Room {{ $student->room_number }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="status-badge status-{{ $student->hostel_status }}">
                                {{ ucfirst($student->hostel_status) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn-action-dots" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2">
                                    <li>
                                        <a class="dropdown-item rounded" href="{{ route('student.show', $student->id) }}">
                                            <i class="bi bi-eye me-2 text-info"></i> View Details
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item rounded" href="{{ route('student.edit', $student->id) }}">
                                            <i class="bi bi-pencil me-2 text-primary"></i> Edit
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('student.destroy', $student->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item rounded text-danger" 
                                                    onclick="return confirm('Are you sure you want to delete this record?')">
                                                <i class="bi bi-trash me-2"></i> Delete Record
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <h5>No Students Found</h5>
                                <p>Start by adding your first student record.</p>
                                <a href="{{ route('student.create') }}" class="btn btn-primary btn-sm mt-3">
                                    <i class="bi bi-person-plus"></i> Add First Student
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
    }
    .page-header-section .text-muted {
        font-size: 0.95rem;
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
        min-width: 300px;
        display: flex;
        align-items: center;
        background: white;
        border-radius: 10px;
        padding: 5px 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        position: relative;
    }
    .search-container i {
        color: #6c757d;
        margin-right: 10px;
        font-size: 1.1rem;
    }
    .search-container form {
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
    }
    .custom-search::placeholder {
        color: #adb5bd;
    }

    .btn-add-student {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        gap: 8px;
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
        padding: 15px 20px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: #495057;
    }
    .student-table tbody td {
        padding: 12px 20px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f5;
    }
    .student-table tbody tr:last-child td {
        border-bottom: none;
    }
    .student-table tbody tr:hover {
        background: #f8f9fa;
    }

    /* Avatar */
    .avatar-circle {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.8rem;
        flex-shrink: 0;
    }

    /* Status Badges */
    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .status-active { background: #d4edda; color: #155724; }
    .status-inactive { background: #fff3cd; color: #856404; }
    .status-graduated { background: #d1ecf1; color: #0c5460; }
    .status-left { background: #f8d7da; color: #721c24; }

    /* Action Button */
    .btn-action-dots {
        background: none;
        border: none;
        padding: 5px 10px;
        border-radius: 8px;
        transition: all 0.2s ease;
        font-size: 1.2rem;
        color: #6c757d;
    }
    .btn-action-dots:hover {
        background: #f1f3f5;
        color: #2c3e50;
    }
    .dropdown-item {
        padding: 8px 12px;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }
    .dropdown-item:hover {
        background: #f8f9fa;
    }

    /* Pagination */
    .pagination-container {
        padding: 15px 20px;
        border-top: 1px solid #e9ecef;
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

    /* Responsive */
    @media (max-width: 768px) {
        .action-row {
            flex-direction: column;
            align-items: stretch;
        }
        .search-container {
            min-width: auto;
        }
        .btn-add-student {
            justify-content: center;
        }
    }
</style>

@endsection