<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\GalleryItem;
use App\Models\Post;
use App\Services\ArticleGeneratorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function index(Request $request): Response
    {
        $posts = Post::with('category:id,name')
            ->when($request->search, fn ($q, $search) => $q->where('title', 'like', "%{$search}%"))
            ->when($request->category, fn ($q, $cat) => $q->where('category_id', $cat))
            ->latest('id')
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($item) => [
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'category_name' => $item->category_name_display,
                'cover_image_url' => $item->cover_image_url,
                'author_name' => $item->author_name ?? 'Admin Nirwana',
                'is_published' => (bool) $item->is_published,
                'is_featured' => (bool) $item->is_featured,
                'is_scheduled' => (bool) ($item->is_published && $item->published_at && $item->published_at->isFuture()),
                'published_at' => $item->published_at ? $item->published_at->format('d M Y') : '-',
            ]);

        $categories = Category::select('id', 'name')->orderBy('name')->get();

        return Inertia::render('Posts/Index', [
            'posts' => $posts,
            'categories' => $categories,
            'filters' => [
                'search' => $request->search ?? '',
                'category' => $request->category ?? '',
            ],
        ]);
    }

    public function generator(): Response
    {
        $galleryImagesCount = GalleryItem::where('media_type', 'image')->count();

        return Inertia::render('Posts/Generator', [
            'categories' => Category::select('id', 'name')->orderBy('name')->get(),
            'galleryImagesCount' => $galleryImagesCount,
        ]);
    }

    public function generate(Request $request, ArticleGeneratorService $generatorService): RedirectResponse
    {
        $request->validate([
            'titles_raw' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'category_name' => 'nullable|string|max:100',
            'start_date' => 'required|date',
            'interval_days' => 'required|integer|min:0|max:30',
            'status' => 'required|in:published,draft',
            'feature_first' => 'nullable|boolean',
            'images.*' => 'nullable|image|max:5120',
        ]);

        $titles = preg_split('/\r\n|\r|\n/', (string) $request->input('titles_raw'));
        $uploadedFiles = $request->file('images', []);

        $result = $generatorService->generateBatch(
            $titles,
            $uploadedFiles,
            [
                'category_id' => $request->category_id,
                'category_name' => $request->category_name,
                'start_date' => $request->start_date,
                'interval_days' => (int) $request->interval_days,
                'status' => $request->status,
                'feature_first' => (bool) $request->feature_first,
            ],
            auth()->user()?->name ?? 'Admin Nirwana'
        );

        if ($result['count'] === 0) {
            return back()->withErrors(['titles_raw' => 'Tidak ada judul artikel yang valid untuk digenerate. Masukkan minimal 1 judul.']);
        }

        $message = "Berhasil membuat {$result['count']} artikel otomatis berstruktur SEO!";
        if ($result['count'] > 1 && $result['first_date'] && $result['last_date']) {
            $message .= " Jadwal rilis: {$result['first_date']} s/d {$result['last_date']}.";
        }

        return redirect()->route('admin.posts.index')->with('success', $message);
    }

    public function create(): Response
    {
        return Inertia::render('Posts/Form', [
            'post' => null,
            'categories' => Category::select('id', 'name')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'category_id' => 'nullable|exists:categories,id',
            'category_name' => 'nullable|string|max:100',
            'excerpt' => 'nullable|string|max:1000',
            'content' => 'required|string',
            'author_name' => 'nullable|string|max:100',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'cover_image' => 'nullable|image|max:3072',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
            $count = Post::where('slug', 'like', "{$validated['slug']}%")->count();
            if ($count > 0) {
                $validated['slug'] .= '-' . ($count + 1);
            }
        }

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('posts', 'public');
        }

        if ($validated['is_published'] ?? false) {
            $validated['published_at'] = now();
        }

        Post::create($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Artikel / berita berhasil diterbitkan.');
    }

    public function edit(Post $post): Response
    {
        return Inertia::render('Posts/Form', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'category_id' => $post->category_id,
                'category_name' => $post->category_name,
                'excerpt' => $post->excerpt,
                'content' => $post->content,
                'author_name' => $post->author_name,
                'cover_image_url' => $post->cover_image_url,
                'is_published' => (bool) $post->is_published,
                'is_featured' => (bool) $post->is_featured,
            ],
            'categories' => Category::select('id', 'name')->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => "nullable|string|max:255|unique:posts,slug,{$post->id}",
            'category_id' => 'nullable|exists:categories,id',
            'category_name' => 'nullable|string|max:100',
            'excerpt' => 'nullable|string|max:1000',
            'content' => 'required|string',
            'author_name' => 'nullable|string|max:100',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'cover_image' => 'nullable|image|max:3072',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('cover_image')) {
            if ($post->cover_image && Storage::disk('public')->exists($post->cover_image)) {
                Storage::disk('public')->delete($post->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('posts', 'public');
        } else {
            unset($validated['cover_image']);
        }

        if (($validated['is_published'] ?? false) && ! $post->published_at) {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        if ($post->cover_image && Storage::disk('public')->exists($post->cover_image)) {
            Storage::disk('public')->delete($post->cover_image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Artikel telah dihapus.');
    }

    /**
     * Hapus banyak artikel sekaligus (Bulk Delete)
     */
    public function bulkDelete(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:posts,id',
        ]);

        $posts = Post::whereIn('id', $validated['ids'])->get();
        $count = $posts->count();

        foreach ($posts as $item) {
            if ($item->cover_image && Storage::disk('public')->exists($item->cover_image)) {
                Storage::disk('public')->delete($item->cover_image);
            }
            $item->delete();
        }

        return redirect()->route('admin.posts.index')
            ->with('success', "{$count} artikel berhasil dihapus sekaligus.");
    }

    public function toggle(Request $request, Post $post): RedirectResponse
    {
        $field = $request->input('field', 'is_published');
        if (in_array($field, ['is_published', 'is_featured'])) {
            $post->update([$field => !$post->{$field}]);
            return back()->with('success', 'Status artikel berhasil diubah.');
        }
        return back();
    }
}
