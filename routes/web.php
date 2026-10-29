<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

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

// Artikel & Tips Wisata
Route::get('/artikel', [PostController::class, 'index'])->name('posts.index');
Route::get('/artikel/{slug}', [PostController::class, 'show'])->name('posts.show');

// Kontak
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');

// Submission Lead / Booking
Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');

// Rute Akses Login Admin di /login
Route::get('/login', \App\Filament\Pages\Auth\Login::class)
    ->middleware([
        'web',
        'Filament\Http\Middleware\SetUpPanel:admin',
        'Filament\Http\Middleware\DisableBladeIconComponents',
        'Filament\Http\Middleware\DispatchServingFilamentEvent',
    ])
    ->name('filament.admin.auth.login');

Route::get('/admin/login', function () {
    return redirect('/login');
});
