<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CertificateController as AdminCertificateController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FleetController as AdminFleetController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\PartnerController as AdminPartnerController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\TeamMemberController as AdminTeamMemberController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\TourPackageController as AdminTourPackageController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

// XML Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Public Multi-Page Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil-nirwana', [HomeController::class, 'profile'])->name('profile');
Route::get('/manajemen', [HomeController::class, 'management'])->name('management');
Route::get('/sertifikasi', [HomeController::class, 'certificates'])->name('certificates');
Route::get('/sertifikat', [HomeController::class, 'certificates']);
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');

// Destinasi & Paket Wisata
Route::get('/destinasi', [PackageController::class, 'index'])->name('destinations.index');
Route::get('/destinasi/{slug}', [PackageController::class, 'show'])->name('destinations.show');
Route::get('/paket-wisata', [PackageController::class, 'index'])->name('packages.index');
Route::get('/paket-wisata/{slug}', [PackageController::class, 'show'])->name('packages.show');

// Layanan
Route::get('/layanan', [ServiceController::class, 'index'])->name('services.index');
Route::get('/layanan/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Galeri Dokumentasi
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');

// Artikel & Tips Wisata / Berita
Route::get('/artikel', [PostController::class, 'index'])->name('posts.index');
Route::get('/berita', [PostController::class, 'index']);
Route::get('/artikel/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/berita/{slug}', [PostController::class, 'show']);

// Kontak
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');

// Submission Lead / Booking
Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');

// Kirim Testimoni / Ulasan Klien
Route::post('/testimoni', [TestimonialController::class, 'store'])->name('testimonial.store');

// ========================================================
// PORTAL ADMIN (LARAVEL + INERTIA.JS + VUE 3)
// ========================================================
Route::prefix('admin')->name('admin.')->group(function () {
    // Akses Utama /admin: Menampilkan form Login jika belum masuk, atau Dashboard jika sudah login
    Route::get('/', function () {
        if (!auth()->check()) {
            return app(AdminAuthController::class)->showLogin();
        }
        return app(AdminDashboardController::class)->index();
    })->name('dashboard');

    // Guest Auth
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login']);
        Route::post('/', [AdminAuthController::class, 'login']);
    });

    // Authenticated Admin Area
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index']);
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // Manajemen Paket Wisata
        Route::post('/packages/bulk-delete', [AdminTourPackageController::class, 'bulkDelete'])->name('packages.bulk-delete');
        Route::resource('packages', AdminTourPackageController::class);
        Route::post('/packages/{package}/toggle', [AdminTourPackageController::class, 'toggle'])->name('packages.toggle');

        // Layanan Perjalanan
        Route::resource('services', AdminServiceController::class);
        Route::post('/services/{service}/toggle', [AdminServiceController::class, 'toggle'])->name('services.toggle');

        // Artikel & Berita
        Route::post('/posts/bulk-delete', [AdminPostController::class, 'bulkDelete'])->name('posts.bulk-delete');
        Route::get('/posts/generator', [AdminPostController::class, 'generator'])->name('posts.generator');
        Route::post('/posts/generator', [AdminPostController::class, 'generate'])->name('posts.generate');
        Route::resource('posts', AdminPostController::class);
        Route::post('/posts/{post}/toggle', [AdminPostController::class, 'toggle'])->name('posts.toggle');

        // Galeri Dokumentasi
        Route::post('/gallery/bulk-delete', [AdminGalleryController::class, 'bulkDelete'])->name('gallery.bulk-delete');
        Route::resource('gallery', AdminGalleryController::class);
        Route::post('/gallery/{gallery}/toggle', [AdminGalleryController::class, 'toggle'])->name('gallery.toggle');

        // Mitra Rekanan
        Route::get('/partners', [AdminPartnerController::class, 'index'])->name('partners.index');
        Route::post('/partners', [AdminPartnerController::class, 'store'])->name('partners.store');
        Route::put('/partners/{partner}', [AdminPartnerController::class, 'update'])->name('partners.update');
        Route::delete('/partners/{partner}', [AdminPartnerController::class, 'destroy'])->name('partners.destroy');

        // Armada Bus
        Route::get('/fleets', [AdminFleetController::class, 'index'])->name('fleets.index');
        Route::post('/fleets', [AdminFleetController::class, 'store'])->name('fleets.store');
        Route::put('/fleets/{fleet}', [AdminFleetController::class, 'update'])->name('fleets.update');
        Route::delete('/fleets/{fleet}', [AdminFleetController::class, 'destroy'])->name('fleets.destroy');

        // Pesan Masuk / Inquiries
        Route::post('/inquiries/bulk-delete', [AdminInquiryController::class, 'bulkDelete'])->name('inquiries.bulk-delete');
        Route::get('/inquiries/export', [AdminInquiryController::class, 'exportCsv'])->name('inquiries.export');
        Route::get('/inquiries', [AdminInquiryController::class, 'index'])->name('inquiries.index');
        Route::patch('/inquiries/{inquiry}/status', [AdminInquiryController::class, 'updateStatus'])->name('inquiries.status');
        Route::delete('/inquiries/{inquiry}', [AdminInquiryController::class, 'destroy'])->name('inquiries.destroy');

        // Ulasan & Testimonial Pelanggan
        Route::post('/testimonials/bulk-delete', [AdminTestimonialController::class, 'bulkDelete'])->name('testimonials.bulk-delete');
        Route::get('/testimonials', [AdminTestimonialController::class, 'index'])->name('testimonials.index');
        Route::post('/testimonials', [AdminTestimonialController::class, 'store'])->name('testimonials.store');
        Route::put('/testimonials/{testimonial}', [AdminTestimonialController::class, 'update'])->name('testimonials.update');
        Route::delete('/testimonials/{testimonial}', [AdminTestimonialController::class, 'destroy'])->name('testimonials.destroy');
        Route::post('/testimonials/{testimonial}/toggle', [AdminTestimonialController::class, 'toggle'])->name('testimonials.toggle');

        // Manajemen & Tim Profesional
        Route::resource('team-members', AdminTeamMemberController::class)->except(['create', 'show', 'edit']);
        Route::post('/team-members/{teamMember}/toggle', [AdminTeamMemberController::class, 'toggle'])->name('team-members.toggle');

        // Dokumen Legalitas & Sertifikasi
        Route::resource('certificates', AdminCertificateController::class)->except(['create', 'show', 'edit']);
        Route::post('/certificates/{certificate}/toggle', [AdminCertificateController::class, 'toggle'])->name('certificates.toggle');

        // Kontak & Kantor Cabang
        Route::resource('contacts', AdminContactController::class)->except(['create', 'show', 'edit']);
        Route::post('/contacts/{contact}/toggle', [AdminContactController::class, 'toggle'])->name('contacts.toggle');

        // Kategori Konten
        Route::resource('categories', AdminCategoryController::class)->except(['create', 'show', 'edit']);

        // Manajemen Akun Admin
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

        // Pengaturan Website & Profil
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
    });
});

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::get('/auth/login', function () {
    return redirect()->route('admin.login');
});

// PWA Assets Routing
Route::get('/manifest.json', function () {
    return response()->json(json_decode(file_get_contents(public_path('manifest.json')), true));
});

Route::get('/sw.js', function () {
    return response()->file(public_path('sw.js'), ['Content-Type' => 'application/javascript']);
});

// Download Backup Database Khusus Admin
Route::get('/admin/backup-database', function () {
    if (!auth()->check()) {
        abort(403, 'Akses ditolak.');
    }
    \Illuminate\Support\Facades\Artisan::call('app:backup-database');
    $backupDir = storage_path('app/backups');
    $files = \Illuminate\Support\Facades\File::files($backupDir);
    usort($files, fn ($a, $b) => $b->getMTime() - $a->getMTime());
    if (empty($files)) {
        abort(404, 'File backup tidak ditemukan.');
    }
    return response()->download($files[0]->getPathname());
})->middleware(['web', 'auth'])->name('admin.backup.download');

// Buat Symlink Storage Khusus Admin (Bermanfaat jika hosting tanpa terminal SSH)
Route::get('/admin/storage-link', function () {
    if (!auth()->check()) {
        abort(403, 'Akses ditolak.');
    }

    $target = storage_path('app/public');
    $link = public_path('storage');
    $messages = [];

    // 1. Coba buat symlink standar Laravel
    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        $messages[] = 'Perintah storage:link berhasil dijalankan.';
    } catch (\Throwable $e) {
        $messages[] = 'Perintah storage:link gagal: ' . $e->getMessage();
    }

    // 2. Jika symlink tidak terbentuk atau hosting mematikan fungsi symlink(), salin fisik folder ke public
    if (!is_link($link)) {
        if (!file_exists($link)) {
            \Illuminate\Support\Facades\File::makeDirectory($link, 0755, true, true);
        }
        if (is_dir($link)) {
            \Illuminate\Support\Facades\File::copyDirectory($target, $link);
            $messages[] = 'Folder fisik storage dan seluruh gambar/video berhasil disinkronkan langsung ke: ' . htmlspecialchars($link);
        }
    } else {
        $messages[] = 'Symlink aktif dan terhubung ke: ' . htmlspecialchars($link);
    }

    $outputHtml = '<div style="font-family:sans-serif;padding:30px;line-height:1.6;">';
    $outputHtml .= '<h2 style="color:#0f766e;">Storage link berhasil dibuat!</h2>';
    $outputHtml .= '<ul>';
    foreach ($messages as $msg) {
        $outputHtml .= '<li>' . $msg . '</li>';
    }
    $outputHtml .= '</ul>';
    $outputHtml .= '<p style="color:#16a34a;font-weight:bold;">Gambar dan video siap dimuat di website!</p>';
    $outputHtml .= '<p><a href="/admin" style="display:inline-block;padding:10px 20px;background:#0f766e;color:#fff;text-decoration:none;border-radius:6px;">Kembali ke Dashboard Admin</a></p>';
    $outputHtml .= '</div>';

    return response($outputHtml);
})->middleware(['web', 'auth'])->name('admin.storage.link');

