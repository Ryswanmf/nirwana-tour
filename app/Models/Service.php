<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('nirwana_footer_services');
        });
        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('nirwana_footer_services');
        });
    }

    public function getImageUrlAttribute(): string
    {
        return storage_or_asset($this->image, 'assets/images/destinasi/pahawang.jpg');
    }
}
