<?php

if (!function_exists('storage_or_asset')) {
    /**
     * Mengembalikan URL aset yang benar baik untuk file unggahan di storage maupun aset statis di public/assets.
     */
    function storage_or_asset(?string $path, ?string $fallback = null): ?string
    {
        if (empty($path)) {
            return $fallback ? asset($fallback) : null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            return $path;
        }

        if (str_starts_with($path, 'assets/') || str_starts_with($path, 'storage/')) {
            return asset($path);
        }

        return asset('storage/' . ltrim($path, '/'));
    }
}
