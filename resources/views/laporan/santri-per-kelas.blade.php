@extends('layouts.app')

@section('title', 'Laporan Santri Per Kelas')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Laporan Santri Per Kelas</h1>
                <p class="text-muted small mb-0">Data distribusi santri berdasarkan kelas</p>
            </div>
            <div>
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="bi bi-printer me-2"></i>Cetak Laporan
                </button>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Kelas
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_kelas'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-book-half fs-2 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Kelas Aktif
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_kelas_aktif'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-check-circle fs-2 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total Santri
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_santri'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-people fs-2 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Rata-rata Per Kelas
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($stats['rata_santri_per_kelas'], 1) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-graph-up fs-2 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Per Kelas -->
        @foreach ($kelas as $kelasItem)
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-0 font-weight-bold text-primary">
                                {{ $kelasItem->nama_kelas }}
                                <span class="badge bg-secondary">{{ $kelasItem->kode_kelas }}</span>
                            </h6>
                        </div>
                        <div class="col-auto">
                            <span class="badge bg-info">{{ $kelasItem->santris_count }} Santri</span>
                            @if ($kelasItem->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($kelasItem->santris->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="15%">No. Induk</th>
                                        <th width="30%">Nama Santri</th>
                                        <th width="15%">Jenis Kelamin</th>
                                        <th width="20%">Tempat, Tanggal Lahir</th>
                                        <th width="15%">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kelasItem->santris as $index => $santri)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $santri->no_induk }}</td>
                                            <td><strong>{{ $santri->nama }}</strong></td>
                                            <td>{{ $santri->jenis_kelamin }}</td>
                                            <td>{{ $santri->tempat_lahir }}, {{ $santri->tanggal_lahir_formatted }}</td>
                                            <td>
                                                @if ($santri->is_active)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-secondary">Tidak Aktif</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-1"></i>
                            <p class="mb-0">Belum ada santri di kelas ini</p>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <style>
        @media print {

            .sidebar,
            .navbar,
            .btn,
            .no-print {
                display: none !important;
            }

            .card {
                border: 1px solid #dee2e6 !important;
                page-break-inside: avoid;
            }
        }
    </style>
@endsection
