<!DOCTYPE html>
<html>
<head>
    <title>Add Staff</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            background: #f0f2f5; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container { 
            margin-top: 50px; 
        }
        .card { 
            border-radius: 15px; 
            box-shadow: 0 0 30px rgba(0,0,0,0.1);
            border: none;
        }
        .card-header { 
            background: linear-gradient(135deg, #1a2035, #2d3447);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
        }
        .card-body {
            padding: 30px;
        }
        .btn-success {
            background: #28a745;
            border: none;
            padding: 10px 30px;
        }
        .btn-success:hover {
            background: #218838;
        }
        .btn-danger {
            padding: 10px 30px;
        }
        .form-label {
            font-weight: 600;
            color: #333;
        }
        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
        }
        .form-control:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.25);
        }
        .text-danger {
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-user-plus me-2"></i> Add New Staff
                    </h4>
                    <p class="mb-0 text-light opacity-75">Enter staff details </p>
                </div>
                <div class="card-body">
                    
                    {{-- INSERT FORM --}}
                    <form action="{{ route('staff.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-user me-1"></i> Full Name 
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" class="form-control" required placeholder="Enter full name">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-briefcase me-1"></i> Role 
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="role" class="form-control" required placeholder="e.g., Warden, Kitchen Staff">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-phone me-1"></i> Phone Number 
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="phone" class="form-control" required placeholder="e.g., 0312-4567890">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-clock me-1"></i> Duty / Shift 
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="duty_shift" class="form-control" required placeholder="e.g., Morning (8 AM - 4 PM)">
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('staff.index') }}" class="btn btn-danger">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Save Staff
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>