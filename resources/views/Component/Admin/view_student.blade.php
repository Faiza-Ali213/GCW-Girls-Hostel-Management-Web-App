@extends('Layout.admin')

@section('content')
<style>
    .profile-container {
        max-width: 900px;
        margin: 0 auto;
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        border: 1px solid #f0f2f5;
    }
    .profile-header {
        display: flex;
        align-items: center;
        gap: 25px;
        padding-bottom: 25px;
        border-bottom: 2px solid #f1f3f5;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }
    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4F46E5 0%, #4338CA 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2.5rem;
        font-weight: 700;
        flex-shrink: 0;
        overflow: hidden;
        border: 4px solid #EEF2FF;
    }
    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .profile-title {
        flex: 1;
    }
    .profile-title h3 {
        margin: 0;
        font-weight: 700;
        color: #0b1a33;
        font-size: 1.5rem;
    }
    .profile-title .sub-title {
        color: #94a3b8;
        font-size: 0.95rem;
        margin-top: 4px;
    }
    .profile-title .badge-status {
        display: inline-block;
        padding: 4px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 8px;
    }
    .badge-active { background: #ECFDF5; color: #10B981; }
    .badge-inactive { background: #FEF3C7; color: #F59E0B; }
    .badge-graduated { background: #EEF2FF; color: #4F46E5; }
    .badge-left { background: #FEF2F2; color: #EF4444; }

    .info-section {
        margin-bottom: 25px;
    }
    .info-section .section-title {
        font-weight: 600;
        color: #0b1a33;
        font-size: 1rem;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f1f3f5;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .info-section .section-title i {
        color: #4F46E5;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
    }
    .info-item {
        background: #f8fafc;
        border-radius: 10px;
        padding: 12px 16px;
        border: 1px solid #eef2f6;
        transition: all 0.2s ease;
    }
    .info-item:hover {
        background: #f1f4f9;
        border-color: #d5dce6;
    }
    .info-item .label {
        font-size: 0.7rem;
        text-transform: uppercase;
        font-weight: 600;
        color: #94a3b8;
        letter-spacing: 0.5px;
        display: block;
        margin-bottom: 3px;
    }
    .info-item .value {
        font-weight: 600;
        color: #0b1a33;
        font-size: 0.95rem;
    }
    .info-item .value.room-number {
        color: #4F46E5;
        font-size: 1.1rem;
    }
    .info-item .value.room-type {
        color: #F59E0B;
    }
    .info-item .value.room-status-available {
        color: #10B981;
    }
    .info-item .value.room-status-full {
        color: #EF4444;
    }
    .info-item .value.room-status-maintenance {
        color: #F59E0B;
    }

    .room-card {
        background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
        border-radius: 12px;
        padding: 18px 22px;
        border: 2px solid #4F46E5;
        margin-top: 5px;
    }
    .room-card .room-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: #4F46E5;
    }
    .room-card .room-detail {
        color: #0b1a33;
        font-weight: 500;
    }
    .room-card .room-occupancy {
        display: inline-block;
        padding: 2px 12px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
        background: white;
        color: #4F46E5;
    }

    .action-buttons {
        display: flex;
        gap: 12px;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 2px solid #f1f3f5;
        flex-wrap: wrap;
    }
    .btn {
        padding: 10px 28px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        text-decoration: none;
    }
    .btn-edit {
        background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }
    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
        color: white;
    }
    .btn-back {
        background: #f1f3f5;
        color: #495057;
    }
    .btn-back:hover {
        background: #e9ecef;
        color: #2c3e50;
    }
    .btn-fee {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }
    .btn-fee:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        color: white;
    }
    .btn-delete {
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }
    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        color: white;
    }

    .empty-room {
        color: #94a3b8;
        font-style: italic;
    }

    @media (max-width: 768px) {
        .profile-container {
            padding: 20px;
        }
        .profile-header {
            flex-direction: column;
            text-align: center;
        }
        .profile-avatar {
            width: 80px;
            height: 80px;
            font-size: 2rem;
        }
        .info-grid {
            grid-template-columns: 1fr;
        }
        .action-buttons {
            flex-direction: column;
        }
        .action-buttons .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="profile-container">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-avatar">
            @if($student->profile_picture)
                <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="{{ $student->student_name }}">
            @else
                {{ substr($student->student_name, 0, 2) }}
            @endif
        </div>
        <div class="profile-title">
            <h3>{{ $student->student_name }}</h3>
            <div class="sub-title">
                <i class="bi bi-person-badge"></i> 
                {{ $student->father_name ? 'Son of ' . $student->father_name : '' }}
            </div>
            <span class="badge-status badge-{{ $student->hostel_status ?? 'active' }}">
                <i class="bi {{ $student->hostel_status == 'active' ? 'bi-check-circle' : 'bi-info-circle' }}"></i>
                {{ ucfirst($student->hostel_status ?? 'Active') }}
            </span>
        </div>
    </div>

    <!-- Personal Information -->
    <div class="info-section">
        <div class="section-title">
            <i class="bi bi-person-lines-fill"></i> Personal Information
        </div>
        <div class="info-grid">
            <div class="info-item">
                <span class="label">Student Name</span>
                <span class="value">{{ $student->student_name }}</span>
            </div>
            <div class="info-item">
                <span class="label">Father Name</span>
                <span class="value">{{ $student->father_name ?? 'N/A' }}</span>
            </div>
            <div class="info-item">
                <span class="label">Phone Number</span>
                <span class="value">{{ $student->phone_number ?? 'N/A' }}</span>
            </div>
            <div class="info-item">
                <span class="label">CNIC Number</span>
                <span class="value">{{ $student->cnic_number ?? 'N/A' }}</span>
            </div>
            <div class="info-item">
                <span class="label">Email Address</span>
                <span class="value">{{ $student->email ?? 'N/A' }}</span>
            </div>
            <div class="info-item">
                <span class="label">Admission Date</span>
                <span class="value">{{ $student->admission_date ? $student->admission_date->format('d-m-Y') : 'N/A' }}</span>
            </div>
            <div class="info-item" style="grid-column: 1 / -1;">
                <span class="label">Address</span>
                <span class="value">{{ $student->address ?? 'N/A' }}</span>
            </div>
        </div>
    </div>

    <!-- Hostel Information -->
    <div class="info-section">
        <div class="section-title">
            <i class="bi bi-building"></i> Hostel Information
        </div>
        <div class="info-grid">
            <div class="info-item">
                <span class="label">Room Number</span>
                <span class="value room-number">
                    @if($student->room_number)
                        <i class="bi bi-door-open"></i> {{ $student->room_number }}
                    @else
                        <span class="empty-room">Not Assigned</span>
                    @endif
                </span>
            </div>
            <div class="info-item">
                <span class="label">Room Type</span>
                <span class="value room-type">
                    @if($student->room_type)
                        {{ ucfirst($student->room_type) }}
                        @if($student->room_type == 'double') (2 Beds)
                        @elseif($student->room_type == 'triple') (3 Beds)
                        @elseif($student->room_type == 'quad') (4 Beds)
                        @endif
                    @else
                        <span class="empty-room">N/A</span>
                    @endif
                </span>
            </div>
            <div class="info-item">
                <span class="label">Block</span>
                <span class="value">
                    @if($student->room)
                        {{ $student->room->block ?? 'N/A' }}
                    @else
                        <span class="empty-room">N/A</span>
                    @endif
                </span>
            </div>
            <div class="info-item">
                <span class="label">Floor</span>
                <span class="value">
                    @if($student->room)
                        {{ $student->room->floor ?? 'N/A' }}
                    @else
                        <span class="empty-room">N/A</span>
                    @endif
                </span>
            </div>
            <div class="info-item">
                <span class="label">Room Status</span>
                <span class="value room-status-{{ $student->room ? $student->room->status : 'available' }}">
                    @if($student->room)
                        @if($student->room->status == 'available')
                            <i class="bi bi-check-circle"></i> Available
                        @elseif($student->room->status == 'full')
                            <i class="bi bi-x-circle"></i> Full
                        @else
                            <i class="bi bi-tools"></i> Maintenance
                        @endif
                    @else
                        <span class="empty-room">Not Assigned</span>
                    @endif
                </span>
            </div>
            <div class="info-item">
                <span class="label">Occupancy</span>
                <span class="value">
                    @if($student->room)
                        {{ $student->room->current_occupancy ?? 0 }} / {{ $student->room->capacity ?? 0 }}
                        <span class="room-occupancy">
                            {{ $student->room->current_occupancy ? round(($student->room->current_occupancy / $student->room->capacity) * 100) : 0 }}%
                        </span>
                    @else
                        <span class="empty-room">N/A</span>
                    @endif
                </span>
            </div>
        </div>
    </div>

    <!-- Room Details Card -->
    @if($student->room)
        <div class="info-section">
            <div class="section-title">
                <i class="bi bi-door-open"></i> Room Details
            </div>
            <div class="room-card">
                <div class="row">
                    <div class="col-md-4">
                        <span class="room-number">{{ $student->room->room_number }}</span>
                        <div class="room-detail">
                            <i class="bi bi-tag"></i> {{ ucfirst($student->room->room_type) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="room-detail">
                            <i class="bi bi-geo-alt"></i> Block {{ $student->room->block }} - Floor {{ $student->room->floor }}
                        </div>
                        <div class="room-detail">
                            <i class="bi bi-people"></i> {{ $student->room->current_occupancy }} / {{ $student->room->capacity }} Occupied
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="room-detail">
                            <i class="bi bi-{{ $student->room->status == 'available' ? 'check-circle text-success' : ($student->room->status == 'full' ? 'x-circle text-danger' : 'tools text-warning') }}"></i>
                            Status: {{ ucfirst($student->room->status) }}
                        </div>
                        <div class="room-detail">
                            <i class="bi bi-bed"></i> 
                            {{ $student->room->capacity - $student->room->current_occupancy }} Beds Available
                        </div>
                    </div>
                </div>
                @if($student->room->notes)
                    <div class="mt-2 pt-2 border-top">
                        <small class="text-muted"><i class="bi bi-sticky-note"></i> {{ $student->room->notes }}</small>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Contact & Emergency -->
    <div class="info-section">
        <div class="section-title">
            <i class="bi bi-phone"></i> Contact & Emergency
        </div>
        <div class="info-grid">
            <div class="info-item">
                <span class="label">Guardian Contact</span>
                <span class="value">{{ $student->guardian_contact ?? 'N/A' }}</span>
            </div>
            <div class="info-item">
                <span class="label">Emergency Contact</span>
                <span class="value">{{ $student->emergency_contact ?? 'N/A' }}</span>
            </div>
        </div>
    </div>

    <!-- Additional Information -->
    @if($student->medical_conditions || $student->remarks)
        <div class="info-section">
            <div class="section-title">
                <i class="bi bi-clipboard"></i> Additional Information
            </div>
            <div class="info-grid">
                @if($student->medical_conditions)
                    <div class="info-item" style="grid-column: 1 / -1;">
                        <span class="label">Medical Conditions</span>
                        <span class="value">{{ $student->medical_conditions }}</span>
                    </div>
                @endif
                @if($student->remarks)
                    <div class="info-item" style="grid-column: 1 / -1;">
                        <span class="label">Remarks</span>
                        <span class="value">{{ $student->remarks }}</span>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="action-buttons">
        <a href="{{ route('student-records') }}" class="btn btn-back">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
        <a href="{{ route('student.edit', $student->id) }}" class="btn btn-edit">
            <i class="bi bi-pencil"></i> Edit Student
        </a>
        @if($student->room_number)
            <a href="{{ route('fee-record.pay', ['id' => $student->id]) }}" class="btn btn-fee">
                <i class="bi bi-cash-stack"></i> Fee Details
            </a>
        @endif
        <form action="{{ route('student.destroy', $student->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this student? This action cannot be undone.');">
                <i class="bi bi-trash"></i> Delete Student
            </button>
        </form>
    </div>
</div>

@endsection