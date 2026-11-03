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
        $response->assertSee('Biro Wisata, Paket Tour & Sewa Bus Terpercaya');
        $response->assertSee('Baca Selengkapnya');
        $response->assertDontSee('Konsultasi Trip Ini');
        $response->assertDontSee('Lihat Berita Lainnya');
        $response->assertSee(route('packages.index'));
        $response->assertSee('Lihat Destinasi Lainnya');
    }

    public function test_footer_displays_matching_services(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Layanan Unggulan');
        $response->assertSee('Paket Wisata Domestik & Lampung');
        $response->assertSee('Study Tour & Field Trip Sekolah');
        $response->assertSee('Family Gathering & Corporate Event');
        $response->assertSee('Sewa Bus & Transportasi Pariwisata');
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
        $response->assertDontSee('Tertarik Mengunjungi Destinasi Ini?');
    }

    public function test_contact_page_loads_successfully(): void
    {
        $response = $this->get('/kontak');
        $response->assertStatus(200);
        $response->assertSee('Hubungi Kami');
        $response->assertSee('Informasi Kantor', false);
        $response->assertSee('Kirim Permintaan ke WhatsApp');
        $response->assertSee('Pilihan Layanan / Paket Wisata');
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

    public function test_dynamic_xml_sitemap_returns_valid_xml(): void
    {
        $response = $this->get('/sitemap.xml');
        $response->assertStatus(200);
        $this->assertStringContainsString('application/xml', $response->headers->get('Content-Type'));
        $response->assertSee('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', false);
        $response->assertSee('/paket-wisata');
        $response->assertSee('/artikel');
        $response->assertSee('/layanan');
    }

    public function test_open_graph_and_schema_tags_exist_on_frontend(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('property="og:site_name"', false);
        $response->assertSee('property="og:type"', false);
        $response->assertSee('name="twitter:card"', false);
        $response->assertSee('"@type": "TravelAgency"', false);
    }

    public function test_authenticated_admin_can_access_users_management_and_profile(): void
    {
        $admin = \App\Models\User::first();
        $this->assertNotNull($admin);

        $responseUsers = $this->actingAs($admin)->get('/admin/users');
        $responseUsers->assertStatus(200);
        $responseUsers->assertSee('Pengguna Administrator');

        $responseProfile = $this->actingAs($admin)->get('/admin/profile');
        $responseProfile->assertStatus(200);
    }

    public function test_honeypot_silently_rejects_spam_bots(): void
    {
        $botData = [
            'name' => 'Spam Bot',
            'phone' => '08999999999',
            'message' => 'Spam link here',
            '_hp_security_check' => 'I am a bot filling hidden field',
        ];

        $response = $this->post('/inquiry', $botData);
        $response->assertStatus(302);

        $this->assertDatabaseMissing('inquiries', [
            'name' => 'Spam Bot',
        ]);
    }

    public function test_inquiry_triggers_email_notification(): void
    {
        \Illuminate\Support\Facades\Mail::fake();

        $data = [
            'name' => 'Siti Aminah',
            'phone' => '081298765432',
            'email' => 'siti@example.com',
            'message' => 'Tanya ketersediaan trip rombongan',
        ];

        $response = $this->post('/inquiry', $data);
        $response->assertStatus(302);

        \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\NewInquiryReceived::class);
    }

    public function test_pwa_manifest_and_service_worker_are_available(): void
    {
        $manifest = $this->get('/manifest.json');
        $manifest->assertStatus(200);
        $manifest->assertJsonFragment([
            'short_name' => 'Nirwana Tour',
        ]);

        $sw = $this->get('/sw.js');
        $sw->assertStatus(200);
    }

    public function test_team_members_accessible_on_frontend_and_filament(): void
    {
        $response = $this->get('/manajemen');
        $response->assertStatus(200);
        $response->assertSee('Kiki M Alfin');

        $admin = \App\Models\User::first();
        $responseAdmin = $this->actingAs($admin)->get('/admin/team-members');
        $responseAdmin->assertStatus(200);
        $responseAdmin->assertSee('Tim Manajemen');
    }

    public function test_guest_can_submit_testimonial_for_moderation(): void
    {
        $payload = [
            'client_name' => 'Ahmad Faisal',
            'organization' => 'PT Mitra Sejahtera Lampung',
            'role' => 'Ketua Panitia Gathering',
            'trip_name' => 'Family Gathering Pahawang 2D1N',
            'rating' => 5,
            'comment' => 'Pelayanan sangat memuaskan, bus nyaman dan tour leadernya ramah sekali!',
        ];

        $response = $this->post('/testimoni', $payload);
        $response->assertStatus(302);
        $response->assertSessionHas('review_success');

        $this->assertDatabaseHas('testimonials', [
            'client_name' => 'Ahmad Faisal',
            'trip_name' => 'Family Gathering Pahawang 2D1N',
            'rating' => 5,
            'is_active' => false,
        ]);
    }

    public function test_testimonial_honeypot_ignores_spam(): void
    {
        $payload = [
            'client_name' => 'Spam Bot',
            'rating' => 5,
            'comment' => 'This is a spam comment from a bot',
            '_hp_check' => 'spam_honeypot_value',
        ];

        $response = $this->post('/testimoni', $payload);
        $response->assertStatus(302);

        $this->assertDatabaseMissing('testimonials', [
            'client_name' => 'Spam Bot',
        ]);
    }

    public function test_package_detail_has_faq_and_faq_schema(): void
    {
        $package = TourPackage::where('is_active', true)->first();
        $this->assertNotNull($package);

        $response = $this->get("/paket-wisata/{$package->slug}");
        $response->assertStatus(200);
        $response->assertSee('Pertanyaan Umum (FAQ)');
        $response->assertSee('FAQPage');
        $response->assertSee('Apa saja perlengkapan yang wajib dibawa saat trip ini?');
    }

    public function test_database_backup_command_creates_backup_file(): void
    {
        $exitCode = \Illuminate\Support\Facades\Artisan::call('app:backup-database');
        $this->assertEquals(0, $exitCode);

        $backupDir = storage_path('app/backups');
        $this->assertTrue(\Illuminate\Support\Facades\File::isDirectory($backupDir));

        $files = \Illuminate\Support\Facades\File::files($backupDir);
        $this->assertNotEmpty($files);
    }

    public function test_admin_backup_download_requires_auth(): void
    {
        // Tamu tanpa login ditolak
        $guestResponse = $this->get('/admin/backup-database');
        $guestResponse->assertRedirect(route('login'));

        // Admin yang sudah login berhasil mengunduh
        $admin = \App\Models\User::first();
        $adminResponse = $this->actingAs($admin)->get('/admin/backup-database');
        $adminResponse->assertStatus(200);
        $this->assertTrue(str_contains($adminResponse->headers->get('content-disposition'), 'attachment'));
    }

    public function test_admin_storage_link_requires_auth(): void
    {
        $guestResponse = $this->get('/admin/storage-link');
        $guestResponse->assertRedirect(route('login'));

        $admin = \App\Models\User::first();
        $adminResponse = $this->actingAs($admin)->get('/admin/storage-link');
        $adminResponse->assertStatus(200);
        $adminResponse->assertSee('Storage link berhasil dibuat');
    }

    public function test_admin_sidebar_and_navbar_have_logo_and_reorganized_groups(): void
    {
        $admin = \App\Models\User::first();
        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);

        // Logo dan Teks Brand Nirwana Tour Lampung
        $response->assertSee('assets/logo/Logo-Nirwana.png');
        $response->assertSee('Nirwana');
        $response->assertSee('Tour');
        $response->assertSee('Lampung');

        // Kelompok Navigasi Sidebar Baru yang Rapi
        $response->assertSee('Manajemen Wisata & Reservasi');
        $response->assertSee('Konten & Informasi');
        $response->assertSee('Profil & Pengaturan');
    }

    public function test_admin_dashboard_widgets_render_neatly_and_functionally(): void
    {
        $admin = \App\Models\User::first();
        $this->actingAs($admin);

        $response = $this->get('/admin');
        $response->assertStatus(200);

        // Test individual widgets rendering functionally
        \Livewire\Livewire::test(\App\Filament\Widgets\AdminWelcomeWidget::class)
            ->assertSee('Selamat Datang')
            ->assertSee('Tambah Paket')
            ->assertSee('Daftar Leads');

        \Livewire\Livewire::test(\App\Filament\Widgets\StatsOverview::class)
            ->assertSee('Pesanan Masuk (Leads)')
            ->assertSee('Paket Wisata Aktif')
            ->assertSee('Kepuasan Wisatawan')
            ->assertSee('Armada Transportasi');

        \Livewire\Livewire::test(\App\Filament\Widgets\LatestInquiriesWidget::class)
            ->assertSee('Pesanan & Permintaan Konsultasi Terbaru');
    }

    public function test_frontend_uses_webp_images_and_optimized_assets(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('hero-right.webp');
        $response->assertSee('loading="lazy"', false);

        // Verify minified assets exist and are referenced
        $this->assertFileExists(public_path('css/style.min.css'));
        $this->assertFileExists(public_path('js/script.min.js'));
        $this->assertFileExists(public_path('assets/images/hero-right.webp'));
        $response->assertSee('style.min.css');
        $response->assertSee('script.min.js');
    }

    public function test_sitesetting_cache_invalidates_both_collection_and_single_key(): void
    {
        \Illuminate\Support\Facades\Cache::flush();

        // Get value to warm cache
        $initial = \App\Models\SiteSetting::get('whatsapp_number', '0812345');
        $this->assertTrue(\Illuminate\Support\Facades\Cache::has('site_setting_whatsapp_number'));

        // Update setting
        $setting = \App\Models\SiteSetting::where('key', 'whatsapp_number')->first();
        if ($setting) {
            $setting->update(['value' => '628999999999']);
        } else {
            \App\Models\SiteSetting::set('whatsapp_number', '628999999999');
        }

        // Cache must be evicted
        $this->assertFalse(\Illuminate\Support\Facades\Cache::has('site_setting_whatsapp_number'));
        $this->assertFalse(\Illuminate\Support\Facades\Cache::has('nirwana_site_settings'));
    }

    public function test_uploaded_storage_images_render_proper_url_with_storage_prefix(): void
    {
        // Pastikan storage disk public aktif
        $this->assertEquals('public', config('filesystems.default'));

        // Path unggahan dari Filament
        $uploadPath = 'partners/jlwnTzzhFVJwBcvZbQN6k9zYiSpurCHZd7FwlN5C.png';
        $url = storage_or_asset($uploadPath);

        $this->assertStringContainsString('/storage/partners/', $url);

        // Pastikan path statis bawaan tetap mengarah ke assets/
        $staticUrl = storage_or_asset('assets/images/destinasi/pahawang.jpg');
        $this->assertStringContainsString('/assets/images/destinasi/pahawang.jpg', $staticUrl);
        $this->assertStringNotContainsString('/storage/assets/', $staticUrl);

        // Halaman depan merender url storage untuk partner yang memiliki logo unggahan
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('/storage/partners/jlwnTzzhFVJwBcvZbQN6k9zYiSpurCHZd7FwlN5C.png');
    }

    public function test_package_filtering_by_duration_and_budget_and_sorting(): void
    {
        // Filter durasi oneday
        $resDuration = $this->get('/paket-wisata?durasi=oneday');
        $resDuration->assertStatus(200);
        $resDuration->assertSee('Semua Durasi Trip');

        // Filter budget under 500k
        $resBudget = $this->get('/paket-wisata?budget=under_500k');
        $resBudget->assertStatus(200);

        // Sorting termurah
        $resSort = $this->get('/paket-wisata?sort=termurah');
        $resSort->assertStatus(200);
        $resSort->assertSee('Harga: Termurah');
    }

    public function test_social_share_links_and_google_review_badge(): void
    {
        // Halaman depan merender badge ulasan Google
        $homeRes = $this->get('/');
        $homeRes->assertStatus(200);
        $homeRes->assertSee('Lihat Review Google Maps');
        $homeRes->assertSee('Ulasan Google');

        // Detail paket memiliki tombol share WhatsApp, FB, Telegram
        $package = \App\Models\TourPackage::where('is_active', true)->first();
        $pkgRes = $this->get("/paket-wisata/{$package->slug}");
        $pkgRes->assertStatus(200);
        $pkgRes->assertSee('api.whatsapp.com/send');
        $pkgRes->assertSee('facebook.com/sharer');
        $pkgRes->assertSee('t.me/share/url');

        // Detail artikel memiliki tombol share
        $post = \App\Models\Post::where('is_published', true)->first();
        $postRes = $this->get("/artikel/{$post->slug}");
        $postRes->assertStatus(200);
        $postRes->assertSee('Bagikan Tips');
        $postRes->assertSee('api.whatsapp.com/send');
    }

    public function test_marketing_tracking_tags_render_dynamically(): void
    {
        \App\Models\SiteSetting::set('google_analytics_id', 'G-TESTING123');
        \App\Models\SiteSetting::set('meta_pixel_id', '9876543210');
        \App\Models\SiteSetting::set('google_site_verification', 'verification-test-token');

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('https://www.googletagmanager.com/gtag/js?id=G-TESTING123');
        $response->assertSee('fbq(\'init\', \'9876543210\')', false);
        $response->assertSee('content="verification-test-token"', false);

        // Reset
        \App\Models\SiteSetting::set('google_analytics_id', '');
        \App\Models\SiteSetting::set('meta_pixel_id', '');
        \App\Models\SiteSetting::set('google_site_verification', '');
    }

    public function test_sitesetting_filament_edit_works_for_both_text_and_photo(): void
    {
        $user = \App\Models\User::first() ?? \App\Models\User::factory()->create();

        // 1. Uji setting bertipe teks (misalnya stat_legal_count yang sempat diedit user)
        $textSetting = \App\Models\SiteSetting::where('key', 'stat_legal_count')->first();
        if (!$textSetting) {
            $textSetting = \App\Models\SiteSetting::create([
                'key' => 'stat_legal_count',
                'label' => 'Statistik Legalitas',
                'value' => '100',
                'group' => 'about',
            ]);
        }

        \Livewire\Livewire::actingAs($user)
            ->test(\App\Filament\Resources\SiteSettingResource\Pages\EditSiteSetting::class, [
                'record' => $textSetting->getRouteKey(),
            ])
            ->assertSuccessful()
            ->fillForm([
                'value' => '100+',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertEquals('100+', $textSetting->fresh()->value);

        // 2. Uji setting bertipe foto
        $photoSetting = \App\Models\SiteSetting::where('key', 'owner_photo')->first();
        if (!$photoSetting) {
            $photoSetting = \App\Models\SiteSetting::create([
                'key' => 'owner_photo',
                'label' => 'Foto Pemilik',
                'value' => null,
                'group' => 'about',
            ]);
        }

        \Livewire\Livewire::actingAs($user)
            ->test(\App\Filament\Resources\SiteSettingResource\Pages\EditSiteSetting::class, [
                'record' => $photoSetting->getRouteKey(),
            ])
            ->assertSuccessful();
    }

    public function test_custom_404_error_page_renders_branded_nirwana_content(): void
    {
        $response = $this->get('/halaman-destinasi-tidak-ada-nirwana-404');
        $response->assertStatus(404);
        $response->assertSee('Destinasi Belum Ditemukan');
        $response->assertSee('Kembali ke Beranda');
        $response->assertSee('Lihat Semua Paket Wisata');
    }

    public function test_backup_database_is_scheduled_daily(): void
    {
        $schedule = app(\Illuminate\Console\Scheduling\Schedule::class);
        $events = collect($schedule->events());

        $hasBackupSchedule = $events->contains(function ($event) {
            return str_contains($event->command, 'app:backup-database');
        });

        $this->assertTrue($hasBackupSchedule, 'Command app:backup-database harus terjadwal harian');
    }

    public function test_filament_gallery_and_post_resources_form_render_without_binding_resolution_exception(): void
    {
        $user = \App\Models\User::first() ?? \App\Models\User::factory()->create();

        // Pastikan ada kategori gallery
        \App\Models\Category::firstOrCreate(
            ['slug' => 'test-galeri-foto'],
            ['name' => 'Test Galeri Foto', 'type' => 'gallery']
        );

        // Uji rendering halaman Create Gallery Item di Filament (tanpa field kategori & thumbnail video)
        \Livewire\Livewire::actingAs($user)
            ->test(\App\Filament\Resources\GalleryItemResource\Pages\CreateGalleryItem::class)
            ->assertSuccessful()
            ->assertFormFieldExists('title')
            ->assertFormFieldExists('file_path')
            ->assertFormFieldDoesNotExist('category_id')
            ->assertFormFieldDoesNotExist('thumbnail');

        // Uji rendering halaman Create Post di Filament (kategori ketik sendiri, toggle unggulan & upload media)
        \Livewire\Livewire::actingAs($user)
            ->test(\App\Filament\Resources\PostResource\Pages\CreatePost::class)
            ->assertSuccessful()
            ->assertFormFieldExists('category_name')
            ->assertFormFieldExists('is_featured')
            ->assertFormFieldExists('cover_image')
            ->assertFormFieldExists('gallery_images')
            ->assertFormFieldDoesNotExist('category_id');
    }

    public function test_featured_gallery_videos_appear_on_home_and_non_featured_on_gallery_page(): void
    {
        $featuredTitle = 'Test Video Unggulan Beranda ' . uniqid();
        $regularTitle = 'Test Video Galeri Reguler ' . uniqid();

        $featuredVideo = \App\Models\GalleryItem::create([
            'title' => $featuredTitle,
            'media_type' => 'video',
            'file_path' => 'gallery/test-featured.mp4',
            'is_featured' => true,
            'order' => -100,
        ]);

        $regularVideo = \App\Models\GalleryItem::create([
            'title' => $regularTitle,
            'media_type' => 'video',
            'file_path' => 'gallery/test-regular.mp4',
            'is_featured' => false,
            'order' => -99,
        ]);

        try {
            // Cek halaman beranda: video unggulan tampil, video reguler tidak tampil
            $homeResponse = $this->get('/');
            $homeResponse->assertStatus(200);
            $homeResponse->assertSee($featuredTitle);
            $homeResponse->assertDontSee($regularTitle);

            // Cek halaman galeri: video reguler tampil, video unggulan tidak tampil
            $galleryResponse = $this->get('/galeri');
            $galleryResponse->assertStatus(200);
            $galleryResponse->assertSee($regularTitle);
            $galleryResponse->assertDontSee($featuredTitle);
        } finally {
            $featuredVideo->delete();
            $regularVideo->delete();
        }
    }

    public function test_featured_articles_appear_on_home_and_non_featured_on_articles_page(): void
    {
        $featuredTitle = 'Test Berita Unggulan Beranda ' . uniqid();
        $regularTitle = 'Test Berita Halaman Berita Reguler ' . uniqid();

        $featuredPost = \App\Models\Post::create([
            'title' => $featuredTitle,
            'slug' => \Illuminate\Support\Str::slug($featuredTitle),
            'content' => 'Konten artikel unggulan untuk tampil di beranda utama.',
            'category_name' => 'Tips Wisata',
            'is_published' => true,
            'is_featured' => true,
            'published_at' => now(),
        ]);

        $regularPost = \App\Models\Post::create([
            'title' => $regularTitle,
            'slug' => \Illuminate\Support\Str::slug($regularTitle),
            'content' => 'Konten artikel reguler untuk tampil di halaman berita.',
            'category_name' => 'Edukasi',
            'is_published' => true,
            'is_featured' => false,
            'published_at' => now(),
        ]);

        try {
            // Verifikasi beranda menampilkan berita unggulan dan tidak menampilkan berita reguler
            $homeRes = $this->get('/');
            $homeRes->assertStatus(200);
            $homeRes->assertSee($featuredTitle);
            $homeRes->assertDontSee($regularTitle);

            // Verifikasi halaman berita menampilkan berita reguler dan tidak menampilkan berita unggulan
            $articlesRes = $this->get('/berita');
            $articlesRes->assertStatus(200);
            $articlesRes->assertSee($regularTitle);
            $articlesRes->assertDontSee($featuredTitle);
        } finally {
            $featuredPost->delete();
            $regularPost->delete();
        }
    }

    public function test_image_optimizer_compresses_without_changing_resolution(): void
    {
        if (!extension_loaded('gd')) {
            $this->markTestSkipped('GD extension is not available.');
        }

        $tempPath = storage_path('app/temp_test_optimizer_' . uniqid() . '.jpg');

        // Buat gambar JPEG 1920x1080 dengan kualitas uncompressed 100
        $im = imagecreatetruecolor(1920, 1080);
        $color1 = imagecolorallocate($im, 128, 0, 32);
        imagefilledrectangle($im, 0, 0, 1920, 1080, $color1);
        imagejpeg($im, $tempPath, 100);
        imagedestroy($im);

        $sizeBefore = filesize($tempPath);
        $infoBefore = getimagesize($tempPath);
        $this->assertEquals(1920, $infoBefore[0]);
        $this->assertEquals(1080, $infoBefore[1]);

        // Jalankan kompresi
        $result = \App\Helpers\ImageOptimizer::compress($tempPath, 80);
        $this->assertTrue($result);

        clearstatcache(true, $tempPath);
        $sizeAfter = filesize($tempPath);
        $infoAfter = getimagesize($tempPath);

        // Resolusi WAJIB tetap sama persis (tanpa di-downscale)
        $this->assertEquals(1920, $infoAfter[0]);
        $this->assertEquals(1080, $infoAfter[1]);

        // Ukuran berkas terkompresi lebih hemat
        $this->assertLessThanOrEqual($sizeBefore, $sizeAfter);

        if (file_exists($tempPath)) {
            @unlink($tempPath);
        }
    }

    public function test_article_detail_shows_only_one_image_if_only_one_uploaded(): void
    {
        $singlePost = \App\Models\Post::create([
            'title' => 'Test Single Image Post ' . uniqid(),
            'slug' => 'test-single-img-' . uniqid(),
            'content' => 'Konten artikel satu gambar saja.',
            'category_name' => 'Tips Wisata',
            'cover_image' => 'assets/images/destinasi/pahawang.jpg',
            'gallery_images' => null,
            'is_published' => true,
            'published_at' => now(),
        ]);

        try {
            $this->assertCount(1, $singlePost->photos);

            $res = $this->get("/artikel/{$singlePost->slug}");
            $res->assertStatus(200);
            $res->assertSee('article-main-photo');
            $res->assertDontSee('article-sub-photos');
        } finally {
            $singlePost->delete();
        }
    }

    public function test_security_headers_are_present_on_responses(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
    }

    public function test_home_data_is_cached_and_cleared_on_model_events(): void
    {
        \Illuminate\Support\Facades\Cache::forget('nirwana_home_data');

        $this->get('/');
        $this->assertTrue(\Illuminate\Support\Facades\Cache::has('nirwana_home_data'));

        // Creating or updating a partner invalidates home cache
        $partner = \App\Models\Partner::create([
            'name' => 'Cache Test Partner ' . uniqid(),
            'is_active' => true,
            'order' => 999,
        ]);

        $this->assertFalse(\Illuminate\Support\Facades\Cache::has('nirwana_home_data'));
        $partner->delete();
    }

    public function test_contact_crud_in_database_and_frontend(): void
    {
        $uniqueBranch = 'Cabang Uji ' . uniqid();
        $contact = \App\Models\Contact::create([
            'name' => $uniqueBranch,
            'type' => 'Kantor Cabang',
            'address' => 'Jl. Uji Coba Cabang No. 99',
            'city' => 'Metro',
            'phone' => '0721-998877',
            'whatsapp' => '6281299887766',
            'is_primary' => false,
            'is_active' => true,
            'order' => 50,
        ]);

        try {
            // Verify record exists and attributes work
            $this->assertDatabaseHas('contacts', ['name' => $uniqueBranch]);
            $this->assertEquals('6281299887766', $contact->clean_whatsapp);

            // Verify rendered on contact page
            $response = $this->get('/kontak');
            $response->assertStatus(200);
            $response->assertSee($uniqueBranch);
            $response->assertSee('Kantor Cabang');
            $response->assertSee('Jl. Uji Coba Cabang No. 99');
        } finally {
            $contact->delete();
        }

        $this->assertDatabaseMissing('contacts', ['name' => $uniqueBranch]);
    }

    public function test_article_reading_time_and_navigation_and_crud_features(): void
    {
        $post = Post::where('is_published', true)->first();
        $this->assertNotNull($post);

        // 1. Reading time attribute works
        $this->assertStringContainsString('menit baca', $post->reading_time);

        // 2. getAvailableCategories returns an array
        $categories = Post::getAvailableCategories();
        $this->assertIsArray($categories);

        // 3. Frontend displays reading time
        $detailRes = $this->get("/artikel/{$post->slug}");
        $detailRes->assertStatus(200);
        $detailRes->assertSee($post->reading_time);

        $indexRes = $this->get('/artikel');
        $indexRes->assertStatus(200);
        $indexRes->assertSee('menit baca');

        // 4. Test Post CRUD scopes
        $publishedCount = Post::published()->count();
        $this->assertGreaterThan(0, $publishedCount);
        $featuredCount = Post::featured()->count();
        $this->assertGreaterThanOrEqual(0, $featuredCount);
    }

    public function test_service_crud_lifecycle_and_frontend_features(): void
    {
        $uniqueTitle = 'Layanan VIP Uji ' . uniqid();
        $uniqueSlug = 'layanan-vip-uji-' . uniqid();

        // 1. Create a new service
        $service = Service::create([
            'title' => $uniqueTitle,
            'slug' => $uniqueSlug,
            'icon' => 'fa-solid fa-plane-departure',
            'short_description' => 'Layanan khusus penerbangan carter rombongan eksklusif.',
            'full_description' => '<p>Fasilitas lengkap carter pesawat pribadi dan handling bandara VIP.</p>',
            'features' => ['Fast Track Bandara', 'Lounge VIP Eksklusif', 'Konsumsi Bintang Lima'],
            'order' => 99,
            'is_active' => true,
        ]);

        try {
            $this->assertDatabaseHas('services', ['slug' => $uniqueSlug]);

            // 2. Scopes work
            $activeServices = Service::active()->ordered()->get();
            $this->assertTrue($activeServices->contains('id', $service->id));

            // 3. Rendered on catalog (/layanan)
            $indexRes = $this->get('/layanan');
            $indexRes->assertStatus(200);
            $indexRes->assertSee($uniqueTitle);
            $indexRes->assertSee('Layanan khusus penerbangan carter');
            $indexRes->assertSee('Fast Track Bandara');

            // 4. Rendered on detail (/layanan/{slug})
            $detailRes = $this->get("/layanan/{$uniqueSlug}");
            $detailRes->assertStatus(200);
            $detailRes->assertSee($uniqueTitle);
            $detailRes->assertSee('Lounge VIP Eksklusif');
            $detailRes->assertSee('Layanan: ' . $uniqueTitle);
            $detailRes->assertSee('api.whatsapp.com/send');

            // 5. Update service
            $service->update(['short_description' => 'Deskripsi layanan telah diperbarui']);
            $this->assertDatabaseHas('services', ['id' => $service->id, 'short_description' => 'Deskripsi layanan telah diperbarui']);

        } finally {
            $service->delete();
        }

        // 6. Deleted from database
        $this->assertDatabaseMissing('services', ['slug' => $uniqueSlug]);
    }

    public function test_tour_package_crud_lifecycle_and_frontend_features(): void
    {
        $category = \App\Models\Category::firstOrCreate(
            ['name' => 'Wisata Eksplorasi', 'type' => 'tour'],
            ['slug' => 'wisata-eksplorasi']
        );

        $uniqueTitle = 'Paket Eksklusif Uji ' . uniqid();
        $uniqueSlug = 'paket-eksklusif-uji-' . uniqid();

        // 1. Create package
        $package = TourPackage::create([
            'category_id' => $category->id,
            'title' => $uniqueTitle,
            'slug' => $uniqueSlug,
            'badge' => 'Promo Spesial',
            'destination_location' => 'Krui, Pesisir Barat',
            'price_from' => 1250000,
            'duration_days' => 3,
            'duration_nights' => 2,
            'min_pax' => 4,
            'summary' => 'Trip selancar dan penjelajahan pantai eksotis Krui.',
            'description' => '<p>Pengalaman surfing dan wisata bahari kelas dunia di Lampung Barat.</p>',
            'itinerary' => [
                ['day' => 1, 'title' => 'Kedatangan Krui', 'activities' => 'Check-in resort dan santai sore di Pantai Labuhan Jukung.'],
                ['day' => 2, 'title' => 'Surfing & Pulau Pisang', 'activities' => 'Menyeberang ke Pulau Pisang dan hunting lumba-lumba.'],
                ['day' => 3, 'title' => 'Oleh-oleh & Kepulangan', 'activities' => 'Beli kopi robusta dan transfer kembali.'],
            ],
            'includes' => ['Transport HiAce', 'Resort 2 Malam', 'Kapal Pulau Pisang'],
            'excludes' => ['Sewa Papan Surfing', 'Tipping Driver'],
            'faqs' => [
                ['question' => 'Apakah pemula bisa ikut?', 'answer' => 'Sangat bisa, ada instruktur lokal berpengalaman.'],
            ],
            'gallery' => ['packages/gallery/sample1.jpg', 'packages/gallery/sample2.jpg'],
            'is_featured' => true,
            'is_active' => true,
            'order' => 99,
        ]);

        try {
            $this->assertDatabaseHas('tour_packages', ['slug' => $uniqueSlug]);

            // 2. Scopes & Accessors work
            $this->assertEquals('Rp 1.250.000', $package->formatted_price);
            $this->assertEquals('3D 2N', $package->duration_label);
            $this->assertTrue(TourPackage::active()->get()->contains('id', $package->id));
            $this->assertTrue(TourPackage::featured()->get()->contains('id', $package->id));

            // 3. Rendered on catalog (/paket-wisata)
            $indexRes = $this->get('/paket-wisata');
            $indexRes->assertStatus(200);
            $indexRes->assertSee($uniqueTitle);
            $indexRes->assertSee('Krui, Pesisir Barat');
            $indexRes->assertSee('1.250.000');

            // 4. Rendered on detail (/paket-wisata/{slug})
            $detailRes = $this->get("/paket-wisata/{$uniqueSlug}");
            $detailRes->assertStatus(200);
            $detailRes->assertSee($uniqueTitle);
            $detailRes->assertSee('Promo Spesial');
            $detailRes->assertSee('Kedatangan Krui');
            $detailRes->assertSee('Transport HiAce');
            $detailRes->assertSee('Apakah pemula bisa ikut?');
            $detailRes->assertSee('sample1.jpg');

            // 5. Update package
            $package->update(['price_from' => 1500000]);
            $this->assertDatabaseHas('tour_packages', ['id' => $package->id, 'price_from' => 1500000]);

        } finally {
            $package->delete();
        }

        // 6. Deleted from database
        $this->assertDatabaseMissing('tour_packages', ['slug' => $uniqueSlug]);
    }
}
