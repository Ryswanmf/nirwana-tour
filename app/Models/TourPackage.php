<?php

namespace App\Models;

use App\Traits\ClearsHomeCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TourPackage extends Model
{
    use HasFactory, ClearsHomeCache;

    protected $guarded = ['id'];

    protected $casts = [
        'itinerary' => 'array',
        'includes' => 'array',
        'excludes' => 'array',
        'faqs' => 'array',
        'gallery' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'price_from' => 'integer',
        'duration_days' => 'integer',
        'duration_nights' => 'integer',
        'min_pax' => 'integer',
        'order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saving(function ($package) {
            if ($package->isDirty('thumbnail') && !empty($package->thumbnail)) {
                $fullPath = \Illuminate\Support\Facades\Storage::disk('public')->path($package->thumbnail);
                \App\Helpers\ImageOptimizer::compress($fullPath);
            }

            if ($package->isDirty('gallery') && !empty($package->gallery) && is_array($package->gallery)) {
                foreach ($package->gallery as $galleryImg) {
                    if (!empty($galleryImg)) {
                        $fullPath = \Illuminate\Support\Facades\Storage::disk('public')->path($galleryImg);
                        \App\Helpers\ImageOptimizer::compress($fullPath);
                    }
                }
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price_from, 0, ',', '.');
    }

    public function getDurationLabelAttribute(): string
    {
        if ($this->duration_nights > 0) {
            return "{$this->duration_days}D {$this->duration_nights}N";
        }
        return "{$this->duration_days} Hari (One Day Trip)";
    }

    public function getThumbnailUrlAttribute(): string
    {
        return webp_url($this->thumbnail, 'assets/images/destinasi/pahawang.jpg');
    }
}
