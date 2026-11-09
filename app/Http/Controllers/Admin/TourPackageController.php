<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\TourPackage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class TourPackageController extends Controller
{
    /**
     * Tampilkan daftar paket wisata dengan filter dan pencarian
     */
    public function index(Request $request): Response
    {
        $query = TourPackage::with('category:id,name')
            ->when($request->search, function ($q, $search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('title', 'like', "%{$search}%")
                        ->orWhere('destination_location', 'like', "%{$search}%");
                });
            })
            ->when($request->category, function ($q, $cat) {
                $q->where('category_id', $cat);
            })
            ->when($request->status !== null && $request->status !== '', function ($q) use ($request) {
                $q->where('is_active', filter_var($request->status, FILTER_VALIDATE_BOOLEAN));
            })
            ->orderBy('order', 'asc')
            ->latest('id');

        $packages = $query->paginate(10)->withQueryString()->through(function ($pkg) {
            return [
                'id' => $pkg->id,
                'title' => $pkg->title,
                'slug' => $pkg->slug,
                'badge' => $pkg->badge,
                'destination_location' => $pkg->destination_location,
                'price_from' => $pkg->price_from,
                'price_formatted' => 'Rp ' . number_format($pkg->price_from, 0, ',', '.'),
                'duration' => "{$pkg->duration_days} Hari" . ($pkg->duration_nights ? " {$pkg->duration_nights} Malam" : ''),
                'thumbnail_url' => $pkg->thumbnail ? (str_starts_with($pkg->thumbnail, 'http') ? $pkg->thumbnail : asset('storage/' . $pkg->thumbnail)) : asset('assets/images/destinasi/pahawang.jpg'),
                'is_featured' => (bool) $pkg->is_featured,
                'is_active' => (bool) $pkg->is_active,
                'category_name' => $pkg->category?->name ?? 'Umum',
            ];
        });

        $categories = Category::select('id', 'name')->orderBy('name')->get();

        return Inertia::render('Packages/Index', [
            'packages' => $packages,
            'categories' => $categories,
            'filters' => [
                'search' => $request->search ?? '',
                'category' => $request->category ?? '',
                'status' => $request->status ?? '',
            ],
        ]);
    }

    /**
     * Tampilkan form pembuatan paket wisata baru
     */
    public function create(): Response
    {
        return Inertia::render('Packages/Form', [
            'package' => null,
            'categories' => Category::select('id', 'name')->orderBy('name')->get(),
        ]);
    }

    /**
     * Simpan paket wisata baru ke database
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:tour_packages,slug',
            'category_id' => 'nullable|exists:categories,id',
            'badge' => 'nullable|string|max:50',
            'destination_location' => 'nullable|string|max:255',
            'price_from' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'duration_nights' => 'nullable|integer|min:0',
            'min_pax' => 'required|integer|min:1',
            'summary' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
            'thumbnail' => 'nullable|image|max:3072',
            'itinerary' => 'nullable|array',
            'includes' => 'nullable|array',
            'excludes' => 'nullable|array',
            'faqs' => 'nullable|array',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
            $count = TourPackage::where('slug', 'like', "{$validated['slug']}%")->count();
            if ($count > 0) {
                $validated['slug'] .= '-' . ($count + 1);
            }
        }

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('tour-packages', 'public');
            $validated['thumbnail'] = $path;
        }

        TourPackage::create($validated);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket wisata baru berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit paket wisata
     */
    public function edit(TourPackage $package): Response
    {
        return Inertia::render('Packages/Form', [
            'package' => [
                'id' => $package->id,
                'title' => $package->title,
                'slug' => $package->slug,
                'category_id' => $package->category_id,
                'badge' => $package->badge,
                'destination_location' => $package->destination_location,
                'price_from' => $package->price_from,
                'duration_days' => $package->duration_days,
                'duration_nights' => $package->duration_nights,
                'min_pax' => $package->min_pax,
                'summary' => $package->summary,
                'description' => $package->description,
                'thumbnail_url' => $package->thumbnail ? (str_starts_with($package->thumbnail, 'http') ? $package->thumbnail : asset('storage/' . $package->thumbnail)) : null,
                'itinerary' => $package->itinerary ?? [],
                'includes' => $package->includes ?? [],
                'excludes' => $package->excludes ?? [],
                'faqs' => $package->faqs ?? [],
                'is_featured' => (bool) $package->is_featured,
                'is_active' => (bool) $package->is_active,
                'order' => $package->order,
            ],
            'categories' => Category::select('id', 'name')->orderBy('name')->get(),
        ]);
    }

    /**
     * Update data paket wisata di database
     */
    public function update(Request $request, TourPackage $package): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => "nullable|string|max:255|unique:tour_packages,slug,{$package->id}",
            'category_id' => 'nullable|exists:categories,id',
            'badge' => 'nullable|string|max:50',
            'destination_location' => 'nullable|string|max:255',
            'price_from' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'duration_nights' => 'nullable|integer|min:0',
            'min_pax' => 'required|integer|min:1',
            'summary' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
            'thumbnail' => 'nullable|image|max:3072',
            'itinerary' => 'nullable|array',
            'includes' => 'nullable|array',
            'excludes' => 'nullable|array',
            'faqs' => 'nullable|array',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('thumbnail')) {
            if ($package->thumbnail && Storage::disk('public')->exists($package->thumbnail)) {
                Storage::disk('public')->delete($package->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('tour-packages', 'public');
        } else {
            unset($validated['thumbnail']);
        }

        $package->update($validated);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket wisata berhasil diperbarui.');
    }

    /**
     * Hapus paket wisata
     */
    public function destroy(TourPackage $package): RedirectResponse
    {
        if ($package->thumbnail && Storage::disk('public')->exists($package->thumbnail)) {
            Storage::disk('public')->delete($package->thumbnail);
        }

        $package->delete();

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket wisata telah berhasil dihapus.');
    }

    /**
     * Hapus banyak paket wisata sekaligus (Bulk Delete)
     */
    public function bulkDelete(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:tour_packages,id',
        ]);

        $packages = TourPackage::whereIn('id', $validated['ids'])->get();
        $count = $packages->count();

        foreach ($packages as $pkg) {
            if ($pkg->thumbnail && Storage::disk('public')->exists($pkg->thumbnail)) {
                Storage::disk('public')->delete($pkg->thumbnail);
            }
            $pkg->delete();
        }

        return redirect()->route('admin.packages.index')
            ->with('success', "{$count} paket wisata berhasil dihapus sekaligus.");
    }

    /**
     * Cepat ubah status aktif atau status unggulan
     */
    public function toggle(Request $request, TourPackage $package): RedirectResponse
    {
        $field = $request->input('field');
        if (in_array($field, ['is_active', 'is_featured'])) {
            $package->update([
                $field => !$package->{$field},
            ]);
            $statusName = $field === 'is_active' ? 'Status publikasi' : 'Status unggulan';
            return back()->with('success', "{$statusName} berhasil diubah.");
        }

        return back()->with('error', 'Aksi tidak valid.');
    }
}
