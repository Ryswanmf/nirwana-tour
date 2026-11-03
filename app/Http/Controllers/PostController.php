<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        // Hanya menampilkan berita non-unggulan di Halaman Berita (berita unggulan tampil di Beranda)
        $query = Post::where('is_published', true)
            ->where('is_featured', false)
            ->with('category');

        // Pencarian kata kunci judul / isi berita
        if ($request->filled('q')) {
            $keyword = trim($request->query('q'));
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('excerpt', 'like', "%{$keyword}%")
                  ->orWhere('content', 'like', "%{$keyword}%")
                  ->orWhere('category_name', 'like', "%{$keyword}%");
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $catSlug = $request->query('category');
            $query->where(function ($q) use ($catSlug) {
                $q->whereHas('category', function ($sub) use ($catSlug) {
                    $sub->where('slug', $catSlug);
                })->orWhere('category_name', 'like', "%{$catSlug}%");
            });
        }

        // Pengurutan
        $sort = $request->query('sort', 'latest');
        if ($sort === 'oldest') {
            $query->orderBy('published_at', 'asc');
        } else {
            $query->orderByDesc('published_at');
        }

        $posts = $query->paginate(6)->withQueryString();
        $categories = Category::where('type', 'article')
            ->withCount(['posts' => fn ($q) => $q->where('is_published', true)->where('is_featured', false)])
            ->get();

        return view('pages.articles.index', compact('posts', 'categories'));
    }

    public function show(string $slug): View
    {
        $post = Post::where('slug', $slug)
            ->where('is_published', true)
            ->with('category')
            ->firstOrFail();

        $recentPosts = Post::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->orderByDesc('published_at')
            ->take(4)
            ->get();

        $prevPost = Post::where('is_published', true)
            ->where(function ($q) use ($post) {
                $q->where('published_at', '<', $post->published_at)
                  ->orWhere(function ($sub) use ($post) {
                      $sub->where('published_at', '=', $post->published_at)
                          ->where('id', '<', $post->id);
                  });
            })
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->first();

        $nextPost = Post::where('is_published', true)
            ->where(function ($q) use ($post) {
                $q->where('published_at', '>', $post->published_at)
                  ->orWhere(function ($sub) use ($post) {
                      $sub->where('published_at', '=', $post->published_at)
                          ->where('id', '>', $post->id);
                  });
            })
            ->orderBy('published_at', 'asc')
            ->orderBy('id', 'asc')
            ->first();

        return view('pages.articles.show', compact('post', 'recentPosts', 'prevPost', 'nextPost'));
    }
}
