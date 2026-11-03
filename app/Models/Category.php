<?php

namespace App\Models;

use App\Traits\ClearsHomeCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, ClearsHomeCache;

    protected $guarded = ['id'];

    public function tourPackages(): HasMany
    {
        return $this->hasMany(TourPackage::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function galleryItems(): HasMany
    {
        return $this->hasMany(GalleryItem::class);
    }
}
