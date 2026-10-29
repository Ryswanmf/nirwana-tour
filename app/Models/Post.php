<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get 4 gallery photos for article detail view
     *
     * @return array<int, string>
     */
    public function getPhotosAttribute(): array
    {
        if (!empty($this->gallery_images) && is_array($this->gallery_images)) {
            $list = array_filter(array_merge([$this->cover_image], $this->gallery_images));
            if (count($list) >= 4) {
                return array_slice($list, 0, 4);
            }
        }

        $presetGalleries = [
            '5-tips-snorkeling-aman-di-pulau-pahawang' => [
                'assets/images/destinasi/pahawang.jpg',
                'assets/images/galeri/galeri-1.jpg',
                'assets/images/galeri/galeri-2.jpg',
                'assets/images/destinasi/krui.jpg',
            ],
            'waktu-terbaik-menyaksikan-lumba-lumba-teluk-kiluan' => [
                'assets/images/destinasi/kiluan.jpg',
                'assets/images/galeri/galeri-3.jpg',
                'assets/images/galeri/galeri-4.jpg',
                'assets/images/destinasi/krakatau.jpg',
            ],
            'panduan-memilih-bus-pariwisata-rombongan-sekolah' => [
                'assets/images/destinasi/jakarta-bandung.jpg',
                'assets/images/galeri/galeri-5.jpg',
                'assets/images/destinasi/jogja.jpg',
                'assets/images/galeri/galeri-6.jpg',
            ],
            'eksotisme-karang-purba-pantai-gigi-hiu-panduan-spot-foto' => [
                'assets/images/destinasi/gigi-hiu.jpg',
                'assets/images/galeri/galeri-2.jpg',
                'assets/images/destinasi/krui.jpg',
                'assets/images/galeri/galeri-1.jpg',
            ],
            'paket-study-tour-edukasi-jogja-bandung-persiapan-sekolah' => [
                'assets/images/destinasi/jogja.jpg',
                'assets/images/destinasi/jakarta-bandung.jpg',
                'assets/images/destinasi/bromo.jpg',
                'assets/images/galeri/galeri-5.jpg',
            ],
            'tips-memilih-paket-outbound-family-gathering-perusahaan-lampung' => [
                'assets/images/destinasi/krui.jpg',
                'assets/images/destinasi/pahawang.jpg',
                'assets/images/galeri/galeri-4.jpg',
                'assets/images/galeri/galeri-6.jpg',
            ],
        ];

        if (isset($presetGalleries[$this->slug])) {
            return $presetGalleries[$this->slug];
        }

        $defaultCover = $this->cover_image ?: 'assets/images/destinasi/pahawang.jpg';
        return [
            $defaultCover,
            'assets/images/galeri/galeri-1.jpg',
            'assets/images/galeri/galeri-2.jpg',
            'assets/images/galeri/galeri-3.jpg',
        ];
    }
}
