@extends('Layout.admin')

@section('content')
<style>
    .receipt-container {
        max-width: 600px;
        margin: 0 auto;
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        border: 1px solid #f0f2f5;
    }
    .receipt-header {
        text-align: center;
        border-bottom: 2px dashed #e9ecef;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }
    .receipt-header .icon {
        font-size: 3rem;
        color: #10B981;
        margin-bottom: 10px;
    }
    .receipt-header h4 {
        color: #0b1a33;
        font-weight: 700;
        margin-bottom: 5px;
    }
    .receipt-header .sub-title {
        color: #94a3b8;
        font-size: 0.9rem;
    }
    .receipt-body .info-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f1f3f5;
    }
    .receipt-body .info-row:last-child {
        border-bottom: none;
    }
    .receipt-body .label {
        color: #64748b;
        font-weight: 500;
    }
    .receipt-body .value {
        font-weight: 600;
        color: #0b1a33;
    }
    .receipt-body .value.amount {
        color: #4F46E5;
        font-size: 1.2rem;
    }
    .receipt-body .value.paid {
        color: #10B981;
    }
    .receipt-body .value.pending {
        color: #EF4444;
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
    .receipt-footer {
        text-align: center;
        padding-top: 20px;
        border-top: 2px dashed #e9ecef;
        margin-top: 20px;
    }
    .receipt-footer .btn-print {
        background: linear-gradient(135deg, #4F46E5 0%, #4338CA 100%);
        color: white !important;
        border: none;
        padding: 10px 30px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .receipt-footer .btn-print:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(79, 70, 229, 0.35);
        color: white !important;
    }
    .receipt-footer .btn-back {
        background: #f1f3f5;
        color: #495057 !important;
        border: none;
        padding: 10px 30px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-block;
    }
    .receipt-footer .btn-back:hover {
        background: #e9ecef;
        color: #2c3e50 !important;
        text-decoration: none;
    }
</style>

<div class="receipt-container" id="receipt">
    <div class="receipt-header">
        <div class="icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h4>Payment Receipt</h4>
        <div class="sub-title">Fee payment confirmed successfully</div>
    </div>

    <div class="receipt-body">
        <div class="info-row">
            <span class="label">Receipt #</span>
            <span class="value">#{{ str_pad($feeRecord->id, 6, '0', STR_PAD_LEFT) }}</span>
        </div>
        <div class="info-row">
            <span class="label">Date</span>
            <span class="value">{{ $feeRecord->payment_date ? date('d-m-Y h:i A', strtotime($feeRecord->payment_date)) : now()->format('d-m-Y h:i A') }}</span>
        </div>
        <div class="info-row">
            <span class="label">Student Name</span>
            <span class="value">{{ $feeRecord->student_name }}</span>
        </div>
        <div class="info-row">
            <span class="label">Room No</span>
            <span class="value">{{ $feeRecord->room_no ?? 'N/A' }}</span>
        </div>
        <div class="info-row">
            <span class="label">Phone</span>
            <span class="value">{{ $feeRecord->phone_number }}</span>
        </div>
        <div class="info-row">
            <span class="label">Total Fee</span>
            <span class="value amount">PKR {{ number_format($feeRecord->fee_amount, 2) }}</span>
        </div>
        <div class="info-row">
            <span class="label">Amount Paid</span>
            <span class="value paid">PKR {{ number_format($feeRecord->paid_amount, 2) }}</span>
        </div>
        <div class="info-row">
            <span class="label">Pending Amount</span>
            <span class="value pending">PKR {{ number_format($feeRecord->pending_amount, 2) }}</span>
        </div>
        <div class="info-row">
            <span class="label">Payment Method</span>
            <span class="value">{{ ucfirst($feeRecord->payment_method ?? 'Cash') }}</span>
        </div>
        <div class="info-row">
            <span class="label">Status</span>
            <span class="value">
                <span class="status-badge status-{{ $feeRecord->fee_status }}">
                    {{ ucfirst($feeRecord->fee_status) }}
                </span>
            </span>
        </div>
        @if($feeRecord->remarks)
        <div class="info-row">
            <span class="label">Remarks</span>
            <span class="value">{{ $feeRecord->remarks }}</span>
        </div>
        @endif
    </div>

    <div class="receipt-footer">
        <div class="d-flex gap-2 justify-content-center flex-wrap">
            <button onclick="window.print()" class="btn-print">
                <i class="fas fa-print"></i> Print Receipt
            </button>
            <a href="{{ route('fee_record') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Back to Fee Records
            </a>
        </div>
        <div class="mt-3 text-muted">
            <small>Thank you for your payment!</small>
        </div>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert" style="max-width:600px;margin:20px auto 0;">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert" style="max-width:600px;margin:20px auto 0;">
    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@endsection