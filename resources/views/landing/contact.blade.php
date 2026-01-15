@extends('landing.layout')

@section('title', 'Hubungi Kami - TPQ Khairunnisa Ternate')

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Hubungi Kami</h1>
                        <p class="mb-0">Kami siap membantu Anda dengan informasi yang Anda butuhkan</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('landing') }}">Beranda</a></li>
                    <li class="current">Kontak</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
                <iframe style="border:0; width: 100%; height: 400px;"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6666666666665!2d127.38!3d0.79!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMMKwNDcnMjQuMCJOIDEyN8KwMjInNDguMCJF!5e0!3m2!1sid!2sid!4v1234567890"
                    frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div><!-- End Google Maps -->

            <div class="row gy-4">
                <div class="col-lg-4">
                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-geo-alt flex-shrink-0"></i>
                        <div>
                            <h3>Alamat</h3>
                            <p>Jl. MT. Habib Abubakar Al-Atas No.12<br>Kelurahan Gamalama, Ternate<br>Maluku Utara,
                                Indonesia</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-telephone flex-shrink-0"></i>
                        <div>
                            <h3>Telepon</h3>
                            <p>
                                <a href="tel:+6285240204028" class="text-decoration-none">085240204028</a><br>
                                <a href="tel:+6282256219291" class="text-decoration-none">082256219291</a>
                            </p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                        <i class="bi bi-whatsapp flex-shrink-0"></i>
                        <div>
                            <h3>WhatsApp</h3>
                            <p>
                                <a href="https://wa.me/6285240204028" target="_blank"
                                    class="text-decoration-none">085240204028</a><br>
                                <a href="https://wa.me/6282256219291" target="_blank"
                                    class="text-decoration-none">082256219291</a>
                            </p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="600">
                        <i class="bi bi-envelope flex-shrink-0"></i>
                        <div>
                            <h3>Email</h3>
                            <p><a href="mailto:admin@tpq-khairunnisa.com"
                                    class="text-decoration-none">admin@tpq-khairunnisa.com</a></p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="700">
                        <i class="bi bi-clock flex-shrink-0"></i>
                        <div>
                            <h3>Jam Operasional</h3>
                            <p>Senin - Jumat: 14.00 - 17.00 WIT<br>Sabtu: 08.00 - 12.00 WIT<br>Minggu: Libur</p>
                        </div>
                    </div><!-- End Info Item -->
                </div>

                <div class="col-lg-8">
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

                    <form action="{{ route('landing.contact.submit') }}" method="post" class="php-email-form"
                        data-aos="fade-up" data-aos-delay="200">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" placeholder="Email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" placeholder="Nomor Telepon (contoh: 081234567890)"
                                    value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
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
                                    <option value="Biaya Pendidikan"
                                        {{ old('subject') == 'Biaya Pendidikan' ? 'selected' : '' }}>
                                        Biaya Pendidikan
                                    </option>
                                    <option value="Jadwal Kelas" {{ old('subject') == 'Jadwal Kelas' ? 'selected' : '' }}>
                                        Jadwal Kelas
                                    </option>
                                    <option value="Lainnya" {{ old('subject') == 'Lainnya' ? 'selected' : '' }}>
                                        Lainnya
                                    </option>
                                </select>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="6"
                                    placeholder="Pesan" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send me-2"></i>Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Quick Contact Buttons -->
                    <div class="row mt-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="col-md-6 mb-3">
                            <a href="https://wa.me/6285240204028?text=Assalamualaikum, saya ingin bertanya tentang TPQ Khairunnisa"
                                target="_blank"
                                class="btn btn-success w-100 d-flex align-items-center justify-content-center">
                                <i class="bi bi-whatsapp me-2 fs-5"></i>
                                <div class="text-start">
                                    <small class="d-block">Hubungi via WhatsApp</small>
                                    <strong>085240204028</strong>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="tel:+6285240204028"
                                class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center">
                                <i class="bi bi-telephone me-2 fs-5"></i>
                                <div class="text-start">
                                    <small class="d-block">Telepon Sekarang</small>
                                    <strong>085240204028</strong>
                                </div>
                            </a>
                        </div>
                    </div>
                </div><!-- End Contact Form -->
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
                            <h3>Berapa biaya pendaftaran dan SPP bulanan?</h3>
                            <div class="faq-content">
                                <p>Untuk informasi lengkap mengenai biaya pendaftaran dan SPP bulanan, silakan hubungi kami
                                    langsung melalui telepon atau WhatsApp di nomor 085240204028 atau 082256219291.
                                    Kami juga menyediakan program beasiswa untuk santri berprestasi.</p>
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
                                <p>Persyaratan pendaftaran meliputi: Fotocopy Akta Kelahiran, Fotocopy Kartu Keluarga, Pas
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
                                    monitoring digital untuk memantau perkembangan setiap santri.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>

                        <div class="faq-item">
                            <h3>Apakah orang tua bisa memantau perkembangan santri?</h3>
                            <div class="faq-content">
                                <p>Ya, orang tua dapat memantau perkembangan santri melalui sistem digital kami. Kami juga
                                    rutin memberikan laporan perkembangan santri setiap bulannya dan mengadakan pertemuan
                                    dengan orang tua secara berkala.</p>
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
                                    diperlukan.</p>
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
        .info-item a {
            color: inherit;
            transition: color 0.3s ease;
        }

        .info-item a:hover {
            color: #2563eb;
        }

        .btn-success {
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            border: none;
            padding: 15px 20px;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #128C7E 0%, #075E54 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 211, 102, 0.4);
        }

        .btn-outline-primary {
            padding: 15px 20px;
            border: 2px solid #2563eb;
        }

        .btn-outline-primary:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.4);
        }
    </style>
@endpush
