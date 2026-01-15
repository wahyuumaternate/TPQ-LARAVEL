@extends('layouts.app')

@section('title', 'Detail Berita')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Detail Berita</h1>
                <p class="text-muted small mb-0">Informasi lengkap berita</p>
            </div>
            <div>
                <a href="{{ route('berita.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
                <a href="{{ route('berita.edit', $berita) }}" class="btn btn-warning">
                    <i class="bi bi-pencil me-2"></i>Edit
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <!-- Title & Meta -->
                        <div class="mb-4">
                            <h2 class="mb-3">{{ $berita->judul }}</h2>

                            <div class="d-flex flex-wrap gap-3 text-muted small mb-3">
                                <span>
                                    <i class="bi bi-person me-1"></i>
                                    {{ $berita->creator->name ?? 'Admin' }}
                                </span>
                                <span>
                                    <i class="bi bi-calendar me-1"></i>
                                    {{ $berita->published_date }}
                                </span>
                                <span>
                                    <i class="bi bi-eye me-1"></i>
                                    {{ $berita->views }} views
                                </span>
                                <span>
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $berita->reading_time }}
                                </span>
                                @if ($berita->kategori)
                                    <span class="badge bg-info">{{ $berita->kategori }}</span>
                                @endif
                                <span class="badge {{ $berita->status_badge_class }}">
                                    {{ $berita->status_label }}
                                </span>
                            </div>
                        </div>

                        <!-- Featured Image -->
                        @if ($berita->gambar)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                                    class="img-fluid rounded w-100" style="max-height: 500px; object-fit: cover;">
                            </div>
                        @endif

                        <!-- Summary -->
                        @if ($berita->ringkasan)
                            <div class="alert alert-light border-start border-primary border-4 mb-4">
                                <p class="mb-0"><strong>{{ $berita->ringkasan }}</strong></p>
                            </div>
                        @endif

                        <!-- Content -->
                        <div class="content">
                            {!! $berita->isi !!}
                        </div>
                    </div>
                </div>

                <!-- Related News -->
                @if ($relatedNews->count() > 0)
                    <div class="card shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Berita Terkait</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($relatedNews as $related)
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100">
                                            @if ($related->gambar)
                                                <img src="{{ asset('storage/' . $related->gambar) }}" class="card-img-top"
                                                    alt="{{ $related->judul }}" style="height: 150px; object-fit: cover;">
                                            @else
                                                <div class="bg-secondary d-flex align-items-center justify-content-center"
                                                    style="height: 150px;">
                                                    <i class="bi bi-image text-white fs-1"></i>
                                                </div>
                                            @endif
                                            <div class="card-body">
                                                <h6 class="card-title">
                                                    <a href="{{ route('berita.show', $related) }}"
                                                        class="text-decoration-none text-dark">
                                                        {{ Str::limit($related->judul, 50) }}
                                                    </a>
                                                </h6>
                                                <p class="card-text small text-muted">
                                                    {{ Str::limit($related->excerpt, 80) }}
                                                </p>
                                                <small class="text-muted">
                                                    <i class="bi bi-calendar me-1"></i>
                                                    {{ $related->published_date }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Actions -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Aksi</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('berita.edit', $berita) }}" class="btn btn-warning">
                                <i class="bi bi-pencil me-2"></i>Edit Berita
                            </a>

                            <form action="{{ route('berita.toggle-publish', $berita) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="btn btn-{{ $berita->is_published ? 'secondary' : 'success' }} w-100">
                                    <i class="bi bi-{{ $berita->is_published ? 'eye-slash' : 'eye' }} me-2"></i>
                                    {{ $berita->is_published ? 'Jadikan Draft' : 'Publikasikan' }}
                                </button>
                            </form>

                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal">
                                <i class="bi bi-trash me-2"></i>Hapus Berita
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Info -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="40%"><strong>Slug:</strong></td>
                                <td><code>{{ $berita->slug }}</code></td>
                            </tr>
                            <tr>
                                <td><strong>Kategori:</strong></td>
                                <td>
                                    @if ($berita->kategori)
                                        <span class="badge bg-info">{{ $berita->kategori }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    <span class="badge {{ $berita->status_badge_class }}">
                                        {{ $berita->status_label }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Dibuat:</strong></td>
                                <td>{{ $berita->created_at->isoFormat('D MMMM YYYY HH:mm') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Diupdate:</strong></td>
                                <td>{{ $berita->updated_at->isoFormat('D MMMM YYYY HH:mm') }}</td>
                            </tr>
                            @if ($berita->is_published)
                                <tr>
                                    <td><strong>Dipublikasi:</strong></td>
                                    <td>{{ $berita->published_at->isoFormat('D MMMM YYYY HH:mm') }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td><strong>Views:</strong></td>
                                <td><i class="bi bi-eye me-1"></i>{{ $berita->views }}</td>
                            </tr>
                        </table>
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
                    <p>Apakah Anda yakin ingin menghapus berita ini?</p>
                    <div class="alert alert-warning">
                        <strong>{{ $berita->judul }}</strong>
                    </div>
                    <p class="text-danger mb-0">
                        <small><i class="bi bi-info-circle me-1"></i>Data yang dihapus tidak dapat dikembalikan!</small>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('berita.destroy', $berita) }}" method="POST" class="d-inline">
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

    @push('scripts')
        <script>
            function copyToClipboard() {
                const url = "{{ route('berita.show', $berita) }}";
                navigator.clipboard.writeText(url).then(function() {
                    alert('Link berhasil disalin!');
                });
            }
        </script>
    @endpush

    <style>
        .content {
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .content p {
            margin-bottom: 1rem;
        }
    </style>
@endsection
