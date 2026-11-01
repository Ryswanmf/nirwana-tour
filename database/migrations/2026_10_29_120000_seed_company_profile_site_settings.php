<?php

use App\Models\SiteSetting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Cache;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update group for existing about_company
        SiteSetting::where('key', 'about_company')->update(['group' => 'about', 'label' => 'Ringkasan Profil Perusahaan']);

        $settings = [
            [
                'key' => 'owner_name',
                'label' => 'Nama Pemilik / Founder',
                'group' => 'about',
                'value' => 'Kiki M Alfin',
            ],
            [
                'key' => 'owner_role',
                'label' => 'Jabatan & Masa Berdiri',
                'group' => 'about',
                'value' => 'Pimpinan & Founder - Nirwana Tour Lampung • Sejak 2016',
            ],
            [
                'key' => 'owner_quote',
                'label' => 'Kutipan Sambutan Pemilik',
                'group' => 'about',
                'value' => 'Selamat datang di Nirwana Tour Lampung. Bagi kami, setiap perjalanan bukan sekadar mengantar Anda ke destinasi, melainkan sebuah amanah untuk menghadirkan rasa aman, kenyamanan prima, dan kenangan indah yang abadi bersama orang-orang tercinta.',
            ],
            [
                'key' => 'owner_photo',
                'label' => 'Foto Pemilik / Founder',
                'group' => 'about',
                'value' => null,
            ],
            [
                'key' => 'about_description',
                'label' => 'Deskripsi Detail Profil Perusahaan',
                'group' => 'about',
                'value' => 'Dengan pengalaman lebih dari 8 tahun, kami telah melayani ribuan pelanggan mulai dari keluarga, sekolah, universitas, instansi pemerintahan, hingga BUMN & perusahaan swasta nasional. Setiap rencana perjalanan kami susun secara terstruktur dengan pemandu berlisensi dan armada transportasi pariwisata terawat.',
            ],
            [
                'key' => 'stat_years_count',
                'label' => 'Statistik: Tahun Pengalaman (Angka)',
                'group' => 'about',
                'value' => '8',
            ],
            [
                'key' => 'stat_years_label',
                'label' => 'Statistik: Tahun Pengalaman (Label)',
                'group' => 'about',
                'value' => 'Tahun Pengalaman',
            ],
            [
                'key' => 'stat_trips_count',
                'label' => 'Statistik: Trip Terlaksana (Angka)',
                'group' => 'about',
                'value' => '1500',
            ],
            [
                'key' => 'stat_trips_label',
                'label' => 'Statistik: Trip Terlaksana (Label)',
                'group' => 'about',
                'value' => 'Trip Terlaksana',
            ],
            [
                'key' => 'stat_satisfaction_count',
                'label' => 'Statistik: Kepuasan Pelanggan (Angka)',
                'group' => 'about',
                'value' => '99',
            ],
            [
                'key' => 'stat_satisfaction_label',
                'label' => 'Statistik: Kepuasan Pelanggan (Label)',
                'group' => 'about',
                'value' => 'Kepuasan Pelanggan',
            ],
            [
                'key' => 'stat_legal_count',
                'label' => 'Statistik: Legalitas Resmi (Angka)',
                'group' => 'about',
                'value' => '100',
            ],
            [
                'key' => 'stat_legal_label',
                'label' => 'Statistik: Legalitas Resmi (Label)',
                'group' => 'about',
                'value' => 'Legalitas Resmi',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'label' => $setting['label'],
                    'group' => $setting['group'],
                    'value' => $setting['value'],
                ]
            );
        }

        Cache::forget('nirwana_site_settings');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $keys = [
            'owner_name',
            'owner_role',
            'owner_quote',
            'owner_photo',
            'about_description',
            'stat_years_count',
            'stat_years_label',
            'stat_trips_count',
            'stat_trips_label',
            'stat_satisfaction_count',
            'stat_satisfaction_label',
            'stat_legal_count',
            'stat_legal_label',
        ];

        SiteSetting::whereIn('key', $keys)->delete();
        Cache::forget('nirwana_site_settings');
    }
};
