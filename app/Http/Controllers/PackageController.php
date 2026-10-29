<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PackageController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::where('type', 'tour')->withCount(['tourPackages' => fn ($q) => $q->where('is_active', true)])->get();

        $query = TourPackage::where('is_active', true)->with('category');

        if ($request->filled('kategori')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('destination_location', 'like', "%{$search}%");
            });
        }

        $packages = $query->orderBy('order')->paginate(9)->withQueryString();

        return view('pages.packages.index', compact('packages', 'categories'));
    }

    public function show(string $slug): View
    {
        $package = TourPackage::where('slug', $slug)
            ->where('is_active', true)
            ->with('category')
            ->firstOrFail();

        $relatedPackages = TourPackage::where('is_active', true)
            ->where('id', '!=', $package->id)
            ->where('category_id', $package->category_id)
            ->take(3)
            ->get();

        return view('pages.packages.show', compact('package', 'relatedPackages'));
    }
}
