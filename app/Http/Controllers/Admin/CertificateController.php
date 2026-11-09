<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class CertificateController extends Controller
{
    public function index(): Response
    {
        $certificates = Certificate::orderBy('order', 'asc')
            ->latest('id')
            ->get()
            ->map(fn ($c) => [
                'id' => $c->id,
                'title' => $c->title,
                'slug' => $c->slug,
                'issuer' => $c->issuer,
                'certificate_number' => $c->certificate_number,
                'badge' => $c->badge,
                'icon' => $c->icon ?: 'fa-solid fa-certificate',
                'description' => $c->description,
                'image_url' => $c->image_url,
                'file_url' => $c->file_url,
                'order' => $c->order,
                'is_active' => (bool) $c->is_active,
            ]);

        return Inertia::render('Certificates/Index', [
            'certificates' => $certificates,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'certificate_number' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:100',
            'icon' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:3072',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $counter = 1;
        while (Certificate::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('certificates/images', 'public');
        }

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('certificates/documents', 'public');
        }

        Certificate::create($validated);

        return back()->with('success', 'Dokumen legalitas/sertifikasi berhasil ditambahkan.');
    }

    public function update(Request $request, Certificate $certificate): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'certificate_number' => 'nullable|string|max:255',
            'badge' => 'nullable|string|max:100',
            'icon' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:3072',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        if ($certificate->title !== $validated['title']) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $counter = 1;
            while (Certificate::where('slug', $slug)->where('id', '!=', $certificate->id)->exists()) {
                $slug = "{$baseSlug}-{$counter}";
                $counter++;
            }
            $validated['slug'] = $slug;
        }

        if ($request->hasFile('image')) {
            if ($certificate->image && Storage::disk('public')->exists($certificate->image)) {
                Storage::disk('public')->delete($certificate->image);
            }
            $validated['image'] = $request->file('image')->store('certificates/images', 'public');
        }

        if ($request->hasFile('file')) {
            if ($certificate->file && Storage::disk('public')->exists($certificate->file)) {
                Storage::disk('public')->delete($certificate->file);
            }
            $validated['file'] = $request->file('file')->store('certificates/documents', 'public');
        }

        $certificate->update($validated);

        return back()->with('success', 'Dokumen legalitas/sertifikasi berhasil diperbarui.');
    }

    public function destroy(Certificate $certificate): RedirectResponse
    {
        if ($certificate->image && Storage::disk('public')->exists($certificate->image)) {
            Storage::disk('public')->delete($certificate->image);
        }

        if ($certificate->file && Storage::disk('public')->exists($certificate->file)) {
            Storage::disk('public')->delete($certificate->file);
        }

        $certificate->delete();

        return back()->with('success', 'Dokumen legalitas/sertifikasi telah dihapus.');
    }

    public function toggle(Certificate $certificate): RedirectResponse
    {
        $certificate->update([
            'is_active' => !$certificate->is_active,
        ]);

        return back()->with('success', 'Status dokumen berhasil diubah.');
    }
}
