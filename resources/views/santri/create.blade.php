@extends('layouts.app')

@section('title', 'Tambah Santri')

@section('content')
    <div class="container-fluid px-4 py-3">
        <!-- Header -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1 text-dark fw-bold">
                        <i class="bi bi-person-plus-fill text-primary"></i> Tambah Santri
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('santri.index') }}">Santri</a></li>
                            <li class="breadcrumb-item active">Tambah</li>
                        </ol>
                    </nav>
                </div>
                <a href="{{ route('santri.index') }}" class="btn btn-secondary">
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
        <form action="{{ route('santri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Informasi Pribadi -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-person-badge"></i> Informasi Pribadi</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                No. ID Santri <small class="text-muted">(Otomatis)</small>
                            </label>
                            <input type="text" class="form-control bg-light" readonly placeholder="Auto Generated">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin"
                                required>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Tempat Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
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
                            <select class="form-select @error('orangtua_id') is-invalid @enderror" id="orangtua_id"
                                name="orangtua_id" style="width: 100%" required>
                                <option value="">-- Pilih Orang Tua --</option>
                                @foreach ($orangtuaList as $orangtua)
                                    <option value="{{ $orangtua->id }}" data-ayah="{{ $orangtua->nama_ayah }}"
                                        data-ibu="{{ $orangtua->nama_ibu }}" data-hp="{{ $orangtua->no_hp }}"
                                        data-alamat="{{ $orangtua->alamat }}"
                                        data-kelurahan-id="{{ $orangtua->kelurahan_id }}"
                                        data-kecamatan-id="{{ $orangtua->kelurahan?->kecamatan_id }}"
                                        data-status-ayah="{{ $orangtua->status_ayah }}"
                                        data-status-ibu="{{ $orangtua->status_ibu }}"
                                        data-status-anak="{{ $orangtua->status_anak }}"
                                        {{ old('orangtua_id') == $orangtua->id ? 'selected' : '' }}>
                                        {{ $orangtua->no_id }} - {{ $orangtua->nama_lengkap }}
                                    </option>
                                @endforeach
                            </select>
                            @error('orangtua_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                <i class="bi bi-info-circle"></i> Pilih orang tua dari database. Data alamat akan otomatis
                                terisi.
                                <a href="{{ route('orangtua.create') }}" target="_blank" class="text-primary">Tambah orang
                                    tua baru</a>
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
                                <option value="Ayah" {{ old('hubungan_wali') == 'Ayah' ? 'selected' : '' }}>Ayah
                                </option>
                                <option value="Ibu" {{ old('hubungan_wali') == 'Ibu' ? 'selected' : '' }}>Ibu</option>
                                <option value="Kakek" {{ old('hubungan_wali') == 'Kakek' ? 'selected' : '' }}>Kakek
                                </option>
                                <option value="Nenek" {{ old('hubungan_wali') == 'Nenek' ? 'selected' : '' }}>Nenek
                                </option>
                                <option value="Paman" {{ old('hubungan_wali') == 'Paman' ? 'selected' : '' }}>Paman
                                </option>
                                <option value="Bibi" {{ old('hubungan_wali') == 'Bibi' ? 'selected' : '' }}>Bibi
                                </option>
                                <option value="Kakak" {{ old('hubungan_wali') == 'Kakak' ? 'selected' : '' }}>Kakak
                                </option>
                                <option value="Lainnya" {{ old('hubungan_wali') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                </option>
                            </select>
                            @error('hubungan_wali')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">No HP Wali</label>
                            <input type="text" class="form-control @error('no_hp_wali') is-invalid @enderror"
                                id="no_hp_wali" name="no_hp_wali" value="{{ old('no_hp_wali') }}"
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
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="2"
                                placeholder="Contoh: Jl. Sultan Babullah No. 123, RT 001/RW 002">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kecamatan</label>
                            <select class="form-select @error('kecamatan_id') is-invalid @enderror" id="kecamatan_id"
                                name="kecamatan_id_temp">
                                <option value="">-- Pilih Kecamatan --</option>
                                @foreach ($kecamatanList as $kecamatan)
                                    <option value="{{ $kecamatan->id }}"
                                        {{ old('kecamatan_id') == $kecamatan->id ? 'selected' : '' }}>
                                        {{ $kecamatan->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kecamatan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kelurahan</label>
                            <select class="form-select @error('kelurahan_id') is-invalid @enderror" id="kelurahan_id"
                                name="kelurahan_id" disabled>
                                <option value="">-- Pilih Kecamatan Terlebih Dahulu --</option>
                            </select>
                            @error('kelurahan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="alert alert-info py-2">
                                <small>
                                    <i class="bi bi-info-circle me-1"></i>
                                    <strong>Kota Ternate</strong> - Pilih kecamatan dan kelurahan tempat tinggal santri
                                </small>
                            </div>
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
                                        {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
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
                                        {{ old('guru_id') == $guru->id ? 'selected' : '' }}>
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
                                name="tanggal_masuk" value="{{ old('tanggal_masuk', date('Y-m-d')) }}">
                            @error('tanggal_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                                <option value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="lulus" {{ old('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                <option value="pindah" {{ old('status') == 'pindah' ? 'selected' : '' }}>Pindah</option>
                                <option value="keluar" {{ old('status') == 'keluar' ? 'selected' : '' }}>Keluar</option>
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
                            <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                name="foto" id="foto" accept="image/*">
                            <small class="text-muted">Max 2MB (JPG, PNG, JPEG)</small>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Preview Foto</label>
                            <div class="border rounded p-3 text-center bg-light" style="height: 150px;">
                                <img src="{{ asset('images/logo-tpq-1.png') }}" id="preview" class="img-fluid h-100"
                                    style="object-fit: contain;">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Catatan</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror" name="catatan" rows="3"
                                placeholder="Catatan tambahan tentang santri">{{ old('catatan') }}</textarea>
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
                            <i class="bi bi-save"></i> Simpan Data Santri
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            console.log('Initializing form scripts...');

            // Initialize Select2 with error handling
            try {
                if (typeof $.fn.select2 !== 'undefined') {
                    $('#orangtua_id').select2({
                        theme: 'bootstrap-5',
                        placeholder: '-- Pilih Orang Tua --',
                        allowClear: true,
                        width: '100%'
                    });
                    console.log('✓ Select2 initialized for #orangtua_id');
                } else {
                    console.warn('⚠ Select2 not available, using standard dropdown');
                }
            } catch (e) {
                console.error('Error initializing Select2:', e);
                console.log('Continuing with standard dropdown...');
            }

            // Cascading dropdown: Kecamatan -> Kelurahan
            $('#kecamatan_id').on('change', function(e, preselectedKelurahan) {
                const kecamatanId = $(this).val();
                const $kelurahan = $('#kelurahan_id');

                if (kecamatanId) {
                    // Enable kelurahan dropdown
                    $kelurahan.prop('disabled', true).html('<option value="">Loading...</option>');

                    // Fetch kelurahan via AJAX
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

                            // If preselected kelurahan (from orangtua), select it
                            if (preselectedKelurahan) {
                                $kelurahan.val(preselectedKelurahan);
                            }
                        },
                        error: function() {
                            $kelurahan.html('<option value="">Error loading data</option>');
                            $kelurahan.prop('disabled', false);
                        }
                    });
                } else {
                    // Disable and reset kelurahan
                    $kelurahan.html('<option value="">-- Pilih Kecamatan Terlebih Dahulu --</option>');
                    $kelurahan.prop('disabled', true);
                }
            });

            // Auto-fill data when orangtua selected
            $('#orangtua_id').on('change', function() {
                const selectedOption = $(this).find('option:selected');

                if (selectedOption.val()) {
                    // Show info panel
                    $('#orangtua-info').show();

                    // Fill info
                    const namaAyah = selectedOption.data('ayah') || '-';
                    const namaIbu = selectedOption.data('ibu') || '-';
                    const statusAyah = selectedOption.data('status-ayah');
                    const statusIbu = selectedOption.data('status-ibu');
                    const statusAnak = selectedOption.data('status-anak');
                    const kelurahanId = selectedOption.data('kelurahan-id');
                    const kecamatanId = selectedOption.data('kecamatan-id');

                    $('#info-ayah').text(namaAyah);
                    $('#info-ibu').text(namaIbu);
                    $('#info-hp').text(selectedOption.data('hp') || '-');
                    $('#info-alamat').text(selectedOption.data('alamat') || '-');

                    // Status badges
                    $('#badge-ayah').removeClass().addClass('badge').addClass(statusAyah === 'Hidup' ?
                        'bg-success' : 'bg-secondary').text(statusAyah);
                    $('#badge-ibu').removeClass().addClass('badge').addClass(statusIbu === 'Hidup' ?
                        'bg-success' : 'bg-secondary').text(statusIbu);

                    // Status anak badge
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

                    // Auto-fill form fields
                    $('#alamat').val(selectedOption.data('alamat') || '');

                    // Auto-fill kecamatan and kelurahan
                    if (kecamatanId) {
                        $('#kecamatan_id').val(kecamatanId).trigger('change', [kelurahanId]);
                    }

                    // Auto-fill wali info
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
                    // Hide info panel
                    $('#orangtua-info').hide();

                    // Clear fields
                    $('#alamat').val('');
                    $('#kecamatan_id').val('').trigger('change');
                }
            });

            // Trigger change if already selected (for old values)
            if ($('#orangtua_id').val()) {
                $('#orangtua_id').trigger('change');
            }

            if ($('#kecamatan_id').val()) {
                $('#kecamatan_id').trigger('change');
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
                        $('#preview').attr('src', event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush
