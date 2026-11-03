<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait ClearsHomeCache
{
    public static function bootClearsHomeCache(): void
    {
        static::saved(function () {
            Cache::forget('nirwana_home_data');
            Cache::forget('nirwana_tour_categories');
        });

        static::deleted(function () {
            Cache::forget('nirwana_home_data');
            Cache::forget('nirwana_tour_categories');
        });
    }
}
