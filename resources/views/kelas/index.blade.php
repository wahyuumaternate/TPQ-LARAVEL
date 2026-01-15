@extends('layouts.app')

@section('title', 'Data Kelas')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Data Kelas</h1>
                <p class="text-muted small mb-0">Kelola data kelas pembelajaran santri</p>
            </div>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Kelas
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
                <form action="{{ route('kelas.index') }}" method="GET" class="row g-3">
                    <div class="col-md-5">
                        <label for="search" class="form-label">Pencarian</label>
                        <input type="text" class="form-control" id="search" name="search"
                            value="{{ request('search') }}" placeholder="Cari nama kelas, kode...">
                    </div>
                    <div class="col-md-3">
                        <label for="is_active" class="form-label">Status</label>
                        <select class="form-select" id="is_active" name="is_active">
                            <option value="">Semua Status</option>
                            <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="hari" class="form-label">Hari</label>
                        <select class="form-select" id="hari" name="hari">
                            <option value="">Semua Hari</option>
                            <option value="Senin" {{ request('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ request('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ request('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ request('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ request('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                            <option value="Sabtu" {{ request('hari') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                            <option value="Minggu" {{ request('hari') == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                        </select>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100 me-2">
                            <i class="bi bi-search"></i>
                        </button>
                        <a href="{{ route('kelas.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Data Table Card -->
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Kelas</h6>
                    </div>
                    <div class="col-auto">
                        <span class="badge bg-info">Total: {{ $kelas->total() }} kelas</span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered align-middle" style="font-size: 0.875rem;">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="12%">Kode Kelas</th>
                                <th width="15%">Nama Kelas</th>
                                <th width="25%">Deskripsi</th>
                                <th width="10%">Hari</th>
                                <th width="10%">Jam Mulai</th>
                                <th width="10%">Jam Selesai</th>
                                <th width="8%">Status</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kelas as $index => $item)
                                <tr>
                                    <td>{{ $kelas->firstItem() + $index }}</td>
                                    <td><span class="badge bg-secondary">{{ $item->kode_kelas }}</span></td>
                                    <td><strong>{{ $item->nama_kelas }}</strong></td>
                                    <td>{{ Str::limit($item->deskripsi, 50) ?? '-' }}</td>
                                    <td>{{ $item->hari ?? '-' }}</td>
                                    <td>{{ $item->jam_mulai ? date('H:i', strtotime($item->jam_mulai)) : '-' }}</td>
                                    <td>{{ $item->jam_selesai ? date('H:i', strtotime($item->jam_selesai)) : '-' }}</td>
                                    <td>
                                        @if ($item->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $item->id }}" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $item->id }}" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning text-white">
                                                        <h5 class="modal-title">
                                                            <i class="bi bi-pencil me-2"></i>Edit Kelas
                                                        </h5>
                                                        <button type="button" class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form action="{{ route('kelas.update', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <label for="edit_nama_kelas{{ $item->id }}"
                                                                        class="form-label">
                                                                        Nama Kelas <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control"
                                                                        id="edit_nama_kelas{{ $item->id }}"
                                                                        name="nama_kelas" value="{{ $item->nama_kelas }}"
                                                                        required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="edit_kode_kelas{{ $item->id }}"
                                                                        class="form-label">
                                                                        Kode Kelas <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control"
                                                                        id="edit_kode_kelas{{ $item->id }}"
                                                                        name="kode_kelas" value="{{ $item->kode_kelas }}"
                                                                        required>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="edit_deskripsi{{ $item->id }}"
                                                                        class="form-label">
                                                                        Deskripsi
                                                                    </label>
                                                                    <textarea class="form-control" id="edit_deskripsi{{ $item->id }}" name="deskripsi" rows="3">{{ $item->deskripsi }}</textarea>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="edit_hari{{ $item->id }}"
                                                                        class="form-label">
                                                                        Hari
                                                                    </label>
                                                                    <select class="form-select"
                                                                        id="edit_hari{{ $item->id }}" name="hari">
                                                                        <option value="">Pilih Hari</option>
                                                                        <option value="Senin"
                                                                            {{ $item->hari == 'Senin' ? 'selected' : '' }}>
                                                                            Senin</option>
                                                                        <option value="Selasa"
                                                                            {{ $item->hari == 'Selasa' ? 'selected' : '' }}>
                                                                            Selasa</option>
                                                                        <option value="Rabu"
                                                                            {{ $item->hari == 'Rabu' ? 'selected' : '' }}>
                                                                            Rabu</option>
                                                                        <option value="Kamis"
                                                                            {{ $item->hari == 'Kamis' ? 'selected' : '' }}>
                                                                            Kamis</option>
                                                                        <option value="Jumat"
                                                                            {{ $item->hari == 'Jumat' ? 'selected' : '' }}>
                                                                            Jumat</option>
                                                                        <option value="Sabtu"
                                                                            {{ $item->hari == 'Sabtu' ? 'selected' : '' }}>
                                                                            Sabtu</option>
                                                                        <option value="Minggu"
                                                                            {{ $item->hari == 'Minggu' ? 'selected' : '' }}>
                                                                            Minggu</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="edit_jam_mulai{{ $item->id }}"
                                                                        class="form-label">
                                                                        Jam Mulai
                                                                    </label>
                                                                    <input type="time" class="form-control"
                                                                        id="edit_jam_mulai{{ $item->id }}"
                                                                        name="jam_mulai" value="{{ $item->jam_mulai }}">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="edit_jam_selesai{{ $item->id }}"
                                                                        class="form-label">
                                                                        Jam Selesai
                                                                    </label>
                                                                    <input type="time" class="form-control"
                                                                        id="edit_jam_selesai{{ $item->id }}"
                                                                        name="jam_selesai"
                                                                        value="{{ $item->jam_selesai }}">
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="edit_is_active{{ $item->id }}"
                                                                            name="is_active" value="1"
                                                                            {{ $item->is_active ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="edit_is_active{{ $item->id }}">
                                                                            Kelas Aktif
                                                                        </label>
                                                                    </div>
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
                                        </div>

                                        <!-- Delete Modal -->
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
                                                        <p>Apakah Anda yakin ingin menghapus kelas:</p>
                                                        <div class="alert alert-warning">
                                                            <strong>{{ $item->kode_kelas }}</strong><br>
                                                            {{ $item->nama_kelas }}
                                                        </div>
                                                        <p class="text-danger mb-0">
                                                            <small><i class="bi bi-info-circle me-1"></i>Data yang dihapus
                                                                tidak dapat dikembalikan!</small>
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <form action="{{ route('kelas.destroy', $item->id) }}"
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
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox" style="font-size: 3rem; opacity: 0.3;"></i>
                                            <p class="mb-0 mt-2">Tidak ada data kelas</p>
                                            @if (request()->hasAny(['search', 'is_active', 'hari']))
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

            <!-- Pagination -->
            @if ($kelas->hasPages())
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            Menampilkan {{ $kelas->firstItem() }} - {{ $kelas->lastItem() }} dari
                            {{ $kelas->total() }} kelas
                        </div>
                        <div>
                            {{ $kelas->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Kelas Baru
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('kelas.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nama_kelas" class="form-label">
                                    Nama Kelas <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror"
                                    id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas') }}"
                                    placeholder="Contoh: Iqra 1" required>
                                @error('nama_kelas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="kode_kelas" class="form-label">
                                    Kode Kelas <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('kode_kelas') is-invalid @enderror"
                                    id="kode_kelas" name="kode_kelas" value="{{ old('kode_kelas') }}"
                                    placeholder="Contoh: IQR-1" required>
                                @error('kode_kelas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                    rows="3" placeholder="Deskripsi kelas...">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="hari" class="form-label">Hari</label>
                                <select class="form-select @error('hari') is-invalid @enderror" id="hari"
                                    name="hari">
                                    <option value="">Pilih Hari</option>
                                    <option value="Senin" {{ old('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                                    <option value="Selasa" {{ old('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                    <option value="Rabu" {{ old('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                    <option value="Kamis" {{ old('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                    <option value="Jumat" {{ old('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                    <option value="Sabtu" {{ old('hari') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                    <option value="Minggu" {{ old('hari') == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                                </select>
                                @error('hari')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror"
                                    id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}">
                                @error('jam_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror"
                                    id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') }}">
                                @error('jam_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                        value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Kelas Aktif
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Auto hide alerts after 5 seconds
            setTimeout(function() {
                var alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);

            // Re-open create modal if validation errors exist
            @if ($errors->any() && !request()->route('kelas'))
                var createModal = new bootstrap.Modal(document.getElementById('createModal'));
                createModal.show();
            @endif
        </script>
    @endpush
@endsection
