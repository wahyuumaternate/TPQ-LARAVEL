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
                                <th width="14%">Santri</th>
                                <th width="12%">Guru</th>
                                <th width="8%">Jilid</th>
                                <th width="6%">Hal</th>
                                <th width="12%">Surah</th>
                                <th width="10%">Ayat</th>
                                <th width="10%">Status</th>
                                <th width="12%">Hafalan</th>
                                <th width="5%" class="text-center">Aksi</th>
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
                                    <td>{{ $item->bacaan_ayat_info }}</td>
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

                                <!-- Detail Modal -->
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
                                                        <p>{{ $item->bacaan_ayat_info }}</p>
                                                    </div>
                                                    <div class="col-md-12">
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

                                <!-- Edit Modal -->
                                @include('progress-santri.partials.edit-modal', ['item' => $item])

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
                                    <td colspan="11" class="text-center py-5">
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

    <!-- Create Modal -->
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
