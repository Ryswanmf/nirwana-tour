<?php

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

// Rute Akses Login Admin di /login
Route::get('/login', \App\Filament\Pages\Auth\Login::class)
    ->middleware([
        'web',
        'Filament\Http\Middleware\SetUpPanel:admin',
        'Filament\Http\Middleware\DisableBladeIconComponents',
        'Filament\Http\Middleware\DispatchServingFilamentEvent',
    ])
    ->name('filament.admin.auth.login');

Route::get('/auth/login', function () {
    return redirect('/login');
})->name('login');

Route::get('/admin/login', function () {
    return redirect('/login');
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

