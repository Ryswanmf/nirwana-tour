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

if (!function_exists('webp_url')) {
    /**
     * Mengembalikan URL versi .webp jika tersedia di public directory, atau fallback ke storage_or_asset.
     */
    function webp_url(?string $path, ?string $fallback = null): ?string
    {
        $url = storage_or_asset($path, $fallback);
        if (!$url) {
            return null;
        }

        $parsedPath = ltrim(parse_url($url, PHP_URL_PATH) ?? '', '/');
        $webpRelative = preg_replace('/\.(jpe?g|png)$/i', '.webp', $parsedPath);

        if ($webpRelative && $webpRelative !== $parsedPath && file_exists(public_path($webpRelative))) {
            return asset($webpRelative);
        }

        return $url;
    }
}
