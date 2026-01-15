<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Pengumuman::with('creator');

            return DataTables::of($query->latest())
                ->addIndexColumn()
                ->addColumn('tanggal_format', function ($row) {
                    $start = $row->tanggal_mulai ? $row->tanggal_mulai->format('d/m/Y') : '-';
                    $end = $row->tanggal_selesai ? $row->tanggal_selesai->format('d/m/Y') : '-';
                    return $start . ' s/d ' . $end;
                })
                ->addColumn('tipe_badge', function ($row) {
                    $colors = [
                        'umum' => 'bg-primary',
                        'santri' => 'bg-info',
                        'guru' => 'bg-success',
                        'orangtua' => 'bg-warning',
                    ];
                    $class = $colors[$row->tipe] ?? 'bg-secondary';
                    return '<span class="badge ' . $class . '">' . $row->tipe_label . '</span>';
                })
                ->addColumn('prioritas_badge', function ($row) {
                    $badge = $row->prioritas_badge;
                    return '<span class="badge ' . $badge['class'] . '">' . $badge['label'] . '</span>';
                })
                ->addColumn('wa_status', function ($row) {
                    if ($row->kirim_wa && $row->wa_sent_at) {
                        return '<span class="badge bg-success"><i class="bi bi-whatsapp"></i> Terkirim</span>';
                    } elseif ($row->kirim_wa) {
                        return '<span class="badge bg-warning"><i class="bi bi-whatsapp"></i> Pending</span>';
                    }
                    return '<span class="badge bg-secondary">-</span>';
                })
                ->addColumn('status_badge', function ($row) {
                    if ($row->is_currently_active) {
                        return '<span class="badge bg-success">Aktif</span>';
                    }
                    return '<span class="badge bg-secondary">Tidak Aktif</span>';
                })
                ->addColumn('action', function ($row) {
                    $sendWa = '';
                    if ($row->kirim_wa && !$row->wa_sent_at) {
                        $sendWa = '<button type="button" class="btn btn-sm btn-success btn-send-wa" data-id="' . $row->id . '" title="Kirim WA">
                            <i class="bi bi-whatsapp"></i>
                        </button>';
                    }
                    return '
                        ' . $sendWa . '
                        <button type="button" class="btn btn-sm btn-warning btn-edit" data-id="' . $row->id . '" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    ';
                })
                ->rawColumns(['tipe_badge', 'prioritas_badge', 'wa_status', 'status_badge', 'action'])
                ->make(true);
        }

        return view('pengumuman.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tipe' => 'required|in:umum,santri,guru,orangtua',
            'prioritas' => 'required|in:normal,penting,urgent',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'kirim_wa' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['created_by'] = auth()->id();

        $pengumuman = Pengumuman::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pengumuman berhasil ditambahkan',
            'data' => $pengumuman
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengumuman $pengumuman)
    {
        return response()->json([
            'success' => true,
            'data' => $pengumuman
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tipe' => 'required|in:umum,santri,guru,orangtua',
            'prioritas' => 'required|in:normal,penting,urgent',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'kirim_wa' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $pengumuman->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pengumuman berhasil diperbarui',
            'data' => $pengumuman
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pengumuman berhasil dihapus'
        ]);
    }

    /**
     * Send WhatsApp notification
     */
    public function sendWhatsApp(Pengumuman $pengumuman)
    {
        // TODO: Implement WhatsApp API integration
        // This is a placeholder for the actual implementation
        
        $pengumuman->update([
            'wa_sent_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengumuman berhasil dikirim via WhatsApp'
        ]);
    }
}
