@extends('Layout.admin')

@section('page_title', 'View Student')
@section('page_subtitle', 'Student details and information')

@section('content')
<style>
/* ============================================
   PROFESSIONAL VIEW STUDENT PAGE
   ============================================ */

/* Page Container */
.view-user-page {
    max-width: 900px;
    margin: 0 auto;
    padding: 10px 0;
}

/* Back Button */
.back-button-wrapper {
    margin-bottom: 24px;
}

.back-button {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 10px 20px;
    color: #64748B;
    font-weight: 500;
    font-size: 14px;
    text-decoration: none;
    border-radius: 10px;
    transition: all 0.3s ease;
    background: #F8FAFC;
    border: 1px solid #E2E8F0;
}

.back-button:hover {
    background: #F1F5F9;
    border-color: #CBD5E1;
    color: #1E293B;
    text-decoration: none;
}

.back-button i {
    font-size: 18px;
}

/* Main Card */
.profile-card {
    background: #FFFFFF;
    border-radius: 20px;
    border: 1px solid #E2E8F0;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
}

/* Card Header */
.profile-card-header {
    padding: 24px 32px;
    border-bottom: 1px solid #F1F5F9;
    background: #FAFBFC;
    display: flex;
    align-items: center;
    gap: 16px;
}

.header-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: #EEF2FF;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #4F46E5;
    font-size: 20px;
    flex-shrink: 0;
}

.header-title {
    font-size: 18px;
    font-weight: 700;
    color: #0F172A;
    margin: 0;
}

.header-subtitle {
    font-size: 14px;
    color: #94A3B8;
    margin: 0;
}

/* Card Body */
.profile-card-body {
    padding: 32px;
}

/* Profile Header */
.profile-header {
    display: flex;
    align-items: center;
    gap: 24px;
    padding-bottom: 24px;
    border-bottom: 1px solid #F1F5F9;
    margin-bottom: 24px;
}

.profile-avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #EEF2FF;
    flex-shrink: 0;
}

.profile-name-section {
    flex: 1;
}

.profile-name {
    font-size: 24px;
    font-weight: 700;
    color: #0F172A;
    margin: 0;
}

.profile-email {
    font-size: 14px;
    color: #64748B;
    margin: 4px 0 8px;
}

.profile-badges {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.badge-custom {
    padding: 4px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.badge-role {
    background: #EEF2FF;
    color: #4338CA;
}

.badge-status {
    background: #ECFDF5;
    color: #065F46;
}

.badge-status.inactive {
    background: #FEF2F2;
    color: #991B1B;
}

.badge-status.graduated {
    background: #EEF2FF;
    color: #4F46E5;
}

.badge-status.left {
    background: #FEF3C7;
    color: #92400E;
}

/* Info Grid */
.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.info-item {
    padding: 16px 20px;
    background: #F8FAFC;
    border-radius: 12px;
    border: 1px solid #F1F5F9;
}

.info-label {
    font-size: 12px;
    font-weight: 600;
    color: #94A3B8;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: block;
    margin-bottom: 4px;
}

.info-value {
    font-size: 15px;
    font-weight: 500;
    color: #0F172A;
}

.info-value .text-muted {
    color: #94A3B8;
    font-weight: 400;
}

/* Action Buttons */
.profile-actions {
    margin-top: 24px;
    padding-top: 24px;
    border-top: 1px solid #F1F5F9;
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.btn {
    padding: 10px 28px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}

.btn-secondary {
    background: #F1F5F9;
    border: 1px solid #E2E8F0;
    color: #64748B;
}

.btn-secondary:hover {
    background: #E2E8F0;
    color: #0F172A;
    text-decoration: none;
}

.btn-primary {
    background: #4F46E5;
    border: none;
    color: #FFFFFF;
}

.btn-primary:hover {
    background: #4338CA;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    color: #FFFFFF;
    text-decoration: none;
}

.btn-warning {
    background: #F59E0B;
    border: none;
    color: #FFFFFF;
}

.btn-warning:hover {
    background: #D97706;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    color: #FFFFFF;
    text-decoration: none;
}

.btn-danger {
    background: #EF4444;
    border: none;
    color: #FFFFFF;
}

.btn-danger:hover {
    background: #DC2626;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    color: #FFFFFF;
    text-decoration: none;
}

/* Responsive */
@media (max-width: 768px) {
    .profile-card-header {
        padding: 20px;
        flex-direction: column;
        text-align: center;
    }
    
    .profile-card-body {
        padding: 20px;
    }
    
    .profile-header {
        flex-direction: column;
        text-align: center;
    }
    
    .profile-avatar {
        width: 80px;
        height: 80px;
    }
    
    .profile-badges {
        justify-content: center;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    
    .profile-actions {
        flex-direction: column;
    }
    
    .profile-actions .btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .view-user-page {
        padding: 0;
    }
    
    .back-button-wrapper {
        margin-bottom: 16px;
    }
    
    .back-button {
        padding: 8px 16px;
        font-size: 13px;
    }
    
    .profile-card-body {
        padding: 16px;
    }
    
    .profile-name {
        font-size: 20px;
    }
}
</style>

<div class="view-user-page">
    <!-- Back Button -->
    <div class="back-button-wrapper">
        <a href="{{ route('student-records') }}" class="back-button">
            <i class="bi bi-arrow-left"></i>
            Back to Student Records
        </a>
    </div>

    <!-- Main Profile Card -->
    <div class="profile-card">
        <!-- Card Header -->
        <div class="profile-card-header">
            <div class="header-icon">
                <i class="bi bi-person-circle"></i>
            </div>
            <div>
                <h4 class="header-title">Student Profile</h4>
                <p class="header-subtitle">View student details and information</p>
            </div>
        </div>

        <!-- Card Body -->
        <div class="profile-card-body">
            <!-- Profile Header -->
            <div class="profile-header">
                @if(isset($student->profile_picture) && $student->profile_picture)
                    <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="{{ $student->student_name }}" class="profile-avatar">
                @else
                    <div class="profile-avatar" style="display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#4338CA,#4F46E5);color:#fff;font-size:40px;font-weight:700;">
                        {{ isset($student->student_name) ? strtoupper(substr($student->student_name, 0, 1)) : 'S' }}
                    </div>
                @endif
                <div class="profile-name-section">
                    <h2 class="profile-name">{{ $student->student_name ?? 'N/A' }}</h2>
                    <p class="profile-email">{{ $student->email ?? 'No email provided' }}</p>
                    <div class="profile-badges">
                        <span class="badge-custom badge-role">
                            <i class="bi bi-person"></i>
                            Student
                        </span>
                        <span class="badge-custom badge-status {{ $student->hostel_status ?? 'active' }}">
                            <span class="status-dot" style="display:inline-block;width:8px;height:8px;border-radius:50%;background:{{ ($student->hostel_status ?? 'active') === 'active' ? '#10B981' : (($student->hostel_status ?? 'active') === 'graduated' ? '#4F46E5' : (($student->hostel_status ?? 'active') === 'left' ? '#F59E0B' : '#EF4444')) }};margin-right:4px;"></span>
                            {{ ucfirst($student->hostel_status ?? 'Active') }}
                        </span>
                        @if(isset($student->room_number) && $student->room_number)
                            <span class="badge-custom" style="background:#E0F2FE;color:#0EA5E9;">
                                <i class="bi bi-door-open"></i> Room {{ $student->room_number }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Information Grid -->
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-person"></i> Student Name</span>
                    <span class="info-value">{{ $student->student_name ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-person-fill"></i> Father's Name</span>
                    <span class="info-value">{{ $student->father_name ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-envelope"></i> Email Address</span>
                    <span class="info-value">{{ $student->email ?? 'Not provided' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-phone"></i> Phone Number</span>
                    <span class="info-value">{{ $student->phone_number ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-credit-card"></i> CNIC</span>
                    <span class="info-value">{{ $student->cnic_number ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-person-badge"></i> Gender</span>
                    <span class="info-value">{{ isset($student->gender) ? ucfirst($student->gender) : 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-calendar"></i> Date of Birth</span>
                    <span class="info-value">{{ isset($student->date_of_birth) ? date('d M Y', strtotime($student->date_of_birth)) : 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-geo-alt"></i> Address</span>
                    <span class="info-value">{{ $student->address ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-house"></i> Room Number</span>
                    <span class="info-value">{{ $student->room_number ?? 'Not Allocated' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-calendar-check"></i> Admission Date</span>
                    <span class="info-value">{{ isset($student->admission_date) ? date('d M Y', strtotime($student->admission_date)) : 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-telephone"></i> Guardian Contact</span>
                    <span class="info-value">{{ $student->guardian_contact ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-exclamation-triangle"></i> Emergency Contact</span>
                    <span class="info-value">{{ $student->emergency_contact ?? 'N/A' }}</span>
                </div>
                <div class="info-item" style="grid-column: 1 / -1;">
                    <span class="info-label"><i class="bi bi-heart"></i> Medical Conditions</span>
                    <span class="info-value">{{ $student->medical_conditions ?? 'None' }}</span>
                </div>
                <div class="info-item" style="grid-column: 1 / -1;">
                    <span class="info-label"><i class="bi bi-sticky"></i> Remarks</span>
                    <span class="info-value">{{ $student->remarks ?? 'No remarks' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-clock-history"></i> Registered On</span>
                    <span class="info-value">{{ isset($student->created_at) ? date('F d, Y', strtotime($student->created_at)) : 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label"><i class="bi bi-calendar-plus"></i> Last Updated</span>
                    <span class="info-value">{{ isset($student->updated_at) ? date('F d, Y H:i A', strtotime($student->updated_at)) : 'N/A' }}</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="profile-actions">
                <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil me-2"></i> Edit Student
                </a>
                <a href="{{ route('student-records') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i> Back to List
                </a>
                <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $student->id }}, '{{ addslashes($student->student_name) }}')">
                    <i class="bi bi-trash3 me-2"></i> Delete Student
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Form (Hidden) -->
<form id="deleteForm" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
function confirmDelete(studentId, studentName) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You are about to delete '" + studentName + "'. This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Create form dynamically to avoid route concatenation issues
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '/student/' + studentId;
            
            // Add CSRF token
            var csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);
            
            // Add DELETE method
            var methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
@endsection