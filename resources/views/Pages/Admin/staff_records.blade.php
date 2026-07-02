@extends('Layout.admin')

@section('content')
<div class="staff-container">
    
    <div class="page-header-section">
        <h2>Staff Management</h2>
        <p class="text-muted">Overview of hostel employees and their duties.</p>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="stat-card total-staff">
                <div class="stat-icon"><i class="bi bi-people"></i></div>
                <div class="stat-number">{{ $totalStaff ?? 0 }}</div>
                <div class="stat-label">Total Staff</div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="stat-card active-staff">
                <div class="stat-icon"><i class="bi bi-person-check"></i></div>
                <div class="stat-number">{{ $activeStaff ?? 0 }}</div>
                <div class="stat-label">Active Staff</div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="stat-card inactive-staff">
                <div class="stat-icon"><i class="bi bi-person-x"></i></div>
                <div class="stat-number">{{ $inactiveStaff ?? 0 }}</div>
                <div class="stat-label">Inactive Staff</div>
            </div>
        </div>
    </div>

    <!-- Search & Action Row -->
    <div class="action-row">
        <div class="search-container">
            <i class="bi bi-search"></i>
            <form action="{{ route('staff_records') }}" method="GET" class="search-form">
                <input type="text" name="search" class="staff-search" 
                       placeholder="Search staff by name or role..." 
                       value="{{ request('search') }}">
                <button type="submit" class="btn-search">
                    <i class="bi bi-search"></i> Search
                </button>
                @if(request('search'))
                    <a href="{{ route('staff_records') }}" class="btn-clear">
                        <i class="bi bi-x-circle"></i> Clear
                    </a>
                @endif
            </form>
        </div>
        
        <a href="{{ route('staff.create') }}" class="btn-add-staff">
            <i class="bi bi-plus-circle"></i> Add New Record
        </a>
    </div>

    <!-- Staff Table -->
    <div class="staff-table-card">
        <div class="table-responsive">
            <table class="table staff-table align-middle">
                <thead>
                    <tr>
                        <th width="60px">#</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Phone</th>
                        <th>Duty / Shift</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($staff ?? [] as $member)
                    <tr>
                        <td class="text-muted fw-bold">{{ ($staff->currentPage() - 1) * $staff->perPage() + $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($member->profile_picture)
                                    <img src="{{ asset('storage/' . $member->profile_picture) }}" 
                                         alt="{{ $member->name }}" 
                                         class="rounded-circle me-2" 
                                         width="35" height="35"
                                         style="object-fit: cover;">
                                @else
                                    <div class="avatar-placeholder me-2">
                                        {{ substr($member->name, 0, 1) }}
                                    </div>
                                @endif
                                <span class="fw-bold text-dark">{{ $member->name }}</span>
                            </div>
                        </td>
                        <td><span class="role-badge">{{ $member->role }}</span></td>
                        <td>{{ $member->phone }}</td>
                        <td>{{ $member->duty_shift }}</td>
                        <td>
                            <span class="status-badge status-{{ $member->status }}">
                                {{ ucfirst($member->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="action-buttons">
                                <a href="{{ route('staff.show', $member->id) }}" class="action-btn view-btn" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('staff.edit', $member->id) }}" class="action-btn edit-btn" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('staff.destroy', $member->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn" title="Delete" 
                                            onclick="return confirm('Are you sure you want to delete this staff member?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="bi bi-people"></i>
                                <h5>No Staff Members Found</h5>
                                <p>Start by adding your first staff record.</p>
                                <a href="{{ route('staff.create') }}" class="btn btn-primary btn-sm mt-3">
                                    <i class="bi bi-plus-circle"></i> Add First Staff
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if(isset($staff) && $staff->hasPages())
            <div class="pagination-container">
                {{ $staff->appends(request()->query())->links() }}
            </div>
        @endif
        
        <!-- Showing info -->
        @if(isset($staff) && $staff->count() > 0)
            <div class="pagination-container" style="border-top: none; padding-top: 0;">
                <small class="text-muted">
                    Showing {{ $staff->firstItem() ?? 0 }} to {{ $staff->lastItem() ?? 0 }} of {{ $staff->total() ?? 0 }} staff members
                </small>
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
    .stat-card.total-staff { border-left-color: #667eea; }
    .stat-card.active-staff { border-left-color: #28a745; }
    .stat-card.inactive-staff { border-left-color: #dc3545; }

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

    .staff-search {
        border: none;
        padding: 10px 0;
        flex: 1;
        outline: none;
        background: transparent;
        font-size: 0.95rem;
        color: #2c3e50;
    }
    .staff-search::placeholder {
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

    .btn-add-staff {
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
    .btn-add-staff:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    /* Staff Table */
    .staff-table-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .staff-table {
        margin-bottom: 0;
    }
    .staff-table thead {
        background: #f8f9fa;
    }
    .staff-table thead th {
        border: none;
        padding: 14px 18px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 0.5px;
        color: #495057;
    }
    .staff-table tbody td {
        padding: 12px 18px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f5;
    }
    .staff-table tbody tr:last-child td {
        border-bottom: none;
    }
    .staff-table tbody tr:hover {
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

    /* Role Badge */
    .role-badge {
        background: #e8eaf6;
        color: #3949ab;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
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
    .status-inactive { background: #f8d7da; color: #721c24; }

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
        .btn-add-staff {
            justify-content: center;
        }
        .action-buttons {
            flex-wrap: wrap;
        }
    }
</style>

@endsection