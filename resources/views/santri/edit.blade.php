@extends('layouts.app')

@section('title', 'Edit Santri')

@section('content')
    <div class="container-fluid px-4 py-3">
        <!-- Header -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1 text-dark fw-bold">
                        <i class="bi bi-pencil-square text-warning"></i> Edit Santri
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('santri.index') }}">Santri</a></li>
                            <li class="breadcrumb-item active">Edit - {{ $santri->nama }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="btn-group">
                    <a href="{{ route('santri.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('santri.show', $santri->id) }}" class="btn btn-info">
                        <i class="bi bi-eye"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle"></i> <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Info Card -->
        <div class="alert alert-info mb-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>No. ID:</strong> {{ $santri->no_id }}
                </div>
                <div class="col-md-6 text-md-end">
                    <span
                        class="badge {{ $santri->status_badge['class'] }} me-1">{{ $santri->status_badge['label'] }}</span>
                    <span class="badge bg-{{ $santri->jenis_kelamin == 'L' ? 'primary' : 'danger' }}">
                        {{ $santri->jenis_kelamin_label }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('santri.update', $santri->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Informasi Pribadi -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-person-badge"></i> Informasi Pribadi</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. ID Santri</label>
                            <input type="text" class="form-control bg-light" value="{{ $santri->no_id }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                value="{{ old('nama', $santri->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin"
                                required>
                                <option value="L"
                                    {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="P"
                                    {{ old('jenis_kelamin', $santri->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Tempat Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                name="tempat_lahir" value="{{ old('tempat_lahir', $santri->tempat_lahir) }}">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                name="tanggal_lahir"
                                value="{{ old('tanggal_lahir', $santri->tanggal_lahir?->format('Y-m-d')) }}">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Orang Tua -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-people-fill"></i> Data Orang Tua</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Pilih Orang Tua <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select class="form-select @error('orangtua_id') is-invalid @enderror" id="orangtua_id"
                                    name="orangtua_id" required>
                                    <option value="">-- Pilih Orang Tua --</option>
                                    @foreach ($orangtuaList as $orangtua)
                                        <option value="{{ $orangtua->id }}" data-ayah="{{ $orangtua->nama_ayah }}"
                                            data-ibu="{{ $orangtua->nama_ibu }}" data-hp="{{ $orangtua->no_hp }}"
                                            data-alamat="{{ $orangtua->alamat }}"
                                            data-kelurahan-id="{{ $orangtua->kelurahan_id }}"
                                            data-kecamatan-id="{{ $orangtua->kelurahan?->kecamatan_id }}"
                                            data-kelurahan="{{ $orangtua->kelurahan?->nama }}"
                                            data-kecamatan="{{ $orangtua->kelurahan?->kecamatan?->nama }}"
                                            data-kota="Kota Ternate" data-status-ayah="{{ $orangtua->status_ayah }}"
                                            data-status-ibu="{{ $orangtua->status_ibu }}"
                                            data-status-anak="{{ $orangtua->status_anak }}"
                                            {{ old('orangtua_id', $santri->orangtua_id) == $orangtua->id ? 'selected' : '' }}>
                                            {{ $orangtua->no_id }} - {{ $orangtua->nama_lengkap }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#tambahOrangtuaModal">
                                    <i class="bi bi-plus-circle"></i> Tambah Baru
                                </button>
                            </div>
                            @error('orangtua_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                <i class="bi bi-info-circle"></i> Pilih orang tua dari database atau tambah baru jika belum
                                terdaftar.
                            </small>
                        </div>

                        <div class="col-12">
                            <div class="alert alert-light border" id="orangtua-info" style="display: none;">
                                <h6 class="mb-2"><i class="bi bi-info-circle text-primary"></i> Informasi Orang Tua</h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        <small class="text-muted">Nama Ayah:</small>
                                        <p class="mb-1 fw-semibold" id="info-ayah">-</p>
                                        <span class="badge" id="badge-ayah"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <small class="text-muted">Nama Ibu:</small>
                                        <p class="mb-1 fw-semibold" id="info-ibu">-</p>
                                        <span class="badge" id="badge-ibu"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <small class="text-muted">Status Anak:</small>
                                        <p class="mb-1"><span class="badge" id="badge-anak">-</span></p>
                                    </div>
                                    <div class="col-md-3">
                                        <small class="text-muted">No HP:</small>
                                        <p class="mb-1" id="info-hp">-</p>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <small class="text-muted">Alamat:</small>
                                        <p class="mb-0" id="info-alamat">-</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Hubungan Wali</label>
                            <select class="form-select @error('hubungan_wali') is-invalid @enderror" id="hubungan_wali"
                                name="hubungan_wali">
                                <option value="">-- Pilih --</option>
                                <option value="Ayah"
                                    {{ old('hubungan_wali', $santri->hubungan_wali) == 'Ayah' ? 'selected' : '' }}>Ayah
                                </option>
                                <option value="Ibu"
                                    {{ old('hubungan_wali', $santri->hubungan_wali) == 'Ibu' ? 'selected' : '' }}>Ibu
                                </option>
                                <option value="Kakek"
                                    {{ old('hubungan_wali', $santri->hubungan_wali) == 'Kakek' ? 'selected' : '' }}>Kakek
                                </option>
                                <option value="Nenek"
                                    {{ old('hubungan_wali', $santri->hubungan_wali) == 'Nenek' ? 'selected' : '' }}>Nenek
                                </option>
                                <option value="Paman"
                                    {{ old('hubungan_wali', $santri->hubungan_wali) == 'Paman' ? 'selected' : '' }}>Paman
                                </option>
                                <option value="Bibi"
                                    {{ old('hubungan_wali', $santri->hubungan_wali) == 'Bibi' ? 'selected' : '' }}>Bibi
                                </option>
                                <option value="Kakak"
                                    {{ old('hubungan_wali', $santri->hubungan_wali) == 'Kakak' ? 'selected' : '' }}>Kakak
                                </option>
                                <option value="Lainnya"
                                    {{ old('hubungan_wali', $santri->hubungan_wali) == 'Lainnya' ? 'selected' : '' }}>
                                    Lainnya</option>
                            </select>
                            @error('hubungan_wali')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No HP Wali</label>
                            <input type="text" class="form-control @error('no_hp_wali') is-invalid @enderror"
                                id="no_hp_wali" name="no_hp_wali" value="{{ old('no_hp_wali', $santri->no_hp_wali) }}"
                                placeholder="08xxxxxxxxxx">
                            @error('no_hp_wali')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alamat -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-geo-alt"></i> Alamat Tempat Tinggal</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Alamat Lengkap</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="2">{{ old('alamat', $santri->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Kelurahan</label>
                            <input type="text" class="form-control @error('kelurahan') is-invalid @enderror"
                                id="kelurahan" name="kelurahan" value="{{ old('kelurahan', $santri->kelurahan) }}">
                            @error('kelurahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Kecamatan</label>
                            <input type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                                id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $santri->kecamatan) }}">
                            @error('kecamatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Kota/Kabupaten</label>
                            <input type="text" class="form-control @error('kota') is-invalid @enderror"
                                id="kota" name="kota" value="{{ old('kota', $santri->kota) }}">
                            @error('kota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Akademik -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-mortarboard"></i> Informasi Akademik</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kelas</label>
                            <select class="form-select @error('kelas_id') is-invalid @enderror" name="kelas_id">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelasList as $kelas)
                                    <option value="{{ $kelas->id }}"
                                        {{ old('kelas_id', $santri->kelas_id) == $kelas->id ? 'selected' : '' }}>
                                        {{ $kelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Guru Pengajar</label>
                            <select class="form-select @error('guru_id') is-invalid @enderror" name="guru_id">
                                <option value="">-- Pilih Guru --</option>
                                @foreach ($guruList as $guru)
                                    <option value="{{ $guru->id }}"
                                        {{ old('guru_id', $santri->guru_id) == $guru->id ? 'selected' : '' }}>
                                        {{ $guru->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('guru_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal Masuk</label>
                            <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror"
                                name="tanggal_masuk"
                                value="{{ old('tanggal_masuk', $santri->tanggal_masuk?->format('Y-m-d')) }}">
                            @error('tanggal_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                                <option value="aktif" {{ old('status', $santri->status) == 'aktif' ? 'selected' : '' }}>
                                    Aktif</option>
                                <option value="lulus" {{ old('status', $santri->status) == 'lulus' ? 'selected' : '' }}>
                                    Lulus</option>
                                <option value="pindah" {{ old('status', $santri->status) == 'pindah' ? 'selected' : '' }}>
                                    Pindah</option>
                                <option value="keluar" {{ old('status', $santri->status) == 'keluar' ? 'selected' : '' }}>
                                    Keluar</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Foto & Catatan -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="bi bi-card-image"></i> Foto & Catatan</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Foto Santri</label>
                            @if ($santri->foto)
                                <div class="mb-2">
                                    <small class="text-muted">Foto saat ini:</small><br>
                                    <img src="{{ $santri->foto_url }}" class="img-thumbnail mt-1"
                                        style="max-width: 200px;">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                name="foto" id="foto" accept="image/*">
                            <small class="text-muted">Max 2MB (JPG, PNG, JPEG). Kosongkan jika tidak ingin mengubah
                                foto.</small>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Preview Foto Baru</label>
                            <div class="border rounded p-3 text-center bg-light" style="height: 200px;"
                                id="preview-container">
                                <img src="{{ asset('images/default-avatar.png') }}" id="preview"
                                    class="img-fluid h-100" style="object-fit: contain; display: none;">
                                <p class="text-muted mt-5" id="preview-text">Pilih foto untuk melihat preview</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Catatan</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror" name="catatan" rows="3"
                                placeholder="Catatan tambahan tentang santri">{{ old('catatan', $santri->catatan) }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('santri.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-lg"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-save"></i> Update Data Santri
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal Tambah Orang Tua -->
    <div class="modal fade" id="tambahOrangtuaModal" tabindex="-1" aria-labelledby="tambahOrangtuaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="tambahOrangtuaModalLabel">
                        <i class="bi bi-plus-circle"></i> Tambah Data Orang Tua Baru
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="formTambahOrangtua">
                    @csrf
                    <div class="modal-body">
                        <!-- Alert untuk error/success -->
                        <div id="modalAlert" class="alert d-none" role="alert"></div>

                        <div class="row g-3">
                            <!-- Data Ayah -->
                            <div class="col-12">
                                <h6 class="border-bottom pb-2"><i class="bi bi-person"></i> Data Ayah</h6>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Ayah</label>
                                <input type="text" class="form-control" id="modal_nama_ayah" name="nama_ayah">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Pekerjaan Ayah</label>
                                <input type="text" class="form-control" id="modal_pekerjaan_ayah"
                                    name="pekerjaan_ayah">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Status Ayah <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" id="modal_status_ayah" name="status_ayah" required>
                                    <option value="Hidup" selected>Hidup</option>
                                    <option value="Wafat">Wafat</option>
                                </select>
                            </div>

                            <!-- Data Ibu -->
                            <div class="col-12 mt-3">
                                <h6 class="border-bottom pb-2"><i class="bi bi-person"></i> Data Ibu</h6>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Ibu</label>
                                <input type="text" class="form-control" id="modal_nama_ibu" name="nama_ibu">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Pekerjaan Ibu</label>
                                <input type="text" class="form-control" id="modal_pekerjaan_ibu"
                                    name="pekerjaan_ibu">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Status Ibu <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" id="modal_status_ibu" name="status_ibu" required>
                                    <option value="Hidup" selected>Hidup</option>
                                    <option value="Wafat">Wafat</option>
                                </select>
                            </div>

                            <!-- Status Anak -->
                            <div class="col-12 mt-3">
                                <h6 class="border-bottom pb-2"><i class="bi bi-shield-check"></i> Status</h6>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Status Anak <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" id="modal_status_anak" name="status_anak" required>
                                    <option value="Dalam Asuhan OT" selected>Dalam Asuhan Orang Tua</option>
                                    <option value="Anak Yatim">Anak Yatim (Ayah Wafat)</option>
                                    <option value="Anak Piatu">Anak Piatu (Ibu Wafat)</option>
                                    <option value="Anak Yatim Piatu">Anak Yatim Piatu (Ayah & Ibu Wafat)</option>
                                </select>
                            </div>

                            <!-- Kontak -->
                            <div class="col-12 mt-3">
                                <h6 class="border-bottom pb-2"><i class="bi bi-telephone"></i> Kontak</h6>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">No. HP/WA</label>
                                <input type="text" class="form-control" id="modal_no_hp" name="no_hp"
                                    placeholder="08xxxxxxxxxx">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">No. HP Alternatif</label>
                                <input type="text" class="form-control" id="modal_no_hp_alternatif"
                                    name="no_hp_alternatif">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" id="modal_email" name="email">
                            </div>

                            <!-- Alamat -->
                            <div class="col-12 mt-3">
                                <h6 class="border-bottom pb-2"><i class="bi bi-geo-alt"></i> Alamat</h6>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Alamat Lengkap</label>
                                <textarea class="form-control" id="modal_alamat" name="alamat" rows="2"
                                    placeholder="Jl. Sultan Babullah No. 123"></textarea>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-semibold">Kecamatan</label>
                                <select class="form-select" id="modal_kecamatan_id" name="modal_kecamatan_id">
                                    <option value="">-- Pilih Kecamatan --</option>
                                    @foreach ($kecamatanList as $kecamatan)
                                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-semibold">Kelurahan</label>
                                <select class="form-select" id="modal_kelurahan_id" name="kelurahan_id" disabled>
                                    <option value="">-- Pilih Kecamatan Dahulu --</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold">Kode Pos</label>
                                <input type="text" class="form-control" id="modal_kode_pos" name="kode_pos"
                                    maxlength="10">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-success" id="btnSimpanOrangtua">
                            <i class="bi bi-save"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            console.log('Initializing edit form scripts...');

            // Auto-fill data when orangtua selected
            $('#orangtua_id').on('change', function() {
                const selectedOption = $(this).find('option:selected');

                if (selectedOption.val()) {
                    $('#orangtua-info').show();

                    const namaAyah = selectedOption.data('ayah') || '-';
                    const namaIbu = selectedOption.data('ibu') || '-';
                    const statusAyah = selectedOption.data('status-ayah');
                    const statusIbu = selectedOption.data('status-ibu');
                    const statusAnak = selectedOption.data('status-anak');

                    $('#info-ayah').text(namaAyah);
                    $('#info-ibu').text(namaIbu);
                    $('#info-hp').text(selectedOption.data('hp') || '-');
                    $('#info-alamat').text(selectedOption.data('alamat') || '-');

                    $('#badge-ayah').removeClass().addClass('badge').addClass(statusAyah === 'Hidup' ?
                        'bg-success' : 'bg-secondary').text(statusAyah);
                    $('#badge-ibu').removeClass().addClass('badge').addClass(statusIbu === 'Hidup' ?
                        'bg-success' : 'bg-secondary').text(statusIbu);

                    let badgeClass = 'bg-info';
                    switch (statusAnak) {
                        case 'Dalam Asuhan OT':
                            badgeClass = 'bg-primary';
                            break;
                        case 'Anak Yatim':
                            badgeClass = 'bg-warning';
                            break;
                        case 'Anak Piatu':
                            badgeClass = 'bg-info';
                            break;
                        case 'Anak Yatim Piatu':
                            badgeClass = 'bg-danger';
                            break;
                    }
                    $('#badge-anak').removeClass().addClass('badge').addClass(badgeClass).text(statusAnak);

                    $('#alamat').val(selectedOption.data('alamat') || '');
                    $('#kelurahan').val(selectedOption.data('kelurahan') || '');
                    $('#kecamatan').val(selectedOption.data('kecamatan') || '');
                    $('#kota').val(selectedOption.data('kota') || '');

                    if (!$('#no_hp_wali').val()) {
                        $('#no_hp_wali').val(selectedOption.data('hp') || '');
                    }
                    if (!$('#hubungan_wali').val()) {
                        if (statusAyah === 'Hidup') {
                            $('#hubungan_wali').val('Ayah');
                        } else if (statusIbu === 'Hidup') {
                            $('#hubungan_wali').val('Ibu');
                        }
                    }
                } else {
                    $('#orangtua-info').hide();
                }
            });

            if ($('#orangtua_id').val()) {
                $('#orangtua_id').trigger('change');
            }

            // Photo preview
            $('#foto').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    if (file.size > 2048000) {
                        alert('Ukuran file terlalu besar. Maksimal 2MB');
                        e.target.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(event) {
                        $('#preview').attr('src', event.target.result).show();
                        $('#preview-text').hide();
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#preview').hide();
                    $('#preview-text').show();
                }
            });

            // ============================================
            // MODAL TAMBAH ORANG TUA
            // ============================================

            // Cascading dropdown di modal
            $('#modal_kecamatan_id').on('change', function() {
                const kecamatanId = $(this).val();
                const $kelurahan = $('#modal_kelurahan_id');

                if (kecamatanId) {
                    $kelurahan.prop('disabled', true).html('<option value="">Loading...</option>');

                    $.ajax({
                        url: '/api/santri/kelurahan/' + kecamatanId,
                        type: 'GET',
                        success: function(data) {
                            $kelurahan.html('<option value="">-- Pilih Kelurahan --</option>');
                            $.each(data, function(index, kelurahan) {
                                $kelurahan.append(
                                    $('<option></option>')
                                    .attr('value', kelurahan.id)
                                    .text(kelurahan.nama)
                                );
                            });
                            $kelurahan.prop('disabled', false);
                        },
                        error: function() {
                            $kelurahan.html('<option value="">Error loading data</option>');
                            $kelurahan.prop('disabled', false);
                        }
                    });
                } else {
                    $kelurahan.html('<option value="">-- Pilih Kecamatan Dahulu --</option>');
                    $kelurahan.prop('disabled', true);
                }
            });

            // Auto update status anak
            function updateStatusAnak() {
                const statusAyah = $('#modal_status_ayah').val();
                const statusIbu = $('#modal_status_ibu').val();
                const $statusAnak = $('#modal_status_anak');

                if (statusAyah === 'Wafat' && statusIbu === 'Wafat') {
                    $statusAnak.val('Anak Yatim Piatu');
                } else if (statusAyah === 'Wafat') {
                    $statusAnak.val('Anak Yatim');
                } else if (statusIbu === 'Wafat') {
                    $statusAnak.val('Anak Piatu');
                } else {
                    $statusAnak.val('Dalam Asuhan OT');
                }
            }

            $('#modal_status_ayah, #modal_status_ibu').on('change', updateStatusAnak);

            // Submit form
            $('#formTambahOrangtua').on('submit', function(e) {
                e.preventDefault();

                const $form = $(this);
                const $btnSubmit = $('#btnSimpanOrangtua');
                const $alert = $('#modalAlert');

                $btnSubmit.prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...'
                );

                $form.find('.is-invalid').removeClass('is-invalid');
                $form.find('.invalid-feedback').text('');
                $alert.addClass('d-none');

                const formData = new FormData(this);

                $.ajax({
                    url: '{{ route('orangtua.store') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $alert.removeClass('d-none alert-danger')
                                .addClass('alert-success')
                                .html('<i class="bi bi-check-circle"></i> ' + response.message);

                            const kecamatanName = $('#modal_kecamatan_id option:selected')
                            .text();
                            const kelurahanName = $('#modal_kelurahan_id option:selected')
                            .text();

                            const newOption = new Option(
                                response.data.no_id + ' - ' + response.data.nama_lengkap,
                                response.data.id,
                                true,
                                true
                            );

                            $(newOption).attr({
                                'data-ayah': response.data.nama_ayah || '',
                                'data-ibu': response.data.nama_ibu || '',
                                'data-hp': response.data.no_hp || '',
                                'data-alamat': response.data.alamat || '',
                                'data-kelurahan-id': response.data.kelurahan_id || '',
                                'data-kecamatan-id': response.data.kecamatan_id || '',
                                'data-kelurahan': kelurahanName !==
                                    '-- Pilih Kelurahan --' ? kelurahanName : '',
                                'data-kecamatan': kecamatanName !==
                                    '-- Pilih Kecamatan --' ? kecamatanName : '',
                                'data-kota': 'Kota Ternate',
                                'data-status-ayah': response.data.status_ayah,
                                'data-status-ibu': response.data.status_ibu,
                                'data-status-anak': response.data.status_anak
                            });

                            $('#orangtua_id').append(newOption).val(response.data.id).trigger(
                                'change');

                            $form[0].reset();

                            setTimeout(function() {
                                $('#tambahOrangtuaModal').modal('hide');
                                $alert.addClass('d-none');
                            }, 1500);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            let errorMessage =
                                '<strong>Terjadi kesalahan:</strong><ul class="mb-0 mt-2">';

                            $.each(errors, function(field, messages) {
                                const $field = $form.find('[name="' + field + '"]');
                                $field.addClass('is-invalid');
                                $field.next('.invalid-feedback').text(messages[0]);
                                errorMessage += '<li>' + messages[0] + '</li>';
                            });

                            errorMessage += '</ul>';

                            $alert.removeClass('d-none alert-success')
                                .addClass('alert-danger')
                                .html('<i class="bi bi-exclamation-circle"></i> ' +
                                    errorMessage);
                        } else {
                            $alert.removeClass('d-none alert-success')
                                .addClass('alert-danger')
                                .html(
                                    '<i class="bi bi-exclamation-circle"></i> Terjadi kesalahan saat menyimpan data'
                                    );
                        }

                        $('#modalAlert')[0].scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    },
                    complete: function() {
                        $btnSubmit.prop('disabled', false).html(
                            '<i class="bi bi-save"></i> Simpan Data');
                    }
                });
            });

            // Reset form when modal is closed
            $('#tambahOrangtuaModal').on('hidden.bs.modal', function() {
                $('#formTambahOrangtua')[0].reset();
                $('#formTambahOrangtua').find('.is-invalid').removeClass('is-invalid');
                $('#formTambahOrangtua').find('.invalid-feedback').text('');
                $('#modalAlert').addClass('d-none');
                $('#modal_kelurahan_id').html('<option value="">-- Pilih Kecamatan Dahulu --</option>')
                    .prop('disabled', true);
            });
        });
    </script>
@endpush
