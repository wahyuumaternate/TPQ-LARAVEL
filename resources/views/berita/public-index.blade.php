@extends('landing.layout')

@section('title', 'Berita & Kegiatan - TPQ Khairunnisa Ternate')

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Berita & Kegiatan</h1>
                        <p class="mb-0">Informasi terkini dan kegiatan TPQ Khairunnisa Ternate</p>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- End Page Title -->

    <!-- Blog Section -->
    <section id="blog" class="blog section">
        <div class="container">
            <div class="row gy-4">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Filter & Search -->
                    <div class="card mb-4" data-aos="fade-up">
                        <div class="card-body">
                            <form method="GET" action="{{ url('/news') }}">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="search"
                                            value="{{ request('search') }}" placeholder="Cari berita...">
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-select" name="kategori">
                                            <option value="">Semua Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category }}"
                                                    {{ request('kategori') == $category ? 'selected' : '' }}>
                                                    {{ $category }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Blog Posts -->
                    @forelse($beritas as $berita)
                        <article class="blog-post" data-aos="fade-up" data-aos-delay="100">
                            <div class="post-img">
                                @if ($berita->gambar)
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                                        class="img-fluid">
                                @else
                                    <div class="bg-gradient d-flex align-items-center justify-content-center"
                                        style="height: 300px; background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);">
                                        <i class="bi bi-newspaper text-white" style="font-size: 5rem;"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="post-content">
                                <div class="post-meta">
                                    @if ($berita->kategori)
                                        <span class="post-category">{{ $berita->kategori }}</span>
                                    @endif
                                    <span class="post-date">
                                        <i class="bi bi-calendar3"></i> {{ $berita->published_date }}
                                    </span>
                                    <span class="post-author">
                                        <i class="bi bi-person"></i> {{ $berita->creator->name ?? 'Admin' }}
                                    </span>
                                    <span class="post-views">
                                        <i class="bi bi-eye"></i> {{ $berita->views }} views
                                    </span>
                                </div>

                                <h2 class="post-title">
                                    <a href="{{ url('news/' . $berita->slug) }}">{{ $berita->judul }}</a>
                                </h2>

                                <p class="post-excerpt">
                                    {{ $berita->excerpt }}
                                </p>

                                <div class="read-more">
                                    <a href="{{ url('news/' . $berita->slug) }}" class="btn btn-outline-primary">
                                        Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="alert alert-info text-center" data-aos="fade-up">
                            <i class="bi bi-info-circle me-2"></i>
                            Tidak ada berita yang ditemukan
                            @if (request()->hasAny(['search', 'kategori']))
                                <br><small>Coba ubah filter pencarian Anda</small>
                            @endif
                        </div>
                    @endforelse

                    <!-- Pagination -->
                    @if ($beritas->hasPages())
                        <div class="blog-pagination" data-aos="fade-up">
                            {{ $beritas->appends(request()->all())->links() }}
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Search Widget -->
                    <div class="sidebar-item search-form" data-aos="fade-up">
                        <h3 class="sidebar-title">Pencarian</h3>
                        <form action="{{ url('/news') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                    placeholder="Cari berita...">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Categories Widget -->
                    <div class="sidebar-item categories" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="sidebar-title">Kategori</h3>
                        <ul class="list-unstyled">
                            <li>
                                <a href="{{ url('/news') }}" class="{{ !request('kategori') ? 'active' : '' }}">
                                    Semua Kategori <span>({{ $beritas->total() }})</span>
                                </a>
                            </li>
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ url('/news?kategori=' . $category) }}"
                                        class="{{ request('kategori') == $category ? 'active' : '' }}">
                                        {{ $category }}
                                        <span>({{ \App\Models\Berita::published()->where('kategori', $category)->count() }})</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Recent Posts Widget -->
                    <div class="sidebar-item recent-posts" data-aos="fade-up" data-aos-delay="200">
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

                    <!-- Popular Posts Widget -->
                    <div class="sidebar-item recent-posts" data-aos="fade-up" data-aos-delay="300">
                        <h3 class="sidebar-title">Berita Populer</h3>
                        @foreach ($popularNews as $popular)
                            <div class="post-item">
                                @if ($popular->gambar)
                                    <img src="{{ asset('storage/' . $popular->gambar) }}" alt="{{ $popular->judul }}"
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
                                            href="{{ url('news/' . $popular->slug) }}">{{ Str::limit($popular->judul, 50) }}</a>
                                    </h4>
                                    <div class="d-flex align-items-center text-muted small">
                                        <i class="bi bi-eye me-1"></i> {{ $popular->views }} views
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Tags Widget -->
                    @if ($categories->count() > 0)
                        <div class="sidebar-item tags" data-aos="fade-up" data-aos-delay="400">
                            <h3 class="sidebar-title">Tags</h3>
                            <ul class="list-inline">
                                @foreach ($categories as $category)
                                    <li class="list-inline-item">
                                        <a href="{{ url('/news?kategori=' . $category) }}">{{ $category }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section><!-- /Blog Section -->
@endsection

@push('styles')
    <style>
        .blog-post {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        .blog-post:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
        }

        .blog-post .post-img img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .blog-post .post-content {
            padding: 30px;
        }

        .post-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .post-meta span {
            color: #6c757d;
        }

        .post-category {
            background: #2563eb;
            color: white !important;
            padding: 4px 12px;
            border-radius: 15px;
            font-weight: 500;
        }

        .post-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .post-title a {
            color: #1f2937;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .post-title a:hover {
            color: #2563eb;
        }

        .post-excerpt {
            color: #6b7280;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        /* Sidebar */
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

        .categories ul li {
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .categories ul li:last-child {
            border-bottom: none;
        }

        .categories ul li a {
            color: #1f2937;
            text-decoration: none;
            display: flex;
            justify-content: space-between;
            transition: all 0.3s ease;
        }

        .categories ul li a:hover,
        .categories ul li a.active {
            color: #2563eb;
            padding-left: 10px;
        }

        .categories ul li a span {
            color: #6b7280;
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

        .tags ul li {
            margin-bottom: 10px;
        }

        .tags ul li a {
            display: inline-block;
            padding: 8px 15px;
            background: #f3f4f6;
            color: #1f2937;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .tags ul li a:hover {
            background: #2563eb;
            color: white;
        }

        @media (max-width: 991px) {
            .blog-post .post-title {
                font-size: 20px;
            }
        }
    </style>
@endpush
