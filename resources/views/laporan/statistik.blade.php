@extends('layouts.app')

@section('title', 'Statistik')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Statistik Umum</h1>
                <p class="text-muted small mb-0">Dashboard statistik dan analisis data</p>
            </div>
            <div>
                <form method="GET" class="d-inline">
                    <select name="tahun" class="form-select d-inline-block w-auto" onchange="this.form.submit()">
                        @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                            <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>
                                Tahun {{ $i }}
                            </option>
                        @endfor
                    </select>
                </form>
                <button onclick="window.print()" class="btn btn-primary ms-2">
                    <i class="bi bi-printer me-2"></i>Cetak
                </button>
            </div>
        </div>

        <!-- Statistik Santri -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white py-3">
                <h6 class="m-0 font-weight-bold">
                    <i class="bi bi-people me-2"></i>Statistik Santri
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Santri
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $santriStats['total_santri'] }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-people-fill fs-2 text-gray-300"></i>
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
                                            Santri Aktif
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $santriStats['santri_aktif'] }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-check-circle-fill fs-2 text-gray-300"></i>
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
                                            Laki-laki
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $santriStats['santri_laki'] }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-gender-male fs-2 text-gray-300"></i>
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
                                            Perempuan
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $santriStats['santri_perempuan'] }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-gender-female fs-2 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chart Santri Per Bulan -->
                <div class="mt-3">
                    <h6 class="font-weight-bold">Pendaftaran Santri Per Bulan ({{ $tahun }})</h6>
                    <canvas id="santriPerBulanChart" height="80"></canvas>
                </div>
            </div>
        </div>

        <!-- Statistik Progress -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white py-3">
                <h6 class="m-0 font-weight-bold">
                    <i class="bi bi-graph-up me-2"></i>Statistik Progress Pembelajaran
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total Progress ({{ $tahun }})
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $progressStats['total_progress'] }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-clipboard-check fs-2 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Total Hafalan ({{ $tahun }})
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $progressStats['total_hafalan'] }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-star-fill fs-2 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h6 class="font-weight-bold">Progress Per Jilid</h6>
                        <canvas id="progressPerJilidChart" height="200"></canvas>
                    </div>
                    <div class="col-md-6">
                        <h6 class="font-weight-bold">Progress Per Bulan ({{ $tahun }})</h6>
                        <canvas id="progressPerBulanChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Kelas -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-info text-white py-3">
                <h6 class="m-0 font-weight-bold">
                    <i class="bi bi-book me-2"></i>Statistik Kelas
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Total Kelas
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $kelasStats['total_kelas'] }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-book-half fs-2 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Kelas Aktif
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $kelasStats['kelas_aktif'] }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-check2-square fs-2 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h6 class="font-weight-bold">Distribusi Santri Per Kelas</h6>
                <canvas id="santriPerKelasChart" height="100"></canvas>
            </div>
        </div>

        <!-- Statistik Absensi -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-warning text-white py-3">
                <h6 class="m-0 font-weight-bold">
                    <i class="bi bi-calendar-check me-2"></i>Statistik Absensi
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total Kehadiran ({{ $tahun }})
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $absensiStats['total_kehadiran'] }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-person-check fs-2 text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Tingkat Kehadiran
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $absensiStats['tingkat_kehadiran'] }}%
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
            </div>
        </div>

        <!-- Top Santri -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-secondary text-white py-3">
                <h6 class="m-0 font-weight-bold">
                    <i class="bi bi-trophy me-2"></i>Top 10 Santri Paling Aktif ({{ $tahun }})
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="10%">Ranking</th>
                                <th width="20%">No. Induk</th>
                                <th width="40%">Nama Santri</th>
                                <th width="30%">Total Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($topSantri as $index => $item)
                                <tr>
                                    <td class="text-center">
                                        @if ($index == 0)
                                            <span class="badge bg-warning"><i class="bi bi-trophy-fill"></i>
                                                #{{ $index + 1 }}</span>
                                        @elseif($index == 1)
                                            <span class="badge bg-secondary"><i class="bi bi-trophy-fill"></i>
                                                #{{ $index + 1 }}</span>
                                        @elseif($index == 2)
                                            <span class="badge bg-danger"><i class="bi bi-trophy-fill"></i>
                                                #{{ $index + 1 }}</span>
                                        @else
                                            <span class="badge bg-info">#{{ $index + 1 }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->santri->no_induk ?? '-' }}</td>
                                    <td><strong>{{ $item->santri->nama ?? '-' }}</strong></td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: {{ ($item->total_progress / $topSantri->max('total_progress')) * 100 }}%">
                                                {{ $item->total_progress }} progress
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <i class="bi bi-inbox fs-1 text-muted"></i>
                                        <p class="text-muted mb-0">Belum ada data progress</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Chart Santri Per Bulan
            const ctxSantriPerBulan = document.getElementById('santriPerBulanChart');
            new Chart(ctxSantriPerBulan, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Oct', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Pendaftaran Santri',
                        data: [
                            @for ($i = 1; $i <= 12; $i++)
                                {{ $santriStats['santri_per_bulan'][$i] ?? 0 }},
                            @endfor
                        ],
                        borderColor: 'rgb(75, 192, 192)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Chart Progress Per Jilid
            const ctxProgressPerJilid = document.getElementById('progressPerJilidChart');
            new Chart(ctxProgressPerJilid, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($progressStats['progress_per_jilid']->keys()) !!},
                    datasets: [{
                        label: 'Progress',
                        data: {!! json_encode($progressStats['progress_per_jilid']->values()) !!},
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)',
                            'rgba(255, 159, 64, 0.8)',
                            'rgba(199, 199, 199, 0.8)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Chart Progress Per Bulan
            const ctxProgressPerBulan = document.getElementById('progressPerBulanChart');
            new Chart(ctxProgressPerBulan, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Oct', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Progress',
                        data: [
                            @for ($i = 1; $i <= 12; $i++)
                                {{ $progressStats['progress_per_bulan'][$i] ?? 0 }},
                            @endfor
                        ],
                        borderColor: 'rgb(54, 162, 235)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Chart Santri Per Kelas
            const ctxSantriPerKelas = document.getElementById('santriPerKelasChart');
            new Chart(ctxSantriPerKelas, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($kelasStats['santri_per_kelas']->keys()) !!},
                    datasets: [{
                        label: 'Jumlah Santri',
                        data: {!! json_encode($kelasStats['santri_per_kelas']->values()) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.8)'
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
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
            .no-print,
            form {
                display: none !important;
            }

            .card {
                page-break-inside: avoid;
            }
        }

        .border-left-primary {
            border-left: 0.25rem solid #4e73df !important;
        }

        .border-left-success {
            border-left: 0.25rem solid #1cc88a !important;
        }

        .border-left-info {
            border-left: 0.25rem solid #36b9cc !important;
        }

        .border-left-warning {
            border-left: 0.25rem solid #f6c23e !important;
        }

        .border-left-danger {
            border-left: 0.25rem solid #e74a3b !important;
        }

        .border-left-secondary {
            border-left: 0.25rem solid #858796 !important;
        }
    </style>
@endsection
