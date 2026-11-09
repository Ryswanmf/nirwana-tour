<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    public function index(): Response
    {
        $contacts = Contact::orderByDesc('is_primary')
            ->orderBy('order', 'asc')
            ->latest('id')
            ->get();

        return Inertia::render('Contacts/Index', [
            'contacts' => $contacts,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'address' => 'required|string',
            'city' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'operating_hours' => 'nullable|string|max:255',
            'google_maps_embed' => 'nullable|string',
            'google_maps_url' => 'nullable|url|max:500',
            'description' => 'nullable|string',
            'is_primary' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        if (!empty($validated['is_primary'])) {
            Contact::where('is_primary', true)->update(['is_primary' => false]);
        }

        Contact::create($validated);

        return back()->with('success', 'Kontak / Cabang berhasil ditambahkan.');
    }

    public function update(Request $request, Contact $contact): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'address' => 'required|string',
            'city' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'operating_hours' => 'nullable|string|max:255',
            'google_maps_embed' => 'nullable|string',
            'google_maps_url' => 'nullable|url|max:500',
            'description' => 'nullable|string',
            'is_primary' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        if (!empty($validated['is_primary'])) {
            Contact::where('id', '!=', $contact->id)->where('is_primary', true)->update(['is_primary' => false]);
        }

        $contact->update($validated);

        return back()->with('success', 'Data kontak / cabang berhasil diperbarui.');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return back()->with('success', 'Data kontak / cabang telah dihapus.');
    }

    public function toggle(Contact $contact): RedirectResponse
    {
        $contact->update([
            'is_active' => !$contact->is_active,
        ]);

        return back()->with('success', 'Status kontak berhasil diubah.');
    }
}
