<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = ['no_id', 'user_id', 'nama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'pendidikan', 'jurusan', 'alamat', 'kelurahan', 'kecamatan', 'kota', 'no_hp', 'email', 'kelas_id', 'foto', 'tanggal_bergabung', 'is_active'];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_bergabung' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Boot method for model events
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($guru) {
            if (empty($guru->no_id)) {
                $guru->no_id = self::generateNoId();
            }
        });
    }

    /**
     * Generate unique No ID
     */
    public static function generateNoId(): string
    {
        $lastGuru = self::orderBy('id', 'desc')->first();
        $lastNumber = $lastGuru ? intval(Str::afterLast($lastGuru->no_id, '.')) : 0;
        $newNumber = $lastNumber + 1;

        return 'G-TPQH.' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Get user account
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get kelas
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    /**
     * Get all santri taught by this guru
     */
    public function santris()
    {
        return $this->hasMany(Santri::class);
    }

    /**
     * Get progress records created by this guru
     */
    public function progressSantris()
    {
        return $this->hasMany(ProgressSantri::class);
    }

    /**
     * Calculate age
     */
    public function getUsiaAttribute()
    {
        if ($this->tanggal_lahir) {
            return $this->tanggal_lahir->age;
        }
        return null;
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
     * Scope for active guru
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
