<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saving(function ($member) {
            if ($member->isDirty('photo') && !empty($member->photo)) {
                $fullPath = \Illuminate\Support\Facades\Storage::disk('public')->path($member->photo);
                \App\Helpers\ImageOptimizer::compress($fullPath);
            }
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

    public function scopeByDivision($query, string $division)
    {
        return $query->where('division', $division);
    }

    public function getPhotoUrlAttribute(): string
    {
        return storage_or_asset($this->photo, 'assets/images/pemilik-nirwana.webp');
    }
}
