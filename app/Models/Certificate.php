<?php

namespace App\Models;

use App\Traits\ClearsHomeCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Certificate extends Model
{
    use HasFactory, ClearsHomeCache;

    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saving(function ($cert) {
            if ($cert->isDirty('image') && !empty($cert->image)) {
                $fullPath = Storage::disk('public')->path($cert->image);
                \App\Helpers\ImageOptimizer::compress($fullPath);
            }
        });

        static::saved(function () {
            Cache::forget('nirwana_certificates_active');
        });

        static::deleted(function () {
            Cache::forget('nirwana_certificates_active');
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

    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->image)) {
            return null;
        }

        return storage_or_asset($this->image);
    }

    public function getFileUrlAttribute(): ?string
    {
        if (empty($this->file)) {
            return null;
        }

        return Storage::disk('public')->url($this->file);
    }
}
