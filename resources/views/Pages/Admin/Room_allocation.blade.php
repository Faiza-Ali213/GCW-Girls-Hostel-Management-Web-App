@extends('Layout.admin')

@section('content')
<div class="room-container">
    
    <!-- Page Header -->
    <div class="page-header-section">
        <h2><i class="bi bi-door-open-fill me-2" style="color: #4F46E5;"></i>Room Allocation</h2>
        <p class="text-muted">Manage hostel rooms and monitor space availability.</p>
    </div>

    <!-- Action Row -->
    <div class="action-row">
        <div class="search-container">
            <i class="bi bi-search search-icon"></i>
            <input type="text" class="custom-search" placeholder="Search by name, room number or phone..." id="searchInput">
        </div>
        
        <a href="{{ route('room_allocation.create') }}" class="btn-add-room">
            <i class="bi bi-plus-circle"></i> Add New Room
        </a>
    </div>

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
                <i class="bi bi-door-closed-fill"></i>
            </div>
            <div class="stat-info">
                <h5>{{ $totalRooms ?? 0 }}</h5>
                <p>Total Allocations</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-warning-soft">
                <i class="bi bi-person-check-fill"></i>
            </div>
            <div class="stat-info">
                <h5>{{ $availableRooms ?? 0 }}</h5>
                <p>Available Rooms</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-danger-soft">
                <i class="bi bi-person-x-fill"></i>
            </div>
            <div class="stat-info">
                <h5>{{ $fullRooms ?? 0 }}</h5>
                <p>Full Rooms</p>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="data-table-card">
        <div class="table-responsive">
            <table class="table room-table align-middle">
                <thead>
                    <tr>
                        <th width="70px">#</th>
                        <th>Student Name</th>
                        <th>Phone Number</th>
                        <th>Room No</th>
                        <th>Available Space</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roomAllocations ?? [] as $index => $allocation)
                    <tr>
                        <td class="text-muted fw-bold">{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if($allocation->student_name)
                                    <div class="avatar-placeholder">
                                        {{ strtoupper(substr($allocation->student_name, 0, 1)) }}
                                    </div>
                                @endif
                                <span class="fw-bold text-dark">{{ $allocation->student_name }}</span>
                            </div>
                        </td>
                        <td>{{ $allocation->phone ?? 'N/A' }}</td>
                        <td>
                            <span class="room-badge">{{ $allocation->room_no }}</span>
                        </td>
                        <td>
                            @php
                                $available = $allocation->room ? $allocation->room->available_beds : 0;
                            @endphp
                            @if($available > 0)
                                <span class="space-badge available">
                                    <i class="bi bi-check-circle-fill"></i> {{ $available }} Beds Left
                                </span>
                            @else
                                <span class="space-badge full">
                                    <i class="bi bi-x-circle-fill"></i> Room Full
                                </span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn-action-dots" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2">
                                    <li>
                                        <a class="dropdown-item rounded" href="{{ route('room_allocation.edit', $allocation->id) }}">
                                            <i class="bi bi-pencil me-2 text-primary"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('room_allocation.deallocate', $allocation->id) }}" method="POST" class="d-inline w-100">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item rounded text-warning w-100" onclick="return confirm('Are you sure you want to deallocate this room?')">
                                                <i class="bi bi-person-x me-2"></i> Deallocate
                                            </button>
                                        </form>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('room_allocation.destroy', $allocation->id) }}" method="POST" class="d-inline w-100">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item rounded text-danger w-100" onclick="return confirm('Are you sure you want to delete this allocation?')">
                                                <i class="bi bi-trash me-2"></i> Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="bi bi-inbox-empty"></i>
                                <h5>No Room Allocations Found</h5>
                                <p>Start by adding your first room allocation.</p>
                                <a href="{{ route('room_allocation.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> Add First Allocation
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if(isset($roomAllocations) && method_exists($roomAllocations, 'links'))
            <div class="pagination-wrapper">
                {{ $roomAllocations->links() }}
            </div>
        @endif
    </div>
</div>

<style>
/* ============================================ */
/* ROOM ALLOCATION - BLUE THEME */
/* ============================================ */

.room-container {
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

.btn-add-room {
    background: linear-gradient(135deg, #4F46E5 0%, #4338CA 100%);
    color: white;
    border: none;
    padding: 11px 28px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.95rem;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    text-decoration: none;
    white-space: nowrap;
    box-shadow: 0 4px 15px rgba(79, 70, 229, 0.25);
}

.btn-add-room:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(79, 70, 229, 0.35);
    color: white;
}

.btn-add-room i {
    font-size: 1.1rem;
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

.bg-danger-soft {
    background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
    color: #EF4444;
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

/* Data Table */
.data-table-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    overflow: hidden;
    border: 1px solid #f0f2f5;
}

.room-table {
    margin-bottom: 0;
}

.room-table thead {
    background: #f8fafc;
}

.room-table thead th {
    border: none;
    padding: 14px 20px;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.7rem;
    letter-spacing: 0.5px;
    color: #64748b;
    border-bottom: 2px solid #eef2f6;
}

.room-table tbody td {
    padding: 14px 20px;
    vertical-align: middle;
    border-bottom: 1px solid #f1f3f5;
}

.room-table tbody tr:last-child td {
    border-bottom: none;
}

.room-table tbody tr:hover {
    background: #f8faff;
}

/* Avatar Placeholder */
.avatar-placeholder {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4F46E5, #4338CA);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.9rem;
    flex-shrink: 0;
    text-transform: uppercase;
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

/* Space Badge */
.space-badge {
    padding: 5px 14px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.space-badge.available {
    background: #ECFDF5;
    color: #10B981;
}

.space-badge.full {
    background: #FEF2F2;
    color: #EF4444;
}

/* Action Buttons */
.btn-action-dots {
    background: none;
    border: none;
    padding: 5px 10px;
    font-size: 1.2rem;
    color: #94a3b8;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.btn-action-dots:hover {
    background: #f1f5f9;
    color: #4F46E5;
}

.dropdown-menu {
    border-radius: 12px;
    padding: 8px;
    min-width: 180px;
}

.dropdown-item {
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 500;
    color: #334155;
    transition: all 0.2s ease;
    cursor: pointer;
}

.dropdown-item:hover {
    background: #f8fafc;
}

.dropdown-item i {
    width: 18px;
}

.dropdown-item.text-warning:hover {
    background: #FFFBEB;
}

.dropdown-item.text-danger:hover {
    background: #FEF2F2;
}

.dropdown-divider {
    margin: 4px 0;
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
    
    .btn-add-room {
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
    
    .room-table thead th,
    .room-table tbody td {
        padding: 10px 12px;
        font-size: 0.85rem;
    }
}

@media (max-width: 576px) {
    .room-container {
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
    
    .btn-add-room {
        font-size: 0.85rem;
        padding: 9px 18px;
    }
}
</style>

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput')?.addEventListener('keyup', function() {
        let searchTerm = this.value.toLowerCase();
        let rows = document.querySelectorAll('.room-table tbody tr');
        
        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>
@endpush
@endsection