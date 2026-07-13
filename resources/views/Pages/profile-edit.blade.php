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

        .profile-wrapper {
            padding: 40px 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .profile-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid #eef2f7;
        }

        .profile-card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1A365D;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f4f8;
        }

        .profile-card-title i {
            margin-right: 10px;
        }

        .form-group-custom {
            margin-bottom: 25px;
        }

        .form-group-custom label {
            font-weight: 600;
            color: #2d3748;
            font-size: 0.95rem;
            margin-bottom: 8px;
            display: block;
        }

        .form-group-custom label i {
            color: #1A365D;
            margin-right: 8px;
        }

        .form-group-custom .form-control {
            border-radius: 12px;
            padding: 14px 18px;
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
        }

        .form-group-custom .form-control:disabled {
            background: #f1f5f9;
            cursor: not-allowed;
        }

        .form-group-custom .form-control.is-invalid {
            border-color: #fc8181;
        }

        .form-group-custom .form-control.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(252, 129, 129, 0.15);
        }

        .text-danger {
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
        }

        .btn-save {
            background: #1A365D;
            color: white;
            padding: 14px 40px;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
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
            padding: 14px 40px;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-cancel:hover {
            background: #cbd5e0;
            color: #2d3748;
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

        .btn-back {
            color: #1A365D;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-back:hover {
            color: #2c4a7a;
            transform: translateX(-3px);
        }

        .btn-back i {
            margin-right: 8px;
        }

        .profile-avatar-upload {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-avatar-upload .avatar-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #1A365D;
            object-fit: cover;
            background: #f0f4f8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            color: #1A365D;
            margin: 0 auto 10px;
        }

        .profile-avatar-upload .avatar-preview img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-avatar-upload .btn-upload {
            background: #1A365D;
            color: white;
            padding: 8px 20px;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .profile-avatar-upload .btn-upload:hover {
            background: #2c4a7a;
        }

        @media (max-width: 768px) {
            .profile-card {
                padding: 25px;
            }

            .btn-save,
            .btn-cancel {
                width: 100%;
                text-align: center;
            }

            .d-flex.gap-3 {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-building"></i> GCW <span>Hostel</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fas fa-dashboard"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('profile') }}">
                            <i class="fas fa-user"></i> Profile
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="profile-wrapper">
        <div class="container">
            <a href="{{ route('profile') }}" class="btn-back mb-3 d-inline-block">
                <i class="fas fa-arrow-left"></i> Back to Profile
            </a>

            @if(session('success'))
                <div class="alert-custom alert-success-custom">
                    <i class="fas fa-check