@extends('Layout.admin')

@section('content')
<style>
    /* Page Header - Minimal */
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
    .page-header .action-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
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
    .btn-edit-page {
        background: #0B2E33;
        color: white;
        border: none;
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
    .btn-edit-page:hover {
        background: #1a4a52;
        color: white;
        text-decoration: none;
    }

    /* Status Badge - Simple */
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
    .status-badge-simple.paid { 
        background: #e8f5e9; 
        color: #2e7d32; 
    }
    .status-badge-simple.unpaid { 
        background: #fce4ec; 
        color: #c62828; 
    }
    .status-badge-simple.partial { 
        background: #fff8e1; 
        color: #f57f17; 
    }

    /* Detail Wrapper */
    .detail-wrapper {
        background: white;
        border-radius: 12px;
        padding: 28px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        max-width: 900px;
        margin: 0 auto;
        border: 1px solid #f0f0f0;
    }

    /* Student Header - Simple */
    .student-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f5f5f5;
    }
    .student-avatar {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #0B2E33;
        color: white;
        font-weight: 600;
        font-size: 20px;
        flex-shrink: 0;
    }
    .student-name-large {
        font-size: 1.3rem;
        font-weight: 600;
        color: #1a1a1a;
    }
    .student-detail {
        color: #777;
        font-size: 0.9rem;
    }
    .student-detail i {
        margin-right: 4px;
        color: #999;
    }
    .student-detail .sep {
        margin: 0 10px;
        color: #ddd;
    }
    .room-tag {
        display: inline-block;
        padding: 2px 10px;
        background: #f5f5f5;
        border-radius: 4px;
        font-size: 13px;
        color: #333;
        font-weight: 500;
    }

    /* Info Grid - Clean */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 20px;
    }
    .info-item {
        background: #fafafa;
        border-radius: 10px;
        padding: 14px 18px;
        border: 1px solid #f0f0f0;
        transition: all 0.2s ease;
    }
    .info-item:hover {
        background: #f5f5f5;
    }
    .info-item .label {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #999;
        margin-bottom: 4px;
    }
    .info-item .value {
        font-size: 1.05rem;
        font-weight: 600;
        color: #1a1a1a;
    }
    .info-item .value .currency {
        color: #888;
        font-weight: 400;
    }
    .info-item .value.paid-text {
        color: #2e7d32;
    }
    .info-item .value.pending-text {
        color: #c62828;
    }

    /* Status Tag in Info */
    .status-tag {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: capitalize;
    }
    .status-tag.paid { background: #e8f5e9; color: #2e7d32; }
    .status-tag.unpaid { background: #fce4ec; color: #c62828; }
    .status-tag.partial { background: #fff8e1; color: #f57f17; }
    .status-tag i {
        font-size: 0.65rem;
    }

    /* Payment Details - Clean */
    .payment-details {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #f5f5f5;
    }
    .payment-details .section-title {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #999;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .payment-details .section-title i {
        color: #0B2E33;
    }
    .meta-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }
    .meta-item {
        background: #fafafa;
        border-radius: 8px;
        padding: 10px 14px;
        border: 1px solid #f0f0f0;
    }
    .meta-item .meta-label {
        font-size: 0.65rem;
        text-transform: uppercase;
        color: #aaa;
        letter-spacing: 0.3px;
    }
    .meta-item .meta-value {
        font-size: 0.9rem;
        font-weight: 500;
        color: #1a1a1a;
        margin-top: 2px;
    }

    /* Remarks - Clean */
    .remarks-section {
        background: #fafafa;
        border-radius: 10px;
        padding: 16px 20px;
        margin-top: 20px;
        border: 1px solid #f0f0f0;
    }
    .remarks-section .remarks-label {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #999;
        margin-bottom: 4px;
    }
    .remarks-section .remarks-text {
        font-size: 0.95rem;
        color: #1a1a1a;
        line-height: 1.6;
    }
    .remarks-section .remarks-text.empty {
        color: #bbb;
        font-style: italic;
    }

    /* Not Found */
    .not-found {
        text-align: center;
        padding: 40px 20px;
    }
    .not-found i {
        font-size: 3.5rem;
        color: #ddd;
        margin-bottom: 15px;
    }
    .not-found h5 {
        color: #888;
        margin-bottom: 6px;
        font-weight: 500;
    }
    .not-found p {
        color: #aaa;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .info-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .meta-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
        .page-header .action-buttons {
            width: 100%;
        }
        .page-header .action-buttons .btn-back,
        .page-header .action-buttons .btn-edit-page {
            flex: 1;
            justify-content: center;
        }
        .detail-wrapper {
            padding: 20px;
        }
        .student-header {
            flex-direction: column;
            text-align: center;
        }
        .student-avatar {
            width: 48px;
            height: 48px;
            font-size: 18px;
        }
        .student-name-large {
            font-size: 1.1rem;
        }
        .info-grid {
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .meta-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
    @media (max-width: 576px) {
        .detail-wrapper {
            padding: 16px;
        }
        .page-header h4 {
            font-size: 1rem;
        }
        .info-grid {
            grid-template-columns: 1fr;
        }
        .meta-grid {
            grid-template-columns: 1fr 1fr;
        }
        .info-item {
            padding: 12px 14px;
        }
        .info-item .value {
            font-size: 0.95rem;
        }
        .page-header .action-buttons {
            flex-direction: column;
        }
        .page-header .action-buttons .btn-back,
        .page-header .action-buttons .btn-edit-page {
            width: 100%;
        }
        .student-detail .sep {
            margin: 0 6px;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div>
        <h4>
            <i class="fas fa-file-invoice"></i>
            Fee Record Details
        </h4>
        <div class="sub-title">View complete fee payment information</div>
        @if(isset($feeRecord))
        <div class="status-badge-simple {{ $feeRecord->fee_status }}">
            <i class="fas fa-{{ $feeRecord->fee_status == 'paid' ? 'check-circle' : ($feeRecord->fee_status == 'unpaid' ? 'times-circle' : 'clock') }}"></i>
            {{ ucfirst($feeRecord->fee_status) }}
        </div>
        @endif
    </div>
    <div class="action-buttons">
        @if(isset($feeRecord))
        <a href="{{ route('fee-record.edit', $feeRecord->id) }}" class="btn-edit-page">
            <i class="fas fa-edit"></i> Edit
        </a>
        @endif
        <a href="{{ route('fee_record') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<!-- Detail View -->
<div class="detail-wrapper">
    @if(isset($feeRecord))
    
    <!-- Student Header -->
    <div class="student-header">
        <div class="student-avatar">
            {{ substr($feeRecord->student_name, 0, 2) }}
        </div>
        <div>
            <div class="student-name-large">{{ $feeRecord->student_name }}</div>
            <div class="student-detail">
                <i class="fas fa-phone"></i> {{ $feeRecord->phone_number }}
                <span class="sep">|</span>
                <i class="fas fa-door-open"></i> Room <span class="room-tag">{{ $feeRecord->room_no }}</span>
            </div>
        </div>
    </div>

    <!-- Info Grid -->
    <div class="info-grid">
        <div class="info-item">
            <div class="label"><i class="fas fa-money-bill-wave"></i> Fee Amount</div>
            <div class="value"><span class="currency">PKR</span> {{ number_format($feeRecord->fee_amount, 2) }}</div>
        </div>
        <div class="info-item">
            <div class="label"><i class="fas fa-check-circle"></i> Paid Amount</div>
            <div class="value paid-text"><span class="currency">PKR</span> {{ number_format($feeRecord->paid_amount, 2) }}</div>
        </div>
        <div class="info-item">
            <div class="label"><i class="fas fa-clock"></i> Pending Amount</div>
            <div class="value pending-text"><span class="currency">PKR</span> {{ number_format($feeRecord->pending_amount, 2) }}</div>
        </div>
        <div class="info-item">
            <div class="label"><i class="fas fa-tag"></i> Status</div>
            <div class="value">
                <span class="status-tag {{ $feeRecord->fee_status }}">
                    @if($feeRecord->fee_status == 'paid')
                        <i class="fas fa-check-circle"></i>
                    @elseif($feeRecord->fee_status == 'unpaid')
                        <i class="fas fa-times-circle"></i>
                    @else
                        <i class="fas fa-clock"></i>
                    @endif
                    {{ ucfirst($feeRecord->fee_status) }}
                </span>
            </div>
        </div>
        <div class="info-item">
            <div class="label"><i class="fas fa-credit-card"></i> Payment Method</div>
            <div class="value">
                @if($feeRecord->payment_method)
                    {{ ucfirst(str_replace('_', ' ', $feeRecord->payment_method)) }}
                @else
                    <span style="color: #bbb; font-weight: 400;">Not specified</span>
                @endif
            </div>
        </div>
        <div class="info-item">
            <div class="label"><i class="fas fa-calendar-alt"></i> Payment Date</div>
            <div class="value">
                @if($feeRecord->payment_date)
                    {{ date('d M Y', strtotime($feeRecord->payment_date)) }}
                @else
                    <span style="color: #bbb; font-weight: 400;">Not paid yet</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Payment Details -->
    <div class="payment-details">
        <div class="section-title">
            <i class="fas fa-receipt"></i> Payment Summary
        </div>
        <div class="meta-grid">
            <div class="meta-item">
                <div class="meta-label">Record ID</div>
                <div class="meta-value">#{{ $feeRecord->id }}</div>
            </div>
            <div class="meta-item">
                <div class="meta-label">Created</div>
                <div class="meta-value">{{ $feeRecord->created_at->format('d M Y, h:i A') }}</div>
            </div>
            <div class="meta-item">
                <div class="meta-label">Updated</div>
                <div class="meta-value">{{ $feeRecord->updated_at->format('d M Y, h:i A') }}</div>
            </div>
            <div class="meta-item">
                <div class="meta-label">Time Since</div>
                <div class="meta-value">{{ $feeRecord->created_at->diffForHumans() }}</div>
            </div>
        </div>
    </div>

    <!-- Remarks -->
    <div class="remarks-section">
        <div class="remarks-label"><i class="fas fa-comment"></i> Remarks</div>
        <div class="remarks-text {{ empty($feeRecord->remarks) ? 'empty' : '' }}">
            {{ $feeRecord->remarks ?? 'No remarks added for this record.' }}
        </div>
    </div>

    @else
    <!-- Not Found -->
    <div class="not-found">
        <i class="fas fa-exclamation-circle"></i>
        <h5>Fee Record Not Found</h5>
        <p>The requested fee record does not exist.</p>
        <a href="{{ route('fee_record') }}" class="btn-back" style="display:inline-flex;margin-top:15px;">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Any additional JS if needed
    });
</script>
@endpush