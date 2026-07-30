<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - GCW Hostel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* ============================================
           PROFILE PAGE - EARTHY TONES THEME
           ============================================ */

        * {
            font-family: 'Inter', sans-serif;
        }

        /* ===== BODY ===== */
        body {
            background: #e8dcc8;
            min-height: 100vh;
            padding: 2rem 0;
        }

        /* ===== NAVBAR ===== */
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

        .navbar-custom .dropdown-menu {
            background: #f5efe6;
            border: 1px solid rgba(196, 154, 108, 0.2);
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(74, 50, 40, 0.15);
            padding: 8px;
        }

        .navbar-custom .dropdown-item {
            color: #4A3228;
            border-radius: 8px;
            padding: 10px 18px;
            font-weight: 500;
            transition: 0.2s;
        }

        .navbar-custom .dropdown-item:hover {
            background: #e8dcc8;
            color: #4A3228;
        }

        .navbar-custom .dropdown-item i {
            color: #8B6B4A;
            margin-right: 10px;
            width: 20px;
        }

        .navbar-custom .dropdown-divider {
            border-color: rgba(196, 154, 108, 0.2);
        }

        /* ===== MAIN CONTAINER ===== */
        .profile-container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        /* ===== ALERTS ===== */
        .alert-custom {
            border-radius: 12px;
            padding: 15px 20px;
            border: none;
            margin-bottom: 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success-custom {
            background: #e8dcc8;
            color: #4A3228;
            border-left: 4px solid #C49A6C;
        }

        .alert-danger-custom {
            background: #f5e6e6;
            color: #6B2E2E;
            border-left: 4px solid #c0392b;
        }

        .alert-custom ul {
            margin: 0;
            padding-left: 20px;
        }

        .alert-custom .close-btn {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #8B6B4A;
            cursor: pointer;
            margin-left: auto;
            padding: 0 4px;
        }

        /* ===== BREADCRUMB ===== */
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

        .breadcrumb-custom .path a {
            color: #8B6B4A;
            text-decoration: none;
        }

        .breadcrumb-custom .path a:hover {
            color: #4A3228;
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

        /* ===== PROFILE CARD ===== */
        .profile-card {
            background: #f5efe6;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(74, 50, 40, 0.12);
            overflow: hidden;
            border: 1px solid rgba(196, 154, 108, 0.15);
        }

        /* ===== PROFILE HEADER ===== */
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
            overflow: hidden;
            position: relative;
        }

        .profile-header .user-info .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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

        /* ===== PROFILE BODY ===== */
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

        /* ===== INFO ITEMS (View Mode) ===== */
        .info-item {
            margin-bottom: 1rem;
            padding: 0.8rem 1.2rem;
            background: #FFFFFF;
            border-radius: 12px;
            border-left: 3px solid #C49A6C;
            box-shadow: 0 2px 8px rgba(74, 50, 40, 0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .info-item .info-left {
            display: flex;
            flex-direction: column;
        }

        .info-item strong {
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

        .info-item .info-value {
            margin: 0;
            font-size: 1rem;
            color: #4A3228;
            font-weight: 500;
        }

        .info-item .status-badge {
            background: #8B6B4A;
            color: #FFFFFF;
            padding: 0.2rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* ===== COMPLAINT STATUS SECTION ===== */
        .complaint-section {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid #e8dcc8;
        }

        .complaint-card {
            background: #FFFFFF;
            border-radius: 12px;
            padding: 1.2rem 1.5rem;
            margin-bottom: 1rem;
            border-left: 4px solid #C49A6C;
            box-shadow: 0 2px 8px rgba(74, 50, 40, 0.06);
            transition: all 0.3s ease;
        }

        .complaint-card:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 16px rgba(74, 50, 40, 0.1);
        }

        .complaint-card .complaint-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 0.5rem;
        }

        .complaint-card .complaint-title {
            font-weight: 600;
            color: #4A3228;
            font-size: 1rem;
        }

        .complaint-card .complaint-title i {
            color: #8B6B4A;
            margin-right: 8px;
        }

        .complaint-card .complaint-status {
            padding: 0.2rem 1rem;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .complaint-status.pending {
            background: #fffbeb;
            color: #F59E0B;
            border: 1px solid #F59E0B;
        }

        .complaint-status.in_progress {
            background: #e0f2fe;
            color: #0EA5E9;
            border: 1px solid #0EA5E9;
        }

        .complaint-status.resolved {
            background: #ecfdf5;
            color: #10B981;
            border: 1px solid #10B981;
        }

        .complaint-status.rejected {
            background: #fef2f2;
            color: #EF4444;
            border: 1px solid #EF4444;
        }

        .complaint-card .complaint-details {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-top: 0.5rem;
        }

        .complaint-card .complaint-details .detail {
            font-size: 0.85rem;
            color: #6B5544;
        }

        .complaint-card .complaint-details .detail i {
            color: #8B6B4A;
            margin-right: 4px;
            width: 16px;
        }

        .complaint-card .complaint-details .detail strong {
            color: #4A3228;
            font-weight: 600;
        }

        .complaint-card .complaint-description {
            margin-top: 0.5rem;
            padding-top: 0.5rem;
            border-top: 1px solid #f1ece4;
            font-size: 0.9rem;
            color: #6B5544;
        }

        .complaint-empty {
            text-align: center;
            padding: 2rem;
            color: #94a3b8;
            background: #FFFFFF;
            border-radius: 12px;
            border: 2px dashed #e8dcc8;
        }

        .complaint-empty i {
            font-size: 3rem;
            color: #d1d5db;
            display: block;
            margin-bottom: 1rem;
        }

        .complaint-empty h6 {
            color: #4A3228;
            font-weight: 600;
        }

        .complaint-empty p {
            font-size: 0.9rem;
        }

        /* ===== EDIT TOGGLE BUTTON ===== */
        .btn-edit-toggle {
            background: linear-gradient(135deg, #8B6B4A, #A8825A);
            border: none;
            color: #FFFFFF;
            padding: 0.7rem 2.5rem;
            border-radius: 60px;
            font-weight: 700;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 4px 20px rgba(139, 107, 74, 0.35);
            border: 1px solid #C49A6C;
        }

        .btn-edit-toggle:hover {
            background: linear-gradient(135deg, #A8825A, #C49A6C);
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(139, 107, 74, 0.4);
            color: #FFFFFF;
        }

        /* ===== EDIT MODE ===== */
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

        .edit-section .alert-info {
            background: #e8dcc8;
            border: 1px solid #C49A6C;
            color: #4A3228;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }

        .edit-section .alert-info i {
            color: #8B6B4A;
            margin-right: 8px;
        }

        /* ===== FORM ===== */
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
            text-transform: uppercase;
            letter-spacing: 0.3px;
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
            transition: 0.3s;
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

        /* ===== FORM ACTIONS ===== */
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
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .btn-cancel:hover {
            background: #e8dcc8;
            border-color: #8B6B4A;
            color: #4A3228;
        }

        .btn-save {
            background: linear-gradient(135deg, #8B6B4A, #A8825A);
            border: none;
            color: #FFFFFF;
            padding: 0.6rem 2.5rem;
            border-radius: 50px;
            font-weight: 700;
            transition: 0.3s;
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

        /* ===== TOGGLE SECTIONS ===== */
        .view-mode {
            display: block;
        }

        .view-mode.hidden {
            display: none;
        }

        .hidden {
            display: none !important;
        }

        /* ===== VALIDATION ===== */
        .is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.1) !important;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
                padding: 1.5rem;
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
                width: 100%;
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

            .info-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }

            .breadcrumb-custom {
                flex-direction: column;
                text-align: center;
            }

            .complaint-card .complaint-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .complaint-card .complaint-details {
                flex-direction: column;
                gap: 4px;
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

            .profile-container {
                padding: 0 0.8rem;
            }

            .profile-body {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar - Only Admin User dropdown -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-building"></i> GCW <span>Hostel</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- ONLY ADMIN USER DROPDOWN -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> {{ Auth::user()->name ?? 'Admin User' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user"></i> My Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-edit"></i> Edit Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item" style="border: none; background: none; width: 100%; text-align: left;">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="profile-container">
        @if(session('success'))
            <div class="alert-custom alert-success-custom">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button class="close-btn" onclick="this.parentElement.remove()">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert-custom alert-danger-custom">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button class="close-btn" onclick="this.parentElement.remove()">&times;</button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert-custom alert-danger-custom">
                <i class="fas fa-exclamation-circle"></i>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button class="close-btn" onclick="this.parentElement.remove()">&times;</button>
            </div>
        @endif

        <!-- Breadcrumb -->
        <div class="breadcrumb-custom">
            <i class="fas fa-home"></i>
            <span class="path">
                <a href="/">Home</a> / 
                <a href="{{ route('profile') }}">Profile</a>
                <span>Viewing</span>
            </span>
            <span class="badge-active ms-auto">
                <i class="fas fa-user-check"></i> Active
            </span>
        </div>

        <!-- Profile Card -->
        <div class="profile-card">
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="user-info">
                    <div class="avatar">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo">
                        @else
                            <i class="fas fa-user"></i>
                        @endif
                    </div>
                    <div>
                        <h4>{{ Auth::user()->name ?? 'Admin User' }}</h4>
                        <small><i class="fas fa-envelope me-1"></i> {{ Auth::user()->email ?? 'admin@example.com' }}</small>
                    </div>
                </div>
                <div class="user-stats">
                    <div class="stat">
                        <strong>{{ Auth::user()->role ?? 'Admin' }}</strong>
                        <span>Role</span>
                    </div>
                    <div class="stat">
                        <strong>{{ Auth::user()->created_at ? Auth::user()->created_at->format('M d, Y') : 'N/A' }}</strong>
                        <span>Joined</span>
                    </div>
                    <div class="stat">
                        <strong>{{ isset($complaints) ? $complaints->count() : 0 }}</strong>
                        <span>Complaints</span>
                    </div>
                </div>
            </div>

            <!-- Profile Body -->
            <div class="profile-body">
                <!-- View Mode -->
                <div id="viewMode" class="view-mode">
                    <div class="row g-4">
                        <!-- Personal Information -->
                        <div class="col-lg-6">
                            <div class="section-title">
                                <i class="fas fa-user-circle"></i> Personal Information
                            </div>
                            <div class="info-item">
                                <div class="info-left">
                                    <strong><i class="fas fa-user"></i> Full Name</strong>
                                    <span class="info-value">{{ Auth::user()->name ?? 'Admin' }}</span>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-left">
                                    <strong><i class="fas fa-envelope"></i> Email</strong>
                                    <span class="info-value">{{ Auth::user()->email ?? 'admin@example.com' }}</span>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-left">
                                    <strong><i class="fas fa-id-badge"></i> Role</strong>
                                    <span class="info-value">{{ Auth::user()->role ?? 'Admin' }}</span>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-left">
                                    <strong><i class="fas fa-phone"></i> Phone</strong>
                                    <span class="info-value">{{ Auth::user()->phone ?? '0300-1234567' }}</span>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-left">
                                    <strong><i class="fas fa-calendar-alt"></i> Joined</strong>
                                    <span class="info-value">{{ Auth::user()->created_at ? Auth::user()->created_at->format('M d, Y') : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Account Information -->
                        <div class="col-lg-6">
                            <div class="section-title">
                                <i class="fas fa-shield-alt"></i> Account Information
                            </div>
                            <div class="info-item">
                                <div class="info-left">
                                    <strong><i class="fas fa-user-check"></i> Account Status</strong>
                                    <span class="info-value"><span class="status-badge">Active</span></span>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-left">
                                    <strong><i class="fas fa-clock"></i> Last Login</strong>
                                    <span class="info-value">{{ Auth::user()->last_login ?? 'First login' }}</span>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-left">
                                    <strong><i class="fas fa-building"></i> Hostel</strong>
                                    <span class="info-value">GCW Hostel</span>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-left">
                                    <strong><i class="fas fa-map-marker-alt"></i> Location</strong>
                                    <span class="info-value">Gujranwala, Pakistan</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Complaint Status Section -->
                    <div class="complaint-section">
                        <div class="section-title">
                            <i class="fas fa-exclamation-triangle"></i> My Complaints
                            <span style="font-size: 0.8rem; font-weight: 400; color: #94a3b8;">
                                ({{ isset($complaints) ? $complaints->count() : 0 }} total)
                            </span>
                        </div>

                        @if(isset($complaints) && $complaints->count() > 0)
                            @foreach($complaints as $complaint)
                                <div class="complaint-card">
                                    <div class="complaint-header">
                                        <span class="complaint-title">
                                            <i class="fas fa-file-alt"></i> {{ $complaint->title }}
                                        </span>
                                        <span class="complaint-status {{ $complaint->status }}">
                                            @if($complaint->status == 'pending')
                                                <i class="fas fa-clock"></i> Pending
                                            @elseif($complaint->status == 'in_progress')
                                                <i class="fas fa-spinner fa-spin"></i> In Progress
                                            @elseif($complaint->status == 'resolved')
                                                <i class="fas fa-check-circle"></i> Resolved
                                            @elseif($complaint->status == 'rejected')
                                                <i class="fas fa-times-circle"></i> Rejected
                                            @endif
                                        </span>
                                    </div>
                                    <div class="complaint-details">
                                        <span class="detail">
                                            <i class="fas fa-calendar-alt"></i> 
                                            <strong>Submitted:</strong> {{ $complaint->created_at->format('d M Y, h:i A') }}
                                        </span>
                                        <span class="detail">
                                            <i class="fas fa-flag"></i> 
                                            <strong>Priority:</strong> {{ ucfirst($complaint->priority) }}
                                        </span>
                                        <span class="detail">
                                            <i class="fas fa-user-tag"></i> 
                                            <strong>Complaint By:</strong> {{ ucfirst($complaint->complaint_by ?? 'User') }}
                                        </span>
                                    </div>
                                    <div class="complaint-description">
                                        <i class="fas fa-align-left" style="color: #8B6B4A; margin-right: 6px;"></i>
                                        {{ Str::limit($complaint->description, 150) }}
                                    </div>
                                    @if($complaint->admin_remark)
                                        <div style="margin-top: 0.5rem; padding: 0.5rem 1rem; background: #f5efe6; border-radius: 8px; font-size: 0.85rem; color: #6B5544;">
                                            <i class="fas fa-comment" style="color: #8B6B4A;"></i> 
                                            <strong>Admin Remark:</strong> {{ $complaint->admin_remark }}
                                        </div>
                                    @endif
                                    @if($complaint->resolved_at)
                                        <div style="margin-top: 0.3rem; font-size: 0.8rem; color: #10B981;">
                                            <i class="fas fa-check-circle"></i> 
                                            Resolved on: {{ $complaint->resolved_at->format('d M Y, h:i A') }}
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="complaint-empty">
                                <i class="fas fa-inbox"></i>
                                <h6>No Complaints Found</h6>
                                <p>You haven't submitted any complaints yet.</p>
                                @if(Route::has('complaint.registration'))
                                    <a href="{{ route('complaint.registration') }}" class="btn-edit-toggle" style="display: inline-flex; padding: 0.5rem 1.5rem; font-size: 0.9rem;">
                                        <i class="fas fa-plus-circle"></i> Submit a Complaint
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Edit Button -->
                    <div class="text-center mt-4">
                        <button class="btn-edit-toggle" onclick="toggleEditMode()">
                            <i class="fas fa-edit"></i> Edit Profile
                        </button>
                    </div>
                </div>

                <!-- Edit Mode -->
                <div id="editMode" class="edit-section">
                    <div class="alert-info">
                        <i class="fas fa-info-circle"></i> Update your personal information below. Fields marked with <span class="text-danger">*</span> are required.
                    </div>

                    <form class="edit-form" action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name"><i class="fas fa-user"></i> Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"><i class="fas fa-envelope"></i> Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone"><i class="fas fa-phone"></i> Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone ?? '' }}" placeholder="Enter phone number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role"><i class="fas fa-id-badge"></i> Role</label>
                                    <input type="text" class="form-control" id="role" value="{{ Auth::user()->role ?? 'Admin' }}" readonly>
                                    <small class="text-muted">Role cannot be changed</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password"><i class="fas fa-lock"></i> New Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation"><i class="fas fa-check-circle"></i> Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn-cancel" onclick="toggleEditMode()">
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Edit Mode
        function toggleEditMode() {
            const viewMode = document.getElementById('viewMode');
            const editMode = document.getElementById('editMode');
            
            viewMode.classList.toggle('hidden');
            editMode.classList.toggle('active');
        }

        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert-custom');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            });
        }, 5000);
    </script>
</body>
</html>