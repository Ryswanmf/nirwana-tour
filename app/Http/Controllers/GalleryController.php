<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        // Video & Reel non-unggulan (koleksi lengkap galeri reguler)
        $galleryItems = GalleryItem::whereIn('media_type', ['video', 'reel'])
            ->where('is_featured', false)
            ->orderBy('order')
            ->paginate(8)
            ->withQueryString();

        return view('pages.gallery.index', compact('galleryItems'));
    }
}
