@extends('landing.layout')

@section('title', 'Data Santri - TPQ Khairunnisa Ternate')

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Data Santri</h1>
                        <p class="mb-0">Informasi data santri, guru, dan kelas TPQ Khairunnisa</p>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- End Page Title -->

    <!-- Stats Section -->
    <section class="stats-section section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="bi bi-people color-blue flex-shrink-0"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $totalSantri }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Total Santri</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="bi bi-person-badge color-orange flex-shrink-0"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $totalGuru }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Total Guru</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="stats-item d-flex align-items-center w-100 h-100">
                        <i class="bi bi-door-open color-green flex-shrink-0"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $totalKelas }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Total Kelas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Stats Section -->

    <!-- Data Santri Table Section -->
    <section id="data-santri-table" class="section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Daftar Santri</h2>
            <p>Data lengkap santri aktif TPQ Khairunnisa</p>
        </div>

        <div class="container">
            <!-- Filter & Search -->
            <div class="card mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card-body">
                    <form method="GET" action="{{ route('landing.data-santri') }}">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Cari Santri</label>
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                    placeholder="Nama santri...">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Kelas</label>
                                <select class="form-select" name="kelas_id">
                                    <option value="">Semua Kelas</option>
                                    @foreach ($kelas as $k)
                                        <option value="{{ $k->id }}"
                                            {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="jenis_kelamin">
                                    <option value="">Semua</option>
                                    <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-search"></i> Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Table -->
            <div class="card shadow-sm" data-aos="fade-up" data-aos-delay="200">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="20%">Nama</th>
                                    <th width="15%">Kelas</th>
                                    <th width="8%">L/P</th>
                                    <th width="20%">Guru</th>
                                    <th width="32%">Orangtua</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($santris as $index => $santri)
                                    <tr>
                                        <td>{{ $santris->firstItem() + $index }}</td>
                                        <td>
                                            <strong>{{ $santri->nama }}</strong>
                                            @if ($santri->no_induk)
                                                <br><small class="text-muted">NIS: {{ $santri->no_induk }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($santri->kelas)
                                                <span class="badge bg-primary">{{ $santri->kelas->nama_kelas }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($santri->jenis_kelamin == 'L')
                                                <span class="badge bg-info">L</span>
                                            @else
                                                <span class="badge bg-danger">P</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($santri->kelas && $santri->kelas->guru)
                                                {{ $santri->kelas->guru->nama }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($santri->orangTua)
                                                <div>
                                                    @if ($santri->orangTua->nama_ayah)
                                                        <i class="bi bi-person-fill text-primary"></i>
                                                        <strong>{{ $santri->orangTua->nama_ayah }}</strong>
                                                    @endif
                                                    @if ($santri->orangTua->nama_ibu)
                                                        <br>
                                                        <i class="bi bi-person-fill text-danger"></i>
                                                        <strong>{{ $santri->orangTua->nama_ibu }}</strong>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <i class="bi bi-inbox fs-1 text-muted"></i>
                                            <p class="text-muted mb-0">Tidak ada data santri</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($santris->hasPages())
                        <div class="mt-3 d-flex justify-content-center">
                            {{ $santris->appends(request()->all())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section><!-- /Data Santri Table Section -->

    <!-- Data Kelas Section -->
    <section id="data-kelas" class="section light-background">
        <div class="container section-title" data-aos="fade-up">
            <h2>Daftar Kelas</h2>
            <p>Informasi kelas yang tersedia di TPQ Khairunnisa</p>
        </div>

        <div class="container">
            <div class="row gy-4">
                @forelse($kelas as $k)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title mb-0">{{ $k->nama_kelas }}</h5>
                                    <span class="badge bg-primary">{{ $k->kode_kelas }}</span>
                                </div>

                                @if ($k->deskripsi)
                                    <p class="card-text text-muted small">{{ $k->deskripsi }}</p>
                                @endif

                                <div class="mt-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-calendar3 me-2 text-primary"></i>
                                        <small>{{ $k->hari }}</small>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-clock me-2 text-primary"></i>
                                        <small>{{ $k->jam_mulai_formatted }} - {{ $k->jam_selesai_formatted }} WIT</small>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-people me-2 text-primary"></i>
                                        <small>{{ $k->santris_count ?? 0 }} Santri</small>
                                    </div>
                                    @if ($k->guru)
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-person-badge me-2 text-primary"></i>
                                            <small>{{ $k->guru->nama }}</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle me-2"></i>Belum ada data kelas
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section><!-- /Data Kelas Section -->

    <!-- CTA Section -->
    <section class="call-to-action section light-background">
        <div class="container">
            <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                <div class="col-xl-10">
                    <div class="text-center">
                        <h3>Bergabunglah dengan Kami</h3>
                        <p>Daftarkan putra-putri Anda sekarang dan berikan pendidikan Al-Quran terbaik untuk masa depan
                            mereka</p>
                        <a class="cta-btn" href="{{ route('landing.contact') }}">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /CTA Section -->
@endsection

@push('styles')
    <style>
        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table td {
            vertical-align: middle;
        }

        .badge {
            padding: 0.35em 0.65em;
            font-weight: 500;
        }

        @media print {

            .page-title,
            .breadcrumbs,
            .card.mb-4,
            .btn,
            .pagination {
                display: none !important;
            }

            .table {
                font-size: 0.85rem;
            }

            .card {
                box-shadow: none !important;
                border: 1px solid #dee2e6 !important;
            }
        }
    </style>
@endpush
