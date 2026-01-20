@extends('layouts.app')

@section('title', 'Tambah Berita')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Tambah Berita Baru</h1>
                <p class="text-muted small mb-0">Buat berita atau pengumuman baru</p>
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
        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

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
                                    id="judul" name="judul" value="{{ old('judul') }}"
                                    placeholder="Masukkan judul berita..." required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Slug akan dibuat otomatis dari judul</small>
                            </div>

                            <!-- Ringkasan -->
                            <div class="mb-3">
                                <label for="ringkasan" class="form-label">Ringkasan</label>
                                <textarea class="form-control @error('ringkasan') is-invalid @enderror" id="ringkasan" name="ringkasan" rows="3"
                                    placeholder="Ringkasan singkat berita (opsional)">{{ old('ringkasan') }}</textarea>
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
                                <textarea class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" rows="15" required>{{ old('isi') }}</textarea>
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
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_published" name="is_published"
                                        value="1" {{ old('is_published') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_published">
                                        <strong>Publikasikan Sekarang</strong>
                                    </label>
                                </div>
                                <small class="text-muted">
                                    Jika tidak dicentang, berita akan disimpan sebagai draft
                                </small>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-2"></i>Simpan Berita
                                </button>
                                <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary">
                                    Batal
                                </a>
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
                                        {{ old('kategori') == $category ? 'selected' : '' }}>
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
                            <div class="mb-3">
                                <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                    id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                            </div>

                            <!-- Image Preview -->
                            <div id="imagePreview" class="text-center d-none">
                                <img id="preview" src="" alt="Preview" class="img-fluid rounded"
                                    style="max-height: 200px;">
                                <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeImage()">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

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
                    'removeformat | code | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',

                // Image upload handler


                // File picker for media
                file_picker_types: 'image media',
                file_picker_callback: function(callback, value, meta) {
                    if (meta.filetype === 'image') {
                        var input = document.createElement('input');
                        input.setAttribute('type', 'file');
                        input.setAttribute('accept', 'image/*');

                        input.onchange = function() {
                            var file = this.files[0];
                            var reader = new FileReader();

                            reader.onload = function() {
                                var id = 'blobid' + (new Date()).getTime();
                                var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                var base64 = reader.result.split(',')[1];
                                var blobInfo = blobCache.create(id, file, base64);
                                blobCache.add(blobInfo);
                                callback(blobInfo.blobUri(), {
                                    title: file.name
                                });
                            };

                            reader.readAsDataURL(file);
                        };

                        input.click();
                    }
                },

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
                    } else {
                        counterDiv.classList.remove('text-danger');
                        counterDiv.classList.add('text-muted');
                    }
                }

                ringkasanField.addEventListener('input', updateCounter);
                updateCounter();
            }
        </script>
    @endpush
@endsection
