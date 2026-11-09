<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Fleet;
use App\Models\GalleryItem;
use App\Models\Inquiry;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Service;
use App\Models\TourPackage;
use App\Models\User;
use Tests\TestCase;

class VueAdminPortalTest extends TestCase
{
    public function test_guest_accesses_login_page_via_admin_url(): void
    {
        $response = $this->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('data-page', false);
    }

    public function test_admin_logout_redirects_directly_to_home_page(): void
    {
        $admin = User::first() ?? User::factory()->create();

        $response = $this->actingAs($admin)->post('/admin/logout');
        $response->assertRedirect('/');
        $this->assertGuest();
    }

    public function test_login_page_renders_with_inertia(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('data-page', false);
    }

    public function test_admin_can_authenticate_via_vue_form(): void
    {
        $user = User::factory()->create([
            'email' => 'test-admin-' . uniqid() . '@example.com',
            'password' => bcrypt('secret12345'),
        ]);

        $response = $this->post('/admin/login', [
            'email' => $user->email,
            'password' => 'secret12345',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_authenticated_admin_can_access_dashboard(): void
    {
        $user = User::first() ?? User::factory()->create();

        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('data-page', false);
    }

    public function test_authenticated_admin_can_view_tour_packages(): void
    {
        $user = User::first() ?? User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/packages');
        $response->assertStatus(200);
        $response->assertSee('data-page', false);
    }

    public function test_authenticated_admin_can_view_services(): void
    {
        $user = User::first() ?? User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/services');
        $response->assertStatus(200);
        $response->assertSee('data-page', false);
    }

    public function test_authenticated_admin_can_view_posts(): void
    {
        $user = User::first() ?? User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/posts');
        $response->assertStatus(200);
        $response->assertSee('data-page', false);
    }

    public function test_authenticated_admin_can_view_gallery(): void
    {
        $user = User::first() ?? User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/gallery');
        $response->assertStatus(200);
        $response->assertSee('data-page', false);
    }

    public function test_authenticated_admin_can_view_partners(): void
    {
        $user = User::first() ?? User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/partners');
        $response->assertStatus(200);
        $response->assertSee('data-page', false);
    }

    public function test_authenticated_admin_can_view_fleets(): void
    {
        $user = User::first() ?? User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/fleets');
        $response->assertStatus(200);
        $response->assertSee('data-page', false);
    }

    public function test_authenticated_admin_can_view_settings(): void
    {
        $user = User::first() ?? User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/settings');
        $response->assertStatus(200);
        $response->assertSee('data-page', false);
    }

    public function test_authenticated_admin_can_view_inquiries_and_export_csv(): void
    {
        $user = User::first() ?? User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/inquiries');
        $response->assertStatus(200);
        $response->assertSee('data-page', false);

        // Test export CSV endpoint
        $exportResponse = $this->actingAs($user)->get('/admin/inquiries/export');
        $exportResponse->assertStatus(200);
        $this->assertTrue(str_contains($exportResponse->headers->get('content-type') ?? '', 'text/csv'));
    }

    public function test_authenticated_admin_can_view_and_moderate_testimonials(): void
    {
        $user = User::first() ?? User::factory()->create();

        // 1. View Testimonials Index
        $response = $this->actingAs($user)->get('/admin/testimonials');
        $response->assertStatus(200);
        $response->assertSee('data-page', false);

        // 2. Create Testimonial
        $createRes = $this->actingAs($user)->post('/admin/testimonials', [
            'client_name' => 'Budi Testimonial Test',
            'organization' => 'Dinas Pendidikan Lampung',
            'role' => 'Kepala Seksi',
            'trip_name' => 'Trip Gathering 2026',
            'rating' => 5,
            'comment' => 'Pelayanan luar biasa memuaskan dan ramah.',
            'is_active' => true,
        ]);
        $createRes->assertRedirect(route('admin.testimonials.index'));

        $item = \App\Models\Testimonial::where('client_name', 'Budi Testimonial Test')->first();
        $this->assertNotNull($item);
        $this->assertTrue($item->is_active);

        // 3. Toggle Status
        $toggleRes = $this->actingAs($user)->post("/admin/testimonials/{$item->id}/toggle");
        $toggleRes->assertStatus(302);
        $this->assertFalse($item->fresh()->is_active);

        // Cleanup
        $item->delete();
    }

    public function test_authenticated_admin_can_manage_users(): void
    {
        $admin = User::first() ?? User::factory()->create();

        // 1. View Users Index
        $response = $this->actingAs($admin)->get('/admin/users');
        $response->assertStatus(200);
        $response->assertSee('data-page', false);

        // 2. Create New Admin User
        $newEmail = 'admin-baru-' . uniqid() . '@nirwanatour.com';
        $createRes = $this->actingAs($admin)->post('/admin/users', [
            'name' => 'Admin Baru Nirwana',
            'email' => $newEmail,
            'password' => 'secret12345',
            'password_confirmation' => 'secret12345',
        ]);
        $createRes->assertRedirect(route('admin.users.index'));

        $createdUser = User::where('email', $newEmail)->first();
        $this->assertNotNull($createdUser);
        $this->assertEquals('Admin Baru Nirwana', $createdUser->name);

        // 3. Update Admin User
        $updateRes = $this->actingAs($admin)->put("/admin/users/{$createdUser->id}", [
            'name' => 'Admin Baru Diperbarui',
            'email' => $newEmail,
        ]);
        $updateRes->assertRedirect(route('admin.users.index'));
        $this->assertEquals('Admin Baru Diperbarui', $createdUser->fresh()->name);

        // 4. Admin cannot delete their own account
        $selfDeleteRes = $this->actingAs($admin)->delete("/admin/users/{$admin->id}");
        $selfDeleteRes->assertSessionHas('error');
        $this->assertNotNull(User::find($admin->id));

        // 5. Admin can delete other admin account
        $deleteRes = $this->actingAs($admin)->delete("/admin/users/{$createdUser->id}");
        $deleteRes->assertRedirect(route('admin.users.index'));
        $this->assertNull(User::find($createdUser->id));
    }

    public function test_authenticated_admin_can_bulk_delete_posts_and_packages(): void
    {
        $admin = User::first() ?? User::factory()->create();

        // 1. Bulk Delete Posts
        $post1 = Post::create([
            'title' => 'Bulk Delete Post 1 ' . uniqid(),
            'slug' => 'bulk-delete-post-1-' . uniqid(),
            'content' => 'Test content 1',
            'is_published' => false,
        ]);
        $post2 = Post::create([
            'title' => 'Bulk Delete Post 2 ' . uniqid(),
            'slug' => 'bulk-delete-post-2-' . uniqid(),
            'content' => 'Test content 2',
            'is_published' => false,
        ]);

        $resPosts = $this->actingAs($admin)->post('/admin/posts/bulk-delete', [
            'ids' => [$post1->id, $post2->id],
        ]);
        $resPosts->assertRedirect(route('admin.posts.index'));
        $this->assertNull(Post::find($post1->id));
        $this->assertNull(Post::find($post2->id));

        // 2. Bulk Delete Packages
        $pkg1 = TourPackage::create([
            'title' => 'Bulk Package 1 ' . uniqid(),
            'slug' => 'bulk-pkg-1-' . uniqid(),
            'price_from' => 500000,
            'duration_days' => 1,
            'min_pax' => 10,
        ]);
        $pkg2 = TourPackage::create([
            'title' => 'Bulk Package 2 ' . uniqid(),
            'slug' => 'bulk-pkg-2-' . uniqid(),
            'price_from' => 750000,
            'duration_days' => 2,
            'min_pax' => 15,
        ]);

        $resPkgs = $this->actingAs($admin)->post('/admin/packages/bulk-delete', [
            'ids' => [$pkg1->id, $pkg2->id],
        ]);
        $resPkgs->assertRedirect(route('admin.packages.index'));
        $this->assertNull(TourPackage::find($pkg1->id));
        $this->assertNull(TourPackage::find($pkg2->id));
    }

    public function test_authenticated_admin_can_access_article_generator(): void
    {
        $admin = User::first() ?? User::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/posts/generator');
        $response->assertStatus(200);
        $response->assertSee('Posts\/Generator', false);
    }

    public function test_authenticated_admin_can_generate_batch_articles_with_scheduling_and_random_images(): void
    {
        \Illuminate\Support\Facades\Storage::fake('public');

        $admin = User::first() ?? User::factory()->create();

        $image1 = \Illuminate\Http\UploadedFile::fake()->image('pahawang-snorkeling.jpg', 800, 600);
        $image2 = \Illuminate\Http\UploadedFile::fake()->image('kiluan-dolphins.jpg', 800, 600);

        $titles = [
            '10 Spot Snorkeling Terbaik di Pulau Pahawang ' . uniqid(),
            'Panduan Wisata Lumba Lumba Teluk Kiluan ' . uniqid(),
            'Eksplorasi Gunung Anak Krakatau Eksotis ' . uniqid(),
        ];

        $titlesRaw = implode("\n", $titles);
        $startDate = now()->addDays(2)->toDateString();

        $response = $this->actingAs($admin)->post('/admin/posts/generator', [
            'titles_raw' => $titlesRaw,
            'start_date' => $startDate,
            'interval_days' => 1,
            'status' => 'published',
            'feature_first' => true,
            'images' => [$image1, $image2],
        ]);

        $response->assertRedirect(route('admin.posts.index'));
        $response->assertSessionHas('success');

        foreach ($titles as $index => $title) {
            $post = Post::where('title', $title)->first();
            $this->assertNotNull($post, "Artikel '{$title}' harus berhasil dibuat di database.");
            $this->assertNotEmpty($post->slug);
            $this->assertNotEmpty($post->content);
            $this->assertStringContainsString('Nirwana Tour Lampung', $post->content);
            $this->assertStringContainsString('https://wa.me/6282179881004', $post->content);
            $this->assertNotEmpty($post->cover_image);

            // Verifikasi penjadwalan (interval 1 hari)
            $expectedDate = now()->addDays(2 + $index)->toDateString();
            $this->assertEquals($expectedDate, $post->published_at->toDateString());
        }

        // Cek fitur unggulan pada artikel pertama
        $firstPost = Post::where('title', $titles[0])->first();
        $this->assertTrue((bool) $firstPost->is_featured);
    }

    public function test_future_scheduled_articles_are_hidden_from_public_frontend_until_scheduled_date(): void
    {
        $futureTitle = 'Rahasia Tersembunyi Pantai Lampung Masa Depan ' . uniqid();
        $futurePost = Post::create([
            'title' => $futureTitle,
            'slug' => \Illuminate\Support\Str::slug($futureTitle),
            'content' => '<p>Konten artikel yang dijadwalkan terbit minggu depan.</p>',
            'category_name' => 'Tips Wisata',
            'is_published' => true,
            'published_at' => now()->addDays(7), // Terjadwal 7 hari lagi
        ]);

        // Verifikasi tidak muncul di daftar artikel publik
        $indexResponse = $this->get('/berita');
        $indexResponse->assertStatus(200);
        $indexResponse->assertDontSee($futureTitle);

        // Verifikasi 404 jika diakses langsung sebelum tanggal rilis
        $showResponse = $this->get('/berita/' . $futurePost->slug);
        $showResponse->assertStatus(404);

        // Ubah tanggal menjadi sudah lewat / hari ini
        $futurePost->update(['published_at' => now()->subHour()]);

        // Verifikasi kini muncul dan bisa diakses
        $liveResponse = $this->get('/berita/' . $futurePost->slug);
        $liveResponse->assertStatus(200);
        $liveResponse->assertSee($futureTitle);
    }
}
