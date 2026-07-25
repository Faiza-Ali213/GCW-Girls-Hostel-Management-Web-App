<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - GCW Hostel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            min-height: 100vh;
        }

        .navbar-custom {
            background: #1A365D !important;
            padding: 15px 0;
            box-shadow: 0 4px 20px rgba(26, 54, 93, 0.15);
        }

        .navbar-custom .navbar-brand {
            color: #ffffff !important;
            font-weight: 800;
            font-size: 1.5rem;
        }

        .navbar-custom .navbar-brand span {
            color: #ffffff;
        }

        .navbar-custom .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 8px 18px !important;
            border-radius: 8px;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.1);
        }

        .navbar-custom .nav-link i {
            margin-right: 8px;
        }

        .navbar-custom .dropdown-menu {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }

        .navbar-custom .dropdown-item {
            border-radius: 8px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .navbar-custom .dropdown-item:hover {
            background: rgba(26, 54, 93, 0.1);
            color: #1A365D;
        }

        .navbar-custom .dropdown-item i {
            margin-right: 10px;
            width: 20px;
            color: #1A365D;
        }

        .profile-wrapper {
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .profile-header {
            background: linear-gradient(135deg, #1A365D 0%, #2c4a7a 100%);
            border-radius: 20px;
            padding: 40px;
            color: white;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(26, 54, 93, 0.2);
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
            border-radius: 50%;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.3);
            object-fit: cover;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            color: white;
            position: relative;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-avatar .edit-avatar {
            position: absolute;
            bottom: 0;
            right: 0;
            background: white;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1A365D;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid #1A365D;
        }

        .profile-avatar .edit-avatar:hover {
            transform: scale(1.1);
            background: #1A365D;
            color: white;
        }

        .profile-name {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .profile-role {
            font-size: 1rem;
            opacity: 0.8;
            font-weight: 400;
        }

        .profile-email {
            font-size: 0.95rem;
            opacity: 0.8;
        }

        .profile-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid #eef2f7;
            transition: all 0.3s ease;
            height: 100%;
        }

        .profile-card:hover {
            box-shadow: 0 10px 40px rgba(26, 54, 93, 0.08);
        }

        .profile-card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1A365D;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f4f8;
        }

        .profile-card-title i {
            margin-right: 10px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0f4f8;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #718096;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .info-value {
            color: #1A365D;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .info-value i {
            margin-right: 8px;
        }

        .alert-custom {
            border-radius: 12px;
            padding: 15px 20px;
            border: none;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success-custom {
            background: #c6f6d5;
            color: #22543d;
            border-left: 4px solid #48bb78;
        }

        .alert-danger-custom {
            background: #fed7d7;
            color: #742a2a;
            border-left: 4px solid #fc8181;
        }

        @media (max-width: 768px) {
            .profile-header {
                padding: 25px;
                text-align: center;
            }

            .profile-avatar {
                margin: 0 auto 15px;
            }

            .profile-name {
                font-size: 1.5rem;
            }

            .profile-card {
                padding: 20px;
            }

            .info-item {
                flex-direction: column;
                gap: 5px;
            }
        }

        @media (max-width: 576px) {
            .profile-wrapper {
                padding: 20px 10px;
            }

            .profile-header {
                padding: 20px;
            }

            .profile-avatar {
                width: 80px;
                height: 80px;
                font-size: 35px;
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

    <div class="profile-wrapper">
        <div class="container">
            @if(session('success'))
                <div class="alert-custom alert-success-custom">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-custom alert-danger-custom">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert-custom alert-danger-custom">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Profile Header -->
            <div class="profile-header">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center text-md-start">
                        <div class="profile-avatar mx-auto mx-md-0">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo">
                            @else
                                <i class="fas fa-user"></i>
                            @endif
                            <div class="edit-avatar" onclick="document.getElementById('photoInput').click()">
                                <i class="fas fa-camera"></i>
                            </div>
                            <form action="{{ route('profile.upload-photo') }}" method="POST" enctype="multipart/form-data" id="photoForm" style="display: none;">
                                @csrf
                                <input type="file" name="profile_photo" id="photoInput" accept="image/*" onchange="document.getElementById('photoForm').submit()">
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 text-center text-md-start">
                        <h2 class="profile-name">{{ Auth::user()->name ?? 'Admin User' }}</h2>
                        <p class="profile-role">{{ Auth::user()->role ?? 'Admin' }}</p>
                        <p class="profile-email"><i class="fas fa-envelope"></i> {{ Auth::user()->email ?? 'admin@example.com' }}</p>
                    </div>
                    <div class="col-md-3 text-center text-md-end">
                        <a href="{{ route('profile.edit') }}" class="btn btn-light">
                            <i class="fas fa-edit"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Personal Information & Account Information -->
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="profile-card">
                        <h5 class="profile-card-title">
                            <i class="fas fa-user-circle"></i> Personal Information
                        </h5>
                        <div class="info-item">
                            <span class="info-label"><i class="fas fa-user"></i> Full Name</span>
                            <span class="info-value">{{ Auth::user()->name ?? 'Admin' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label"><i class="fas fa-envelope"></i> Email</span>
                            <span class="info-value">{{ Auth::user()->email ?? 'admin@example.com' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label"><i class="fas fa-id-badge"></i> Role</span>
                            <span class="info-value">{{ Auth::user()->role ?? 'Admin' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label"><i class="fas fa-phone"></i> Phone</span>
                            <span class="info-value">{{ Auth::user()->phone ?? '0300-1234567' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label"><i class="fas fa-calendar-alt"></i> Joined</span>
                            <span class="info-value">{{ Auth::user()->created_at ? Auth::user()->created_at->format('M d, Y') : 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Account Information -->
                <div class="col-lg-6">
                    <div class="profile-card">
                        <h5 class="profile-card-title">
                            <i class="fas fa-shield-alt"></i> Account Information
                        </h5>
                        <div class="info-item">
                            <span class="info-label"><i class="fas fa-user-check"></i> Account Status</span>
                            <span class="info-value">
                                <span class="badge bg-success">Active</span>
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="info-label"><i class="fas fa-clock"></i> Last Login</span>
                            <span class="info-value">{{ Auth::user()->last_login ?? 'First login' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label"><i class="fas fa-building"></i> Hostel</span>
                            <span class="info-value">GCW Hostel</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label"><i class="fas fa-map-marker-alt"></i> Location</span>
                            <span class="info-value">Gujranwala, Pakistan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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