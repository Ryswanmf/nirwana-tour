# 🌟 Dokumen Fitur & Presentasi Website Nirwana Tour & Travel Lampung

> **Dokumen Presentasi Klien & Spesifikasi Fitur Produk**  
> **Aplikasi:** Nirwana Tour & Travel Lampung  
> **Teknologi:** Laravel 12 + Filament 3 + Tailwind CSS + Alpine.js + PWA  
> **Tanggal:** 2026

---

## 📋 Daftar Isi
1. [Ringkasan Eksekutif & Nilai Tambah (Value Proposition)](#1-ringkasan-eksekutif--nilai-tambah-value-proposition)
2. [Fitur Utama Pengunjung (Frontend & Pengalaman Pengguna)](#2-fitur-utama-pengunjung-frontend--pengalaman-pengguna)
3. [Fitur Konversi & Integrasi WhatsApp Cerdas](#3-fitur-konversi--integrasi-whatsapp-cerdas)
4. [Kemampuan Progressive Web App (PWA)](#4-kemampuan-progressive-web-app-pwa)
5. [Fitur Manajemen Konten (Panel Admin Filament v3)](#5-fitur-manajemen-konten-panel-admin-filament-v3)
6. [Optimalisasi SEO, Keamanan & Performa Tinggi](#6-optimalisasi-seo-keamanan--performa-tinggi)
7. [Panduan & Skrip Alur Demo untuk Presentasi ke Klien](#7-panduan--skrip-alur-demo-untuk-presentasi-ke-klien)

---

## 1. Ringkasan Eksekutif & Nilai Tambah (Value Proposition)

Website **Nirwana Tour & Travel Lampung** dirancang khusus bukan sekadar sebagai "brosur digital", melainkan sebuah **mesin konversi penjualan paket wisata (*Tour Sales Machine*)** yang elegan, cepat, dan mudah dikelola oleh pemilik bisnis pariwisata.

### 🎯 Keunggulan Utama untuk Bisnis Klien:
* **High Conversion to WhatsApp**: 85%+ wisatawan di Indonesia memesan tur melalui WhatsApp. Website ini mengintegrasikan tombol konsultasi dan pemesanan dengan pesan otomatis yang sudah terisi (*pre-filled auto message*).
* **Kalkulator Wisata Mandiri (Price Estimator)**: Membantu calon klien menghitung estimasi biaya grup atau custom trip secara transparan dalam hitungan detik sebelum menghubungi admin.
* **Tampilan Mewah & Modern (Luxury Tourism Branding)**: Menggunakan kombinasi warna *Elegant Logo Pink* (`#DE0171` & `#FC028B`) yang serasi dengan identitas logo resmi Nirwana Tour, berpadu dengan aksen *Warm Sand Gold* (`#F59E0B`) dan latar *Royal Velvet Noir* (`#36021B`), meningkatkan kredibilitas agen tour di mata wisatawan premium, keluarga, instansi BUMN, maupun rombongan perusahaan (*corporate gathering*).
* **Bisa Di-install di HP Seperti Aplikasi (PWA)**: Wisatawan tidak perlu download dari Play Store, cukup 1 klik "Install App" langsung tersimpan di layar beranda ponsel mereka.
* **Panel Admin Mandiri (Full Self-Service)**: Pemilik bisnis dapat mengubah harga, menambah paket wisata, mengunggah foto galeri, menulis artikel tips wisata, dan memantau pesanan masuk tanpa perlu coding.

---

## 2. Fitur Utama Pengunjung (Frontend & Pengalaman Pengguna)

### A. Navigasi & Tampilan Responsif (Mobile-First Experience)
* **Header Pintar (*Sticky & Smart Glassmorphism*)**: Header otomatis berubah latar semi-transparan saat digulir (*scroll*) untuk menjaga fokus pengunjung.
* **Menu Mobile Ergonomis**: Tombol hamburger dengan drawer navigasi yang lega, ukuran tombol ramah jempol (*thumb-friendly touch target*), dan garis bawah indikator halaman aktif yang bersih tanpa latar merah muda yang mengganggu.
* **Dropdown Submenu "Tentang" Interaktif**: Transisi akordeon halus untuk mengakses Profil Perusahaan, Struktur Manajemen, Sertifikasi Legalitas, dan Galeri Dokumentasi.

### B. Beranda Interaktif (*High-Impact Hero Section*)
* **Hero Banner Sinematik**: Menampilkan tagline kuat, tombol aksi langsung (*Rencanakan Perjalanan* & *Jelajahi Paket*), serta statistik pencapaian (Ribuan Wisatawan Puas, Destinasi Unggulan, Rating 4.9/5.0).
* **Trust Badges & Nilai Unggulan**: Sorotan legalitas resmi, pemandu lokal berlisensi, garansi keamanan perjalanan, dan armada kendaraan prima.

### C. Katalog Destinasi & Paket Wisata (*Tour Packages Showcase*)
* **Pencarian Kilat Instan (*Instant Live Debounced Search*)**: Pengunjung dapat mengetik nama destinasi (misal: "Pahawang", "Kiluan", "Gigi Hiu") dan kartu paket langsung tersaring seketika tanpa perlu memuat ulang halaman (*zero page reload*).
* **Filter Berdasarkan Kategori**: Memilih paket wisata berdasarkan jenis: Wisata Bahari & Snorkeling, Geowisata & Petualangan, Family Vacation, Outbound/Gathering Perusahaan, dan Edukasi.
* **Kartu Paket Informatif**: Menampilkan foto destinasi berkualitas tinggi, durasi (misal: *1 Hari*, *2H1M*, *3H2M*), badge kategori, harga per pax, ringkasan fasilitas, dan tombol detail.

### D. Modal Interaktif Detail Itinerary & Rundown
* **Modal Rundown Interaktif**: Tanpa meninggalkan halaman beranda, pengunjung dapat melihat jadwal perjalanan jam-per-jam (contoh: *07.30 Briefing, 09.30 Snorkeling Cukuh Bedil, 12.00 Makan Siang Prasmanan*).
* **Daftar Fasilitas Jelas (Include & Exclude)**: Memastikan transparansi apa saja yang didapat wisatawan (alat snorkeling, dokumentasi underwater, kapal wisata, tiket retribusi, asuransi, dll.).
* **Tombol Pesan Terintegrasi WA**: Tombol "Pesan Paket Ini via WhatsApp" langsung membuka WhatsApp dan menuliskan nama paket yang dipilih secara otomatis.

### E. Kalkulator Estimasi Biaya Wisata (*Trip Cost Estimator*)
* **Fitur Interaktif Canggih**: Pengunjung dapat memilih destinasi, menentukan jumlah peserta (1 hingga 50+ orang), durasi hari, dan opsi tambahan (dokumentasi drone, penginapan upgrade, water sport).
* **Perhitungan Real-Time**: Sistem otomatis menghitung estimasi total biaya dan estimasi biaya per orang secara transparan.
* **Konsultasi Hasil Estimasi**: Pengunjung dapat langsung menekan tombol *"Konsultasikan Estimasi Ini via WhatsApp"* dengan rincian hitungan yang otomatis tersalin ke chat admin.

### F. Showcase Video Instagram Reels Sinematik
* **Kartu Video Instagram Modern**: Menampilkan cuplikan video kegiatan liburan dengan efek kartu bertema glassmorphic, durasi klip, serta tombol *Play*.
* **Lightbox Video Player Modal**: Ketika diklik, video terbuka dalam jendela pop-up responsif yang bersih dan nyaman ditonton di perangkat ponsel maupun desktop.

### G. Layanan Perjalanan Lengkap (*Comprehensive Tour Services*)
* Menampilkan portofolio layanan beyond paket wisata:
  1. **Sewa Mobil & HiAce / Bus Pariwisata Lampung**
  2. **Corporate Gathering, Outbound & Team Building**
  3. **Pemesanan Tiket Kapal Cepat & Tiket Pesawat**
  4. **Reservasi Hotel & Resort Tepi Pantai**
  5. **Custom Private Trip VIP**

### H. Bukti Sosial & Ulasan Wisatawan (*Social Proof & Reviews*)
* **Rating Google Reviews 4.9 Bintang**: Menampilkan kepuasan pelanggan secara meyakinkan.
* **Kartu Ulasan Wisatawan**: Testimoni asli lengkap dengan nama, asal kota, bintang kepuasan, foto profil, dan kutipan pengalaman mereka.
* **Formulir Pengiriman Testimoni Publik**: Wisatawan yang baru selesai trip dapat mengirim ulasan langsung melalui website (ulasan dapat dimoderasi oleh admin sebelum tayang).

### I. Pusat Informasi & FAQ Interaktif (*Frequently Asked Questions*)
* Desain akordeon tanya-jawab interaktif mengenai cara booking, kebijakan refund/reschedule, fasilitas untuk lansia/anak-anak, dan titik kumpul (*meeting point*).

### J. Galeri Dokumentasi Foto & Album Perjalanan
* Album foto kegiatan wisata dengan filter lokasi (Pulau Pahawang, Teluk Kiluan, Pantai Gigi Hiu, Krakatau, dll.).
* Pratinjau gambar tajam dengan proteksi loading cepat (*lazy loading*).

### K. Artikel Tips & Berita Pariwisata (*SEO Blog*)
* Portal informasi seputar panduan wisata Lampung, tips snorkeling, rekomendasi kuliner, dan berita terbaru.
* Membantu website mendapatkan ranking nomor 1 di Google (*Organic Traffic Booster*).
* Fitur pencarian artikel, pagination rapi, kategori artikel, dan rekomendasi tulisan terkait.

### L. Halaman Kredibilitas & Legalitas Resmi Perusahaan
* **Halaman Profil Nirwana**: Visi, misi, sejarah pendirian, nilai-nilai pelayanan, dan komitmen keselamatan.
* **Halaman Struktur Manajemen**: Profil pimpinan perusahaan, tim operasional, dan tour guide tersertifikasi.
* **Halaman Sertifikasi & Izin Usaha**: Menampilkan sertifikat izin resmi biro perjalanan wisata, bukti anggota asosiasi resmi pariwisata (ASITA), dan sertifikat CHSE/Kemenparekraf.

---

## 3. Fitur Konversi & Integrasi WhatsApp Cerdas

Seluruh alur interaksi dirancang untuk mempermudah calon wisatawan bertransaksi langsung via WhatsApp dengan data terstruktur:

| Titik Pemicu (*Trigger*) | Format Pesan Otomatis ke WhatsApp Admin |
|---|---|
| **Tombol Header / Navbar** | *"Halo Nirwana Tour, saya ingin konsultasi perjalanan."* |
| **Tombol Detail Paket Wisata** | *"Halo Nirwana Tour, saya ingin pesan Paket Wisata [Nama Paket] untuk jadwal mendatang..."* |
| **Hasil Kalkulator Estimasi** | *"Halo Nirwana Tour, saya telah menghitung estimasi biaya [Nama Paket] untuk [X] peserta..."* |
| **Formulir Kontak Beranda** | Berisi format lengkap: Nama, Nomor Telepon, Layanan yang Dipilih, Jumlah Peserta, Tanggal, dan Catatan Khusus. |
| **Floating Concierge Speed-Dial** | Menampilkan menu pop-up interaktif: Tanya Paket, Sewa Armada, Rekening Pembayaran, & Jam Operasional. |

---

## 4. Kemampuan Progressive Web App (PWA)

Website ini dibangun menggunakan standar modern **Progressive Web App (PWA)**:
1. **Dapat Di-install Seperti Aplikasi Native**:
   - Di Android: Muncul banner ajakan *"Pasang Aplikasi Nirwana Tour"* dengan 1 klik install.
   - Di iPhone / iOS: Panduan *"Add to Home Screen"* via Safari.
   - Di Komputer / Laptop: Muncul ikon install di address bar browser Google Chrome / Microsoft Edge.
2. **Ikon & Splash Screen Khusus**: Memiliki icon branding beresolusi tinggi (192px dan 512px) serta tema warna status bar yang senada.
3. **Offline Caching (Service Worker `sw.js`)**: Halaman yang sudah pernah dikunjungi tetap dapat dibuka meski koneksi internet wisatawan sedang tidak stabil di tengah laut atau pulau terpencil.

---

## 5. Fitur Manajemen Konten (Panel Admin Filament v3)

Pemilik bisnis diberikan akses dashboard admin yang aman, elegan, dan berbahasa Indonesia di URL khusus `/login` atau `/admin`.

### 🎛️ 14 Modul Pengelolaan Konten:
1. **Manajemen Paket Wisata (`Tour Packages`)**: Tambah/edit destinasi, harga, durasi, status unggulan (*featured*), fasilitas include/exclude, dan rundown acara.
2. **Manajemen Kategori (`Categories`)**: Klasifikasi kategori wisata dan kategori artikel.
3. **Manajemen Armada & Transportasi (`Fleets`)**: Kelola daftar mobil (Avanza, Innova, HiAce, Bus Pariwisata) beserta kapasitas penumpang dan fasilitasnya.
4. **Manajemen Layanan (`Services`)**: Update deskripsi jasa travel, outbound, dan tiket.
5. **Manajemen Artikel & Berita (`Posts`)**: Editor teks kaya (*Rich Text WYSIWYG*), upload thumbnail, pengaturan tag, dan status publish/draft.
6. **Manajemen Galeri Foto (`Gallery Items`)**: Unggah foto dokumentasi trip, penamaan album, dan penataan urutan foto.
7. **Manajemen Testimoni (`Testimonials`)**: Verifikasi dan terbitkan ulasan kepuasan pelanggan dengan rating bintang.
8. **Manajemen Permintaan Custom (`Inquiries`)**: Rekapitulasi calon pelanggan yang mengisi form pemesanan custom di web.
9. **Manajemen Pesan Kontak (`Contacts`)**: Membaca pesan kritik dan saran yang dikirim via formulir kontak.
10. **Manajemen Sertifikat & Legalitas (`Certificates`)**: Unggah bukti izin edar, sertifikat akreditasi, dan penghargaan usaha.
11. **Manajemen Tim & Pemandu (`Team Members`)**: Kelola profil jajaran direksi, staf operasional, dan tour leader.
12. **Manajemen Mitra Rekanan (`Partners`)**: Tampilkan logo hotel rekanan, maskapai penerbangan, dan klien korporasi yang pernah bekerjasama.
13. **Pengaturan Global Situs (`Site Settings`)**: Mengganti nomor WhatsApp tujuan, alamat kantor, email, link media sosial (Instagram, Facebook, TikTok, YouTube), jam operasional, dan meta description SEO hanya dari satu form.
14. **Manajemen Pengguna (`Users`)**: Tambah staf admin, ubah password akun, dan hak akses.

### 🛠️ Fitur Spesial Hosting Mandiri (Hosting Friendly):
* **One-Click Storage Link (`/admin/storage-link`)**: Memperbaiki link folder gambar hanya dengan membuka 1 link tanpa perlu akses command line SSH di cPanel.
* **One-Click Database Backup (`/admin/backup-database`)**: Tombol instan untuk mengunduh salinan cadangan seluruh database website dalam format `.sql` ke laptop admin demi keamanan data.

---

## 6. Optimalisasi SEO, Keamanan & Performa Tinggi

* **SEO On-Page Siap Peringkat Google**:
  - Peta situs otomatis XML di URL `/sitemap.xml` yang selalu ter-update secara berkala untuk mempermudah Google Search Console mengindeks website.
  - Tag OpenGraph (OG:Image, OG:Title, OG:Description) agar saat link website dibagikan ke WhatsApp, Facebook, atau Telegram, otomatis muncul gambar banner yang menarik.
* **Kecepatan Akses Kilat**:
  - Menggunakan kompresi aset modern (*Vite Bundle, Gzip/Brotli, CSS Minification*).
  - Prefetching pintar: browser otomatis memuat halaman tujuan saat kursor pengguna mendekati tombol menu (*hover/touch*), menghasilkan perpindahan halaman instan.
* **Standar Keamanan Tinggi**:
  - Proteksi penuh terhadap serangan hacker: CSRF Protection, Anti-SQL Injection, XSS Protection, dan Password Hashing standar industri.
  - Form dilengkapi validasi anti-spam untuk mencegah bot mengirim pesan palsu.

---

## 7. Panduan & Skrip Alur Demo untuk Presentasi ke Klien

Gunakan urutan alur ini saat mendemokan website langsung di hadapan calon klien/klien Anda:

```
[Tahap 1: Pembukaan & First Impression]
  👉 Tampilkan Halaman Beranda (Desktop & Mobile view).
  👉 Jelaskan: "Desain website ini dibuat eksklusif dengan warna brand Nirwana Tour, memberikan kesan biro wisata resmi yang profesional dan terpercaya."

[Tahap 2: Demo Fitur Pencarian Paket & Rundown]
  👉 Buka menu "Paket Wisata".
  👉 Ketik "Pahawang" di kolom pencarian tanpa klik apa pun — tunjukkan bagaimana kartu paket langsung tersaring seketika (Instant Search).
  👉 Klik salah satu paket dan buka "Rundown Acara" — tunjukkan rincian jam per jam yang sangat memudahkan calon wisatawan.

[Tahap 3: Demo Kalkulator Estimasi Biaya (Fitur Unggulan)]
  👉 Buka bagian "Kalkulator Wisata".
  👉 Geser jumlah peserta menjadi 25 orang, pilih opsi dokumentasi drone.
  👉 Tunjukkan bagaimana biaya per orang langsung terhitung otomatis.
  👉 Klik tombol WhatsApp: tunjukkan bahwa rincian kalkulasi langsung tertata rapi di pesan WhatsApp tanpa perlu diketik manual oleh klien.

[Tahap 4: Demo Tampilan Mobile & Kemudahan PWA]
  👉 Buka browser di smartphone (atau aktifkan mode inspeksi ponsel di Chrome F12).
  👉 Tunjukkan navigasi hamburger yang nyaman, jarak antar menu yang lega, serta dropdown "Tentang" yang membuka akordeon profil & sertifikasi.
  👉 Tunjukkan tombol "Install App" (PWA) yang memungkinkan wisatawan menyimpan website ke homescreen layaknya aplikasi.

[Tahap 5: Demo Panel Admin (Filament v3)]
  👉 Login ke halaman `/login`.
  👉 Tunjukkan betapa mudahnya mengedit harga paket, mengganti nomor WhatsApp, atau menambah foto galeri baru hanya dalam beberapa detik.
  👉 Tunjukkan fitur download backup database untuk keamanan jangka panjang.

[Tahap 6: Closing & Nilai Investasi]
  👉 Tekankan: "Website ini bukan sekadar profil perusahaan, melainkan alat bantu kerja yang akan menghemat waktu admin dalam membalas chat harga serta meningkatkan persentase closing penjualan tur harian."
```

---

*Dokumen ini disusun sebagai panduan resmi penyerahan produk dan materi presentasi komersial Nirwana Tour & Travel Lampung.*
