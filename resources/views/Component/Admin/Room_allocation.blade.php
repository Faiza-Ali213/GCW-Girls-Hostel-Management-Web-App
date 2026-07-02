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
            <input type="text" id="searchInput" class="custom-search shadow-sm" placeholder="Search by name, room number or phone...">
        </div>
        
        <button class="btn-add-room shadow-sm" data-bs-toggle="modal" data-bs-target="#addAllocationModal">
            <i class="bi bi-door-open-fill"></i> Add New Room
        </button>
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
                <tbody id="allocationsTableBody">
                    @forelse($allocations as $key => $allocation)
                    <tr>
                        <td class="text-muted fw-bold">{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}</td>
                        <td><span class="fw-bold text-dark">{{ $allocation->student->name }}</span></td>
                        <td>{{ $allocation->student->phone ?? 'N/A' }}</td>
                        <td><span class="fw-bold text-primary">{{ $allocation->room->room_number }}</span></td>
                        <td>
                            @php
                                $available = $allocation->room->available_beds;
                                $spaceClass = $available <= 0 ? 'space-full' : 'space-available';
                            @endphp
                            <span class="space-badge {{ $spaceClass }}">
                                {{ $available <= 0 ? 'Room Full' : $available . ' Beds Left' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn-action-dots" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2">
                                    <li>
                                        <a class="dropdown-item rounded edit-btn" href="#" 
                                           data-id="{{ $allocation->id }}"
                                           data-student="{{ $allocation->student->name }}"
                                           data-room="{{ $allocation->room->room_number }}"
                                           data-room-id="{{ $allocation->room_id }}"
                                           data-remarks="{{ $allocation->remarks }}">
                                            <i class="bi bi-pencil me-2 text-primary"></i> Edit Room
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item rounded deallocate-btn" href="#" 
                                           data-id="{{ $allocation->id }}"
                                           data-student="{{ $allocation->student->name }}">
                                            <i class="bi bi-person-x me-2 text-warning"></i> Deallocate
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item rounded text-danger delete-btn" href="#" 
                                           data-id="{{ $allocation->id }}"
                                           data-student="{{ $allocation->student->name }}">
                                            <i class="bi bi-trash me-2"></i> Delete
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No active allocations found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">
            {{ $allocations->links() }}
        </div>
    </div>
</div>

<!-- Add Allocation Modal -->
<div class="modal fade" id="addAllocationModal" tabindex="-1" aria-labelledby="addAllocationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAllocationModalLabel">
                    <i class="bi bi-plus-circle me-2 text-primary"></i> Add New Room Allocation
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addAllocationForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="student_id" class="form-label">Student <span class="text-danger">*</span></label>
                            <select class="form-select" id="student_id" name="student_id" required>
                                <option value="">Select Student</option>
                                @foreach($students ?? [] as $student)
                                <option value="{{ $student->id }}">{{ $student->name }} - {{ $student->phone }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="room_id" class="form-label">Room <span class="text-danger">*</span></label>
                            <select class="form-select" id="room_id" name="room_id" required>
                                <option value="">Select Room</option>
                                @foreach($rooms as $room)
                                <option value="{{ $room->id }}">
                                    {{ $room->room_number }} ({{ $room->available_beds }} beds available)
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="allocation_date" class="form-label">Allocation Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="allocation_date" name="allocation_date" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea class="form-control" id="remarks" name="remarks" rows="2" placeholder="Optional remarks"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i> Allocate Room
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editAllocationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-pencil me-2 text-warning"></i> Edit Room Allocation
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editAllocationForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Student</label>
                            <input type="text" class="form-control" id="edit_student_name" disabled>
                            <input type="hidden" id="edit_allocation_id" name="allocation_id">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_room_id" class="form-label">Room <span class="text-danger">*</span></label>
                            <select class="form-select" id="edit_room_id" name="room_id" required>
                                @foreach($rooms as $room)
                                <option value="{{ $room->id }}">
                                    {{ $room->room_number }} ({{ $room->available_beds }} beds available)
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="edit_remarks" class="form-label">Remarks</label>
                            <textarea class="form-control" id="edit_remarks" name="remarks" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-circle me-1"></i> Update Allocation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const baseUrl = '{{ url("/") }}';

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    let searchTimeout;

    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            const search = this.value;
            fetch(`/room-allocations/search?search=${encodeURIComponent(search)}`)
                .then(response => response.json())
                .then(data => {
                    // Update table with search results
                    updateTable(data.data);
                })
                .catch(error => console.error('Search error:', error));
        }, 500);
    });

    // Add allocation
    document.getElementById('addAllocationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);

        fetch('/room-allocations', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            alert('Error: ' + error.message);
        });
    });

    // Deallocate
    document.querySelectorAll('.deallocate-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.dataset.id;
            const student = this.dataset.student;

            if (confirm(`Are you sure you want to deallocate ${student}?`)) {
                fetch(`/room-allocations/${id}/deallocate`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    alert('Error: ' + error.message);
                });
            }
        });
    });

    // Delete
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.dataset.id;
            const student = this.dataset.student;

            if (confirm(`Are you sure you want to delete allocation for ${student}?`)) {
                fetch(`/room-allocations/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    alert('Error: ' + error.message);
                });
            }
        });
    });

    // Edit - populate modal
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.dataset.id;
            const student = this.dataset.student;
            const roomId = this.dataset.roomId;
            const remarks = this.dataset.remarks || '';

            document.getElementById('edit_allocation_id').value = id;
            document.getElementById('edit_student_name').value = student;
            document.getElementById('edit_room_id').value = roomId;
            document.getElementById('edit_remarks').value = remarks;

            new bootstrap.Modal(document.getElementById('editAllocationModal')).show();
        });
    });

    // Edit - submit
    document.getElementById('editAllocationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const id = document.getElementById('edit_allocation_id').value;
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);

        fetch(`/room-allocations/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            alert('Error: ' + error.message);
        });
    });

    function updateTable(allocations) {
        const tbody = document.getElementById('allocationsTableBody');
        if (allocations.length === 0) {
            tbody.innerHTML = `<tr><td colspan="6" class="text-center py-4">No allocations found.</td></tr>`;
            return;
        }

        let html = '';
        allocations.forEach((allocation, index) => {
            const available = allocation.room.available_beds;
            const spaceClass = available <= 0 ? 'space-full' : 'space-available';
            const spaceText = available <= 0 ? 'Room Full' : available + ' Beds Left';

            html += `
                <tr>
                    <td class="text-muted fw-bold">${String(index + 1).padStart(2, '0')}</td>
                    <td><span class="fw-bold text-dark">${allocation.student.name}</span></td>
                    <td>${allocation.student.phone || 'N/A'}</td>
                    <td><span class="fw-bold text-primary">${allocation.room.room_number}</span></td>
                    <td><span class="space-badge ${spaceClass}">${spaceText}</span></td>
                    <td class="text-end">
                        <div class="dropdown">
                            <button class="btn-action-dots" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2">
                                <li>
                                    <a class="dropdown-item rounded edit-btn" href="#"
                                       data-id="${allocation.id}"
                                       data-student="${allocation.student.name}"
                                       data-room-id="${allocation.room_id}"
                                       data-remarks="${allocation.remarks || ''}">
                                        <i class="bi bi-pencil me-2 text-primary"></i> Edit Room
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item rounded deallocate-btn" href="#"
                                       data-id="${allocation.id}"
                                       data-student="${allocation.student.name}">
                                        <i class="bi bi-person-x me-2 text-warning"></i> Deallocate
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item rounded text-danger delete-btn" href="#"
                                       data-id="${allocation.id}"
                                       data-student="${allocation.student.name}">
                                        <i class="bi bi-trash me-2"></i> Delete
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            `;
        });

        tbody.innerHTML = html;
        // Re-bind events after table update
        bindEvents();
    }

    function bindEvents() {
        // Re-bind all event listeners
        document.querySelectorAll('.deallocate-btn').forEach(btn => {
            btn.removeEventListener('click', handleDeallocate);
            btn.addEventListener('click', handleDeallocate);
        });

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.removeEventListener('click', handleDelete);
            btn.addEventListener('click', handleDelete);
        });

        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.removeEventListener('click', handleEdit);
            btn.addEventListener('click', handleEdit);
        });
    }

    function handleDeallocate(e) {
        e.preventDefault();
        const id = this.dataset.id;
        const student = this.dataset.student;
        if (confirm(`Are you sure you want to deallocate ${student}?`)) {
            fetch(`/room-allocations/${id}/deallocate`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => alert('Error: ' + error.message));
        }
    }

    function handleDelete(e) {
        e.preventDefault();
        const id = this.dataset.id;
        const student = this.dataset.student;
        if (confirm(`Are you sure you want to delete allocation for ${student}?`)) {
            fetch(`/room-allocations/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => alert('Error: ' + error.message));
        }
    }

    function handleEdit(e) {
        e.preventDefault();
        const id = this.dataset.id;
        const student = this.dataset.student;
        const roomId = this.dataset.roomId;
        const remarks = this.dataset.remarks || '';

        document.getElementById('edit_allocation_id').value = id;
        document.getElementById('edit_student_name').value = student;
        document.getElementById('edit_room_id').value = roomId;
        document.getElementById('edit_remarks').value = remarks;

        new bootstrap.Modal(document.getElementById('editAllocationModal')).show();
    }
});
</script>
@endpush
@endsection