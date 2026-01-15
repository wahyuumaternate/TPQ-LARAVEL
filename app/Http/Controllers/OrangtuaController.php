<?php

namespace App\Http\Controllers;

use App\Models\Orangtua;
use App\Models\User;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class OrangtuaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Orangtua::with(['user', 'santris', 'kelurahan.kecamatan']);

        // Filter berdasarkan status
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        // Filter berdasarkan status anak
        if ($request->filled('status_anak')) {
            $query->where('status_anak', $request->status_anak);
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
                $q->where('no_id', 'like', "%{$search}%")
                    ->orWhere('nama_ayah', 'like', "%{$search}%")
                    ->orWhere('nama_ibu', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $orangtuas = $query->latest()->paginate(25)->withQueryString();

        $kecamatanList = Kecamatan::active()->orderBy('nama')->get();

        return view('orangtua.index', compact('orangtuas', 'kecamatanList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kecamatanList = Kecamatan::active()->orderBy('nama')->get();

        return view('orangtua.create', compact('kecamatanList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'status_ayah' => 'required|in:Hidup,Wafat',
            'status_ibu' => 'required|in:Hidup,Wafat',
            'status_anak' => 'required|in:Dalam Asuhan OT,Anak Yatim,Anak Piatu,Anak Yatim Piatu',
            'no_hp' => 'nullable|string|max:20',
            'no_hp_alternatif' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'nullable|string',
            'kelurahan_id' => 'nullable|exists:kelurahans,id',
            'kode_pos' => 'nullable|string|max:10',
            'is_active' => 'nullable|boolean',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'create_account' => 'nullable|boolean',
        ]);

        // Set default value untuk is_active jika tidak ada
        $validated['is_active'] = $request->has('is_active') ? $request->is_active : true;

        // Validasi minimal nama ayah atau ibu harus diisi
        if (empty($validated['nama_ayah']) && empty($validated['nama_ibu'])) {
            return redirect()
                ->back()
                ->withErrors(['nama' => 'Minimal nama ayah atau nama ibu harus diisi'])
                ->withInput();
        }

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('orangtua', 'public');
        }

        // Buat akun user jika diminta
        if ($request->has('create_account') && $request->create_account && !empty($validated['email'])) {
            try {
                $user = User::create([
                    'name' => $validated['nama_ayah'] ?? $validated['nama_ibu'],
                    'email' => $validated['email'],
                    'password' => Hash::make('password123'),
                    'role' => 'orangtua',
                ]);
                $validated['user_id'] = $user->id;
            } catch (\Exception $e) {
                return redirect()
                    ->back()
                    ->withErrors(['email' => 'Email sudah terdaftar atau terjadi kesalahan'])
                    ->withInput();
            }
        }

        // Hapus field yang tidak ada di tabel
        unset($validated['create_account']);

        // Simpan data orangtua
        $orangtua = Orangtua::create($validated);

        return redirect()->route('orangtua.index')->with('success', 'Data orang tua berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Orangtua $orangtua)
    {
        $orangtua->load(['user', 'santris', 'kelurahan.kecamatan']);

        return view('orangtua.show', compact('orangtua'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orangtua $orangtua)
    {
        $orangtua->load(['user', 'santris', 'kelurahan.kecamatan']);

        $kecamatanList = Kecamatan::active()->orderBy('nama')->get();

        // Get kelurahan list for selected kecamatan
        $kelurahanList = collect();
        if ($orangtua->kelurahan_id) {
            $kelurahanList = Kelurahan::where('kecamatan_id', $orangtua->kelurahan->kecamatan_id)->active()->orderBy('nama')->get();
        }

        return view('orangtua.edit', compact('orangtua', 'kecamatanList', 'kelurahanList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orangtua $orangtua)
    {
        $validated = $request->validate([
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'status_ayah' => 'required|in:Hidup,Wafat',
            'status_ibu' => 'required|in:Hidup,Wafat',
            'status_anak' => 'required|in:Dalam Asuhan OT,Anak Yatim,Anak Piatu,Anak Yatim Piatu',
            'no_hp' => 'nullable|string|max:20',
            'no_hp_alternatif' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'nullable|string',
            'kelurahan_id' => 'nullable|exists:kelurahans,id',
            'kode_pos' => 'nullable|string|max:10',
            'is_active' => 'nullable|boolean',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Set default value untuk is_active jika tidak ada
        $validated['is_active'] = $request->has('is_active') ? $request->is_active : $orangtua->is_active;

        // Validasi minimal nama ayah atau ibu harus diisi
        if (empty($validated['nama_ayah']) && empty($validated['nama_ibu'])) {
            return redirect()
                ->back()
                ->withErrors(['nama' => 'Minimal nama ayah atau nama ibu harus diisi'])
                ->withInput();
        }

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($orangtua->foto) {
                Storage::disk('public')->delete($orangtua->foto);
            }
            $validated['foto'] = $request->file('foto')->store('orangtua', 'public');
        }

        // Update data
        $orangtua->update($validated);

        return redirect()->route('orangtua.index')->with('success', 'Data orang tua berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orangtua $orangtua)
    {
        try {
            // Hapus foto jika ada
            if ($orangtua->foto) {
                Storage::disk('public')->delete($orangtua->foto);
            }

            // Hapus user jika ada
            if ($orangtua->user) {
                $orangtua->user->delete();
            }

            // Hapus data orangtua
            $orangtua->delete();

            return redirect()->route('orangtua.index')->with('success', 'Data orang tua berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()
                ->route('orangtua.index')
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
     * Get orangtua list for select options (untuk form lain)
     */
    public function list(Request $request)
    {
        $query = Orangtua::where('is_active', true)->select('id', 'no_id', 'nama_ayah', 'nama_ibu', 'status_ayah', 'status_ibu', 'status_anak', 'no_hp', 'alamat', 'kelurahan_id');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_ayah', 'like', '%' . $search . '%')->orWhere('nama_ibu', 'like', '%' . $search . '%');
            });
        }

        $orangtuas = $query->with('kelurahan.kecamatan')->orderBy('nama_ayah')->limit(20)->get();

        return response()->json($orangtuas);
    }
}
