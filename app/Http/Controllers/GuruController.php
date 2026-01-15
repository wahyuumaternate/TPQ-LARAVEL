<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Guru::with(['kelas', 'user']);

        // Filter by kelas
        if ($request->filled('kelas_id')) {
            $query->where('kelas_id', $request->kelas_id);
        }

        // Filter by jenis kelamin
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Filter by status
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        } else {
            // Default filter to active
            $query->where('is_active', 1);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('no_id', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Pagination
        $perPage = $request->input('per_page', 25);
        $gurus = $query->orderBy('nama')->paginate($perPage);

        $kelasList = Kelas::active()->orderBy('nama_kelas')->get();

        return view('guru.index', compact('gurus', 'kelasList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelasList = Kelas::active()->orderBy('nama_kelas')->get();
        return view('guru.create', compact('kelasList'));
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
                'pendidikan' => 'nullable|string|max:255',
                'jurusan' => 'nullable|string|max:255',
                'alamat' => 'nullable|string',
                'kelurahan' => 'nullable|string|max:255',
                'kecamatan' => 'nullable|string|max:255',
                'kota' => 'nullable|string|max:255',
                'no_hp' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255|unique:gurus,email',
                'kelas_id' => 'nullable|exists:kelas,id',
                'tanggal_bergabung' => 'nullable|date',
                'is_active' => 'boolean',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'create_account' => 'boolean',
            ]);

            // Handle foto upload
            if ($request->hasFile('foto')) {
                $validated['foto'] = $request->file('foto')->store('guru', 'public');
            }

            // Set is_active default
            if (!isset($validated['is_active'])) {
                $validated['is_active'] = false;
            }

            // Create user account if requested
            if ($request->boolean('create_account') && !empty($validated['email'])) {
                $user = User::create([
                    'name' => $validated['nama'],
                    'email' => $validated['email'],
                    'password' => Hash::make('password123'), // Default password
                    'role' => 'guru',
                ]);
                $validated['user_id'] = $user->id;
            }

            unset($validated['create_account']);
            $guru = Guru::create($validated);

            return redirect()
                ->route('guru.index')
                ->with('success', 'Data guru berhasil ditambahkan dengan No. ID: ' . $guru->no_id);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating guru: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        $guru->load(['kelas', 'user']);
        return view('guru.show', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru)
    {
        $guru->load(['kelas', 'user']);
        $kelasList = Kelas::active()->orderBy('nama_kelas')->get();

        return view('guru.edit', compact('guru', 'kelasList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guru $guru)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:L,P',
                'tempat_lahir' => 'nullable|string|max:255',
                'tanggal_lahir' => 'nullable|date',
                'pendidikan' => 'nullable|string|max:255',
                'jurusan' => 'nullable|string|max:255',
                'alamat' => 'nullable|string',
                'kelurahan' => 'nullable|string|max:255',
                'kecamatan' => 'nullable|string|max:255',
                'kota' => 'nullable|string|max:255',
                'no_hp' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255|unique:gurus,email,' . $guru->id,
                'kelas_id' => 'nullable|exists:kelas,id',
                'tanggal_bergabung' => 'nullable|date',
                'is_active' => 'boolean',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Handle foto upload
            if ($request->hasFile('foto')) {
                // Delete old foto
                if ($guru->foto) {
                    Storage::disk('public')->delete($guru->foto);
                }
                $validated['foto'] = $request->file('foto')->store('guru', 'public');
            }

            // Set is_active
            if (!isset($validated['is_active'])) {
                $validated['is_active'] = false;
            }

            $guru->update($validated);

            // Update linked user if exists
            if ($guru->user && !empty($validated['email'])) {
                $guru->user->update([
                    'name' => $validated['nama'],
                    'email' => $validated['email'],
                ]);
            }

            return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating guru: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        try {
            // Delete foto
            if ($guru->foto) {
                Storage::disk('public')->delete($guru->foto);
            }

            // Delete linked user account
            if ($guru->user) {
                $guru->user->delete();
            }

            $guru->delete();

            return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting guru: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
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
     * Get guru list for select options
     */
    public function list(Request $request)
    {
        $query = Guru::active()->select('id', 'nama', 'no_id');

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $gurus = $query->orderBy('nama')->limit(20)->get();

        return response()->json($gurus);
    }
}
