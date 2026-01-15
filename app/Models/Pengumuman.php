<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumumans';

    protected $fillable = [
        'judul',
        'isi',
        'tipe',
        'prioritas',
        'tanggal_mulai',
        'tanggal_selesai',
        'kirim_wa',
        'wa_sent_at',
        'created_by',
        'is_active',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'wa_sent_at' => 'datetime',
        'kirim_wa' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get creator
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get tipe label
     */
    public function getTipeLabelAttribute()
    {
        return match($this->tipe) {
            'umum' => 'Umum',
            'santri' => 'Santri',
            'guru' => 'Guru',
            'orangtua' => 'Orang Tua',
            default => $this->tipe,
        };
    }

    /**
     * Get prioritas badge
     */
    public function getPrioritasBadgeAttribute()
    {
        return match($this->prioritas) {
            'normal' => ['label' => 'Normal', 'class' => 'bg-secondary'],
            'penting' => ['label' => 'Penting', 'class' => 'bg-warning'],
            'urgent' => ['label' => 'Urgent', 'class' => 'bg-danger'],
            default => ['label' => $this->prioritas, 'class' => 'bg-secondary'],
        };
    }

    /**
     * Check if pengumuman is currently active
     */
    public function getIsCurrentlyActiveAttribute()
    {
        $now = now()->startOfDay();
        
        if (!$this->is_active) return false;
        if ($this->tanggal_mulai && $now->lt($this->tanggal_mulai)) return false;
        if ($this->tanggal_selesai && $now->gt($this->tanggal_selesai)) return false;
        
        return true;
    }

    /**
     * Scope for active pengumuman
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for current pengumuman
     */
    public function scopeCurrent($query)
    {
        $now = now()->startOfDay();
        
        return $query->where('is_active', true)
            ->where(function ($q) use ($now) {
                $q->whereNull('tanggal_mulai')
                  ->orWhere('tanggal_mulai', '<=', $now);
            })
            ->where(function ($q) use ($now) {
                $q->whereNull('tanggal_selesai')
                  ->orWhere('tanggal_selesai', '>=', $now);
            });
    }
}
