<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - TPQ Khairunnisa</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }

        /* Left Side - Decorative */
        .left-side {
            flex: 1;
            background: linear-gradient(135deg, #0f4c75 0%, #1b262c 50%, #0f4c75 100%);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            overflow: hidden;
            min-height: 100vh;
        }

        .left-side::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            animation: float 30s linear infinite;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            100% {
                transform: translate(-50px, -50px) rotate(360deg);
            }
        }

        /* Floating shapes */
        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: pulse 4s ease-in-out infinite;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background: linear-gradient(45deg, #3fc1c9, #00b894);
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            background: linear-gradient(45deg, #f39c12, #e74c3c);
            bottom: -50px;
            right: -50px;
            animation-delay: 1s;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            background: linear-gradient(45deg, #9b59b6, #3498db);
            top: 50%;
            left: 10%;
            animation-delay: 2s;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.1;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.15;
            }
        }

        .brand-content {
            position: relative;
            z-index: 10;
            text-align: center;
            color: white;
            max-width: 600px;

        }

        .mosque-icon {
            width: 120px;
            height: 120px;
            background-color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            animation: glow 3s ease-in-out infinite;
        }

        @keyframes glow {

            0%,
            100% {
                box-shadow: 0 0 30px rgba(63, 193, 201, 0.3);
            }

            50% {
                box-shadow: 0 0 50px rgba(63, 193, 201, 0.5);
            }
        }

        .mosque-icon i {
            font-size: 60px;
            color: #3fc1c9;
        }

        .brand-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
        }

        .brand-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 40px;
            font-weight: 300;
            line-height: 1.6;
        }

        .features {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 40px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 25px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            text-align: left;
        }

        .feature-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(10px);
        }

        .feature-item i {
            font-size: 24px;
            color: #3fc1c9;
            flex-shrink: 0;
        }

        .feature-item span {
            font-size: 0.95rem;
            flex: 1;
        }

        /* Right Side - Login Form */
        .right-side {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            background: #f8f9fa;
            position: relative;
            min-height: 100vh;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header h2 {
            font-size: 2rem;
            font-weight: 600;
            color: #1b262c;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #6c757d;
            font-size: 0.95rem;
        }

        .login-form {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #1b262c;
            font-size: 0.9rem;
        }

        .input-wrapper {
            position: relative;
            transition: transform 0.2s ease;
        }

        .input-wrapper i.input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            font-size: 18px;
            transition: color 0.3s ease;
            pointer-events: none;
            z-index: 1;
        }

        .input-wrapper input {
            width: 100%;
            padding: 15px 50px 15px 50px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .input-wrapper input:focus {
            outline: none;
            border-color: #0f4c75;
            background: white;
            box-shadow: 0 0 0 4px rgba(15, 76, 117, 0.1);
        }

        .input-wrapper input:focus~i.input-icon,
        .input-wrapper:focus-within i.input-icon {
            color: #0f4c75;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #adb5bd;
            cursor: pointer;
            padding: 8px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 2;
            width: 36px;
            height: 36px;
        }

        .password-toggle:hover {
            color: #0f4c75;
            background: rgba(15, 76, 117, 0.05);
        }

        .password-toggle:active {
            transform: translateY(-50%) scale(0.95);
        }

        .password-toggle i {
            font-size: 18px;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #0f4c75;
            cursor: pointer;
        }

        .remember-me span {
            font-size: 0.9rem;
            color: #6c757d;
            user-select: none;
        }

        .forgot-password {
            color: #0f4c75;
            font-size: 0.9rem;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #3fc1c9;
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #0f4c75 0%, #1b262c 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(15, 76, 117, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login i {
            font-size: 20px;
        }

        .error-message {
            background: #fee2e2;
            color: #dc2626;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid #dc2626;
        }

        .error-message i {
            font-size: 18px;
            flex-shrink: 0;
        }

        .success-message {
            background: #d1fae5;
            color: #059669;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid #059669;
        }

        .success-message i {
            font-size: 18px;
            flex-shrink: 0;
        }

        .footer-text {
            text-align: center;
            margin-top: 30px;
            color: #6c757d;
            font-size: 0.85rem;
        }

        .footer-text a {
            color: #0f4c75;
            text-decoration: none;
            font-weight: 500;
        }

        /* Arabic Decoration */
        .arabic-text {
            font-size: 1.8rem;
            margin-bottom: 10px;
            opacity: 0.9;
            font-family: 'Traditional Arabic', serif;
        }

        /* Loading animation */
        .btn-login.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .spinner {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive Design */
        @media (max-width: 1200px) {

            .left-side,
            .right-side {
                flex: 1;
            }

            .brand-title {
                font-size: 2.2rem;
            }

            .feature-item span {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 992px) {
            body {
                flex-direction: column;
                overflow-y: auto;
            }

            .left-side {
                min-height: 50vh;
                padding: 40px 20px;
            }

            .right-side {
                min-height: 50vh;
                padding: 40px 20px;
            }

            .brand-title {
                font-size: 2rem;
            }

            .brand-subtitle {
                font-size: 1rem;
            }

            .features {
                margin-top: 30px;
                gap: 15px;
            }

            .feature-item {
                padding: 12px 20px;
            }

            .login-form {
                padding: 35px 30px;
            }
        }

        @media (max-width: 768px) {
            .left-side {
                min-height: 40vh;
                padding: 30px 20px;
            }

            .mosque-icon {
                width: 100px;
                height: 100px;
            }

            .mosque-icon i {
                font-size: 50px;
            }

            .brand-title {
                font-size: 1.8rem;
            }

            .brand-subtitle {
                font-size: 0.95rem;
                margin-bottom: 20px;
            }

            .arabic-text {
                font-size: 1.5rem;
            }

            .features {
                display: none;
            }

            .login-header h2 {
                font-size: 1.75rem;
            }

            .login-form {
                padding: 30px 25px;
            }

            .form-group {
                margin-bottom: 20px;
            }
        }

        @media (max-width: 576px) {
            .left-side {
                min-height: 35vh;
                padding: 25px 15px;
            }

            .right-side {
                padding: 30px 15px;
            }

            .mosque-icon {
                width: 80px;
                height: 80px;

            }

            .mosque-icon i {
                font-size: 40px;
            }

            .brand-title {
                font-size: 1.5rem;
            }

            .brand-subtitle {
                font-size: 0.9rem;
            }

            .arabic-text {
                font-size: 1.3rem;
            }

            .login-header {
                margin-bottom: 30px;
            }

            .login-header h2 {
                font-size: 1.5rem;
            }

            .login-header p {
                font-size: 0.9rem;
            }

            .login-form {
                padding: 25px 20px;
                border-radius: 16px;
            }

            .input-wrapper input {
                padding: 14px 45px 14px 45px;
                font-size: 0.95rem;
            }

            .input-wrapper i.input-icon {
                font-size: 16px;
                left: 14px;
            }

            .password-toggle {
                right: 10px;
                width: 34px;
                height: 34px;
            }

            .password-toggle i {
                font-size: 16px;
            }

            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .btn-login {
                padding: 14px;
                font-size: 0.95rem;
            }

            .footer-text {
                font-size: 0.8rem;
                margin-top: 20px;
            }
        }

        @media (max-width: 400px) {
            .login-container {
                max-width: 100%;
            }

            .login-form {
                padding: 20px 15px;
            }

            .input-wrapper input {
                padding: 12px 40px 12px 40px;
            }
        }

        /* Dark mode support (optional) */
        @media (prefers-color-scheme: dark) {
            /* You can add dark mode styles here if needed */
        }
    </style>
</head>

<body>
    <!-- Left Side - Branding -->
    <div class="left-side">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>

        <div class="brand-content">
            <div class="mosque-icon">
                <img src="{{ asset('images/logo-tpq-1.png') }}" alt="logo tpq khairunnisa"
                    style="width: 90px; height: 90px;">
            </div>
            <div class="arabic-text">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيم</div>
            <h1 class="brand-title">TPQ Khairunnisa</h1>
            <p class="brand-subtitle">Taman Pendidikan Al-Quran<br>Ternate, Maluku Utara</p>

            <div class="features">
                <div class="feature-item">
                    <i class="bi bi-people-fill"></i>
                    <span>Kelola Data Santri dengan Mudah</span>
                </div>
                <div class="feature-item">
                    <i class="bi bi-graph-up-arrow"></i>
                    <span>Pantau Progress Pembelajaran</span>
                </div>
                <div class="feature-item">
                    <i class="bi bi-calendar-check"></i>
                    <span>Absensi Terintegrasi</span>
                </div>
                <div class="feature-item">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Laporan & Analitik Lengkap</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side - Login Form -->
    <div class="right-side">
        <div class="login-container">
            <div class="login-header">
                <h2>Selamat Datang!</h2>
                <p>Silakan login untuk melanjutkan</p>
            </div>

            <div class="login-form">
                @if (session('status'))
                    <div class="success-message">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-wrapper">
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                placeholder="Masukkan email Anda" required autofocus>
                            <i class="bi bi-envelope input-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <input type="password" id="password" name="password" placeholder="Masukkan password"
                                required>
                            <i class="bi bi-lock input-icon"></i>
                            <button type="button" class="password-toggle" onclick="togglePassword()"
                                aria-label="Toggle password visibility">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember" id="remember">
                            <span>Ingat saya</span>
                        </label>

                    </div>

                    <button type="submit" class="btn-login" id="btnLogin">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span>Login</span>
                    </button>
                </form>
            </div>

            <p class="footer-text">
                &copy; {{ date('Y') }} TPQ Khairunnisa Ternate. All rights reserved.
            </p>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }

        // Form submit loading
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('btnLogin');
            btn.classList.add('loading');
            btn.innerHTML = '<div class="spinner"></div><span>Memproses...</span>';
        });

        // Add floating animation to input focus
        document.querySelectorAll('.input-wrapper input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>

</html>
