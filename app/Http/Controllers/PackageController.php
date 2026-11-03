<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class PackageController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Cache::remember('nirwana_tour_categories', 3600, function () {
            return Category::where('type', 'tour')->withCount(['tourPackages' => fn ($q) => $q->where('is_active', true)])->get();
        });

        $query = TourPackage::where('is_active', true)->with('category');

        if ($request->filled('kategori')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        if ($request->filled('durasi')) {
            switch ($request->durasi) {
                case '1':
                case 'oneday':
                    $query->where('duration_days', 1)->where('duration_nights', 0);
                    break;
                case '2d1n':
                    $query->where('duration_days', 2)->where('duration_nights', 1);
                    break;
                case '3d2n':
                    $query->where('duration_days', 3)->where('duration_nights', 2);
                    break;
                case 'multidays':
                    $query->where('duration_days', '>=', 4);
                    break;
            }
        }

        if ($request->filled('budget')) {
            switch ($request->budget) {
                case 'under_500k':
                    $query->where('price_from', '<=', 500000);
                    break;
                case '500k_1500k':
                    $query->whereBetween('price_from', [500001, 1500000]);
                    break;
                case 'above_1500k':
                    $query->where('price_from', '>', 1500000);
                    break;
            }
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('destination_location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'termurah':
                    $query->orderBy('price_from', 'asc');
                    break;
                case 'termahal':
                    $query->orderBy('price_from', 'desc');
                    break;
                default:
                    $query->orderBy('order');
                    break;
            }
        } else {
            $query->orderBy('order');
        }

        $packages = $query->paginate(9)->withQueryString();

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
