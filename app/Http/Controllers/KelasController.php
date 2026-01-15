<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kelas::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_kelas', 'like', "%{$search}%")
                    ->orWhere('kode_kelas', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        // Hari filter
        if ($request->filled('hari')) {
            $query->where('hari', $request->hari);
        }

        // Paginate results
        $kelas = $query->orderBy('created_at', 'desc')->paginate(10);

        // Preserve query parameters in pagination
        $kelas->appends($request->all());

        return view('kelas.index', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_kelas' => 'required|string|max:255',
                'kode_kelas' => 'required|string|max:255|unique:kelas,kode_kelas',
                'deskripsi' => 'nullable|string',
                'hari' => 'nullable|string|max:255',
                'jam_mulai' => 'nullable|date_format:H:i',
                'jam_selesai' => 'nullable|date_format:H:i|after:jam_mulai',
                'is_active' => 'boolean',
            ],
            [
                'nama_kelas.required' => 'Nama kelas wajib diisi',
                'kode_kelas.required' => 'Kode kelas wajib diisi',
                'kode_kelas.unique' => 'Kode kelas sudah digunakan',
                'jam_mulai.date_format' => 'Format jam mulai tidak valid',
                'jam_selesai.date_format' => 'Format jam selesai tidak valid',
                'jam_selesai.after' => 'Jam selesai harus setelah jam mulai',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $request->all();
            $data['is_active'] = $request->has('is_active') ? 1 : 0;

            Kelas::create($data);

            return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menambahkan data kelas: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        return view('kelas.show', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_kelas' => 'required|string|max:255',
                'kode_kelas' => 'required|string|max:255|unique:kelas,kode_kelas,' . $kelas->id,
                'deskripsi' => 'nullable|string',
                'hari' => 'nullable|string|max:255',
                'jam_mulai' => 'nullable|date_format:H:i',
                'jam_selesai' => 'nullable|date_format:H:i|after:jam_mulai',
                'is_active' => 'boolean',
            ],
            [
                'nama_kelas.required' => 'Nama kelas wajib diisi',
                'kode_kelas.required' => 'Kode kelas wajib diisi',
                'kode_kelas.unique' => 'Kode kelas sudah digunakan',
                'jam_mulai.date_format' => 'Format jam mulai tidak valid',
                'jam_selesai.date_format' => 'Format jam selesai tidak valid',
                'jam_selesai.after' => 'Jam selesai harus setelah jam mulai',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $request->all();
            $data['is_active'] = $request->has('is_active') ? 1 : 0;

            $kelas->update($data);

            return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal memperbarui data kelas: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        try {
            // Check if kelas has related santris
            // Uncomment this if you have relationship with santris
            // if ($kelas->santris()->count() > 0) {
            //     return redirect()->back()
            //         ->with('error', 'Tidak dapat menghapus kelas yang masih memiliki santri terdaftar!');
            // }

            $kelas->delete();

            return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus data kelas: ' . $e->getMessage());
        }
    }

    /**
     * Toggle status kelas (aktif/non-aktif)
     */
    public function toggleStatus(Kelas $kelas)
    {
        try {
            $kelas->update([
                'is_active' => !$kelas->is_active,
            ]);

            $status = $kelas->is_active ? 'diaktifkan' : 'dinonaktifkan';

            return redirect()
                ->back()
                ->with('success', "Kelas berhasil {$status}!");
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal mengubah status kelas: ' . $e->getMessage());
        }
    }

    /**
     * Get kelas for AJAX request (optional)
     */
    public function getKelas(Request $request)
    {
        if ($request->ajax()) {
            $kelas = Kelas::where('is_active', 1)
                ->orderBy('nama_kelas', 'asc')
                ->get(['id', 'nama_kelas', 'kode_kelas']);

            return response()->json($kelas);
        }
    }
}
