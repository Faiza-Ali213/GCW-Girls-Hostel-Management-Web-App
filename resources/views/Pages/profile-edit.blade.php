<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - GCW Hostel</title>
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

        /* Top Bar with Dropdown */
        .top-bar {
            background: #1A365D;
            padding: 12px 30px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            box-shadow: 0 4px 20px rgba(26, 54, 93, 0.15);
        }

        .top-bar .dropdown-toggle {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.1);
            border: none;
        }

        .top-bar .dropdown-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .top-bar .dropdown-toggle i {
            margin-right: 8px;
        }

        .top-bar .dropdown-menu {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 10px;
            min-width: 200px;
        }

        .top-bar .dropdown-item {
            border-radius: 8px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .top-bar .dropdown-item:hover {
            background: rgba(26, 54, 93, 0.1);
            color: #1A365D;
        }

        .top-bar .dropdown-item i {
            margin-right: 10px;
            width: 20px;
            color: #1A365D;
        }

        .top-bar .dropdown-divider {
            margin: 8px 0;
        }

        .top-bar .dropdown-item.text-danger {
            color: #dc3545 !important;
        }

        .top-bar .dropdown-item.text-danger i {
            color: #dc3545 !important;
        }

        .top-bar .dropdown-item.text-danger:hover {
            background: #f8d7da;
        }

        .profile-wrapper {
            padding: 40px 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .profile-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(26, 54, 93, 0.08);
            border: 1px solid #eef2f7;
        }

        .profile-card-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1A365D;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f4f8;
        }

        .profile-card-title i {
            margin-right: 10px;
            color: #1A365D;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1A365D;
            margin-bottom: 20px;
        }

        .section-title i {
            margin-right: 10px;
        }

        .section-divider {
            border-top: 2px dashed #e2e8f0;
            margin: 30px 0;
        }

        .form-group-custom {
            margin-bottom: 25px;
        }

        .form-group-custom label {
            font-weight: 600;
            color: #2d3748;
            font-size: 0.9rem;
            margin-bottom: 8px;
            display: block;
        }

        .form-group-custom label i {
            color: #1A365D;
            margin-right: 8px;
            width: 20px;
        }

        .form-group-custom .form-control {
            border-radius: 12px;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: #f8fafc;
            width: 100%;
        }

        .form-group-custom .form-control:focus {
            border-color: #1A365D;
            box-shadow: 0 0 0 4px rgba(26, 54, 93, 0.1);
            background: white;
            outline: none;
        }

        .form-group-custom .form-control:disabled {
            background: #e9ecef;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .form-group-custom .input-group {
            position: relative;
        }

        .form-group-custom .input-group .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #718096;
            z-index: 10;
            background: transparent;
            border: none;
            font-size: 1rem;
            padding: 5px;
        }

        .form-group-custom .input-group .toggle-password:hover {
            color: #1A365D;
        }

        .password-hint {
            font-size: 0.8rem;
            color: #718096;
            margin-top: 5px;
            display: block;
        }

        .password-hint i {
            margin-right: 5px;
        }

        .btn-save {
            background: #1A365D;
            color: white;
            padding: 14px 35px;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            width: 100%;
            font-size: 1rem;
            cursor: pointer;
        }

        .btn-save:hover {
            background: #2c4a7a;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(26, 54, 93, 0.2);
            color: white;
        }

        .btn-save i {
            margin-right: 8px;
        }

        .btn-cancel {
            background: #e2e8f0;
            color: #4a5568;
            padding: 14px 35px;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            width: 100%;
            font-size: 1rem;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-cancel:hover {
            background: #cbd5e0;
            color: #2d3748;
            text-decoration: none;
        }

        .text-muted {
            color: #718096;
            font-size: 0.8rem;
            margin-top: 5px;
            display: block;
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

        .alert-danger-custom ul {
            margin-bottom: 0;
            padding-left: 20px;
        }

        @media (max-width: 768px) {
            .top-bar {
                padding: 10px 15px;
            }

            .profile-wrapper {
                padding: 20px 10px;
            }

            .profile-card {
                padding: 25px 20px;
            }

            .profile-card-title {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>

    <!-- Top Bar with Admin Dropdown -->
    <div class="top-bar">
        <div class="dropdown">
            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-circle"></i> {{ Auth::user()->name ?? 'Admin User' }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="{{ route('profile') }}">
                        <i class="fas fa-user"></i> My Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item active" href="{{ route('profile.edit') }}">
                        <i class="fas fa-edit"></i> Edit Profile
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger" style="border: none; background: none; width: 100%; text-align: left;">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

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

            <div class="profile-card">
                <h5 class="profile-card-title">
                    <i class="fas fa-user-edit"></i> Edit Profile
                </h5>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Personal Information Section -->
                    <div class="section-title">
                        <i class="fas fa-user-circle"></i> Personal Information
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label><i class="fas fa-user"></i> Full Name</label>
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name ?? '' }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label><i class="fas fa-envelope"></i> Email</label>
                                <input type="email" class="form-control" name="email" value="{{ Auth::user()->email ?? '' }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label><i class="fas fa-id-badge"></i> Role</label>
                                <input type="text" class="form-control" name="role" value="{{ Auth::user()->role ?? 'Admin' }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label><i class="fas fa-phone"></i> Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label><i class="fas fa-id-card"></i> Student ID</label>
                                <input type="text" class="form-control" value="GCW-2024-001" disabled>
                                <small class="text-muted">Student ID cannot be changed</small>
                            </div>
                        </div>
                    </div>

                    <!-- Password Section -->
                    <div class="section-divider"></div>

                    <div class="section-title">
                        <i class="fas fa-key"></i> Change Password
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group-custom">
                                <label><i class="fas fa-lock"></i> Current Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Enter current password">
                                    <button type="button" class="toggle-password" onclick="togglePassword('current_password')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label><i class="fas fa-key"></i> New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Enter new password">
                                    <button type="button" class="toggle-password" onclick="togglePassword('new_password')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <small class="password-hint">
                                    <i class="fas fa-info-circle"></i> Password must be at least 8 characters
                                </small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label><i class="fas fa-check-circle"></i> Confirm New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" placeholder="Confirm new password">
                                    <button type="button" class="toggle-password" onclick="togglePassword('new_password_confirmation')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <button type="submit" class="btn-save">
                                <i class="fas fa-save"></i> Update Profile
                            </button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('profile') }}" class="btn-cancel">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Password Visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.parentElement.querySelector('.toggle-password i');
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Auto-hide alerts after 5 seconds
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