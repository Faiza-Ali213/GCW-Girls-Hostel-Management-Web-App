@extends('Layout.admin')

@section('content')
<style>
    .payment-container {
        max-width: 600px;
        margin: 0 auto;
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        border: 1px solid #f0f2f5;
    }
    .payment-container h4 {
        color: #0b1a33;
        font-weight: 700;
        margin-bottom: 5px;
    }
    .payment-container .sub-title {
        color: #94a3b8;
        font-size: 0.95rem;
        margin-bottom: 20px;
    }
    .student-info-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 18px 22px;
        margin-bottom: 20px;
        border: 1px solid #eef2f6;
    }
    .student-info-card .label {
        color: #94a3b8;
        font-size: 0.75rem;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .student-info-card .value {
        font-weight: 600;
        color: #0b1a33;
        font-size: 1.05rem;
    }
    .fee-amount-display {
        background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        margin-bottom: 20px;
        border: 2px solid #4F46E5;
    }
    .fee-amount-display .amount {
        font-size: 2.2rem;
        font-weight: 700;
        color: #4F46E5;
    }
    .fee-amount-display .label {
        color: #64748b;
        font-size: 0.85rem;
        font-weight: 500;
    }
    .payment-details {
        background: #f8fafc;
        border-radius: 12px;
        padding: 15px 20px;
        margin: 15px 0;
        border: 1px solid #eef2f6;
    }
    .payment-details .row-item {
        display: flex;
        justify-content: space-between;
        padding: 6px 0;
        border-bottom: 1px solid #e9ecef;
    }
    .payment-details .row-item:last-child {
        border-bottom: none;
    }
    .payment-details .label {
        color: #64748b;
        font-weight: 500;
    }
    .payment-details .value {
        font-weight: 600;
        color: #0b1a33;
    }
    .payment-details .value.paid {
        color: #10B981;
    }
    .payment-details .value.pending {
        color: #EF4444;
    }
    .payment-details .value.partial {
        color: #F59E0B;
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
    .btn-back {
        background: #f1f3f5;
        color: #495057 !important;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        width: 100%;
        transition: all 0.2s ease;
        margin-bottom: 10px;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }
    .btn-back:hover {
        background: #e9ecef;
        color: #2c3e50 !important;
        text-decoration: none;
    }
    .status-badge {
        padding: 4px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }
    .status-paid { background: #ECFDF5; color: #10B981; }
    .status-pending { background: #FEF3C7; color: #F59E0B; }
    .status-partial { background: #FFFBEB; color: #F59E0B; }
</style>

<div class="payment-container">
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h4><i class="fas fa-hand-holding-usd text-primary"></i> Record Fee Payment</h4>
            <div class="sub-title">Enter the payment amount for this student</div>
        </div>
        <span class="status-badge status-{{ $feeRecord->fee_status }}">
            {{ ucfirst($feeRecord->fee_status) }}
        </span>
    </div>

    <!-- Student Info -->
    <div class="student-info-card">
        <div class="row">
            <div class="col-6">
                <div class="label">Student Name</div>
                <div class="value">{{ $feeRecord->student_name }}</div>
            </div>
            <div class="col-6">
                <div class="label">Room No</div>
                <div class="value">{{ $feeRecord->room_no ?? 'N/A' }}</div>
            </div>
            <div class="col-6 mt-2">
                <div class="label">Phone</div>
                <div class="value">{{ $feeRecord->phone_number }}</div>
            </div>
            <div class="col-6 mt-2">
                <div class="label">Total Fee</div>
                <div class="value">PKR {{ number_format($feeRecord->fee_amount, 2) }}</div>
            </div>
        </div>
    </div>

    <!-- Fee Amount Display -->
    <div class="fee-amount-display">
        <div class="label">Total Fee Amount</div>
        <div class="amount">PKR {{ number_format($feeRecord->fee_amount, 2) }}</div>
    </div>

    <!-- Payment Details -->
    <div class="payment-details">
        <div class="row-item">
            <span class="label">Already Paid</span>
            <span class="value paid">PKR {{ number_format($feeRecord->paid_amount, 2) }}</span>
        </div>
        <div class="row-item">
            <span class="label">Pending Amount</span>
            <span class="value pending">PKR {{ number_format($feeRecord->pending_amount, 2) }}</span>
        </div>
        <div class="row-item">
            <span class="label">Current Status</span>
            <span class="value partial">{{ ucfirst($feeRecord->fee_status) }}</span>
        </div>
    </div>

    <!-- Payment Form -->
    <form action="{{ route('fee-record.process-payment', $feeRecord->id) }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="paid_amount" class="form-label fw-bold">Enter Payment Amount <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('paid_amount') is-invalid @enderror" 
                   id="paid_amount" name="paid_amount" 
                   placeholder="Enter amount to pay" 
                   min="1" 
                   max="{{ $feeRecord->pending_amount }}"
                   step="0.01" 
                   value="{{ old('paid_amount') }}"
                   required>
            <small class="text-muted">Max amount: PKR {{ number_format($feeRecord->pending_amount, 2) }}</small>
            @error('paid_amount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="payment_method" class="form-label fw-bold">Payment Method</label>
            <select class="form-control @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method">
                <option value="cash" {{ old('payment_method', 'cash') == 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                <option value="easypaisa" {{ old('payment_method') == 'easypaisa' ? 'selected' : '' }}>EasyPaisa</option>
                <option value="jazzcash" {{ old('payment_method') == 'jazzcash' ? 'selected' : '' }}>JazzCash</option>
                <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                <option value="other" {{ old('payment_method') == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('payment_method')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="remarks" class="form-label fw-bold">Remarks</label>
            <textarea class="form-control @error('remarks') is-invalid @enderror" 
                      id="remarks" name="remarks" rows="2" 
                      placeholder="Any additional notes...">{{ old('remarks') }}</textarea>
            @error('remarks')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn-submit">
                <i class="fas fa-check-circle"></i> Process Payment
            </button>
            <a href="{{ route('fee_record') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Cancel & Go Back
            </a>
        </div>
    </form>
</div>
@endsection