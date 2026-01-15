@extends('layouts.app')

@section('title', 'Data Guru')

@section('content')
    <div class="container-fluid px-4 py-3">
        <!-- Header -->
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-1 text-dark fw-bold">
                    <i class="bi bi-person-badge text-primary"></i> Daftar Guru
                </h1>
                <p class="text-muted mb-0">Kelola data guru TPQ Khairunnisa</p>
            </div>
            <div>
                <button class="btn btn-outline-secondary me-2" onclick="window.print()">
                    <i class="bi bi-download"></i> Download
                </button>
                <a href="{{ route('guru.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Tambah Guru
                </a>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Filter -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-funnel text-primary"></i> Filter & Pencarian
                </h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('guru.index') }}" id="filterForm">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Kelas yang Diajar</label>
                            <select class="form-select" name="kelas_id">
                                <option value="">Semua Kelas</option>
                                @foreach ($kelasList as $kelas)
                                    <option value="{{ $kelas->id }}"
                                        {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                        {{ $kelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                            <select class="form-select" name="jenis_kelamin">
                                <option value="">Semua</option>
                                <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Status</label>
                            <select class="form-select" name="is_active">
                                <option value="">Semua</option>
                                <option value="1" {{ request('is_active', '1') == '1' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Tidak Aktif
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Cari</label>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                placeholder="Cari nama/ID guru...">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table View -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-table text-primary"></i> Daftar Guru
                </h5>
                <div class="d-flex align-items-center gap-2">
                    <label class="mb-0">Tampilkan:</label>
                    <select class="form-select form-select-sm" style="width: auto;" onchange="changePerPage(this)">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="8%">Foto</th>
                                <th width="10%">ID Guru</th>
                                <th width="20%">Nama</th>
                                <th width="8%">L/P</th>
                                <th width="8%">Usia</th>
                                <th width="12%">Pendidikan</th>
                                <th width="10%">Kelas</th>
                                <th width="10%">Nomor HP</th>
                                <th width="8%">Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($gurus as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $gurus->firstItem() + $index }}</td>
                                    <td class="text-center">
                                        <img src="{{ $item->foto ? asset('storage/' . $item->foto) : asset('images/default-avatar.png') }}"
                                            class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                                    </td>
                                    <td class="fw-semibold">{{ $item->no_id ?? '-' }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td class="text-center">
                                        <span
                                            class="badge {{ $item->jenis_kelamin === 'L' ? 'bg-primary' : 'bg-danger' }}">
                                            {{ $item->jenis_kelamin === 'L' ? 'L' : 'P' }}
                                        </span>
                                    </td>
                                    <td class="text-center">{{ $item->usia ?? '-' }} th</td>
                                    <td>{{ $item->pendidikan ?? '-' }}</td>
                                    <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                    <td>{{ $item->no_hp ?? '-' }}</td>
                                    <td class="text-center">
                                        @if ($item->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('guru.show', $item->id) }}"
                                                class="btn btn-sm btn-outline-info" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('guru.edit', $item->id) }}"
                                                class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('guru.destroy', $item->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $item->nama }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center py-4">
                                        <i class="bi bi-inbox fs-1 text-muted"></i>
                                        <p class="mb-0 mt-2 text-muted">Tidak ada data ditemukan</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Menampilkan {{ $gurus->firstItem() ?? 0 }} - {{ $gurus->lastItem() ?? 0 }} dari
                        {{ $gurus->total() }} data
                    </div>
                    <nav>
                        {{ $gurus->appends(request()->query())->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
            transition: background-color 0.2s ease;
        }

        .btn-group .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function changePerPage(select) {
            const form = document.getElementById('filterForm');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'per_page';
            input.value = select.value;
            form.appendChild(input);
            form.submit();
        }
    </script>
@endpush
