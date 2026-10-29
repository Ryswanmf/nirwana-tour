<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TourPackage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'itinerary' => 'array',
        'includes' => 'array',
        'excludes' => 'array',
        'gallery' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'price_from' => 'integer',
        'duration_days' => 'integer',
        'duration_nights' => 'integer',
        'min_pax' => 'integer',
        'order' => 'integer',
    ];

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
}
