<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'order' => 'integer',
        'is_featured' => 'boolean',
    ];

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
            return $this->file_path;
        }

        return storage_or_asset($this->file_path);
    }

    public function getThumbnailUrlAttribute(): string
    {
        return webp_url($this->thumbnail, 'assets/images/galeri/video1-poster.jpg');
    }
}
