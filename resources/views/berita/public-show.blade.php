@extends('landing.layout')

@section('title', $berita->judul . ' - TPQ Khairunnisa Ternate')

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>{{ $berita->judul }}</h1>
                        <p class="mb-0">{{ $berita->excerpt }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- End Page Title -->

    <!-- Blog Details Section -->
    <section id="blog-details" class="blog-details section">
        <div class="container">
            <div class="row gy-4">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <article class="article" data-aos="fade-up">
                        <!-- Featured Image -->
                        @if ($berita->gambar)
                            <div class="post-img">
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                                    class="img-fluid">
                            </div>
                        @endif

                        <!-- Article Meta -->
                        <div class="meta-top">
                            <ul>
                                <li class="d-flex align-items-center">
                                    <i class="bi bi-person"></i>
                                    <a href="#">{{ $berita->creator->name ?? 'Admin' }}</a>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="bi bi-clock"></i>
                                    <time datetime="{{ $berita->published_at }}">{{ $berita->published_date }}</time>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="bi bi-eye"></i>
                                    <span>{{ $berita->views }} views</span>
                                </li>
                                @if ($berita->kategori)
                                    <li class="d-flex align-items-center">
                                        <i class="bi bi-folder"></i>
                                        <a
                                            href="{{ url('/news?kategori=' . $berita->kategori) }}">{{ $berita->kategori }}</a>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        <!-- Article Content -->
                        <div class="content">
                            @if ($berita->ringkasan)
                                <div class="alert alert-light border-start border-primary border-4 mb-4">
                                    <p class="mb-0"><strong>{{ $berita->ringkasan }}</strong></p>
                                </div>
                            @endif

                            <div class="article-text">
                                {!! $berita->isi !!}
                            </div>
                        </div>

                        <!-- Article Footer -->
                        <div class="meta-bottom">
                            <div class="row">
                                <div class="col-md-6">
                                    <i class="bi bi-clock-history"></i>
                                    <span>Waktu baca: {{ $berita->reading_time }}</span>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <i class="bi bi-share"></i> Bagikan:
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('news/' . $berita->slug) }}"
                                        target="_blank" class="ms-2">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ url('news/' . $berita->slug) }}&text={{ $berita->judul }}"
                                        target="_blank" class="ms-2">
                                        <i class="bi bi-twitter-x"></i>
                                    </a>
                                    <a href="https://wa.me/?text={{ $berita->judul }} {{ url('news/' . $berita->slug) }}"
                                        target="_blank" class="ms-2">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Related Posts -->
                    @if ($relatedNews->count() > 0)
                        <div class="related-posts" data-aos="fade-up">
                            <h3 class="related-title">Berita Terkait</h3>
                            <div class="row gy-4">
                                @foreach ($relatedNews as $related)
                                    <div class="col-md-4">
                                        <article class="related-post">
                                            <div class="post-img">
                                                @if ($related->gambar)
                                                    <img src="{{ asset('storage/' . $related->gambar) }}"
                                                        alt="{{ $related->judul }}" class="img-fluid">
                                                @else
                                                    <div class="bg-primary text-white d-flex align-items-center justify-content-center"
                                                        style="height: 150px;">
                                                        <i class="bi bi-image fs-1"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <h4>
                                                <a
                                                    href="{{ url('news/' . $related->slug) }}">{{ Str::limit($related->judul, 60) }}</a>
                                            </h4>
                                            <time
                                                datetime="{{ $related->published_at }}">{{ $related->published_date }}</time>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Recent Posts Widget -->
                    <div class="sidebar-item recent-posts" data-aos="fade-up">
                        <h3 class="sidebar-title">Berita Terbaru</h3>
                        @foreach ($latestNews as $latest)
                            <div class="post-item">
                                @if ($latest->gambar)
                                    <img src="{{ asset('storage/' . $latest->gambar) }}" alt="{{ $latest->judul }}"
                                        class="flex-shrink-0">
                                @else
                                    <div class="flex-shrink-0 bg-primary text-white d-flex align-items-center justify-content-center"
                                        style="width: 80px; height: 80px;">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                                <div>
                                    <h4>
                                        <a
                                            href="{{ url('news/' . $latest->slug) }}">{{ Str::limit($latest->judul, 50) }}</a>
                                    </h4>
                                    <time datetime="{{ $latest->published_at }}">{{ $latest->published_date }}</time>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Back to News -->
                    <div class="sidebar-item" data-aos="fade-up" data-aos-delay="100">
                        <a href="{{ url('/news') }}" class="btn btn-primary w-100">
                            <i class="bi bi-arrow-left me-2"></i>Kembali ke Berita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Blog Details Section -->
@endsection

@push('styles')
    <style>
        .article {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        }

        .article .post-img {
            margin-bottom: 30px;
            overflow: hidden;
            border-radius: 10px;
        }

        .article .post-img img {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
        }

        .meta-top {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
        }

        .meta-top ul {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .meta-top ul li i {
            margin-right: 5px;
            color: #2563eb;
        }

        .meta-top ul li a {
            color: #6b7280;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .meta-top ul li a:hover {
            color: #2563eb;
        }

        .content .article-text {
            font-size: 16px;
            line-height: 1.8;
            color: #374151;
        }

        .content .article-text p {
            margin-bottom: 1.5rem;
        }

        .meta-bottom {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
        }

        .meta-bottom a {
            color: #6b7280;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .meta-bottom a:hover {
            color: #2563eb;
        }

        .related-posts {
            margin-top: 50px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        }

        .related-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 30px;
            color: #1f2937;
        }

        .related-post {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .related-post:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .related-post .post-img {
            overflow: hidden;
        }

        .related-post .post-img img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .related-post:hover .post-img img {
            transform: scale(1.1);
        }

        .related-post h4 {
            font-size: 16px;
            padding: 15px;
            margin: 0;
        }

        .related-post h4 a {
            color: #1f2937;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .related-post h4 a:hover {
            color: #2563eb;
        }

        .related-post time {
            display: block;
            padding: 0 15px 15px;
            font-size: 13px;
            color: #6b7280;
        }

        .sidebar-item {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .sidebar-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #1f2937;
            position: relative;
            padding-bottom: 10px;
        }

        .sidebar-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: #2563eb;
        }

        .recent-posts .post-item {
            display: flex;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .recent-posts .post-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .recent-posts .post-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }

        .recent-posts .post-item h4 {
            font-size: 15px;
            margin-bottom: 5px;
        }

        .recent-posts .post-item h4 a {
            color: #1f2937;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .recent-posts .post-item h4 a:hover {
            color: #2563eb;
        }

        .recent-posts .post-item time {
            font-size: 13px;
            color: #6b7280;
        }

        @media (max-width: 768px) {
            .article {
                padding: 20px;
            }

            .meta-top ul {
                flex-direction: column;
                gap: 10px;
            }

            .meta-bottom .row>div {
                text-align: center !important;
                margin-bottom: 10px;
            }
        }
    </style>
@endpush
