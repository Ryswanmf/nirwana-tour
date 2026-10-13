# Nirwana Tour Lampung - Company Profile Website

Single-page website profile perusahaan travel **Nirwana Tour Lampung**, built with HTML, CSS, and JavaScript. Website menampilkan 9 section lengkap dengan fitur interaktif: filter destinasi, kalkulator estimasi biaya, modal rundown itinerary, lightbox gallery, dan koneksi WhatsApp untuk konsultasi.

---

## 📋 Fitur Utama

### Navigasi & Layout
- **Single-page navigation** dengan smooth scroll antar section
- **Navbar sticky** yang menambah kelas `.scrolled` saat scroll turun
- **Menu hamburger mobile** untuk layar < 768px dengan close di luar area
- **Anchor links** dengan highlight section aktif berdasarkan posisi scroll

### Section Website
1. **Hero** - Headline "Jelajahi Dunia, Ciptakan Cerita" dengan tombol konsultasi WhatsApp
2. **Tentang Kami** - Profil perusahaan dengan foto tim dan badge "8+ Tahun Melayani"
3. **Layanan** - 4 jenis perjalanan: Wisata, Study Tour, Kunjungan Industri, Transportasi Rombongan
4. **Destinasi Wisata** - 9 kartu destinasi dengan filter kategori (Lampung, Nusantara, Edukasi)
5. **Keunggulan** - Alasan memilih Nirwana Tour Lampung
6. **Galeri Kegiatan** - Lightbox modal dengan navigasi next/prev dan keyboard control
7. **Kontak** - Formulir kontak + tombol WhatsApp cepat
8. **Footer** - Identitas perusahaan, tautan sosial, copyright tahun dinamis

### Fitur Interaktif
- **Budget Estimator** - Kalkulator biaya wisata interaktif dengan:
  - Dropdown destinasi (9 opsi, termasuk 3 paket domestik baru: Jakarta-Bandung, Yogyakarta, Malang-Bromo)
  - Slider jumlah peserta
  - Opsi armada transportasi (HiAce, Medium Bus, Big Bus)
  - Add-on: drone (Rp750k), kaos trip, dinner
  - Output: harga perorang & total dalam format Rupiah
  - Tombol WhatsApp CTA dengan pesan otomatis

- **Itinerary Modal** - Modal detail rundown perjalanan per paket dengan:
  - Timeline per hari
  - Daftar include & exclude
  - Harga per paket
  - Tombol WhatsApp konsultasi
  - Tutup dengan tombol X atau backdrop click

- **Destination Filter** - Tab filter kategori:
  - Semua / Lampung / Nusantara / Edukasi
  - Menampilkan/ menyembunyikan kartu destinasi sesuai filter

- **Lightbox Gallery** - Pop-up foto kegiatan:
  - Navigasi next/prev
  - Keyboard control (Arrow Left/Right, Escape)
  - Counter gambar saat ini / total
  - Title & caption dari setiap foto

- **WhatsApp Integration** - Tombol konsultasi tersebar di:
  - Hero section
  - Setiap card layanan
  - Setiap card destinasi
  - Setiap tombol "Pesan Paket"
  - Contact form submit

- **FAQ Accordion** - 6 pertanyaan jawaban dengan:
  - Tutup semua yang lain saat buka satu
  - ARIA expanded attributes
  - Animasi height transition

### Desain Visual
- **Paleta warna**:
  - Primer: Ocean Blue `#0284C7`
  - Aksen: Gold `#F59E0B`
  - Neutral: Abu-abu gelap `#0f2c59` - `#f8f9fa`
- **Typography**: Font `Plus Jakarta Sans` untuk semua teks
- **Radius**: `var(--radius-xl)` untuk kotak, `var(--radius-md)` untuk badge
- **Shadow**: `var(--shadow-xl)` untuk kartu dan image wrapper

### Media & Aset
- **Gambar destinasi**: 12 gambar di 3 kategori (Lampung dalam, Nusantara, Edukasi)
- **Galerinya**: Foto kegiatan wisata dengan data-src untuk lightbox
- **Hero section**: Gambar perjalanan utama
- **Logo**: `Logo-Nirwana.png` di Navbar dan Footer
- **Foto tim**: `about-team.jpg` di section tentang kami

---

## 📁 Struktur File

```
nirwana-tour-lampung/
├── index.html          # Halaman utama, 9 section, semua content
├── css/
│   └── style.css       # Gaya tampilan, warna, responsif
└── js/
    └── script.js       # Semua interaktivitas (828 lines)
        └── 11 modul:
            - WhatsApp conversion links
            - Sticky navbar & scroll highlight
            - Mobile hamburger menu
            - Smooth scroll anchor links
            - Destination filter tabs
            - Itinerary rundown modal
            - Budget estimator kalkulator
            - FAQ accordion
            - Lightbox gallery modal
            - Dynamic year update
            - Contact form to WhatsApp

assets/
├── images/
│   ├── hero/
│   │   ├── about-team.jpg      # Foto tim perusahaan
│   │   ├── hero-bg.jpg         # Background hero
│   │   └── about-team.jpg    # (ganti dari pemilik)
│   ├── destinasi/
│   │   ├── 6 gambar Lampung
│   │   ├── jakarta-bandung.jpg
│   │   ├── yogyakarta.jpg
│   │   └── bromo.jpg
│   └── galeri/
│       └── multiple gallery images
└── logo/
    └── Logo-Nirwana.png
```

---

## 🛠 Teknologi

- **HTML5** - Struktur semantic, 9 section, data attributes
- **CSS3** - Flexbox, Grid, responsive design, CSS variables
- **Vanilla JavaScript** - Tidak ada dependency luar, 828 lines murni
- **Font Awesome 6** - Ikon (check, xmark, clock, bus, dll)
- **Responsive** - Mobile-first, breakpoints di 768px dan 375px
- **No Build Step** - Bisa langsung dibuka di browser

---

## 📱 Uji Coba

### Browser Automation Test Results
- **0 error/warning** di headless browser
- **Image display**: 412×560px founder photo (sekarang tim photo)
- **Mobile viewport** 375px: Semua fitur aktif
- **Calculator**: 3 paket domestic dengan price data benar
- **Filter**: 9 kartu destinasi + 3 kategori filter
- **Modal**: Itinerary dan Lightbox terbuka/tertutup dengan benar

### Test Scenario
1. Buka `index.html` di browser
2. Test smooth scroll ke tiap section
3. Cek menu hamburger di mobile (resize < 768px)
4. Filter destinasi ke Lampung/Nusantara/Edukasi
5. Kalkulator estimator: pilih destinasi, masukan peserta, lihat harga
6. Klik tombol "Pesan Paket" buka modal rundown
7. Galeri: klik foto buka lightbox, cek navigasi
8. Scroll turun, lihat navbar berubah warna (sticky)
9. WhatsApp buttons: verifikasi URL wa.me terbuka dengan pesan otomatis

---

## 🚀 Deployment

Website static bisa dihosting di:
- **GitHub Pages** - Letak `index.html` di branch `main`
- **Netlify** - Drag folder atau koneksi repo
- **Vercel** - Same principle
- **Shared hosting** - Upload file ke `public_html`

**Catatan**: Tidak butah build step atau server-side language. Cukup upload file ke web server.

---

## 📞 Kontak

**Nirwana Tour Lampung**
- Website: Dibuat untuk konsultasi perjalanan wisata
- WhatsApp: Terintegrasi di seluruh tombol konsultasi
- Pembuatan: Single-page travel profile

---

*Dibangun dengan ❤️ untuk mempromosikan perjalanan wisata ke Lampung dan destinasional Indonesia lainnya.*