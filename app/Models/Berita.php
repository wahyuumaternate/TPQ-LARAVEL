<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas';

    protected $fillable = [
        'judul',
        'slug',
        'ringkasan',
        'isi',
        'gambar',
        'kategori',
        'created_by',
        'views',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'views' => 'integer',
    ];

    /**
     * Boot method for model events
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->judul);
            }
            
            // Ensure unique slug
            $originalSlug = $berita->slug;
            $count = 1;
            while (self::where('slug', $berita->slug)->exists()) {
                $berita->slug = $originalSlug . '-' . $count++;
            }
        });

        static::updating(function ($berita) {
            if ($berita->isDirty('judul') && !$berita->isDirty('slug')) {
                $berita->slug = Str::slug($berita->judul);
                
                // Ensure unique slug
                $originalSlug = $berita->slug;
                $count = 1;
                while (self::where('slug', $berita->slug)->where('id', '!=', $berita->id)->exists()) {
                    $berita->slug = $originalSlug . '-' . $count++;
                }
            }
        });
    }

    /**
     * Get creator
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get gambar URL
     */
    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/' . $this->gambar);
        }
        return asset('images/default-news.png');
    }

    /**
     * Get excerpt from isi
     */
    public function getExcerptAttribute()
    {
        if ($this->ringkasan) {
            return $this->ringkasan;
        }
        return Str::limit(strip_tags($this->isi), 150);
    }

    /**
     * Increment views
     */
    public function incrementViews()
    {
        $this->increment('views');
    }

    /**
     * Scope for published berita
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope by kategori
     */
    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }
}
