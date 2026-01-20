<?php

namespace App\Http\Controllers;

use App\Models\ProgressSantri;
use App\Models\Santri;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProgressSantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ProgressSantri::with(['santri', 'guru']);

        // Filter by santri
        if ($request->filled('santri_id')) {
            $query->where('santri_id', $request->santri_id);
        }

        // Filter by guru
        if ($request->filled('guru_id')) {
            $query->where('guru_id', $request->guru_id);
        }

        // Filter by jilid
        if ($request->filled('jilid')) {
            $query->where('jilid', $request->jilid);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by tanggal
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        // Filter hafalan
        if ($request->filled('hafalan')) {
            $query->where('hafalan', $request->hafalan);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('surah', 'like', "%{$search}%")
                    ->orWhere('halaman', 'like', "%{$search}%")
                    ->orWhere('catatan', 'like', "%{$search}%")
                    ->orWhereHas('santri', function ($sq) use ($search) {
                        $sq->where('nama', 'like', "%{$search}%");
                    });
            });
        }

        // Order by latest
        $progress = $query->orderBy('tanggal', 'desc')->orderBy('created_at', 'desc')->paginate(15);

        // Preserve query parameters
        $progress->appends($request->all());

        // Get data for filters
        $santris = Santri::where('is_active', 1)->orderBy('nama')->get();
        $gurus = Guru::where('is_active', 1)->orderBy('nama')->get();

        return view('progress-santri.index', compact('progress', 'santris', 'gurus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'santri_id' => 'required|exists:santris,id',
                'guru_id' => 'nullable|exists:gurus,id',
                'tanggal' => 'required|date',
                'jilid' => 'required|string|max:255',
                'halaman' => 'nullable|string|max:255',
                'dari_ayat' => 'nullable|string|max:255',
                'sampai_ayat' => 'nullable|string|max:255',
                'surah' => 'nullable|string|max:255',
                'status' => 'required|in:lancar,kurang_lancar,mengulang',
                'catatan' => 'nullable|string',
                'hafalan' => 'boolean',
                'hafalan_surah' => 'nullable|required_if:hafalan,1|string|max:255',
                'hafalan_ayat_dari' => 'nullable|integer|min:1',
                'hafalan_ayat_sampai' => 'nullable|integer|min:1|gte:hafalan_ayat_dari',
            ],
            [
                'santri_id.required' => 'Santri wajib dipilih',
                'santri_id.exists' => 'Santri tidak ditemukan',
                'tanggal.required' => 'Tanggal wajib diisi',
                'jilid.required' => 'Jilid wajib diisi',
                'status.required' => 'Status wajib dipilih',
                'hafalan_surah.required_if' => 'Surah hafalan wajib diisi jika ada hafalan',
                'hafalan_ayat_sampai.gte' => 'Ayat sampai harus lebih besar atau sama dengan ayat dari',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $request->all();
            $data['hafalan'] = $request->has('hafalan') ? 1 : 0;

            // Clear hafalan data if hafalan is false
            if (!$data['hafalan']) {
                $data['hafalan_surah'] = null;
                $data['hafalan_ayat_dari'] = null;
                $data['hafalan_ayat_sampai'] = null;
            }

            ProgressSantri::create($data);

            return redirect()->route('progress-santri.index')->with('success', 'Progress santri berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menambahkan progress: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgressSantri $progressSantri)
    {
        $progressSantri->load(['santri', 'guru']);
        return view('progress-santri.show', compact('progressSantri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgressSantri $progressSantri)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'santri_id' => 'required|exists:santris,id',
                'guru_id' => 'nullable|exists:gurus,id',
                'tanggal' => 'required|date',
                'jilid' => 'required|string|max:255',
                'halaman' => 'nullable|string|max:255',
                'dari_ayat' => 'nullable|string|max:255',
                'sampai_ayat' => 'nullable|string|max:255',
                'surah' => 'nullable|string|max:255',
                'status' => 'required|in:lancar,kurang_lancar,mengulang',
                'catatan' => 'nullable|string',
                'hafalan' => 'boolean',
                'hafalan_surah' => 'nullable|required_if:hafalan,1|string|max:255',
                'hafalan_ayat_dari' => 'nullable|integer|min:1',
                'hafalan_ayat_sampai' => 'nullable|integer|min:1|gte:hafalan_ayat_dari',
            ],
            [
                'santri_id.required' => 'Santri wajib dipilih',
                'tanggal.required' => 'Tanggal wajib diisi',
                'jilid.required' => 'Jilid wajib diisi',
                'status.required' => 'Status wajib dipilih',
                'hafalan_surah.required_if' => 'Surah hafalan wajib diisi jika ada hafalan',
                'hafalan_ayat_sampai.gte' => 'Ayat sampai harus lebih besar atau sama dengan ayat dari',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $request->all();
            $data['hafalan'] = $request->has('hafalan') ? 1 : 0;

            // Clear hafalan data if hafalan is false
            if (!$data['hafalan']) {
                $data['hafalan_surah'] = null;
                $data['hafalan_ayat_dari'] = null;
                $data['hafalan_ayat_sampai'] = null;
            }

            $progressSantri->update($data);

            return redirect()->route('progress-santri.index')->with('success', 'Progress santri berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal memperbarui progress: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgressSantri $progressSantri)
    {
        try {
            $progressSantri->delete();

            return redirect()->route('progress-santri.index')->with('success', 'Progress santri berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus progress: ' . $e->getMessage());
        }
    }

    /**
     * Get progress by santri for chart/report
     */
    public function getProgressBySantri(Request $request, $santriId)
    {
        $santri = Santri::findOrFail($santriId);

        $progress = ProgressSantri::where('santri_id', $santriId)->orderBy('tanggal', 'desc')->limit(10)->get();

        return response()->json([
            'santri' => $santri,
            'progress' => $progress,
        ]);
    }

    /**
     * Export progress report (PDF/Excel)
     */
    public function exportReport(Request $request)
    {
        // Implementation for export functionality
        // You can use libraries like Laravel Excel or DomPDF
    }
}
