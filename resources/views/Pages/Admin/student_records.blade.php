@extends('Layout.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/student_records.css') }}">

<div class="student-container">
    
    <div class="page-header-section">
        <h2>Student Records</h2>
        <p class="text-muted">Database of all residents currently staying in GCW Hostel.</p>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card total-students">
                <div class="stat-icon"><i class="bi bi-people"></i></div>
                <div class="stat-number">{{ $totalStudents ?? 0 }}</div>
                <div class="stat-label">Total Students</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card active-students">
                <div class="stat-icon"><i class="bi bi-person-check"></i></div>
                <div class="stat-number">{{ $activeStudents ?? 0 }}</div>
                <div class="stat-label">Active Students</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card total-rooms">
                <div class="stat-icon"><i class="bi bi-door-open"></i></div>
                <div class="stat-number">{{ $totalRooms ?? 0 }}</div>
                <div class="stat-label">Occupied Rooms</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card total-rooms">
                <div class="stat-icon"><i class="bi bi-building"></i></div>
                <div class="stat-number">{{ ($totalStudents ?? 0) - ($activeStudents ?? 0) }}</div>
                <div class="stat-label">Inactive Students</div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Row -->
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
            </form>
        </div>
        
        <div class="d-flex gap-2">
            <a href="{{ route('student.create') }}" class="btn-add-student shadow-sm">
                <i class="bi bi-person-plus"></i> Add Student Record
            </a>
            <a href="{{ route('student.export') }}" class="btn btn-outline-success shadow-sm">
                <i class="bi bi-download"></i> Export
            </a>
        </div>
    </div>

    <!-- Filter by Status -->
    <div class="filter-row mb-3">
        <span class="filter-label">Filter by Status:</span>
        <a href="{{ route('student-records') }}" class="filter-badge {{ !request('status') ? 'active' : '' }}">All</a>
        <a href="{{ route('student-records', ['status' => 'active']) }}" class="filter-badge {{ request('status') == 'active' ? 'active' : '' }}">Active</a>
        <a href="{{ route('student-records', ['status' => 'inactive']) }}" class="filter-badge {{ request('status') == 'inactive' ? 'active' : '' }}">Inactive</a>
        <a href="{{ route('student-records', ['status' => 'graduated']) }}" class="filter-badge {{ request('status') == 'graduated' ? 'active' : '' }}">Graduated</a>
        <a href="{{ route('student-records', ['status' => 'left']) }}" class="filter-badge {{ request('status') == 'left' ? 'active' : '' }}">Left</a>
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
                                         width="40" height="40">
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
                                <span class="text-muted">Not Assigned</span>
                            @endif
                        </td>
                        <td>
                            <span class="{{ $student->status_badge_class }}">
                                {{ $student->status_label }}
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
    /* Statistics Cards */
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
    }
    .stat-card.total-students { border-left-color: #667eea; }
    .stat-card.active-students { border-left-color: #28a745; }
    .stat-card.total-rooms { border-left-color: #17a2b8; }

    .avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.9rem;
    }

    .filter-row {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        align-items: center;
        padding: 10px 0;
    }
    .filter-label {
        font-weight: 600;
        color: #495057;
        margin-right: 10px;
        font-size: 0.9rem;
    }
    .filter-badge {
        padding: 5px 15px;
        border-radius: 20px;
        background: #e9ecef;
        color: #495057;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    .filter-badge:hover {
        background: #dee2e6;
        color: #212529;
    }
    .filter-badge.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .pagination-container {
        padding: 15px 20px;
        border-top: 1px solid #e9ecef;
    }

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
</style>

@endsection