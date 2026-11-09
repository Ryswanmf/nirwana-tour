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
                    : ($item->thumbnail ? asset('storage/' . $item->thumbnail) : ($item->thumbnail_url ?? asset('assets/images/destinasi/pahawang.jpg'))),
                'file_url' => $item->file_url,
                'video_url' => $item->file_path,
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
            'caption' => 'nullable|string|max:1000',
            'order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'file' => 'nullable|file|max:102400', // Mendukung file video/foto hingga 100MB
            'thumbnail' => 'nullable|image|max:5120',
        ]);

        $filePath = '';

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('gallery', 'public');
        } elseif ($request->filled('video_url')) {
            $filePath = $request->input('video_url');
        }

        if (empty($filePath) && in_array($validated['media_type'], ['reel', 'video']) && $request->filled('video_url')) {
            $filePath = $request->input('video_url');
        }

        if (empty($filePath) && $validated['media_type'] === 'image' && !$request->hasFile('file')) {
            return back()->withErrors(['file' => 'File foto wajib diunggah untuk format gambar.']);
        }

        if (empty($filePath) && $validated['media_type'] === 'video' && !$request->hasFile('file') && !$request->filled('video_url')) {
            return back()->withErrors(['file' => 'File video (.mp4) atau URL video wajib diunggah/diisi.']);
        }

        if (empty($filePath) && $validated['media_type'] === 'reel' && !$request->filled('video_url')) {
            return back()->withErrors(['video_url' => 'Tautan / URL Reels Instagram wajib diisi.']);
        }

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('gallery-thumbs', 'public');
        }

        GalleryItem::create([
            'title' => $validated['title'],
            'category_id' => $validated['category_id'] ?? null,
            'media_type' => $validated['media_type'],
            'file_path' => $filePath,
            'thumbnail' => $thumbnailPath,
            'caption' => $validated['caption'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_featured' => (bool) ($validated['is_featured'] ?? false),
        ]);

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
                'video_url' => str_starts_with($gallery->file_path ?? '', 'http') ? $gallery->file_path : '',
                'caption' => $gallery->caption,
                'order' => $gallery->order,
                'is_featured' => (bool) $gallery->is_featured,
                'preview_url' => $gallery->file_path ? (str_starts_with($gallery->file_path, 'http') ? $gallery->file_path : asset('storage/' . $gallery->file_path)) : null,
                'thumb_preview' => $gallery->thumbnail ? asset('storage/' . $gallery->thumbnail) : null,
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
            'caption' => 'nullable|string|max:1000',
            'order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'file' => 'nullable|file|max:102400',
            'thumbnail' => 'nullable|image|max:5120',
        ]);

        $filePath = $gallery->file_path;

        if ($request->hasFile('file')) {
            if ($gallery->file_path && !str_starts_with($gallery->file_path, 'http') && Storage::disk('public')->exists($gallery->file_path)) {
                Storage::disk('public')->delete($gallery->file_path);
            }
            $filePath = $request->file('file')->store('gallery', 'public');
        } elseif ($request->filled('video_url') && in_array($validated['media_type'], ['reel', 'video'])) {
            $filePath = $request->input('video_url');
        }

        $thumbnailPath = $gallery->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($gallery->thumbnail && Storage::disk('public')->exists($gallery->thumbnail)) {
                Storage::disk('public')->delete($gallery->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('gallery-thumbs', 'public');
        }

        $gallery->update([
            'title' => $validated['title'],
            'category_id' => $validated['category_id'] ?? null,
            'media_type' => $validated['media_type'],
            'file_path' => $filePath,
            'thumbnail' => $thumbnailPath,
            'caption' => $validated['caption'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_featured' => (bool) ($validated['is_featured'] ?? false),
        ]);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Media galeri berhasil diperbarui.');
    }

    public function destroy(GalleryItem $gallery): RedirectResponse
    {
        if ($gallery->file_path && !str_starts_with($gallery->file_path, 'http') && Storage::disk('public')->exists($gallery->file_path)) {
            Storage::disk('public')->delete($gallery->file_path);
        }

        if ($gallery->thumbnail && Storage::disk('public')->exists($gallery->thumbnail)) {
            Storage::disk('public')->delete($gallery->thumbnail);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Media galeri berhasil dihapus.');
    }

    public function bulkDelete(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'exists:gallery_items,id',
        ]);

        $items = GalleryItem::whereIn('id', $validated['ids'])->get();

        foreach ($items as $item) {
            if ($item->file_path && !str_starts_with($item->file_path, 'http') && Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }
            if ($item->thumbnail && Storage::disk('public')->exists($item->thumbnail)) {
                Storage::disk('public')->delete($item->thumbnail);
            }
            $item->delete();
        }

        return redirect()->route('admin.gallery.index')
            ->with('success', count($validated['ids']) . ' media galeri berhasil dihapus.');
    }

    public function toggle(GalleryItem $gallery): RedirectResponse
    {
        $gallery->update([
            'is_featured' => !$gallery->is_featured,
        ]);

        return back()->with('success', 'Status media pilihan berhasil diperbarui.');
    }
}
