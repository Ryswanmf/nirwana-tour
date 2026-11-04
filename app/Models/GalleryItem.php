<?php

namespace App\Models;

use App\Traits\ClearsHomeCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryItem extends Model
{
    use HasFactory, ClearsHomeCache;

    protected $guarded = ['id'];

    protected $casts = [
        'order' => 'integer',
        'is_featured' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function ($item) {
            if ($item->isDirty('file_path') && !empty($item->file_path) && $item->media_type === 'image') {
                $disk = \Illuminate\Support\Facades\Storage::disk('public');
                if ($disk->exists($item->file_path)) {
                    $fullPath = $disk->path($item->file_path);
                    \App\Helpers\ImageOptimizer::compress($fullPath);
                }
            }
        });
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeRegular($query)
    {
        return $query->where('is_featured', false);
    }

    public function scopeVideos($query)
    {
        return $query->whereIn('media_type', ['video', 'reel']);
    }

    public function scopeImages($query)
    {
        return $query->where('media_type', 'image');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getIsInstagramAttribute(): bool
    {
        return $this->media_type === 'reel' || str_contains($this->file_path ?? '', 'instagram.com');
    }

    public function getInstagramEmbedUrlAttribute(): ?string
    {
        if (!$this->is_instagram) {
            return null;
        }

        $url = $this->file_path ?? '';

        // Extract shortcode from /reel/{code}/ or /p/{code}/
        if (preg_match('/(?:reel|p)\/([A-Za-z0-9_-]+)/', $url, $matches)) {
            return "https://www.instagram.com/reel/{$matches[1]}/embed/";
        }

        return rtrim($url, '/') . '/embed/';
    }

    public function getFileUrlAttribute(): string
    {
        if ($this->is_instagram) {
            $url = trim($this->file_path ?? '');
            if (!empty($url) && !str_starts_with($url, 'http://') && !str_starts_with($url, 'https://')) {
                return 'https://' . $url;
            }
            return $url ?: 'https://www.instagram.com/nirwana_tourlampung/';
        }

        return storage_or_asset($this->file_path);
    }

    public function getThumbnailUrlAttribute(): string
    {
        return webp_url($this->thumbnail, 'assets/images/galeri/video1-poster.jpg');
    }
}
