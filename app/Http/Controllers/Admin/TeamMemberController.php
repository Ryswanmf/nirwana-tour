<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class TeamMemberController extends Controller
{
    public function index(): Response
    {
        $teamMembers = TeamMember::orderBy('order', 'asc')
            ->latest('id')
            ->get()
            ->map(fn ($m) => [
                'id' => $m->id,
                'name' => $m->name,
                'role' => $m->role,
                'division' => $m->division,
                'photo_url' => $m->photo_url,
                'linkedin_url' => $m->linkedin_url,
                'facebook_url' => $m->facebook_url,
                'tiktok_url' => $m->tiktok_url,
                'twitter_url' => $m->twitter_url,
                'order' => $m->order,
                'is_active' => (bool) $m->is_active,
            ]);

        return Inertia::render('TeamMembers/Index', [
            'teamMembers' => $teamMembers,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'division' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'linkedin_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'tiktok_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'photo' => 'nullable|image|max:3072',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('team', 'public');
        }

        TeamMember::create($validated);

        return back()->with('success', 'Anggota tim berhasil ditambahkan.');
    }

    public function update(Request $request, TeamMember $teamMember): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'division' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'linkedin_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'tiktok_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'photo' => 'nullable|image|max:3072',
        ]);

        if ($request->hasFile('photo')) {
            if ($teamMember->photo && Storage::disk('public')->exists($teamMember->photo)) {
                Storage::disk('public')->delete($teamMember->photo);
            }
            $validated['photo'] = $request->file('photo')->store('team', 'public');
        }

        $teamMember->update($validated);

        return back()->with('success', 'Data anggota tim berhasil diperbarui.');
    }

    public function destroy(TeamMember $teamMember): RedirectResponse
    {
        if ($teamMember->photo && Storage::disk('public')->exists($teamMember->photo)) {
            Storage::disk('public')->delete($teamMember->photo);
        }

        $teamMember->delete();

        return back()->with('success', 'Anggota tim telah dihapus.');
    }

    public function toggle(TeamMember $teamMember): RedirectResponse
    {
        $teamMember->update([
            'is_active' => !$teamMember->is_active,
        ]);

        return back()->with('success', 'Status keaktifan anggota tim berhasil diubah.');
    }
}
