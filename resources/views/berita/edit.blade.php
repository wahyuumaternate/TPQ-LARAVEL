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

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
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
                                <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                    id="judul" name="judul" value="{{ old('judul', $berita->judul) }}"
                                    placeholder="Masukkan judul berita..." required>
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
                                <textarea class="form-control @error('ringkasan') is-invalid @enderror" id="ringkasan" name="ringkasan" rows="3"
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
                                <textarea class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" rows="15" required>{{ old('isi', $berita->isi) }}</textarea>
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
                            <div class="alert alert-info border-0 mb-3">
                                <small>
                                    <strong>Status:</strong>
                                    <span class="badge {{ $berita->status_badge_class }}">
                                        {{ $berita->status_label }}
                                    </span>
                                    <br>
                                    @if ($berita->is_published)
                                        <strong>Dipublikasikan:</strong> {{ $berita->published_date }}
                                    @endif
                                </small>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_published" name="is_published"
                                        value="1" {{ old('is_published', $berita->is_published) ? 'checked' : '' }}>
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
                            <div class="stat-item mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="stat-icon bg-primary-subtle rounded-3 p-2 me-3">
                                        <i class="bi bi-eye text-primary fs-5"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Total Dilihat</small>
                                        <strong class="fs-5">{{ $berita->views }}</strong>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">
                                    <i class="bi bi-calendar-plus me-1"></i>Dibuat
                                </span>
                                <strong class="small">{{ $berita->created_at->format('d M Y') }}</strong>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">
                                    <i class="bi bi-clock-history me-1"></i>Terakhir Update
                                </span>
                                <strong class="small">{{ $berita->updated_at->diffForHumans() }}</strong>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">
                                    <i class="bi bi-person me-1"></i>Penulis
                                </span>
                                <strong class="small">{{ $berita->user->name ?? 'Admin' }}</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Kategori</h6>
                        </div>
                        <div class="card-body">
                            <select class="form-select @error('kategori') is-invalid @enderror" id="kategori"
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
                            @if ($berita->gambar)
                                <div class="mb-3 text-center position-relative" id="currentImage">
                                    <div class="current-image-wrapper">
                                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                                            class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                                        <div class="image-overlay">
                                            <span class="badge bg-success">Gambar Saat Ini</span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="gambar" class="form-label">
                                    <i
                                        class="bi bi-image me-1"></i>{{ $berita->gambar ? 'Ganti Gambar' : 'Upload Gambar' }}
                                </label>
                                <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                    id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                            </div>

                            <!-- New Image Preview -->
                            <div id="imagePreview" class="text-center d-none">
                                <div class="alert alert-success border-0 py-2 mb-2">
                                    <small><i class="bi bi-info-circle me-1"></i><strong>Preview Gambar
                                            Baru</strong></small>
                                </div>
                                <div class="preview-wrapper position-relative">
                                    <img id="preview" src="" alt="Preview"
                                        class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                                </div>
                                <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeImage()">
                                    <i class="bi bi-trash"></i> Batal Ganti
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('berita.show', $berita) }}" class="btn btn-outline-info btn-sm"
                                    target="_blank">
                                    <i class="bi bi-eye me-1"></i>Lihat Berita
                                </a>
                                <button type="button" class="btn btn-outline-danger btn-sm"
                                    onclick="if(confirm('Yakin ingin menghapus berita ini?')) document.getElementById('delete-form').submit()">
                                    <i class="bi bi-trash me-1"></i>Hapus Berita
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Delete Form (Hidden) -->
        <form id="delete-form" action="{{ route('berita.destroy', $berita) }}" method="POST" class="d-none">
            @csrf
            @method('DELETE')
        </form>
    </div>

    @push('styles')
        <style>
            .current-image-wrapper {
                position: relative;
                display: inline-block;
            }

            .image-overlay {
                position: absolute;
                top: 10px;
                right: 10px;
            }

            .stat-item {
                transition: all 0.3s ease;
            }

            .stat-item:hover {
                transform: translateX(5px);
            }

            .stat-icon {
                width: 50px;
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .preview-wrapper {
                border: 2px dashed #28a745;
                padding: 10px;
                border-radius: 8px;
                background: #f8f9fa;
            }
        </style>
    @endpush

    @push('scripts')
        <!-- TinyMCE -->
        <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>

        <script>
            // Initialize TinyMCE
            tinymce.init({
                selector: '#isi',
                height: 500,
                menubar: true,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'table', 'code', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic forecolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | link | code | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',





                // Language
                language: 'id',

                // Automatic resize
                min_height: 400,
                max_height: 800,
                autoresize_on_init: true,

                // Paste options
                paste_data_images: true,
                paste_as_text: false,

                // Link options
                link_default_target: '_blank',
                link_title: false,

                // Misc options
                branding: false,
                promotion: false,
                statusbar: true,
                elementpath: false,
                resize: true
            });

            // Image Preview
            function previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    // Validate file size (2MB)
                    if (file.size > 2048000) {
                        alert('Ukuran file terlalu besar! Maksimal 2MB');
                        event.target.value = '';
                        return;
                    }

                    // Validate file type
                    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                    if (!allowedTypes.includes(file.type)) {
                        alert('Format file tidak didukung! Gunakan JPG, PNG, atau GIF');
                        event.target.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('preview').src = e.target.result;
                        document.getElementById('imagePreview').classList.remove('d-none');

                        // Fade out current image
                        const currentImage = document.getElementById('currentImage');
                        if (currentImage) {
                            currentImage.style.opacity = '0.5';
                        }
                    }
                    reader.readAsDataURL(file);
                }
            }

            // Remove Image
            function removeImage() {
                document.getElementById('gambar').value = '';
                document.getElementById('imagePreview').classList.add('d-none');
                document.getElementById('preview').src = '';

                // Restore current image opacity
                const currentImage = document.getElementById('currentImage');
                if (currentImage) {
                    currentImage.style.opacity = '1';
                }
            }

            // Auto hide alerts
            setTimeout(function() {
                var alerts = document.querySelectorAll('.alert-dismissible');
                alerts.forEach(function(alert) {
                    if (!alert.classList.contains('alert-info')) {
                        var bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }
                });
            }, 5000);

            // Form validation before submit
            document.querySelector('form').addEventListener('submit', function(e) {
                // Update TinyMCE content to textarea
                tinymce.triggerSave();

                // Validate required fields
                const judul = document.getElementById('judul').value.trim();
                const isi = tinymce.get('isi').getContent();

                if (!judul) {
                    e.preventDefault();
                    alert('Judul berita wajib diisi!');
                    document.getElementById('judul').focus();
                    return false;
                }

                if (!isi || isi === '') {
                    e.preventDefault();
                    alert('Isi berita wajib diisi!');
                    tinymce.get('isi').focus();
                    return false;
                }

                // Show loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';
            });

            // Character counter for ringkasan
            const ringkasanField = document.getElementById('ringkasan');
            if (ringkasanField) {
                const maxLength = 500;
                const counterDiv = document.createElement('small');
                counterDiv.className = 'text-muted float-end';
                ringkasanField.parentElement.querySelector('small').after(counterDiv);

                function updateCounter() {
                    const length = ringkasanField.value.length;
                    counterDiv.textContent = `${length}/${maxLength} karakter`;
                    if (length > maxLength) {
                        counterDiv.classList.remove('text-muted');
                        counterDiv.classList.add('text-danger');
                        ringkasanField.classList.add('is-invalid');
                    } else {
                        counterDiv.classList.remove('text-danger');
                        counterDiv.classList.add('text-muted');
                        ringkasanField.classList.remove('is-invalid');
                    }
                }

                ringkasanField.addEventListener('input', updateCounter);
                updateCounter();
            }

            // Unsaved changes warning
            let formChanged = false;
            const formInputs = document.querySelectorAll('input, select, textarea');

            formInputs.forEach(input => {
                input.addEventListener('change', () => {
                    formChanged = true;
                });
            });

            // TinyMCE change detection
            tinymce.get('isi').on('change', function() {
                formChanged = true;
            });

            window.addEventListener('beforeunload', function(e) {
                if (formChanged) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });

            // Don't warn on form submit
            document.querySelector('form').addEventListener('submit', function() {
                formChanged = false;
            });
        </script>
    @endpush
@endsection
