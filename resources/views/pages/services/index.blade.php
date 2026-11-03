@extends('layouts.app')

@section('title', 'Layanan Perjalanan - ' . ($settings['site_name'] ?? 'Nirwana Tour Lampung') . ' | Biro Wisata & Sewa Bus Terpercaya')
@section('meta_description', 'Layanan lengkap Nirwana Tour Lampung: Paket Wisata Domestik & Lampung, Study Tour Sekolah, Family Gathering Perusahaan, dan Sewa Bus Pariwisata Eksekutif.')

@section('content')
  <main>
    <!-- ========================================================
         PAGE HERO BANNER & BREADCRUMB
         ======================================================== -->
    <section class="page-hero relative overflow-hidden" id="services-hero">
      <!-- Background Pemandangan Wisata dengan Perpaduan Merah Maroon Mewah -->
      <div class="page-hero-bg-container" aria-hidden="true">
        <picture>
          @php
            $servicesPageBg = !empty($settings['services_page_background_image']) 
              ? $settings['services_page_background_image'] 
              : ($settings['services_background_image'] ?? null);
          @endphp
          @if(!empty($servicesPageBg))
            <img src="{{ str_starts_with($servicesPageBg, 'http') ? $servicesPageBg : asset('storage/' . $servicesPageBg) }}" 
                 alt="Background Layanan Perjalanan Nirwana Tour" 
                 class="page-hero-bg-image" 
                 loading="eager" 
                 fetchpriority="high" 
                 decoding="async">
          @else
            <source srcset="{{ asset('assets/images/hero/prambanan-hero.webp') }}" type="image/webp">
            <img src="{{ asset('assets/images/hero/prambanan-hero.jpg') }}" 
                 alt="Background Wisata Indonesia Candi Prambanan Nirwana Tour" 
                 class="page-hero-bg-image" 
                 loading="eager" 
                 fetchpriority="high" 
                 decoding="async">
          @endif
        </picture>
        <div class="page-hero-maroon-overlay"></div>
        <div class="page-hero-ambient-overlay"></div>
        <div class="page-hero-dots-overlay"></div>
      </div>

      <div class="container page-hero-content relative z-10">
        <nav class="breadcrumb-nav" aria-label="Breadcrumb">
          <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> Beranda</a>
          <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
          <span class="current">Layanan Perjalanan</span>
        </nav>
        <h1 class="page-hero-title">Layanan Perjalanan Kami</h1>
        <p class="page-hero-desc">
          Solusi terpadu liburan keluarga, karya wisata sekolah, family gathering instansi, serta layanan sewa transportasi pariwisata profesional dengan standar keselamatan dan kenyamanan prima.
        </p>
      </div>
    </section>

    <!-- ========================================================
         SERVICES LIST SECTION
         ======================================================== -->
    <section class="section" id="layanan-utama">
      <div class="container">
        <div class="section-header text-center" style="max-width: 720px; margin: 0 auto 40px auto;">
          <h2 class="section-title">Pilihan Layanan Wisata & Acara</h2>
          <p class="section-subtitle">
            Kami menyediakan perencanaan perjalanan komprehensif mulai dari penyusunan jadwal itinerary, tiket masuk wisata, akomodasi hotel, konsumsi, hingga pemandu wisata bersertifikat.
          </p>
        </div>

        <div class="services-main-grid">
          @foreach($services as $service)
            <div class="service-card-premium">
              <div>
                <div class="service-icon-box">
                  <i class="{{ $service->icon }}"></i>
                </div>
                <h3 class="service-card-title">{{ $service->title }}</h3>
                <p class="service-card-desc">{{ $service->short_description }}</p>

                @if(!empty($service->features))
                  <ul class="service-feature-list">
                    @foreach($service->features as $feat)
                      <li class="service-feature-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ $feat }}</span>
                      </li>
                    @endforeach
                  </ul>
                @endif
              </div>

              <div class="service-card-actions">
                <a href="{{ route('services.show', $service->slug) }}" class="service-link-btn">
                  <span>Detail Lengkap</span>
                  <i class="fa-solid fa-arrow-right"></i>
                </a>
                @php
                  $cleanWa = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188');
                  $waMsg = rawurlencode("Halo Nirwana Tour, saya ingin konsultasi mengenai layanan: {$service->title}");
                @endphp
                <a href="https://wa.me/{{ $cleanWa }}?text={{ $waMsg }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="service-wa-btn"
                   title="Konsultasi via WhatsApp">
                  <i class="fa-brands fa-whatsapp"></i>
                  <span>Konsultasi</span>
                </a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- ========================================================
         PROCESS STEPS (ALUR PEMESANAN) SECTION
         ======================================================== -->
    <section class="section bg-alt" id="alur-layanan">
      <div class="container">
        <div class="section-header text-center" style="max-width: 720px; margin: 0 auto 35px auto;">
          <h2 class="section-title">Alur Pemesanan & Pelaksanaan Acara</h2>
          <p class="section-subtitle">
            Empat langkah praktis merencanakan kegiatan wisata dan acara rombongan Anda bersama tim Nirwana Tour Lampung.
          </p>
        </div>

        <div class="service-steps-grid">
          <div class="service-step-card">
            <div class="service-step-num">01</div>
            <h4 class="service-step-title">Konsultasi Kebutuhan</h4>
            <p class="service-step-desc">
              Sampaikan ide destinasi, estimasi peserta, durasi perjalanan, dan anggaran yang diinginkan kepada tim kami.
            </p>
          </div>

          <div class="service-step-card">
            <div class="service-step-num">02</div>
            <h4 class="service-step-title">Penyusunan Proposal</h4>
            <p class="service-step-desc">
              Kami menyusun rincian jadwal kegiatan (itinerary), pilihan fasilitas hotel, jenis armada, dan estimasi biaya transparan.
            </p>
          </div>

          <div class="service-step-card">
            <div class="service-step-num">03</div>
            <h4 class="service-step-title">Konfirmasi & Persiapan</h4>
            <p class="service-step-desc">
              Finalisasi tanggal, penandatanganan kesepakatan kerjasama, dan reservasi tiket destinasi serta unit armada resmi.
            </p>
          </div>

          <div class="service-step-card">
            <div class="service-step-num">04</div>
            <h4 class="service-step-title">Pelaksanaan Liburan</h4>
            <p class="service-step-desc">
              Berangkat dengan tenang didampingi tour leader berpengalaman dan kru profesional yang siap melayani rombongan Anda.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- ========================================================
         CTA BANNER SECTION
         ======================================================== -->
    <section class="section" style="padding-top: 0;">
      <div class="container">
        <div style="background: linear-gradient(135deg, #4A0012 0%, #800020 100%); border-radius: 24px; padding: 48px 40px; color: #FFFFFF; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 28px; box-shadow: 0 16px 36px rgba(128, 0, 32, 0.22);">
          <div style="max-width: 680px;">
            <h3 style="font-size: 1.55rem; font-weight: 800; color: #FFFFFF; margin: 0 0 10px 0;">
              Siap Mengadakan Acara Perjalanan Bersama Kami?
            </h3>
            <p style="margin: 0; font-size: 0.96rem; color: #FCE7EB; line-height: 1.65;">
              Dapatkan proposal penawaran khusus dan konsultasikan konsep kegiatan rombongan sekolah, instansi, maupun perusahaan Anda tanpa biaya konsultasi.
            </p>
          </div>
          <div style="display: flex; gap: 14px; flex-wrap: wrap;">
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg" style="background: #FFFFFF; color: var(--primary, #800020); border: none; font-weight: 700; white-space: nowrap;">
              Hubungi Kami Sekarang
            </a>
            @php
              $cleanWa = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188');
              $waGeneralMsg = rawurlencode("Halo Nirwana Tour, saya ingin konsultasi rencana kegiatan perjalanan rombongan.");
            @endphp
            <a href="https://wa.me/{{ $cleanWa }}?text={{ $waGeneralMsg }}"
               target="_blank"
               rel="noopener noreferrer"
               class="btn btn-lg"
               style="background: #25D366; color: #FFFFFF; border: none; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; white-space: nowrap;">
              <i class="fa-brands fa-whatsapp"></i>
              <span>Chat WhatsApp</span>
            </a>
          </div>
        </div>
      </div>
    </section>

  </main>
@endsection
