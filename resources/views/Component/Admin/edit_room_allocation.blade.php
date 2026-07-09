<!-- resources/views/Pages/Admin/edit_room_allocation.blade.php -->
@extends('Layout.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">
                        <i class="bi bi-pencil-square text-warning me-2"></i>Edit Room Allocation
                    </h3>
                    <div class="d-flex gap-2">
                        <a href="{{ route('room-allocation.index') }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye me-1"></i> View All
                        </a>
                        <a href="{{ route('room-allocation.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('room-allocation.update', $allocation->id) }}" method="POST" id="editForm">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Student Selection -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student_id" class="form-label fw-bold">
                                        <i class="bi bi-person-fill text-primary me-1"></i> Select Student <span class="text-danger">*</span>
                                    </label>
                                    <select name="student_id" id="student_id" 
                                            class="form-select @error('student_id') is-invalid @enderror" 
                                            required>
                                        <option value="">-- Select Student --</option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}" 
                                                    {{ old('student_id', $allocation->student_id) == $student->id ? 'selected' : '' }}
                                                    data-phone="{{ $student->phone_number ?? 'N/A' }}"
                                                    data-email="{{ $student->email ?? 'N/A' }}"
                                                    data-room="{{ $student->room_number ?? 'Not Allocated' }}">
                                                {{ $student->student_name }} 
                                                @if($student->phone_number) 
                                                    ({{ $student->phone_number }})
                                                @else
                                                    (No Phone)
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('student_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Room Selection -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="room_id" class="form-label fw-bold">
                                        <i class="bi bi-door-open-fill text-success me-1"></i> Select Room <span class="text-danger">*</span>
                                    </label>
                                    <select name="room_id" id="room_id" 
                                            class="form-select @error('room_id') is-invalid @enderror" 
                                            required>
                                        <option value="">-- Select Room --</option>
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->id }}" 
                                                    {{ old('room_id', $allocation->room_id) == $room->id ? 'selected' : '' }}
                                                    data-available="{{ $room->available_beds ?? 0 }}"
                                                    data-total="{{ $room->total_beds ?? 0 }}"
                                                    data-type="{{ $room->room_type ?? 'Standard' }}">
                                                Room {{ $room->room_number }} 
                                                @if(isset($room->available_beds))
                                                    ({{ $room->available_beds }} beds available)
                                                @else
                                                    (Available)
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('room_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <!-- Allocation Date -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="allocation_date" class="form-label fw-bold">
                                        <i class="bi bi-calendar-date-fill text-info me-1"></i> Allocation Date <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" name="allocation_date" id="allocation_date" 
                                           class="form-control @error('allocation_date') is-invalid @enderror" 
                                           value="{{ old('allocation_date', $allocation->allocation_date) }}"
                                           required>
                                    @error('allocation_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Current Allocation Info -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-info-circle-fill text-info me-1"></i> Current Allocation Info
                                    </label>
                                    <div class="border rounded p-3 bg-info bg-opacity-10">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <i class="bi bi-info-circle-fill fs-2 text-info"></i>
                                            </div>
                                            <div>
                                                <strong class="d-block">Current Details</strong>
                                                <small>
                                                    <i class="bi bi-person me-1"></i> <strong>Student:</strong> {{ $allocation->student_name }}<br>
                                                    <i class="bi bi-door-open me-1"></i> <strong>Room:</strong> {{ $allocation->room_no }}<br>
                                                    <i class="bi bi-calendar me-1"></i> <strong>Allocated:</strong> {{ \Carbon\Carbon::parse($allocation->allocation_date)->format('d M Y') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <!-- Student Details -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-person-vcard-fill text-primary me-1"></i> Student Details
                                    </label>
                                    <div id="studentDetails" class="border rounded p-3 bg-light">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <i class="bi bi-person-circle fs-2 text-primary"></i>
                                            </div>
                                            <div>
                                                <strong class="d-block">{{ $allocation->student_name }}</strong>
                                                <small class="text-muted">
                                                    <i class="bi bi-telephone me-1"></i> {{ $allocation->phone ?? 'N/A' }}
                                                </small>
                                                <br>
                                                <span class="badge bg-success">Currently Allocated</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Room Details -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-building-fill text-success me-1"></i> Room Details
                                    </label>
                                    <div id="roomDetails" class="border rounded p-3 bg-light">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <i class="bi bi-building fs-2 text-success"></i>
                                            </div>
                                            <div>
                                                <strong class="d-block">Room {{ $allocation->room_no }}</strong>
                                                <small class="text-muted">
                                                    @if(isset($allocation->room->available_beds))
                                                        <i class="bi bi-bed me-1"></i> Available: {{ $allocation->room->available_beds }} beds
                                                    @else
                                                        <i class="bi bi-check-circle me-1"></i> Status: Available
                                                    @endif
                                                </small>
                                                <br>
                                                <span class="badge bg-info">Currently Allocated</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-clipboard-check-fill text-warning me-1"></i> Allocation Summary
                                    </label>
                                    <div id="allocationSummary" class="border rounded p-3 bg-warning bg-opacity-10">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <i class="bi bi-pencil-square fs-2 text-warning"></i>
                                            </div>
                                            <div>
                                                <strong class="d-block text-warning">Editing Allocation</strong>
                                                <small>
                                                    <i class="bi bi-person me-1"></i> <strong>{{ $allocation->student_name }}</strong>
                                                    <i class="bi bi-arrow-right mx-2"></i>
                                                    <i class="bi bi-door-open me-1"></i> Room <strong>{{ $allocation->room_no }}</strong>
                                                </small>
                                                <br>
                                                <span class="badge bg-warning">Update Mode</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-warning px-4">
                                    <i class="bi bi-pencil-square me-2"></i> Update Allocation
                                </button>
                                <button type="reset" class="btn btn-secondary px-4">
                                    <i class="bi bi-arrow-counterclockwise me-2"></i> Reset
                                </button>
                                <a href="{{ route('room-allocation.index') }}" class="btn btn-outline-secondary px-4">
                                    <i class="bi bi-x-circle me-2"></i> Cancel
                                </a>
                                <a href="{{ route('room-allocation.index') }}" class="btn btn-outline-info px-4">
                                    <i class="bi bi-eye me-2"></i> View All
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const studentSelect = document.getElementById('student_id');
        const roomSelect = document.getElementById('room_id');
        const studentDetails = document.getElementById('studentDetails');
        const roomDetails = document.getElementById('roomDetails');
        const allocationSummary = document.getElementById('allocationSummary');

        // Student Selection Handler
        studentSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (this.value) {
                const studentName = selectedOption.text.split(' (')[0];
                const phone = selectedOption.dataset.phone || 'N/A';
                const email = selectedOption.dataset.email || 'N/A';
                const currentRoom = selectedOption.dataset.room || 'Not Allocated';
                
                studentDetails.innerHTML = `
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-person-circle fs-2 text-primary"></i>
                        </div>
                        <div>
                            <strong class="d-block">${studentName}</strong>
                            <small class="text-muted">
                                <i class="bi bi-telephone me-1"></i> ${phone}
                            </small>
                            ${email !== 'N/A' ? `<br><small class="text-muted"><i class="bi bi-envelope me-1"></i> ${email}</small>` : ''}
                            <br><small class="text-muted">
                                <i class="bi bi-door-open me-1"></i> Current Room: ${currentRoom}
                            </small>
                            <br><span class="badge bg-success">Selected</span>
                        </div>
                    </div>
                `;
            } else {
                studentDetails.innerHTML = `
                    <p class="text-muted mb-0">
                        <i class="bi bi-info-circle"></i> Select a student to view details
                    </p>
                `;
            }
            updateSummary();
        });

        // Room Selection Handler
        roomSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (this.value) {
                const roomNumber = selectedOption.text.split(' (')[0].replace('Room ', '');
                const availableBeds = selectedOption.dataset.available || 'N/A';
                const totalBeds = selectedOption.dataset.total || 'N/A';
                const roomType = selectedOption.dataset.type || 'Standard';
                
                let statusBadge = '';
                if (availableBeds > 0) {
                    statusBadge = `<span class="badge bg-success">Available</span>`;
                } else if (availableBeds == 0) {
                    statusBadge = `<span class="badge bg-danger">Full</span>`;
                } else {
                    statusBadge = `<span class="badge bg-warning">Unknown</span>`;
                }
                
                roomDetails.innerHTML = `
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-building fs-2 text-success"></i>
                        </div>
                        <div>
                            <strong class="d-block">Room ${roomNumber}</strong>
                            <small class="text-muted">
                                <i class="bi bi-tag me-1"></i> Type: ${roomType}
                            </small>
                            <br>
                            <small class="text-muted">
                                <i class="bi bi-bed me-1"></i> Available: ${availableBeds} beds 
                                ${totalBeds !== 'N/A' ? `/ Total: ${totalBeds} beds` : ''}
                            </small>
                            <br>${statusBadge}
                        </div>
                    </div>
                `;
            } else {
                roomDetails.innerHTML = `
                    <p class="text-muted mb-0">
                        <i class="bi bi-info-circle"></i> Select a room to view details
                    </p>
                `;
            }
            updateSummary();
        });

        // Update Summary
        function updateSummary() {
            const studentId = studentSelect.value;
            const roomId = roomSelect.value;
            
            if (studentId && roomId) {
                const studentName = studentSelect.options[studentSelect.selectedIndex].text.split(' (')[0];
                const roomNumber = roomSelect.options[roomSelect.selectedIndex].text.split(' (')[0].replace('Room ', '');
                
                allocationSummary.innerHTML = `
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-pencil-square fs-2 text-warning"></i>
                        </div>
                        <div>
                            <strong class="d-block text-warning">Ready to Update</strong>
                            <small>
                                <i class="bi bi-person me-1"></i> <strong>${studentName}</strong>
                                <i class="bi bi-arrow-right mx-2"></i>
                                <i class="bi bi-door-open me-1"></i> Room <strong>${roomNumber}</strong>
                            </small>
                            <br><span class="badge bg-warning">Update Mode</span>
                        </div>
                    </div>
                `;
            } else {
                let message = 'Select both student and room to update';
                if (studentId && !roomId) {
                    message = 'Please select a room';
                } else if (!studentId && roomId) {
                    message = 'Please select a student';
                }
                allocationSummary.innerHTML = `
                    <p class="text-muted mb-0">
                        <i class="bi bi-pencil-square"></i> ${message}
                    </p>
                `;
            }
        }

        // Form Submit Handler
        document.getElementById('editForm').addEventListener('submit', function(e) {
            const studentId = studentSelect.value;
            const roomId = roomSelect.value;
            
            if (!studentId || !roomId) {
                e.preventDefault();
                alert('⚠️ Please select both a student and a room before updating.');
                return false;
            }
            
            const studentName = studentSelect.options[studentSelect.selectedIndex].text.split(' (')[0];
            const roomNumber = roomSelect.options[roomSelect.selectedIndex].text.split(' (')[0].replace('Room ', '');
            
            return confirm(`Are you sure you want to update allocation for ${studentName} to Room ${roomNumber}?`);
        });

        // Initialize
        updateSummary();
    });
</script>
@endpush

@push('styles')
<style>
    .form-group {
        margin-bottom: 1.5rem;
    }
    .card-header {
        background: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }
    .bg-light {
        background-color: #f8f9fa !important;
    }
    #studentDetails, #roomDetails, #allocationSummary {
        min-height: 70px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    @media (max-width: 768px) {
        .card-header {
            flex-direction: column;
            align-items: stretch !important;
            gap: 10px;
        }
        .card-header .d-flex {
            justify-content: stretch;
        }
        .card-header .btn {
            flex: 1;
        }
    }
</style>
@endpush
@endsection