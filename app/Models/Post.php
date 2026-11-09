<?php

namespace App\Models;

use App\Traits\ClearsHomeCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

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
                $category = Category::where('name', $trimmed)
                    ->orWhere('slug', Str::slug($trimmed))
                    ->first();

                if (! $category) {
                    $baseSlug = Str::slug($trimmed) ?: 'kategori-' . time();
                    $uniqueSlug = $baseSlug;
                    $counter = 1;
                    while (Category::where('slug', $uniqueSlug)->exists()) {
                        $uniqueSlug = "{$baseSlug}-{$counter}";
                        $counter++;
                    }

                    $category = Category::create([
                        'name' => $trimmed,
                        'type' => 'article',
                        'slug' => $uniqueSlug,
                    ]);
                }
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
     * Mengembalikan konten artikel yang telah diformat secara editorial dan disanitasi dari ancaman XSS.
     * Mendukung pemformatan teks polos, heading H1-H6, daftar UL/OL, kutipan, gambar, dan tabel responsif.
     */
    public function getFormattedContentAttribute(): string
    {
        $raw = (string) ($this->content ?? '');

        if ($raw === '') {
            return '';
        }

        // Jika teks polos (belum berupa markup HTML dari editor), ubah pemisah baris menjadi tag <p>
        if (strip_tags($raw) === $raw) {
            $paragraphs = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $raw)));
            if (!empty($paragraphs)) {
                $raw = '<p>' . implode("</p><p>", $paragraphs) . '</p>';
            }
        }

        // Sanitasi HTML terhadap XSS menggunakan Symfony HtmlSanitizer
        $sanitized = static::sanitizeArticleHtml($raw);

        // Bungkus tabel yang belum memiliki wrapper responsif dengan div .article-table-wrapper
        return preg_replace_callback(
            '/(?<!<div class="article-table-wrapper">)(?<!<div class="table-responsive">)(<table\b[^>]*>.*?<\/table>)/is',
            function ($matches) {
                return '<div class="article-table-wrapper">' . $matches[1] . '</div>';
            },
            $sanitized
        );
    }

    /**
     * Sanitasi HTML artikel dengan daftar tag editorial dan atribut yang aman.
     */
    public static function sanitizeArticleHtml(string $html): string
    {
        $config = (new HtmlSanitizerConfig())
            ->allowSafeElements()
            ->allowElement('table', ['class', 'style', 'border', 'cellpadding', 'cellspacing'])
            ->allowElement('thead', ['class'])
            ->allowElement('tbody', ['class'])
            ->allowElement('tfoot', ['class'])
            ->allowElement('tr', ['class', 'style'])
            ->allowElement('th', ['colspan', 'rowspan', 'scope', 'style', 'class', 'width', 'align'])
            ->allowElement('td', ['colspan', 'rowspan', 'style', 'class', 'width', 'align'])
            ->allowElement('h1', ['class', 'id'])
            ->allowElement('h2', ['class', 'id'])
            ->allowElement('h3', ['class', 'id'])
            ->allowElement('h4', ['class', 'id'])
            ->allowElement('h5', ['class', 'id'])
            ->allowElement('h6', ['class', 'id'])
            ->allowElement('p', ['style', 'class'])
            ->allowElement('blockquote', ['style', 'class'])
            ->allowElement('ul', ['style', 'class'])
            ->allowElement('ol', ['style', 'class', 'start', 'type'])
            ->allowElement('li', ['style', 'class'])
            ->allowElement('a', ['href', 'title', 'target', 'rel', 'class', 'style'])
            ->allowElement('img', ['src', 'alt', 'title', 'width', 'height', 'loading', 'class', 'style'])
            ->allowElement('figure', ['class', 'style', 'data-trix-attachment', 'data-trix-content-type'])
            ->allowElement('figcaption', ['class', 'style'])
            ->allowElement('strong')
            ->allowElement('b')
            ->allowElement('em')
            ->allowElement('i')
            ->allowElement('u')
            ->allowElement('s')
            ->allowElement('strike')
            ->allowElement('del')
            ->allowElement('span', ['style', 'class'])
            ->allowElement('div', ['style', 'class'])
            ->allowElement('br')
            ->allowElement('hr', ['class'])
            ->allowElement('code', ['class'])
            ->allowElement('pre', ['class'])
            ->allowLinkSchemes(['http', 'https', 'mailto', 'tel'])
            ->allowRelativeLinks();

        $sanitizer = new HtmlSanitizer($config);

        return $sanitizer->sanitize($html);
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
     * Ambil daftar semua nama kategori artikel untuk opsi autocomplete di admin.
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
