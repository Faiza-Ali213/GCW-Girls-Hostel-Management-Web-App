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
            background: #e8dcc8;
            min-height: 100vh;
            padding: 2rem 0;
        }

        /* Navbar Custom */
        .navbar-custom {
            background: #4A3228;
            padding: 0.8rem 0;
            box-shadow: 0 4px 20px rgba(74, 50, 40, 0.3);
        }

        .navbar-custom .navbar-brand {
            color: #FFFFFF;
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }

        .navbar-custom .navbar-brand i {
            color: #C49A6C;
            margin-right: 10px;
        }

        .navbar-custom .navbar-brand span {
            color: #C49A6C;
        }

        .navbar-custom .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: 0.2s;
        }

        .navbar-custom .nav-link:hover {
            color: #FFFFFF !important;
            background: rgba(196, 154, 108, 0.15);
            border-radius: 8px;
        }

        .navbar-custom .nav-link.active {
            color: #FFFFFF !important;
            background: rgba(196, 154, 108, 0.2);
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
            background: #f5efe6;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(74, 50, 40, 0.08);
            margin-bottom: 1.8rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            flex-wrap: wrap;
            border: 1px solid rgba(196, 154, 108, 0.2);
        }

        .breadcrumb-custom i {
            color: #8B6B4A;
        }

        .breadcrumb-custom .path {
            color: #6B5544;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .breadcrumb-custom .path span {
            background: #e8dcc8;
            padding: 0.2rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #4A3228;
            margin-left: 6px;
        }

        .breadcrumb-custom .badge-active {
            background: #8B6B4A;
            color: #FFFFFF;
            padding: 0.2rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Profile Card */
        .profile-card {
            background: #f5efe6;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(74, 50, 40, 0.12);
            overflow: hidden;
            border: 1px solid rgba(196, 154, 108, 0.15);
        }

        .profile-header {
            background: linear-gradient(135deg, #4A3228 0%, #6B5544 100%);
            padding: 2rem 2rem 1.5rem;
            color: #FFFFFF;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            border-bottom: 3px solid #C49A6C;
        }

        .profile-header .user-info {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }

        .profile-header .user-info .avatar {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #C49A6C, #A8825A);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            color: #4A3228;
            border: 3px solid #C49A6C;
        }

        .profile-header .user-info h4 {
            font-weight: 600;
            margin: 0;
            color: #FFFFFF;
        }

        .profile-header .user-info small {
            opacity: 0.8;
            font-weight: 400;
            color: #f5efe6;
        }

        .profile-header .user-stats {
            display: flex;
            gap: 2rem;
            background: rgba(255, 255, 255, 0.08);
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            border: 1px solid rgba(196, 154, 108, 0.2);
        }

        .profile-header .user-stats .stat {
            text-align: center;
        }

        .profile-header .user-stats .stat strong {
            display: block;
            font-size: 1.2rem;
            color: #C49A6C;
        }

        .profile-header .user-stats .stat span {
            font-size: 0.75rem;
            opacity: 0.7;
            color: #f5efe6;
        }

        /* Profile Body */
        .profile-body {
            padding: 2rem;
            background: #f5efe6;
        }

        .profile-body .section-title {
            font-size: 1rem;
            font-weight: 600;
            color: #4A3228;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-body .section-title i {
            color: #8B6B4A;
        }

        .profile-body .section-title::after {
            content: '';
            flex: 1;
            height: 2px;
            background: linear-gradient(to right, #C49A6C, transparent);
        }

        /* Edit Form */
        .edit-form .form-group {
            margin-bottom: 1.5rem;
        }

        .edit-form .form-group label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #6B5544;
            margin-bottom: 0.4rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .edit-form .form-group label i {
            color: #8B6B4A;
            width: 1.2rem;
        }

        .edit-form .form-group .form-control,
        .edit-form .form-group .form-select {
            border: 2px solid #d5c9b8;
            border-radius: 12px;
            padding: 0.7rem 1.2rem;
            font-size: 0.95rem;
            transition: 0.2s;
            background: #FFFFFF;
            color: #4A3228;
        }

        .edit-form .form-group .form-control:focus,
        .edit-form .form-group .form-select:focus {
            border-color: #C49A6C;
            box-shadow: 0 0 0 4px rgba(196, 154, 108, 0.15);
            background: #FFFFFF;
        }

        .edit-form .form-group .form-control::placeholder {
            color: #b5a694;
        }

        .edit-form .form-group .form-control[readonly] {
            background: #f5efe6;
            cursor: not-allowed;
            border-color: #d5c9b8;
        }

        /* Action Buttons */
        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            padding-top: 1.5rem;
            border-top: 2px solid #e8dcc8;
            margin-top: 1rem;
        }

        .btn-cancel {
            background: transparent;
            border: 2px solid #C49A6C;
            color: #6B5544;
            padding: 0.6rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-cancel:hover {
            background: #e8dcc8;
            border-color: #8B6B4A;
            text-decoration: none;
            color: #4A3228;
        }

        .btn-save {
            background: linear-gradient(135deg, #8B6B4A, #A8825A);
            border: none;
            color: #FFFFFF;
            padding: 0.6rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(139, 107, 74, 0.3);
        }

        .btn-save:hover {
            background: linear-gradient(135deg, #A8825A, #C49A6C);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(139, 107, 74, 0.4);
            color: #FFFFFF;
        }

        .btn-save i {
            font-size: 1rem;
        }

        /* Edit Profile Toggle Button */
        .btn-edit-toggle {
            background: linear-gradient(135deg, #8B6B4A, #A8825A);
            border: none;
            color: #FFFFFF;
            padding: 0.7rem 2rem;
            border-radius: 60px;
            font-weight: 600;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: 0.2s;
            box-shadow: 0 4px 20px rgba(139, 107, 74, 0.35);
            border: 1px solid #C49A6C;
        }

        .btn-edit-toggle:hover {
            background: linear-gradient(135deg, #A8825A, #C49A6C);
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(139, 107, 74, 0.4);
            color: #FFFFFF;
        }

        /* Footer */
        .footer-meta {
            margin-top: 2rem;
            padding: 1.2rem 2rem;
            background: #4A3228;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(74, 50, 40, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            font-size: 0.85rem;
            color: #f5efe6;
            border: 1px solid rgba(196, 154, 108, 0.15);
        }

        .footer-meta i {
            color: #C49A6C;
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
            background: rgba(255, 255, 255, 0.08);
            padding: 0.2rem 0.8rem;
            border-radius: 20px;
            font-weight: 500;
            color: #f5efe6;
        }

        /* Toggle sections */
        .edit-section {
            display: none;
            animation: slideDown 0.4s ease;
        }

        .edit-section.active {
            display: block;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* View Mode */
        .view-mode {
            display: block;
        }

        .view-mode.hidden {
            display: none;
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

            .profile-header .user-stats {
                flex-wrap: wrap;
                justify-content: center;
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
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
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
                / <a href="{{ route('home') }}" class="text-decoration-none" style="color: #8B6B4A;">Home</a>
                / <a href="#" class="text-decoration-none" style="color: #8B6B4A;">Profile</a>
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

                <!-- ====== VIEW MODE ====== -->
                <div id="viewMode" class="view-mode">
                    <!-- Personal Information View -->
                    <div class="section-title">
                        <i class="fas fa-id-card"></i> Personal Information
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-item">
                                <strong><i class="fas fa-user"></i> Full Name</strong>
                                <p style="color: #4A3228; font-weight: 500;">{{ $user->name ?? 'Faiza Ahmed' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <strong><i class="fas fa-envelope"></i> Email</strong>
                                <p style="color: #4A3228; font-weight: 500;">{{ $user->email ?? 'faiza@example.com' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <strong><i class="fas fa-user-tag"></i> Role</strong>
                                <p style="color: #4A3228; font-weight: 500;">{{ $user->role ?? 'Student' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <strong><i class="fas fa-phone"></i> Phone</strong>
                                <p style="color: #4A3228; font-weight: 500;">{{ $user->phone ?? '+92 300 1234567' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Account Information View -->
                    <div class="section-title mt-4">
                        <i class="fas fa-user-cog"></i> Account Information
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-item">
                                <strong><i class="fas fa-circle"></i> Account Status</strong>
                                <p style="color: #4A3228; font-weight: 500;"><span class="badge" style="background: #8B6B4A; color: #FFFFFF;">Active</span></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <strong><i class="fas fa-clock"></i> Last Login</strong>
                                <p style="color: #4A3228; font-weight: 500;">10:40 PM, 7/20/2026</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <strong><i class="fas fa-home"></i> Hostel</strong>
                                <p style="color: #4A3228; font-weight: 500;">{{ $user->hostel ?? 'GCW Hostel' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <strong><i class="fas fa-map-pin"></i> Location</strong>
                                <p style="color: #4A3228; font-weight: 500;">{{ $user->location ?? 'Gujranwala, Pakistan' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Button -->
                    <div class="text-center mt-4">
                        <button class="btn-edit-toggle" id="editToggleBtn">
                            <i class="fas fa-user-edit"></i> Edit Profile
                        </button>
                    </div>
                </div>

                <!-- ====== EDIT MODE ====== -->
                <div id="editMode" class="edit-section">
                    <div class="alert alert-info" style="background: #e8dcc8; border: 1px solid #C49A6C; color: #4A3228;">
                        <i class="fas fa-info-circle"></i> You are now in edit mode. Make your changes and click "Save Changes".
                    </div>

                    <form class="edit-form" id="editProfileForm" action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Personal Information -->
                        <div class="section-title">
                            <i class="fas fa-id-card"></i> Personal Information
                        </div>

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
                            <button type="button" class="btn-cancel" id="cancelEditBtn">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                            <button type="submit" class="btn-save">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>

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
            // Get elements
            const viewMode = document.getElementById('viewMode');
            const editMode = document.getElementById('editMode');
            const editToggleBtn = document.getElementById('editToggleBtn');
            const cancelEditBtn = document.getElementById('cancelEditBtn');
            const form = document.getElementById('editProfileForm');
            
            // Edit button - This is the fix!
            if (editToggleBtn) {
                editToggleBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Show edit mode, hide view mode
                    viewMode.classList.add('hidden');
                    editMode.classList.add('active');
                    
                    // Scroll to edit form
                    editMode.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    
                    // Update button state
                    editToggleBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Editing...';
                    editToggleBtn.disabled = true;
                    editToggleBtn.style.opacity = '0.6';
                });
            }
            
            // Cancel button
            if (cancelEditBtn) {
                cancelEditBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Show view mode, hide edit mode
                    viewMode.classList.remove('hidden');
                    editMode.classList.remove('active');
                    
                    // Reset button
                    if (editToggleBtn) {
                        editToggleBtn.innerHTML = '<i class="fas fa-user-edit"></i> Edit Profile';
                        editToggleBtn.disabled = false;
                        editToggleBtn.style.opacity = '1';
                    }
                    
                    // Reset form (optional)
                    // form.reset();
                });
            }
            
            // Form validation
            if (form) {
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
                    } else {
                        // Show loading state
                        const submitBtn = form.querySelector('.btn-save');
                        if (submitBtn) {
                            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
                            submitBtn.disabled = true;
                        }
                    }
                });
            }
            
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
        
        .hidden {
            display: none !important;
        }
        
        .info-item {
            margin-bottom: 1rem;
            padding: 0.8rem 1.2rem;
            background: #FFFFFF;
            border-radius: 12px;
            border-left: 3px solid #C49A6C;
            box-shadow: 0 2px 8px rgba(74, 50, 40, 0.06);
        }
        
        .info-item strong {
            display: block;
            color: #6B5544;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.7;
            margin-bottom: 0.2rem;
        }
        
        .info-item strong i {
            color: #8B6B4A;
            margin-right: 6px;
        }
        
        .info-item p {
            margin: 0;
            font-size: 1rem;
        }
    </style>

</body>
</html>