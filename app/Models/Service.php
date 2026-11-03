<?php

namespace App\Models;

use App\Traits\ClearsHomeCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory, ClearsHomeCache;

    protected $guarded = ['id'];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saving(function ($service) {
            if ($service->isDirty('image') && !empty($service->image)) {
                $fullPath = \Illuminate\Support\Facades\Storage::disk('public')->path($service->image);
                \App\Helpers\ImageOptimizer::compress($fullPath);
            }
        });

        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('nirwana_footer_services');
        });
        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('nirwana_footer_services');
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function getImageUrlAttribute(): string
    {
        return storage_or_asset($this->image, 'assets/images/destinasi/pahawang.jpg');
    }
}
