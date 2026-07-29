@extends('Layout.admin')

@section('content')
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

    /* Form Card */
    .form-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    /* Form Sections */
    .form-section {
        margin-bottom: 30px;
        padding-bottom: 25px;
        border-bottom: 1px solid #e9ecef;
    }
    .form-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .section-title {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .section-title i {
        color: #667eea;
    }

    /* Form Inputs */
    .custom-input {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 15px;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }
    .custom-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }
    .custom-input.is-invalid {
        border-color: #dc3545;
    }
    .custom-input.is-valid {
        border-color: #10B981;
        background-color: #ECFDF5;
    }
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }
    .text-danger {
        color: #dc3545;
    }
    .text-success {
        color: #10B981;
    }
    .text-warning {
        color: #F59E0B;
    }

    /* Room Status Display */
    .room-status {
        padding: 8px 12px;
        border-radius: 8px;
        margin-top: 5px;
        font-weight: 500;
        font-size: 0.9rem;
    }
    .room-status.available {
        background: #ECFDF5;
        color: #10B981;
        border: 1px solid #10B981;
    }
    .room-status.full {
        background: #FEF2F2;
        color: #EF4444;
        border: 1px solid #EF4444;
    }
    .room-status.not-found {
        background: #FFFBEB;
        color: #F59E0B;
        border: 1px solid #F59E0B;
    }
    .room-status.loading {
        background: #EFF6FF;
        color: #3B82F6;
        border: 1px solid #3B82F6;
    }
    .room-status.current {
        background: #EEF2FF;
        color: #4F46E5;
        border: 1px solid #4F46E5;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding-top: 20px;
        border-top: 2px solid #f1f3f5;
        margin-top: 10px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 10px 30px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
    }

    .btn-save {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }
    .btn-save:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none !important;
    }

    .btn-cancel {
        background: #f1f3f5;
        color: #6c757d;
    }
    .btn-cancel:hover {
        background: #e9ecef;
        color: #495057;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-card {
            padding: 20px 15px;
        }
        .form-actions {
            flex-direction: column;
        }
        .form-actions .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="student-container">
    
    <div class="page-header-section">
        <h2>Edit Student</h2>
        <p class="text-muted">Update the details of the resident in GCW Hostel.</p>
    </div>

    <div class="form-card">
        <form id="editStudentForm" action="{{ route('student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-section">
                <h5 class="section-title">
                    <i class="bi bi-person-badge"></i> Personal Information
                </h5>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Student Name <span class="text-danger">*</span></label>
                        <input type="text" name="student_name" class="form-control custom-input @error('student_name') is-invalid @enderror" 
                               placeholder="Enter full name" value="{{ old('student_name', $student->student_name) }}" required>
                        @error('student_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Father Name <span class="text-danger">*</span></label>
                        <input type="text" name="father_name" class="form-control custom-input @error('father_name') is-invalid @enderror" 
                               placeholder="Enter father's name" value="{{ old('father_name', $student->father_name) }}" required>
                        @error('father_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="tel" name="phone_number" class="form-control custom-input @error('phone_number') is-invalid @enderror" 
                               id="phoneInput" placeholder="0300-1234567" value="{{ old('phone_number', $student->phone_number) }}" required>
                        @error('phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">CNIC Number <span class="text-danger">*</span></label>
                        <input type="text" name="cnic_number" class="form-control custom-input @error('cnic_number') is-invalid @enderror" 
                               id="cnicInput" placeholder="35201-1234567-8" value="{{ old('cnic_number', $student->cnic_number) }}" required>
                        @error('cnic_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control custom-input @error('email') is-invalid @enderror" 
                               placeholder="student@example.com" value="{{ old('email', $student->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Admission Date <span class="text-danger">*</span></label>
                        <input type="date" name="admission_date" class="form-control custom-input @error('admission_date') is-invalid @enderror" 
                               value="{{ old('admission_date', $student->admission_date ? $student->admission_date->format('Y-m-d') : '') }}" required>
                        @error('admission_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Address <span class="text-danger">*</span></label>
                        <textarea name="address" class="form-control custom-input @error('address') is-invalid @enderror" 
                                  rows="3" placeholder="Enter complete address" required>{{ old('address', $student->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h5 class="section-title">
                    <i class="bi bi-building"></i> Hostel Information
                </h5>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Room Number</label>
                        <input type="text" name="room_number" 
                               class="form-control custom-input @error('room_number') is-invalid @enderror" 
                               id="room_number" 
                               placeholder="Enter room number (e.g., 101)" 
                               value="{{ old('room_number', $student->room_number) }}">
                        <div id="roomStatus" class="room-status current" style="display:{{ $student->room_number ? 'block' : 'none' }};">
                            <i class="bi bi-info-circle"></i> 
                            @if($student->room_number)
                                Current Room: {{ $student->room_number }} 
                                @if($student->room)
                                    ({{ $student->room->room_type }} - {{ $student->room->current_occupancy }}/{{ $student->room->capacity }} occupied)
                                @endif
                            @else
                                No room assigned
                            @endif
                        </div>
                        @error('room_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Hostel Status</label>
                        <select name="hostel_status" class="form-control custom-input @error('hostel_status') is-invalid @enderror">
                            <option value="active" {{ old('hostel_status', $student->hostel_status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('hostel_status', $student->hostel_status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="graduated" {{ old('hostel_status', $student->hostel_status) == 'graduated' ? 'selected' : '' }}>Graduated</option>
                            <option value="left" {{ old('hostel_status', $student->hostel_status) == 'left' ? 'selected' : '' }}>Left</option>
                        </select>
                        @error('hostel_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h5 class="section-title">
                    <i class="bi bi-phone"></i> Contact & Emergency
                </h5>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Guardian Contact</label>
                        <input type="text" name="guardian_contact" class="form-control custom-input @error('guardian_contact') is-invalid @enderror" 
                               placeholder="0300-1234567" value="{{ old('guardian_contact', $student->guardian_contact) }}">
                        @error('guardian_contact')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Emergency Contact</label>
                        <input type="text" name="emergency_contact" class="form-control custom-input @error('emergency_contact') is-invalid @enderror" 
                               placeholder="0300-7654321" value="{{ old('emergency_contact', $student->emergency_contact) }}">
                        @error('emergency_contact')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h5 class="section-title">
                    <i class="bi bi-clipboard"></i> Additional Information
                </h5>
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label">Profile Picture</label>
                        @if($student->profile_picture)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $student->profile_picture) }}" 
                                     alt="{{ $student->student_name }}" 
                                     style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px; border: 2px solid #e9ecef;">
                                <small class="text-muted d-block">Current profile picture</small>
                            </div>
                        @endif
                        <input type="file" name="profile_picture" class="form-control custom-input @error('profile_picture') is-invalid @enderror" 
                               accept="image/*">
                        <small class="text-muted">Maximum file size: 2MB. Supported formats: JPG, PNG, GIF</small>
                        @error('profile_picture')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Medical Conditions</label>
                        <textarea name="medical_conditions" class="form-control custom-input @error('medical_conditions') is-invalid @enderror" 
                                  rows="2" placeholder="Any medical conditions or allergies">{{ old('medical_conditions', $student->medical_conditions) }}</textarea>
                        @error('medical_conditions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" class="form-control custom-input @error('remarks') is-invalid @enderror" 
                                  rows="2" placeholder="Any additional remarks">{{ old('remarks', $student->remarks) }}</textarea>
                        @error('remarks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('student-records') }}" class="btn btn-cancel">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
                <button type="submit" class="btn btn-save" id="submitBtn">
                    <i class="bi bi-check-circle"></i> Update Student
                </button>
            </div>

        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    console.log('✅ Edit Student page loaded');

    var roomValidationTimer = null;
    var roomValid = false;
    var roomData = null;
    var currentRoomNumber = '{{ $student->room_number }}';
    var roomStatusDiv = $('#roomStatus');

    // Auto-capitalize student name
    $('input[name="student_name"]').on('blur', function() {
        $(this).val($(this).val().toUpperCase());
    });

    // Auto-capitalize father name
    $('input[name="father_name"]').on('blur', function() {
        $(this).val($(this).val().toUpperCase());
    });

    // Format phone number
    $('#phoneInput').on('input', function() {
        var value = $(this).val().replace(/\D/g, '');
        if (value.length > 0) {
            if (value.length <= 4) {
                $(this).val(value);
            } else if (value.length <= 7) {
                $(this).val(value.slice(0, 4) + '-' + value.slice(4));
            } else {
                $(this).val(value.slice(0, 4) + '-' + value.slice(4, 7) + '-' + value.slice(7, 11));
            }
        }
    });

    // Format CNIC
    $('#cnicInput').on('input', function() {
        var value = $(this).val().replace(/\D/g, '');
        if (value.length > 0) {
            if (value.length <= 5) {
                $(this).val(value);
            } else if (value.length <= 12) {
                $(this).val(value.slice(0, 5) + '-' + value.slice(5));
            } else {
                $(this).val(value.slice(0, 5) + '-' + value.slice(5, 12) + '-' + value.slice(12, 13));
            }
        }
    });

    // ============================================
    // ROOM NUMBER VALIDATION
    // ============================================
    $('#room_number').on('input', function() {
        var roomNumber = $(this).val().trim();
        var submitBtn = $('#submitBtn');
        
        // Clear previous timer
        if (roomValidationTimer) {
            clearTimeout(roomValidationTimer);
        }
        
        // If empty or same as current room, show current status
        if (!roomNumber) {
            roomStatusDiv.show();
            roomStatusDiv.removeClass('available full not-found loading');
            roomStatusDiv.addClass('current');
            roomStatusDiv.html('<i class="bi bi-info-circle"></i> No room assigned');
            roomValid = true;
            roomData = null;
            $(this).removeClass('is-valid is-invalid');
            submitBtn.prop('disabled', false);
            return;
        }
        
        // If same as current room, show current status
        if (roomNumber === currentRoomNumber) {
            roomStatusDiv.show();
            roomStatusDiv.removeClass('available full not-found loading');
            roomStatusDiv.addClass('current');
            roomStatusDiv.html('<i class="bi bi-info-circle"></i> Current Room: ' + roomNumber + 
                @if($student->room) 
                    ' ({{ $student->room->room_type }} - {{ $student->room->current_occupancy }}/{{ $student->room->capacity }} occupied)' 
                @endif
            );
            roomValid = true;
            roomData = null;
            $(this).removeClass('is-valid is-invalid');
            submitBtn.prop('disabled', false);
            return;
        }
        
        // Show loading status
        roomStatusDiv.show();
        roomStatusDiv.removeClass('available full not-found loading current');
        roomStatusDiv.addClass('loading');
        roomStatusDiv.html('<i class="bi bi-hourglass-split"></i> Checking room availability...');
        $(this).removeClass('is-valid is-invalid');
        submitBtn.prop('disabled', true);
        
        // Debounce validation
        roomValidationTimer = setTimeout(function() {
            // AJAX request to validate room
            $.ajax({
                url: '{{ route("student.validateRoom") }}',
                type: 'GET',
                data: { room_number: roomNumber },
                success: function(response) {
                    console.log('Room validation response:', response);
                    
                    if (response.success) {
                        var room = response.data;
                        
                        if (room.current_occupancy < room.capacity) {
                            // Room has space available
                            roomStatusDiv.removeClass('loading');
                            roomStatusDiv.addClass('available');
                            roomStatusDiv.html('<i class="bi bi-check-circle-fill"></i> Room ' + room.room_number + 
                                ' is available! (' + room.current_occupancy + '/' + room.capacity + ' occupied) - ' + 
                                room.room_type + ' room');
                            $('#room_number').removeClass('is-invalid').addClass('is-valid');
                            roomValid = true;
                            roomData = room;
                            submitBtn.prop('disabled', false);
                        } else {
                            // Room is full
                            roomStatusDiv.removeClass('loading');
                            roomStatusDiv.addClass('full');
                            roomStatusDiv.html('<i class="bi bi-x-circle-fill"></i> Room ' + room.room_number + 
                                ' is FULL! (Capacity: ' + room.capacity + ', Occupied: ' + room.current_occupancy + ')');
                            $('#room_number').removeClass('is-valid').addClass('is-invalid');
                            roomValid = false;
                            roomData = null;
                            submitBtn.prop('disabled', true);
                        }
                    } else {
                        // Room not found
                        roomStatusDiv.removeClass('loading');
                        roomStatusDiv.addClass('not-found');
                        roomStatusDiv.html('<i class="bi bi-exclamation-triangle-fill"></i> ' + response.message);
                        $('#room_number').removeClass('is-valid').addClass('is-invalid');
                        roomValid = false;
                        roomData = null;
                        submitBtn.prop('disabled', true);
                    }
                },
                error: function(xhr) {
                    console.error('AJAX Error:', xhr);
                    roomStatusDiv.removeClass('loading');
                    roomStatusDiv.addClass('not-found');
                    roomStatusDiv.html('<i class="bi bi-exclamation-triangle-fill"></i> Error checking room. Please try again.');
                    roomValid = false;
                    roomData = null;
                    submitBtn.prop('disabled', true);
                }
            });
        }, 500);
    });

    // ============================================
    // FORM SUBMISSION - Validate Room
    // ============================================
    $('#editStudentForm').on('submit', function(e) {
        var roomNumber = $('#room_number').val().trim();
        var currentRoom = '{{ $student->room_number }}';
        
        // If room number is provided and different from current, validate
        if (roomNumber && roomNumber !== currentRoom) {
            if (!roomValid || !roomData) {
                e.preventDefault();
                alert('Please enter a valid room number with available space.');
                $('#room_number').focus();
                return false;
            }
            
            // Add room_id to form data
            var roomIdInput = $('<input>').attr({
                type: 'hidden',
                name: 'room_id',
                value: roomData.id
            });
            $(this).append(roomIdInput);
            
            // Add room_type to form data
            var roomTypeInput = $('<input>').attr({
                type: 'hidden',
                name: 'room_type',
                value: roomData.room_type
            });
            $(this).append(roomTypeInput);
        }
        
        return true;
    });
});
</script>
@endpush