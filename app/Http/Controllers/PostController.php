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
        $query = Post::where('is_published', true)->with('category');

        // Pencarian kata kunci judul / isi berita
        if ($request->filled('q')) {
            $keyword = trim($request->query('q'));
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('excerpt', 'like', "%{$keyword}%")
                  ->orWhere('content', 'like', "%{$keyword}%");
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->query('category'));
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
        $categories = Category::where('type', 'article')->withCount('posts')->get();

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

        return view('pages.articles.show', compact('post', 'recentPosts'));
    }
}
