<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fleet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class FleetController extends Controller
{
    public function index(): Response
    {
        $fleets = Fleet::orderBy('order', 'asc')
            ->latest('id')
            ->get()
            ->map(fn ($f) => [
                'id' => $f->id,
                'name' => $f->name,
                'type' => $f->type ?? 'Bus Pariwisata',
                'capacity' => $f->capacity ?? '30-50 Seat',
                'facilities' => $f->facilities ?? [],
                'image_url' => $f->image_url,
                'is_active' => (bool) $f->is_active,
                'order' => $f->order,
            ]);

        return Inertia::render('Fleets/Index', [
            'fleets' => $fleets,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:100',
            'capacity' => 'nullable|string|max:100',
            'facilities' => 'nullable|array',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:3072',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('fleets', 'public');
        }

        Fleet::create($validated);

        return back()->with('success', 'Armada berhasil ditambahkan.');
    }

    public function update(Request $request, Fleet $fleet): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:100',
            'capacity' => 'nullable|string|max:100',
            'facilities' => 'nullable|array',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:3072',
        ]);

        if ($request->hasFile('image')) {
            if ($fleet->image && Storage::disk('public')->exists($fleet->image)) {
                Storage::disk('public')->delete($fleet->image);
            }
            $validated['image'] = $request->file('image')->store('fleets', 'public');
        }

        $fleet->update($validated);

        return back()->with('success', 'Armada berhasil diperbarui.');
    }

    public function destroy(Fleet $fleet): RedirectResponse
    {
        if ($fleet->image && Storage::disk('public')->exists($fleet->image)) {
            Storage::disk('public')->delete($fleet->image);
        }

        $fleet->delete();

        return back()->with('success', 'Armada telah dihapus.');
    }
}
