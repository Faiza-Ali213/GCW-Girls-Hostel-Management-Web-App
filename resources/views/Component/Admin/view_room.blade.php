@extends('Layout.admin')

@section('content')
<style>
    .room-detail-container {
        max-width: 1000px;
        margin: 0 auto;
        background: #ffffff;
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        border: 1px solid #eef2f6;
    }
    
    /* Top Action Bar */
    .top-action-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .top-action-bar .btn {
        padding: 8px 20px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        text-decoration: none;
        font-size: 0.9rem;
    }
    .top-action-bar .btn-back {
        background: #f1f5f9;
        color: #475569;
    }
    .top-action-bar .btn-back:hover {
        background: #e2e8f0;
        color: #0f172a;
        transform: translateY(-2px);
    }
    .top-action-bar .btn-edit {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: #ffffff;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }
    .top-action-bar .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(245, 158, 11, 0.4);
        color: #ffffff;
    }

    /* Room Header */
    .room-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 25px;
        border-bottom: 2px solid #f0f2f5;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }
    .room-header .room-title {
        display: flex;
        align-items: center;
        gap: 18px;
        flex-wrap: wrap;
    }
    .room-header .room-title .room-number {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1a2332;
        letter-spacing: -0.5px;
    }
    .room-header .room-title .room-type {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: #ffffff;
        padding: 6px 20px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .room-header .room-status {
        padding: 8px 24px;
        border-radius: 25px;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .room-status.available {
        background: #ecfdf5;
        color: #059669;
        border: 2px solid #34d399;
    }
    .room-status.full {
        background: #fef2f2;
        color: #dc2626;
        border: 2px solid #f87171;
    }
    .room-status.maintenance {
        background: #fffbeb;
        color: #d97706;
        border: 2px solid #fbbf24;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 16px;
        margin-bottom: 30px;
    }
    .info-item {
        background: #f8fafc;
        border-radius: 14px;
        padding: 14px 18px;
        border: 1px solid #eef2f6;
        transition: all 0.3s ease;
    }
    .info-item:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
        transform: translateY(-2px);
    }
    .info-item .label {
        font-size: 0.7rem;
        text-transform: uppercase;
        font-weight: 700;
        color: #94a3b8;
        letter-spacing: 0.8px;
        display: block;
        margin-bottom: 4px;
    }
    .info-item .label i {
        margin-right: 5px;
    }
    .info-item .value {
        font-weight: 700;
        color: #0f172a;
        font-size: 1rem;
    }
    .info-item .value.available-beds {
        color: #059669;
    }
    .info-item .value.occupied-beds {
        color: #4f46e5;
    }
    .info-item .value.occupancy-rate {
        color: #7c3aed;
    }

    /* Bed Indicator */
    .bed-section {
        background: #f8fafc;
        border-radius: 14px;
        padding: 18px 22px;
        margin-bottom: 30px;
        border: 1px solid #eef2f6;
    }
    .bed-section .bed-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        font-weight: 700;
        color: #94a3b8;
        letter-spacing: 0.8px;
        display: block;
        margin-bottom: 12px;
    }
    .bed-section .bed-label i {
        margin-right: 6px;
    }
    .bed-indicator {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
    }
    .bed {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 700;
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    .bed.occupied {
        background: linear-gradient(135deg, #4f46e5, #6366f1);
        color: #ffffff;
        border-color: #4f46e5;
        box-shadow: 0 2px 10px rgba(79, 70, 229, 0.3);
    }
    .bed.occupied:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 20px rgba(79, 70, 229, 0.4);
    }
    .bed.available {
        background: #ecfdf5;
        color: #059669;
        border-color: #34d399;
    }
    .bed.available:hover {
        transform: scale(1.1);
        background: #d1fae5;
    }
    .bed-legend {
        display: flex;
        gap: 20px;
        margin-top: 12px;
        flex-wrap: wrap;
    }
    .bed-legend span {
        font-size: 0.8rem;
        font-weight: 600;
        color: #475569;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .bed-legend .legend-occupied {
        color: #4f46e5;
    }
    .bed-legend .legend-available {
        color: #059669;
    }

    /* Students Section */
    .students-section {
        margin-top: 30px;
    }
    .students-section .section-title {
        font-weight: 700;
        color: #0f172a;
        font-size: 1.1rem;
        margin-bottom: 18px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f0f2f5;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .students-section .section-title i {
        color: #4f46e5;
        font-size: 1.2rem;
    }
    .students-section .section-title .badge-count {
        background: linear-gradient(135deg, #4f46e5, #6366f1);
        color: #ffffff;
        padding: 2px 14px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        margin-left: auto;
    }

    .student-card {
        display: flex;
        align-items: center;
        gap: 18px;
        background: #ffffff;
        border-radius: 14px;
        padding: 16px 22px;
        border: 1px solid #eef2f6;
        transition: all 0.3s ease;
        margin-bottom: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }
    .student-card:hover {
        background: #fafbff;
        border-color: #c7d2fe;
        transform: translateX(6px);
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.08);
    }
    .student-card .student-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4f46e5, #7c3aed);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-weight: 700;
        font-size: 1.2rem;
        flex-shrink: 0;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(79, 70, 229, 0.25);
    }
    .student-card .student-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .student-card .student-info {
        flex: 1;
    }
    .student-card .student-info .student-name {
        font-weight: 700;
        color: #0f172a;
        font-size: 1.05rem;
        margin-bottom: 2px;
    }
    .student-card .student-info .student-details {
        color: #64748b;
        font-size: 0.85rem;
        display: flex;
        gap: 18px;
        flex-wrap: wrap;
    }
    .student-card .student-info .student-details span {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .student-card .student-info .student-details i {
        font-size: 0.8rem;
        color: #94a3b8;
    }
    .student-card .student-info .student-details .status-active {
        color: #059669;
        font-weight: 600;
    }
    .student-card .student-info .student-details .status-inactive {
        color: #d97706;
        font-weight: 600;
    }
    .student-card .student-info .student-details .status-graduated {
        color: #4f46e5;
        font-weight: 600;
    }
    .student-card .student-info .student-details .status-left {
        color: #dc2626;
        font-weight: 600;
    }
    .student-card .student-actions {
        display: flex;
        gap: 8px;
    }
    .student-card .student-actions .btn-sm {
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .btn-sm-view {
        background: #eef2ff;
        color: #4f46e5;
    }
    .btn-sm-view:hover {
        background: #4f46e5;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }
    .btn-sm-edit {
        background: #fffbeb;
        color: #d97706;
    }
    .btn-sm-edit:hover {
        background: #d97706;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(217, 119, 6, 0.3);
    }

    /* Empty State */
    .empty-students {
        text-align: center;
        padding: 50px 20px;
        background: #f8fafc;
        border-radius: 14px;
        border: 2px dashed #e2e8f0;
    }
    .empty-students i {
        font-size: 3.5rem;
        color: #cbd5e1;
        display: block;
        margin-bottom: 12px;
    }
    .empty-students h5 {
        color: #0f172a;
        font-weight: 700;
        margin-bottom: 5px;
        font-size: 1.1rem;
    }
    .empty-students p {
        color: #94a3b8;
        font-size: 0.95rem;
        margin-bottom: 15px;
    }

    @media (max-width: 768px) {
        .room-detail-container {
            padding: 20px;
        }
        .top-action-bar {
            flex-direction: column;
            align-items: stretch;
        }
        .top-action-bar .btn {
            justify-content: center;
        }
        .room-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
        .room-header .room-title .room-number {
            font-size: 1.8rem;
        }
        .info-grid {
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .student-card {
            flex-direction: column;
            text-align: center;
            padding: 16px;
        }
        .student-card .student-actions {
            width: 100%;
            justify-content: center;
        }
        .bed-indicator {
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
        .room-header .room-title .room-number {
            font-size: 1.5rem;
        }
        .student-card .student-info .student-details {
            flex-direction: column;
            gap: 4px;
        }
    }
</style>

<div class="room-detail-container">
    <!-- Top Action Bar -->
    <div class="top-action-bar">
        <a href="{{ route('room-allocation.index') }}" class="btn btn-back">
            <i class="fas fa-arrow-left"></i> Back to Rooms
        </a>
        <a href="{{ route('room-allocation.edit', $room->id) }}" class="btn btn-edit">
            <i class="fas fa-edit"></i> Edit Room
        </a>
    </div>

    <!-- Room Header -->
    <div class="room-header">
        <div class="room-title">
            <span class="room-number">{{ $room->room_number }}</span>
            <span class="room-type">{{ ucfirst($room->room_type) }}</span>
        </div>
        <div>
            <span class="room-status {{ $room->status }}">
                <i class="fas {{ $room->status == 'available' ? 'fa-check-circle' : ($room->status == 'full' ? 'fa-times-circle' : 'fa-tools') }}"></i>
                {{ ucfirst($room->status) }}
            </span>
        </div>
    </div>

    <!-- Room Information -->
    <div class="info-grid">
        <div class="info-item">
            <span class="label"><i class="fas fa-door-open"></i> Room Number</span>
            <span class="value">{{ $room->room_number }}</span>
        </div>
        <div class="info-item">
            <span class="label"><i class="fas fa-tag"></i> Room Type</span>
            <span class="value">{{ ucfirst($room->room_type) }}</span>
        </div>
        <div class="info-item">
            <span class="label"><i class="fas fa-bed"></i> Total Beds</span>
            <span class="value">{{ $room->capacity }}</span>
        </div>
        <div class="info-item">
            <span class="label"><i class="fas fa-users"></i> Occupied</span>
            <span class="value occupied-beds">{{ $room->students->count() }} Students</span>
        </div>
        <div class="info-item">
            <span class="label"><i class="fas fa-bed"></i> Available Beds</span>
            <span class="value available-beds">{{ $room->capacity - $room->students->count() }}</span>
        </div>
        <div class="info-item">
            <span class="label"><i class="fas fa-map-marker-alt"></i> Location</span>
            <span class="value">Block {{ $room->block }} - Floor {{ $room->floor }}</span>
        </div>
        <div class="info-item">
            <span class="label"><i class="fas fa-chart-pie"></i> Occupancy Rate</span>
            <span class="value occupancy-rate">
                @if($room->capacity > 0)
                    {{ round(($room->students->count() / $room->capacity) * 100) }}%
                @else
                    0%
                @endif
            </span>
        </div>
        <div class="info-item" style="grid-column: 1 / -1;">
            <span class="label"><i class="fas fa-sticky-note"></i> Notes</span>
            <span class="value">{{ $room->notes ?? 'No notes available' }}</span>
        </div>
    </div>

    <!-- Bed Indicator -->
    <div class="bed-section">
        <span class="bed-label"><i class="fas fa-bed"></i> Bed Status</span>
        <div class="bed-indicator">
            @php
                $occupiedCount = $room->students->count();
                $availableCount = $room->capacity - $occupiedCount;
            @endphp
            @for($i = 1; $i <= $room->capacity; $i++)
                @if($i <= $occupiedCount)
                    <div class="bed occupied" title="Occupied by Student {{ $i }}">
                        <i class="fas fa-user"></i>
                    </div>
                @else
                    <div class="bed available" title="Available Bed">
                        <i class="fas fa-check"></i>
                    </div>
                @endif
            @endfor
        </div>
        <div class="bed-legend">
            <span><span class="legend-occupied"><i class="fas fa-bed"></i> Occupied</span> ({{ $occupiedCount }})</span>
            <span><span class="legend-available"><i class="fas fa-bed"></i> Available</span> ({{ $availableCount }})</span>
        </div>
    </div>

    <!-- Students Section -->
    <div class="students-section">
        <div class="section-title">
            <i class="fas fa-user-graduate"></i> Students Living in This Room
            <span class="badge-count">{{ $room->students->count() }} Students</span>
        </div>

        @if($room->students->count() > 0)
            @foreach($room->students as $student)
                <div class="student-card">
                    <div class="student-avatar">
                        @if($student->profile_picture)
                            <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="{{ $student->student_name }}">
                        @else
                            {{ substr($student->student_name, 0, 2) }}
                        @endif
                    </div>
                    <div class="student-info">
                        <div class="student-name">{{ $student->student_name }}</div>
                        <div class="student-details">
                            <span><i class="fas fa-phone"></i> {{ $student->phone_number ?? 'N/A' }}</span>
                            <span><i class="fas fa-id-card"></i> {{ $student->cnic_number ?? 'N/A' }}</span>
                            <span>
                                <i class="fas fa-circle" style="color: 
                                    @if($student->hostel_status == 'active') #059669 
                                    @elseif($student->hostel_status == 'inactive') #d97706 
                                    @elseif($student->hostel_status == 'graduated') #4f46e5 
                                    @else #dc2626 @endif;
                                    font-size: 0.6rem;">
                                </i>
                                <span class="status-{{ $student->hostel_status ?? 'active' }}">
                                    {{ ucfirst($student->hostel_status ?? 'Active') }}
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="student-actions">
                        <a href="{{ route('student.show', $student->id) }}" class="btn-sm btn-sm-view" title="View Student">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('student.edit', $student->id) }}" class="btn-sm btn-sm-edit" title="Edit Student">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="empty-students">
                <i class="fas fa-bed"></i>
                <h5>No Students Assigned</h5>
                <p>This room is currently empty. Students can be assigned from the student management section.</p>
                <a href="{{ route('student-records') }}" class="btn btn-edit" style="display:inline-flex;margin-top:10px;">
                    <i class="fas fa-user-plus"></i> Assign Students
                </a>
            </div>
        @endif
    </div>
</div>
@endsection