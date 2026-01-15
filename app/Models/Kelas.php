<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = ['nama_kelas', 'kode_kelas', 'deskripsi', 'jam_mulai', 'jam_selesai', 'hari', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
    ];

    /**
     * Get all guru for this kelas
     */
    public function gurus()
    {
        return $this->hasMany(Guru::class);
    }

    /**
     * Get all santri in this kelas
     */
    public function santris()
    {
        return $this->hasMany(Santri::class);
    }

    /**
     * Get total santri count
     */
    public function getTotalSantriAttribute()
    {
        return $this->santris()->where('is_active', true)->count();
    }

    /**
     * Scope for active kelas
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Relationship dengan Guru
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
}
