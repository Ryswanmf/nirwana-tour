<p align="center">
  <a href="https://nirwanatourlampung.com" target="_blank" rel="noopener noreferrer">
    <img src="public/assets/logo/Logo-Nirwana.png" alt="Logo Nirwana Tour Lampung" width="130">
  </a>
</p>

<h1 align="center">Nirwana Tour and Travel Lampung</h1>

<p align="center">
  <strong>Website Resmi & Sistem Informasi Biro Perjalanan Wisata Terpercaya di Lampung</strong><br>
  Paket Wisata Domestik • Study Tour Sekolah • Family Gathering Instansi • Persewaan Bus Pariwisata Eksekutif
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/Filament-3.x-F59E0B?style=for-the-badge&logo=filament&logoColor=white" alt="Filament 3">
  <img src="https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.3">
  <img src="https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/PWA-Ready-800020?style=for-the-badge&logo=pwa&logoColor=white" alt="PWA Ready">
  <img src="https://img.shields.io/badge/Tests-60%20Passed-10B981?style=for-the-badge&logo=github-actions&logoColor=white" alt="60 Tests Passed">
</p>

---

## 📋 Daftar Isi
1. [Tentang Website](#-tentang-website)
2. [Fitur Utama & Keunggulan](#-fitur-utama--keunggulan)
3. [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
4. [Kebutuhan Sistem](#-kebutuhan-sistem)
5. [Instalasi Lokal](#-instalasi-lokal-local-development)
6. [Akses Panel Admin](#-akses-panel-admin-filament)
7. [Panduan Hosting & Produksi](#-panduan-hosting--produksi)
8. [Struktur Direktori Penting](#-struktur-direktori-penting)
9. [Status Repositori GitHub](#-status-repositori-github)
10. [Lisensi & Kredit](#-lisensi--kredit)

---

## 🌟 Tentang Website

Website **Nirwana Tour Lampung** adalah platform digital komprehensif yang dirancang untuk menghadirkan pengalaman pemesanan perjalanan yang mudah, cepat, dan profesional bagi wisatawan perorangan, sekolah, universitas, instansi pemerintahan, maupun perusahaan swasta.

Didukung oleh arsitektur **Laravel 12** dan panel administrasi modern **Filament 3**, website ini memberikan kontrol penuh kepada admin perusahaan untuk mengelola katalog paket wisata, artikel panduan wisata, testimoni, sertifikasi usaha, video dokumentasi, hingga pengaturan konten beranda secara real-time.

---

## 🚀 Fitur Utama & Keunggulan

### 1. Antarmuka Publik (Front-End Wisatawan)
- **Desain Mewah Bernuansa Wisata Indonesia**:
  - Hero Beranda berlatar siluet Candi Borobudur dengan teknik *White Fusion Gradient*.
  - Section Solusi Layanan (Dieng), Mengapa Memilih Kami (Candi Prambanan), dan Edukasi (Gunung Bromo) berpadu harmonis dengan gradasi warna pink logo elegan khas Nirwana Tour (`#DE0171`, `#FC028B` & `#36021B`).
- **Pencarian Cepat (*Instant Live Filter & Search*)**:
  - Pencarian paket wisata real-time dengan *debounce 280ms* tanpa me-refresh halaman.
  - Filter interaktif berdasarkan **Kategori Wisata**, **Durasi Trip**, **Rentang Biaya**, dan **Urutan Harga**.
  - Sinkronisasi otomatis ke URL peramban (*HTML5 History API*) sehingga link filter dapat langsung dibagikan.
- **Galeri Video & Instagram Reels Sinematik**:
  - Format cover video proporsional 9:16 (*full-bleed*) dengan *Glassmorphic Play Button* dan badge resmi Instagram Reels.
  - *Reels Lightbox Modal Player* otomatis memutar video secara fokus tanpa mengganggu animasi *marquee auto-scroll*.
- **PWA (*Progressive Web App*)**:
  - Notifikasi *Install Banner* cerdas untuk pengunjung HP Android/iOS untuk memasang website langsung ke *Home Screen*.
  - Dilengkapi *Service Worker* dan *Manifest* untuk pemuatan super cepat dan hemat kuota.
- **Estimator Anggaran Interaktif (*Budget Estimator*)**:
  - Simulasi hitung biaya perjalanan instan yang terhubung langsung ke format chat WhatsApp konsultan.
- **Konsultan Perjalanan WhatsApp Mengambang (*Floating Concierge*)**:
  - Widget WhatsApp melayang di sudut layar dengan pilihan topik pertanyaan cepat (Paket Tour, Study Tour, Gathering, Sewa Bus).
- **Halaman Profil & Kredibilitas Lengkap**:
  - Profil Perusahaan, Manajemen & Tim Pemandu Berlisensi HPI, Legalitas & Sertifikasi Resmi (NIB & TDUP), Berita & Tips Wisata, serta Halaman Kontak.

### 2. Panel Admin (Back-End Filament v3)
- **Katalog Paket Wisata**: Tambah/edit destinasi, harga bertingkat, fasilitas include/exclude, itinerary hari-ke-hari, dan upload foto multi-resolusi.
- **Layanan Wisata**: Pengaturan layanan unggulan perusahaan beserta daftar keunggulannya.
- **Galeri Dokumentasi**: Manajemen video YouTube, file MP4, serta Instagram Reels.
- **Blog & Tips Wisata**: Editor artikel lengkap dengan kategori, tags, waktu baca, dan optimasi SEO meta.
- **Sertifikasi Usaha**: Arsip digital dokumen perizinan resmi perusahaan.
- **Inquiry & Pesan Masuk**: Rekap formulir pemesanan dan pertanyaan dari calon pelanggan.
- **Pengaturan Beranda & Profil Dinamis**: Ubah teks hero, kutipan founder, statistik tahunan, hingga ganti background foto wisata secara mandiri tanpa coding.

---

## 🛠 Teknologi yang Digunakan

| Komponen | Teknologi | Keterangan |
|---|---|---|
| **Back-End Framework** | Laravel 12.x | PHP Web Framework terkini |
| **Admin Panel** | Filament v3.x | TALL-Stack Administration Panel |
| **Bahasa Pemrograman** | PHP 8.3+ | Kecepatan & penanganan tipe ketat |
| **Front-End Styling** | Tailwind CSS 3.x & Custom CSS | Desain responsif, adaptif, & berkinerja tinggi |
| **Build Tool** | Vite 8.x | Kompilasi aset CSS/JS instan & minifikasi |
| **Interaktivitas UI** | Alpine.js & Vanilla JavaScript | Interaktivitas ringan tanpa beban berat |
| **Basis Data** | MySQL 8.0+ / MariaDB | Relasional dengan skema terindeks optimal |
| **Optimasi Gambar** | WebP GD Optimizer | Kompresi foto otomatis untuk kecepatan akses |
| **Testing** | PHPUnit 11.x | 60 skenario pengujian otomatis lulus 100% |

---

## 💻 Kebutuhan Sistem

Sebelum menjalankan proyek ini, pastikan komputer/server Anda memenuhi persyaratan berikut:
- **PHP** >= 8.2 (Sangat direkomendasikan **PHP 8.3**)
- Ekstensi PHP yang aktif: `BCMath`, `Ctype`, `cURL`, `DOM`, `Fileinfo`, `Filter`, `GD`, `Hash`, `Mbstring`, `OpenSSL`, `PCRE`, `PDO`, `PDO_MySQL`, `Session`, `Tokenizer`, `XML`.
- **Composer** >= 2.6.x
- **Node.js** >= 18.x & **NPM** >= 9.x
- **MySQL** >= 8.0 atau **MariaDB** >= 10.4

---

## ⚙️ Instalasi Lokal (Local Development)

Ikuti langkah-langkah di bawah ini untuk menjalankan website di komputer lokal:

### 1. Kloning Repositori
```bash
git clone https://github.com/Ryswanmf/nirwana-tour.git
cd nirwana-tour
```

### 2. Pindah ke Branch Aktif
```bash
git checkout riswan
```

### 3. Pasang Dependensi PHP & JavaScript
```bash
composer install
npm install
```

### 4. Konfigurasi Environment (`.env`)
Salin file konfigurasi contoh:
```bash
cp .env.example .env
php artisan key:generate
```
Buka file `.env` dan sesuaikan koneksi database MySQL lokal Anda:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nirwana_tour
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Buat Database & Import Data
Buat database bernama `nirwana_tour` di MySQL Anda, kemudian import file SQL bawaan:
```bash
# Melalui terminal mysql:
mysql -u root -p nirwana_tour < database/nirwana_tour.sql

# Atau alternatif via Laravel Migration:
php artisan migrate --seed
```

### 6. Hubungkan Penyimpanan Berkas (*Storage Link*)
```bash
php artisan storage:link
```

### 7. Kompilasi Aset
```bash
npm run build
```
*(Untuk pengembangan langsung dengan hot-reload, gunakan `npm run dev`)*

### 8. Jalankan Server Lokal
```bash
php artisan serve
```
Buka peramban di: **`http://127.0.0.1:8000`**

---

## 🔐 Akses Panel Admin (Filament)

Panel administrasi dapat diakses melalui URL:
* **URL**: `http://127.0.0.1:8000/admin`
* **Email Default**: `admin@nirwanatour.com`
* **Password Default**: `password123`

> [!TIP]
> Anda dapat membuat admin baru kapan saja lewat terminal dengan perintah:
> `php artisan make:filament-user`

---

## 🌐 Panduan Hosting & Produksi

### Opsi 1: Shared Hosting (cPanel / DirectAdmin)
1. **Kompres Berkas**: Jalankan `npm run build` lokal, lalu arsipkan seluruh folder proyek ke format `.zip` (pastikan folder `public/build`, `vendor`, `app`, `resources` ikut ter-zip).
2. **Unggah & Ekstrak**: Unggah file zip ke cPanel File Manager lalu ekstrak.
3. **Atur Document Root**: Arahkan *Document Root* domain Anda ke folder **`/public`**.
4. **Setup Database**: Buat database MySQL di cPanel dan import berkas `database/nirwana_tour.sql` via phpMyAdmin.
5. **Sesuaikan `.env`**: Atur `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://domainanda.com`, dan kredensial database cPanel.
6. **Hubungkan Storage Link**: Jalankan `php artisan storage:link` via terminal cPanel.

### Opsi 2: Cloud / VPS (Ubuntu, Nginx, Docker)
```bash
git clone https://github.com/Ryswanmf/nirwana-tour.git /var/www/nirwana-tour
cd /var/www/nirwana-tour
composer install --optimize-autoloader --no-dev
npm install && npm run build
cp .env.example .env
php artisan key:generate
# Sesuaikan .env lalu import database
php artisan storage:link
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
php artisan optimize
```

---

## 📁 Struktur Direktori Penting

```text
Nirwana-Tour-Lampung/
├── app/
│   ├── Filament/                # Panel Admin (Resources, Pages, Widgets)
│   │   ├── Pages/               # ManageHomePage, CompanyProfile
│   │   └── Resources/           # Package, Service, Gallery, Post, dll.
│   ├── Helpers/                 # ImageOptimizer, Helpers webp
│   ├── Http/Controllers/        # HomeController, PackageController, dll.
│   └── Models/                  # TourPackage, GalleryItem, SiteSetting, dll.
├── database/
│   ├── migrations/              # Skema tabel database
│   ├── seeders/                 # Data inisialisasi awal
│   └── nirwana_tour.sql         # Snapshot database siap import
├── public/
│   ├── assets/                  # Logo, gambar hero, dan destinasi
│   ├── build/                   # Hasil kompilasi Vite (CSS & JS)
│   ├── manifest.json            # Konfigurasi PWA Mobile
│   ├── sw.js                    # Service Worker Offline Cache
│   └── robots.txt               # Aturan SEO search engine
├── resources/
│   ├── css/                     # custom.css & app.css
│   └── views/
│       ├── components/          # Navbar, Footer, Budget Estimator, Card
│       ├── layouts/             # Layout utama app.blade.php
│       └── pages/               # Beranda, Layanan, Paket, Galeri, dll.
└── routes/
    └── web.php                  # Rute navigasi website
```

---

## 🔗 Status Repositori GitHub

Repositori ini telah terhubung secara resmi ke remote GitHub:
* **Remote URL**: [`https://github.com/Ryswanmf/nirwana-tour.git`](https://github.com/Ryswanmf/nirwana-tour.git)
* **Branch Utama Pengembangan**: `riswan`
* **Status Sinkronisasi**: Siap di-push dengan `git push origin riswan`.

---

## 📄 Lisensi & Kredit

Hak Cipta &copy; 2026 **Nirwana Tour Lampung**. Seluruh hak cipta dilindungi undang-undang.<br>
Dikembangkan dan dipelihara secara profesional oleh tim developer [Swift Code Lampung](https://www.instagram.com/swiftcode.lpg).
