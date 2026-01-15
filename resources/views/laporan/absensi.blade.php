@extends('layouts.app')

@section('title', 'Laporan Absensi')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Laporan Absensi</h1>
                <p class="text-muted small mb-0">Monitoring kehadiran santri</p>
            </div>
            <div>
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="bi bi-printer me-2"></i>Cetak Laporan
                </button>
            </div>
        </div>

        <!-- Filter -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('laporan.absensi') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Bulan</label>
                            <select name="bulan" class="form-select">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Tahun</label>
                            <select name="tahun" class="form-select">
                                @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                                    <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Santri</label>
                            <select name="santri_id" class="form-select">
                                <option value="">Semua Santri</option>
                                @foreach ($santris as $santri)
                                    <option value="{{ $santri->id }}"
                                        {{ request('santri_id') == $santri->id ? 'selected' : '' }}>
                                        {{ $santri->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-search me-1"></i>Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Absensi
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $stats['total_absensi'] }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-calendar-check fs-2 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Hadir
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $stats['total_hadir'] }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-check-circle fs-2 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Izin
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $stats['total_izin'] }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-envelope fs-2 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Sakit
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $stats['total_sakit'] }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-bandaid fs-2 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Alpha
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $stats['total_alpha'] }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-x-circle fs-2 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    Persentase Hadir
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @if ($stats['total_absensi'] > 0)
                                        {{ number_format(($stats['total_hadir'] / $stats['total_absensi']) * 100, 1) }}%
                                    @else
                                        0%
                                    @endif
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-percent fs-2 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Kehadiran</h6>
            </div>
            <div class="card-body">
                <canvas id="absensiChart" height="80"></canvas>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Data Absensi - {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
                    {{ $tahun }}
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="12%">Tanggal</th>
                                <th width="20%">Santri</th>
                                <th width="15%">Kelas</th>
                                <th width="10%">Status</th>
                                <th width="38%">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($absensi as $index => $item)
                                <tr>
                                    <td>{{ $absensi->firstItem() + $index }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                    <td><strong>{{ $item->santri->nama ?? '-' }}</strong></td>
                                    <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                    <td>
                                        @if ($item->status == 'hadir')
                                            <span class="badge bg-success">Hadir</span>
                                        @elseif($item->status == 'izin')
                                            <span class="badge bg-info">Izin</span>
                                        @elseif($item->status == 'sakit')
                                            <span class="badge bg-warning">Sakit</span>
                                        @else
                                            <span class="badge bg-danger">Alpha</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="bi bi-inbox fs-1 text-muted"></i>
                                        <p class="text-muted mb-0">Tidak ada data absensi</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($absensi->hasPages())
                    <div class="mt-3">
                        {{ $absensi->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('absensiChart');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Hadir', 'Izin', 'Sakit', 'Alpha'],
                    datasets: [{
                        data: [
                            {{ $stats['total_hadir'] }},
                            {{ $stats['total_izin'] }},
                            {{ $stats['total_sakit'] }},
                            {{ $stats['total_alpha'] }}
                        ],
                        backgroundColor: [
                            'rgba(40, 167, 69, 0.8)',
                            'rgba(23, 162, 184, 0.8)',
                            'rgba(255, 193, 7, 0.8)',
                            'rgba(220, 53, 69, 0.8)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        title: {
                            display: true,
                            text: 'Distribusi Kehadiran'
                        }
                    }
                }
            });
        </script>
    @endpush

    <style>
        @media print {

            .sidebar,
            .navbar,
            .btn,
            .no-print {
                display: none !important;
            }
        }
    </style>
@endsection
