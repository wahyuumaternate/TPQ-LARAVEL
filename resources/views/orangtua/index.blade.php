@extends('layouts.app')

@section('title', 'Data Orang Tua')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Data Orang Tua</h1>
                <p class="text-muted small mb-0">Kelola data orang tua/wali santri</p>
            </div>
            <div>
                <a href="{{ route('orangtua.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Data
                </a>
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
                <form action="{{ route('orangtua.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label for="search" class="form-label">Pencarian</label>
                        <input type="text" class="form-control" id="search" name="search"
                            value="{{ request('search') }}" placeholder="Cari nama, no ID, HP...">
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
                        <label for="status_anak" class="form-label">Status Anak</label>
                        <select class="form-select" id="status_anak" name="status_anak">
                            <option value="">Semua</option>
                            <option value="Dalam Asuhan OT"
                                {{ request('status_anak') == 'Dalam Asuhan OT' ? 'selected' : '' }}>Dalam Asuhan OT</option>
                            <option value="Anak Yatim" {{ request('status_anak') == 'Anak Yatim' ? 'selected' : '' }}>Anak
                                Yatim</option>
                            <option value="Anak Piatu" {{ request('status_anak') == 'Anak Piatu' ? 'selected' : '' }}>Anak
                                Piatu</option>
                            <option value="Anak Yatim Piatu"
                                {{ request('status_anak') == 'Anak Yatim Piatu' ? 'selected' : '' }}>Anak Yatim Piatu
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100 me-2">
                            <i class="bi bi-search me-1"></i>Cari
                        </button>
                        <a href="{{ route('orangtua.index') }}" class="btn btn-secondary">
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
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Orang Tua</h6>
                    </div>
                    <div class="col-auto">
                        <span class="badge bg-info">Total: {{ $orangtuas->total() }} data</span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered align-middle" style="font-size: 0.875rem;">
                        <thead class="table-light">
                            <tr>
                                <th width="8%">No. ID</th>
                                <th width="12%">Nama Santri</th>
                                <th width="11%">Nama Ayah</th>
                                <th width="11%">Nama Ibu</th>
                                <th width="10%">Pekerjaan Ayah</th>
                                <th width="10%">Pekerjaan Ibu</th>
                                <th width="8%">Status Ayah</th>
                                <th width="8%">Status Ibu</th>
                                <th width="10%">Status Anak</th>
                                <th width="12%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orangtuas as $orangtua)
                                <tr>
                                    <td><span class="badge bg-secondary">{{ $orangtua->no_id }}</span></td>
                                    <td>{{ $orangtua->santris->first()->nama ?? '-' }}</td>
                                    <td>{{ $orangtua->nama_ayah ?? '-' }}</td>
                                    <td>{{ $orangtua->nama_ibu ?? '-' }}</td>
                                    <td>{{ $orangtua->pekerjaan_ayah ?? '-' }}</td>
                                    <td>{{ $orangtua->pekerjaan_ibu ?? '-' }}</td>
                                    <td>
                                        @if ($orangtua->status_ayah == 'Hidup')
                                            <span class="badge bg-success">Hidup</span>
                                        @else
                                            <span class="badge bg-secondary">Wafat</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($orangtua->status_ibu == 'Hidup')
                                            <span class="badge bg-success">Hidup</span>
                                        @else
                                            <span class="badge bg-secondary">Wafat</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $badgeClass = 'bg-info';
                                            switch ($orangtua->status_anak) {
                                                case 'Dalam Asuhan OT':
                                                    $badgeClass = 'bg-primary';
                                                    break;
                                                case 'Anak Yatim':
                                                    $badgeClass = 'bg-warning';
                                                    break;
                                                case 'Anak Piatu':
                                                    $badgeClass = 'bg-info';
                                                    break;
                                                case 'Anak Yatim Piatu':
                                                    $badgeClass = 'bg-danger';
                                                    break;
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $orangtua->status_anak }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('orangtua.show', $orangtua->id) }}" class="btn btn-info"
                                                title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('orangtua.edit', $orangtua->id) }}" class="btn btn-warning"
                                                title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $orangtua->id }}" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $orangtua->id }}" tabindex="-1"
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
                                                        <p>Apakah Anda yakin ingin menghapus data orang tua:</p>
                                                        <div class="alert alert-warning">
                                                            <strong>{{ $orangtua->no_id }}</strong><br>
                                                            Ayah: {{ $orangtua->nama_ayah ?? '-' }}<br>
                                                            Ibu: {{ $orangtua->nama_ibu ?? '-' }}
                                                        </div>
                                                        @if ($orangtua->santris && $orangtua->santris->count() > 0)
                                                            <div class="alert alert-danger">
                                                                <i class="bi bi-exclamation-circle me-1"></i>
                                                                Orang tua ini memiliki {{ $orangtua->santris->count() }}
                                                                anak/santri terdaftar!
                                                            </div>
                                                        @endif
                                                        <p class="text-danger mb-0">
                                                            <small><i class="bi bi-info-circle me-1"></i>Data yang dihapus
                                                                tidak dapat dikembalikan!</small>
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <form action="{{ route('orangtua.destroy', $orangtua->id) }}"
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
                                    <td colspan="10" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox" style="font-size: 3rem; opacity: 0.3;"></i>
                                            <p class="mb-0 mt-2">Tidak ada data orang tua</p>
                                            @if (request()->hasAny(['search', 'is_active', 'status_anak']))
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
            @if ($orangtuas->hasPages())
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            Menampilkan {{ $orangtuas->firstItem() }} - {{ $orangtuas->lastItem() }} dari
                            {{ $orangtuas->total() }} data
                        </div>
                        <div>
                            {{ $orangtuas->links() }}
                        </div>
                    </div>
                </div>
            @endif
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
        </script>
    @endpush
@endsection
