<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Santri extends Model
{
    use HasFactory;

    protected $fillable = ['no_id', 'nama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'usia', 'kelas_id', 'orangtua_id', 'guru_id', 'kelurahan_id', 'hubungan_wali', 'no_hp_wali', 'alamat', 'foto', 'tanggal_masuk', 'tanggal_lulus', 'status', 'catatan', 'is_active'];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
        'tanggal_lulus' => 'date',
        'is_active' => 'boolean',
    ];

    protected $appends = ['foto_url', 'calculated_usia', 'status_badge', 'jenis_kelamin_label'];

    /**
     * Boot method for model events
     */
    protected static function boot()
    {
        parent::boot();

        // Generate no_id before creating
        static::creating(function ($santri) {
            if (empty($santri->no_id)) {
                $santri->no_id = self::generateNoId();
            }
        });

        // Auto calculate age when saving
        static::saving(function ($santri) {
            // Auto calculate age from tanggal_lahir
            if ($santri->tanggal_lahir) {
                $santri->usia = $santri->tanggal_lahir->age;
            }
        });
    }

    /**
     * Generate unique No ID
     * Format: TPQH-XXXXX (5 digits, padded with zeros)
     */
    public static function generateNoId(): string
    {
        $last = self::orderBy('id', 'desc')->first();
        $lastNumber = $last ? intval(Str::afterLast($last->no_id, '-')) : 0;
        $newNumber = $lastNumber + 1;

        return 'TPQH-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    }

    /**
     * Relationships
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function orangtua()
    {
        return $this->belongsTo(Orangtua::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    public function progressSantris()
    {
        return $this->hasMany(ProgressSantri::class);
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }

    /**
     * Accessors
     */

    /**
     * Calculate age from tanggal_lahir
     */
    public function getCalculatedUsiaAttribute()
    {
        if ($this->tanggal_lahir) {
            return $this->tanggal_lahir->age;
        }
        return $this->usia;
    }

    /**
     * Get foto URL with fallback to default avatar
     */
    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            // Check if file exists in storage
            if (Storage::disk('public')->exists($this->foto)) {
                return Storage::disk('public')->url($this->foto);
            }
            // Fallback if file not found
            return asset('storage/' . $this->foto);
        }

        // Default avatar based on gender
        return $this->jenis_kelamin === 'P' ? asset('images/default-female.png') : asset('images/default-male.png');
    }

    /**
     * Get jenis kelamin label
     */
    public function getJenisKelaminLabelAttribute()
    {
        return $this->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    /**
     * Get status label with badge class
     */
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'aktif' => ['label' => 'Aktif', 'class' => 'bg-success'],
            'lulus' => ['label' => 'Lulus', 'class' => 'bg-primary'],
            'pindah' => ['label' => 'Pindah', 'class' => 'bg-warning'],
            'keluar' => ['label' => 'Keluar', 'class' => 'bg-danger'],
            default => ['label' => 'Unknown', 'class' => 'bg-secondary'],
        };
    }

    /**
     * Get full address (with kelurahan and kecamatan)
     */
    public function getAlamatLengkapAttribute()
    {
        $parts = [];

        if ($this->alamat) {
            $parts[] = $this->alamat;
        }

        if ($this->kelurahan) {
            $parts[] = $this->kelurahan->full_name;
            $parts[] = $this->kelurahan->kecamatan->full_name;
            $parts[] = 'Kota Ternate';
        }

        return !empty($parts) ? implode(', ', $parts) : '-';
    }

    /**
     * Get study duration
     */
    public function getLamaBelajarAttribute()
    {
        if ($this->tanggal_masuk) {
            $end = $this->tanggal_lulus ?? now();
            return $this->tanggal_masuk->diffForHumans($end, true);
        }
        return '-';
    }

    /**
     * Get kecamatan through kelurahan
     */
    public function getKecamatanAttribute()
    {
        return $this->kelurahan?->kecamatan;
    }

    /**
     * Scopes
     */

    /**
     * Scope for active santri (is_active = true AND status = aktif)
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->where('status', 'aktif');
    }

    /**
     * Scope for santri with status aktif only
     */
    public function scopeStatusAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Scope by kelas
     */
    public function scopeByKelas($query, $kelasId)
    {
        return $query->where('kelas_id', $kelasId);
    }

    /**
     * Scope by guru
     */
    public function scopeByGuru($query, $guruId)
    {
        return $query->where('guru_id', $guruId);
    }

    /**
     * Scope by jenis kelamin
     */
    public function scopeByJenisKelamin($query, $jenisKelamin)
    {
        return $query->where('jenis_kelamin', $jenisKelamin);
    }

    /**
     * Scope by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope by kelurahan
     */
    public function scopeByKelurahan($query, $kelurahanId)
    {
        return $query->where('kelurahan_id', $kelurahanId);
    }

    /**
     * Scope by kecamatan (through kelurahan)
     */
    public function scopeByKecamatan($query, $kecamatanId)
    {
        return $query->whereHas('kelurahan', function ($q) use ($kecamatanId) {
            $q->where('kecamatan_id', $kecamatanId);
        });
    }

    // Di App\Models\Santri.php

    /**
     * Relationship dengan Progress
     */
    public function progresses()
    {
        return $this->hasMany(ProgressSantri::class);
    }

    /**
     * Get latest progress
     */
    public function latestProgress()
    {
        return $this->hasOne(ProgressSantri::class)->latestOfMany('tanggal');
    }

    
}
