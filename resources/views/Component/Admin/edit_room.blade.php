@extends('Layout.admin')

@section('content')
<style>
    .room-form-container {
        max-width: 700px;
        margin: 0 auto;
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        border: 1px solid #f0f2f5;
    }
    .room-form-container h4 {
        color: #0b1a33;
        font-weight: 700;
        margin-bottom: 5px;
    }
    .room-form-container .sub-title {
        color: #94a3b8;
        font-size: 0.95rem;
        margin-bottom: 25px;
    }
    .form-label {
        font-weight: 600;
        color: #0b1a33;
        font-size: 0.9rem;
    }
    .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }
    .form-control:focus {
        border-color: #4F46E5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.06);
    }
    .form-control.is-invalid {
        border-color: #EF4444;
    }
    .invalid-feedback {
        font-size: 0.8rem;
        color: #EF4444;
        margin-top: 4px;
    }
    .btn-submit {
        background: linear-gradient(135deg, #4F46E5 0%, #4338CA 100%);
        color: white !important;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1rem;
        width: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.25);
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(79, 70, 229, 0.35);
        color: white !important;
    }
    .btn-cancel {
        background: #f1f3f5;
        color: #495057 !important;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        width: 100%;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }
    .btn-cancel:hover {
        background: #e9ecef;
        color: #2c3e50 !important;
        text-decoration: none;
    }
    .form-section {
        background: #f8fafc;
        border-radius: 12px;
        padding: 18px 20px;
        margin-bottom: 20px;
        border: 1px solid #eef2f6;
    }
    .form-section .section-title {
        font-weight: 600;
        color: #0b1a33;
        font-size: 0.9rem;
        margin-bottom: 12px;
    }
    .form-section .section-title i {
        color: #4F46E5;
        margin-right: 8px;
    }
    .required-star {
        color: #EF4444;
        margin-left: 2px;
    }
    .current-occupancy-info {
        background: #EEF2FF;
        border-radius: 10px;
        padding: 10px 15px;
        text-align: center;
        font-weight: 600;
        color: #4F46E5;
        font-size: 1rem;
        border: 2px dashed #4F46E5;
        margin-top: 5px;
    }
    .current-occupancy-info .occupancy-number {
        font-size: 1.5rem;
    }
    .current-occupancy-info .occupancy-label {
        font-size: 0.85rem;
        color: #64748b;
    }
    .warning-box {
        background: #FFFBEB;
        border: 1px solid #F59E0B;
        border-radius: 10px;
        padding: 12px 16px;
        color: #92400E;
        font-size: 0.9rem;
        margin-top: 10px;
    }
    .warning-box i {
        color: #F59E0B;
        margin-right: 8px;
    }
    .capacity-display {
        background: #ECFDF5;
        border-radius: 10px;
        padding: 8px 15px;
        text-align: center;
        font-weight: 600;
        color: #10B981;
        font-size: 1rem;
        border: 2px solid #10B981;
    }

    @media (max-width: 768px) {
        .room-form-container {
            padding: 20px;
        }
    }
</style>

<div class="room-form-container">
    <div>
        <h4><i class="fas fa-door-open text-primary"></i> Edit Room</h4>
        <div class="sub-title">Update room details for {{ $room->room_number }}</div>
    </div>

    <form action="{{ route('room-allocation.update', $room->id) }}" method="POST" id="editRoomForm">
        @csrf
        @method('PUT')

        <!-- Basic Information -->
        <div class="form-section">
            <div class="section-title">
                <i class="fas fa-info-circle"></i> Basic Information
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="room_number" class="form-label">Room Number <span class="required-star">*</span></label>
                    <input type="text" class="form-control @error('room_number') is-invalid @enderror" 
                           id="room_number" name="room_number" 
                           placeholder="e.g., 101, A-201" 
                           value="{{ old('room_number', $room->room_number) }}" required>
                    @error('room_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="room_type" class="form-label">Room Type <span class="required-star">*</span></label>
                    <select class="form-control @error('room_type') is-invalid @enderror" id="room_type" name="room_type" required>
                        <option value="double" {{ old('room_type', $room->room_type) == 'double' ? 'selected' : '' }}>Double (2 Beds)</option>
                        <option value="triple" {{ old('room_type', $room->room_type) == 'triple' ? 'selected' : '' }}>Triple (3 Beds)</option>
                        <option value="quad" {{ old('room_type', $room->room_type) == 'quad' ? 'selected' : '' }}>Quad (4 Beds)</option>
                    </select>
                    @error('room_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Capacity (Auto-set)</label>
                    <div class="capacity-display" id="capacityDisplay">
                        <i class="fas fa-bed"></i> 
                        <span id="capacityValue">{{ $room->capacity }}</span> Beds
                    </div>
                    <input type="hidden" id="capacity" name="capacity" value="{{ $room->capacity }}">
                    <small class="text-muted">Capacity is automatically set based on room type</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status <span class="required-star">*</span></label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="available" {{ old('status', $room->status) == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="full" {{ old('status', $room->status) == 'full' ? 'selected' : '' }}>Full</option>
                        <option value="maintenance" {{ old('status', $room->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Current Occupancy Info -->
            <div class="row">
                <div class="col-md-12">
                    <div class="current-occupancy-info">
                        <div class="occupancy-label">Current Occupancy</div>
                        <div class="occupancy-number">
                            {{ $room->current_occupancy }} / {{ $room->capacity }}
                        </div>
                        <small style="color:#64748b;font-weight:400;">
                            {{ $room->capacity - $room->current_occupancy }} beds available
                        </small>
                    </div>
                    @if($room->current_occupancy > 0)
                        <div class="warning-box">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Warning:</strong> This room currently has <strong>{{ $room->current_occupancy }}</strong> student(s) assigned. 
                            Changing room type with lower capacity is not allowed.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Location Information -->
        <div class="form-section">
            <div class="section-title">
                <i class="fas fa-map-marker-alt"></i> Location Information
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="block" class="form-label">Block <span class="required-star">*</span></label>
                    <select class="form-control @error('block') is-invalid @enderror" id="block" name="block" required>
                        <option value="">Select Block</option>
                        <option value="A" {{ old('block', $room->block) == 'A' ? 'selected' : '' }}>Block A</option>
                        <option value="B" {{ old('block', $room->block) == 'B' ? 'selected' : '' }}>Block B</option>
                        <option value="C" {{ old('block', $room->block) == 'C' ? 'selected' : '' }}>Block C</option>
                        <option value="D" {{ old('block', $room->block) == 'D' ? 'selected' : '' }}>Block D</option>
                    </select>
                    @error('block')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="floor" class="form-label">Floor <span class="required-star">*</span></label>
                    <select class="form-control @error('floor') is-invalid @enderror" id="floor" name="floor" required>
                        <option value="">Select Floor</option>
                        <option value="Ground" {{ old('floor', $room->floor) == 'Ground' ? 'selected' : '' }}>Ground Floor</option>
                        <option value="1" {{ old('floor', $room->floor) == '1' ? 'selected' : '' }}>1st Floor</option>
                        <option value="2" {{ old('floor', $room->floor) == '2' ? 'selected' : '' }}>2nd Floor</option>
                        <option value="3" {{ old('floor', $room->floor) == '3' ? 'selected' : '' }}>3rd Floor</option>
                        <option value="4" {{ old('floor', $room->floor) == '4' ? 'selected' : '' }}>4th Floor</option>
                        <option value="5" {{ old('floor', $room->floor) == '5' ? 'selected' : '' }}>5th Floor</option>
                    </select>
                    @error('floor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Additional Notes -->
        <div class="form-section">
            <div class="section-title">
                <i class="fas fa-sticky-note"></i> Additional Notes
            </div>
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control @error('notes') is-invalid @enderror" 
                          id="notes" name="notes" rows="3" 
                          placeholder="Any additional notes about this room...">{{ old('notes', $room->notes) }}</textarea>
                @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Form Actions -->
        <div class="row mt-3">
            <div class="col-md-6 mb-2">
                <button type="submit" class="btn-submit" id="submitBtn">
                    <i class="fas fa-save"></i> Update Room
                </button>
            </div>
            <div class="col-md-6 mb-2">
                <a href="{{ route('room-allocation.index') }}" class="btn-cancel">
                    <i class="fas fa-arrow-left"></i> Cancel & Go Back
                </a>
            </div>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    console.log('✅ Edit Room page loaded');

    var currentOccupancy = {{ $room->current_occupancy }};

    // Auto-capitalize room number
    $('#room_number').on('blur', function() {
        $(this).val($(this).val().toUpperCase());
    });

    // Auto-set capacity based on room type (same as controller)
    $('#room_type').on('change', function() {
        var roomType = $(this).val();
        var capacity = 2;
        var capacityLabel = '2 Beds';
        
        if (roomType === 'double') {
            capacity = 2;
            capacityLabel = '2 Beds';
        } else if (roomType === 'triple') {
            capacity = 3;
            capacityLabel = '3 Beds';
        } else if (roomType === 'quad') {
            capacity = 4;
            capacityLabel = '4 Beds';
        }
        
        // Check if capacity is valid (not less than current occupancy)
        if (capacity < currentOccupancy) {
            alert('Cannot change to ' + roomType + ' room type (Capacity: ' + capacity + ') because current occupancy is ' + currentOccupancy + ' students.');
            $(this).val('{{ $room->room_type }}'); // Revert to previous value
            return;
        }
        
        // Update hidden capacity input
        $('#capacity').val(capacity);
        
        // Update display
        $('#capacityValue').text(capacity);
        $('#capacityDisplay').html('<i class="fas fa-bed"></i> <span id="capacityValue">' + capacity + '</span> ' + capacityLabel);
        
        console.log('Room type changed to: ' + roomType + ', Capacity set to: ' + capacity);
    });

    // Form submission validation
    $('#editRoomForm').on('submit', function(e) {
        var capacity = parseInt($('#capacity').val());
        var currentOccupancy = {{ $room->current_occupancy }};
        
        if (capacity < currentOccupancy) {
            e.preventDefault();
            alert('Cannot update: Capacity (' + capacity + ') is less than current occupancy (' + currentOccupancy + ' students).');
            return false;
        }
        
        console.log('Form submitted with capacity: ' + capacity);
        return true;
    });
});
</script>
@endpush