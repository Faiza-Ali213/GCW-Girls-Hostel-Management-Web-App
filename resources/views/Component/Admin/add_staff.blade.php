@extends('Layout.admin')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .form-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .form-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px 30px;
    }
    
    .form-header h3 {
        margin: 0;
        font-weight: 600;
    }
    
    .form-header p {
        margin: 5px 0 0;
        opacity: 0.9;
    }
    
    .form-body {
        padding: 30px;
    }
    
    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }
    
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        padding: 10px 15px;
        transition: all 0.3s;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102,126,234,0.25);
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 12px 30px;
        font-weight: 600;
        border-radius: 8px;
        color: white;
        transition: all 0.3s;
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102,126,234,0.4);
    }
    
    .btn-back {
        background: #6c757d;
        border: none;
        padding: 12px 30px;
        font-weight: 600;
        border-radius: 8px;
        color: white;
        margin-right: 10px;
    }
    
    .btn-back:hover {
        background: #5a6268;
    }
    
    .required-field::after {
        content: '*';
        color: red;
        margin-left: 5px;
    }
    
    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border-radius: 8px;
        padding: 10px 15px;
        margin-bottom: 20px;
    }
    
    .form-row {
        margin-bottom: 20px;
    }
    
    @media (max-width: 768px) {
        .form-body {
            padding: 20px;
        }
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h3><i class="bi bi-person-plus"></i> Add New Staff Member</h3>
            <p>Fill in the details to add a new staff member to the system</p>
        </div>
        
        <div class="form-body">
            @if ($errors->any())
                <div class="alert-error">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('staff.store') }}" method="POST" id="staffForm">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <label class="form-label required-field">Full Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" placeholder="Enter full name" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-row">
                            <label class="form-label required-field">Role</label>
                            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="">Select Role</option>
                                <option value="Warden" {{ old('role') == 'Warden' ? 'selected' : '' }}>Warden</option>
                                <option value="Kitchen Staff" {{ old('role') == 'Kitchen Staff' ? 'selected' : '' }}>Kitchen Staff</option>
                                <option value="Housekeeping" {{ old('role') == 'Housekeeping' ? 'selected' : '' }}>Housekeeping</option>
                                <option value="Security Guard" {{ old('role') == 'Security Guard' ? 'selected' : '' }}>Security Guard</option>
                                <option value="Maintenance" {{ old('role') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                <option value="Accountant" {{ old('role') == 'Accountant' ? 'selected' : '' }}>Accountant</option>
                                <option value="Manager" {{ old('role') == 'Manager' ? 'selected' : '' }}>Manager</option>
                                <option value="Clerk" {{ old('role') == 'Clerk' ? 'selected' : '' }}>Clerk</option>
                            </select>
                            @error('role')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <label class="form-label required-field">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" 
                                   value="{{ old('phone_number') }}" placeholder="Enter phone number" required>
                            @error('phone_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-row">
                            <label class="form-label required-field">Duty Shift</label>
                            <select name="duty_shift" class="form-select @error('duty_shift') is-invalid @enderror" required>
                                <option value="">Select Shift</option>
                                <option value="Morning (8 AM - 4 PM)" {{ old('duty_shift') == 'Morning (8 AM - 4 PM)' ? 'selected' : '' }}>Morning (8 AM - 4 PM)</option>
                                <option value="Evening (4 PM - 12 AM)" {{ old('duty_shift') == 'Evening (4 PM - 12 AM)' ? 'selected' : '' }}>Evening (4 PM - 12 AM)</option>
                                <option value="Night (12 AM - 8 AM)" {{ old('duty_shift') == 'Night (12 AM - 8 AM)' ? 'selected' : '' }}>Night (12 AM - 8 AM)</option>
                                <option value="Full Day" {{ old('duty_shift') == 'Full Day' ? 'selected' : '' }}>Full Day</option>
                                <option value="Rotational" {{ old('duty_shift') == 'Rotational' ? 'selected' : '' }}>Rotational</option>
                            </select>
                            @error('duty_shift')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" placeholder="Enter email address">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-row">
                            <label class="form-label">Joining Date</label>
                            <input type="date" name="joining_date" class="form-control @error('joining_date') is-invalid @enderror" 
                                   value="{{ old('joining_date') }}">
                            @error('joining_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-row">
                            <label class="form-label">Salary (PKR)</label>
                            <input type="number" name="salary" class="form-control @error('salary') is-invalid @enderror" 
                                   value="{{ old('salary') }}" placeholder="Enter salary amount" step="0.01">
                            @error('salary')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-row">
                            <label class="form-label required-field">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="text-end mt-4">
                    <a href="{{ route('staff.index') }}" class="btn-back">
                        <i class="bi bi-arrow-left"></i> Back to List
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-save"></i> Save Staff Member
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection