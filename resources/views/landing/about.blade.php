@extends('landing.layout')

@section('title', 'Tentang Kami - TPQ Khairunnisa Ternate')

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Tentang TPQ Khairunnisa</h1>
                        <p class="mb-0">Lembaga Pendidikan Al-Quran yang berkomitmen mencetak generasi Qurani berakhlak
                            mulia</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Page Title -->

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container">
            <div class="row gy-4 gx-5">
                <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="200">
                    <img src="{{ asset('images/logo-tpq-2.png') }}" class="img-fluid rounded-4 mb-4 " alt="TPQ Khairunnisa">
                    <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox play-btn"></a>
                </div>

                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="mb-4">Sejarah TPQ Khairunnisa</h3>
                    <p class="fs-5 text-muted mb-4">
                        TPQ Khairunnisa Ternate didirikan dengan tujuan mulia untuk memberikan pendidikan Al-Quran
                        yang berkualitas kepada generasi muda Muslim di Ternate, Maluku Utara.
                    </p>

                    <div class="vstack gap-3">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <i class="bi bi-check-circle-fill text-primary fs-4"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1">Visi</h5>
                                <p class="text-muted mb-0">Menjadi lembaga pendidikan Al-Quran terdepan yang mencetak
                                    generasi
                                    Qurani berakhlak mulia</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <i class="bi bi-check-circle-fill text-success fs-4"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1">Misi</h5>
                                <p class="text-muted mb-0">Memberikan pendidikan Al-Quran yang berkualitas dengan metode
                                    pembelajaran yang efektif dan menyenangkan</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <i class="bi bi-check-circle-fill text-warning fs-4"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1">Nilai</h5>
                                <p class="text-muted mb-0">Religius, Profesional, Inovatif, dan Peduli</p>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info mt-4 border-0 shadow-sm" role="alert">
                        <i class="bi bi-info-circle me-2"></i>
                        Dengan dukungan guru-guru yang berkompeten dan berpengalaman, serta sistem pembelajaran yang
                        terstruktur, kami berkomitmen untuk memberikan yang terbaik bagi setiap santri.
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /About Section -->



    <!-- Features Section -->
    <section id="features" class="features section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Keunggulan Kami</h2>
            <p>Mengapa memilih TPQ Khairunnisa untuk pendidikan Al-Quran putra-putri Anda</p>
        </div>

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="features-item text-center p-4 h-100 bg-white rounded-4 shadow-sm hover-shadow">
                        <div class="icon-box mb-3">
                            <i class="bi bi-book" style="color: #0dcaf0; font-size: 48px;"></i>
                        </div>
                        <h4 class="mb-3">Metode Pembelajaran Modern</h4>
                        <p class="text-muted">Menggunakan metode pembelajaran yang efektif dan disesuaikan dengan kemampuan
                            santri</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="features-item text-center p-4 h-100 bg-white rounded-4 shadow-sm hover-shadow">
                        <div class="icon-box mb-3">
                            <i class="bi bi-people" style="color: #fd7e14; font-size: 48px;"></i>
                        </div>
                        <h4 class="mb-3">Guru Berkompeten</h4>
                        <p class="text-muted">Tenaga pengajar yang profesional dan berpengalaman dalam bidang pendidikan
                            Al-Quran</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="features-item text-center p-4 h-100 bg-white rounded-4 shadow-sm hover-shadow">
                        <div class="icon-box mb-3">
                            <i class="bi bi-clipboard-data" style="color: #20c997; font-size: 48px;"></i>
                        </div>
                        <h4 class="mb-3">Sistem Monitoring Digital</h4>
                        <p class="text-muted">Pemantauan progress santri secara digital yang dapat diakses oleh orang tua
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="features-item text-center p-4 h-100 bg-white rounded-4 shadow-sm hover-shadow">
                        <div class="icon-box mb-3">
                            <i class="bi bi-star" style="color: #df1529; font-size: 48px;"></i>
                        </div>
                        <h4 class="mb-3">Program Unggulan</h4>
                        <p class="text-muted">Program hafalan, tilawah, dan pembinaan akhlak yang terstruktur</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="features-item text-center p-4 h-100 bg-white rounded-4 shadow-sm hover-shadow">
                        <div class="icon-box mb-3">
                            <i class="bi bi-award" style="color: #6610f2; font-size: 48px;"></i>
                        </div>
                        <h4 class="mb-3">Prestasi Gemilang</h4>
                        <p class="text-muted">Santri-santri kami sering meraih prestasi di berbagai kompetisi Al-Quran</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="features-item text-center p-4 h-100 bg-white rounded-4 shadow-sm hover-shadow">
                        <div class="icon-box mb-3">
                            <i class="bi bi-building" style="color: #f3268c; font-size: 48px;"></i>
                        </div>
                        <h4 class="mb-3">Fasilitas Memadai</h4>
                        <p class="text-muted">Ruang kelas yang nyaman dan fasilitas pembelajaran yang lengkap</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="700">
                    <div class="features-item text-center p-4 h-100 bg-white rounded-4 shadow-sm hover-shadow">
                        <div class="icon-box mb-3">
                            <i class="bi bi-heart" style="color: #4233ff; font-size: 48px;"></i>
                        </div>
                        <h4 class="mb-3">Pendekatan Personal</h4>
                        <p class="text-muted">Perhatian khusus untuk setiap santri sesuai dengan kebutuhan dan kemampuannya
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="800">
                    <div class="features-item text-center p-4 h-100 bg-white rounded-4 shadow-sm hover-shadow">
                        <div class="icon-box mb-3">
                            <i class="bi bi-calendar-check" style="color: #b2904f; font-size: 48px;"></i>
                        </div>
                        <h4 class="mb-3">Jadwal Fleksibel</h4>
                        <p class="text-muted">Pilihan waktu belajar yang fleksibel menyesuaikan dengan jadwal santri</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Features Section -->

    <!-- Call to Action Section -->
    <section id="call-to-action" class="call-to-action section accent-background">
        <div class="container">
            <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                <div class="col-xl-10">
                    <div class="text-center">
                        <h3>Bergabunglah Bersama Kami</h3>
                        <p>Daftarkan putra-putri Anda sekarang dan berikan mereka pendidikan Al-Quran yang berkualitas untuk
                            masa depan yang lebih baik</p>
                        <a class="cta-btn" href="{{ route('register') }}">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Call to Action Section -->

    <style>
        .hover-shadow {
            transition: all 0.3s ease;
        }

        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
        }

        .features-item {
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .features-item:hover {
            border-color: transparent;
        }

        .stats-item {
            transition: all 0.3s ease;
        }

        .stats-item:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
        }

        .icon-box {
            display: inline-block;
            width: 80px;
            height: 80px;
            line-height: 80px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.03);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .vstack>div {
            padding: 15px;
            border-radius: 8px;
            background: rgba(0, 0, 0, 0.02);
        }
    </style>

@endsection
