<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Orangtua;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd('Santri index disabled for now');
        $query = Santri::with(['kelas', 'guru', 'orangtua', 'kelurahan.kecamatan']);

        // Filter by kelas
        if ($request->filled('kelas_id')) {
            $query->where('kelas_id', $request->kelas_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        } else {
            // Default filter to aktif
            $query->where('status', 'aktif');
        }

        // Filter by jenis kelamin
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Filter by kecamatan
        if ($request->filled('kecamatan_id')) {
            $query->byKecamatan($request->kecamatan_id);
        }

        // Filter by kelurahan
        if ($request->filled('kelurahan_id')) {
            $query->where('kelurahan_id', $request->kelurahan_id);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")->orWhere('no_id', 'like', "%{$search}%");
            });
        }

        // Pagination
        $perPage = $request->input('per_page', 25);
        $santris = $query->orderBy('nama')->paginate($perPage);

        // Statistics
        $stats = [
            'total' => Santri::count(),
            'aktif' => Santri::where('status', 'aktif')->count(),
            'lulus' => Santri::where('status', 'lulus')->count(),
            'laki' => Santri::where('jenis_kelamin', 'L')->count(),
            'perempuan' => Santri::where('jenis_kelamin', 'P')->count(),
        ];

        $kelasList = Kelas::query()
            ->when(method_exists(Kelas::class, 'scopeActive'), function ($q) {
                return $q->active();
            })
            ->orderBy('nama_kelas')
            ->get();

        $guruList = Guru::query()
            ->when(method_exists(Guru::class, 'scopeActive'), function ($q) {
                return $q->active();
            })
            ->orderBy('nama')
            ->get();

        $kecamatanList = Kecamatan::active()->orderBy('nama')->get();

        return view('santri.index', compact('santris', 'kelasList', 'guruList', 'kecamatanList', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelasList = Kelas::query()
            ->when(method_exists(Kelas::class, 'scopeActive'), function ($q) {
                return $q->active();
            })
            ->orderBy('nama_kelas')
            ->get();

        $guruList = Guru::query()
            ->when(method_exists(Guru::class, 'scopeActive'), function ($q) {
                return $q->active();
            })
            ->orderBy('nama')
            ->get();

        $orangtuaList = Orangtua::query()
            ->when(method_exists(Orangtua::class, 'scopeActive'), function ($q) {
                return $q->active();
            })
            ->orderBy('no_id')
            ->get();

        $kecamatanList = Kecamatan::active()->orderBy('nama')->get();

        return view('santri.create', compact('kelasList', 'guruList', 'orangtuaList', 'kecamatanList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:L,P',
                'tempat_lahir' => 'nullable|string|max:255',
                'tanggal_lahir' => 'nullable|date',
                'kelas_id' => 'nullable|exists:kelas,id',
                'guru_id' => 'nullable|exists:gurus,id',
                'orangtua_id' => 'nullable|exists:orangtuas,id',
                'kelurahan_id' => 'nullable|exists:kelurahans,id',
                'hubungan_wali' => 'nullable|string|max:100',
                'no_hp_wali' => 'nullable|string|max:20',
                'alamat' => 'nullable|string',
                'tanggal_masuk' => 'nullable|date',
                'status' => 'required|in:aktif,lulus,pindah,keluar',
                'catatan' => 'nullable|string',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Handle foto upload
            if ($request->hasFile('foto')) {
                $validated['foto'] = $request->file('foto')->store('santri', 'public');
            }

            // Set default tanggal_masuk if not provided
            if (empty($validated['tanggal_masuk'])) {
                $validated['tanggal_masuk'] = now();
            }

            $santri = Santri::create($validated);

            return redirect()
                ->route('santri.index')
                ->with('success', 'Data santri berhasil ditambahkan dengan No. ID: ' . $santri->no_id);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating santri: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Santri $santri)
    {
        $santri->load([
            'kelas',
            'guru',
            'orangtua',
            'kelurahan.kecamatan',
            'progressSantris' => function ($query) {
                $query->latest('tanggal')->take(20);
            },
            'absensis' => function ($query) {
                $query->latest('tanggal')->take(30);
            },
        ]);

        return view('santri.show', compact('santri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Santri $santri)
    {
        $santri->load(['kelas', 'guru', 'orangtua', 'kelurahan.kecamatan']);

        $kelasList = Kelas::query()
            ->when(method_exists(Kelas::class, 'scopeActive'), function ($q) {
                return $q->active();
            })
            ->orderBy('nama_kelas')
            ->get();

        $guruList = Guru::query()
            ->when(method_exists(Guru::class, 'scopeActive'), function ($q) {
                return $q->active();
            })
            ->orderBy('nama')
            ->get();

        $orangtuaList = Orangtua::query()
            ->when(method_exists(Orangtua::class, 'scopeActive'), function ($q) {
                return $q->active();
            })
            ->orderBy('no_id')
            ->get();

        $kecamatanList = Kecamatan::active()->orderBy('nama')->get();

        // Get kelurahan list for selected kecamatan
        $kelurahanList = collect();
        if ($santri->kelurahan_id) {
            $kelurahanList = Kelurahan::where('kecamatan_id', $santri->kelurahan->kecamatan_id)->active()->orderBy('nama')->get();
        }

        return view('santri.edit', compact('santri', 'kelasList', 'guruList', 'orangtuaList', 'kecamatanList', 'kelurahanList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Santri $santri)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:L,P',
                'tempat_lahir' => 'nullable|string|max:255',
                'tanggal_lahir' => 'nullable|date',
                'kelas_id' => 'nullable|exists:kelas,id',
                'guru_id' => 'nullable|exists:gurus,id',
                'orangtua_id' => 'nullable|exists:orangtuas,id',
                'kelurahan_id' => 'nullable|exists:kelurahans,id',
                'hubungan_wali' => 'nullable|string|max:100',
                'no_hp_wali' => 'nullable|string|max:20',
                'alamat' => 'nullable|string',
                'tanggal_masuk' => 'nullable|date',
                'status' => 'required|in:aktif,lulus,pindah,keluar',
                'catatan' => 'nullable|string',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Handle foto upload
            if ($request->hasFile('foto')) {
                // Delete old foto
                if ($santri->foto && Storage::disk('public')->exists($santri->foto)) {
                    Storage::disk('public')->delete($santri->foto);
                }
                $validated['foto'] = $request->file('foto')->store('santri', 'public');
            }

            $santri->update($validated);

            return redirect()->route('santri.index')->with('success', 'Data santri berhasil diperbarui');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating santri: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Santri $santri)
    {
        try {
            // Delete foto
            if ($santri->foto && Storage::disk('public')->exists($santri->foto)) {
                Storage::disk('public')->delete($santri->foto);
            }

            $santri->delete();

            return redirect()->route('santri.index')->with('success', 'Data santri berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting santri: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * Get kelurahan by kecamatan (AJAX)
     */
    public function getKelurahan(Request $request)
    {
        $kecamatanId = $request->kecamatan_id;

        $kelurahans = Kelurahan::where('kecamatan_id', $kecamatanId)
            ->active()
            ->orderBy('nama')
            ->get(['id', 'nama']);

        return response()->json($kelurahans);
    }

    /**
     * Export data to Excel
     */
    public function export(Request $request)
    {
        // Will implement with maatwebsite/excel
        return response()->json(['message' => 'Export feature coming soon']);
    }

    /**
     * Get santri statistics
     */
    public function statistics()
    {
        $stats = [
            'total' => Santri::count(),
            'aktif' => Santri::where('status', 'aktif')->count(),
            'lulus' => Santri::where('status', 'lulus')->count(),
            'laki' => Santri::where('jenis_kelamin', 'L')->count(),
            'perempuan' => Santri::where('jenis_kelamin', 'P')->count(),
        ];

        return response()->json($stats);
    }
}
