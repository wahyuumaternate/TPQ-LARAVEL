@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Edit Berita</h1>
                <p class="text-muted small mb-0">Perbarui informasi berita</p>
            </div>
            <div>
                <a href="{{ route('berita.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('berita.update', $berita) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Informasi Berita</h6>
                        </div>
                        <div class="card-body">
                            <!-- Judul -->
                            <div class="mb-3">
                                <label for="judul" class="form-label">
                                    Judul Berita <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                    class="form-control @error('judul') is-invalid @enderror" 
                                    id="judul" 
                                    name="judul" 
                                    value="{{ old('judul', $berita->judul) }}" 
                                    placeholder="Masukkan judul berita..."
                                    required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    Slug saat ini: <strong>{{ $berita->slug }}</strong>
                                </small>
                            </div>

                            <!-- Ringkasan -->
                            <div class="mb-3">
                                <label for="ringkasan" class="form-label">Ringkasan</label>
                                <textarea class="form-control @error('ringkasan') is-invalid @enderror" 
                                    id="ringkasan" 
                                    name="ringkasan" 
                                    rows="3" 
                                    placeholder="Ringkasan singkat berita (opsional)">{{ old('ringkasan', $berita->ringkasan) }}</textarea>
                                @error('ringkasan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Maksimal 500 karakter</small>
                            </div>

                            <!-- Isi Berita -->
                            <div class="mb-3">
                                <label for="isi" class="form-label">
                                    Isi Berita <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('isi') is-invalid @enderror" 
                                    id="isi" 
                                    name="isi" 
                                    rows="15" 
                                    required>{{ old('isi', $berita->isi) }}</textarea>
                                @error('isi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Status & Publish -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Publikasi</h6>
                        </div>
                        <div class="card-body">
                            <!-- Status Info -->
                            <div class="alert alert-info mb-3">
                                <small>
                                    <strong>Status:</strong> 
                                    <span class="badge {{ $berita->status_badge_class }}">
                                        {{ $berita->status_label }}
                                    </span>
                                    <br>
                                    @if($berita->is_published)
                                        <strong>Dipublikasikan:</strong> {{ $berita->published_date }}
                                    @endif
                                </small>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" 
                                        type="checkbox" 
                                        id="is_published" 
                                        name="is_published" 
                                        value="1"
                                        {{ old('is_published', $berita->is_published) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_published">
                                        <strong>Publikasikan</strong>
                                    </label>
                                </div>
                                <small class="text-muted">
                                    Centang untuk mempublikasikan berita
                                </small>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-2"></i>Update Berita
                                </button>
                                <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Statistik</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span><i class="bi bi-eye me-2"></i>Dilihat:</span>
                                <strong>{{ $berita->views }} kali</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span><i class="bi bi-calendar me-2"></i>Dibuat:</span>
                                <strong>{{ $berita->created_at->diffForHumans() }}</strong>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span><i class="bi bi-pencil me-2"></i>Diupdate:</span>
                                <strong>{{ $berita->updated_at->diffForHumans() }}</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Kategori</h6>
                        </div>
                        <div class="card-body">
                            <select class="form-select @error('kategori') is-invalid @enderror" 
                                id="kategori" 
                                name="kategori">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}" 
                                        {{ old('kategori', $berita->kategori) == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Gambar -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Gambar Unggulan</h6>
                        </div>
                        <div class="card-body">
                            <!-- Current Image -->
                            @if($berita->gambar)
                                <div class="mb-3 text-center">
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" 
                                        alt="{{ $berita->judul }}" 
                                        class="img-fluid rounded"
                                        style="max-height: 200px;">
                                    <p class="text-muted small mt-2">Gambar saat ini</p>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="gambar" class="form-label">
                                    {{ $berita->gambar ? 'Ganti Gambar' : 'Upload Gambar' }}
                                </label>
                                <input type="file" 
                                    class="form-control @error('gambar') is-invalid @enderror" 
                                    id="gambar" 
                                    name="gambar" 
                                    accept="image/*"
                                    onchange="previewImage(event)">
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                            </div>

                            <!-- New Image Preview -->
                            <div id="imagePreview" class="text-center d-none">
                                <p class="text-success small"><strong>Preview Gambar Baru:</strong></p>
                                <img id="preview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeImage()">
                                    <i class="bi bi-trash"></i> Hapus Preview
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
    <script>
        // Initialize CKEditor
        CKEDITOR.replace('isi', {
            height: 400,
            filebrowserUploadUrl: "{{ route('berita.update', $berita) }}",
            filebrowserUploadMethod: 'form'
        });

        // Image Preview
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            }
        }

        // Remove Image
        function removeImage() {
            document.getElementById('gambar').value = '';
            document.getElementById('imagePreview').classList.add('d-none');
            document.getElementById('preview').src = '';
        }

        // Auto hide alerts
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
    @endpush
@endsection