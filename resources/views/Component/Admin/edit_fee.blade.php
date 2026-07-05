@extends('Layout.admin')

@section('content')
<style>
    /* Page Header */
    .page-header {
        background: white;
        border-radius: 15px;
        padding: 20px 25px;
        margin-bottom: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }
    .page-header h4 {
        margin: 0;
        font-weight: 700;
        color: #2c3e50;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .page-header h4 i {
        color: #667eea;
    }
    .page-header .sub-title {
        color: #6c757d;
        font-size: 0.9rem;
        margin-top: 4px;
        font-weight: 400;
    }
    .btn-back {
        background: #f1f3f5;
        color: #495057;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
    }
    .btn-back:hover {
        background: #e9ecef;
        color: #2c3e50;
        text-decoration: none;
        transform: translateY(-2px);
    }
    .btn-back i {
        font-size: 1rem;
    }

    /* Status Badge in Header */
    .status-display {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        margin-top: 8px;
    }
    .status-display i {
        font-size: 0.9rem;
    }
    .status-display.paid { 
        background: #d4edda; 
        color: #155724; 
    }
    .status-display.unpaid { 
        background: #f8d7da; 
        color: #721c24; 
    }
    .status-display.partial { 
        background: #fff3cd; 
        color: #856404; 
    }

    /* Form Wrapper */
    .form-wrapper {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        max-width: 900px;
        margin: 0 auto;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .form-group label {
        font-weight: 600;
        font-size: 0.9rem;
        color: #2c3e50;
    }
    .form-group .required {
        color: #dc3545;
        margin-left: 2px;
    }
    .form-control {
        padding: 10px 14px;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
        color: #333;
        width: 100%;
    }
    .form-control:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
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
        font-size: 0.8rem;
        margin-top: 4px;
    }
    textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }
    select.form-control {
        appearance: auto;
        cursor: pointer;
    }

    /* Amount Display */
    .amount-display {
        padding: 10px 14px;
        border-radius: 10px;
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        font-weight: 600;
        font-size: 0.95rem;
        color: #0B2E33;
    }
    .amount-display.paid-amount {
        color: #28a745;
        border-color: #28a745;
        background: #d4edda20;
    }
    .amount-display.pending-amount {
        color: #dc3545;
        border-color: #dc3545;
        background: #f8d7da20;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
        justify-content: flex-end;
    }
    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 10px 30px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        color: white;
    }
    .btn-submit i {
        font-size: 1rem;
    }
    .btn-cancel {
        background: #f1f3f5;
        color: #495057;
        border: none;
        padding: 10px 25px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-cancel:hover {
        background: #e9ecef;
        color: #2c3e50;
        text-decoration: none;
    }

    /* Info Box */
    .info-box {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 15px 20px;
        margin-bottom: 20px;
        border-left: 4px solid #667eea;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    .info-box .info-label {
        font-weight: 600;
        color: #6c757d;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .info-box .info-value {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.1rem;
    }
    .info-box .info-value.paid {
        color: #28a745;
    }
    .info-box .info-value.pending {
        color: #dc3545;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        .page-header .btn-back {
            width: 100%;
            justify-content: center;
        }
        .form-row {
            grid-template-columns: 1fr;
            gap: 16px;
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
            padding: 15px;
        }
        .page-header h4 {
            font-size: 1.1rem;
        }
        .form-control {
            font-size: 0.85rem;
            padding: 8px 12px;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div>
        <h4>
            <i class="fas fa-edit"></i>
            Edit Fee Record
        </h4>
        <div class="sub-title">Update student fee payment details</div>
        @if(isset($feeRecord))
        <div class="status-display {{ $feeRecord->fee_status }}">
            <i class="fas fa-{{ $feeRecord->fee_status == 'paid' ? 'check-circle' : ($feeRecord->fee_status == 'unpaid' ? 'times-circle' : 'clock') }}"></i>
            Current Status: {{ ucfirst($feeRecord->fee_status) }}
        </div>
        @endif
    </div>
    <a href="{{ route('fee_record') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Back to List
    </a>
</div>

<!-- Form -->
<div class="form-wrapper">
    <!-- Info Box -->
    @if(isset($feeRecord))
    <div class="info-box">
        <div>
            <span class="info-label">Record ID</span>
            <div class="info-value">#{{ $feeRecord->id }}</div>
        </div>
        <div>
            <span class="info-label">Total Fee</span>
            <div class="info-value">PKR {{ number_format($feeRecord->fee_amount, 2) }}</div>
        </div>
        <div>
            <span class="info-label">Paid Amount</span>
            <div class="info-value paid">PKR {{ number_format($feeRecord->paid_amount, 2) }}</div>
        </div>
        <div>
            <span class="info-label">Pending Amount</span>
            <div class="info-value pending">PKR {{ number_format($feeRecord->pending_amount, 2) }}</div>
        </div>
        <div>
            <span class="info-label">Created</span>
            <div class="info-value">{{ $feeRecord->created_at->format('d M Y') }}</div>
        </div>
    </div>
    @endif

    <form id="feeForm" action="{{ route('fee-records.update', $feeRecord->id ?? 0) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-row">
            <div class="form-group">
                <label for="student_name">Student Name <span class="required">*</span></label>
                <input type="text" class="form-control @error('student_name') is-invalid @enderror" 
                       id="student_name" name="student_name" value="{{ old('student_name', $feeRecord->student_name ?? '') }}" 
                       placeholder="Enter student name" required>
                @error('student_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="room_no">Room Number <span class="required">*</span></label>
                <input type="text" class="form-control @error('room_no') is-invalid @enderror" 
                       id="room_no" name="room_no" value="{{ old('room_no', $feeRecord->room_no ?? '') }}" 
                       placeholder="e.g. A-101" required>
                @error('room_no')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="phone_number">Phone Number <span class="required">*</span></label>
                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" 
                       id="phone_number" name="phone_number" value="{{ old('phone_number', $feeRecord->phone_number ?? '') }}" 
                       placeholder="e.g. 03XX-XXXXXXX" required>
                @error('phone_number')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="fee_amount">Fee Amount (PKR) <span class="required">*</span></label>
                <input type="number" step="0.01" class="form-control @error('fee_amount') is-invalid @enderror" 
                       id="fee_amount" name="fee_amount" value="{{ old('fee_amount', $feeRecord->fee_amount ?? '') }}" 
                       placeholder="Enter fee amount" required>
                @error('fee_amount')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="paid_amount">Paid Amount (PKR)</label>
                <input type="number" step="0.01" class="form-control @error('paid_amount') is-invalid @enderror" 
                       id="paid_amount" name="paid_amount" value="{{ old('paid_amount', $feeRecord->paid_amount ?? 0) }}" 
                       placeholder="Enter paid amount">
                @error('paid_amount')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <select class="form-control @error('payment_method') is-invalid @enderror" 
                        id="payment_method" name="payment_method">
                    <option value="">Select Method</option>
                    <option value="cash" {{ old('payment_method', $feeRecord->payment_method ?? '') == 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="bank_transfer" {{ old('payment_method', $feeRecord->payment_method ?? '') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                    <option value="easypaisa" {{ old('payment_method', $feeRecord->payment_method ?? '') == 'easypaisa' ? 'selected' : '' }}>Easypaisa</option>
                    <option value="jazzcash" {{ old('payment_method', $feeRecord->payment_method ?? '') == 'jazzcash' ? 'selected' : '' }}>JazzCash</option>
                </select>
                @error('payment_method')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="payment_date">Payment Date</label>
                <input type="date" class="form-control @error('payment_date') is-invalid @enderror" 
                       id="payment_date" name="payment_date" value="{{ old('payment_date', $feeRecord->payment_date ?? '') }}">
                @error('payment_date')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="fee_status">Fee Status</label>
                <select class="form-control @error('fee_status') is-invalid @enderror" 
                        id="fee_status" name="fee_status">
                    <option value="unpaid" {{ old('fee_status', $feeRecord->fee_status ?? '') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    <option value="paid" {{ old('fee_status', $feeRecord->fee_status ?? '') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="partial" {{ old('fee_status', $feeRecord->fee_status ?? '') == 'partial' ? 'selected' : '' }}>Partial</option>
                </select>
                @error('fee_status')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group" style="grid-column: 1 / -1;">
                <label for="remarks">Remarks</label>
                <textarea class="form-control @error('remarks') is-invalid @enderror" 
                          id="remarks" name="remarks" rows="3" 
                          placeholder="Any additional notes...">{{ old('remarks', $feeRecord->remarks ?? '') }}</textarea>
                @error('remarks')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('fee_record') }}" class="btn-cancel">
                <i class="fas fa-times"></i> Cancel
            </a>
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Update Record
            </button>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Auto-calculate and validate
    $('#fee_amount, #paid_amount').on('input', function() {
        const fee = parseFloat($('#fee_amount').val()) || 0;
        const paid = parseFloat($('#paid_amount').val()) || 0;
        
        if (paid > fee && fee > 0) {
            $('#paid_amount').val(fee);
            alert('Paid amount cannot exceed fee amount');
        }
    });

    // Form validation
    $('#feeForm').on('submit', function(e) {
        const fee = parseFloat($('#fee_amount').val()) || 0;
        const paid = parseFloat($('#paid_amount').val()) || 0;
        
        if (paid > fee) {
            e.preventDefault();
            alert('Paid amount cannot exceed fee amount');
            $('#paid_amount').focus();
        }
    });

    // Status change warning
    $('#fee_status').on('change', function() {
        const status = $(this).val();
        const currentStatus = '{{ $feeRecord->fee_status ?? '' }}';
        if (status !== currentStatus && currentStatus) {
            if (!confirm('Are you sure you want to change the status from "' + 
                currentStatus.charAt(0).toUpperCase() + currentStatus.slice(1) + 
                '" to "' + status.charAt(0).toUpperCase() + status.slice(1) + '"?')) {
                $(this).val(currentStatus);
            }
        }
    });
});
</script>
@endpush