<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class SettingController extends Controller
{
    public function index(): Response
    {
        $settings = SiteSetting::all()->pluck('value', 'key')->toArray();

        // Siapkan URL preview untuk file gambar jika ada
        $imageUrls = [
            'owner_photo_url' => !empty($settings['owner_photo']) ? storage_or_asset($settings['owner_photo']) : asset('assets/images/pemilik-nirwana.webp'),
            'about_team_photo_url' => !empty($settings['about_team_photo']) ? storage_or_asset($settings['about_team_photo']) : asset('assets/images/hero/about-team.jpg'),
            'hero_background_image_url' => !empty($settings['hero_background_image']) ? storage_or_asset($settings['hero_background_image']) : asset('assets/images/hero/candi-hero.jpg'),
        ];

        return Inertia::render('Settings/Index', [
            'settings' => $settings,
            'imageUrls' => $imageUrls,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->except(['_token', '_method']);

        // Handle upload file gambar
        $imageFields = ['owner_photo', 'about_team_photo', 'hero_background_image'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $oldPath = SiteSetting::get($field);
                if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
                $data[$field] = $request->file($field)->store('settings', 'public');
            } elseif (array_key_exists($field, $data) && ($data[$field] === null || $data[$field] === 'null')) {
                unset($data[$field]); // jangan timpa jika tidak upload file baru
            }
        }

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                SiteSetting::set($key, (string) ($value ?? ''));
            }
        }

        Cache::forget('nirwana_site_settings');
        Cache::forget('nirwana_home_data');

        return back()->with('success', 'Pengaturan website dan profil perusahaan berhasil disimpan.');
    }
}
