<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProgressSantri extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'progress_santris';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['santri_id', 'guru_id', 'tanggal', 'jilid', 'halaman', 'ayat', 'surah', 'nilai', 'status', 'catatan', 'hafalan', 'hafalan_surah', 'hafalan_ayat_dari', 'hafalan_ayat_sampai'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tanggal' => 'date',
        'hafalan' => 'boolean',
        'hafalan_ayat_dari' => 'integer',
        'hafalan_ayat_sampai' => 'integer',
    ];

    /**
     * Relationship dengan Santri
     */
    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    /**
     * Relationship dengan Guru
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    /**
     * Scope untuk filter berdasarkan santri
     */
    public function scopeBySantri($query, $santriId)
    {
        return $query->where('santri_id', $santriId);
    }

    /**
     * Scope untuk filter berdasarkan tanggal
     */
    public function scopeByDate($query, $date)
    {
        return $query->whereDate('tanggal', $date);
    }

    /**
     * Scope untuk filter berdasarkan bulan
     */
    public function scopeByMonth($query, $year, $month)
    {
        return $query->whereYear('tanggal', $year)->whereMonth('tanggal', $month);
    }

    /**
     * Scope untuk filter berdasarkan jilid
     */
    public function scopeByJilid($query, $jilid)
    {
        return $query->where('jilid', $jilid);
    }

    /**
     * Scope untuk progress dengan hafalan
     */
    public function scopeWithHafalan($query)
    {
        return $query->where('hafalan', true);
    }

    /**
     * Accessor untuk format tanggal Indonesia
     */
    public function getTanggalFormattedAttribute()
    {
        return Carbon::parse($this->tanggal)->isoFormat('D MMMM YYYY');
    }

    /**
     * Accessor untuk badge class nilai
     */
    public function getNilaiBadgeClassAttribute()
    {
        return match ($this->nilai) {
            'A' => 'bg-success',
            'B' => 'bg-primary',
            'C' => 'bg-info',
            'D' => 'bg-warning',
            'E' => 'bg-danger',
            default => 'bg-secondary',
        };
    }

    /**
     * Accessor untuk badge class status
     */
    public function getStatusBadgeClassAttribute()
    {
        return match ($this->status) {
            'lancar' => 'bg-success',
            'kurang_lancar' => 'bg-warning',
            'mengulang' => 'bg-danger',
            default => 'bg-secondary',
        };
    }

    /**
     * Accessor untuk status label
     */
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'lancar' => 'Lancar',
            'kurang_lancar' => 'Kurang Lancar',
            'mengulang' => 'Mengulang',
            default => '-',
        };
    }

    /**
     * Accessor untuk info hafalan
     */
    public function getHafalanInfoAttribute()
    {
        if (!$this->hafalan) {
            return '-';
        }

        $info = $this->hafalan_surah;
        if ($this->hafalan_ayat_dari && $this->hafalan_ayat_sampai) {
            $info .= " ayat {$this->hafalan_ayat_dari}-{$this->hafalan_ayat_sampai}";
        }
        return $info;
    }
}
