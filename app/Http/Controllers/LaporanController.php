<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Kelas;
use App\Models\ProgressSantri;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Laporan Santri Per Kelas
     */
    public function santriPerKelas(Request $request)
    {
        $query = Kelas::withCount([
            'santris' => function ($q) {
                $q->where('is_active', 1);
            },
        ])->with([
            'santris' => function ($q) {
                $q->where('is_active', 1)->orderBy('nama');
            },
        ]);

        // Filter by status
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $kelas = $query->orderBy('nama_kelas')->get();

        // Statistics
        $stats = [
            'total_kelas' => Kelas::count(),
            'total_kelas_aktif' => Kelas::where('is_active', 1)->count(),
            'total_santri' => Santri::where('is_active', 1)->count(),
            'rata_santri_per_kelas' => Kelas::withCount([
                'santris' => function ($q) {
                    $q->where('is_active', 1);
                },
            ])
                ->get()
                ->avg('santris_count'),
        ];

        return view('laporan.santri-per-kelas', compact('kelas', 'stats'));
    }

    /**
     * Laporan Progress Bulanan
     */
    public function progressBulanan(Request $request)
    {
        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);
        $santri_id = $request->input('santri_id');
        $jilid = $request->input('jilid');

        $query = ProgressSantri::with(['santri', 'guru'])
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun);

        if ($santri_id) {
            $query->where('santri_id', $santri_id);
        }

        if ($jilid) {
            $query->where('jilid', $jilid);
        }

        $progress = $query->orderBy('tanggal', 'desc')->paginate(20);

        // Statistics
        $stats = [
            'total_progress' => ProgressSantri::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->count(),
            'total_hafalan' => ProgressSantri::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->where('hafalan', true)->count(),
            'santri_aktif' => ProgressSantri::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->distinct('santri_id')->count('santri_id'),
            'distribusi_nilai' => ProgressSantri::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->whereNotNull('nilai')->select('nilai', DB::raw('count(*) as total'))->groupBy('nilai')->pluck('total', 'nilai'),
        ];

        // Get santris for filter
        $santris = Santri::where('is_active', 1)->orderBy('nama')->get();

        // Get jilids for filter
        $jilids = ['Iqra 1', 'Iqra 2', 'Iqra 3', 'Iqra 4', 'Iqra 5', 'Iqra 6', 'Al-Quran'];

        return view('laporan.progress-bulanan', compact('progress', 'stats', 'bulan', 'tahun', 'santris', 'jilids'));
    }

    /**
     * Laporan Absensi
     */
    public function absensi(Request $request)
    {
        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);
        $santri_id = $request->input('santri_id');

        $query = Absensi::with(['santri', 'kelas'])
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun);

        if ($santri_id) {
            $query->where('santri_id', $santri_id);
        }

        $absensi = $query->orderBy('tanggal', 'desc')->paginate(20);

        // Statistics
        $stats = [
            'total_hadir' => Absensi::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->where('status', 'hadir')->count(),
            'total_izin' => Absensi::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->where('status', 'izin')->count(),
            'total_sakit' => Absensi::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->where('status', 'sakit')->count(),
            'total_alpha' => Absensi::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->where('status', 'alpha')->count(),
        ];

        $stats['total_absensi'] = $stats['total_hadir'] + $stats['total_izin'] + $stats['total_sakit'] + $stats['total_alpha'];

        // Get santris for filter
        $santris = Santri::where('is_active', 1)->orderBy('nama')->get();

        return view('laporan.absensi', compact('absensi', 'stats', 'bulan', 'tahun', 'santris'));
    }

    /**
     * Statistik Umum
     */
    public function statistik(Request $request)
    {
        $tahun = $request->input('tahun', Carbon::now()->year);

        // Statistik Santri
        $santriStats = [
            'total_santri' => Santri::count(),
            'santri_aktif' => Santri::where('is_active', 1)->count(),
            'santri_laki' => Santri::where('jenis_kelamin', 'Laki-laki')->count(),
            'santri_perempuan' => Santri::where('jenis_kelamin', 'Perempuan')->count(),
            'santri_per_bulan' => Santri::whereYear('created_at', $tahun)->select(DB::raw('MONTH(created_at) as bulan'), DB::raw('COUNT(*) as total'))->groupBy('bulan')->pluck('total', 'bulan'),
        ];

        // Statistik Progress
        $progressStats = [
            'total_progress' => ProgressSantri::whereYear('tanggal', $tahun)->count(),
            'total_hafalan' => ProgressSantri::whereYear('tanggal', $tahun)->where('hafalan', true)->count(),
            'progress_per_jilid' => ProgressSantri::whereYear('tanggal', $tahun)->select('jilid', DB::raw('COUNT(*) as total'))->groupBy('jilid')->pluck('total', 'jilid'),
            'progress_per_bulan' => ProgressSantri::whereYear('tanggal', $tahun)->select(DB::raw('MONTH(tanggal) as bulan'), DB::raw('COUNT(*) as total'))->groupBy('bulan')->pluck('total', 'bulan'),
        ];

        // Statistik Kelas
        $kelasStats = [
            'total_kelas' => Kelas::count(),
            'kelas_aktif' => Kelas::where('is_active', 1)->count(),
            'santri_per_kelas' => Kelas::withCount([
                'santris' => function ($q) {
                    $q->where('is_active', 1);
                },
            ])
                ->get()
                ->pluck('santris_count', 'nama_kelas'),
        ];

        // Statistik Absensi (jika ada)
        $absensiStats = [
            'total_kehadiran' => Absensi::whereYear('tanggal', $tahun)->where('status', 'hadir')->count(),
            'tingkat_kehadiran' => $this->calculateAttendanceRate($tahun),
        ];

        // Top Santri (berdasarkan jumlah progress)
        $topSantri = ProgressSantri::whereYear('tanggal', $tahun)->select('santri_id', DB::raw('COUNT(*) as total_progress'))->groupBy('santri_id')->orderBy('total_progress', 'desc')->with('santri')->limit(10)->get();

        return view('laporan.statistik', compact('santriStats', 'progressStats', 'kelasStats', 'absensiStats', 'topSantri', 'tahun'));
    }

    /**
     * Calculate attendance rate
     */
    private function calculateAttendanceRate($tahun)
    {
        $totalAbsensi = Absensi::whereYear('tanggal', $tahun)->count();

        if ($totalAbsensi == 0) {
            return 0;
        }

        $totalHadir = Absensi::whereYear('tanggal', $tahun)->where('status', 'hadir')->count();

        return round(($totalHadir / $totalAbsensi) * 100, 2);
    }

    /**
     * Export Laporan (placeholder for future implementation)
     */
    public function export(Request $request)
    {
        $type = $request->input('type'); // santri-per-kelas, progress-bulanan, etc

        // Implementation with Laravel Excel or PDF library
        return redirect()->back()->with('info', 'Fitur export sedang dalam pengembangan');
    }
}
