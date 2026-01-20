@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle"><i class="bi bi-house-door"></i> Dashboard</h1>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted">Total Santri</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="bi bi-people fs-1"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 display-5">{{ $stats['total_santri'] ?? 0 }}</h1>
                    <div class="mb-0">
                        <span class="badge bg-success-subtle text-success me-2">
                            <i class="bi bi-person"></i> L: {{ $santriByGender['L'] ?? 0 }}
                        </span>
                        <span class="badge bg-danger-subtle text-danger">
                            <i class="bi bi-person"></i> P: {{ $santriByGender['P'] ?? 0 }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted">Total Guru</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-success">
                                <i class="bi bi-person-badge fs-1"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 display-5">{{ $stats['total_guru'] ?? 0 }}</h1>
                    <div class="mb-0">
                        <span class="text-muted">Ustadz & Ustadzah</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted">Total Orangtua</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-warning">
                                <i class="bi bi-people-fill fs-1"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 display-5">{{ $stats['total_orangtua'] ?? 0 }}</h1>
                    <div class="mb-0">
                        <span class="text-muted">Wali Santri</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title text-muted">Total Kelas</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-info">
                                <i class="bi bi-collection fs-1"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3 display-5">{{ $stats['total_kelas'] ?? 0 }}</h1>
                    <div class="mb-0">
                        <span class="text-muted">Iqra & Al-Quran</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Santri per Kelas Chart -->
        <div class="col-xl-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-bar-chart-fill text-primary"></i> Santri per Kelas
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="santriByKelasChart" height="300"></canvas>
                </div>
            </div>
        </div>


    </div>

    <div class="row">
        <!-- Recent Progress -->
        <div class="col-xl-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-graph-up text-info"></i> Progress Terbaru
                    </h5>
                    <a href="{{ route('progress-santri.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Santri</th>
                                    <th>Jilid</th>
                                    <th>Halaman</th>
                                    <th>Status</th>
                                    <th>Guru</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentProgress ?? [] as $progress)
                                    <tr>
                                        <td>{{ $progress->tanggal ? $progress->tanggal->format('d/m/Y') : '-' }}</td>
                                        <td>{{ $progress->santri->nama ?? '-' }}</td>
                                        <td>{{ $progress->jilid ?? '-' }}</td>
                                        <td>{{ $progress->halaman ?? '-' }}</td>
                                        <td>
                                            @if ($progress && method_exists($progress, 'getStatusBadgeClassAttribute'))
                                                <span class="badge {{ $progress->status_badge_class }}">
                                                    {{ $progress->status_label }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $progress->guru->nama ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Belum ada data progress</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Santri by Kelas Chart
            const santriByKelasCtx = document.getElementById('santriByKelasChart');
            if (santriByKelasCtx) {
                const santriByKelasData = {!! json_encode($santriByKelas ?? collect()) !!};

                new Chart(santriByKelasCtx.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: santriByKelasData.map(item => item.nama_kelas || 'Unknown'),
                        datasets: [{
                            label: 'Jumlah Santri',
                            data: santriByKelasData.map(item => item.santris_count || 0),
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.8)',
                                'rgba(75, 192, 192, 0.8)',
                                'rgba(255, 206, 86, 0.8)',
                                'rgba(255, 99, 132, 0.8)',
                                'rgba(153, 102, 255, 0.8)',
                                'rgba(255, 159, 64, 0.8)',
                                'rgba(199, 199, 199, 0.8)',
                                'rgba(83, 102, 255, 0.8)',
                            ],
                            borderRadius: 5,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            }

            // Attendance Chart
            const attendanceCtx = document.getElementById('attendanceChart');
            if (attendanceCtx) {
                const attendanceData = {!! json_encode($todayAttendance ?? []) !!};

                new Chart(attendanceCtx.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Hadir', 'Izin', 'Sakit', 'Alpha'],
                        datasets: [{
                            data: [
                                attendanceData.hadir || 0,
                                attendanceData.izin || 0,
                                attendanceData.sakit || 0,
                                attendanceData.alpha || 0
                            ],
                            backgroundColor: [
                                'rgba(40, 167, 69, 0.8)',
                                'rgba(23, 162, 184, 0.8)',
                                'rgba(255, 193, 7, 0.8)',
                                'rgba(220, 53, 69, 0.8)'
                            ],
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush
