<!-- resources/views/Component/Admin/add_room.blade.php -->
@extends('Layout.admin') <!-- Adjust this based on your layout -->

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Room Allocation</h3>
                    <div class="card-tools">
                        <a href="{{ route('room_allocation') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('room_allocation.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <!-- Student Selection -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student_id">Select Student <span class="text-danger">*</span></label>
                                    <select name="student_id" id="student_id" class="form-control @error('student_id') is-invalid @enderror" required>
                                        <option value="">-- Select Student --</option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                                {{ $student->student_name }} ({{ $student->phone_number ?? 'No Phone' }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('student_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if($students->isEmpty())
                                        <small class="text-warning">No unallocated students available.</small>
                                    @endif
                                </div>
                            </div>

                            <!-- Room Selection -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="room_id">Select Room <span class="text-danger">*</span></label>
                                    <select name="room_id" id="room_id" class="form-control @error('room_id') is-invalid @enderror" required>
                                        <option value="">-- Select Room --</option>
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                                Room {{ $room->room_number }} (Available: {{ $room->available_beds }} beds)
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('room_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if($rooms->isEmpty())
                                        <small class="text-warning">No available rooms with beds.</small>
                                    @endif
                                </div>
                            </div>

                            <!-- Allocation Date -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="allocation_date">Allocation Date</label>
                                    <input type="date" name="allocation_date" id="allocation_date" 
                                           class="form-control @error('allocation_date') is-invalid @enderror" 
                                           value="{{ old('allocation_date', date('Y-m-d')) }}">
                                    @error('allocation_date')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Student Details Preview (Optional) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Student Details</label>
                                    <div id="studentDetails" class="border p-2 bg-light">
                                        <p class="text-muted mb-0">Select a student to view details</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary" id="submitBtn" {{ $students->isEmpty() || $rooms->isEmpty() ? 'disabled' : '' }}>
                                    <i class="fas fa-save"></i> Allocate Room
                                </button>
                                <button type="reset" class="btn btn-secondary">
                                    <i class="fas fa-undo"></i> Reset
                                </button>
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
    $(document).ready(function() {
        // When student is selected, show student details
        $('#student_id').on('change', function() {
            var studentId = $(this).val();
            var studentDetails = $('#studentDetails');
            
            if (studentId) {
                // Get student details via AJAX if needed
                var selectedStudent = $('#student_id option:selected').text();
                var phone = selectedStudent.match(/\((.*?)\)/);
                var name = selectedStudent.replace(/\(.*?\)/, '').trim();
                
                studentDetails.html(`
                    <strong>Name:</strong> ${name}<br>
                    <strong>Phone:</strong> ${phone ? phone[1] : 'N/A'}
                `);
            } else {
                studentDetails.html('<p class="text-muted mb-0">Select a student to view details</p>');
            }
        });

        // When room is selected, show room details
        $('#room_id').on('change', function() {
            var selectedRoom = $('#room_id option:selected').text();
            var roomDetails = $('#roomDetails');
            
            if (roomDetails.length) {
                if ($(this).val()) {
                    roomDetails.html(`
                        <strong>Room:</strong> ${selectedRoom}
                    `);
                } else {
                    roomDetails.html('<p class="text-muted mb-0">Select a room to view details</p>');
                }
            }
        });

        // Form validation before submit
        $('form').on('submit', function(e) {
            var studentId = $('#student_id').val();
            var roomId = $('#room_id').val();
            
            if (!studentId || !roomId) {
                e.preventDefault();
                alert('Please select both a student and a room.');
                return false;
            }
            
            return true;
        });
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
    #studentDetails, #roomDetails {
        min-height: 60px;
        border-radius: 4px;
    }
    .text-warning {
        color: #856404 !important;
    }
</style>
@endpush
@endsection