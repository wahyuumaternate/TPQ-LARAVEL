<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TPQ Khairunnisa') }} - @yield('title', 'Dashboard')</title>
    <link rel="icon" href="{{ asset('images/logo-tpq-2.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-tpq-2.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- ============================================ -->
    <!-- SELECT2 CSS - HARUS DI SINI! -->
    <!-- ============================================ -->
    <link href="{{ asset('select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('select2/dist/css/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet" />

    @stack('styles')
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Page Content -->
        <div class="main">
            <!-- Navbar -->
            @include('layouts.navbar')

            <!-- Main Content -->
            <main class="content">
                <div class="container-fluid p-0">
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <strong>TPQ Khairunnisa</strong> &copy; {{ date('Y') }}
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="mb-0">
                                Sistem Informasi Manajemen TPQ
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- SCRIPTS - URUTAN SANGAT PENTING! -->
    <!-- ============================================ -->

    <!-- 1. jQuery - HARUS PERTAMA -->
    <script src="{{ asset('jquery-3.7.1.min.js') }}"></script>

    <!-- 2. Select2 - FROM LOCAL FOLDER -->
    <script src="{{ asset('select2/dist/js/select2.min.js') }}"></script>

    <!-- 3. Verify libraries loaded -->
    <script>
        // Check if libraries loaded correctly
        if (typeof jQuery === 'undefined') {
            console.error('CRITICAL: jQuery not loaded!');
        } else {
            console.log('✓ jQuery loaded:', $.fn.jquery);
        }

        if (typeof $.fn.select2 === 'undefined') {
            console.error('CRITICAL: Select2 not loaded!');
            console.error('Check if file exists: {{ asset('select2/dist/js/select2.min.js') }}');
        } else {
            console.log('✓ Select2 loaded successfully from local folder');
        }
    </script>

    <!-- 4. Custom Scripts dari Views -->
    @stack('scripts')

    <!-- 5. Global Scripts -->
    <script>
        $(document).ready(function() {
            // Auto hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert:not(.alert-permanent)').fadeOut('slow');
            }, 5000);

            // CSRF Token untuk AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Set global Select2 defaults only if Select2 is loaded
            if (typeof $.fn.select2 !== 'undefined') {
                try {
                    $.fn.select2.defaults.set("theme", "bootstrap-5");
                    $.fn.select2.defaults.set("width", "100%");
                    console.log('✓ Select2 global defaults set');
                } catch (e) {
                    console.warn('Could not set Select2 defaults:', e);
                }
            }
        });
    </script>
</body>

</html>
