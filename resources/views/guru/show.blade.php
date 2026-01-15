@extends('layouts.app')

@section('title', 'Detail Guru')

@section('content')
    <div class="container-fluid px-4 py-3">
        <!-- Header -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1 text-dark fw-bold">
                        <i class="bi bi-person-badge text-info"></i> Detail Guru
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('guru.index') }}">Guru</a></li>
                            <li class="breadcrumb-item active">Detail - {{ $guru->nama }}</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('guru.edit', $guru->id) }}" class="btn btn-warning me-2">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="{{ route('guru.index') }}" class="btn btn-secondary">
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
                        <img src="{{ $guru->foto ? asset('storage/' . $guru->foto) : asset('images/default-avatar.png') }}"
                            class="rounded-circle mb-3" width="180" height="180" style="object-fit: cover;">
                        <h4 class="mb-1 fw-bold">{{ $guru->nama }}</h4>
                        <p class="text-muted mb-2">{{ $guru->no_id }}</p>
                        @if ($guru->is_active)
                            <span class="badge bg-success px-3 py-2">
                                <i class="bi bi-check-circle"></i> Aktif
                            </span>
                        @else
                            <span class="badge bg-danger px-3 py-2">
                                <i class="bi bi-x-circle"></i> Tidak Aktif
                            </span>
                        @endif
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
                                    class="bi {{ $guru->jenis_kelamin == 'L' ? 'bi-gender-male text-primary' : 'bi-gender-female text-danger' }}"></i>
                                {{ $guru->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </strong>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Usia</small>
                            <strong>{{ $guru->usia ?? '-' }} tahun</strong>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Tanggal Lahir</small>
                            <strong>{{ $guru->tanggal_lahir ? date('d F Y', strtotime($guru->tanggal_lahir)) : '-' }}</strong>
                        </div>
                        <div class="mb-0">
                            <small class="text-muted d-block">Pendidikan</small>
                            <strong>{{ $guru->pendidikan ?? '-' }}</strong>
                        </div>
                    </div>
                </div>

                <!-- Contact Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h6 class="mb-0"><i class="bi bi-telephone"></i> Kontak</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <small class="text-muted d-block">No. HP</small>
                            @if ($guru->no_hp)
                                <strong>
                                    <a href="tel:{{ $guru->no_hp }}" class="text-decoration-none">
                                        <i class="bi bi-telephone text-success"></i> {{ $guru->no_hp }}
                                    </a>
                                </strong>
                            @else
                                <strong>-</strong>
                            @endif
                        </div>
                        <div class="mb-0">
                            <small class="text-muted d-block">Email</small>
                            @if ($guru->email)
                                <strong>
                                    <a href="mailto:{{ $guru->email }}" class="text-decoration-none">
                                        <i class="bi bi-envelope text-primary"></i> {{ $guru->email }}
                                    </a>
                                </strong>
                            @else
                                <strong>-</strong>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Teaching Info -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <h6 class="mb-0"><i class="bi bi-book"></i> Mengajar</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-0">
                            <small class="text-muted d-block mb-2">Kelas yang Diajar</small>
                            @if ($guru->kelas)
                                <span class="badge bg-primary fs-6 px-3 py-2">
                                    <i class="bi bi-book"></i> {{ $guru->kelas->nama_kelas }}
                                </span>
                            @else
                                <span class="text-muted">Belum ada kelas</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Details -->
            <div class="col-md-8">
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
                                    <td width="200" class="text-muted">No. ID Guru</td>
                                    <td class="fw-semibold">: {{ $guru->no_id ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Nama Lengkap</td>
                                    <td class="fw-semibold">: {{ $guru->nama }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Jenis Kelamin</td>
                                    <td>: {{ $guru->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Tempat, Tanggal Lahir</td>
                                    <td>: {{ $guru->tempat_lahir ?? '-' }},
                                        {{ $guru->tanggal_lahir ? date('d-m-Y', strtotime($guru->tanggal_lahir)) : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Usia</td>
                                    <td>: {{ $guru->usia ?? '-' }} tahun</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Academic Info -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0 fw-semibold">
                            <i class="bi bi-mortarboard text-success"></i> Informasi Akademik
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td width="200" class="text-muted">Pendidikan Terakhir</td>
                                    <td class="fw-semibold">: {{ $guru->pendidikan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Jurusan</td>
                                    <td>: {{ $guru->jurusan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Kelas yang Diajar</td>
                                    <td>:
                                        @if ($guru->kelas)
                                            <span class="badge bg-primary">{{ $guru->kelas->nama_kelas }}</span>
                                        @else
                                            <span class="text-muted">Belum ada kelas</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Tanggal Bergabung</td>
                                    <td>:
                                        {{ $guru->tanggal_bergabung ? date('d F Y', strtotime($guru->tanggal_bergabung)) : '-' }}
                                    </td>
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
                                    <td>: {{ $guru->alamat ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Kelurahan/Desa</td>
                                    <td>: {{ $guru->kelurahan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Kecamatan</td>
                                    <td>: {{ $guru->kecamatan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Kota</td>
                                    <td>: {{ $guru->kota ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Account Info (if user exists) -->
                @if ($guru->user)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white">
                            <h5 class="mb-0 fw-semibold">
                                <i class="bi bi-shield-check text-primary"></i> Akun Pengguna
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td width="200" class="text-muted">Email Login</td>
                                        <td class="fw-semibold">: {{ $guru->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Role</td>
                                        <td>: <span
                                                class="badge bg-info">{{ ucfirst($guru->user->role ?? 'Guru') }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Akun Dibuat</td>
                                        <td>: {{ $guru->user->created_at->format('d F Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <!-- Statistics (if available) -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0 fw-semibold">
                            <i class="bi bi-graph-up text-success"></i> Statistik
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="border rounded p-3 mb-3 mb-md-0">
                                    <h3 class="text-primary mb-1">
                                        {{ $guru->kelas ? $guru->kelas->santris_count ?? 0 : 0 }}
                                    </h3>
                                    <small class="text-muted">Jumlah Santri</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="border rounded p-3 mb-3 mb-md-0">
                                    <h3 class="text-success mb-1">
                                        {{ $guru->kelas ? 1 : 0 }}
                                    </h3>
                                    <small class="text-muted">Kelas Diajar</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="border rounded p-3">
                                    <h3 class="text-info mb-1">

                                        {{ date('d/m/Y', strtotime($guru->tanggal_bergabung)) }}
                                    </h3>



                                    <small class="text-muted">Tahun Mengajar</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                <strong class="d-block">{{ $guru->updated_at->format('d F Y, H:i') }} WIT</strong>
                            </div>
                            <div>
                                <a href="{{ route('guru.edit', $guru->id) }}" class="btn btn-warning me-2">
                                    <i class="bi bi-pencil"></i> Edit Data
                                </a>
                                <form action="{{ route('guru.destroy', $guru->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $guru->nama }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash"></i> Hapus Data
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
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
