@extends('Layout.admin')

@section('content')
<style>
    /* Page Header */
    .page-header {
        background: white;
        border-radius: 12px;
        padding: 18px 24px;
        margin-bottom: 25px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        border-bottom: 2px solid #f0f0f0;
    }
    .page-header h4 {
        margin: 0;
        font-weight: 600;
        color: #1a1a1a;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.2rem;
    }
    .page-header h4 i {
        color: #0B2E33;
    }
    .page-header .sub-title {
        color: #888;
        font-size: 0.85rem;
        margin-top: 2px;
        font-weight: 400;
    }
    .btn-back {
        background: #f5f5f5;
        color: #333;
        border: 1px solid #e0e0e0;
        padding: 8px 18px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.85rem;
    }
    .btn-back:hover {
        background: #e8e8e8;
        color: #1a1a1a;
        text-decoration: none;
    }

    /* Status Badge in Header */
    .status-badge-simple {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 14px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.8rem;
        margin-top: 6px;
    }
    .status-badge-simple.active { 
        background: #e8f5e9; 
        color: #2e7d32; 
    }
    .status-badge-simple.checked_out { 
        background: #f5f5f5; 
        color: #888; 
    }

    /* Form Wrapper */
    .form-wrapper {
        background: white;
        border-radius: 12px;
        padding: 28px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        max-width: 900px;
        margin: 0 auto;
        border: 1px solid #f0f0f0;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-bottom: 18px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    .form-group label {
        font-weight: 500;
        font-size: 0.85rem;
        color: #333;
    }
    .form-group .required {
        color: #dc3545;
        margin-left: 2px;
    }
    .form-control {
        padding: 8px 12px;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        background: #fafafa;
        color: #333;
        width: 100%;
    }
    .form-control:focus {
        outline: none;
        border-color: #0B2E33;
        background: white;
        box-shadow: 0 0 0 3px rgba(11, 46, 51, 0.06);
    }
    .form-control.is-invalid {
        border-color: #dc3545;
    }
    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }
    .form-control[readonly] {
        background: #e9ecef;
        cursor: not-allowed;
    }
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.78rem;
        margin-top: 3px;
    }
    textarea.form-control {
        resize: vertical;
        min-height: 70px;
    }
    select.form-control {
        appearance: auto;
        cursor: pointer;
    }

    /* Info Box */
    .info-box {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 14px 18px;
        margin-bottom: 20px;
        border-left: 3px solid #0B2E33;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .info-box i {
        color: #0B2E33;
        font-size: 1.1rem;
    }
    .info-box .info-text {
        font-size: 0.85rem;
        color: #666;
    }
    .info-box .info-text strong {
        color: #1a1a1a;
    }
    .info-box .info-text .highlight {
        color: #0B2E33;
        font-weight: 600;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 22px;
        padding-top: 18px;
        border-top: 2px solid #f5f5f5;
        justify-content: flex-end;
    }
    .btn-submit {
        background: #0B2E33;
        color: white;
        border: none;
        padding: 9px 28px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-submit:hover {
        background: #1a4a52;
        color: white;
    }
    .btn-submit i {
        font-size: 0.9rem;
    }
    .btn-cancel {
        background: #f5f5f5;
        color: #333;
        border: 1px solid #e0e0e0;
        padding: 9px 22px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-cancel:hover {
        background: #e8e8e8;
        color: #1a1a1a;
        text-decoration: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
        .page-header .btn-back {
            width: 100%;
            justify-content: center;
        }
        .form-row {
            grid-template-columns: 1fr;
            gap: 14px;
        }
        .form-wrapper {
            padding: 20px;
        }
        .form-actions {
            flex-direction: column;
        }
        .form-actions .btn-submit,
        .form-actions .btn-cancel {
            width: 100%;
            justify-content: center;
        }
        .info-box {
            flex-direction: column;
            align-items: flex-start;
        }
    }
    @media (max-width: 576px) {
        .form-wrapper {
            padding: 16px;
        }
        .page-header h4 {
            font-size: 1rem;
        }
        .form-control {
            font-size: 0.85rem;
            padding: 7px 10px;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div>
        <h4>
            <i class="fas fa-user-edit"></i>
            Edit Visitor
        </h4>
        <div class="sub-title">Update visitor information</div>
        @if(isset($visitor))
        <div class="status-badge-simple {{ $visitor->status }}">
            <i class="fas fa-{{ $visitor->status == 'active' ? 'circle' : 'check-circle' }}"></i>
            Current Status: {{ $visitor->status == 'active' ? 'Active' : 'Checked Out' }}
        </div>
        @endif
    </div>
    <a href="{{ route('visitors_records') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Back to List
    </a>
</div>

<!-- Form -->
<div class="form-wrapper">
    <!-- Info Box -->
    @if(isset($visitor))
    <div class="info-box">
        <i class="fas fa-info-circle"></i>
        <div class="info-text">
            <strong>Record ID:</strong> #{{ $visitor->id }} &nbsp;|&nbsp;
            <strong>Check In:</strong> {{ $visitor->check_in_time->format('d M Y, h:i A') }} &nbsp;|&nbsp;
            <strong>Status:</strong> 
            <span class="highlight">{{ $visitor->status == 'active' ? 'Active' : 'Checked Out' }}</span>
            @if($visitor->status == 'active')
                <span style="color:#999;font-size:0.8rem;">(Check out to mark as completed)</span>
            @endif
        </div>
    </div>
    @endif

    <form id="visitorForm" action="{{ route('visitor.update', $visitor->id ?? 0) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-row">
            <div class="form-group">
                <label for="visitor_name">Visitor Name <span class="required">*</span></label>
                <input type="text" class="form-control @error('visitor_name') is-invalid @enderror" 
                       id="visitor_name" name="visitor_name" value="{{ old('visitor_name', $visitor->visitor_name ?? '') }}" 
                       placeholder="Enter visitor full name" required>
                @error('visitor_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number <span class="required">*</span></label>
                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" 
                       id="phone_number" name="phone_number" value="{{ old('phone_number', $visitor->phone_number ?? '') }}" 
                       placeholder="e.g. 03XX-XXXXXXX" required>
                @error('phone_number')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email', $visitor->email ?? '') }}" 
                       placeholder="Enter email address">
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="id_card_number">ID Card Number</label>
                <input type="text" class="form-control @error('id_card_number') is-invalid @enderror" 
                       id="id_card_number" name="id_card_number" value="{{ old('id_card_number', $visitor->id_card_number ?? '') }}" 
                       placeholder="Enter ID card number">
                @error('id_card_number')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="purpose_of_visit">Purpose of Visit <span class="required">*</span></label>
                <select class="form-control @error('purpose_of_visit') is-invalid @enderror" 
                        id="purpose_of_visit" name="purpose_of_visit" required>
                    <option value="">Select Purpose</option>
                    <option value="Meeting" {{ old('purpose_of_visit', $visitor->purpose_of_visit ?? '') == 'Meeting' ? 'selected' : '' }}>Meeting</option>
                    <option value="Visit Student" {{ old('purpose_of_visit', $visitor->purpose_of_visit ?? '') == 'Visit Student' ? 'selected' : '' }}>Visit Student</option>
                    <option value="Delivery" {{ old('purpose_of_visit', $visitor->purpose_of_visit ?? '') == 'Delivery' ? 'selected' : '' }}>Delivery</option>
                    <option value="Maintenance" {{ old('purpose_of_visit', $visitor->purpose_of_visit ?? '') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="Interview" {{ old('purpose_of_visit', $visitor->purpose_of_visit ?? '') == 'Interview' ? 'selected' : '' }}>Interview</option>
                    <option value="Other" {{ old('purpose_of_visit', $visitor->purpose_of_visit ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('purpose_of_visit')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="room_no">Room Number</label>
                <input type="text" class="form-control @error('room_no') is-invalid @enderror" 
                       id="room_no" name="room_no" value="{{ old('room_no', $visitor->room_no ?? '') }}" 
                       placeholder="e.g. A-101">
                @error('room_no')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="student_name">Student Name (if visiting student)</label>
                <input type="text" class="form-control @error('student_name') is-invalid @enderror" 
                       id="student_name" name="student_name" value="{{ old('student_name', $visitor->student_name ?? '') }}" 
                       placeholder="Enter student name">
                @error('student_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="student_room">Student Room Number</label>
                <input type="text" class="form-control @error('student_room') is-invalid @enderror" 
                       id="student_room" name="student_room" value="{{ old('student_room', $visitor->student_room ?? '') }}" 
                       placeholder="e.g. B-204">
                @error('student_room')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="check_in_time">Check-in Time</label>
                <input type="datetime-local" class="form-control @error('check_in_time') is-invalid @enderror" 
                       id="check_in_time" name="check_in_time" value="{{ old('check_in_time', isset($visitor) ? $visitor->check_in_time->format('Y-m-d\TH:i') : '') }}">
                @error('check_in_time')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control @error('status') is-invalid @enderror" 
                        id="status" name="status">
                    <option value="active" {{ old('status', $visitor->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="checked_out" {{ old('status', $visitor->status ?? '') == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                </select>
                @error('status')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group" style="grid-column: 1 / -1;">
                <label for="remarks">Remarks</label>
                <textarea class="form-control @error('remarks') is-invalid @enderror" 
                          id="remarks" name="remarks" rows="3" 
                          placeholder="Any additional notes...">{{ old('remarks', $visitor->remarks ?? '') }}</textarea>
                @error('remarks')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('visitors_records') }}" class="btn-cancel">
                <i class="fas fa-times"></i> Cancel
            </a>
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Update Visitor
            </button>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Form validation
        $('#visitorForm').on('submit', function(e) {
            const phone = $('#phone_number').val();
            const phoneRegex = /^[0-9+\-\s()]{7,15}$/;
            if (phone && !phoneRegex.test(phone)) {
                e.preventDefault();
                alert('Please enter a valid phone number');
                $('#phone_number').focus();
            }
        });

        // Status change warning
        $('#status').on('change', function() {
            const status = $(this).val();
            const currentStatus = '{{ $visitor->status ?? '' }}';
            if (status !== currentStatus && currentStatus) {
                if (status === 'checked_out') {
                    if (!confirm('Are you sure you want to check out this visitor?\n\nThis will mark the visitor as checked out and set the checkout time.')) {
                        $(this).val(currentStatus);
                    }
                }
            }
        });

        // Purpose selection helper
        $('#purpose_of_visit').on('change', function() {
            const purpose = $(this).val();
            if (purpose === 'Visit Student') {
                // Optionally show/hide student fields
            }
        });
    });
</script>
@endpush