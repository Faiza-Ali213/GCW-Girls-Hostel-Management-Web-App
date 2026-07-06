@extends('Layout.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Room_allocation.css') }}">

<div class="room-container">
    
    <div class="page-header-section">
        <h2>Room Allocation</h2>
        <p class="text-muted">Manage hostel rooms and monitor space availability.</p>
    </div>

    <div class="action-row">
        <div class="search-container">
            <i class="bi bi-search"></i>
            <input type="text" class="custom-search shadow-sm" placeholder="Search by name, room number or phone..." id="searchInput">
        </div>
        
        <!-- ✅ Updated: Add Room button now links to create form -->
        <a href="{{ route('room_allocation.create') }}" class="btn-add-room shadow-sm text-decoration-none">
            <i class="bi bi-door-open-fill"></i> Add New Room
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="stats-row mb-3">
        <div class="stat-card">
            <div class="stat-icon bg-primary">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-info">
                <h5>{{ $totalStudents ?? 0 }}</h5>
                <p>Total Students</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-success">
                <i class="bi bi-door-closed-fill"></i>
            </div>
            <div class="stat-info">
                <h5>{{ $totalRooms ?? 0 }}</h5>
                <p>Total Allocations</p>
            </div>
        </div>
    </div>

    <div class="data-table-card">
        <div class="table-responsive">
            <table class="table room-table align-middle">
                <thead>
                    <tr>
                        <th width="70px">Sr.No</th>
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
                        <td><span class="fw-bold text-dark">{{ $allocation->student_name }}</span></td>
                        <td>{{ $allocation->phone ?? 'N/A' }}</td>
                        <td><span class="fw-bold text-primary">{{ $allocation->room_no }}</span></td>
                        <td>
                            @php
                                // Calculate available space if room relationship exists
                                $available = $allocation->room ? $allocation->room->available_beds : 0;
                            @endphp
                            @if($available > 0)
                                <span class="space-badge space-available">{{ $available }} Beds Left</span>
                            @else
                                <span class="space-badge space-full">Room Full</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn-action-dots" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2">
                                    <li>
                                        <a class="dropdown-item rounded" href="{{ route('room_allocation.edit', $allocation->id) }}">
                                            <i class="bi bi-pencil me-2 text-primary"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('room_allocation.deallocate', $allocation->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item rounded text-warning" onclick="return confirm('Are you sure you want to deallocate this room?')">
                                                <i class="bi bi-person-x me-2"></i> Deallocate
                                            </button>
                                        </form>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('room_allocation.destroy', $allocation->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item rounded text-danger" onclick="return confirm('Are you sure you want to delete this allocation?')">
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
                        <td colspan="6" class="text-center py-4">
                            <i class="bi bi-inbox fs-1 d-block text-muted"></i>
                            <p class="text-muted mt-2">No room allocations found</p>
                            <a href="{{ route('room_allocation.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-circle"></i> Add First Allocation
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if(isset($roomAllocations) && method_exists($roomAllocations, 'links'))
            <div class="d-flex justify-content-end mt-3">
                {{ $roomAllocations->links() }}
            </div>
        @endif
    </div>
</div>

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

    // Confirm delete
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this allocation?')) {
                e.preventDefault();
            }
        });
    });
</script>
@endpush

<style>
.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
}

.stat-card {
    background: white;
    padding: 15px 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    display: flex;
    align-items: center;
    gap: 15px;
}

.stat-icon {
    width: 45px;
    height: 45px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
}

.stat-info h5 {
    margin: 0;
    font-weight: 700;
    font-size: 1.2rem;
}

.stat-info p {
    margin: 0;
    color: #6c757d;
    font-size: 0.85rem;
}

.space-badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.space-available {
    background: #d4edda;
    color: #155724;
}

.space-full {
    background: #f8d7da;
    color: #721c24;
}

.btn-add-room {
    background: #0d6efd;
    color: white;
    border: none;
    padding: 8px 20px;
    border-radius: 8px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s;
    cursor: pointer;
}

.btn-add-room:hover {
    background: #0b5ed7;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
}

.btn-action-dots {
    background: none;
    border: none;
    padding: 5px 10px;
    font-size: 1.2rem;
    color: #6c757d;
    border-radius: 5px;
    transition: all 0.2s;
}

.btn-action-dots:hover {
    background: #e9ecef;
}

.dropdown-item {
    padding: 8px 15px;
    cursor: pointer;
}

.dropdown-item:hover {
    background: #f8f9fa;
}

.dropdown-item button {
    background: none;
    border: none;
    width: 100%;
    text-align: left;
    padding: 0;
}

@media (max-width: 768px) {
    .action-row {
        flex-direction: column;
        gap: 10px;
    }
    
    .search-container {
        width: 100%;
    }
    
    .btn-add-room {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection