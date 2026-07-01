@extends('Layout.admin')

@section('content')
<div class="student-container">
    
    <div class="page-header-section">
        <h2>Student Records</h2>
        <p class="text-muted">Database of all residents currently staying in GCW Hostel.</p>
    </div>

    <!-- Simple Search Bar Only -->
    <div class="action-row">
        <div class="search-container">
            <i class="bi bi-search"></i>
            <form action="{{ route('student-records') }}" method="GET" class="search-form">
                <input type="text" name="search" class="custom-search" 
                       placeholder="Search by name, father name, or CNIC..." 
                       value="{{ request('search') }}">
                <button type="submit" class="btn-search">
                    <i class="bi bi-search"></i> Search
                </button>
                @if(request('search'))
                    <a href="{{ route('student_records') }}" class="btn-clear">
                        <i class="bi bi-x-circle"></i> Clear
                    </a>
                @endif
            </form>
        </div>
        
        <a href="{{ route('student.create') }}" class="btn-add-student">
            <i class="bi bi-person-plus"></i> Add Student Record
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
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('student.edit', $student->id) }}" class="action-btn edit-btn" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('student.destroy', $student->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn" title="Delete" 
                                            onclick="return confirm('Are you sure you want to delete this record?')">
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
        font-size: 1.8rem;
    }
    .page-header-section .text-muted {
        font-size: 0.95rem;
        color: #6c757d;
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

    .search-container i {
        color: #adb5bd;
        margin-right: 10px;
        font-size: 1.1rem;
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

    /* Action Buttons - Fixed! */
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