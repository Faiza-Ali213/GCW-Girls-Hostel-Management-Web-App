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
                    <div>
                        <a href="{{ route('room-allocation.index') }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye me-1"></i> View All
                        </a>
                        <a href="{{ route('room-allocation.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('room-allocation.store') }}" method="POST">
                        @csrf

                        <!-- Row 1: Student and Room Selection -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-person-fill text-primary me-1"></i> Select Student <span class="text-danger">*</span>
                                    </label>
                                    <select name="student_id" id="student_id" class="form-select" required>
                                        <option value="">-- Select Student --</option>
                                        @forelse($students ?? [] as $student)
                                            <option value="{{ $student->id }}" 
                                                    {{ old('student_id') == $student->id ? 'selected' : '' }}
                                                    data-phone="{{ $student->phone_number ?? 'N/A' }}"
                                                    data-email="{{ $student->email ?? 'N/A' }}">
                                                {{ $student->student_name }} 
                                                @if($student->phone_number) 
                                                    ({{ $student->phone_number }})
                                                @endif
                                            </option>
                                        @empty
                                            <option value="">No students available</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-door-open-fill text-success me-1"></i> Select Room <span class="text-danger">*</span>
                                    </label>
                                    <select name="room_id" id="room_id" class="form-select" required>
                                        <option value="">-- Select Room --</option>
                                        @forelse($rooms ?? [] as $room)
                                            <option value="{{ $room->id }}" 
                                                    {{ old('room_id') == $room->id ? 'selected' : '' }}
                                                    data-available="{{ $room->available_beds ?? 0 }}"
                                                    data-type="{{ $room->room_type ?? 'Standard' }}">
                                                Room {{ $room->room_number }} 
                                                @if(isset($room->available_beds))
                                                    ({{ $room->available_beds }} beds available)
                                                @endif
                                            </option>
                                        @empty
                                            <option value="">No rooms available</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Row 2: Date -->
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-calendar-date-fill text-info me-1"></i> Allocation Date <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" name="allocation_date" class="form-control" 
                                           value="{{ old('allocation_date', date('Y-m-d')) }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Row 3: Preview Sections -->
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-person-vcard-fill text-primary me-1"></i> Student Details
                                    </label>
                                    <div id="studentDetails" class="border rounded p-3 bg-light">
                                        <p class="text-muted mb-0">Select a student to view details</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-building-fill text-success me-1"></i> Room Details
                                    </label>
                                    <div id="roomDetails" class="border rounded p-3 bg-light">
                                        <p class="text-muted mb-0">Select a room to view details</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Row 4: Summary -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-clipboard-check-fill text-warning me-1"></i> Allocation Summary
                                    </label>
                                    <div id="allocationSummary" class="border rounded p-3 bg-success bg-opacity-10">
                                        <p class="text-muted mb-0">Select both student and room to continue</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Row 5: Buttons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-4" id="submitBtn">
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
        const studentSelect = document.getElementById('student_id');
        const roomSelect = document.getElementById('room_id');
        const studentDetails = document.getElementById('studentDetails');
        const roomDetails = document.getElementById('roomDetails');
        const allocationSummary = document.getElementById('allocationSummary');
        const submitBtn = document.getElementById('submitBtn');

        function updateStudentDetails() {
            const opt = studentSelect.options[studentSelect.selectedIndex];
            if (studentSelect.value) {
                const name = opt.text.split(' (')[0];
                const phone = opt.dataset.phone || 'N/A';
                const email = opt.dataset.email || 'N/A';
                studentDetails.innerHTML = `
                    <div class="d-flex align-items-center">
                        <div class="me-3"><i class="bi bi-person-circle fs-2 text-primary"></i></div>
                        <div>
                            <strong>${name}</strong><br>
                            <small><i class="bi bi-telephone me-1"></i> ${phone}</small>
                            ${email !== 'N/A' ? `<br><small><i class="bi bi-envelope me-1"></i> ${email}</small>` : ''}
                            <br><span class="badge bg-success mt-1">Selected</span>
                        </div>
                    </div>
                `;
            } else {
                studentDetails.innerHTML = `<p class="text-muted mb-0">Select a student to view details</p>`;
            }
            updateSummary();
        }

        function updateRoomDetails() {
            const opt = roomSelect.options[roomSelect.selectedIndex];
            if (roomSelect.value) {
                const roomNum = opt.text.split(' (')[0].replace('Room ', '');
                const avail = opt.dataset.available || '0';
                const type = opt.dataset.type || 'Standard';
                const status = avail > 0 ? '<span class="badge bg-success">Available</span>' : '<span class="badge bg-danger">Full</span>';
                roomDetails.innerHTML = `
                    <div class="d-flex align-items-center">
                        <div class="me-3"><i class="bi bi-building fs-2 text-success"></i></div>
                        <div>
                            <strong>Room ${roomNum}</strong><br>
                            <small><i class="bi bi-tag me-1"></i> Type: ${type}</small><br>
                            <small><i class="bi bi-bed me-1"></i> Available: ${avail} beds</small>
                            <br>${status}
                        </div>
                    </div>
                `;
            } else {
                roomDetails.innerHTML = `<p class="text-muted mb-0">Select a room to view details</p>`;
            }
            updateSummary();
        }

        function updateSummary() {
            const sid = studentSelect.value;
            const rid = roomSelect.value;
            
            if (sid && rid) {
                const sName = studentSelect.options[studentSelect.selectedIndex].text.split(' (')[0];
                const rNum = roomSelect.options[roomSelect.selectedIndex].text.split(' (')[0].replace('Room ', '');
                allocationSummary.innerHTML = `
                    <div class="d-flex align-items-center">
                        <div class="me-3"><i class="bi bi-check-circle-fill fs-2 text-success"></i></div>
                        <div>
                            <strong class="text-success">Ready to Allocate</strong><br>
                            <small><strong>${sName}</strong> → Room <strong>${rNum}</strong></small>
                            <br><span class="badge bg-primary mt-1">Ready</span>
                        </div>
                    </div>
                `;
                submitBtn.disabled = false;
            } else {
                let msg = 'Select both student and room to continue';
                if (sid && !rid) msg = 'Please select a room';
                else if (!sid && rid) msg = 'Please select a student';
                allocationSummary.innerHTML = `<p class="text-muted mb-0"><i class="bi bi-info-circle"></i> ${msg}</p>`;
                submitBtn.disabled = true;
            }
        }

        studentSelect.addEventListener('change', function() {
            updateStudentDetails();
            updateSummary();
        });

        roomSelect.addEventListener('change', function() {
            updateRoomDetails();
            updateSummary();
        });

        document.querySelector('form').addEventListener('submit', function(e) {
            if (!studentSelect.value || !roomSelect.value) {
                e.preventDefault();
                alert('Please select both a student and a room.');
                return false;
            }
            const sName = studentSelect.options[studentSelect.selectedIndex].text.split(' (')[0];
            const rNum = roomSelect.options[roomSelect.selectedIndex].text.split(' (')[0].replace('Room ', '');
            return confirm(`Allocate ${sName} to Room ${rNum}?`);
        });

        // Initial load
        updateStudentDetails();
        updateRoomDetails();
        updateSummary();
    });
</script>
@endpush

@push('styles')
<style>
    .form-group { margin-bottom: 1.5rem; }
    #studentDetails, #roomDetails, #allocationSummary {
        min-height: 70px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    .btn-primary:disabled { opacity: 0.6; cursor: not-allowed; }
    @media (max-width: 768px) {
        .card-header { flex-direction: column; gap: 10px; }
        .card-header .btn { width: 100%; }
    }
</style>
@endpush
@endsection