<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Orangtua extends Model
{
    use HasFactory;

    protected $fillable = ['no_id', 'user_id', 'nama_ayah', 'nama_ibu', 'pekerjaan_ayah', 'pekerjaan_ibu', 'status_ayah', 'status_ibu', 'status_anak', 'no_hp', 'no_hp_alternatif', 'email', 'alamat', 'kelurahan_id', 'kode_pos', 'foto', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Boot method for model events
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($orangtua) {
            if (empty($orangtua->no_id)) {
                $orangtua->no_id = self::generateNoId();
            }
        });
    }

    /**
     * Generate unique No ID
     */
    public static function generateNoId(): string
    {
        $last = self::orderBy('id', 'desc')->first();
        $lastNumber = $last ? intval(Str::afterLast($last->no_id, '.')) : 0;
        $newNumber = $lastNumber + 1;

        return 'TPQH-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    }

    /**
     * Get user account
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all santri (children)
     */
    public function santris()
    {
        return $this->hasMany(Santri::class, 'orangtua_id');
    }

    /**
     * Get kelurahan
     */
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    /**
     * Get full name (combined parents)
     */
    public function getNamaLengkapAttribute()
    {
        $names = [];
        if ($this->nama_ayah) {
            $names[] = $this->nama_ayah;
        }
        if ($this->nama_ibu) {
            $names[] = $this->nama_ibu;
        }
        return !empty($names) ? implode(' & ', $names) : '-';
    }

    /**
     * Get foto URL
     */
    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        }
        return asset('images/default-avatar.png');
    }

    /**
     * Get full address (with kelurahan and kecamatan)
     */
    public function getFullAddressAttribute()
    {
        $address = [];

        if ($this->alamat) {
            $address[] = $this->alamat;
        }

        if ($this->kelurahan) {
            $address[] = $this->kelurahan->full_name;
            $address[] = $this->kelurahan->kecamatan->full_name;
            $address[] = 'Kota Ternate';
        }

        if ($this->kode_pos) {
            $address[] = $this->kode_pos;
        }

        return !empty($address) ? implode(', ', $address) : 'Alamat belum diisi';
    }

    /**
     * Get formatted phone number for WhatsApp
     */
    public function getWhatsappLinkAttribute()
    {
        if (!$this->no_hp) {
            return null;
        }

        $phone = preg_replace('/[^0-9]/', '', $this->no_hp);

        // Convert to international format
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        return 'https://wa.me/' . $phone;
    }

    /**
     * Get status ayah badge class
     */
    public function getStatusAyahBadgeClassAttribute()
    {
        return $this->status_ayah === 'Hidup' ? 'bg-success' : 'bg-secondary';
    }

    /**
     * Get status ibu badge class
     */
    public function getStatusIbuBadgeClassAttribute()
    {
        return $this->status_ibu === 'Hidup' ? 'bg-success' : 'bg-secondary';
    }

    /**
     * Get status anak badge class
     */
    public function getStatusAnakBadgeClassAttribute()
    {
        switch ($this->status_anak) {
            case 'Dalam Asuhan OT':
                return 'bg-primary';
            case 'Anak Yatim':
                return 'bg-warning';
            case 'Anak Piatu':
                return 'bg-info';
            case 'Anak Yatim Piatu':
                return 'bg-danger';
            default:
                return 'bg-secondary';
        }
    }

    /**
     * Get kecamatan through kelurahan
     */
    public function getKecamatanAttribute()
    {
        return $this->kelurahan?->kecamatan;
    }

    /**
     * Scope for active orangtua
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for inactive orangtua
     */
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    /**
     * Scope for search
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('no_id', 'like', "%{$term}%")
                ->orWhere('nama_ayah', 'like', "%{$term}%")
                ->orWhere('nama_ibu', 'like', "%{$term}%")
                ->orWhere('no_hp', 'like', "%{$term}%")
                ->orWhere('email', 'like', "%{$term}%");
        });
    }

    /**
     * Scope for status ayah
     */
    public function scopeStatusAyah($query, $status)
    {
        return $query->where('status_ayah', $status);
    }

    /**
     * Scope for status ibu
     */
    public function scopeStatusIbu($query, $status)
    {
        return $query->where('status_ibu', $status);
    }

    /**
     * Scope for status anak
     */
    public function scopeStatusAnak($query, $status)
    {
        return $query->where('status_anak', $status);
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

    /**
     * Check if has account
     */
    public function hasAccount()
    {
        return $this->user_id !== null;
    }

    /**
     * Check if ayah hidup
     */
    public function isAyahHidup()
    {
        return $this->status_ayah === 'Hidup';
    }

    /**
     * Check if ibu hidup
     */
    public function isIbuHidup()
    {
        return $this->status_ibu === 'Hidup';
    }

    /**
     * Get jumlah anak
     */
    public function getJumlahAnakAttribute()
    {
        return $this->santris()->count();
    }
}
