@extends('Layout.admin')

@section('content')
<div class="student-detail-container">
    
    <!-- Page Header -->
    <div class="page-header-section">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2>Student Details</h2>
                <p class="text-muted">Complete information about the student resident.</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('student.edit', $student->id) }}" class="btn btn-edit">
                    <i class="bi bi-pencil"></i> Edit Student
                </a>
                <a href="{{ route('student-records') }}" class="btn btn-back">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>

    <!-- Student Profile Card -->
    <div class="profile-card">
        <div class="row">
            <!-- Profile Image & Basic Info -->
            <div class="col-md-4 text-center">
                <div class="profile-image-wrapper">
                    @if($student->profile_picture)
                        <img src="{{ asset('storage/' . $student->profile_picture) }}" 
                             alt="{{ $student->student_name }}" 
                             class="profile-image">
                    @else
                        <div class="profile-avatar">
                            {{ substr($student->student_name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <h4 class="student-name-display">{{ $student->student_name }}</h4>
                <span class="status-badge status-{{ $student->hostel_status }}">
                    {{ ucfirst($student->hostel_status) }}
                </span>
                <p class="student-id mt-2">Student ID: #{{ $student->id }}</p>
            </div>

            <!-- Personal Information -->
            <div class="col-md-8">
                <div class="info-section">
                    <h5 class="section-title">
                        <i class="bi bi-person-badge"></i> Personal Information
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Student Name</label>
                                <p class="info-value">{{ $student->student_name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Father Name</label>
                                <p class="info-value">{{ $student->father_name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Phone Number</label>
                                <p class="info-value">{{ $student->phone_number }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">CNIC Number</label>
                                <p class="info-value">{{ $student->cnic_number }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Email Address</label>
                                <p class="info-value">{{ $student->email ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Date of Birth</label>
                                <p class="info-value">{{ $student->date_of_birth ? $student->date_of_birth->format('d-m-Y') : 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Gender</label>
                                <p class="info-value">{{ ucfirst($student->gender ?? 'N/A') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Age</label>
                                <p class="info-value">{{ $student->age ? $student->age . ' years' : 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="info-item">
                                <label class="info-label">Address</label>
                                <p class="info-value">{{ $student->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Information Cards -->
    <div class="row mt-4">
        <!-- Hostel Information -->
        <div class="col-md-6">
            <div class="info-card">
                <h5 class="section-title">
                    <i class="bi bi-building"></i> Hostel Information
                </h5>
                <div class="info-item">
                    <label class="info-label">Room Number</label>
                    <p class="info-value">{{ $student->room_number ?? 'Not Assigned' }}</p>
                </div>
                <div class="info-item">
                    <label class="info-label">Admission Date</label>
                    <p class="info-value">{{ $student->admission_date ? $student->admission_date->format('d-m-Y') : 'N/A' }}</p>
                </div>
                <div class="info-item">
                    <label class="info-label">Hostel Status</label>
                    <p class="info-value">
                        <span class="status-badge status-{{ $student->hostel_status }}">
                            {{ ucfirst($student->hostel_status) }}
                        </span>
                    </p>
                </div>
                <div class="info-item">
                    <label class="info-label">Registered Since</label>
                    <p class="info-value">{{ $student->created_at->format('d-m-Y H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Contact & Emergency -->
        <div class="col-md-6">
            <div class="info-card">
                <h5 class="section-title">
                    <i class="bi bi-phone"></i> Contact & Emergency
                </h5>
                <div class="info-item">
                    <label class="info-label">Guardian Contact</label>
                    <p class="info-value">{{ $student->guardian_contact ?? 'N/A' }}</p>
                </div>
                <div class="info-item">
                    <label class="info-label">Emergency Contact</label>
                    <p class="info-value">{{ $student->emergency_contact ?? 'N/A' }}</p>
                </div>
                <div class="info-item">
                    <label class="info-label">Medical Conditions</label>
                    <p class="info-value">{{ $student->medical_conditions ?? 'None reported' }}</p>
                </div>
                <div class="info-item">
                    <label class="info-label">Remarks</label>
                    <p class="info-value">{{ $student->remarks ?? 'No remarks' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons Bottom -->
    <div class="bottom-actions mt-4">
        <div class="d-flex justify-content-end gap-3 flex-wrap">
            <a href="{{ route('student.edit', $student->id) }}" class="btn btn-edit">
                <i class="bi bi-pencil"></i> Edit Student
            </a>
            <form action="{{ route('student.destroy', $student->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this student record?')">
                    <i class="bi bi-trash"></i> Delete Student
                </button>
            </form>
            <a href="{{ route('student-records') }}" class="btn btn-back">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
</div>

<style>
    /* Container */
    .student-detail-container {
        padding: 10px 0;
    }

    /* Page Header */
    .page-header-section {
        margin-bottom: 25px;
    }
    .page-header-section h2 {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 5px;
        font-size: 1.8rem;
    }
    .page-header-section .text-muted {
        font-size: 0.95rem;
        color: #6c757d;
    }

    .header-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    /* Buttons */
    .btn {
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
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .btn-edit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    .btn-edit:hover {
        color: white;
    }

    .btn-back {
        background: #f1f3f5;
        color: #6c757d;
    }
    .btn-back:hover {
        background: #e9ecef;
        color: #495057;
    }

    .btn-delete {
        background: #fbe9e7;
        color: #d32f2f;
    }
    .btn-delete:hover {
        background: #d32f2f;
        color: white;
    }

    /* Profile Card */
    .profile-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .profile-image-wrapper {
        margin-bottom: 15px;
    }
    .profile-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #667eea;
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.2);
    }
    .profile-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        font-weight: 700;
        margin: 0 auto;
        border: 4px solid #667eea;
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.2);
        text-transform: uppercase;
    }

    .student-name-display {
        font-weight: 700;
        color: #2c3e50;
        margin-top: 10px;
        margin-bottom: 5px;
    }
    .student-id {
        color: #6c757d;
        font-size: 0.9rem;
    }

    /* Info Sections */
    .info-section, .info-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        height: 100%;
    }
    .info-card {
        background: white;
        border: 1px solid #e9ecef;
        padding: 20px 25px;
    }

    .section-title {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 20px;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .section-title i {
        color: #667eea;
        font-size: 1.2rem;
    }

    .info-item {
        margin-bottom: 15px;
    }
    .info-item:last-child {
        margin-bottom: 0;
    }

    .info-label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        margin-bottom: 3px;
    }
    .info-value {
        font-size: 1rem;
        color: #2c3e50;
        margin: 0;
        font-weight: 500;
        word-break: break-word;
    }

    /* Status Badges */
    .status-badge {
        padding: 5px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }
    .status-active { background: #d4edda; color: #155724; }
    .status-inactive { background: #fff3cd; color: #856404; }
    .status-graduated { background: #d1ecf1; color: #0c5460; }
    .status-left { background: #f8d7da; color: #721c24; }

    /* Bottom Actions */
    .bottom-actions {
        padding-top: 10px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-card {
            padding: 20px 15px;
        }
        .profile-image, .profile-avatar {
            width: 120px;
            height: 120px;
            font-size: 3rem;
        }
        .header-actions {
            width: 100%;
        }
        .header-actions .btn {
            flex: 1;
            justify-content: center;
        }
        .bottom-actions .d-flex {
            flex-direction: column;
        }
        .bottom-actions .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

@endsection