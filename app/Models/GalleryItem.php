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

    public function getFileUrlAttribute(): string
    {
        return storage_or_asset($this->file_path);
    }

    public function getThumbnailUrlAttribute(): string
    {
        return storage_or_asset($this->thumbnail, 'assets/images/galeri/video1-poster.jpg');
    }
}
