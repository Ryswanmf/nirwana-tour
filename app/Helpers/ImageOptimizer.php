<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class ImageOptimizer
{
    /**
     * Kompresi file gambar di path disk tanpa mengubah resolusi pixel aslinya.
     * Mendukung format JPEG/JPG, PNG, dan WebP.
     *
     * @param string $fullPath Path absolut ke file gambar
     * @param int $jpegQuality Kualitas kompresi JPEG (default 80)
     * @param int $webpQuality Kualitas kompresi WebP (default 80)
     * @return bool True jika berhasil dikompresi, false jika gagal/dilewati
     */
    public static function compress(string $fullPath, int $jpegQuality = 80, int $webpQuality = 80): bool
    {
        if (!file_exists($fullPath) || !is_file($fullPath)) {
            return false;
        }

        if (!extension_loaded('gd')) {
            return false;
        }

        // Tingkatkan memory limit sementara untuk foto kamera beresolusi tinggi (hingga 25 MB)
        $currentMemory = (int) ini_get('memory_limit');
        if ($currentMemory > 0 && $currentMemory < 512) {
            @ini_set('memory_limit', '512M');
        }

        try {
            $info = @getimagesize($fullPath);
            if (!$info) {
                return false;
            }

            $mime = $info['mime'] ?? '';
            $width = $info[0] ?? 0;
            $height = $info[1] ?? 0;

            if ($width <= 0 || $height <= 0) {
                return false;
            }

            $originalSize = (int) @filesize($fullPath);
            $image = null;

            switch ($mime) {
                case 'image/jpeg':
                case 'image/jpg':
                case 'image/pjpeg':
                    $image = @imagecreatefromjpeg($fullPath);
                    if (!$image) {
                        return false;
                    }

                    // Koreksi orientasi EXIF untuk foto kamera smartphone
                    if (function_exists('exif_read_data')) {
                        $exif = @exif_read_data($fullPath);
                        if (!empty($exif['Orientation'])) {
                            switch ($exif['Orientation']) {
                                case 3:
                                    $image = imagerotate($image, 180, 0);
                                    break;
                                case 6:
                                    $image = imagerotate($image, -90, 0);
                                    break;
                                case 8:
                                    $image = imagerotate($image, 90, 0);
                                    break;
                            }
                        }
                    }

                    // Tulis ulang dengan kualitas 80 tanpa mengubah resolusi
                    imagejpeg($image, $fullPath, $jpegQuality);
                    imagedestroy($image);
                    break;

                case 'image/png':
                    $image = @imagecreatefrompng($fullPath);
                    if (!$image) {
                        return false;
                    }

                    imagealphablending($image, false);
                    imagesavealpha($image, true);

                    // Kompresi PNG level 7 (0-9)
                    imagepng($image, $fullPath, 7);
                    imagedestroy($image);
                    break;

                case 'image/webp':
                    if (function_exists('imagecreatefromwebp') && function_exists('imagewebp')) {
                        $image = @imagecreatefromwebp($fullPath);
                        if (!$image) {
                            return false;
                        }

                        imagewebp($image, $fullPath, $webpQuality);
                        imagedestroy($image);
                    }
                    break;

                default:
                    return false;
            }

            // Bersihkan stat cache agar ukuran baru terbaca
            clearstatcache(true, $fullPath);
            $newSize = (int) @filesize($fullPath);

            Log::info("Image compressed successfully: {$fullPath}", [
                'original_kb' => round($originalSize / 1024, 2),
                'compressed_kb' => round($newSize / 1024, 2),
                'saved_percent' => $originalSize > 0 ? round((($originalSize - $newSize) / $originalSize) * 100, 1) : 0,
                'resolution' => "{$width}x{$height}",
            ]);

            return true;
        } catch (\Throwable $e) {
            Log::warning("Image compression skipped or failed for {$fullPath}: " . $e->getMessage());
            return false;
        }
    }
}
