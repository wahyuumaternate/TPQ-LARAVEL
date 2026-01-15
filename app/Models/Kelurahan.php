<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    protected $fillable = ['kecamatan_id', 'kode', 'nama', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the kecamatan that owns this kelurahan
     */
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    /**
     * Get all santris in this kelurahan
     */
    public function santris()
    {
        return $this->hasMany(Santri::class);
    }

    /**
     * Get all orangtuas in this kelurahan
     */
    public function orangtuas()
    {
        return $this->hasMany(Orangtua::class);
    }

    /**
     * Scope for active kelurahan
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope by kecamatan
     */
    public function scopeByKecamatan($query, $kecamatanId)
    {
        return $query->where('kecamatan_id', $kecamatanId);
    }

    /**
     * Get full name (with "Kelurahan" prefix)
     */
    public function getFullNameAttribute()
    {
        return 'Kelurahan ' . $this->nama;
    }

    /**
     * Get full address (Kelurahan + Kecamatan)
     */
    public function getFullAddressAttribute()
    {
        return $this->full_name . ', ' . $this->kecamatan->full_name . ', Kota Ternate';
    }
}
