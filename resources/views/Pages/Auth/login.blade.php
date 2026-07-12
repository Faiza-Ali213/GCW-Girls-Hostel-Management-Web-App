<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hostel Management</title>
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #4facfe);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            position: relative;
            overflow: hidden;
        }

        /* Animated background with floating particles */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(102, 126, 234, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(118, 75, 162, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 50% 20%, rgba(240, 147, 251, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 50% 80%, rgba(79, 172, 254, 0.2) 0%, transparent 50%);
            z-index: 0;
            animation: pulseBg 8s ease-in-out infinite;
        }

        /* Floating orbs animation */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.3;
            animation: floatOrb 20s ease-in-out infinite;
            z-index: 0;
        }

        .orb-1 {
            width: 400px;
            height: 400px;
            background: #667eea;
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 350px;
            height: 350px;
            background: #764ba2;
            bottom: -80px;
            right: -80px;
            animation-delay: -5s;
        }

        .orb-3 {
            width: 300px;
            height: 300px;
            background: #f093fb;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: -10s;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes pulseBg {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }

        @keyframes floatOrb {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(50px, -30px) scale(1.1); }
            50% { transform: translate(-20px, 40px) scale(0.9); }
            75% { transform: translate(30px, -20px) scale(1.05); }
        }

        .auth-container {
            width: 100%;
            max-width: 500px;
            position: relative;
            z-index: 1;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 45px 40px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .auth-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #4facfe);
            background-size: 300% 100%;
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0% { background-position: 0% 0%; }
            50% { background-position: 100% 0%; }
            100% { background-position: 0% 0%; }
        }

        .auth-card:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.3);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .auth-icon {
            width: 85px;
            height: 85px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 38px;
            color: white;
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
            transition: all 0.4s ease;
            animation: pulseIcon 3s ease-in-out infinite;
        }

        @keyframes pulseIcon {
            0%, 100% { transform: scale(1); box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4); }
            50% { transform: scale(1.05); box-shadow: 0 20px 60px rgba(102, 126, 234, 0.6); }
        }

        .auth-card:hover .auth-icon {
            transform: scale(1.1) rotate(-5deg);
        }

        .auth-title {
            font-weight: 800;
            color: #1a202c;
            font-size: 32px;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
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
            letter-spacing: 0.3px;
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
            transition: color 0.3s ease;
        }

        .form-group label i {
            color: #667eea;
            margin-right: 8px;
            transition: transform 0.3s ease;
        }

        .form-group:hover label i {
            transform: scale(1.2);
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
            background: rgba(247, 250, 252, 0.8);
            color: #2d3748;
            font-weight: 500;
        }

        .input-group-custom .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 5px rgba(102, 126, 234, 0.15);
            background: white;
            transform: scale(1.01);
        }

        .input-group-custom .form-control.is-invalid {
            border-color: #fc8181;
        }

        .input-group-custom .form-control.is-invalid:focus {
            box-shadow: 0 0 0 5px rgba(252, 129, 129, 0.15);
        }

        .input-group-custom .form-control::placeholder {
            color: #a0aec0;
            font-weight: 400;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #a0aec0;
            transition: all 0.3s ease;
            background: none;
            border: none;
            padding: 8px;
            border-radius: 50%;
        }

        .password-toggle:hover {
            color: #667eea;
            background: rgba(102, 126, 234, 0.1);
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
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 10px;
            position: relative;
            overflow: hidden;
            letter-spacing: 0.5px;
        }

        .btn-auth::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-auth:hover::before {
            left: 100%;
        }

        .btn-auth:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.5);
        }

        .btn-auth:active {
            transform: translateY(0) scale(0.98);
        }

        .btn-auth i {
            margin-right: 10px;
            transition: transform 0.3s ease;
        }

        .btn-auth:hover i {
            transform: translateX(-3px);
        }

        .auth-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 2px solid rgba(247, 250, 252, 0.8);
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
            transition: all 0.3s ease;
            position: relative;
            padding: 5px 10px;
            border-radius: 8px;
        }

        .auth-footer a:hover {
            color: #764ba2;
            background: rgba(102, 126, 234, 0.1);
            text-decoration: none;
        }

        .auth-footer a i {
            margin-right: 5px;
            transition: transform 0.3s ease;
        }

        .auth-footer a:hover i {
            transform: translateX(-3px);
        }

        /* Alert Styles */
        .alert-custom {
            border-radius: 15px;
            padding: 15px 20px;
            border: none;
            margin-bottom: 20px;
            font-weight: 500;
            animation: slideDown 0.5s ease;
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

        /* Responsive */
        @media (max-width: 576px) {
            .auth-card {
                padding: 30px 20px;
            }

            .auth-title {
                font-size: 26px;
            }

            .auth-icon {
                width: 65px;
                height: 65px;
                font-size: 30px;
            }

            .btn-auth {
                padding: 14px;
                font-size: 14px;
            }

            .orb-1, .orb-2, .orb-3 {
                display: none;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .auth-card {
            animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(247, 250, 252, 0.8);
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
    <!-- Floating Orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h2 class="auth-title">Welcome <span>Back</span></h2>
                <p class="auth-subtitle">Sign in to continue your journey</p>
            </div>
            
            @if(session('success'))
                <div class="alert alert-custom alert-success-custom alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-custom alert-danger-custom alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
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

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
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
                               placeholder="Enter your password" 
                               required>
                        <button type="button" class="password-toggle" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn-auth">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </button>
            </form>

            <div class="auth-footer">
                <p>
                    <i class="fas fa-user-plus"></i> Don't have an account? 
                    <a href="{{ route('signup') }}">Create Account</a>
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