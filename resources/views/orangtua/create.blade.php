@extends('layouts.app')

@section('title', 'Tambah Data Orang Tua')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Tambah Data Orang Tua</h1>
                <p class="text-muted small mb-0">Formulir pendaftaran orang tua/wali santri</p>
            </div>
            <div>
                <a href="{{ route('orangtua.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <form action="{{ route('orangtua.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Terjadi kesalahan!</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Data Ayah Card -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0"><i class="bi bi-person me-2"></i>Data Ayah</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                    <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror"
                                        id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah') }}"
                                        placeholder="Masukkan nama ayah">
                                    @error('nama_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                                    <input type="text" class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                                        id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}"
                                        placeholder="Masukkan pekerjaan ayah">
                                    @error('pekerjaan_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="status_ayah" class="form-label">Status Ayah <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('status_ayah') is-invalid @enderror" id="status_ayah"
                                        name="status_ayah" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Hidup" {{ old('status_ayah') == 'Hidup' ? 'selected' : '' }}>Hidup
                                        </option>
                                        <option value="Wafat" {{ old('status_ayah') == 'Wafat' ? 'selected' : '' }}>Wafat
                                        </option>
                                    </select>
                                    @error('status_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Ibu Card -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-info text-white">
                            <h6 class="mb-0"><i class="bi bi-person me-2"></i>Data Ibu</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                    <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror"
                                        id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu') }}"
                                        placeholder="Masukkan nama ibu">
                                    @error('nama_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                                    <input type="text" class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                                        id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}"
                                        placeholder="Masukkan pekerjaan ibu">
                                    @error('pekerjaan_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="status_ibu" class="form-label">Status Ibu <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('status_ibu') is-invalid @enderror" id="status_ibu"
                                        name="status_ibu" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Hidup" {{ old('status_ibu') == 'Hidup' ? 'selected' : '' }}>Hidup
                                        </option>
                                        <option value="Wafat" {{ old('status_ibu') == 'Wafat' ? 'selected' : '' }}>Wafat
                                        </option>
                                    </select>
                                    @error('status_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Anak Card -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-warning text-dark">
                            <h6 class="mb-0"><i class="bi bi-people me-2"></i>Status Anak</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="status_anak" class="form-label">Status Anak <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('status_anak') is-invalid @enderror"
                                        id="status_anak" name="status_anak" required>
                                        <option value="">Pilih Status Anak</option>
                                        <option value="Dalam Asuhan OT"
                                            {{ old('status_anak') == 'Dalam Asuhan OT' ? 'selected' : '' }}>Dalam Asuhan OT
                                            (Orang Tua)</option>
                                        <option value="Anak Yatim"
                                            {{ old('status_anak') == 'Anak Yatim' ? 'selected' : '' }}>Anak Yatim (Ayah
                                            Wafat)</option>
                                        <option value="Anak Piatu"
                                            {{ old('status_anak') == 'Anak Piatu' ? 'selected' : '' }}>Anak Piatu (Ibu
                                            Wafat)</option>
                                        <option value="Anak Yatim Piatu"
                                            {{ old('status_anak') == 'Anak Yatim Piatu' ? 'selected' : '' }}>Anak Yatim
                                            Piatu (Kedua Orang Tua Wafat)</option>
                                    </select>
                                    @error('status_anak')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Status anak akan otomatis disesuaikan dengan status ayah dan
                                        ibu</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kontak Card -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-success text-white">
                            <h6 class="mb-0"><i class="bi bi-telephone me-2"></i>Informasi Kontak</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="no_hp" class="form-label">No HP/WhatsApp</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                        id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                                        placeholder="08xxxxxxxxxx">
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="no_hp_alternatif" class="form-label">No HP Alternatif</label>
                                    <input type="text"
                                        class="form-control @error('no_hp_alternatif') is-invalid @enderror"
                                        id="no_hp_alternatif" name="no_hp_alternatif"
                                        value="{{ old('no_hp_alternatif') }}" placeholder="08xxxxxxxxxx">
                                    @error('no_hp_alternatif')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}"
                                        placeholder="email@example.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat Card -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h6 class="mb-0"><i class="bi bi-geo-alt me-2"></i>Alamat Lengkap</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"
                                        placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="kelurahan" class="form-label">Kelurahan</label>
                                    <input type="text" class="form-control @error('kelurahan') is-invalid @enderror"
                                        id="kelurahan" name="kelurahan" value="{{ old('kelurahan') }}"
                                        placeholder="Kelurahan">
                                    @error('kelurahan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <input type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                                        id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}"
                                        placeholder="Kecamatan">
                                    @error('kecamatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="kota" class="form-label">Kota/Kabupaten</label>
                                    <input type="text" class="form-control @error('kota') is-invalid @enderror"
                                        id="kota" name="kota" value="{{ old('kota') }}"
                                        placeholder="Kota/Kabupaten">
                                    @error('kota')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="kode_pos" class="form-label">Kode Pos</label>
                                    <input type="text" class="form-control @error('kode_pos') is-invalid @enderror"
                                        id="kode_pos" name="kode_pos" value="{{ old('kode_pos') }}"
                                        placeholder="Kode Pos" maxlength="10">
                                    @error('kode_pos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Foto & Status Card -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-dark text-white">
                            <h6 class="mb-0"><i class="bi bi-gear me-2"></i>Foto & Pengaturan</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="foto" class="form-label">Foto Profil</label>
                                    <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                        id="foto" name="foto" accept="image/jpeg,image/png,image/jpg"
                                        onchange="previewImage(event)">
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted d-block mt-1">Format: JPG, JPEG, PNG. Maks: 2MB</small>

                                    <!-- Image Preview -->
                                    <div id="imagePreview" class="mt-3" style="display: none;">
                                        <img id="preview" src="" alt="Preview" class="img-thumbnail"
                                            style="max-width: 200px;">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="is_active" class="form-label">Status</label>
                                    <select class="form-select @error('is_active') is-invalid @enderror" id="is_active"
                                        name="is_active">
                                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Tidak Aktif
                                        </option>
                                    </select>
                                    @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label d-block">Buat Akun User</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="create_account"
                                            name="create_account" value="1"
                                            {{ old('create_account') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="create_account">
                                            Ya, buat akun
                                        </label>
                                    </div>
                                    <small class="text-muted">Password default: password123</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('orangtua.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-x-circle me-2"></i>Batal
                                </a>
                                <button type="reset" class="btn btn-warning">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-2"></i>Simpan Data
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Image preview function
            function previewImage(event) {
                const input = event.target;
                const preview = document.getElementById('preview');
                const previewContainer = document.getElementById('imagePreview');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        previewContainer.style.display = 'block';
                    }

                    reader.readAsDataURL(input.files[0]);
                } else {
                    previewContainer.style.display = 'none';
                }
            }

            // Auto update status anak based on status ayah and ibu
            document.getElementById('status_ayah').addEventListener('change', updateStatusAnak);
            document.getElementById('status_ibu').addEventListener('change', updateStatusAnak);

            function updateStatusAnak() {
                const statusAyah = document.getElementById('status_ayah').value;
                const statusIbu = document.getElementById('status_ibu').value;
                const statusAnak = document.getElementById('status_anak');

                if (statusAyah === 'Wafat' && statusIbu === 'Wafat') {
                    statusAnak.value = 'Anak Yatim Piatu';
                } else if (statusAyah === 'Wafat') {
                    statusAnak.value = 'Anak Yatim';
                } else if (statusIbu === 'Wafat') {
                    statusAnak.value = 'Anak Piatu';
                } else if (statusAyah === 'Hidup' && statusIbu === 'Hidup') {
                    statusAnak.value = 'Dalam Asuhan OT';
                }
            }
        </script>
    @endpush
@endsection
