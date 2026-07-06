<!-- resources/views/Component/Admin/add_room.blade.php -->
@extends('Layout.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">
                        <i class="bi bi-door-open-fill text-primary me-2"></i>Add Room Allocation
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('room-allocation.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Display validation errors -->
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

                    <form action="{{ route('room-allocation.store') }}" method="POST" id="allocationForm">
                        @csrf

                        <div class="row">
                            <!-- Student Selection -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student_id" class="form-label fw-bold">
                                        Select Student <span class="text-danger">*</span>
                                    </label>
                                    <select name="student_id" id="student_id" 
                                            class="form-select @error('student_id') is-invalid @enderror" 
                                            required>
                                        <option value="">-- Select Student --</option>
                                        @forelse($students as $student)
                                            <option value="{{ $student->id }}" 
                                                    {{ old('student_id') == $student->id ? 'selected' : '' }}
                                                    data-phone="{{ $student->phone_number ?? 'N/A' }}"
                                                    data-email="{{ $student->email ?? 'N/A' }}">
                                                {{ $student->student_name }} 
                                                @if($student->phone_number) 
                                                    ({{ $student->phone_number }})
                                                @else
                                                    (No Phone)
                                                @endif
                                            </option>
                                        @empty
                                            <option value="" disabled>No unallocated students available</option>
                                        @endforelse
                                    </select>
                                    @error('student_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if($students->isEmpty())
                                        <small class="text-warning">
                                            <i class="bi bi-exclamation-triangle-fill"></i> 
                                            No unallocated students available. All students already have rooms.
                                        </small>
                                    @endif
                                </div>
                            </div>

                            <!-- Room Selection -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="room_id" class="form-label fw-bold">
                                        Select Room <span class="text-danger">*</span>
                                    </label>
                                    <select name="room_id" id="room_id" 
                                            class="form-select @error('room_id') is-invalid @enderror" 
                                            required>
                                        <option value="">-- Select Room --</option>
                                        @forelse($rooms as $room)
                                            <option value="{{ $room->id }}" 
                                                    {{ old('room_id') == $room->id ? 'selected' : '' }}
                                                    data-available="{{ $room->available_beds ?? 0 }}"
                                                    data-total="{{ $room->total_beds ?? 0 }}">
                                                Room {{ $room->room_number }} 
                                                @if(isset($room->available_beds))
                                                    ({{ $room->available_beds }} beds available)
                                                @else
                                                    (Available)
                                                @endif
                                            </option>
                                        @empty
                                            <option value="" disabled>No rooms available</option>
                                        @endforelse
                                    </select>
                                    @error('room_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if($rooms->isEmpty())
                                        <small class="text-warning">
                                            <i class="bi bi-exclamation-triangle-fill"></i> 
                                            No available rooms with beds.
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <!-- Allocation Date -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="allocation_date" class="form-label fw-bold">
                                        Allocation Date <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" name="allocation_date" id="allocation_date" 
                                           class="form-control @error('allocation_date') is-invalid @enderror" 
                                           value="{{ old('allocation_date', date('Y-m-d')) }}"
                                           required>
                                    @error('allocation_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Student Details Preview -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold">Student Details</label>
                                    <div id="studentDetails" class="border rounded p-3 bg-light">
                                        <p class="text-muted mb-0">
                                            <i class="bi bi-info-circle"></i> Select a student to view details
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold">Room Details</label>
                                    <div id="roomDetails" class="border rounded p-3 bg-light">
                                        <p class="text-muted mb-0">
                                            <i class="bi bi-info-circle"></i> Select a room to view details
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Allocation Summary -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold">Allocation Summary</label>
                                    <div id="allocationSummary" class="border rounded p-3 bg-success bg-opacity-10">
                                        <p class="text-muted mb-0">
                                            <i class="bi bi-check-circle"></i> Ready to allocate
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-4" 
                                        id="submitBtn" 
                                        {{ $students->isEmpty() || $rooms->isEmpty() ? 'disabled' : '' }}>
                                    <i class="bi bi-check-circle me-2"></i> Allocate Room
                                </button>
                                <button type="reset" class="btn btn-secondary px-4">
                                    <i class="bi bi-arrow-counterclockwise me-2"></i> Reset
                                </button>
                                <a href="{{ route('room-allocation.index') }}" class="btn btn-outline-secondary px-4">
                                    <i class="bi bi-x-circle me-2"></i> Cancel
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
        // Student selection change
        const studentSelect = document.getElementById('student_id');
        const roomSelect = document.getElementById('room_id');
        const studentDetails = document.getElementById('studentDetails');
        const roomDetails = document.getElementById('roomDetails');
        const allocationSummary = document.getElementById('allocationSummary');
        const submitBtn = document.getElementById('submitBtn');

        // Update student details
        studentSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            
            if (this.value) {
                const studentName = selectedOption.text.split(' (')[0];
                const phone = selectedOption.dataset.phone || 'N/A';
                const email = selectedOption.dataset.email || 'N/A';
                
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

        // Update room details
        roomSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            
            if (this.value) {
                const roomNumber = selectedOption.text.split(' (')[0].replace('Room ', '');
                const availableBeds = selectedOption.dataset.available || 'N/A';
                const totalBeds = selectedOption.dataset.total || 'N/A';
                
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
                            <i class="bi bi-door-open fs-2 text-primary"></i>
                        </div>
                        <div>
                            <strong class="d-block">Room ${roomNumber}</strong>
                            <small class="text-muted">
                                Available: ${availableBeds} beds 
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

        // Update allocation summary
        function updateSummary() {
            const studentId = studentSelect.value;
            const roomId = roomSelect.value;
            
            if (studentId && roomId) {
                const studentName = studentSelect.options[studentSelect.selectedIndex].text.split(' (')[0];
                const roomNumber = roomSelect.options[roomSelect.selectedIndex].text.split(' (')[0].replace('Room ', '');
                
                allocationSummary.innerHTML = `
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="bi bi-check-circle-fill fs-2 text-success"></i>
                        </div>
                        <div>
                            <strong class="d-block text-success">Ready to Allocate</strong>
                            <small>
                                <strong>${studentName}</strong> → Room <strong>${roomNumber}</strong>
                            </small>
                        </div>
                    </div>
                `;
                submitBtn.disabled = false;
            } else {
                allocationSummary.innerHTML = `
                    <p class="text-muted mb-0">
                        <i class="bi bi-check-circle"></i> Select both student and room to continue
                    </p>
                `;
                submitBtn.disabled = true;
            }
        }

        // Form validation
        document.getElementById('allocationForm').addEventListener('submit', function(e) {
            const studentId = studentSelect.value;
            const roomId = roomSelect.value;
            
            if (!studentId || !roomId) {
                e.preventDefault();
                alert('⚠️ Please select both a student and a room before submitting.');
                return false;
            }
            
            // Confirm allocation
            const studentName = studentSelect.options[studentSelect.selectedIndex].text.split(' (')[0];
            const roomNumber = roomSelect.options[roomSelect.selectedIndex].text.split(' (')[0].replace('Room ', '');
            
            return confirm(`Are you sure you want to allocate ${studentName} to Room ${roomNumber}?`);
        });

        // Trigger initial summary update
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
    }
    .text-warning {
        color: #856404 !important;
    }
    .btn-primary:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    .alert ul {
        padding-left: 20px;
    }
</style>
@endpush
@endsection