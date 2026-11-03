<?php

namespace App\Models;

use App\Traits\ClearsHomeCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, ClearsHomeCache;

    protected $guarded = ['id'];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'gallery_images' => 'array',
    ];

    protected static function booted(): void
    {
        static::saving(function ($post) {
            if (!empty($post->category_name)) {
                $trimmed = trim($post->category_name);
                $category = Category::firstOrCreate(
                    ['name' => $trimmed, 'type' => 'article'],
                    ['slug' => Str::slug($trimmed) ?: 'kategori-' . time()]
                );
                $post->category_id = $category->id;
            } elseif ($post->category_id && empty($post->category_name)) {
                $post->category_name = $post->category?->name;
            }

            if ($post->isDirty('cover_image') && !empty($post->cover_image)) {
                $fullPath = \Illuminate\Support\Facades\Storage::disk('public')->path($post->cover_image);
                \App\Helpers\ImageOptimizer::compress($fullPath);
            }

            if ($post->isDirty('gallery_images') && !empty($post->gallery_images) && is_array($post->gallery_images)) {
                foreach ($post->gallery_images as $galleryImg) {
                    if (!empty($galleryImg)) {
                        $fullPath = \Illuminate\Support\Facades\Storage::disk('public')->path($galleryImg);
                        \App\Helpers\ImageOptimizer::compress($fullPath);
                    }
                }
            }
        });
    }

    public function getCategoryNameDisplayAttribute(): string
    {
        return $this->category_name ?: ($this->category?->name ?? 'Info Wisata');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getCoverImageUrlAttribute(): string
    {
        return storage_or_asset($this->cover_image, 'assets/images/destinasi/pahawang.jpg');
    }

    /**
     * Mengembalikan daftar foto artikel.
     * Hanya mengembalikan foto yang benar-benar diunggah (1 foto jika hanya cover, atau beberapa foto jika ada galeri).
     * Tidak menambahkan foto tiruan/dummy sembarangan.
     *
     * @return array<int, string>
     */
    public function getPhotosAttribute(): array
    {
        $photos = [];

        if (!empty($this->cover_image)) {
            $photos[] = $this->cover_image;
        }

        if (!empty($this->gallery_images) && is_array($this->gallery_images)) {
            foreach ($this->gallery_images as $img) {
                if (!empty($img) && !in_array($img, $photos)) {
                    $photos[] = $img;
                }
            }
        }

        return $photos;
    }

    /**
     * Estimasi waktu baca artikel (asumsi kecepatan baca ~200 kata per menit).
     */
    public function getReadingTimeAttribute(): string
    {
        $words = str_word_count(strip_tags($this->content ?? ''));
        $minutes = max(1, (int) ceil($words / 200));

        return "{$minutes} menit baca";
    }

    /**
     * Scope untuk artikel yang sudah terbit.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope untuk artikel unggulan beranda.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Ambil daftar semua nama kategori artikel untuk opsi autocomplete di Filament.
     *
     * @return array<int, string>
     */
    public static function getAvailableCategories(): array
    {
        $fromCategories = Category::where('type', 'article')
            ->pluck('name')
            ->filter()
            ->values()
            ->all();

        $fromPosts = static::whereNotNull('category_name')
            ->where('category_name', '!=', '')
            ->distinct()
            ->pluck('category_name')
            ->filter()
            ->values()
            ->all();

        $merged = array_unique(array_merge($fromCategories, $fromPosts));
        sort($merged);

        return array_values($merged);
    }
}
