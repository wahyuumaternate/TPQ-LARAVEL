<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $fillable = ['kode', 'nama', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all kelurahans in this kecamatan
     */
    public function kelurahans()
    {
        return $this->hasMany(Kelurahan::class);
    }

    /**
     * Get all santris in this kecamatan (through kelurahan)
     */
    public function santris()
    {
        return $this->hasManyThrough(Santri::class, Kelurahan::class);
    }

    /**
     * Get all orangtuas in this kecamatan (through kelurahan)
     */
    public function orangtuas()
    {
        return $this->hasManyThrough(Orangtua::class, Kelurahan::class);
    }

    /**
     * Scope for active kecamatan
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get full name (with "Kecamatan" prefix)
     */
    public function getFullNameAttribute()
    {
        return 'Kecamatan ' . $this->nama;
    }
}
