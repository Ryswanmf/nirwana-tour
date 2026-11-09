<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\GalleryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class GalleryController extends Controller
{
    public function index(Request $request): Response
    {
        $items = GalleryItem::with('category:id,name')
            ->when($request->search, fn ($q, $s) => $q->where('title', 'like', "%{$s}%"))
            ->when($request->type, fn ($q, $t) => $q->where('media_type', $t))
            ->orderBy('order', 'asc')
            ->latest('id')
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($item) => [
                'id' => $item->id,
                'title' => $item->title,
                'media_type' => $item->media_type,
                'category_name' => $item->category?->name ?? 'Umum',
                'preview_url' => $item->media_type === 'image' 
                    ? ($item->file_path ? (str_starts_with($item->file_path, 'http') ? $item->file_path : asset('storage/' . $item->file_path)) : asset('assets/images/destinasi/pahawang.jpg'))
                    : ($item->thumbnail_url ? asset('storage/' . $item->thumbnail_url) : asset('assets/images/destinasi/pahawang.jpg')),
                'video_url' => $item->video_url,
                'is_featured' => (bool) $item->is_featured,
                'order' => $item->order,
            ]);

        return Inertia::render('Gallery/Index', [
            'items' => $items,
            'filters' => [
                'search' => $request->search ?? '',
                'type' => $request->type ?? '',
            ],
            'categories' => Category::select('id', 'name')->orderBy('name')->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Gallery/Form', [
            'item' => null,
            'categories' => Category::select('id', 'name')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'media_type' => 'required|in:image,video,reel',
            'video_url' => 'nullable|string|max:500',
            'caption' => 'nullable|string|max:500',
            'order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'file' => 'nullable|image|max:4096',
            'thumbnail' => 'nullable|image|max:3072',
        ]);

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('gallery', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail_url'] = $request->file('thumbnail')->store('gallery-thumbs', 'public');
        }

        GalleryItem::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Media galeri berhasil ditambahkan.');
    }

    public function edit(GalleryItem $gallery): Response
    {
        return Inertia::render('Gallery/Form', [
            'item' => [
                'id' => $gallery->id,
                'title' => $gallery->title,
                'category_id' => $gallery->category_id,
                'media_type' => $gallery->media_type,
                'video_url' => $gallery->video_url,
                'caption' => $gallery->caption,
                'order' => $gallery->order,
                'is_featured' => (bool) $gallery->is_featured,
                'preview_url' => $gallery->file_path ? asset('storage/' . $gallery->file_path) : null,
                'thumb_preview' => $gallery->thumbnail_url ? asset('storage/' . $gallery->thumbnail_url) : null,
            ],
            'categories' => Category::select('id', 'name')->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, GalleryItem $gallery): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'media_type' => 'required|in:image,video,reel',
            'video_url' => 'nullable|string|max:500',
            'caption' => 'nullable|string|max:500',
            'order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'file' => 'nullable|image|max:4096',
            'thumbnail' => 'nullable|image|max:3072',
        ]);

        if ($request->hasFile('file')) {
            if ($gallery->file_path && Storage::disk('public')->exists($gallery->file_path)) {
                Storage::disk('public')->delete($gallery->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('gallery', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($gallery->thumbnail_url && Storage::disk('public')->exists($gallery->thumbnail_url)) {
                Storage::disk('public')->delete($gallery->thumbnail_url);
            }
            $validated['thumbnail_url'] = $request->file('thumbnail')->store('gallery-thumbs', 'public');
        }

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Media galeri berhasil diperbarui.');
    }

    public function destroy(GalleryItem $gallery): RedirectResponse
    {
        if ($gallery->file_path && Storage::disk('public')->exists($gallery->file_path)) {
            Storage::disk('public')->delete($gallery->file_path);
        }
        if ($gallery->thumbnail_url && Storage::disk('public')->exists($gallery->thumbnail_url)) {
            Storage::disk('public')->delete($gallery->thumbnail_url);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Media galeri telah dihapus.');
    }

    /**
     * Hapus banyak media galeri sekaligus (Bulk Delete)
     */
    public function bulkDelete(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:gallery_items,id',
        ]);

        $items = GalleryItem::whereIn('id', $validated['ids'])->get();
        $count = $items->count();

        foreach ($items as $item) {
            if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }
            if ($item->thumbnail_url && Storage::disk('public')->exists($item->thumbnail_url)) {
                Storage::disk('public')->delete($item->thumbnail_url);
            }
            $item->delete();
        }

        return redirect()->route('admin.gallery.index')
            ->with('success', "{$count} media galeri berhasil dihapus sekaligus.");
    }

    public function toggle(GalleryItem $gallery): RedirectResponse
    {
        $gallery->update(['is_featured' => !$gallery->is_featured]);
        return back()->with('success', 'Status unggulan galeri diperbarui.');
    }
}
