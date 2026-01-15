@extends('layouts.app')

@section('title', 'Data Santri')

@section('content')
    <div class="container-fluid px-4 py-3">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1 text-dark fw-bold">
                    <i class="bi bi-people-fill text-primary"></i> Manajemen Data Santri
                </h1>
                <p class="text-muted mb-0">Kelola data santri TPQ Khairunnisa</p>
            </div>
            <a href="{{ route('santri.create') }}" class="btn btn-primary btn-lg shadow-sm">
                <i class="bi bi-plus-circle"></i> Tambah Santri
            </a>
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

        

        <!-- Filter Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-funnel text-primary"></i> Filter & Pencarian
                </h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('santri.index') }}" id="filterForm">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-book"></i> Kelas/Jilid
                            </label>
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
                            <label class="form-label fw-semibold">
                                <i class="bi bi-gender-ambiguous"></i> Jenis Kelamin
                            </label>
                            <select class="form-select" name="jenis_kelamin">
                                <option value="">Semua</option>
                                <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-info-circle"></i> Status
                            </label>
                            <select class="form-select" name="status">
                                <option value="">Semua</option>
                                <option value="aktif" {{ request('status', 'aktif') == 'aktif' ? 'selected' : '' }}>
                                    Aktif</option>
                                <option value="lulus" {{ request('status') == 'lulus' ? 'selected' : '' }}>Lulus
                                </option>
                                <option value="pindah" {{ request('status') == 'pindah' ? 'selected' : '' }}>Pindah
                                </option>
                                <option value="keluar" {{ request('status') == 'keluar' ? 'selected' : '' }}>Keluar
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-search"></i> Cari
                            </label>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                placeholder="Cari nama/no ID...">
                        </div>
                        <div class="col-md-2 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                            <a href="{{ route('santri.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-clockwise"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-table text-primary"></i> Daftar Santri
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
                                <th width="10%">No. ID</th>
                                <th width="18%">Nama</th>
                                <th width="5%">JK</th>
                                <th width="7%">Usia</th>
                                <th width="10%">Kelas</th>
                                <th width="12%">Guru</th>
                                <th width="10%">Kontak Wali</th>
                                <th width="8%">Status</th>
                                <th width="12%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($santris as $index => $santri)
                                <tr>
                                    <td class="text-center">{{ $santris->firstItem() + $index }}</td>
                                    <td class="text-center">
                                        <img src="{{ $santri->foto ? asset('storage/' . $santri->foto) : asset('images/default-avatar.png') }}"
                                            class="rounded-circle" width="40" height="40"
                                            style="object-fit: cover;">
                                    </td>
                                    <td class="fw-semibold">{{ $santri->no_id ?? '-' }}</td>
                                    <td>{{ $santri->nama }}</td>
                                    <td class="text-center">
                                        <span
                                            class="badge {{ $santri->jenis_kelamin === 'L' ? 'bg-primary' : 'bg-danger' }}">
                                            {{ $santri->jenis_kelamin }}
                                        </span>
                                    </td>
                                    <td class="text-center">{{ $santri->calculated_usia ?? '-' }} th</td>
                                    <td class="text-center">
                                        @if ($santri->kelas)
                                            <span class="badge bg-primary">{{ $santri->kelas->nama_kelas }}</span>
                                        @else
                                            <span class="badge bg-secondary">Belum Ada</span>
                                        @endif
                                    </td>
                                    <td>{{ $santri->guru->nama ?? '-' }}</td>
                                    <td>{{ $santri->no_hp_wali ?? '-' }}</td>
                                    <td class="text-center">
                                        @php
                                            $statusBadges = [
                                                'aktif' => 'bg-success',
                                                'lulus' => 'bg-info',
                                                'pindah' => 'bg-warning',
                                                'keluar' => 'bg-secondary',
                                            ];
                                        @endphp
                                        <span class="badge {{ $statusBadges[$santri->status] ?? 'bg-secondary' }}">
                                            {{ ucfirst($santri->status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('santri.show', $santri->id) }}"
                                                class="btn btn-sm btn-outline-info" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('santri.edit', $santri->id) }}"
                                                class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('santri.destroy', $santri->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $santri->nama }}?')">
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
                        Menampilkan {{ $santris->firstItem() ?? 0 }} - {{ $santris->lastItem() ?? 0 }} dari
                        {{ $santris->total() }} data
                    </div>
                    <nav>
                        {{ $santris->appends(request()->query())->links() }}
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

        .avatar-sm {
            width: 40px;
            height: 40px;
            object-fit: cover;
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
