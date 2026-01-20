<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Berita::with('creator');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('ringkasan', 'like', "%{$search}%")
                    ->orWhere('isi', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter by status
        if ($request->filled('is_published')) {
            $query->where('is_published', $request->is_published);
        }

        // Order by latest
        $beritas = $query->orderBy('created_at', 'desc')->paginate(10);

        // Preserve query parameters
        $beritas->appends($request->all());

        // Get categories for filter
        $categories = Berita::distinct()->pluck('kategori')->filter();

        return view('berita.index', compact('beritas', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->getCategories();
        return view('berita.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'judul' => 'required|string|max:255',
                'ringkasan' => 'nullable|string|max:500',
                'isi' => 'required|string',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'kategori' => 'nullable|string|max:100',
                'is_published' => 'boolean',
            ],
            [
                'judul.required' => 'Judul berita wajib diisi',
                'isi.required' => 'Isi berita wajib diisi',
                'gambar.image' => 'File harus berupa gambar',
                'gambar.max' => 'Ukuran gambar maksimal 2MB',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Terdapat kesalahan dalam pengisian form');
        }

        try {
            $data = $request->all();
            $data['created_by'] = Auth::id();
            $data['is_published'] = $request->has('is_published') ? 1 : 0;

            // Set published_at if published
            if ($data['is_published']) {
                $data['published_at'] = now();
            }

            // Handle image upload
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = time() . '_' . Str::slug($request->judul) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('berita', $filename, 'public');
                $data['gambar'] = $path;
            }

            Berita::create($data);

            return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menambahkan berita: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Berita $berita)
    {
        $berita->load('creator');

        // Get related news (same category)
        $relatedNews = Berita::published()->where('kategori', $berita->kategori)->where('id', '!=', $berita->id)->limit(3)->get();

        return view('berita.show', compact('berita', 'relatedNews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        $categories = $this->getCategories();
        return view('berita.edit', compact('berita', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $berita)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'judul' => 'required|string|max:255',
                'ringkasan' => 'nullable|string|max:500',
                'isi' => 'required|string',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'kategori' => 'nullable|string|max:100',
                'is_published' => 'boolean',
            ],
            [
                'judul.required' => 'Judul berita wajib diisi',
                'isi.required' => 'Isi berita wajib diisi',
                'gambar.image' => 'File harus berupa gambar',
                'gambar.max' => 'Ukuran gambar maksimal 2MB',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Terdapat kesalahan dalam pengisian form');
        }

        try {
            $data = $request->all();
            $data['is_published'] = $request->has('is_published') ? 1 : 0;

            // Set published_at if newly published
            if ($data['is_published'] && !$berita->is_published) {
                $data['published_at'] = now();
            }

            // Handle image upload
            if ($request->hasFile('gambar')) {
                // Delete old image
                if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                    Storage::disk('public')->delete($berita->gambar);
                }

                $file = $request->file('gambar');
                $filename = time() . '_' . Str::slug($request->judul) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('berita', $filename, 'public');
                $data['gambar'] = $path;
            }

            $berita->update($data);

            return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal memperbarui berita: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        try {
            // Delete image
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }

            $berita->delete();

            return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus berita: ' . $e->getMessage());
        }
    }

    /**
     * Toggle publish status
     */
    public function togglePublish(Berita $berita)
    {
        try {
            $berita->is_published = !$berita->is_published;

            if ($berita->is_published) {
                $berita->published_at = now();
            }

            $berita->save();

            $status = $berita->is_published ? 'dipublikasikan' : 'dijadikan draft';

            return redirect()
                ->back()
                ->with('success', "Berita berhasil {$status}!");
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal mengubah status: ' . $e->getMessage());
        }
    }

    /**
     * Get list of categories
     */
    private function getCategories()
    {
        return ['Pengumuman', 'Kegiatan', 'Prestasi', 'Pendidikan', 'Info Umum', 'Lainnya'];
    }

    /**
     * Public news list (for frontend)
     */
    public function publicIndex(Request $request)
    {
        $query = Berita::published()->with('creator');

        // Filter by category
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")->orWhere('ringkasan', 'like', "%{$search}%");
            });
        }

        $beritas = $query->orderBy('published_at', 'desc')->paginate(9);
        $beritas->appends($request->all());

        $categories = Berita::published()->distinct()->pluck('kategori')->filter();

        // Get latest news
        $latestNews = Berita::published()->orderBy('published_at', 'desc')->limit(5)->get();

        // Get popular news
        $popularNews = Berita::published()->orderBy('views', 'desc')->limit(5)->get();

        return view('berita.public-index', compact('beritas', 'categories', 'latestNews', 'popularNews'));
    }

    /**
     * Public news detail (for frontend)
     */
    public function publicShow(Berita $berita)
    {
        // Only show published news
        if (!$berita->is_published) {
            abort(404);
        }

        $berita->load('creator');
        $berita->incrementViews();

        // Get related news
        $relatedNews = Berita::published()->where('kategori', $berita->kategori)->where('id', '!=', $berita->id)->limit(3)->get();

        // Get latest news
        $latestNews = Berita::published()->orderBy('published_at', 'desc')->limit(5)->get();

        return view('berita.public-show', compact('berita', 'relatedNews', 'latestNews'));
    }
}
