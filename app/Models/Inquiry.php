<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'participants' => 'integer',
        'estimated_price' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => \Illuminate\Support\Facades\Cache::forget('inquiry_pending_badge_count'));
        static::deleted(fn () => \Illuminate\Support\Facades\Cache::forget('inquiry_pending_badge_count'));
    }

    public function tourPackage(): BelongsTo
    {
        return $this->belongsTo(TourPackage::class);
    }
}
