@extends('Layout.admin')

@section('content')
<style>
    /* ===== PAGE CONTAINER ===== */
    .staff-details-container {
        padding: 1.5rem 0;
    }
    
    /* ===== BREADCRUMB ===== */
    .breadcrumb-custom {
        background: transparent;
        padding: 0 0 1.5rem 0;
        margin: 0;
        font-size: 0.9rem;
    }
    .breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before {
        content: "›";
        color: #94a3b8;
        font-size: 1.2rem;
    }
    .breadcrumb-custom .breadcrumb-item a {
        color: #0B2E33;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
    }
    .breadcrumb-custom .breadcrumb-item a:hover {
        color: #1a5a6e;
    }
    .breadcrumb-custom .breadcrumb-item.active {
        color: #64748b;
        font-weight: 500;
    }

    /* ===== MAIN CARD ===== */
    .profile-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06), 0 2px 10px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(226, 232, 240, 0.6);
        overflow: hidden;
        transition: transform 0.2s ease, box-shadow 0.3s ease;
    }
    .profile-card:hover {
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
    }

    /* ===== HEADER ===== */
    .profile-header {
        background: linear-gradient(135deg, #0B2E33 0%, #1a5a6e 100%);
        padding: 2.5rem 2.5rem 1.5rem 2.5rem;
        position: relative;
        overflow: hidden;
    }
    .profile-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 50%;
        pointer-events: none;
    }
    .profile-header::after {
        content: '';
        position: absolute;
        bottom: -40%;
        left: -5%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.02);
        border-radius: 50%;
        pointer-events: none;
    }
    .profile-header-content {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        position: relative;
        z-index: 1;
        flex-wrap: wrap;
    }
    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        font-weight: 700;
        color: #ffffff;
        border: 3px solid rgba(255, 255, 255, 0.25);
        flex-shrink: 0;
        text-transform: uppercase;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    .profile-title {
        flex: 1;
    }
    .profile-title h2 {
        color: #ffffff;
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0 0 0.25rem 0;
        letter-spacing: -0.3px;
    }
    .profile-title .role-badge {
        display: inline-block;
        padding: 0.3rem 1.2rem;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 50px;
        color: #e2e8f0;
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 0.3px;
        text-transform: uppercase;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .profile-status {
        margin-left: auto;
        align-self: flex-start;
    }
    .status-badge-lg {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #ffffff;
    }
    .status-badge-lg i {
        font-size: 0.8rem;
    }
    .status-badge-lg.active {
        background: rgba(34, 197, 94, 0.2);
        border-color: rgba(34, 197, 94, 0.3);
        color: #86efac;
    }
    .status-badge-lg.inactive {
        background: rgba(239, 68, 68, 0.2);
        border-color: rgba(239, 68, 68, 0.3);
        color: #fca5a5;
    }
    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        animation: pulse 2s infinite;
    }
    .status-dot.active {
        background: #22c55e;
    }
    .status-dot.inactive {
        background: #ef4444;
    }
    @keyframes pulse {
        0% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.6; transform: scale(0.9); }
        100% { opacity: 1; transform: scale(1); }
    }

    /* ===== BODY ===== */
    .profile-body {
        padding: 2rem 2.5rem 2.5rem 2.5rem;
    }

    /* ===== INFO GRID ===== */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem 2.5rem;
        margin-bottom: 2rem;
    }
    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        .profile-header-content {
            flex-direction: column;
            text-align: center;
        }
        .profile-status {
            margin-left: 0;
            align-self: center;
        }
        .profile-body {
            padding: 1.5rem;
        }
        .profile-header {
            padding: 2rem 1.5rem;
        }
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
        padding: 0.75rem 1rem;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #f1f5f9;
        transition: all 0.2s ease;
    }
    .info-item:hover {
        background: #f1f5f9;
        border-color: #e2e8f0;
    }
    .info-item .label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .info-item .label i {
        font-size: 0.8rem;
        color: #0B2E33;
        width: 16px;
    }
    .info-item .value {
        font-size: 1rem;
        font-weight: 600;
        color: #0f172a;
        padding-left: 1.8rem;
    }
    .info-item .value .text-muted {
        color: #94a3b8;
        font-weight: 400;
    }

    /* ===== SALARY HIGHLIGHT ===== */
    .salary-highlight {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        border: 1px solid #bbf7d0;
        border-radius: 12px;
        padding: 0.75rem 1rem;
    }
    .salary-highlight .value {
        color: #15803d !important;
    }

    /* ===== ACTION BUTTONS ===== */
    .action-buttons {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        padding-top: 1.5rem;
        border-top: 2px solid #f1f5f9;
        margin-top: 0.5rem;
    }
    .btn-custom {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1.8rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.25s ease;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }
    .btn-custom i {
        font-size: 0.95rem;
    }
    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        text-decoration: none;
    }
    .btn-custom:active {
        transform: scale(0.97);
    }
    .btn-edit {
        background: #0B2E33;
        color: #ffffff;
    }
    .btn-edit:hover {
        background: #1a5a6e;
        color: #ffffff;
        box-shadow: 0 8px 25px rgba(11, 46, 51, 0.25);
    }
    .btn-back {
        background: #f1f5f9;
        color: #475569;
    }
    .btn-back:hover {
        background: #e2e8f0;
        color: #0f172a;
    }
    .btn-delete {
        background: #fef2f2;
        color: #dc2626;
    }
    .btn-delete:hover {
        background: #fecaca;
        color: #b91c1c;
        box-shadow: 0 8px 25px rgba(220, 38, 38, 0.15);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 576px) {
        .action-buttons {
            flex-direction: column;
        }
        .action-buttons .btn-custom {
            justify-content: center;
        }
        .profile-title h2 {
            font-size: 1.4rem;
        }
        .profile-avatar {
            width: 60px;
            height: 60px;
            font-size: 1.6rem;
        }
    }
</style>

<div class="staff-details-container">
    <div class="container-fluid px-0">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="breadcrumb-custom">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('staff.index') }}">
                        <i class="fas fa-users"></i> Staff Management
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $staff->name }}
                </li>
            </ol>
        </nav>

        <!-- Profile Card -->
        <div class="profile-card">
            <!-- Header -->
            <div class="profile-header">
                <div class="profile-header-content">
                    <div class="profile-avatar">
                        {{ $staff->name ? substr($staff->name, 0, 2) : 'S' }}
                    </div>
                    <div class="profile-title">
                        <h2>{{ $staff->name }}</h2>
                        <span class="role-badge">
                            <i class="fas fa-briefcase"></i> {{ $staff->role }}
                        </span>
                    </div>
                    <div class="profile-status">
                        <span class="status-badge-lg {{ $staff->status }}">
                            <span class="status-dot {{ $staff->status }}"></span>
                            {{ ucfirst($staff->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="profile-body">
                <!-- Info Grid -->
                <div class="info-grid">
                    <!-- Left Column -->
                    <div class="info-item">
                        <span class="label">
                            <i class="fas fa-user-circle"></i> Full Name
                        </span>
                        <span class="value">{{ $staff->name }}</span>
                    </div>

                    <div class="info-item">
                        <span class="label">
                            <i class="fas fa-briefcase"></i> Role
                        </span>
                        <span class="value">{{ $staff->role }}</span>
                    </div>

                    <div class="info-item">
                        <span class="label">
                            <i class="fas fa-phone"></i> Phone Number
                        </span>
                        <span class="value">{{ $staff->phone_number }}</span>
                    </div>

                    <div class="info-item">
                        <span class="label">
                            <i class="fas fa-clock"></i> Duty Shift
                        </span>
                        <span class="value">{{ $staff->duty_shift }}</span>
                    </div>

                    <!-- Right Column -->
                    <div class="info-item">
                        <span class="label">
                            <i class="fas fa-envelope"></i> Email Address
                        </span>
                        <span class="value">
                            {{ $staff->email ?? '<span class="text-muted">Not provided</span>' }}
                        </span>
                    </div>

                    <div class="info-item">
                        <span class="label">
                            <i class="fas fa-map-marker-alt"></i> Address
                        </span>
                        <span class="value">
                            {{ $staff->address ?? '<span class="text-muted">Not provided</span>' }}
                        </span>
                    </div>

                    <div class="info-item">
                        <span class="label">
                            <i class="fas fa-calendar-alt"></i> Joining Date
                        </span>
                        <span class="value">
                            {{ $staff->joining_date?->format('d-m-Y') ?? '<span class="text-muted">Not provided</span>' }}
                        </span>
                    </div>

                    <div class="info-item salary-highlight">
                        <span class="label">
                            <i class="fas fa-money-bill-wave"></i> Salary
                        </span>
                        <span class="value">
                            {{ $staff->salary ? 'Rs. ' . number_format($staff->salary, 2) : '<span class="text-muted">Not provided</span>' }}
                        </span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ route('staff.edit', $staff->id) }}" class="btn-custom btn-edit">
                        <i class="fas fa-edit"></i> Edit Staff
                    </a>
                    
                    <a href="{{ route('staff.index') }}" class="btn-custom btn-back">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>

                    @if(isset($staff->id) && $staff->id)
                    <form action="{{ route('staff.destroy', $staff->id) }}" method="POST" class="d-inline" 
                          onsubmit="return confirm('Are you sure you want to delete this staff member? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-custom btn-delete">
                            <i class="fas fa-trash-alt"></i> Delete Staff
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Additional Information Card (Optional) -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="profile-card" style="border-radius: 16px;">
                    <div class="profile-body" style="padding: 1.5rem 2rem;">
                        <div class="d-flex align-items-center gap-2" style="color: #94a3b8; font-size: 0.85rem;">
                            <i class="fas fa-info-circle"></i>
                            <span>Staff ID: <strong style="color: #0f172a;">#{{ $staff->id ?? 'N/A' }}</strong></span>
                            <span class="mx-2">|</span>
                            <span>Last Updated: <strong style="color: #0f172a;">{{ $staff->updated_at?->format('d-m-Y H:i:s') ?? 'N/A' }}</strong></span>
                            <span class="mx-2">|</span>
                            <span>Created: <strong style="color: #0f172a;">{{ $staff->created_at?->format('d-m-Y H:i:s') ?? 'N/A' }}</strong></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Add any additional JavaScript here if needed
        console.log('Staff details page loaded successfully');
        
        // Tooltip initialization if needed
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endpush