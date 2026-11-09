<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class TestimonialController extends Controller
{
    /**
     * Tampilkan daftar testimoni & ulasan pelanggan
     */
    public function index(Request $request): Response
    {
        $query = Testimonial::query()
            ->when($request->search, function ($q, $search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('client_name', 'like', "%{$search}%")
                        ->orWhere('organization', 'like', "%{$search}%")
                        ->orWhere('trip_name', 'like', "%{$search}%")
                        ->orWhere('comment', 'like', "%{$search}%");
                });
            })
            ->when($request->status !== null && $request->status !== '', function ($q) use ($request) {
                $q->where('is_active', $request->status === 'active');
            })
            ->orderBy('order', 'asc')
            ->latest('id');

        $testimonials = $query->paginate(10)->withQueryString()->through(function ($item) {
            return [
                'id' => $item->id,
                'client_name' => $item->client_name,
                'organization' => $item->organization,
                'role' => $item->role,
                'trip_name' => $item->trip_name,
                'rating' => $item->rating,
                'comment' => $item->comment,
                'avatar' => $item->avatar,
                'avatar_url' => $item->avatar_url,
                'is_active' => (bool) $item->is_active,
                'order' => $item->order,
                'created_at' => $item->created_at ? $item->created_at->format('d M Y') : '-',
            ];
        });

        $stats = [
            'total' => Testimonial::count(),
            'active' => Testimonial::where('is_active', true)->count(),
            'pending' => Testimonial::where('is_active', false)->count(),
        ];

        return Inertia::render('Testimonials/Index', [
            'testimonials' => $testimonials,
            'filters' => [
                'search' => $request->search ?? '',
                'status' => $request->status ?? '',
            ],
            'stats' => $stats,
        ]);
    }

    /**
     * Simpan testimoni baru
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'organization' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'trip_name' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'avatar' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        $validated['order'] = $validated['order'] ?? (Testimonial::max('order') + 1);
        $validated['is_active'] = $request->boolean('is_active', true);

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Ulasan testimoni berhasil ditambahkan.');
    }

    /**
     * Perbarui testimoni yang ada
     */
    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'organization' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'trip_name' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'avatar' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('avatar')) {
            if ($testimonial->avatar && Storage::disk('public')->exists($testimonial->avatar)) {
                Storage::disk('public')->delete($testimonial->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Ulasan testimoni berhasil diperbarui.');
    }

    /**
     * Hapus testimoni
     */
    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        if ($testimonial->avatar && Storage::disk('public')->exists($testimonial->avatar)) {
            Storage::disk('public')->delete($testimonial->avatar);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Ulasan testimoni berhasil dihapus.');
    }

    /**
     * Hapus banyak testimoni sekaligus (Bulk Delete)
     */
    public function bulkDelete(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ids' => 'required|array|min:1',
            'ids.*' => 'integer|exists:testimonials,id',
        ]);

        $items = Testimonial::whereIn('id', $validated['ids'])->get();
        $count = $items->count();

        foreach ($items as $item) {
            if ($item->avatar && Storage::disk('public')->exists($item->avatar)) {
                Storage::disk('public')->delete($item->avatar);
            }
            $item->delete();
        }

        return redirect()->route('admin.testimonials.index')
            ->with('success', "{$count} ulasan testimoni berhasil dihapus sekaligus.");
    }

    /**
     * Toggle status aktif/publikasi testimoni
     */
    public function toggle(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update([
            'is_active' => !$testimonial->is_active,
        ]);

        $statusText = $testimonial->is_active ? 'ditampilkan di website' : 'disembunyikan';

        return back()->with('success', "Testimoni dari {$testimonial->client_name} kini {$statusText}.");
    }
}
