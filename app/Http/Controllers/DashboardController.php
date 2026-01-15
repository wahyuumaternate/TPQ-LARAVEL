<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Guru;
use App\Models\Orangtua;
use App\Models\Kelas;
use App\Models\ProgressSantri;
use App\Models\Absensi;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $stats = [
            'total_santri' => Santri::active()->count(),
            'total_guru' => Guru::active()->count(),
            'total_orangtua' => Orangtua::active()->count(),
            'total_kelas' => Kelas::active()->count(),
        ];

        // Santri by gender
        $santriByGender = Santri::active()
            ->select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')
            ->get()
            ->pluck('total', 'jenis_kelamin')
            ->toArray();

        // Santri by kelas
        $santriByKelas = Kelas::withCount(['santris' => function ($query) {
            $query->where('status', 'aktif');
        }])->active()->get();

        // Recent progress
        $recentProgress = ProgressSantri::with(['santri', 'guru'])
            ->latest('tanggal')
            ->take(10)
            ->get();

        // Today's attendance summary
        $todayAttendance = Absensi::whereDate('tanggal', today())
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get()
            ->pluck('total', 'status')
            ->toArray();

        // Active announcements
        $pengumumans = Pengumuman::current()
            ->orderBy('prioritas', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Monthly santri registration trend (last 6 months)
        $monthlyTrend = Santri::select(
                DB::raw('DATE_FORMAT(tanggal_masuk, "%Y-%m") as month'),
                DB::raw('count(*) as total')
            )
            ->where('tanggal_masuk', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('dashboard', compact(
            'stats',
            'santriByGender',
            'santriByKelas',
            'recentProgress',
            'todayAttendance',
            'pengumumans',
            'monthlyTrend'
        ));
    }
}
