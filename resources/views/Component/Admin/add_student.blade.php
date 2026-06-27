@extends('Layout.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/add_student.css') }}">

<div class="student-container">
    
    <div class="page-header-section">
        <h2>Add New Student</h2>
        <p class="text-muted">Fill in the details to register a new resident in GCW Hostel.</p>
    </div>

    <div class="form-card">
        <form id="addStudentForm" action="{{ route('student.store') }}" method="POST">
            @csrf
            
            <div class="form-section">
                <h5 class="section-title">Personal Information</h5>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Student Name <span class="text-danger">*</span></label>
                        <input type="text" name="student_name" class="form-control custom-input" placeholder="Enter full name" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Father Name <span class="text-danger">*</span></label>
                        <input type="text" name="father_name" class="form-control custom-input" placeholder="Enter father's name" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="tel" name="phone_number" class="form-control custom-input" id="phoneInput" placeholder="0300-1234567" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">CNIC Number <span class="text-danger">*</span></label>
                        <input type="text" name="cnic_number" class="form-control custom-input" id="cnicInput" placeholder="35201-1234567-8" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Address <span class="text-danger">*</span></label>
                        <textarea name="address" class="form-control custom-input" rows="3" placeholder="Enter complete address" required></textarea>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('student.records') }}" class="btn btn-cancel">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
                <button type="submit" class="btn btn-save" id="submitBtn">
                    <i class="bi bi-check-circle"></i> Save Student
                </button>
            </div>

        </form>
    </div>
</div>

<script src="{{ asset('js/add_student.js') }}"></script>
@endsection