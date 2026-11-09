<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index(Request $request): Response
    {
        $categories = Category::withCount(['tourPackages', 'posts', 'galleryItems'])
            ->when($request->type, fn ($q, $t) => $q->where('type', $t))
            ->orderBy('type')
            ->orderBy('name')
            ->get();

        return Inertia::render('Categories/Index', [
            'categories' => $categories,
            'filters' => [
                'type' => $request->type ?? '',
            ],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:tour,article,gallery',
            'description' => 'nullable|string|max:500',
        ]);

        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $counter = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }
        $validated['slug'] = $slug;

        Category::create($validated);

        return back()->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:tour,article,gallery',
            'description' => 'nullable|string|max:500',
        ]);

        if ($category->name !== $validated['name']) {
            $baseSlug = Str::slug($validated['name']);
            $slug = $baseSlug;
            $counter = 1;
            while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
                $slug = "{$baseSlug}-{$counter}";
                $counter++;
            }
            $validated['slug'] = $slug;
        }

        $category->update($validated);

        return back()->with('success', 'Data kategori berhasil diperbarui.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $packagesCount = $category->tourPackages()->count();
        $postsCount = $category->posts()->count();

        if ($packagesCount > 0 || $postsCount > 0) {
            return back()->with('error', "Kategori tidak dapat dihapus karena masih digunakan oleh {$packagesCount} paket wisata dan {$postsCount} artikel.");
        }

        $category->delete();

        return back()->with('success', 'Kategori telah dihapus.');
    }
}
