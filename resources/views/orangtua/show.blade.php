@extends('layouts.app')

@section('title', 'Detail Data Orang Tua')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Detail Data Orang Tua</h1>
                <p class="text-muted small mb-0">Informasi lengkap orang tua/wali santri</p>
            </div>
            <div class="btn-group">
                <a href="{{ route('orangtua.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
                <a href="{{ route('orangtua.edit', $orangtua->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil me-2"></i>Edit
                </a>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="bi bi-trash me-2"></i>Hapus
                </button>
            </div>
        </div>

        <div class="row">
            <!-- Left Column: Profile & Contact -->
            <div class="col-lg-4">
                <!-- Profile Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body text-center">
                        @if ($orangtua->foto)
                            <img src="{{ asset('storage/' . $orangtua->foto) }}" alt="Foto Profil"
                                class="rounded-circle mb-3"
                                style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #e9ecef;">
                        @else
                            <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 150px; height: 150px; border: 3px solid #e9ecef;">
                                <i class="bi bi-person" style="font-size: 4rem; color: #6c757d;"></i>
                            </div>
                        @endif

                        <h5 class="mb-1">{{ $orangtua->nama_lengkap }}</h5>
                        <p class="text-muted mb-2">{{ $orangtua->no_id }}</p>

                        <div class="mb-2">
                            @if ($orangtua->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Tidak Aktif</span>
                            @endif

                            @if ($orangtua->user)
                                <span class="badge bg-info ms-1">Memiliki Akun</span>
                            @endif
                        </div>

                        @php
                            $badgeClass = 'info';
                            switch ($orangtua->status_anak) {
                                case 'Dalam Asuhan OT':
                                    $badgeClass = 'primary';
                                    break;
                                case 'Anak Yatim':
                                    $badgeClass = 'warning';
                                    break;
                                case 'Anak Piatu':
                                    $badgeClass = 'info';
                                    break;
                                case 'Anak Yatim Piatu':
                                    $badgeClass = 'danger';
                                    break;
                            }
                        @endphp
                        <span class="badge bg-{{ $badgeClass }}">{{ $orangtua->status_anak }}</span>
                    </div>
                </div>

                <!-- Contact Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0"><i class="bi bi-telephone me-2"></i>Informasi Kontak</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="text-muted small">No HP</label>
                            <p class="mb-0">
                                @if ($orangtua->no_hp)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $orangtua->no_hp) }}"
                                        target="_blank" class="text-decoration-none">
                                        <i class="bi bi-whatsapp text-success me-1"></i>
                                        {{ $orangtua->no_hp }}
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </p>
                        </div>

                        @if ($orangtua->no_hp_alternatif)
                            <div class="mb-3">
                                <label class="text-muted small">No HP Alternatif</label>
                                <p class="mb-0">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $orangtua->no_hp_alternatif) }}"
                                        target="_blank" class="text-decoration-none">
                                        <i class="bi bi-whatsapp text-success me-1"></i>
                                        {{ $orangtua->no_hp_alternatif }}
                                    </a>
                                </p>
                            </div>
                        @endif

                        <div class="mb-0">
                            <label class="text-muted small">Email</label>
                            <p class="mb-0">
                                @if ($orangtua->email)
                                    <a href="mailto:{{ $orangtua->email }}" class="text-decoration-none">
                                        <i class="bi bi-envelope me-1"></i>
                                        {{ $orangtua->email }}
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Address Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-warning text-dark">
                        <h6 class="mb-0"><i class="bi bi-geo-alt me-2"></i>Alamat</h6>
                    </div>
                    <div class="card-body">
                        @if ($orangtua->alamat)
                            <p class="mb-2">{{ $orangtua->alamat }}</p>
                        @endif

                        @if ($orangtua->kelurahan || $orangtua->kecamatan || $orangtua->kota || $orangtua->kode_pos)
                            <div class="text-muted small">
                                @if ($orangtua->kelurahan)
                                    Kel. {{ $orangtua->kelurahan }}<br>
                                @endif
                                @if ($orangtua->kecamatan)
                                    Kec. {{ $orangtua->kecamatan }}<br>
                                @endif
                                @if ($orangtua->kota)
                                    {{ $orangtua->kota }}<br>
                                @endif
                                @if ($orangtua->kode_pos)
                                    {{ $orangtua->kode_pos }}
                                @endif
                            </div>
                        @endif

                        @if (!$orangtua->alamat && !$orangtua->kelurahan && !$orangtua->kecamatan && !$orangtua->kota)
                            <p class="text-muted mb-0">Alamat belum diisi</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Details & Children -->
            <div class="col-lg-8">
                <!-- Parent Status Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0"><i class="bi bi-people me-2"></i>Status Orang Tua</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="p-3 border rounded">
                                    <i class="bi bi-person-fill" style="font-size: 2rem; color: #0d6efd;"></i>
                                    <h6 class="mt-2 mb-1">Status Ayah</h6>
                                    @if ($orangtua->status_ayah == 'Hidup')
                                        <span class="badge bg-success">Hidup</span>
                                    @else
                                        <span class="badge bg-secondary">Wafat</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 border rounded">
                                    <i class="bi bi-person-fill" style="font-size: 2rem; color: #17a2b8;"></i>
                                    <h6 class="mt-2 mb-1">Status Ibu</h6>
                                    @if ($orangtua->status_ibu == 'Hidup')
                                        <span class="badge bg-success">Hidup</span>
                                    @else
                                        <span class="badge bg-secondary">Wafat</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 border rounded">
                                    <i class="bi bi-people-fill"
                                        style="font-size: 2rem; color: {{ $orangtua->status_anak == 'Dalam Asuhan OT'
                                            ? '#0d6efd'
                                            : ($orangtua->status_anak == 'Anak Yatim'
                                                ? '#ffc107'
                                                : ($orangtua->status_anak == 'Anak Piatu'
                                                    ? '#17a2b8'
                                                    : '#dc3545')) }};"></i>
                                    <h6 class="mt-2 mb-1">Status Anak</h6>
                                    <span class="badge bg-{{ $badgeClass }}">{{ $orangtua->status_anak }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Parent Details Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h6 class="mb-0"><i class="bi bi-card-text me-2"></i>Data Orang Tua</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Data Ayah -->
                            <div class="col-md-6">
                                <div class="border-end pe-3">
                                    <h6 class="text-primary mb-3">
                                        <i class="bi bi-person me-1"></i> Data Ayah
                                    </h6>
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td width="40%" class="text-muted">Nama</td>
                                            <td width="5%">:</td>
                                            <td><strong>{{ $orangtua->nama_ayah ?? '-' }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Pekerjaan</td>
                                            <td>:</td>
                                            <td>{{ $orangtua->pekerjaan_ayah ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Status</td>
                                            <td>:</td>
                                            <td>
                                                @if ($orangtua->status_ayah == 'Hidup')
                                                    <span class="badge bg-success">Hidup</span>
                                                @else
                                                    <span class="badge bg-secondary">Wafat</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <!-- Data Ibu -->
                            <div class="col-md-6">
                                <h6 class="text-info mb-3">
                                    <i class="bi bi-person me-1"></i> Data Ibu
                                </h6>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td width="40%" class="text-muted">Nama</td>
                                        <td width="5%">:</td>
                                        <td><strong>{{ $orangtua->nama_ibu ?? '-' }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Pekerjaan</td>
                                        <td>:</td>
                                        <td>{{ $orangtua->pekerjaan_ibu ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Status</td>
                                        <td>:</td>
                                        <td>
                                            @if ($orangtua->status_ibu == 'Hidup')
                                                <span class="badge bg-success">Hidup</span>
                                            @else
                                                <span class="badge bg-secondary">Wafat</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Children/Santri Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header text-white d-flex justify-content-between align-items-center"
                        style="background-color: #6f42c1;">
                        <h6 class="mb-0">
                            <i class="bi bi-people-fill me-2"></i>Data Anak/Santri
                        </h6>
                        <span class="badge bg-light text-dark">
                            {{ $orangtua->santris->count() }} Anak
                        </span>
                    </div>
                    <div class="card-body">
                        @if ($orangtua->santris && $orangtua->santris->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="15%">No Induk</th>
                                            <th>Nama Santri</th>
                                            <th width="15%">Kelas</th>
                                            <th width="15%">Status</th>
                                            <th width="10%" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orangtua->santris as $index => $santri)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td><span class="badge bg-secondary">{{ $santri->no_induk ?? '-' }}</span>
                                                </td>
                                                <td>
                                                    <strong>{{ $santri->nama }}</strong>
                                                    @if ($santri->jenis_kelamin ?? false)
                                                        <br><small class="text-muted">
                                                            <i
                                                                class="bi bi-{{ $santri->jenis_kelamin == 'L' ? 'gender-male' : 'gender-female' }}"></i>
                                                            {{ $santri->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                                        </small>
                                                    @endif
                                                </td>
                                                <td>{{ $santri->kelas ?? '-' }}</td>
                                                <td>
                                                    @if ($santri->is_active ?? true)
                                                        <span class="badge bg-success">Aktif</span>
                                                    @else
                                                        <span class="badge bg-danger">Tidak Aktif</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if (Route::has('santri.show'))
                                                        <a href="{{ route('santri.show', $santri->id) }}"
                                                            class="btn btn-sm btn-info" title="Lihat Detail">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center text-muted py-4">
                                <i class="bi bi-inbox" style="font-size: 3rem; opacity: 0.3;"></i>
                                <p class="mb-0 mt-2">Belum ada data anak/santri</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- User Account Card (if exists) -->
                @if ($orangtua->user)
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h6 class="mb-0"><i class="bi bi-person-circle me-2"></i>Informasi Akun</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td width="30%" class="text-muted">Nama User</td>
                                    <td width="5%">:</td>
                                    <td>{{ $orangtua->user->name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Email Login</td>
                                    <td>:</td>
                                    <td>{{ $orangtua->user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Role</td>
                                    <td>:</td>
                                    <td><span class="badge bg-primary">{{ $orangtua->user->role ?? 'orangtua' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Terdaftar Sejak</td>
                                    <td>:</td>
                                    <td>{{ $orangtua->user->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endif

                <!-- Metadata Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-dark text-white">
                        <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>Metadata</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Dibuat Pada</p>
                                <p class="mb-3"><i
                                        class="bi bi-calendar-plus me-1"></i>{{ $orangtua->created_at->format('d F Y, H:i') }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted small mb-1">Terakhir Diubah</p>
                                <p class="mb-0"><i
                                        class="bi bi-calendar-check me-1"></i>{{ $orangtua->updated_at->format('d F Y, H:i') }}
                                </p>
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
                    <p>Apakah Anda yakin ingin menghapus data orang tua:</p>
                    <div class="alert alert-warning">
                        <strong>{{ $orangtua->no_id }}</strong><br>
                        {{ $orangtua->nama_lengkap }}
                    </div>
                    @if ($orangtua->santris && $orangtua->santris->count() > 0)
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-circle me-1"></i>
                            Orang tua ini memiliki {{ $orangtua->santris->count() }} anak/santri terdaftar!
                        </div>
                    @endif
                    <p class="text-danger mb-0">
                        <small><i class="bi bi-info-circle me-1"></i>Data yang dihapus tidak dapat dikembalikan!</small>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('orangtua.destroy', $orangtua->id) }}" method="POST" class="d-inline"
                        id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" id="confirmDelete">
                            <i class="bi bi-trash me-1"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Confirm delete with AJAX
                $('#confirmDelete').on('click', function() {
                    const form = $('#deleteForm');

                    $.ajax({
                        url: form.attr('action'),
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            window.location.href = "{{ route('orangtua.index') }}";
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan saat menghapus data');
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
