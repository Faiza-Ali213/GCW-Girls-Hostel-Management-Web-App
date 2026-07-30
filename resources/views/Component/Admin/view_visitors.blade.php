@extends('Layout.admin')

@section('content')
<style>
    /* ===== MODERN DARK BLUE THEME ===== */
    .view-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        margin-top: 10px;
        background: #f8faff;
    }

    .view-card .card-header {
        background: linear-gradient(135deg, #0f1a2e 0%, #1a2a4a 100%);
        padding: 18px 28px;
        border: none;
    }

    .view-card .card-header h5 {
        color: #ffffff;
        font-weight: 600;
        font-size: 1rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .view-card .card-header h5 i {
        color: #60a5fa;
        font-size: 1.2rem;
    }

    .view-card .card-header .badge-header {
        background: rgba(255, 255, 255, 0.12);
        color: #93bbfc;
        font-size: 0.65rem;
        font-weight: 500;
        padding: 4px 14px;
        border-radius: 20px;
        margin-left: auto;
        letter-spacing: 0.3px;
    }

    .view-card .card-body {
        padding: 28px;
        background: #f8faff;
    }

    /* Info Section */
    .info-section {
        background: #ffffff;
        border: 1.5px solid #e8edf5;
        border-radius: 12px;
        padding: 20px 24px;
        margin-bottom: 20px;
    }

    .info-section .section-title {
        font-weight: 700;
        font-size: 0.9rem;
        color: #1a2a4a;
        margin-bottom: 16px;
        padding-bottom: 10px;
        border-bottom: 2px solid #eef2f8;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-section .section-title i {
        color: #1a2a4a;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 16px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-item .label {
        font-size: 0.7rem;
        text-transform: uppercase;
        font-weight: 600;
        color: #94a3b8;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .info-item .value {
        font-weight: 600;
        color: #1a2a4a;
        font-size: 0.95rem;
    }

    .info-item .value .badge-room {
        background: #eef2f8;
        color: #1a2a4a;
        padding: 2px 12px;
        border-radius: 12px;
        font-size: 0.8rem;
    }

    /* Visitor Cards */
    .visitor-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 16px;
    }

    .visitor-detail-card {
        background: #ffffff;
        border: 1.5px solid #e8edf5;
        border-radius: 12px;
        padding: 16px 20px;
        transition: all 0.25s ease;
        position: relative;
    }

    .visitor-detail-card:hover {
        border-color: #1a2a4a;
        box-shadow: 0 4px 16px rgba(26, 42, 74, 0.06);
        transform: translateY(-2px);
    }

    .visitor-detail-card .visitor-number {
        font-weight: 700;
        font-size: 0.8rem;
        color: #1a2a4a;
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 1.5px dashed #eef2f8;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .visitor-detail-card .visitor-number .badge-primary {
        background: #1a2a4a;
        color: #ffffff;
        font-size: 0.55rem;
        font-weight: 600;
        padding: 2px 12px;
        border-radius: 12px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .visitor-detail-card .visitor-number .badge-additional {
        background: #eef2f8;
        color: #5a6a8a;
        font-size: 0.55rem;
        font-weight: 600;
        padding: 2px 12px;
        border-radius: 12px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .visitor-detail-card .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 4px 0;
        font-size: 0.85rem;
    }

    .visitor-detail-card .detail-row .detail-label {
        color: #94a3b8;
        font-weight: 500;
    }

    .visitor-detail-card .detail-row .detail-value {
        color: #1a2a4a;
        font-weight: 600;
    }

    .visitor-detail-card .detail-row .detail-value .relationship-badge {
        background: #dbeafe;
        color: #1a4a7a;
        font-size: 0.65rem;
        padding: 2px 10px;
        border-radius: 12px;
        font-weight: 600;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 30px 20px;
        background: #ffffff;
        border-radius: 12px;
        border: 2px dashed #e8edf5;
    }

    .empty-state i {
        font-size: 2.5rem;
        color: #d1d8e0;
        margin-bottom: 12px;
    }

    .empty-state h6 {
        color: #1a2a4a;
        font-weight: 600;
    }

    .empty-state p {
        color: #94a3b8;
        font-size: 0.9rem;
    }

    /* Action Buttons */
    .action-row {
        display: flex;
        gap: 12px;
        margin-top: 20px;
        flex-wrap: wrap;
    }

    .btn-back {
        background: #f1f4f9;
        color: #1a2a4a;
        border: none;
        padding: 10px 28px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.25s ease;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-back:hover {
        background: #e5e9f0;
        color: #0f1a2e;
        text-decoration: none;
        transform: translateY(-2px);
    }

    .btn-edit {
        background: #1a2a4a;
        color: #ffffff;
        border: none;
        padding: 10px 28px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.25s ease;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 8px rgba(26, 42, 74, 0.15);
    }

    .btn-edit:hover {
        background: #0f1a2e;
        color: #ffffff;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(26, 42, 74, 0.2);
    }

    .btn-delete {
        background: #fef2f2;
        color: #dc2626;
        border: 1.5px solid #dc2626;
        padding: 10px 28px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.25s ease;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-delete:hover {
        background: #dc2626;
        color: #ffffff;
        text-decoration: none;
        transform: translateY(-2px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .view-card .card-body {
            padding: 18px;
        }

        .info-section {
            padding: 16px 18px;
        }

        .info-grid {
            grid-template-columns: 1fr 1fr;
        }

        .visitor-grid {
            grid-template-columns: 1fr;
        }

        .action-row {
            flex-direction: column;
        }

        .action-row .btn {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="view-card card">
                <!-- Header -->
                <div class="card-header">
                    <h5>
                        <i class="fas fa-user-circle"></i>
                        Visitor Details
                        <span class="badge-header">
                            <i class="far fa-clock"></i> {{ $visitor->created_at->format('d M Y, h:i A') }}
                        </span>
                    </h5>
                </div>

                <div class="card-body">
                    <!-- Student Information -->
                    <div class="info-section">
                        <div class="section-title">
                            <i class="fas fa-user-graduate"></i>
                            Student Information
                            <span style="margin-left: auto; font-size: 0.7rem; font-weight: 400; color: #94a3b8;">
                                ID: #{{ str_pad($visitor->id, 6, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="label">Student Name</span>
                                <span class="value">{{ $visitor->student_name }}</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Room Number</span>
                                <span class="value">
                                    <span class="badge-room">
                                        <i class="fas fa-door-open" style="font-size: 0.6rem;"></i>
                                        {{ $visitor->student_room ?? 'N/A' }}
                                    </span>
                                </span>
                            </div>
                            <div class="info-item">
                                <span class="label">Phone</span>
                                <span class="value">{{ $visitor->student_phone ?? 'N/A' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="label">CNIC</span>
                                <span class="value">{{ $visitor->student_cnic ?? 'N/A' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Total Visitors</span>
                                <span class="value">
                                    <span style="background: #1a2a4a; color: #ffffff; padding: 2px 16px; border-radius: 12px; font-weight: 700;">
                                        {{ $visitor->number_of_visitors }}
                                    </span>
                                </span>
                            </div>
                            <div class="info-item">
                                <span class="label">Check-in Time</span>
                                <span class="value">{{ $visitor->check_in_time ? $visitor->check_in_time->format('d M Y, h:i A') : 'N/A' }}</span>
                            </div>
                            @if($visitor->remarks)
                            <div class="info-item" style="grid-column: 1 / -1;">
                                <span class="label">Remarks</span>
                                <span class="value">{{ $visitor->remarks }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Visitors List -->
                    <div class="info-section">
                        <div class="section-title">
                            <i class="fas fa-users"></i>
                            Visitors List
                            <span style="margin-left: auto; font-size: 0.7rem; font-weight: 400; color: #94a3b8;">
                                Total: {{ count($visitorDetails) }} visitor(s)
                            </span>
                        </div>

                        @if(!empty($visitorDetails) && count($visitorDetails) > 0)
                            <div class="visitor-grid">
                                @foreach($visitorDetails as $index => $detail)
                                    <div class="visitor-detail-card">
                                        <div class="visitor-number">
                                            <span>
                                                <i class="fas fa-user-circle"></i>
                                                Visitor #{{ $index + 1 }}
                                            </span>
                                            <span class="{{ $index == 0 ? 'badge-primary' : 'badge-additional' }}">
                                                {{ $index == 0 ? 'Primary' : 'Additional' }}
                                            </span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Full Name</span>
                                            <span class="detail-value">{{ $detail['visitor_name'] ?? 'N/A' }}</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Relationship</span>
                                            <span class="detail-value">
                                                <span class="relationship-badge">
                                                    {{ $detail['relationship'] ?? 'N/A' }}
                                                </span>
                                            </span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">CNIC Number</span>
                                            <span class="detail-value">{{ $detail['cnic_number'] ?? 'N/A' }}</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Phone Number</span>
                                            <span class="detail-value">{{ $detail['phone_number'] ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-user-slash"></i>
                                <h6>No Visitor Details Found</h6>
                                <p>This record has no visitor information available.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-row">
                        <a href="{{ route('visitors_records') }}" class="btn-back">
                            <i class="fas fa-arrow-left"></i> Back to Records
                        </a>
                        <a href="{{ route('visitor.edit', $visitor->id) }}" class="btn-edit">
                            <i class="fas fa-edit"></i> Edit Record
                        </a>
                        <form action="{{ route('visitor.destroy', $visitor->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this visitor record? This action cannot be undone.');">
                                <i class="fas fa-trash-alt"></i> Delete Record
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection