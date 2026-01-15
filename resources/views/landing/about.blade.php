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
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('landing') }}">Beranda</a></li>
                    <li class="current">Tentang Kami</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container">
            <div class="row gy-4 gx-5">
                <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="200">
                    <img src="{{ asset('images/logo-tpq-2.png') }}" class="img-fluid rounded-4 mb-4" alt="TPQ Khairunnisa">
                    <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox play-btn"></a>
                </div>

                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                    <h3>Sejarah TPQ Khairunnisa</h3>
                    <p>
                        TPQ Khairunnisa Ternate didirikan dengan tujuan mulia untuk memberikan pendidikan Al-Quran
                        yang berkualitas kepada generasi muda Muslim di Ternate, Maluku Utara.
                    </p>
                    <ul>
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span><strong>Visi:</strong> Menjadi lembaga pendidikan Al-Quran terdepan yang mencetak generasi
                                Qurani berakhlak mulia</span>
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span><strong>Misi:</strong> Memberikan pendidikan Al-Quran yang berkualitas dengan metode
                                pembelajaran yang efektif dan menyenangkan</span>
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            <span><strong>Nilai:</strong> Religius, Profesional, Inovatif, dan Peduli</span>
                        </li>
                    </ul>
                    <p class="mt-4">
                        Dengan dukungan guru-guru yang berkompeten dan berpengalaman, serta sistem pembelajaran yang
                        terstruktur, kami berkomitmen untuk memberikan yang terbaik bagi setiap santri.
                    </p>
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
                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="features-item">
                        <i class="bi bi-book" style="color: #0dcaf0;"></i>
                        <h3>Metode Pembelajaran Modern</h3>
                        <p>Menggunakan metode pembelajaran yang efektif dan disesuaikan dengan kemampuan santri</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="features-item">
                        <i class="bi bi-people" style="color: #fd7e14;"></i>
                        <h3>Guru Berkompeten</h3>
                        <p>Tenaga pengajar yang profesional dan berpengalaman dalam bidang pendidikan Al-Quran</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="features-item">
                        <i class="bi bi-clipboard-data" style="color: #20c997;"></i>
                        <h3>Sistem Monitoring Digital</h3>
                        <p>Pemantauan progress santri secara digital yang dapat diakses oleh orang tua</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="features-item">
                        <i class="bi bi-star" style="color: #df1529;"></i>
                        <h3>Program Unggulan</h3>
                        <p>Program hafalan, tilawah, dan pembinaan akhlak yang terstruktur</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="features-item">
                        <i class="bi bi-award" style="color: #6610f2;"></i>
                        <h3>Prestasi Gemilang</h3>
                        <p>Santri-santri kami sering meraih prestasi di berbagai kompetisi Al-Quran</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="features-item">
                        <i class="bi bi-building" style="color: #f3268c;"></i>
                        <h3>Fasilitas Memadai</h3>
                        <p>Ruang kelas yang nyaman dan fasilitas pembelajaran yang lengkap</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="700">
                    <div class="features-item">
                        <i class="bi bi-heart" style="color: #4233ff;"></i>
                        <h3>Pendekatan Personal</h3>
                        <p>Perhatian khusus untuk setiap santri sesuai dengan kebutuhan dan kemampuannya</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="800">
                    <div class="features-item">
                        <i class="bi bi-calendar-check" style="color: #b2904f;"></i>
                        <h3>Jadwal Fleksibel</h3>
                        <p>Pilihan waktu belajar yang fleksibel menyesuaikan dengan jadwal santri</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Features Section -->

@endsection
