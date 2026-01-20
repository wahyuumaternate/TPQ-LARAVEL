@extends('landing.layout')

@section('title', 'Hubungi Kami - TPQ Khairunnisa Ternate')

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="mb-3">Hubungi Kami</h1>
                        <p class="mb-0 fs-5">Kami siap membantu Anda dengan informasi yang Anda butuhkan tentang TPQ
                            Khairunnisa</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">



            <!-- Map & Form Section -->
            <div class="row gy-4">
                <!-- Google Maps -->
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="map-container">
                        <iframe style="border:0; width: 100%; height: 500px; border-radius: 10px;"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6666666666665!2d127.38!3d0.79!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMMKwNDcnMjQuMCJOIDEyN8KwMjInNDguMCJF!5e0!3m2!1sid!2sid!4v1234567890"
                            frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="contact-form-wrapper">
                        <h3 class="mb-4">Kirim Pesan</h3>
                        <form action="{{ route('landing.contact.submit') }}" method="post" class="php-email-form">
                            @csrf
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" placeholder="Email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            name="phone" placeholder="Nomor Telepon" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-select @error('subject') is-invalid @enderror" name="subject"
                                            required>
                                            <option value="">Pilih Topik</option>
                                            <option value="Pendaftaran Santri Baru"
                                                {{ old('subject') == 'Pendaftaran Santri Baru' ? 'selected' : '' }}>
                                                Pendaftaran Santri Baru
                                            </option>
                                            <option value="Informasi Program"
                                                {{ old('subject') == 'Informasi Program' ? 'selected' : '' }}>
                                                Informasi Program
                                            </option>
                                            <option value="Jadwal Kelas"
                                                {{ old('subject') == 'Jadwal Kelas' ? 'selected' : '' }}>
                                                Jadwal Kelas
                                            </option>
                                            <option value="Metode Pembelajaran"
                                                {{ old('subject') == 'Metode Pembelajaran' ? 'selected' : '' }}>
                                                Metode Pembelajaran
                                            </option>
                                            <option value="Lainnya" {{ old('subject') == 'Lainnya' ? 'selected' : '' }}>
                                                Lainnya
                                            </option>
                                        </select>
                                        @error('subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="6"
                                            placeholder="Tulis pesan Anda di sini..." required>{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-send me-2"></i>Kirim Pesan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Quick Contact Buttons -->
            <div class="row mt-5" data-aos="fade-up" data-aos-delay="400">
                <div class="col-lg-6 mb-3">
                    <a href="https://wa.me/6285240204028?text=Assalamualaikum, saya ingin bertanya tentang TPQ Khairunnisa"
                        target="_blank" class="quick-contact-btn whatsapp-btn">
                        <div class="icon">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <div class="content">
                            <span class="label">Hubungi via WhatsApp</span>
                            <strong class="number">085240204028</strong>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 mb-3">
                    <a href="tel:+6285240204028" class="quick-contact-btn phone-btn">
                        <div class="icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div class="content">
                            <span class="label">Telepon Sekarang</span>
                            <strong class="number">085240204028</strong>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section><!-- /Contact Section -->

    <!-- FAQ Section -->
    <section id="faq" class="faq section light-background">
        <div class="container section-title" data-aos="fade-up">
            <h2>Pertanyaan yang Sering Diajukan</h2>
            <p>Jawaban atas pertanyaan-pertanyaan umum tentang TPQ Khairunnisa</p>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">
                    <div class="faq-container">
                        <div class="faq-item faq-active">
                            <h3>Apakah TPQ Khairunnisa berbayar?</h3>
                            <div class="faq-content">
                                <p>Tidak, TPQ Khairunnisa adalah lembaga pendidikan Al-Quran yang 100% GRATIS. Kami tidak
                                    memungut biaya pendaftaran, SPP, maupun biaya lainnya. Pendidikan Al-Quran adalah hak
                                    setiap muslim dan kami berkomitmen untuk menyediakannya secara cuma-cuma.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>

                        <div class="faq-item">
                            <h3>Berapa usia minimal untuk mendaftar?</h3>
                            <div class="faq-content">
                                <p>Usia minimal untuk mendaftar di TPQ Khairunnisa adalah 5 tahun. Kami menerima santri dari
                                    berbagai tingkat kemampuan, mulai dari yang belum bisa membaca huruf hijaiyah hingga
                                    yang sudah lancar membaca Al-Quran.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>

                        <div class="faq-item">
                            <h3>Apa saja persyaratan pendaftaran?</h3>
                            <div class="faq-content">
                                <p>Persyaratan pendaftaran sangat sederhana: Fotocopy Akta Kelahiran, Fotocopy Kartu
                                    Keluarga, Pas
                                    Foto 3x4 (2 lembar), dan mengisi formulir pendaftaran. Untuk informasi lebih detail,
                                    silakan hubungi kami di 085240204028 atau email admin@tpq-khairunnisa.com</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>

                        <div class="faq-item">
                            <h3>Bagaimana sistem pembelajaran di TPQ Khairunnisa?</h3>
                            <div class="faq-content">
                                <p>Kami menggunakan metode pembelajaran Iqra yang terstruktur dan efektif. Setiap santri
                                    akan dibimbing sesuai dengan kemampuannya masing-masing. Kami juga menggunakan sistem
                                    monitoring digital untuk memantau perkembangan setiap santri secara berkala.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>

                        <div class="faq-item">
                            <h3>Apakah orang tua bisa memantau perkembangan santri?</h3>
                            <div class="faq-content">
                                <p>Ya, orang tua dapat memantau perkembangan santri melalui sistem digital kami. Kami juga
                                    rutin memberikan laporan perkembangan santri setiap bulannya dan mengadakan pertemuan
                                    dengan orang tua secara berkala untuk membahas progress pembelajaran.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>

                        <div class="faq-item">
                            <h3>Dimana lokasi TPQ Khairunnisa?</h3>
                            <div class="faq-content">
                                <p>TPQ Khairunnisa berlokasi di Jl. MT. Habib Abubakar Al-Atas No.12, Kelurahan Gamalama,
                                    Ternate, Maluku Utara. Anda dapat melihat lokasi kami pada peta di atas atau
                                    hubungi kami untuk panduan arah yang lebih detail.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>

                        <div class="faq-item">
                            <h3>Bagaimana cara mendaftar santri baru?</h3>
                            <div class="faq-content">
                                <p>Anda dapat mendaftar dengan datang langsung ke TPQ pada jam operasional, atau hubungi
                                    kami terlebih dahulu via WhatsApp di 085240204028 untuk membuat janji. Kami akan
                                    memberikan penjelasan lengkap tentang prosedur pendaftaran dan persyaratan yang
                                    diperlukan. Ingat, pendaftaran dan pembelajaran di TPQ kami 100% GRATIS.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>

                        <div class="faq-item">
                            <h3>Apakah ada program khusus selain pembelajaran Al-Quran?</h3>
                            <div class="faq-content">
                                <p>Selain pembelajaran membaca Al-Quran dengan metode Iqra, kami juga mengadakan program
                                    tahfidz (hafalan Al-Quran), pembelajaran akhlak dan adab islami, serta kegiatan-kegiatan
                                    keagamaan lainnya untuk membentuk karakter santri yang berakhlakul karimah.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /FAQ Section -->
@endsection

@push('styles')
    <style>
        /* Info Cards */
        .info-card {
            background: #fff;
            border-radius: 15px;
            padding: 30px 20px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #f0f0f0;
        }

        .info-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .info-card .icon-box {
            width: 70px;
            height: 70px;
            margin: 0 auto;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
        }

        .info-card .icon-box i {
            color: #fff;
            font-size: 2rem;
        }

        .info-card h3 {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 15px 0 10px;
            color: #2c3e50;
        }

        .info-card p {
            color: #6c757d;
            margin: 0;
            line-height: 1.8;
        }

        .info-card a {
            color: #667eea;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .info-card a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        /* Map Container */
        .map-container {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
        }

        /* Contact Form Wrapper */
        .contact-form-wrapper {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.08);
            height: 100%;
        }

        .contact-form-wrapper h3 {
            color: #2c3e50;
            font-weight: 700;
        }

        .php-email-form .form-control,
        .php-email-form .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 20px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .php-email-form .form-control:focus,
        .php-email-form .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .php-email-form textarea.form-control {
            resize: vertical;
        }

        .php-email-form .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 15px 30px;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .php-email-form .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        /* Quick Contact Buttons */
        .quick-contact-btn {
            display: flex;
            align-items: center;
            padding: 25px 30px;
            border-radius: 15px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        }

        .whatsapp-btn {
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            color: #fff;
        }

        .whatsapp-btn:hover {
            background: linear-gradient(135deg, #128C7E 0%, #075E54 100%);
            transform: translateY(-5px);
            box-shadow: 0 10px 35px rgba(37, 211, 102, 0.4);
            color: #fff;
        }

        .phone-btn {
            background: #fff;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .phone-btn:hover {
            background: #667eea;
            color: #fff;
            transform: translateY(-5px);
            box-shadow: 0 10px 35px rgba(102, 126, 234, 0.4);
        }

        .quick-contact-btn .icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            flex-shrink: 0;
        }

        .quick-contact-btn .icon i {
            font-size: 1.8rem;
        }

        .phone-btn .icon {
            background: rgba(102, 126, 234, 0.1);
        }

        .quick-contact-btn .content {
            flex-grow: 1;
            text-align: left;
        }

        .quick-contact-btn .label {
            display: block;
            font-size: 0.9rem;
            margin-bottom: 5px;
            opacity: 0.9;
        }

        .quick-contact-btn .number {
            display: block;
            font-size: 1.2rem;
            font-weight: 700;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .info-card {
                margin-bottom: 20px;
            }

            .contact-form-wrapper {
                padding: 25px;
                margin-top: 30px;
            }

            .quick-contact-btn {
                padding: 20px;
            }

            .quick-contact-btn .icon {
                width: 50px;
                height: 50px;
                margin-right: 15px;
            }

            .quick-contact-btn .icon i {
                font-size: 1.5rem;
            }

            .quick-contact-btn .number {
                font-size: 1rem;
            }
        }
    </style>
@endpush
