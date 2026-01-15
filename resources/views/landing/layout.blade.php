<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'TPQ Khairunnisa Ternate')</title>
    <meta name="description" content="Sistem digitalisasi Santri, Guru dan Orang Tua TPQ Khairunnisa Ternate">
    <meta name="keywords" content="TPQ, Khairunnisa, Ternate, Pendidikan Islam, Quran">

    <!-- Favicons -->
    <link rel="icon" href="{{ asset('images/logo-tpq-2.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-tpq-2.png') }}">


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container position-relative d-flex align-items-center justify-content-between">

            <a href="{{ route('landing') }}" class="logo d-flex align-items-center me-auto me-xl-0">
                <h1 class="sitename">TPQ<span>Khairunnisa</span></h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('landing') }}"
                            class="{{ request()->routeIs('landing') ? 'active' : '' }}">Beranda</a></li>
                    <li><a href="{{ route('landing.about') }}"
                            class="{{ request()->routeIs('landing.about') ? 'active' : '' }}">Tentang</a></li>
                    <li><a href="{{ url('/news') }}">Berita</a></li>
                    <li><a href="{{ route('landing.data-santri') }}"
                            class="{{ request()->routeIs('landing.data-santri') ? 'active' : '' }}">Data Santri</a>
                    </li>
                    <li><a href="{{ route('landing.contact') }}"
                            class="{{ request()->routeIs('landing.contact') ? 'active' : '' }}">Kontak</a></li>

                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            {{-- @guest
                <a class="btn-getstarted" href="{{ route('login') }}">Login Aplikasi</a>
            @else
                <a class="btn-getstarted" href="{{ route('dashboard') }}">Dashboard</a>
            @endguest --}}

        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>

    <footer id="footer" class="footer position-relative">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="{{ route('landing') }}" class="logo d-flex align-items-center">
                        <span class="sitename">TPQ Khairunnisa</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Ternate, Maluku Utara</p>
                        <p>Indonesia</p>
                        <p class="mt-3"><strong>Telepon:</strong> <span>+62 xxx xxxx xxxx</span></p>
                        <p><strong>Email:</strong> <span>info@tpqkhairunnisa.com</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Menu</h4>
                    <ul>
                        <li><a href="{{ route('landing') }}">Beranda</a></li>
                        <li><a href="{{ route('landing.about') }}">Tentang Kami</a></li>
                        <li><a href="{{ url('/news') }}">Berita</a></li>
                        <li><a href="{{ route('landing.contact') }}">Kontak</a></li>
                        <li><a href="{{ route('login') }}">Login</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Layanan</h4>
                    <ul>
                        <li><a href="#">Pendaftaran Santri</a></li>
                        <li><a href="#">Data Santri</a></li>
                        <li><a href="#">Data Guru</a></li>
                        <li><a href="#">Laporan Progress</a></li>
                        <li><a href="#">Statistik</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Informasi</h4>
                    <ul>
                        <li><a href="#">Program Pembelajaran</a></li>
                        <li><a href="#">Jadwal Kelas</a></li>
                        <li><a href="#">Pengumuman</a></li>
                        <li><a href="#">Galeri Kegiatan</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Bantuan</h4>
                    <ul>
                        <li><a href="#">Panduan Orang Tua</a></li>
                        <li><a href="#">Syarat Pendaftaran</a></li>
                        <li><a href="#">Hubungi Kami</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Ketentuan Layanan</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>&copy; <span>Copyright</span> <strong>TPQ Khairunnisa Ternate</strong> <span>{{ date('Y') }}. All
                    Rights Reserved</span></p>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
