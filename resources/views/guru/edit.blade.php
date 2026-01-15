@extends('layouts.app')

@section('title', 'Edit Guru')

@section('content')
    <div class="container-fluid px-4 py-3">
        <!-- Header -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1 text-dark fw-bold">
                        <i class="bi bi-pencil-fill text-warning"></i> Edit Guru
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('guru.index') }}">Guru</a></li>
                            <li class="breadcrumb-item active">Edit - {{ $guru->nama }}</li>
                        </ol>
                    </nav>
                </div>
                <a href="{{ route('guru.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
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

        <!-- Form -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">
                    <i class="bi bi-clipboard-data"></i> Form Edit Data Guru
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <!-- Informasi Pribadi -->
                        <div class="col-12">
                            <h6 class="border-bottom pb-2 mb-3 text-primary">
                                <i class="bi bi-person-badge"></i> Informasi Pribadi
                            </h6>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No. ID Guru</label>
                            <input type="text" class="form-control bg-light" value="{{ $guru->no_id }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                value="{{ old('nama', $guru->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin"
                                required>
                                <option value="L"
                                    {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="P"
                                    {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Tempat Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                name="tempat_lahir" value="{{ old('tempat_lahir', $guru->tempat_lahir) }}">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                name="tanggal_lahir" value="{{ old('tanggal_lahir', $guru->tanggal_lahir) }}">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Informasi Akademik -->
                        <div class="col-12 mt-4">
                            <h6 class="border-bottom pb-2 mb-3 text-success">
                                <i class="bi bi-mortarboard"></i> Informasi Akademik
                            </h6>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Pendidikan</label>
                            <input type="text" class="form-control @error('pendidikan') is-invalid @enderror"
                                name="pendidikan" value="{{ old('pendidikan', $guru->pendidikan) }}"
                                placeholder="S1, S2, SMA, dll">
                            @error('pendidikan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kelas yang Diajar</label>
                            <select class="form-select @error('kelas_id') is-invalid @enderror" name="kelas_id">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelasList as $kelas)
                                    <option value="{{ $kelas->id }}"
                                        {{ old('kelas_id', $guru->kelas_id) == $kelas->id ? 'selected' : '' }}>
                                        {{ $kelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kontak & Alamat -->
                        <div class="col-12 mt-4">
                            <h6 class="border-bottom pb-2 mb-3 text-info">
                                <i class="bi bi-geo-alt"></i> Kontak & Alamat
                            </h6>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="3">{{ old('alamat', $guru->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Nomor HP</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                        name="no_hp" value="{{ old('no_hp', $guru->no_hp) }}"
                                        placeholder="08xxxxxxxxxx">
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email', $guru->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Foto & Status -->
                        <div class="col-12 mt-4">
                            <h6 class="border-bottom pb-2 mb-3 text-warning">
                                <i class="bi bi-card-image"></i> Foto & Status
                            </h6>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Foto Guru (Opsional)</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto"
                                id="foto" accept="image/*">
                            <small class="text-muted">Max 2MB (JPG, PNG, JPEG) - Kosongkan jika tidak ingin
                                mengubah</small>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Preview Foto</label>
                            <div class="border rounded p-3 text-center bg-light" style="height: 150px;">
                                <img src="{{ $guru->foto ? asset('storage/' . $guru->foto) : asset('images/default-avatar.png') }}"
                                    id="preview" class="img-fluid h-100" style="object-fit: contain;">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                    value="1" {{ old('is_active', $guru->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active">
                                    Status Aktif
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('guru.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-lg"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save"></i> Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Photo preview
        document.getElementById('foto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 2048000) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB');
                    e.target.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('preview').src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
