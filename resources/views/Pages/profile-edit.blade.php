<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GCW Hostel - Edit Profile</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #f0f4f8;
            min-height: 100vh;
            padding: 2rem 0;
        }

        /* Navbar Custom */
        .navbar-custom {
            background: linear-gradient(135deg, #0b2b3c 0%, #1a4b5e 100%);
            padding: 0.8rem 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .navbar-custom .navbar-brand {
            color: #fff;
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }

        .navbar-custom .navbar-brand i {
            color: #6fc3d9;
            margin-right: 10px;
        }

        .navbar-custom .navbar-brand span {
            color: #6fc3d9;
        }

        .navbar-custom .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: 0.2s;
        }

        .navbar-custom .nav-link:hover {
            color: #fff !important;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
        }

        .navbar-custom .nav-link.active {
            color: #fff !important;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 8px;
        }

        /* Main Container */
        .profile-container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        /* Breadcrumb */
        .breadcrumb-custom {
            background: white;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            margin-bottom: 1.8rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            flex-wrap: wrap;
        }

        .breadcrumb-custom i {
            color: #1a4b5e;
        }

        .breadcrumb-custom .path {
            color: #1a4b5e;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .breadcrumb-custom .path span {
            background: #e3ecf3;
            padding: 0.2rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #0b2b3c;
            margin-left: 6px;
        }

        .breadcrumb-custom .badge-active {
            background: #1f6579;
            color: white;
            padding: 0.2rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Profile Card */
        .profile-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .profile-header {
            background: linear-gradient(135deg, #0b2b3c 0%, #1f6579 100%);
            padding: 2rem 2rem 1.5rem;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .profile-header .user-info {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }

        .profile-header .user-info .avatar {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            border: 3px solid rgba(255, 255, 255, 0.4);
        }

        .profile-header .user-info h4 {
            font-weight: 600;
            margin: 0;
        }

        .profile-header .user-info small {
            opacity: 0.8;
            font-weight: 400;
        }

        .profile-header .user-stats {
            display: flex;
            gap: 2rem;
            background: rgba(255, 255, 255, 0.1);
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
        }

        .profile-header .user-stats .stat {
            text-align: center;
        }

        .profile-header .user-stats .stat strong {
            display: block;
            font-size: 1.2rem;
        }

        .profile-header .user-stats .stat span {
            font-size: 0.75rem;
            opacity: 0.8;
        }

        /* Profile Body */
        .profile-body {
            padding: 2rem;
        }

        .profile-body .section-title {
            font-size: 1rem;
            font-weight: 600;
            color: #0b2b3c;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-body .section-title i {
            color: #1f6579;
        }

        .profile-body .section-title::after {
            content: '';
            flex: 1;
            height: 2px;
            background: linear-gradient(to right, #dce8f0, transparent);
        }

        /* Edit Form */
        .edit-form .form-group {
            margin-bottom: 1.5rem;
        }

        .edit-form .form-group label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #1a4b5e;
            margin-bottom: 0.4rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .edit-form .form-group label i {
            color: #1f6579;
            width: 1.2rem;
        }

        .edit-form .form-group .form-control,
        .edit-form .form-group .form-select {
            border: 2px solid #e5edf3;
            border-radius: 12px;
            padding: 0.7rem 1.2rem;
            font-size: 0.95rem;
            transition: 0.2s;
            background: #fafcfe;
        }

        .edit-form .form-group .form-control:focus,
        .edit-form .form-group .form-select:focus {
            border-color: #1f6579;
            box-shadow: 0 0 0 4px rgba(31, 101, 121, 0.1);
            background: white;
        }

        .edit-form .form-group .form-control::placeholder {
            color: #b0c8d6;
        }

        .edit-form .form-group .form-control[readonly] {
            background: #f0f4f8;
            cursor: not-allowed;
        }

        /* Action Buttons */
        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            padding-top: 1.5rem;
            border-top: 2px solid #f0f4f8;
            margin-top: 1rem;
        }

        .btn-cancel {
            background: transparent;
            border: 2px solid #d0dee9;
            color: #1a4b5e;
            padding: 0.6rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-cancel:hover {
            background: #f0f4f8;
            border-color: #b0c8d6;
        }

        .btn-save {
            background: #1f6579;
            border: none;
            color: white;
            padding: 0.6rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-save:hover {
            background: #104c5e;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(31, 101, 121, 0.3);
        }

        .btn-save i {
            font-size: 1rem;
        }

        /* Footer */
        .footer-meta {
            margin-top: 2rem;
            padding: 1.2rem 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            font-size: 0.85rem;
            color: #3f6b7e;
        }

        .footer-meta i {
            color: #1f6579;
            margin-right: 6px;
        }

        .footer-meta .weather i {
            color: #f39c12;
        }

        .footer-meta .time-lang {
            display: flex;
            gap: 1.2rem;
            align-items: center;
        }

        .footer-meta .time-lang span {
            background: #f0f4f8;
            padding: 0.2rem 0.8rem;
            border-radius: 20px;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .profile-header .user-info {
                flex-direction: column;
            }

            .profile-header .user-stats {
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
                border-radius: 20px;
                padding: 0.8rem 1.2rem;
            }

            .profile-body {
                padding: 1.2rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .form-actions .btn {
                width: 100%;
                justify-content: center;
            }

            .footer-meta {
                flex-direction: column;
                gap: 0.8rem;
                text-align: center;
            }

            .breadcrumb-custom {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .profile-header .user-stats {
                flex-direction: column;
                gap: 0.5rem;
                border-radius: 16px;
                width: 100%;
            }

            .profile-header .user-stats .stat {
                display: flex;
                justify-content: space-between;
                padding: 0.3rem 0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .profile-header .user-stats .stat:last-child {
                border-bottom: none;
            }

            .profile-header .user-stats .stat strong {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

    <!-- ====== NAVBAR ====== -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-building"></i> GCW <span>Hostel</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rooms') }}">
                            <i class="fas fa-door-open"></i> Rooms
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('booking') }}">
                            <i class="fas fa-calendar-check"></i> Booking
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user-edit"></i> Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ====== MAIN CONTENT ====== -->
    <div class="profile-container">

        <!-- Breadcrumb -->
        <div class="breadcrumb-custom">
            <i class="fas fa-route"></i>
            <span class="path">
                / <a href="{{ route('home') }}" class="text-decoration-none text-dark">Home</a>
                / <a href="#" class="text-decoration-none text-dark">Profile</a>
                / <span>Edit Profile <span class="badge-active">Active</span></span>
            </span>
        </div>

        <!-- Profile Card -->
        <div class="profile-card">

            <!-- Header -->
            <div class="profile-header">
                <div class="user-info">
                    <div class="avatar">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div>
                        <h4>{{ $user->name ?? 'Faiza Ahmed' }}</h4>
                        <small><i class="fas fa-envelope"></i> {{ $user->email ?? 'faiza@example.com' }}</small>
                        <br>
                        <small><i class="fas fa-id-badge"></i> Student ID: {{ $user->student_id ?? 'GCW-2024-001' }}</small>
                    </div>
                </div>
                <div class="user-stats">
                    <div class="stat">
                        <strong>{{ $totalStudents ?? '2' }}</strong>
                        <span>Students</span>
                    </div>
                    <div class="stat">
                        <strong>{{ $totalRooms ?? '0' }}</strong>
                        <span>Rooms</span>
                    </div>
                    <div class="stat">
                        <strong>{{ $totalStaff ?? '1' }}</strong>
                        <span>Staff</span>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="profile-body">

                <!-- Personal Information -->
                <div class="section-title">
                    <i class="fas fa-id-card"></i> Personal Information
                </div>

                <form class="edit-form" id="editProfileForm" action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fas fa-user"></i> Full Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name ?? 'Faiza Ahmed') }}" placeholder="Full Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fas fa-envelope"></i> Email Address</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email ?? 'faiza@example.com') }}" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fas fa-user-tag"></i> Role</label>
                                <select class="form-select" name="role">
                                    <option value="student" {{ (old('role', $user->role ?? 'student') == 'student') ? 'selected' : '' }}>Student</option>
                                    <option value="staff" {{ (old('role', $user->role ?? '') == 'staff') ? 'selected' : '' }}>Staff</option>
                                    <option value="admin" {{ (old('role', $user->role ?? '') == 'admin') ? 'selected' : '' }}>Admin</option>
                                    <option value="manager" {{ (old('role', $user->role ?? '') == 'manager') ? 'selected' : '' }}>Manager</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fas fa-phone"></i> Phone Number</label>
                                <input type="tel" class="form-control" name="phone" value="{{ old('phone', $user->phone ?? '+92 300 1234567') }}" placeholder="Phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fas fa-calendar-alt"></i> Date of Birth</label>
                                <input type="date" class="form-control" name="dob" value="{{ old('dob', $user->dob ?? '2000-01-15') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fas fa-venus-mars"></i> Gender</label>
                                <select class="form-select" name="gender">
                                    <option value="female" {{ (old('gender', $user->gender ?? 'female') == 'female') ? 'selected' : '' }}>Female</option>
                                    <option value="male" {{ (old('gender', $user->gender ?? '') == 'male') ? 'selected' : '' }}>Male</option>
                                    <option value="other" {{ (old('gender', $user->gender ?? '') == 'other') ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Account Information -->
                    <div class="section-title mt-4">
                        <i class="fas fa-user-cog"></i> Account Information
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fas fa-circle"></i> Account Status</label>
                                <select class="form-select" name="status">
                                    <option value="active" {{ (old('status', $user->status ?? 'active') == 'active') ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ (old('status', $user->status ?? '') == 'inactive') ? 'selected' : '' }}>Inactive</option>
                                    <option value="suspended" {{ (old('status', $user->status ?? '') == 'suspended') ? 'selected' : '' }}>Suspended</option>
                                    <option value="pending" {{ (old('status', $user->status ?? '') == 'pending') ? 'selected' : '' }}>Pending</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fas fa-clock"></i> Last Login</label>
                                <input type="text" class="form-control" value="{{ $user->last_login ?? '10:40 PM, 7/20/2026' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fas fa-home"></i> Hostel</label>
                                <input type="text" class="form-control" name="hostel" value="{{ old('hostel', $user->hostel ?? 'GCW Hostel') }}" placeholder="Hostel">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fas fa-map-pin"></i> Location</label>
                                <input type="text" class="form-control" name="location" value="{{ old('location', $user->location ?? 'Gujranwala, Pakistan') }}" placeholder="Location">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fas fa-user-plus"></i> Member Since</label>
                                <input type="text" class="form-control" value="{{ $user->created_at ?? 'January 2024' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fas fa-hashtag"></i> Student ID</label>
                                <input type="text" class="form-control" value="{{ $user->student_id ?? 'GCW-2024-001' }}" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('profile') }}" class="btn-cancel">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <button type="submit" class="btn-save">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <!-- Footer -->
        <div class="footer-meta">
            <div class="location">
                <i class="fas fa-map-marker-alt"></i> Gujranwala, Pakistan
            </div>
            <div class="weather">
                <i class="fas fa-sun"></i> 37°C
            </div>
            <div class="time-lang">
                <span>ENG</span>
                <span><i class="far fa-clock"></i> 10:40 PM</span>
                <span>7/20/2026</span>
            </div>
        </div>

    </div>

    <!-- ====== SCRIPTS ====== -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('editProfileForm');
            
            // Form validation
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    alert('Please fill in all required fields.');
                }
            });
            
            // Remove invalid class on input
            document.querySelectorAll('.form-control, .form-select').forEach(el => {
                el.addEventListener('input', function() {
                    this.classList.remove('is-invalid');
                });
            });
        });
    </script>
    
    <!-- Add this CSS for validation -->
    <style>
        .is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.1) !important;
        }
    </style>

</body>
</html>