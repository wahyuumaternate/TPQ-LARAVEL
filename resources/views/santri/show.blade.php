@extends('layouts.app')

@section('title', 'Detail Santri')

@section('content')
    <div class="container-fluid px-4 py-3">
        <!-- Header -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1 text-dark fw-bold">
                        <i class="bi bi-person-badge text-info"></i> Detail Santri
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('santri.index') }}">Santri</a></li>
                            <li class="breadcrumb-item active">Detail - {{ $santri->nama }}</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('santri.edit', $santri->id) }}" class="btn btn-warning me-2">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="{{ route('santri.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column - Profile Card -->
            <div class="col-md-4">
                <!-- Profile Picture Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body text-center">
                        <img src="{{ $santri->foto_url }}" class="rounded-circle mb-3 border" width="180" height="180"
                            style="object-fit: cover;">
                        <h4 class="mb-1 fw-bold">{{ $santri->nama }}</h4>
                        <p class="text-muted mb-2">{{ $santri->no_id }}</p>
                        <span class="badge {{ $santri->status_badge['class'] }} px-3 py-2">
                            <i
                                class="bi bi-{{ $santri->status == 'aktif' ? 'check-circle' : ($santri->status == 'lulus' ? 'trophy' : ($santri->status == 'pindah' ? 'arrow-right-circle' : 'x-circle')) }}"></i>
                            {{ $santri->status_badge['label'] }}
                        </span>
                    </div>
                </div>

                <!-- Quick Info Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0"><i class="bi bi-info-circle"></i> Info Cepat</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <small class="text-muted d-block">Jenis Kelamin</small>
                            <strong>
                                <i
                                    class="bi {{ $santri->jenis_kelamin == 'L' ? 'bi-gender-male text-primary' : 'bi-gender-female text-danger' }}"></i>
                                {{ $santri->jenis_kelamin_label }}
                            </strong>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Usia</small>
                            <strong>{{ $santri->calculated_usia ?? '-' }} tahun</strong>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Tanggal Lahir</small>
                            <strong>{{ $santri->tanggal_lahir ? $santri->tanggal_lahir->format('d F Y') : '-' }}</strong>
                        </div>
                        <div class="mb-0">
                            <small class="text-muted d-block">Tanggal Masuk</small>
                            <strong>{{ $santri->tanggal_masuk ? $santri->tanggal_masuk->format('d F Y') : '-' }}</strong>
                        </div>
                    </div>
                </div>

                <!-- Orang Tua Card -->
                @if ($santri->orangtua)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-info text-white">
                            <h6 class="mb-0"><i class="bi bi-people-fill"></i> Data Orang Tua</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <small class="text-muted d-block">No. ID Orang Tua</small>
                                <strong>{{ $santri->orangtua->no_id }}</strong>
                            </div>
                            <div class="mb-2">
                                <small class="text-muted d-block">Nama Ayah</small>
                                <strong>{{ $santri->orangtua->nama_ayah ?? '-' }}</strong>
                                <span
                                    class="badge {{ $santri->orangtua->status_ayah == 'Hidup' ? 'bg-success' : 'bg-secondary' }} ms-1">
                                    {{ $santri->orangtua->status_ayah }}
                                </span>
                            </div>
                            <div class="mb-2">
                                <small class="text-muted d-block">Nama Ibu</small>
                                <strong>{{ $santri->orangtua->nama_ibu ?? '-' }}</strong>
                                <span
                                    class="badge {{ $santri->orangtua->status_ibu == 'Hidup' ? 'bg-success' : 'bg-secondary' }} ms-1">
                                    {{ $santri->orangtua->status_ibu }}
                                </span>
                            </div>
                            <div class="mb-2">
                                <small class="text-muted d-block">Status Anak</small>
                                <span class="badge {{ $santri->orangtua->status_anak_badge_class }}">
                                    {{ $santri->orangtua->status_anak }}
                                </span>
                            </div>
                            <div class="mb-0">
                                <small class="text-muted d-block">No HP Orang Tua</small>
                                @if ($santri->orangtua->no_hp)
                                    <a href="{{ $santri->orangtua->whatsapp_link }}" target="_blank"
                                        class="text-decoration-none">
                                        <i class="bi bi-whatsapp text-success"></i> {{ $santri->orangtua->no_hp }}
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('orangtua.show', $santri->orangtua->id) }}"
                                    class="btn btn-sm btn-outline-info w-100">
                                    <i class="bi bi-eye"></i> Lihat Detail Orang Tua
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Contact Wali Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h6 class="mb-0"><i class="bi bi-telephone"></i> Kontak Wali</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <small class="text-muted d-block">Hubungan Wali</small>
                            <strong>{{ $santri->hubungan_wali ?? '-' }}</strong>
                        </div>
                        <div class="mb-0">
                            <small class="text-muted d-block">No. HP Wali</small>
                            @if ($santri->no_hp_wali)
                                <strong>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $santri->no_hp_wali) }}"
                                        target="_blank" class="text-decoration-none">
                                        <i class="bi bi-whatsapp text-success"></i> {{ $santri->no_hp_wali }}
                                    </a>
                                </strong>
                            @else
                                <strong>-</strong>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Details -->
            <div class="col-md-8">
                <!-- Academic Info -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0 fw-semibold">
                            <i class="bi bi-journal-bookmark text-primary"></i> Informasi Akademik
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">Kelas/Jilid</small>
                                @if ($santri->kelas)
                                    <span class="badge bg-primary fs-6 px-3 py-2">
                                        <i class="bi bi-book"></i> {{ $santri->kelas->nama_kelas }}
                                    </span>
                                @else
                                    <span class="text-muted">Belum ada kelas</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">Guru Pengajar</small>
                                @if ($santri->guru)
                                    <strong>
                                        <i class="bi bi-person-badge text-success"></i> {{ $santri->guru->nama }}
                                    </strong>
                                @else
                                    <span class="text-muted">Belum ada guru</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Personal Info -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0 fw-semibold">
                            <i class="bi bi-person text-info"></i> Informasi Pribadi
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td width="200" class="text-muted">No. ID Santri</td>
                                    <td class="fw-semibold">: {{ $santri->no_id }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Nama Lengkap</td>
                                    <td class="fw-semibold">: {{ $santri->nama }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Jenis Kelamin</td>
                                    <td>: {{ $santri->jenis_kelamin_label }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Tempat, Tanggal Lahir</td>
                                    <td>: {{ $santri->tempat_lahir ?? '-' }},
                                        {{ $santri->tanggal_lahir ? $santri->tanggal_lahir->format('d F Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Usia</td>
                                    <td>: {{ $santri->calculated_usia ?? '-' }} tahun</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Address Info -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0 fw-semibold">
                            <i class="bi bi-geo-alt text-danger"></i> Alamat
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td width="200" class="text-muted">Alamat Lengkap</td>
                                    <td>: {{ $santri->alamat ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Kelurahan/Desa</td>
                                    <td>: {{ $santri->kelurahan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Kecamatan</td>
                                    <td>: {{ $santri->kecamatan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Kota</td>
                                    <td>: {{ $santri->kota ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Additional Info -->
                @if ($santri->catatan)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white">
                            <h5 class="mb-0 fw-semibold">
                                <i class="bi bi-sticky text-warning"></i> Catatan
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">{{ $santri->catatan }}</p>
                        </div>
                    </div>
                @endif

                <!-- Progress Section -->
                @if ($santri->relationLoaded('progressSantris') && $santri->progressSantris->count() > 0)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white">
                            <h5 class="mb-0 fw-semibold">
                                <i class="bi bi-graph-up text-success"></i> Progress Terbaru
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Materi</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($santri->progressSantris->take(5) as $progress)
                                            <tr>
                                                <td>{{ $progress->tanggal->format('d/m/Y') }}</td>
                                                <td>{{ $progress->materi ?? '-' }}</td>
                                                <td><span class="badge bg-primary">{{ $progress->nilai ?? '-' }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Attendance Section -->
                @if ($santri->relationLoaded('absensis') && $santri->absensis->count() > 0)
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0 fw-semibold">
                                <i class="bi bi-calendar-check text-info"></i> Absensi Terbaru
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($santri->absensis->take(5) as $absen)
                                            <tr>
                                                <td>{{ $absen->tanggal->format('d/m/Y') }}</td>
                                                <td>
                                                    @php
                                                        $statusAbsen = [
                                                            'hadir' => 'bg-success',
                                                            'izin' => 'bg-warning',
                                                            'sakit' => 'bg-info',
                                                            'alpa' => 'bg-danger',
                                                        ];
                                                    @endphp
                                                    <span
                                                        class="badge {{ $statusAbsen[$absen->status] ?? 'bg-secondary' }}">
                                                        {{ ucfirst($absen->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $absen->keterangan ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">Data terakhir diperbarui:</small>
                                <strong class="d-block">{{ $santri->updated_at->format('d F Y, H:i') }} WIB</strong>
                            </div>
                            <div>
                                <a href="{{ route('santri.edit', $santri->id) }}" class="btn btn-warning me-2">
                                    <i class="bi bi-pencil"></i> Edit Data
                                </a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    <i class="bi bi-trash"></i> Hapus Data
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data santri:</p>
                    <div class="alert alert-warning">
                        <strong>{{ $santri->no_id }}</strong><br>
                        Nama: {{ $santri->nama }}<br>
                        Kelas: {{ $santri->kelas->nama_kelas ?? '-' }}
                    </div>
                    <p class="text-danger mb-0">
                        <small><i class="bi bi-info-circle me-1"></i>Data yang dihapus tidak dapat dikembalikan!</small>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('santri.destroy', $santri->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-1"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .table td {
            vertical-align: middle;
        }
    </style>
@endpush
