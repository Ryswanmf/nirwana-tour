@extends('layouts.app')

@section('title', 'Galeri Video Dokumentasi - ' . ($settings['site_name'] ?? 'Nirwana Tour Lampung') . ' | Momen Perjalanan Terbaik')
@section('meta_description', 'Koleksi video dokumentasi autentik kegiatan wisata, study tour sekolah, snorkeling bahari, dan gathering rombongan perusahaan bersama Nirwana Tour Lampung.')

@section('content')
  <main>
    <!-- ========================================================
         PAGE HERO BANNER & BREADCRUMB
         ======================================================== -->
    <section class="page-hero">
      <div class="container page-hero-content">
        <nav class="breadcrumb-nav" aria-label="Breadcrumb">
          <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> Beranda</a>
          <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
          <span class="current">Galeri Video</span>
        </nav>
        <h1 class="page-hero-title">Galeri Video Kegiatan Wisata</h1>
        <p class="page-hero-desc">
          Koleksi cuplikan video dokumentasi autentik keceriaan para wisatawan, rombongan instansi, sekolah, dan keluarga saat menjelajahi destinasi impian bersama Nirwana Tour Lampung.
        </p>
      </div>
    </section>

    <!-- ========================================================
         GALLERY VIDEO SHOWCASE SECTION (VIDEO SAJA)
         ======================================================== -->
    <section class="section bg-alt" id="koleksi-galeri">
      <div class="container">

        <!-- HEADER SUB-BAR (KETERANGAN DOKUMENTASI VIDEO) -->
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px; margin-bottom: 36px; padding-bottom: 20px; border-bottom: 1px solid var(--border-color);">
          <div style="display: inline-flex; align-items: center; gap: 8px; border-left: 3px solid var(--primary, #800020); padding: 3px 0 3px 12px; border-radius: 0; background: transparent; color: var(--primary, #800020); font-weight: 700; font-size: 0.88rem; text-transform: uppercase; letter-spacing: 0.8px;">
            <i class="fa-solid fa-film"></i>
            <span>Dokumentasi Video Nyata &amp; Autentik</span>
          </div>
          <div style="color: var(--text-muted); font-size: 0.88rem;">
            <i class="fa-solid fa-circle-play" style="color: var(--primary, #800020); margin-right: 6px;"></i>
            <span>Klik tombol putar pada video untuk menyaksikan keseruan momen liburan</span>
          </div>
        </div>

        <!-- VIDEO GALLERY GRID (VIDEO ONLY) -->
        @if($galleryItems->isNotEmpty())
          <div class="gallery-video-grid">
            @foreach($galleryItems as $item)
              @php
                $thumbUrl = $item->thumbnail ? asset($item->thumbnail) : asset('assets/images/galeri/video1-poster.jpg');
                $videoUrl = asset($item->file_path);
                
                // Durasi & badge kategori otomatis berdasarkan file_path/order
                $duration = '01:15';
                $catTag = 'Dokumentasi Tour';
                if (str_contains($item->file_path, 'video12')) {
                    $duration = '01:25';
                    $catTag = 'Study Tour & Edukasi';
                } elseif (str_contains($item->file_path, 'video11')) {
                    $duration = '01:40';
                    $catTag = 'Eksotisme Pesisir';
                } elseif (str_contains($item->file_path, 'video10')) {
                    $duration = '01:18';
                    $catTag = 'Ekspedisi Bahari';
                } elseif (str_contains($item->file_path, 'video9')) {
                    $duration = '01:30';
                    $catTag = 'Wisata Budaya';
                } elseif (str_contains($item->file_path, 'video8')) {
                    $duration = '01:45';
                    $catTag = 'Wisata Nusantara';
                } elseif (str_contains($item->file_path, 'video7')) {
                    $duration = '01:10';
                    $catTag = 'Petualangan Alam';
                } elseif (str_contains($item->file_path, 'video6')) {
                    $duration = '01:20';
                    $catTag = 'Konservasi & Edukasi';
                } elseif (str_contains($item->file_path, 'video5')) {
                    $duration = '01:35';
                    $catTag = 'Wisata Bahari';
                } elseif (str_contains($item->file_path, 'video4')) {
                    $duration = '01:15';
                    $catTag = 'Corporate Gathering';
                } elseif (str_contains($item->file_path, 'video3')) {
                    $duration = '01:00';
                    $catTag = 'Liburan Tropis';
                } elseif (str_contains($item->file_path, 'video2')) {
                    $duration = '00:59';
                    $catTag = 'Study Tour Sekolah';
                } elseif (str_contains($item->file_path, 'video1')) {
                    $duration = '01:33';
                    $catTag = 'Wisata Bahari';
                }
              @endphp

              <article class="video-card">
                <div class="video-player-wrapper">
                  <video class="gallery-video" controls playsinline preload="metadata" poster="{{ $thumbUrl }}">
                    <source src="{{ $videoUrl }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutar video HTML5.
                  </video>
                  <div class="video-duration-badge">
                    <i class="fa-solid fa-clock"></i> {{ $duration }}
                  </div>
                </div>

                <div class="video-card-body">
                  <span class="video-tag">{{ $catTag }}</span>
                  <h3 class="video-title">{{ $item->title }}</h3>
                  <p class="video-desc">
                    {{ $item->caption ?? 'Video dokumentasi sinematik autentik keceriaan para wisatawan bersama tim profesional Nirwana Tour Lampung.' }}
                  </p>
                </div>
              </article>
            @endforeach
          </div>

          <!-- PAGINATION -->
          @if($galleryItems->hasPages())
            <div style="margin-top: 48px; display: flex; justify-content: center;">
              {{ $galleryItems->links() }}
            </div>
          @endif
        @else
          <div style="text-align: center; padding: 60px 20px; background: #FFFFFF; border-radius: 18px; border: 1px solid #E2E8F0; box-shadow: 0 4px 18px rgba(0,0,0,0.03);">
            <div style="font-size: 2.8rem; color: #94A3B8; margin-bottom: 14px;">
              <i class="fa-solid fa-video"></i>
            </div>
            <h3 style="font-size: 1.3rem; font-weight: 800; color: #0F172A; margin-bottom: 8px;">Belum Ada Video Dokumentasi</h3>
            <p style="font-size: 0.92rem; color: #64748B; margin-bottom: 22px;">Video dokumentasi kegiatan sedang disiapkan.</p>
          </div>
        @endif

        <!-- CTA HUBUNGI KAMI DI HALAMAN GALERI -->
        <div style="margin-top: 60px; background: linear-gradient(135deg, #4A0012 0%, #800020 100%); border-radius: 22px; padding: 44px 38px; color: #FFFFFF; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 26px; box-shadow: 0 14px 32px rgba(128,0,32,0.2);">
          <div style="max-width: 660px;">
            <h3 style="font-size: 1.5rem; font-weight: 800; color: #FFFFFF; margin: 0 0 10px 0;">
              Ingin Momen Seru Rombongan Anda Diabadikan Bersama Kami?
            </h3>
            <p style="margin: 0; font-size: 0.95rem; color: #FCE7EB; line-height: 1.65;">
              Setiap paket tour bersama Nirwana Tour Lampung sudah termasuk pendampingan dokumentasi profesional agar setiap senyuman dan kenangan indah tetap abadi.
            </p>
          </div>
          <div style="display: flex; gap: 12px; flex-wrap: wrap;">
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg" style="background: #FFFFFF; color: var(--primary, #800020); border: none; font-weight: 700; white-space: nowrap;">
              Hubungi Kami
            </a>
            @php
              $cleanWa = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188');
              $galWaMsg = rawurlencode("Halo Nirwana Tour, saya ingin merencanakan kegiatan wisata rombongan bersama dokumentasi lengkap.");
            @endphp
            <a href="https://wa.me/{{ $cleanWa }}?text={{ $galWaMsg }}"
               target="_blank"
               rel="noopener noreferrer"
               class="btn btn-lg"
               style="background: #25D366; color: #FFFFFF; border: none; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; white-space: nowrap;">
              <i class="fa-brands fa-whatsapp"></i>
              <span>Konsultasi WhatsApp</span>
            </a>
          </div>
        </div>

      </div>
    </section>
  </main>
@endsection
