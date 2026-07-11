<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Hostel Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 500px;
        }

        .auth-card {
            background: #ffffff;
            border-radius: 30px;
            padding: 45px 40px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.1);
            border: 1px solid #e8ecf1;
            transition: transform 0.3s ease;
        }

        .auth-card:hover {
            transform: translateY(-5px);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .auth-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 35px;
            color: white;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .auth-title {
            font-weight: 700;
            color: #2d3748;
            font-size: 30px;
            margin-bottom: 8px;
        }

        .auth-title span {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .auth-subtitle {
            color: #718096;
            font-size: 14px;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            font-weight: 600;
            color: #2d3748;
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
        }

        .form-group label i {
            color: #667eea;
            margin-right: 8px;
        }

        .input-group-custom {
            position: relative;
        }

        .input-group-custom .form-control {
            border-radius: 15px;
            padding: 14px 20px;
            border: 2px solid #e2e8f0;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #f7fafc;
            color: #2d3748;
        }

        .input-group-custom .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            background: white;
        }

        .input-group-custom .form-control.is-invalid {
            border-color: #fc8181;
        }

        .input-group-custom .form-control.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(252, 129, 129, 0.15);
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #a0aec0;
            transition: color 0.3s ease;
            background: none;
            border: none;
            padding: 5px;
        }

        .password-toggle:hover {
            color: #667eea;
        }

        .btn-auth {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 16px;
            font-weight: 600;
            font-size: 16px;
            width: 100%;
            border-radius: 15px;
            color: white;
            transition: all 0.3s ease;
            margin-top: 10px;
            position: relative;
            overflow: hidden;
        }

        .btn-auth:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
        }

        .btn-auth:active {
            transform: translateY(0);
        }

        .btn-auth i {
            margin-right: 10px;
        }

        .auth-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 2px solid #f7fafc;
        }

        .auth-footer p {
            color: #718096;
            font-size: 14px;
            margin-bottom: 0;
        }

        .auth-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
            position: relative;
        }

        .auth-footer a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .auth-footer a i {
            margin-right: 5px;
        }

        /* Alert Styles */
        .alert-custom {
            border-radius: 15px;
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

        .alert-custom ul {
            margin-bottom: 0;
            padding-left: 20px;
        }

        .alert-custom ul li {
            list-style-type: none;
            position: relative;
            padding-left: 5px;
        }

        .alert-custom ul li::before {
            content: "•";
            color: #fc8181;
            font-weight: bold;
            position: absolute;
            left: -15px;
        }

        .alert-success-custom ul li::before {
            color: #48bb78;
        }

        /* Password strength indicator */
        .password-strength {
            margin-top: 8px;
            height: 4px;
            border-radius: 10px;
            background: #e2e8f0;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .password-strength-text {
            font-size: 12px;
            margin-top: 5px;
            color: #718096;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .auth-card {
                padding: 30px 20px;
            }

            .auth-title {
                font-size: 24px;
            }

            .auth-icon {
                width: 60px;
                height: 60px;
                font-size: 28px;
            }

            .btn-auth {
                padding: 14px;
                font-size: 14px;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-card {
            animation: fadeInUp 0.6s ease;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f7fafc;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #764ba2;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h2 class="auth-title">Create <span>Account</span></h2>
                <p class="auth-subtitle">Join our community today</p>
            </div>
            
            @if(session('success'))
                <div class="alert alert-custom alert-success-custom alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-custom alert-danger-custom">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('signup.submit') }}">
                @csrf
                <div class="form-group">
                    <label for="name">
                        <i class="fas fa-user"></i> Full Name
                    </label>
                    <div class="input-group-custom">
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               placeholder="Enter your full name" 
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i> Email Address
                    </label>
                    <div class="input-group-custom">
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="Enter your email address" 
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-key"></i> Password
                    </label>
                    <div class="input-group-custom">
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               placeholder="Create a password (min 6 chars)" 
                               required>
                        <button type="button" class="password-toggle" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="password-strength">
                        <div class="password-strength-bar" id="strengthBar"></div>
                    </div>
                    <div class="password-strength-text" id="strengthText">Password must be at least 6 characters</div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">
                        <i class="fas fa-check-circle"></i> Confirm Password
                    </label>
                    <div class="input-group-custom">
                        <input type="password" 
                               class="form-control" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               placeholder="Confirm your password" 
                               required>
                        <button type="button" class="password-toggle" id="toggleConfirmPassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-auth">
                    <i class="fas fa-user-plus"></i> Create Account
                </button>
            </form>

            <div class="auth-footer">
                <p>
                    <i class="fas fa-sign-in-alt"></i> Already have an account? 
                    <a href="{{ route('login') }}">Sign In</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Password toggle visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password_confirmation');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');
            
            let strength = 0;
            let message = '';
            let color = '';
            
            if (password.length >= 6) strength += 25;
            if (password.length >= 8) strength += 25;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength += 25;
            if (/[0-9]/.test(password) || /[^a-zA-Z0-9]/.test(password)) strength += 25;
            
            if (password.length === 0) {
                message = 'Password must be at least 6 characters';
                color = '#e2e8f0';
                strength = 0;
            } else if (strength <= 25) {
                message = 'Weak password';
                color = '#fc8181';
            } else if (strength <= 50) {
                message = 'Fair password';
                color = '#f6ad55';
            } else if (strength <= 75) {
                message = 'Good password';
                color = '#68d391';
            } else {
                message = 'Strong password';
                color = '#48bb78';
            }
            
            strengthBar.style.width = strength + '%';
            strengthBar.style.background = color;
            strengthText.textContent = message;
            strengthText.style.color = color;
        });

        // Auto-dismiss alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert-dismissible');
                alerts.forEach(function(alert) {
                    const closeButton = alert.querySelector('.btn-close');
                    if (closeButton) {
                        closeButton.click();
                    }
                });
            }, 5000);
        });
    </script>
</body>
</html>