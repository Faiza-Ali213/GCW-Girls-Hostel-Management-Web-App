@extends('Layout.app')

@section('content')
<style>
    .complaint-container {
        max-width: 700px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .complaint-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid #eef2f6;
    }

    .complaint-card .card-header-custom {
        text-align: center;
        margin-bottom: 30px;
    }

    .complaint-card .card-header-custom .icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 2rem;
        color: #4F46E5;
    }

    .complaint-card .card-header-custom h3 {
        color: #0b1a33;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .complaint-card .card-header-custom p {
        color: #94a3b8;
        font-size: 0.95rem;
        margin-bottom: 0;
    }

    .form-label {
        font-weight: 600;
        color: #0b1a33;
        font-size: 0.9rem;
    }

    .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 11px 16px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        border-color: #4F46E5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.06);
    }

    .form-control.is-invalid {
        border-color: #EF4444;
    }

    .form-control::placeholder {
        color: #94a3b8;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    .btn-submit {
        background: linear-gradient(135deg, #4F46E5 0%, #4338CA 100%);
        color: white !important;
        border: none;
        padding: 14px 30px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        width: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(79, 70, 229, 0.25);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(79, 70, 229, 0.35);
        color: white !important;
    }

    .btn-submit i {
        margin-right: 8px;
    }

    .btn-back {
        background: #f1f3f5;
        color: #495057 !important;
        border: none;
        padding: 14px 30px;
        border-radius: 12px;
        font-weight: 600;
        width: 100%;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-back:hover {
        background: #e9ecef;
        color: #2c3e50 !important;
        text-decoration: none;
    }

    .form-section {
        margin-bottom: 25px;
    }

    .form-section .section-title {
        font-weight: 600;
        color: #0b1a33;
        font-size: 0.95rem;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f1f3f5;
    }

    .form-section .section-title i {
        color: #4F46E5;
        margin-right: 8px;
    }

    .required-star {
        color: #EF4444;
        margin-left: 2px;
    }

    .alert {
        border: none;
        padding: 15px 20px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-success {
        background: #ECFDF5;
        color: #065F46;
        border-left: 4px solid #10B981;
    }

    .alert-danger {
        background: #FEF2F2;
        color: #991B1B;
        border-left: 4px solid #EF4444;
    }

    @media (max-width: 768px) {
        .complaint-container {
            padding: 20px 15px;
        }

        .complaint-card {
            padding: 20px;
        }
    }
</style>

<div class="complaint-container">
    <div class="complaint-card">
        <!-- Header -->
        <div class="card-header-custom">
            <div class="icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <h3>Submit a Complaint</h3>
            <p>We value your feedback and will address your concern promptly</p>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Complaint Form -->
        <form action="{{ route('complaint.store') }}" method="POST">
            @csrf

            <!-- Student Information -->
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-user-graduate"></i> Your Information
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Full Name <span class="required-star">*</span></label>
                        <input type="text" class="form-control @error('student_name') is-invalid @enderror" 
                               name="student_name" placeholder="Enter your full name" 
                               value="{{ old('student_name') }}" required>
                        @error('student_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Room Number</label>
                        <input type="text" class="form-control @error('room_number') is-invalid @enderror" 
                               name="room_number" placeholder="e.g., 101" 
                               value="{{ old('room_number') }}">
                        @error('room_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Contact Number</label>
                        <input type="tel" class="form-control @error('contact_number') is-invalid @enderror" 
                               name="contact_number" placeholder="0300-1234567" 
                               value="{{ old('contact_number') }}">
                        @error('contact_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Complaint By</label>
                        <input type="text" class="form-control @error('complaint_by') is-invalid @enderror" 
                               name="complaint_by" placeholder="e.g., Student, Parent, Staff" 
                               value="{{ old('complaint_by') }}">
                        @error('complaint_by')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Complaint Details -->
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-comment-alt"></i> Complaint Details
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label class="form-label">Title <span class="required-star">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               name="title" placeholder="Brief title of your complaint" 
                               value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Priority</label>
                        <select class="form-control @error('priority') is-invalid @enderror" name="priority">
                            <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                        @error('priority')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" value="Pending" disabled>
                        <small class="text-muted">Your complaint will be reviewed by admin</small>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Description <span class="required-star">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  name="description" rows="5" 
                                  placeholder="Please describe your complaint in detail..." 
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="row">
                <div class="col-md-6 mb-2">
                    <a href="{{ route('home') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Cancel
                    </a>
                </div>
                <div class="col-md-6 mb-2">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Submit Complaint
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection