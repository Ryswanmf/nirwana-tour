<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function get(string $key, $default = null): ?string
    {
        return Cache::rememberForever("site_setting_{$key}", function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    public static function set(string $key, $value, ?string $label = null, string $group = 'general'): self
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'label' => $label ?? ucwords(str_replace('_', ' ', $key)),
                'group' => $group,
            ]
        );

        Cache::forget("site_setting_{$key}");

        return $setting;
    }
}
