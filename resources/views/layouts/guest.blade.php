<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TPQ Khairunnisa') }} - @yield('title', 'Login')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        body {
            background: linear-gradient(135deg, #1a3a5c 0%, #2d5a87 100%);
            min-height: 100vh;
        }
        .auth-card {
            max-width: 420px;
            width: 100%;
        }
        .auth-logo {
            width: 80px;
            height: 80px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .auth-logo i {
            font-size: 2.5rem;
            color: #1a3a5c;
        }
    </style>
</head>
<body>
    <div class="d-flex align-items-center justify-content-center min-vh-100 p-4">
        <div class="auth-card">
            <div class="text-center mb-4">
                <div class="auth-logo">
                    <i class="bi bi-book-half"></i>
                </div>
                <h2 class="text-white fw-bold">TPQ KHAIRUNNISA</h2>
                <p class="text-white-50">Sistem Informasi Manajemen TPQ</p>
            </div>
            
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    {{ $slot }}
                </div>
            </div>
            
            <p class="text-center text-white-50 mt-4 small">
                &copy; {{ date('Y') }} TPQ Khairunnisa Ternate
            </p>
        </div>
    </div>
</body>
</html>
