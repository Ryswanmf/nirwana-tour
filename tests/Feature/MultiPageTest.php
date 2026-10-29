<?php

namespace Tests\Feature;

use App\Models\Inquiry;
use App\Models\Post;
use App\Models\Service;
use App\Models\TourPackage;
use Tests\TestCase;

class MultiPageTest extends TestCase
{
    public function test_home_page_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Nirwana Tour');
        $response->assertSee('Baca Selengkapnya');
        $response->assertDontSee('Konsultasi Trip Ini');
        $response->assertDontSee('Lihat Berita Lainnya');
        $response->assertSee(route('packages.index'));
        $response->assertSee('Lihat Destinasi Lainnya');
    }

    public function test_about_page_loads_successfully(): void
    {
        $response = $this->get('/tentang-kami');
        $response->assertStatus(200);
        $response->assertSee('Mengenal Nirwana Tour Lampung');
    }

    public function test_profile_nirwana_page_loads_successfully(): void
    {
        $response = $this->get('/profil-nirwana');
        $response->assertStatus(200);
        $response->assertSee('Profil Nirwana Tour Lampung');
        $response->assertSee('Visi');
        $response->assertSee('Misi');
        $response->assertSee('Nilai-Nilai Utama');
        $response->assertDontSee('Orang di Balik Layar');
        $response->assertDontSee('Sarana & Prasarana');
        $response->assertDontSee('Alur Pemesanan Mudah');
        $response->assertDontSee('Siap Menjelajahi Destinasi Impian Anda?');
    }

    public function test_management_page_loads_successfully(): void
    {
        $response = $this->get('/manajemen');
        $response->assertStatus(200);
        $response->assertSee('Manajemen & Tim Profesional');
        $response->assertDontSee('Rencanakan Perjalanan Bersama Tim Profesional Kami');
    }

    public function test_certificates_page_loads_successfully(): void
    {
        $response = $this->get('/sertifikasi');
        $response->assertStatus(200);
        $response->assertSee('Legalitas Resmi');
        $response->assertDontSee('Siap Bermitra dengan Biro Wisata Resmi & Tepercaya?');
    }

    public function test_packages_index_page_loads_successfully(): void
    {
        $response = $this->get('/paket-wisata');
        $response->assertStatus(200);
        $response->assertSee('Daftar Paket Wisata');
    }

    public function test_destinations_index_page_loads_successfully(): void
    {
        $response = $this->get('/destinasi');
        $response->assertStatus(200);
        $response->assertSee('Daftar Paket Wisata');
    }

    public function test_package_detail_page_loads_successfully(): void
    {
        $package = TourPackage::where('is_active', true)->first();
        $this->assertNotNull($package);

        $response = $this->get("/paket-wisata/{$package->slug}");
        $response->assertStatus(200);
        $response->assertSee($package->title);
    }

    public function test_services_index_page_loads_successfully(): void
    {
        $response = $this->get('/layanan');
        $response->assertStatus(200);
        $response->assertSee('Layanan Perjalanan Kami');
    }

    public function test_service_detail_page_loads_successfully(): void
    {
        $service = Service::where('is_active', true)->first();
        $this->assertNotNull($service);

        $response = $this->get("/layanan/{$service->slug}");
        $response->assertStatus(200);
        $response->assertSee($service->title);
    }

    public function test_gallery_page_loads_successfully(): void
    {
        $response = $this->get('/galeri');
        $response->assertStatus(200);
        $response->assertSee('Galeri Video Kegiatan Wisata');

        // Test pagination 8 videos per page
        $responsePage2 = $this->get('/galeri?page=2');
        $responsePage2->assertStatus(200);
    }

    public function test_articles_index_page_loads_successfully(): void
    {
        $response = $this->get('/artikel');
        $response->assertStatus(200);
        $response->assertSee('Tips Liburan');
    }

    public function test_article_detail_page_loads_successfully(): void
    {
        $post = Post::where('is_published', true)->first();
        $this->assertNotNull($post);

        $response = $this->get("/artikel/{$post->slug}");
        $response->assertStatus(200);
        $response->assertSee($post->title);
    }

    public function test_contact_page_loads_successfully(): void
    {
        $response = $this->get('/kontak');
        $response->assertStatus(200);
        $response->assertSee('Hubungi Kami');
    }

    public function test_inquiry_submission_records_in_database_and_redirects_to_whatsapp(): void
    {
        $package = TourPackage::where('is_active', true)->first();

        $data = [
            'name' => 'Budi Santoso',
            'phone' => '081234567890',
            'email' => 'budi@example.com',
            'tour_package_id' => $package->id,
            'participants' => 15,
            'fleet_type' => 'Medium Bus',
            'estimated_price' => 2500000,
            'message' => 'Tes pemesanan rombongan dinas',
            'source' => 'test_suite',
        ];

        $response = $this->post('/inquiry', $data);

        $this->assertDatabaseHas('inquiries', [
            'name' => 'Budi Santoso',
            'phone' => '081234567890',
            'tour_package_id' => $package->id,
            'status' => 'pending',
        ]);

        $response->assertStatus(302);
        $targetUrl = $response->headers->get('Location');
        $this->assertStringContainsString('https://wa.me/', $targetUrl);
        $this->assertStringContainsString('Budi%20Santoso', $targetUrl);
    }

    public function test_admin_login_page_loads_successfully(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('admin');
        $response->assertSee('6289515915699');
        $response->assertSee('Lupa Sandi?');
        $response->assertDontSee('Katalog Wisata Lengkap');
        $response->assertDontSee('Area Administrator');

        $redirectResponse = $this->get('/admin/login');
        $redirectResponse->assertRedirect('/login');

        $adminResponse = $this->followingRedirects()->get('/admin');
        $adminResponse->assertStatus(200);
        $adminResponse->assertSee('admin');
    }

    public function test_login_rate_limiting_triggers_after_five_failed_attempts(): void
    {
        // Bersihkan limiter sebelum pengujian
        \Illuminate\Support\Facades\RateLimiter::clear(
            'livewire-rate-limiter:' . sha1(\App\Filament\Pages\Auth\Login::class . '|authenticate|127.0.0.1')
        );

        for ($i = 0; $i < 5; $i++) {
            \Livewire\Livewire::test(\App\Filament\Pages\Auth\Login::class)
                ->fillForm([
                    'email' => 'wrong@nirwanatour.com',
                    'password' => 'wrongpassword',
                ])
                ->call('authenticate');
        }

        // Percobaan ke-6 harus memicu notifikasi pembatasan
        \Livewire\Livewire::test(\App\Filament\Pages\Auth\Login::class)
            ->fillForm([
                'email' => 'wrong@nirwanatour.com',
                'password' => 'wrongpassword',
            ])
            ->call('authenticate')
            ->assertNotified('Batas Percobaan Login Terlampaui');
    }
}
