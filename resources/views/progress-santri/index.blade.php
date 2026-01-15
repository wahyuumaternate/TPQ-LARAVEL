@extends('layouts.app')

@section('title', 'Progress Santri')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Progress Santri</h1>
                <p class="text-muted small mb-0">Monitoring perkembangan pembelajaran santri</p>
            </div>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Progress
                </button>
            </div>
        </div>

        <!-- Alert Messages -->
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

        <!-- Filter & Search Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('progress-santri.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="santri_id" class="form-label">Santri</label>
                            <select class="form-select" id="santri_id" name="santri_id">
                                <option value="">Semua Santri</option>
                                @foreach ($santris as $santri)
                                    <option value="{{ $santri->id }}"
                                        {{ request('santri_id') == $santri->id ? 'selected' : '' }}>
                                        {{ $santri->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="jilid" class="form-label">Jilid</label>
                            <select class="form-select" id="jilid" name="jilid">
                                <option value="">Semua Jilid</option>
                                <option value="Iqra 1" {{ request('jilid') == 'Iqra 1' ? 'selected' : '' }}>Iqra 1</option>
                                <option value="Iqra 2" {{ request('jilid') == 'Iqra 2' ? 'selected' : '' }}>Iqra 2</option>
                                <option value="Iqra 3" {{ request('jilid') == 'Iqra 3' ? 'selected' : '' }}>Iqra 3</option>
                                <option value="Iqra 4" {{ request('jilid') == 'Iqra 4' ? 'selected' : '' }}>Iqra 4</option>
                                <option value="Iqra 5" {{ request('jilid') == 'Iqra 5' ? 'selected' : '' }}>Iqra 5</option>
                                <option value="Iqra 6" {{ request('jilid') == 'Iqra 6' ? 'selected' : '' }}>Iqra 6</option>
                                <option value="Al-Quran" {{ request('jilid') == 'Al-Quran' ? 'selected' : '' }}>Al-Quran
                                </option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="">Semua Status</option>
                                <option value="lancar" {{ request('status') == 'lancar' ? 'selected' : '' }}>Lancar
                                </option>
                                <option value="kurang_lancar" {{ request('status') == 'kurang_lancar' ? 'selected' : '' }}>
                                    Kurang Lancar</option>
                                <option value="mengulang" {{ request('status') == 'mengulang' ? 'selected' : '' }}>
                                    Mengulang</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="tanggal_dari" class="form-label">Dari Tanggal</label>
                            <input type="date" class="form-control" id="tanggal_dari" name="tanggal_dari"
                                value="{{ request('tanggal_dari') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="tanggal_sampai" class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-control" id="tanggal_sampai" name="tanggal_sampai"
                                value="{{ request('tanggal_sampai') }}">
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100 me-2">
                                <i class="bi bi-search"></i>
                            </button>
                            <a href="{{ route('progress-santri.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-clockwise"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Data Table Card -->
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Progress</h6>
                    </div>
                    <div class="col-auto">
                        <span class="badge bg-info">Total: {{ $progress->total() }} data</span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered align-middle" style="font-size: 0.875rem;">
                        <thead class="table-light">
                            <tr>
                                <th width="3%">No</th>
                                <th width="8%">Tanggal</th>
                                <th width="12%">Santri</th>
                                <th width="10%">Guru</th>
                                <th width="8%">Jilid</th>
                                <th width="6%">Hal</th>
                                <th width="10%">Surah</th>
                                <th width="5%">Ayat</th>
                                <th width="5%">Nilai</th>
                                <th width="8%">Status</th>
                                <th width="10%">Hafalan</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($progress as $index => $item)
                                <tr>
                                    <td>{{ $progress->firstItem() + $index }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                    <td><strong>{{ $item->santri->nama ?? '-' }}</strong></td>
                                    <td>{{ $item->guru->nama ?? '-' }}</td>
                                    <td><span class="badge bg-primary">{{ $item->jilid }}</span></td>
                                    <td>{{ $item->halaman ?? '-' }}</td>
                                    <td>{{ $item->surah ?? '-' }}</td>
                                    <td>{{ $item->ayat ?? '-' }}</td>
                                    <td>
                                        @if ($item->nilai)
                                            <span class="badge {{ $item->nilai_badge_class }}">{{ $item->nilai }}</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $item->status_badge_class }}">
                                            {{ $item->status_label }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($item->hafalan)
                                            <small class="text-success">
                                                <i class="bi bi-check-circle-fill"></i>
                                                {{ $item->hafalan_info }}
                                            </small>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#detailModal{{ $item->id }}" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $item->id }}" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $item->id }}" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Detail Modal - HARUS DI DALAM LOOP -->
                                <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info text-white">
                                                <h5 class="modal-title">
                                                    <i class="bi bi-info-circle me-2"></i>Detail Progress
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Santri</label>
                                                        <p>{{ $item->santri->nama ?? '-' }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Guru</label>
                                                        <p>{{ $item->guru->nama ?? '-' }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Tanggal</label>
                                                        <p>{{ $item->tanggal_formatted }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Jilid</label>
                                                        <p><span class="badge bg-primary">{{ $item->jilid }}</span></p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-bold">Halaman</label>
                                                        <p>{{ $item->halaman ?? '-' }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-bold">Surah</label>
                                                        <p>{{ $item->surah ?? '-' }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-bold">Ayat</label>
                                                        <p>{{ $item->ayat ?? '-' }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Nilai</label>
                                                        <p>
                                                            @if ($item->nilai)
                                                                <span
                                                                    class="badge {{ $item->nilai_badge_class }}">{{ $item->nilai }}</span>
                                                            @else
                                                                -
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Status</label>
                                                        <p><span
                                                                class="badge {{ $item->status_badge_class }}">{{ $item->status_label }}</span>
                                                        </p>
                                                    </div>
                                                    @if ($item->hafalan)
                                                        <div class="col-12">
                                                            <div class="alert alert-success">
                                                                <h6 class="alert-heading"><i
                                                                        class="bi bi-star-fill me-2"></i>Hafalan</h6>
                                                                <p class="mb-0">{{ $item->hafalan_info }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if ($item->catatan)
                                                        <div class="col-12">
                                                            <label class="form-label fw-bold">Catatan</label>
                                                            <div class="alert alert-light">{{ $item->catatan }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <!-- Edit Modal - HARUS DI DALAM LOOP -->
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning text-white">
                                                <h5 class="modal-title">
                                                    <i class="bi bi-pencil me-2"></i>Edit Progress Santri
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('progress-santri.update', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <label for="edit_santri_id{{ $item->id }}"
                                                                class="form-label">
                                                                Santri <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="form-select"
                                                                id="edit_santri_id{{ $item->id }}" name="santri_id"
                                                                required>
                                                                <option value="">Pilih Santri</option>
                                                                @foreach ($santris as $santri)
                                                                    <option value="{{ $santri->id }}"
                                                                        {{ $item->santri_id == $santri->id ? 'selected' : '' }}>
                                                                        {{ $santri->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="edit_guru_id{{ $item->id }}"
                                                                class="form-label">Guru</label>
                                                            <select class="form-select"
                                                                id="edit_guru_id{{ $item->id }}" name="guru_id">
                                                                <option value="">Pilih Guru</option>
                                                                @foreach ($gurus as $guru)
                                                                    <option value="{{ $guru->id }}"
                                                                        {{ $item->guru_id == $guru->id ? 'selected' : '' }}>
                                                                        {{ $guru->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="edit_tanggal{{ $item->id }}"
                                                                class="form-label">Tanggal <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="date" class="form-control"
                                                                id="edit_tanggal{{ $item->id }}" name="tanggal"
                                                                value="{{ $item->tanggal->format('Y-m-d') }}" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="edit_jilid{{ $item->id }}"
                                                                class="form-label">Jilid <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-select"
                                                                id="edit_jilid{{ $item->id }}" name="jilid"
                                                                required>
                                                                <option value="">Pilih Jilid</option>
                                                                <option value="Iqra 1"
                                                                    {{ $item->jilid == 'Iqra 1' ? 'selected' : '' }}>Iqra 1
                                                                </option>
                                                                <option value="Iqra 2"
                                                                    {{ $item->jilid == 'Iqra 2' ? 'selected' : '' }}>Iqra 2
                                                                </option>
                                                                <option value="Iqra 3"
                                                                    {{ $item->jilid == 'Iqra 3' ? 'selected' : '' }}>Iqra 3
                                                                </option>
                                                                <option value="Iqra 4"
                                                                    {{ $item->jilid == 'Iqra 4' ? 'selected' : '' }}>Iqra 4
                                                                </option>
                                                                <option value="Iqra 5"
                                                                    {{ $item->jilid == 'Iqra 5' ? 'selected' : '' }}>Iqra 5
                                                                </option>
                                                                <option value="Iqra 6"
                                                                    {{ $item->jilid == 'Iqra 6' ? 'selected' : '' }}>Iqra 6
                                                                </option>
                                                                <option value="Al-Quran"
                                                                    {{ $item->jilid == 'Al-Quran' ? 'selected' : '' }}>
                                                                    Al-Quran</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="edit_halaman{{ $item->id }}"
                                                                class="form-label">Halaman</label>
                                                            <input type="text" class="form-control"
                                                                id="edit_halaman{{ $item->id }}" name="halaman"
                                                                value="{{ $item->halaman }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="edit_surah{{ $item->id }}"
                                                                class="form-label">Surah</label>
                                                            <input type="text" class="form-control"
                                                                id="edit_surah{{ $item->id }}" name="surah"
                                                                value="{{ $item->surah }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="edit_ayat{{ $item->id }}"
                                                                class="form-label">Ayat</label>
                                                            <input type="text" class="form-control"
                                                                id="edit_ayat{{ $item->id }}" name="ayat"
                                                                value="{{ $item->ayat }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="edit_nilai{{ $item->id }}"
                                                                class="form-label">Nilai</label>
                                                            <select class="form-select"
                                                                id="edit_nilai{{ $item->id }}" name="nilai">
                                                                <option value="">Pilih Nilai</option>
                                                                <option value="A"
                                                                    {{ $item->nilai == 'A' ? 'selected' : '' }}>A - Sangat
                                                                    Baik</option>
                                                                <option value="B"
                                                                    {{ $item->nilai == 'B' ? 'selected' : '' }}>B - Baik
                                                                </option>
                                                                <option value="C"
                                                                    {{ $item->nilai == 'C' ? 'selected' : '' }}>C - Cukup
                                                                </option>
                                                                <option value="D"
                                                                    {{ $item->nilai == 'D' ? 'selected' : '' }}>D - Kurang
                                                                </option>
                                                                <option value="E"
                                                                    {{ $item->nilai == 'E' ? 'selected' : '' }}>E - Sangat
                                                                    Kurang</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="edit_status{{ $item->id }}"
                                                                class="form-label">Status <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-select"
                                                                id="edit_status{{ $item->id }}" name="status"
                                                                required>
                                                                <option value="">Pilih Status</option>
                                                                <option value="lancar"
                                                                    {{ $item->status == 'lancar' ? 'selected' : '' }}>
                                                                    Lancar</option>
                                                                <option value="kurang_lancar"
                                                                    {{ $item->status == 'kurang_lancar' ? 'selected' : '' }}>
                                                                    Kurang Lancar</option>
                                                                <option value="mengulang"
                                                                    {{ $item->status == 'mengulang' ? 'selected' : '' }}>
                                                                    Mengulang</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="edit_hafalan{{ $item->id }}" name="hafalan"
                                                                    value="1" {{ $item->hafalan ? 'checked' : '' }}
                                                                    onchange="document.getElementById('hafalanFieldsEdit{{ $item->id }}').style.display = this.checked ? 'block' : 'none'">
                                                                <label class="form-check-label"
                                                                    for="edit_hafalan{{ $item->id }}">
                                                                    <i class="bi bi-star-fill text-warning"></i> Ada
                                                                    Hafalan
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="hafalanFieldsEdit{{ $item->id }}"
                                                            style="display: {{ $item->hafalan ? 'block' : 'none' }};">
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <label for="edit_hafalan_surah{{ $item->id }}"
                                                                        class="form-label">Surah Hafalan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="edit_hafalan_surah{{ $item->id }}"
                                                                        name="hafalan_surah"
                                                                        value="{{ $item->hafalan_surah }}">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label
                                                                        for="edit_hafalan_ayat_dari{{ $item->id }}"
                                                                        class="form-label">Ayat Dari</label>
                                                                    <input type="number" class="form-control"
                                                                        id="edit_hafalan_ayat_dari{{ $item->id }}"
                                                                        name="hafalan_ayat_dari"
                                                                        value="{{ $item->hafalan_ayat_dari }}"
                                                                        min="1">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label
                                                                        for="edit_hafalan_ayat_sampai{{ $item->id }}"
                                                                        class="form-label">Ayat Sampai</label>
                                                                    <input type="number" class="form-control"
                                                                        id="edit_hafalan_ayat_sampai{{ $item->id }}"
                                                                        name="hafalan_ayat_sampai"
                                                                        value="{{ $item->hafalan_ayat_sampai }}"
                                                                        min="1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <label for="edit_catatan{{ $item->id }}"
                                                                class="form-label">Catatan</label>
                                                            <textarea class="form-control" id="edit_catatan{{ $item->id }}" name="catatan" rows="3">{{ $item->catatan }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-warning">
                                                        <i class="bi bi-save me-1"></i>Update
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- Delete Modal - HARUS DI DALAM LOOP -->
                                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">
                                                    <i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus progress:</p>
                                                <div class="alert alert-warning">
                                                    <strong>{{ $item->santri->nama ?? '-' }}</strong><br>
                                                    Tanggal: {{ $item->tanggal_formatted }}<br>
                                                    Jilid: {{ $item->jilid }}
                                                </div>
                                                <p class="text-danger mb-0">
                                                    <small><i class="bi bi-info-circle me-1"></i>Data yang dihapus tidak
                                                        dapat dikembalikan!</small>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('progress-santri.destroy', $item->id) }}"
                                                    method="POST" class="d-inline">
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

                            @empty
                                <tr>
                                    <td colspan="12" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox" style="font-size: 3rem; opacity: 0.3;"></i>
                                            <p class="mb-0 mt-2">Tidak ada data progress</p>
                                            @if (request()->hasAny(['santri_id', 'jilid', 'status', 'tanggal_dari', 'tanggal_sampai']))
                                                <small>Coba ubah filter pencarian Anda</small>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($progress->hasPages())
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            Menampilkan {{ $progress->firstItem() }} - {{ $progress->lastItem() }} dari
                            {{ $progress->total() }} data
                        </div>
                        <div>
                            {{ $progress->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Create Modal - DI LUAR LOOP -->
    @include('progress-santri.partials.create-modal')

    @push('scripts')
        <script>
            // Auto hide alerts
            setTimeout(function() {
                var alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);

            // Toggle hafalan fields for create modal
            document.getElementById('hafalan').addEventListener('change', function() {
                const hafalanFields = document.getElementById('hafalanFields');
                hafalanFields.style.display = this.checked ? 'block' : 'none';
            });

            // Re-open create modal if validation errors
            @if ($errors->any() && !request()->route('progressSantri'))
                var createModal = new bootstrap.Modal(document.getElementById('createModal'));
                createModal.show();
            @endif
        </script>
    @endpush
@endsection
