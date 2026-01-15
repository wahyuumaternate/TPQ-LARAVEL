@extends('layouts.app')

@section('title', 'Kelola Berita')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Kelola Berita</h1>
                <p class="text-muted small mb-0">Manajemen berita dan pengumuman</p>
            </div>
            <div>
                <a href="{{ route('berita.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Berita
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

        <!-- Filter & Search -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('berita.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label for="search" class="form-label">Pencarian</label>
                            <input type="text" class="form-control" id="search" name="search"
                                value="{{ request('search') }}" placeholder="Cari judul berita...">
                        </div>
                        <div class="col-md-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}"
                                        {{ request('kategori') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="is_published" class="form-label">Status</label>
                            <select class="form-select" id="is_published" name="is_published">
                                <option value="">Semua Status</option>
                                <option value="1" {{ request('is_published') == '1' ? 'selected' : '' }}>Published
                                </option>
                                <option value="0" {{ request('is_published') == '0' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100 me-2">
                                <i class="bi bi-search"></i>
                            </button>
                            <a href="{{ route('berita.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-clockwise"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Berita</h6>
                    </div>
                    <div class="col-auto">
                        <span class="badge bg-info">Total: {{ $beritas->total() }} berita</span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Gambar</th>
                                <th width="30%">Judul</th>
                                <th width="12%">Kategori</th>
                                <th width="12%">Penulis</th>
                                <th width="8%">Views</th>
                                <th width="10%">Status</th>
                                <th width="13%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($beritas as $index => $berita)
                                <tr>
                                    <td>{{ $beritas->firstItem() + $index }}</td>
                                    <td>
                                        @if ($berita->gambar)
                                            <img src="{{ asset('storage/' . $berita->gambar) }}"
                                                alt="{{ $berita->judul }}" class="img-thumbnail"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                                                style="width: 60px; height: 60px;">
                                                <i class="bi bi-image fs-4"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $berita->judul }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            {{ $berita->published_date }}
                                        </small>
                                    </td>
                                    <td>
                                        @if ($berita->kategori)
                                            <span class="badge bg-info">{{ $berita->kategori }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $berita->creator->name ?? '-' }}</td>
                                    <td>
                                        <i class="bi bi-eye me-1"></i>{{ $berita->views }}
                                    </td>
                                    <td>
                                        <span class="badge {{ $berita->status_badge_class }}">
                                            {{ $berita->status_label }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('berita.show', $berita) }}" class="btn btn-info"
                                                title="Lihat">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('berita.edit', $berita) }}" class="btn btn-warning"
                                                title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $berita->id }}" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $berita->id }}" tabindex="-1"
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
                                                        <p>Apakah Anda yakin ingin menghapus berita:</p>
                                                        <div class="alert alert-warning">
                                                            <strong>{{ $berita->judul }}</strong>
                                                        </div>
                                                        <p class="text-danger mb-0">
                                                            <small><i class="bi bi-info-circle me-1"></i>
                                                                Data yang dihapus tidak dapat dikembalikan!</small>
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <form action="{{ route('berita.destroy', $berita) }}"
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
                                    <td colspan="8" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox" style="font-size: 3rem; opacity: 0.3;"></i>
                                            <p class="mb-0 mt-2">Tidak ada berita</p>
                                            @if (request()->hasAny(['search', 'kategori', 'is_published']))
                                                <small>Coba ubah filter pencarian Anda</small>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($beritas->hasPages())
                    <div class="mt-3">
                        {{ $beritas->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

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
        </script>
    @endpush
@endsection
