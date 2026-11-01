<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        // Video non-unggulan (koleksi lengkap galeri reguler)
        $galleryItems = GalleryItem::where('media_type', 'video')
            ->where('is_featured', false)
            ->orderBy('order')
            ->paginate(8)
            ->withQueryString();

        return view('pages.gallery.index', compact('galleryItems'));
    }
}
