<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $galleryItems = GalleryItem::where('media_type', 'video')
            ->orderBy('order')
            ->paginate(8)
            ->withQueryString();

        return view('pages.gallery.index', compact('galleryItems'));
    }
}
