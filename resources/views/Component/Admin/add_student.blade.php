@extends('Layout.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/add_student.css') }}">

<div class="student-container">
    
    <div class="page-header-section">
        <h2>Add New Student</h2>
        <p class="text-muted">Fill in the details to register a new resident in GCW Hostel.</p>
    </div>

    <div class="form-card">
        <form id="addStudentForm" action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-section">
                <h5 class="section-title">
                    <i class="bi bi-person-badge"></i> Personal Information
                </h5>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Student Name <span class="text-danger">*</span></label>
                        <input type="text" name="student_name" class="form-control custom-input @error('student_name') is-invalid @enderror" 
                               placeholder="Enter full name" value="{{ old('student_name') }}" required>
                        @error('student_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Father Name <span class="text-danger">*</span></label>
                        <input type="text" name="father_name" class="form-control custom-input @error('father_name') is-invalid @enderror" 
                               placeholder="Enter father's name" value="{{ old('father_name') }}" required>
                        @error('father_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="tel" name="phone_number" class="form-control custom-input @error('phone_number') is-invalid @enderror" 
                               id="phoneInput" placeholder="0300-1234567" value="{{ old('phone_number') }}" required>
                        @error('phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">CNIC Number <span class="text-danger">*</span></label>
                        <input type="text" name="cnic_number" class="form-control custom-input @error('cnic_number') is-invalid @enderror" 
                               id="cnicInput" placeholder="35201-1234567-8" value="{{ old('cnic_number') }}" required>
                        @error('cnic_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control custom-input @error('email') is-invalid @enderror" 
                               placeholder="student@example.com" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control custom-input @error('date_of_birth') is-invalid @enderror" 
                               value="{{ old('date_of_birth') }}">
                        @error('date_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Address <span class="text-danger">*</span></label>
                        <textarea name="address" class="form-control custom-input @error('address') is-invalid @enderror" 
                                  rows="3" placeholder="Enter complete address" required>{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h5 class="section-title">
                    <i class="bi bi-building"></i> Hostel Information
                </h5>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Room Number</label>
                        <input type="text" name="room_number" class="form-control custom-input @error('room_number') is-invalid @enderror" 
                               placeholder="e.g., 101-A" value="{{ old('room_number') }}">
                        @error('room_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Hostel Status</label>
                        <select name="hostel_status" class="form-control custom-input @error('hostel_status') is-invalid @enderror">
                            <option value="active" {{ old('hostel_status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('hostel_status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="graduated" {{ old('hostel_status') == 'graduated' ? 'selected' : '' }}>Graduated</option>
                            <option value="left" {{ old('hostel_status') == 'left' ? 'selected' : '' }}>Left</option>
                        </select>
                        @error('hostel_status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-control custom-input @error('gender') is-invalid @enderror">
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Admission Date</label>
                        <input type="date" name="admission_date" class="form-control custom-input @error('admission_date') is-invalid @enderror" 
                               value="{{ old('admission_date') }}">
                        @error('admission_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h5 class="section-title">
                    <i class="bi bi-phone"></i> Contact & Emergency
                </h5>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Guardian Contact</label>
                        <input type="text" name="guardian_contact" class="form-control custom-input @error('guardian_contact') is-invalid @enderror" 
                               placeholder="0300-1234567" value="{{ old('guardian_contact') }}">
                        @error('guardian_contact')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Emergency Contact</label>
                        <input type="text" name="emergency_contact" class="form-control custom-input @error('emergency_contact') is-invalid @enderror" 
                               placeholder="0300-7654321" value="{{ old('emergency_contact') }}">
                        @error('emergency_contact')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h5 class="section-title">
                    <i class="bi bi-clipboard"></i> Additional Information
                </h5>
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label">Profile Picture</label>
                        <input type="file" name="profile_picture" class="form-control custom-input @error('profile_picture') is-invalid @enderror" 
                               accept="image/*">
                        <small class="text-muted">Maximum file size: 2MB. Supported formats: JPG, PNG, GIF</small>
                        @error('profile_picture')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Medical Conditions</label>
                        <textarea name="medical_conditions" class="form-control custom-input @error('medical_conditions') is-invalid @enderror" 
                                  rows="2" placeholder="Any medical conditions or allergies">{{ old('medical_conditions') }}</textarea>
                        @error('medical_conditions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" class="form-control custom-input @error('remarks') is-invalid @enderror" 
                                  rows="2" placeholder="Any additional remarks">{{ old('remarks') }}</textarea>
                        @error('remarks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('student-records') }}" class="btn btn-cancel">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
                <button type="submit" class="btn btn-save" id="submitBtn">
                    <i class="bi bi-check-circle"></i> Save Student
                </button>
            </div>

        </form>
    </div>
</div>

<style>
    /* Page Header */
    .page-header-section {
        margin-bottom: 25px;
    }
    .page-header-section h2 {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 5px;
    }
    .page-header-section .text-muted {
        font-size: 0.95rem;
    }

    /* Form Card */
    .form-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    /* Form Sections */
    .form-section {
        margin-bottom: 30px;
        padding-bottom: 25px;
        border-bottom: 1px solid #e9ecef;
    }
    .form-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .section-title {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .section-title i {
        color: #667eea;
    }

    /* Form Inputs */
    .custom-input {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 15px;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }
    .custom-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }
    .custom-input.is-invalid {
        border-color: #dc3545;
    }
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }
    .text-danger {
        color: #dc3545;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding-top: 20px;
        border-top: 2px solid #f1f3f5;
        margin-top: 10px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 10px 30px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
    }

    .btn-save {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-cancel {
        background: #f1f3f5;
        color: #6c757d;
    }
    .btn-cancel:hover {
        background: #e9ecef;
        color: #495057;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-card {
            padding: 20px 15px;
        }
        .form-actions {
            flex-direction: column;
        }
        .form-actions .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

@endsection