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
    .btn-checkout-page {
        background: #2e7d32;
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
    .btn-checkout-page:hover {
        background: #1b5e20;
        color: white;
        text-decoration: none;
    }

    /* Status Badge */
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

    /* Visitor Header */
    .visitor-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f5f5f5;
    }
    .visitor-avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #0B2E33;
        color: white;
        font-weight: 600;
        font-size: 22px;
        flex-shrink: 0;
    }
    .visitor-name-large {
        font-size: 1.3rem;
        font-weight: 600;
        color: #1a1a1a;
    }
    .visitor-detail {
        color: #777;
        font-size: 0.9rem;
    }
    .visitor-detail i {
        margin-right: 4px;
        color: #999;
    }
    .visitor-detail .sep {
        margin: 0 10px;
        color: #ddd;
    }

    /* Info Grid */
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
    .info-item .label i {
        margin-right: 4px;
    }
    .info-item .value {
        font-size: 1.05rem;
        font-weight: 500;
        color: #1a1a1a;
    }
    .info-item .value .text-muted {
        color: #bbb;
        font-weight: 400;
    }

    /* Status Tag */
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
    .status-tag.active { background: #e8f5e9; color: #2e7d32; }
    .status-tag.checked_out { background: #f5f5f5; color: #888; }
    .status-tag i {
        font-size: 0.65rem;
    }

    /* Room Tag */
    .room-tag {
        display: inline-block;
        padding: 2px 10px;
        background: #f5f5f5;
        border-radius: 4px;
        font-size: 13px;
        color: #333;
        font-weight: 500;
    }

    /* Meta Grid */
    .meta-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #f5f5f5;
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
        font-weight: 600;
    }
    .meta-item .meta-value {
        font-size: 0.9rem;
        font-weight: 500;
        color: #1a1a1a;
        margin-top: 2px;
    }

    /* Remarks Section */
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
    .remarks-section .remarks-label i {
        margin-right: 4px;
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

    /* Section Title */
    .section-title {
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
    .section-title i {
        color: #0B2E33;
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
        .page-header .action-buttons .btn-edit-page,
        .page-header .action-buttons .btn-checkout-page {
            flex: 1;
            justify-content: center;
        }
        .detail-wrapper {
            padding: 20px;
        }
        .visitor-header {
            flex-direction: column;
            text-align: center;
        }
        .visitor-avatar {
            width: 48px;
            height: 48px;
            font-size: 18px;
        }
        .visitor-name-large {
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
        .page-header .action-buttons .btn-edit-page,
        .page-header .action-buttons .btn-checkout-page {
            width: 100%;
        }
        .visitor-detail .sep {
            margin: 0 6px;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div>
        <h4>
            <i class="fas fa-user-circle"></i>
            Visitor Details
        </h4>
        <div class="sub-title">View complete visitor information</div>
        @if(isset($visitor))
        <div class="status-badge-simple {{ $visitor->status }}">
            <i class="fas fa-{{ $visitor->status == 'active' ? 'circle' : 'check-circle' }}"></i>
            {{ $visitor->status == 'active' ? 'Active' : 'Checked Out' }}
        </div>
        @endif
    </div>
    <div class="action-buttons">
        @if(isset($visitor))
            @if($visitor->status == 'active')
                <button class="btn-checkout-page checkout-btn" data-id="{{ $visitor->id }}">
                    <i class="fas fa-sign-out-alt"></i> Check Out
                </button>
            @endif
            <a href="{{ route('visitor.edit', $visitor->id) }}" class="btn-edit-page">
                <i class="fas fa-edit"></i> Edit
            </a>
        @endif
        <a href="{{ route('visitors_records') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<!-- Detail View -->
<div class="detail-wrapper">
    @if(isset($visitor))
    
    <!-- Visitor Header -->
    <div class="visitor-header">
        <div class="visitor-avatar">
            {{ substr($visitor->visitor_name, 0, 2) }}
        </div>
        <div>
            <div class="visitor-name-large">{{ $visitor->visitor_name }}</div>
            <div class="visitor-detail">
                <i class="fas fa-phone"></i> {{ $visitor->phone_number }}
                @if($visitor->email)
                    <span class="sep">|</span>
                    <i class="fas fa-envelope"></i> {{ $visitor->email }}
                @endif
                @if($visitor->id_card_number)
                    <span class="sep">|</span>
                    <i class="fas fa-id-card"></i> {{ $visitor->id_card_number }}
                @endif
            </div>
        </div>
    </div>

    <!-- Info Grid -->
    <div class="info-grid">
        <div class="info-item">
            <div class="label"><i class="fas fa-info-circle"></i> Purpose</div>
            <div class="value">{{ $visitor->purpose_of_visit }}</div>
        </div>
        <div class="info-item">
            <div class="label"><i class="fas fa-door-open"></i> Room Number</div>
            <div class="value">
                @if($visitor->room_no)
                    <span class="room-tag">{{ $visitor->room_no }}</span>
                @else
                    <span class="text-muted">Not specified</span>
                @endif
            </div>
        </div>
        <div class="info-item">
            <div class="label"><i class="fas fa-user-graduate"></i> Student</div>
            <div class="value">
                @if($visitor->student_name)
                    <div>{{ $visitor->student_name }}</div>
                    @if($visitor->student_room)
                        <small style="color:#999;font-size:0.8rem;">
                            <i class="fas fa-door-open"></i> Room {{ $visitor->student_room }}
                        </small>
                    @endif
                @else
                    <span class="text-muted">Not visiting a student</span>
                @endif
            </div>
        </div>
        <div class="info-item">
            <div class="label"><i class="fas fa-calendar-check"></i> Check In</div>
            <div class="value">
                <div>{{ $visitor->check_in_time->format('d M Y') }}</div>
                <small style="color:#999;font-size:0.8rem;">
                    <i class="fas fa-clock"></i> {{ $visitor->check_in_time->format('h:i A') }}
                </small>
            </div>
        </div>
        <div class="info-item">
            <div class="label"><i class="fas fa-calendar-times"></i> Check Out</div>
            <div class="value">
                @if($visitor->check_out_time)
                    <div>{{ $visitor->check_out_time->format('d M Y') }}</div>
                    <small style="color:#999;font-size:0.8rem;">
                        <i class="fas fa-clock"></i> {{ $visitor->check_out_time->format('h:i A') }}
                    </small>
                @else
                    <span class="text-muted">Not checked out yet</span>
                @endif
            </div>
        </div>
        <div class="info-item">
            <div class="label"><i class="fas fa-tag"></i> Status</div>
            <div class="value">
                <span class="status-tag {{ $visitor->status }}">
                    @if($visitor->status == 'active')
                        <i class="fas fa-circle" style="font-size:0.5rem;"></i>
                    @else
                        <i class="fas fa-check-circle"></i>
                    @endif
                    {{ $visitor->status == 'active' ? 'Active' : 'Checked Out' }}
                </span>
                @if($visitor->status == 'checked_out' && $visitor->check_out_time)
                    <div style="font-size:0.8rem;color:#999;margin-top:4px;">
                        <i class="fas fa-clock"></i> 
                        {{ $visitor->check_out_time->diffForHumans() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Meta Information -->
    <div class="meta-grid">
        <div class="meta-item">
            <div class="meta-label">Record ID</div>
            <div class="meta-value">#{{ $visitor->id }}</div>
        </div>
        <div class="meta-item">
            <div class="meta-label">Duration</div>
            <div class="meta-value">
                @if($visitor->check_out_time)
                    {{ $visitor->check_in_time->diffInHours($visitor->check_out_time) }} hrs
                @else
                    {{ $visitor->check_in_time->diffForHumans() }}
                @endif
            </div>
        </div>
        <div class="meta-item">
            <div class="meta-label">Created</div>
            <div class="meta-value">{{ $visitor->created_at->format('d M Y, h:i A') }}</div>
        </div>
        <div class="meta-item">
            <div class="meta-label">Updated</div>
            <div class="meta-value">{{ $visitor->updated_at->format('d M Y, h:i A') }}</div>
        </div>
    </div>

    <!-- Remarks -->
    <div class="remarks-section">
        <div class="remarks-label"><i class="fas fa-comment"></i> Remarks</div>
        <div class="remarks-text {{ empty($visitor->remarks) ? 'empty' : '' }}">
            {{ $visitor->remarks ?? 'No remarks added for this visitor.' }}
        </div>
    </div>

    @else
    <!-- Not Found -->
    <div class="not-found">
        <i class="fas fa-exclamation-circle"></i>
        <h5>Visitor Not Found</h5>
        <p>The requested visitor record does not exist.</p>
        <a href="{{ route('visitors_records') }}" class="btn-back" style="display:inline-flex;margin-top:15px;">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
    @endif
</div>

<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Check Out</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-sign-out-alt" style="font-size:2.5rem;color:#2e7d32;margin-bottom:12px;"></i>
                <p class="mb-0">Are you sure you want to check out <strong>{{ $visitor->visitor_name ?? '' }}</strong>?</p>
                <small class="text-muted">This will mark the visitor as checked out.</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="confirmCheckout">Check Out</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Checkout button click
        let checkoutId = null;
        
        $(document).on('click', '.checkout-btn', function() {
            checkoutId = $(this).data('id');
            $('#checkoutModal').modal('show');
        });

        // Confirm checkout
        $('#confirmCheckout').on('click', function() {
            if (checkoutId) {
                $.ajax({
                    url: '/visitor/' + checkoutId + '/checkout',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#checkoutModal').modal('hide');
                            location.reload();
                        }
                    },
                    error: function() {
                        alert('Failed to checkout visitor');
                    }
                });
            }
        });
    });
</script>
@endpush