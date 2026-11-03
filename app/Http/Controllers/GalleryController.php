<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $type = $request->query('type');

        $query = GalleryItem::where('is_featured', false);

        if ($type === 'video') {
            $query->whereIn('media_type', ['video', 'reel']);
        } elseif ($type === 'image') {
            $query->where('media_type', 'image');
        }

        $galleryItems = $query->orderBy('order')
            ->paginate(12)
            ->withQueryString();

        return view('pages.gallery.index', compact('galleryItems', 'type'));
    }
}
