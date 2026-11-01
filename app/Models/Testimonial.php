<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'rating' => 'integer',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => \Illuminate\Support\Facades\Cache::forget('testimonial_pending_badge_count'));
        static::deleted(fn () => \Illuminate\Support\Facades\Cache::forget('testimonial_pending_badge_count'));
    }

    public function getAvatarUrlAttribute(): ?string
    {
        return storage_or_asset($this->avatar);
    }
}
