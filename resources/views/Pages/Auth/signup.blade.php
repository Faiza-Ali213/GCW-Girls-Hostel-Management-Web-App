<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Hostel Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            min-height: 100vh;
            height: auto;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px 20px;
            background: linear-gradient(-45deg, #1A365D, #2c4a7a, #3b5a8a, #1A365D);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            position: relative;
            overflow-y: auto;
            min-height: 100vh;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(26, 54, 93, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(44, 74, 122, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 50% 20%, rgba(59, 90, 138, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 50% 80%, rgba(26, 54, 93, 0.2) 0%, transparent 50%);
            z-index: 0;
            animation: pulseBg 8s ease-in-out infinite;
        }

        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.3;
            animation: floatOrb 20s ease-in-out infinite;
            z-index: 0;
        }

        .orb-1 {
            width: 400px;
            height: 400px;
            background: #1A365D;
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 350px;
            height: 350px;
            background: #2c4a7a;
            bottom: -80px;
            right: -80px;
            animation-delay: -5s;
        }

        .orb-3 {
            width: 300px;
            height: 300px;
            background: #3b5a8a;
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
            margin: 20px auto;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 40px 35px;
            box-shadow: 0 30px 80px rgba(26, 54, 93, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: visible;
            max-height: 90vh;
            overflow-y: auto;
        }

        .auth-card::-webkit-scrollbar {
            width: 5px;
        }

        .auth-card::-webkit-scrollbar-track {
            background: transparent;
        }

        .auth-card::-webkit-scrollbar-thumb {
            background: #1A365D;
            border-radius: 10px;
        }

        .auth-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #1A365D, #2c4a7a, #3b5a8a, #1A365D);
            background-size: 300% 100%;
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0% { background-position: 0% 0%; }
            50% { background-position: 100% 0%; }
            100% { background-position: 0% 0%; }
        }

        .auth-card:hover {
            transform: translateY(-5px) scale(1.005);
            box-shadow: 0 40px 100px rgba(26, 54, 93, 0.35);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .auth-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #1A365D 0%, #2c4a7a 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 32px;
            color: white;
            box-shadow: 0 15px 40px rgba(26, 54, 93, 0.4);
            transition: all 0.4s ease;
            animation: pulseIcon 3s ease-in-out infinite;
        }

        @keyframes pulseIcon {
            0%, 100% { transform: scale(1); box-shadow: 0 15px 40px rgba(26, 54, 93, 0.4); }
            50% { transform: scale(1.05); box-shadow: 0 20px 60px rgba(26, 54, 93, 0.6); }
        }

        .auth-card:hover .auth-icon {
            transform: scale(1.1) rotate(-5deg);
        }

        .auth-title {
            font-weight: 800;
            color: #1a202c;
            font-size: 28px;
            margin-bottom: 5px;
            letter-spacing: -0.5px;
        }

        .auth-title span {
            background: linear-gradient(135deg, #1A365D 0%, #2c4a7a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .auth-subtitle {
            color: #718096;
            font-size: 13px;
            font-weight: 400;
            letter-spacing: 0.3px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            font-weight: 600;
            color: #2d3748;
            font-size: 13px;
            margin-bottom: 6px;
            display: block;
            transition: color 0.3s ease;
        }

        .form-group label i {
            color: #1A365D;
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
            border-radius: 12px;
            padding: 12px 18px;
            border: 2px solid #e2e8f0;
            font-size: 13px;
            transition: all 0.3s ease;
            background: rgba(247, 250, 252, 0.8);
            color: #2d3748;
            font-weight: 500;
        }

        .input-group-custom .form-control:focus {
            border-color: #1A365D;
            box-shadow: 0 0 0 4px rgba(26, 54, 93, 0.1);
            background: white;
        }

        .input-group-custom .form-control.is-invalid {
            border-color: #fc8181;
        }

        .input-group-custom .form-control.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(252, 129, 129, 0.15);
        }

        .input-group-custom .form-control::placeholder {
            color: #a0aec0;
            font-weight: 400;
        }

        .text-danger {
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #a0aec0;
            transition: all 0.3s ease;
            background: none;
            border: none;
            padding: 5px;
            border-radius: 50%;
        }

        .password-toggle:hover {
            color: #1A365D;
            background: rgba(26, 54, 93, 0.1);
        }

        .btn-auth {
            background: linear-gradient(135deg, #1A365D 0%, #2c4a7a 100%);
            border: none;
            padding: 14px;
            font-weight: 600;
            font-size: 15px;
            width: 100%;
            border-radius: 12px;
            color: white;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 10px;
            margin-bottom: 5px;
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
            transform: translateY(-2px) scale(1.01);
            box-shadow: 0 15px 40px rgba(26, 54, 93, 0.4);
            color: white;
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
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px solid rgba(247, 250, 252, 0.8);
        }

        .auth-footer p {
            color: #718096;
            font-size: 13px;
            margin-bottom: 0;
        }

        .auth-footer a {
            color: #1A365D;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            padding: 5px 10px;
            border-radius: 8px;
        }

        .auth-footer a:hover {
            color: #2c4a7a;
            background: rgba(26, 54, 93, 0.1);
            text-decoration: none;
        }

        .auth-footer a i {
            margin-right: 5px;
            transition: transform 0.3s ease;
        }

        .auth-footer a:hover i {
            transform: translateX(-3px);
        }

        .alert-custom {
            border-radius: 12px;
            padding: 12px 18px;
            border: none;
            margin-bottom: 18px;
            font-weight: 500;
            font-size: 13px;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-15px);
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

        .password-strength {
            margin-top: 6px;
            height: 3px;
            border-radius: 10px;
            background: #e2e8f0;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            border-radius: 10px;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .password-strength-text {
            font-size: 11px;
            margin-top: 4px;
            color: #718096;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        @media (max-width: 576px) {
            body {
                padding: 20px 15px;
            }
            
            .auth-card {
                padding: 25px 20px;
                max-height: 95vh;
            }

            .auth-title {
                font-size: 24px;
            }

            .auth-icon {
                width: 60px;
                height: 60px;
                font-size: 26px;
            }

            .btn-auth {
                padding: 12px;
                font-size: 14px;
            }

            .orb-1, .orb-2, .orb-3 {
                display: none;
            }
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
                    <i class="fas fa-user-plus"></i>
                </div>
                <h1 class="auth-title">Create <span>Account</span></h1>
                <p class="auth-subtitle">Join GCW Hostel family today</p>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert-custom alert-success-custom">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
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

            <!-- Registration Form -->
            <form action="{{ route('signup.submit') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name"><i class="fas fa-user"></i> Full Name</label>
                    <div class="input-group-custom">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" placeholder="Enter your full name" 
                               value="{{ old('name') }}" required>
                    </div>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
                    <div class="input-group-custom">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" placeholder="Enter your email" 
                               value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Password</label>
                    <div class="input-group-custom">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" placeholder="Create a password (min 8 characters)" 
                               required>
                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <div class="password-strength">
                        <div class="password-strength-bar" id="strengthBar"></div>
                    </div>
                    <div class="password-strength-text" id="strengthText">Enter a strong password (min 8 characters)</div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation"><i class="fas fa-check-circle"></i> Confirm Password</label>
                    <div class="input-group-custom">
                        <input type="password" class="form-control" 
                               id="password_confirmation" name="password_confirmation" 
                               placeholder="Confirm your password" required>
                    </div>
                </div>

                <!-- ✅ SUBMIT BUTTON - Now always visible -->
                <button type="submit" class="btn-auth">
                    <i class="fas fa-arrow-right"></i> Create Account
                </button>
            </form>

            <div class="auth-footer">
                <p>Already have an account? <a href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const toggleBtn = field.parentElement.querySelector('.password-toggle');
            const icon = toggleBtn.querySelector('i');
            
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

        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');
            
            let strength = 0;
            let color = '#e2e8f0';
            let text = 'Enter a strong password (min 8 characters)';
            
            if (password.length >= 8) strength += 20;
            if (password.match(/[a-z]+/)) strength += 20;
            if (password.match(/[A-Z]+/)) strength += 20;
            if (password.match(/[0-9]+/)) strength += 20;
            if (password.match(/[$@#&!]+/)) strength += 20;
            
            if (strength === 0) {
                color = '#e2e8f0';
                text = 'Enter a strong password (min 8 characters)';
            } else if (strength <= 20) {
                color = '#fc8181';
                text = 'Weak password';
            } else if (strength <= 40) {
                color = '#ed8936';
                text = 'Fair password';
            } else if (strength <= 60) {
                color = '#ecc94b';
                text = 'Good password';
            } else if (strength <= 80) {
                color = '#48bb78';
                text = 'Strong password';
            } else {
                color = '#38a169';
                text = 'Very strong password!';
            }
            
            strengthBar.style.width = strength + '%';
            strengthBar.style.backgroundColor = color;
            strengthText.textContent = text;
            strengthText.style.color = color;
        });
    </script>

</body>
</html>