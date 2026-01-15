<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Santri;
use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LandingController extends Controller
{
    public function index()
    {
        // Get latest news (published only)
        $latestNews = Berita::published()->orderBy('published_at', 'desc')->limit(3)->get();

        // Get active announcements
        $announcements = Pengumuman::active()
            ->where(function ($q) {
                $q->whereNull('tanggal_mulai')->orWhere('tanggal_mulai', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('tanggal_selesai')->orWhere('tanggal_selesai', '>=', now());
            })
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Statistics
        $stats = [
            'total_santri' => Santri::where('is_active', 1)->count(),
            'total_guru' => Guru::where('is_active', 1)->count(),
            'total_kelas' => Kelas::where('is_active', 1)->count(),
        ];

        return view('landing.index', compact('latestNews', 'announcements', 'stats'));
    }

    public function about()
    {
        $stats = [
            'total_santri' => Santri::where('is_active', 1)->count(),
            'total_guru' => Guru::where('is_active', 1)->count(),
            'total_kelas' => Kelas::where('is_active', 1)->count(),
        ];

        return view('landing.about', compact('stats'));
    }

    public function contact()
    {
        return view('landing.contact');
    }

    public function contactSubmit(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'subject' => 'required|string',
                'message' => 'required|string',
            ],
            [
                'name.required' => 'Nama wajib diisi',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'phone.required' => 'Nomor telepon wajib diisi',
                'subject.required' => 'Topik wajib dipilih',
                'message.required' => 'Pesan wajib diisi',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // TODO: Send email or save to database
        // For now, just redirect with success message

        return redirect()->route('landing.contact')->with('success', 'Terima kasih! Pesan Anda telah terkirim. Kami akan segera menghubungi Anda.');
    }

    public function dataSantri(Request $request)
    {
        $totalSantri = Santri::where('is_active', 1)->count();
        $totalGuru = Guru::where('is_active', 1)->count();
        $totalKelas = Kelas::where('is_active', 1)->count();

        // Query santri dengan filter
        $query = Santri::where('is_active', 1)->with(['kelas.guru', 'orangTua']);

        // Filter by search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%");
        }

        // Filter by kelas
        if ($request->filled('kelas_id')) {
            $query->where('kelas_id', $request->kelas_id);
        }

        // Filter by jenis kelamin
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        $santris = $query->orderBy('nama', 'asc')->paginate(20);

        // Append query parameters to pagination
        $santris->appends($request->all());

        // Get kelas for filter dropdown
        $kelas = Kelas::where('is_active', 1)->withCount('santris')->with('guru')->orderBy('nama_kelas')->get();

        // Get guru for display
        $guru = Guru::where('is_active', 1)->orderBy('nama')->get();

        return view('landing.data-santri', compact('totalSantri', 'totalGuru', 'totalKelas', 'santris', 'kelas', 'guru'));
    }
}
