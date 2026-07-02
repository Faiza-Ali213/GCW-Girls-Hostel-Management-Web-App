@extends('Layout.admin')

@section('content')
<style>
    .staff-container {
        padding: 10px 0;
    }
    
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

    .btn-back {
        background: #f1f3f5;
        color: #6c757d;
    }
    .btn-back:hover {
        background: #e9ecef;
        color: #495057;
    }

    .form-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

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
    .invalid-feedback {
        font-size: 0.8rem;
        margin-top: 5px;
    }
    .form-text {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding-top: 20px;
        border-top: 2px solid #f1f3f5;
        margin-top: 10px;
        flex-wrap: wrap;
    }

    .btn-save {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        padding: 10px 30px;
    }
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-cancel {
        background: #f1f3f5;
        color: #6c757d;
        padding: 10px 30px;
    }
    .btn-cancel:hover {
        background: #e9ecef;
        color: #495057;
    }

    .current-picture {
        display: flex;
        align-items: center;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 10px;
        margin-bottom: 10px;
    }
    .current-picture img {
        object-fit: cover;
        border: 2px solid #e9ecef;
    }

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
        .page-header-section .d-flex {
            flex-direction: column;
            align-items: flex-start !important;
        }
    }
</style>

<div class="staff-container">
    
    <div class="page-header-section">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2>Add New Staff Member</h2>
                <p class="text-muted">Fill in the details to add a new staff member to the system.</p>
            </div>
            <a href="{{ route('staff_records') }}" class="btn btn-back">
                <i class="bi bi-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="form-card">
        <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Personal Information -->
            <div class="form-section">
                <h5 class="section-title">
                    <i class="bi bi-person-badge"></i> Personal Information
                </h5>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="name" class="form-label">
                            Full Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control custom-input @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" 
                               placeholder="Enter full name" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="role" class="form-label">
                            Role <span class="text-danger">*</span>
                        </label>
                        <select class="form-control custom-input @error('role') is-invalid @enderror" 
                                id="role" name="role" required>
                            <option value="">Select Role</option>
                            <option value="Warden" {{ old('role') == 'Warden' ? 'selected' : '' }}>Warden</option>
                            <option value="Kitchen Staff" {{ old('role') == 'Kitchen Staff' ? 'selected' : '' }}>Kitchen Staff</option>
                            <option value="Cleaner" {{ old('role') == 'Cleaner' ? 'selected' : '' }}>Cleaner</option>
                            <option value="Security Guard" {{ old('role') == 'Security Guard' ? 'selected' : '' }}>Security Guard</option>
                            <option value="Maintenance" {{ old('role') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                            <option value="Administrator" {{ old('role') == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                            <option value="Accountant" {{ old('role') == 'Accountant' ? 'selected' : '' }}>Accountant</option>
                            <option value="Housekeeping" {{ old('role') == 'Housekeeping' ? 'selected' : '' }}>Housekeeping</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">
                            Phone Number <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control custom-input @error('phone') is-invalid @enderror" 
                               id="phone" name="phone" value="{{ old('phone') }}" 
                               placeholder="e.g., 0312-4567890" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control custom-input @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" 
                               placeholder="staff@example.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control custom-input @error('address') is-invalid @enderror" 
                                  id="address" name="address" rows="2" 
                                  placeholder="Enter complete address">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Work Information -->
            <div class="form-section">
                <h5 class="section-title">
                    <i class="bi bi-briefcase"></i> Work Information
                </h5>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="duty_shift" class="form-label">
                            Duty / Shift <span class="text-danger">*</span>
                        </label>
                        <select class="form-control custom-input @error('duty_shift') is-invalid @enderror" 
                                id="duty_shift" name="duty_shift" required>
                            <option value="">Select Shift</option>
                            <option value="Morning (8 AM - 4 PM)" {{ old('duty_shift') == 'Morning (8 AM - 4 PM)' ? 'selected' : '' }}>Morning (8 AM - 4 PM)</option>
                            <option value="Evening (4 PM - 12 AM)" {{ old('duty_shift') == 'Evening (4 PM - 12 AM)' ? 'selected' : '' }}>Evening (4 PM - 12 AM)</option>
                            <option value="Night (12 AM - 8 AM)" {{ old('duty_shift') == 'Night (12 AM - 8 AM)' ? 'selected' : '' }}>Night (12 AM - 8 AM)</option>
                            <option value="Full Day" {{ old('duty_shift') == 'Full Day' ? 'selected' : '' }}>Full Day</option>
                        </select>
                        @error('duty_shift')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="joining_date" class="form-label">Joining Date</label>
                        <input type="date" class="form-control custom-input @error('joining_date') is-invalid @enderror" 
                               id="joining_date" name="joining_date" value="{{ old('joining_date') }}">
                        @error('joining_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="salary" class="form-label">Salary (PKR)</label>
                        <input type="number" step="0.01" class="form-control custom-input @error('salary') is-invalid @enderror" 
                               id="salary" name="salary" value="{{ old('salary') }}" 
                               placeholder="Enter monthly salary">
                        @error('salary')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control custom-input @error('status') is-invalid @enderror" 
                                id="status" name="status">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="form-section">
                <h5 class="section-title">
                    <i class="bi bi-image"></i> Profile Picture
                </h5>
                <div class="row g-4">
                    <div class="col-12">
                        <label for="profile_picture" class="form-label">Upload Profile Picture</label>
                        <input type="file" class="form-control custom-input @error('profile_picture') is-invalid @enderror" 
                               id="profile_picture" name="profile_picture" accept="image/*">
                        <small class="form-text">
                            <i class="bi bi-info-circle"></i> Max size: 2MB. Supported formats: JPG, PNG, GIF
                        </small>
                        @error('profile_picture')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea class="form-control custom-input @error('remarks') is-invalid @enderror" 
                                  id="remarks" name="remarks" rows="2" 
                                  placeholder="Any additional remarks">{{ old('remarks') }}</textarea>
                        @error('remarks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('staff_records') }}" class="btn btn-cancel">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
                <button type="submit" class="btn btn-save" id="submitBtn">
                    <i class="bi bi-check-circle"></i> Save Staff Member
                </button>
            </div>

        </form>
    </div>
</div>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
    // Form validation and image preview (optional)
    document.addEventListener('DOMContentLoaded', function() {
        // Image preview
        const profileInput = document.getElementById('profile_picture');
        if (profileInput) {
            profileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // You can add image preview logic here
                        console.log('Image selected:', file.name);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Auto-hide error messages after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.invalid-feedback');
            alerts.forEach(function(alert) {
                alert.style.display = 'none';
            });
        }, 5000);
    });
</script>

@endsection