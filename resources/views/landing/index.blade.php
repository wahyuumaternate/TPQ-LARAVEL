@extends('landing.layout')

@section('title', 'TPQ Khairunnisa Ternate - Beranda')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="hero-image" data-aos="fade-right" data-aos-delay="100">
                        <img src="{{ asset('images/logo-tpq-2.png') }}" alt="TPQ Khairunnisa" class="img-fluid main-image">
                        {{-- <div class="floating-card emergency-card" data-aos="fade-up" data-aos-delay="300">
                            <div class="card-content">
                                <i class="bi bi-telephone-fill"></i>
                                <div class="text">
                                    <span class="label">Hubungi Kami</span>
                                    <span class="number">+62 xxx xxxx xxxx</span>
                                </div>
                            </div>
                        </div>
                        <div class="floating-card stats-card" data-aos="fade-up" data-aos-delay="400">
                            <div class="stat-item">
                                <span class="number">{{ $stats['total_santri'] }}+</span>
                                <span class="label">Santri Aktif</span>
                            </div>
                            <div class="stat-item">
                                <span class="number">{{ $stats['total_guru'] }}+</span>
                                <span class="label">Ustadz/Ustadzah</span>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="hero-content" data-aos="fade-left" data-aos-delay="200">
                        <div class="badge-container">
                            <span class="hero-badge">Taman Pendidikan Al-Quran Terpercaya</span>
                        </div>

                        <h1 class="hero-title">Selamat Datang di TPQ Khairunnisa</h1>
                        <p class="hero-description">
                            Sistem digitalisasi Santri, Guru dan Orang Tua. Login data detail, Laporan Statistik
                            dan berbagai Berita dan informasi tentang TPQ Khairunnisa Ternate.
                        </p>

                        <div class="hero-stats">
                            <div class="stat-group">
                                <div class="stat">
                                    <i class="bi bi-book"></i>
                                    <div class="stat-text">
                                        <span class="number">{{ $stats['total_santri'] }}+</span>
                                        <span class="label">Santri Aktif</span>
                                    </div>
                                </div>
                                <div class="stat">
                                    <i class="bi bi-people"></i>
                                    <div class="stat-text">
                                        <span class="number">{{ $stats['total_guru'] }}+</span>
                                        <span class="label">Guru/Ustadz</span>
                                    </div>
                                </div>
                                <div class="stat">
                                    <i class="bi bi-mortarboard"></i>
                                    <div class="stat-text">
                                        <span class="number">{{ $stats['total_kelas'] }}</span>
                                        <span class="label">Kelas Aktif</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="cta-section">
                            <div class="cta-buttons">
                                <a href="{{ route('login') }}" class="btn btn-primary">Login Aplikasi</a>
                                <a href="{{ route('landing.about') }}" class="btn btn-secondary">
                                    <i class="bi bi-info-circle"></i>
                                    Tentang Kami
                                </a>
                            </div>

                            <div class="quick-actions">
                                <a href="{{ route('landing.contact') }}" class="action-link">
                                    <i class="bi bi-calendar-check"></i>
                                    <span>Daftar Santri Baru</span>
                                </a>
                                <a href="{{ url('/news') }}" class="action-link">
                                    <i class="bi bi-newspaper"></i>
                                    <span>Berita & Pengumuman</span>
                                </a>
                                <a href="{{ route('landing.contact') }}" class="action-link">
                                    <i class="bi bi-chat-dots"></i>
                                    <span>Hubungi Kami</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="background-elements">
            <div class="bg-shape shape-1"></div>
            <div class="bg-shape shape-2"></div>
            <div class="bg-pattern"></div>
        </div>
    </section><!-- /Hero Section -->

    <!-- Home About Section -->
    <section id="home-about" class="home-about section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5" data-aos="fade-up" data-aos-delay="150">
                    <h2 class="section-heading">Pendidikan Al-Quran Berkualitas</h2>
                    <p class="lead-description">
                        TPQ Khairunnisa berkomitmen memberikan pendidikan Al-Quran terbaik dengan metode pembelajaran
                        yang efektif dan menyenangkan bagi para santri.
                    </p>
                </div>
            </div>

            <div class="row align-items-center gy-5">
                <div class="col-lg-7" data-aos="fade-right" data-aos-delay="200">
                    <div class="image-grid">
                        <div class="primary-image">
                            <img src="{{ asset('santri/1.jpg') }}" alt="TPQ Khairunnisa" class="img-fluid">
                            <div class="certification-badge">
                                <i class="bi bi-award"></i>
                                <span>Terakreditasi</span>
                            </div>
                        </div>
                        <div class="secondary-images">
                            <div class="small-image">
                                <img src="{{ asset('santri/2.jpg') }}" alt="Pembelajaran" class="img-fluid">
                            </div>
                            <div class="small-image">
                                <img src="{{ asset('santri/3.jpg') }}" alt="Santri" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5" data-aos="fade-left" data-aos-delay="300">
                    <div class="content-wrapper">
                        <div class="highlight-box">
                            <div class="highlight-icon">
                                <i class="bi bi-heart-pulse-fill"></i>
                            </div>
                            <div class="highlight-content">
                                <h4>Metode Pembelajaran Modern</h4>
                                <p>Menggunakan sistem pembelajaran yang disesuaikan dengan kemampuan dan kebutuhan setiap
                                    santri.</p>
                            </div>
                        </div>

                        <div class="feature-list">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div class="feature-text">Sistem digital monitoring progress santri</div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div class="feature-text">Guru/ustadz berpengalaman dan berkompeten</div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div class="feature-text">Program hafalan dan tilawah</div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div class="feature-text">Laporan perkembangan santri berkala</div>
                            </div>
                        </div>

                        <div class="action-buttons">
                            <a href="{{ route('landing.about') }}" class="btn-explore">Selengkapnya</a>
                            <a href="{{ route('landing.contact') }}" class="btn-contact">
                                <i class="bi bi-telephone"></i>
                                Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Home About Section -->

    <!-- Featured Departments Section -->
    <section id="featured-departments" class="featured-departments section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Program Pembelajaran</h2>
            <p>Program-program unggulan yang dirancang untuk mengembangkan kemampuan santri</p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="departments-grid">
                <div class="row">
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="department-card">
                            <div class="card-icon">
                                <i class="bi bi-book"></i>
                            </div>
                            <div class="card-content">
                                <h3 class="card-title">Iqra 1-6</h3>
                                <p class="card-description">
                                    Program dasar pembelajaran membaca Al-Quran dengan metode Iqra yang terstruktur
                                    dan mudah dipahami.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="department-card">
                            <div class="card-icon">
                                <i class="bi bi-journal-text"></i>
                            </div>
                            <div class="card-content">
                                <h3 class="card-title">Al-Quran</h3>
                                <p class="card-description">
                                    Pembelajaran membaca Al-Quran dengan tartil, tajwid yang benar, dan pemahaman
                                    makna ayat.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="department-card">
                            <div class="card-icon">
                                <i class="bi bi-star"></i>
                            </div>
                            <div class="card-content">
                                <h3 class="card-title">Tahfidz</h3>
                                <p class="card-description">
                                    Program hafalan Al-Quran dengan metode yang menyenangkan dan target yang terukur
                                    sesuai kemampuan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="350">
                        <div class="department-card">
                            <div class="card-icon">
                                <i class="bi bi-music-note"></i>
                            </div>
                            <div class="card-content">
                                <h3 class="card-title">Tilawah</h3>
                                <p class="card-description">
                                    Pelatihan seni baca Al-Quran dengan irama dan lagu yang indah sesuai kaidah
                                    qira'ah sab'ah.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="department-card">
                            <div class="card-icon">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="card-content">
                                <h3 class="card-title">Akhlak & Adab</h3>
                                <p class="card-description">
                                    Pembinaan akhlak mulia dan adab Islami dalam keseharian untuk membentuk karakter
                                    santri yang baik.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="450">
                        <div class="department-card">
                            <div class="card-icon">
                                <i class="bi bi-trophy"></i>
                            </div>
                            <div class="card-content">
                                <h3 class="card-title">Evaluasi & Progress</h3>
                                <p class="card-description">
                                    Sistem monitoring dan evaluasi berkala untuk memantau perkembangan setiap santri
                                    secara digital.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Featured Departments Section -->

    <!-- Latest News -->
    @if ($latestNews->count() > 0)
        <section id="featured-services" class="featured-services section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Berita & Kegiatan Terbaru</h2>
                <p>Informasi terkini tentang kegiatan dan program TPQ Khairunnisa</p>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">
                    @foreach ($latestNews->take(3) as $news)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="service-card">
                                <div class="service-icon">
                                    <i class="bi bi-newspaper"></i>
                                </div>
                                <div class="service-image">
                                    @if ($news->gambar)
                                        <img src="{{ asset('storage/' . $news->gambar) }}" alt="{{ $news->judul }}"
                                            class="img-fluid" loading="lazy">
                                    @else
                                        <img src="{{ asset('assets/img/news-default.jpg') }}" alt="{{ $news->judul }}"
                                            class="img-fluid" loading="lazy">
                                    @endif
                                </div>
                                <div class="service-content">
                                    @if ($news->kategori)
                                        <span class="badge bg-primary mb-2">{{ $news->kategori }}</span>
                                    @endif
                                    <h3>{{ Str::limit($news->judul, 50) }}</h3>
                                    <p>{{ Str::limit($news->excerpt, 100) }}</p>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar3"></i> {{ $news->published_date }}
                                    </small>
                                    <br>
                                    <a href="{{ url('news/' . $news->slug) }}" class="service-link">Baca Selengkapnya <i
                                            class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-4">
                    <a href="{{ url('/news') }}" class="btn btn-primary">Lihat Semua Berita</a>
                </div>
            </div>
        </section>
    @endif

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section light-background">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="content-wrapper">
                            <h2>Daftarkan Putra-Putri Anda Sekarang</h2>
                            <p>
                                Bergabunglah dengan TPQ Khairunnisa dan berikan pendidikan Al-Quran terbaik
                                untuk anak-anak Anda. Sistem pembelajaran modern dengan pengajar berkualitas.
                            </p>

                            <div class="action-buttons">
                                <a href="{{ route('landing.contact') }}" class="primary-btn">Daftar Sekarang</a>
                                <a href="{{ route('landing.about') }}" class="secondary-link">
                                    <span>Pelajari Lebih Lanjut</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-image" data-aos="zoom-in" data-aos-delay="300">
                            <img src="{{ asset('santri/4.webp') }}" alt="TPQ Khairunnisa" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>

            <div class="stats-section" data-aos="fade-up" data-aos-delay="400">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-number">{{ $stats['total_santri'] }}+</div>
                            <div class="stat-label">Santri Aktif</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-number">{{ $stats['total_guru'] }}+</div>
                            <div class="stat-label">Guru/Ustadz</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-number">{{ $stats['total_kelas'] }}</div>
                            <div class="stat-label">Kelas Aktif</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-number">100%</div>
                            <div class="stat-label">Kepuasan Wali Santri</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-banner" data-aos="zoom-in" data-aos-delay="600">
                <div class="banner-content">
                    <div class="contact-info">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-text">
                            <h5>Butuh Informasi Lebih Lanjut?</h5>
                            <p>Tim kami siap membantu Anda untuk informasi pendaftaran dan program TPQ.</p>
                        </div>
                    </div>
                    <div class="contact-actions">
                        <a href="tel:+62xxxxxxxxx" class="call-btn">
                            <i class="fas fa-phone"></i>
                            +62 xxx xxxx xxxx
                        </a>
                        <a href="{{ route('landing.contact') }}" class="contact-link">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Call To Action Section -->
@endsection
