@extends('layouts.app')

@section('title', ($settings['site_name'] ?? 'Nirwana Tour Lampung') . ' - ' . ($settings['tagline'] ?? 'Biro Wisata, Paket Tour & Sewa Bus Terpercaya'))

@section('content')
  <main>
    <!-- ========================================================
         2. HERO SECTION
         ======================================================== -->
    <section class="hero-section relative min-h-[92vh] flex items-center pt-32 pb-24 overflow-hidden bg-white" id="hero">
      <!-- Background Pemandangan Wisata dengan Perpaduan Gradasi Putih Elegan -->
      <div class="hero-bg-container" aria-hidden="true">
        <picture>
          @if(!empty($settings['hero_background_image']))
            <img src="{{ str_starts_with($settings['hero_background_image'], 'http') ? $settings['hero_background_image'] : asset('storage/' . $settings['hero_background_image']) }}" 
                 alt="Pemandangan Wisata Nirwana Tour" 
                 class="hero-bg-image" 
                 fetchpriority="high">
          @else
            <source srcset="{{ asset('assets/images/hero/candi-hero.webp') }}" type="image/webp">
            <img src="{{ asset('assets/images/hero/candi-hero.jpg') }}" 
                 alt="Pemandangan Candi Wisata Budaya Indonesia Nirwana Tour" 
                 class="hero-bg-image" 
                 fetchpriority="high">
          @endif
        </picture>
        <!-- Layer 1: Horizontal White Fusion Gradient -->
        <div class="hero-white-gradient"></div>
        <!-- Layer 2: Vertical Soft Fade -->
        <div class="hero-white-vertical-fade"></div>
        <!-- Layer 3: Pola Dot Elegan -->
        <div class="hero-dots-pattern"></div>
      </div>

      <div class="container hero-container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 items-center gap-10 lg:gap-14 relative z-10">
        <div class="hero-content max-w-2xl">
          <div class="hero-badge inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-[#800020]/10 text-[#800020] border border-[#800020]/20 mb-5 tracking-wide uppercase">
            {{ $settings['hero_badge'] ?? 'Biro Perjalanan Wisata Resmi Lampung' }}
          </div>
          <h1 class="hero-title text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight mb-5">
            {{ $settings['hero_title'] ?? 'Selamat Datang di Website Nirwana Tour and Travel Lampung' }}
          </h1>
          <p class="hero-description text-base sm:text-lg text-slate-600 leading-relaxed mb-8">
            {{ $settings['hero_subtitle'] ?? 'Wujudkan momen liburan terbaik Anda bersama Nirwana Tour Lampung. Kami menghadirkan paket wisata eksotis, study tour edukatif, gathering perusahaan, serta persewaan armada transportasi nyaman dan profesional.' }}
          </p>
          <div class="hero-buttons flex flex-wrap items-center gap-4 mb-10">
            <a href="#" class="btn btn-whatsapp btn-lg wa-link-btn inline-flex items-center gap-2.5 px-6 py-3.5 rounded-xl text-white font-bold bg-[#25D366] hover:bg-[#1EBE5D] shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5" data-wa-msg="Halo Nirwana Tour, saya ingin konsultasi perjalanan wisata.">
              <i class="fa-brands fa-whatsapp text-xl"></i> {{ $settings['hero_cta_wa_text'] ?? 'Konsultasi via WhatsApp' }}
            </a>
            <a href="#destinasi" class="btn btn-outline btn-lg inline-flex items-center gap-2.5 px-6 py-3.5 rounded-xl font-bold border-2 border-[#800020] text-[#800020] hover:bg-[#800020] hover:text-white transition-all duration-200 transform hover:-translate-y-0.5">
              <i class="fa-solid fa-map-location-dot"></i> {{ $settings['hero_cta_dest_text'] ?? 'Lihat Destinasi' }}
            </a>
          </div>

          <!-- Hero Highlights / Mini Badges -->
          <div class="hero-features grid grid-cols-1 sm:grid-cols-3 gap-4 pt-6 border-t border-slate-200/80">
            <div class="hero-feature-item flex items-center gap-2.5 text-xs sm:text-sm font-semibold text-slate-700">
              <i class="fa-solid fa-shield-halved text-[#800020] text-base"></i>
              <span>{{ $settings['hero_feature_1'] ?? 'Legalitas Berizin Resmi' }}</span>
            </div>
            <div class="hero-feature-item flex items-center gap-2.5 text-xs sm:text-sm font-semibold text-slate-700">
              <i class="fa-solid fa-bus-simple text-[#800020] text-base"></i>
              <span>{{ $settings['hero_feature_2'] ?? 'Armada Bus Nyaman & Terawat' }}</span>
            </div>
            <div class="hero-feature-item flex items-center gap-2.5 text-xs sm:text-sm font-semibold text-slate-700">
              <i class="fa-solid fa-user-tie text-[#800020] text-base"></i>
              <span>{{ $settings['hero_feature_3'] ?? 'Tour Leader Berpengalaman' }}</span>
            </div>
          </div>
        </div>

        <!-- Hero Visual (Transparent Cutout) -->
        <div class="hero-visual flex justify-center items-center">
          <div class="hero-image-wrapper relative max-w-lg lg:max-w-none">
            <picture>
              <source srcset="{{ asset('assets/images/hero-right.webp') }}" type="image/webp">
              <img src="{{ asset('assets/images/hero-right.png') }}" alt="Armada Wisata Nirwana Tour Lampung" class="hero-image-cutout w-full h-auto object-contain drop-shadow-2xl" fetchpriority="high">
            </picture>
          </div>
        </div>
      </div>

      <!-- Wave Separator -->
      <div class="hero-wave">
        <svg viewBox="0 0 1440 120" fill="none" preserveAspectRatio="none">
          <path d="M0,32L60,42.7C120,53,240,75,360,74.7C480,75,600,53,720,48C840,43,960,53,1080,64C1200,75,1320,85,1380,90.7L1440,96L1440,120L1380,120C1320,120,1200,120,1080,120C960,120,840,120,720,120C600,120,480,120,360,120C240,120,120,120,60,120L0,120Z" fill="#800020"></path>
        </svg>
      </div>
    </section>

    <!-- ========================================================
         2.5 MITRA & KLIEN REKANAN (DUAL RUNNING MARQUEE)
         ======================================================== -->
    <section class="mitra-section" id="mitra" aria-label="Mitra & Instansi Rekanan Nirwana Tour Lampung">
      <div class="container mitra-container">
        <!-- Kolom Kiri: Label & Heading Mitra -->
        <div class="mitra-info-col">
          <h3 class="mitra-heading">Dipercaya Berbagai Instansi & Perusahaan</h3>
          <p class="mitra-desc">
            Pilihan utama study tour sekolah, perjalanan dinas kantor, family gathering BUMN, dan rombongan di Lampung.
          </p>
        </div>

        <!-- Kolom Kanan: 2 Running Marquee Ticker (Atas & Bawah) -->
        <div class="mitra-marquee-col" title="Sorot kursor untuk menjeda putaran">
          @php
            $halfCount = max(1, (int) ceil($partners->count() / 2));
            $partnersRow1 = $partners->slice(0, $halfCount);
            $partnersRow2 = $partners->slice($halfCount);
            if ($partnersRow2->isEmpty()) {
                $partnersRow2 = $partnersRow1;
            }
          @endphp

          <!-- ================= BARIS 1 (ATAS) ================= -->
          <div class="mitra-marquee-wrap">
            <div class="mitra-track track-left">
              @foreach($partnersRow1 as $partner)
                <div class="mitra-card">
                  <div class="mitra-logo-wrap">
                    @if($partner->logo)
                      <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" loading="lazy" decoding="async" style="max-height: 28px; max-width: 34px; object-fit: contain;">
                    @else
                      <div style="width: 36px; height: 36px; border-radius: 8px; background: linear-gradient(135deg, #800020, #991B1B); color: #FFF; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.82rem;">
                        {{ strtoupper(substr($partner->name, 0, 2)) }}
                      </div>
                    @endif
                  </div>
                  <div class="mitra-meta">
                    <span class="mitra-name">{{ $partner->name }}</span>
                    <span class="mitra-sub">{{ $partner->category ?? 'Mitra Rekanan' }}</span>
                  </div>
                </div>
              @endforeach

              {{-- Clone untuk Infinite Marquee --}}
              @foreach($partnersRow1 as $partner)
                <div class="mitra-card" aria-hidden="true">
                  <div class="mitra-logo-wrap">
                    @if($partner->logo)
                      <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" loading="lazy" decoding="async" style="max-height: 28px; max-width: 34px; object-fit: contain;">
                    @else
                      <div style="width: 36px; height: 36px; border-radius: 8px; background: linear-gradient(135deg, #800020, #991B1B); color: #FFF; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.82rem;">
                        {{ strtoupper(substr($partner->name, 0, 2)) }}
                      </div>
                    @endif
                  </div>
                  <div class="mitra-meta">
                    <span class="mitra-name">{{ $partner->name }}</span>
                    <span class="mitra-sub">{{ $partner->category ?? 'Mitra Rekanan' }}</span>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

          <!-- ================= BARIS 2 (DIBAWAHNYA) ================= -->
          <div class="mitra-marquee-wrap">
            <div class="mitra-track track-right">
              @foreach($partnersRow2 as $partner)
                <div class="mitra-card">
                  <div class="mitra-logo-wrap">
                    @if($partner->logo)
                      <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" loading="lazy" decoding="async" style="max-height: 28px; max-width: 34px; object-fit: contain;">
                    @else
                      <div style="width: 36px; height: 36px; border-radius: 8px; background: linear-gradient(135deg, #0F172A, #1E293B); color: #F59E0B; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.82rem;">
                        {{ strtoupper(substr($partner->name, 0, 2)) }}
                      </div>
                    @endif
                  </div>
                  <div class="mitra-meta">
                    <span class="mitra-name">{{ $partner->name }}</span>
                    <span class="mitra-sub">{{ $partner->category ?? 'Mitra Rekanan' }}</span>
                  </div>
                </div>
              @endforeach

              {{-- Clone untuk Infinite Marquee --}}
              @foreach($partnersRow2 as $partner)
                <div class="mitra-card" aria-hidden="true">
                  <div class="mitra-logo-wrap">
                    @if($partner->logo)
                      <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" loading="lazy" decoding="async" style="max-height: 28px; max-width: 34px; object-fit: contain;">
                    @else
                      <div style="width: 36px; height: 36px; border-radius: 8px; background: linear-gradient(135deg, #0F172A, #1E293B); color: #F59E0B; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.82rem;">
                        {{ strtoupper(substr($partner->name, 0, 2)) }}
                      </div>
                    @endif
                  </div>
                  <div class="mitra-meta">
                    <span class="mitra-name">{{ $partner->name }}</span>
                    <span class="mitra-sub">{{ $partner->category ?? 'Mitra Rekanan' }}</span>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ========================================================
         3. PROFIL PERUSAHAAN & SAMBUTAN PEMILIK
         ======================================================== -->
    <section class="section about-section" id="tentang">
      <div class="container">
        <div class="about-grid">
          
          <!-- Sisi Kiri: Foto & Sambutan Hangat Pemilik Nirwana -->
          <div class="about-owner-showcase">
            <div class="owner-card">
              
              <!-- Frame Foto Pemilik -->
              <div class="owner-photo-frame">
                <picture>
                  @if(!empty($settings['owner_photo']))
                    <img src="{{ storage_or_asset($settings['owner_photo']) }}" alt="{{ $settings['owner_role'] ?? 'Pimpinan & Founder' }} - {{ $settings['owner_name'] ?? 'Kiki M Alfin' }}" class="owner-photo owner-photo-custom" loading="lazy" decoding="async">
                  @else
                    <source srcset="{{ asset('assets/images/pemilik-nirwana.webp') }}" type="image/webp">
                    <img src="{{ asset('assets/images/pemilik-nirwana.JPG') }}" alt="{{ $settings['owner_role'] ?? 'Pimpinan & Founder Nirwana Tour Lampung' }} - {{ $settings['owner_name'] ?? 'Kiki M Alfin' }}" class="owner-photo" loading="lazy" decoding="async">
                  @endif
                </picture>
                <div class="owner-photo-overlay"></div>
              </div>

              <!-- Box Sambutan Pemilik -->
              <div class="owner-speech-box">
                <div class="speech-header">
                  <div class="speech-quote-icon">
                    <i class="fa-solid fa-quote-left"></i>
                  </div>
                  <div class="speech-title-wrap">
                    <span class="speech-tag">Sambutan Hangat</span>
                    <h4 class="speech-title">Dari Pemilik Nirwana Tour</h4>
                  </div>
                </div>

                <blockquote class="owner-quote-body">
                  "{{ $settings['owner_quote'] ?? 'Selamat datang di Nirwana Tour Lampung. Bagi kami, setiap perjalanan bukan sekadar mengantar Anda ke destinasi, melainkan sebuah amanah untuk menghadirkan rasa aman, kenyamanan prima, dan kenangan indah yang abadi bersama orang-orang tercinta.' }}"
                </blockquote>

                <div class="owner-profile-footer">
                  <div class="owner-details">
                    <strong class="owner-name">{{ $settings['owner_name'] ?? 'Kiki M Alfin' }}</strong>
                    <span class="owner-role">{{ $settings['owner_role'] ?? 'Pimpinan & Founder - Nirwana Tour Lampung • Sejak 2016' }}</span>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <!-- Sisi Kanan: Konten Profil Perusahaan -->
          <div class="about-content">
            <div class="section-tag">Profil Perusahaan</div>
            <h2 class="section-title">Biro Perjalanan Wisata Terpercaya di Lampung</h2>
            
            <p class="about-lead">
              {{ $settings['about_company'] ?? 'Nirwana Tour Lampung adalah biro perjalanan wisata berizin resmi (TDUP & NIB) yang telah berpengalaman mendampingi ribuan wisatawan mengeksplorasi keindahan alam dan budaya Indonesia dengan pelayanan standar V.I.P yang aman, nyaman, dan berkesan.' }}
            </p>
            <p class="about-desc">
              {{ $settings['about_description'] ?? 'Dengan pengalaman lebih dari 8 tahun, kami telah melayani ribuan pelanggan mulai dari keluarga, sekolah, universitas, instansi pemerintahan, hingga BUMN & perusahaan swasta nasional. Setiap rencana perjalanan kami susun secara terstruktur dengan pemandu berlisensi dan armada transportasi pariwisata terawat.' }}
            </p>

            <!-- Highlights / Mini Stats Bar -->
            <div class="about-mini-stats">
              <div class="mini-stat">
                <span class="mini-stat-num" data-counter-target="{{ $settings['stat_years_count'] ?? '8' }}" data-counter-suffix="+">{{ $settings['stat_years_count'] ?? '8' }}+</span>
                <span class="mini-stat-lbl">{{ $settings['stat_years_label'] ?? 'Tahun Pengalaman' }}</span>
              </div>
              <div class="mini-stat-sep"></div>
              <div class="mini-stat">
                <span class="mini-stat-num" data-counter-target="{{ $settings['stat_trips_count'] ?? '1500' }}" data-counter-suffix="+" data-counter-dot="true">{{ number_format((int)($settings['stat_trips_count'] ?? 1500), 0, ',', '.') }}+</span>
                <span class="mini-stat-lbl">{{ $settings['stat_trips_label'] ?? 'Trip Terlaksana' }}</span>
              </div>
              <div class="mini-stat-sep"></div>
              <div class="mini-stat">
                <span class="mini-stat-num" data-counter-target="{{ $settings['stat_satisfaction_count'] ?? '99' }}" data-counter-suffix="%">{{ $settings['stat_satisfaction_count'] ?? '99' }}%</span>
                <span class="mini-stat-lbl">{{ $settings['stat_satisfaction_label'] ?? 'Kepuasan Pelanggan' }}</span>
              </div>
              <div class="mini-stat-sep"></div>
              <div class="mini-stat">
                <span class="mini-stat-num" data-counter-target="{{ $settings['stat_legal_count'] ?? '100' }}" data-counter-suffix="%">{{ $settings['stat_legal_count'] ?? '100' }}%</span>
                <span class="mini-stat-lbl">{{ $settings['stat_legal_label'] ?? 'Legalitas Resmi' }}</span>
              </div>
            </div>

            <!-- Logo Sertifikasi, Asosiasi & Kemitraan Resmi -->
            <div class="about-cert-logos">
              <span class="cert-logos-label">
                <i class="fa-solid fa-shield-halved"></i> Sertifikasi & Asosiasi Resmi
              </span>
              <div class="cert-logos-row">
                <div class="cert-logo-item" title="Nirwana Tour Lampung - Biro Perjalanan Wisata Resmi">
                  <img src="{{ asset('assets/logo/Logo-Nirwana.png') }}" alt="Logo Nirwana Tour Lampung" class="cert-logo-img" loading="lazy" decoding="async">
                </div>
                <div class="cert-logo-item" title="ASITA (Association of The Indonesian Tours and Travel Agencies)">
                  <img src="{{ asset('assets/images/asita.png') }}" alt="Logo ASITA Indonesia" class="cert-logo-img" loading="lazy" decoding="async">
                </div>
                <div class="cert-logo-item" title="Wonderful Indonesia - Kementerian Pariwisata RI">
                  <img src="{{ asset('assets/images/wonderful.png') }}" alt="Logo Wonderful Indonesia" class="cert-logo-img" loading="lazy" decoding="async">
                </div>
                <div class="cert-logo-item" title="Pariwisata Provinsi Lampung - The Treasure of Sumatra">
                  <img src="{{ asset('assets/images/lampung.png') }}" alt="Logo Pariwisata Lampung" class="cert-logo-img" loading="lazy" decoding="async">
                </div>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="about-cta-row">
              <a href="{{ route('profile') }}" class="btn btn-primary">
                <i class="fa-solid fa-circle-info"></i> Selengkapnya Tentang Kami
              </a>
              <a href="#" class="btn btn-outline wa-link-btn" data-wa-msg="Halo Pimpinan Nirwana Tour, saya ingin konsultasi paket perjalanan wisata.">
                <i class="fa-brands fa-whatsapp"></i> Konsultasi via WhatsApp
              </a>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ========================================================
         4. LAYANAN SECTION (DINAMIS DARI DATABASE)
         ======================================================== -->
    <section class="section services-section relative overflow-hidden" id="layanan">
      <!-- Background Pemandangan Wisata dengan Perpaduan Merah Maroon Mewah -->
      <div class="services-bg-container" aria-hidden="true">
        <picture>
          @if(!empty($settings['services_background_image']))
            <img src="{{ str_starts_with($settings['services_background_image'], 'http') ? $settings['services_background_image'] : asset('storage/' . $settings['services_background_image']) }}" 
                 alt="Background Layanan Wisata Nirwana Tour" 
                 class="services-bg-image" 
                 loading="lazy" 
                 decoding="async">
          @else
            <source srcset="{{ asset('assets/images/hero/dieng-hero.webp') }}" type="image/webp">
            <img src="{{ asset('assets/images/hero/dieng-hero.jpg') }}" 
                 alt="Background Layanan Wisata Nirwana Tour" 
                 class="services-bg-image" 
                 loading="lazy" 
                 decoding="async">
          @endif
        </picture>
        <div class="services-maroon-overlay"></div>
        <div class="services-ambient-overlay"></div>
        <div class="services-dots-overlay"></div>
      </div>

      <div class="container relative z-10">
        <div class="section-header text-center">
          <div class="section-tag inline-block">Solusi Perjalanan Lengkap</div>
          <h2 class="section-title">Layanan Terbaik Nirwana Tour Lampung</h2>
          <p class="section-subtitle">Pilihan komprehensif untuk liburan keluarga, kegiatan pendidikan, gathering kantor, hingga sewa transportasi VIP.</p>
        </div>

        <div class="services-grid">
          @forelse($services as $index => $service)
            @php
              $accents = ['accent-burgundy', 'accent-emerald', 'accent-amber', 'accent-rose'];
              $accentClass = $accents[$index % count($accents)];
              $defaultIcons = ['fa-umbrella-beach', 'fa-graduation-cap', 'fa-people-roof', 'fa-van-shuttle'];
              $iconClass = $service->icon ?: ($defaultIcons[$index % count($defaultIcons)] ?? 'fa-compass');
            @endphp
            <div class="service-card">
              <div class="service-card-top">
                <div class="service-icon-box {{ $accentClass }}">
                  <i class="fa-solid {{ $iconClass }}"></i>
                </div>
                <span class="service-chip">Layanan Unggulan</span>
              </div>
              <h3 class="service-title">
                <a href="{{ route('services.show', $service->slug) }}" style="color: inherit; text-decoration: none;">{{ $service->title }}</a>
              </h3>
              <p class="service-desc">
                {{ Str::limit($service->short_description, 140) }}
              </p>
              @if(!empty($service->features) && is_array($service->features))
                <ul class="service-perks">
                  @foreach(array_slice($service->features, 0, 4) as $perk)
                    <li><i class="fa-solid fa-check"></i> {{ $perk }}</li>
                  @endforeach
                </ul>
              @endif
              <div class="service-action">
                <a href="{{ route('services.show', $service->slug) }}" class="btn btn-service-detail" title="Rincian Layanan {{ $service->title }}">
                  <i class="fa-solid fa-circle-info"></i>
                  <span class="btn-text">
                    <span class="btn-lbl-desktop">Rincian Layanan</span>
                    <span class="btn-lbl-mobile">Detail</span>
                  </span>
                </a>
                <a href="#" class="btn btn-service-wa wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya tertarik dengan layanan {{ $service->title }}." title="Pesan Layanan {{ $service->title }}">
                  <i class="fa-brands fa-whatsapp"></i>
                  <span class="btn-text">
                    <span class="btn-lbl-desktop">Pesan Layanan</span>
                    <span class="btn-lbl-mobile">Pesan</span>
                  </span>
                </a>
              </div>
            </div>
          @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px 20px; background: #FFF; border-radius: 12px; border: 1px solid var(--border-light);">
              <p style="color: #64748b;">Belum ada data layanan aktif saat ini.</p>
            </div>
          @endforelse
        </div>
      </div>
    </section>

    <!-- ========================================================
         5. DESTINASI WISATA SECTION (DINAMIS DARI DATABASE)
         ======================================================== -->
    <section class="section destination-section" id="destinasi">
      <div class="container">
        <div class="section-header text-center">
          <div class="section-tag">Inspirasi Wisata Favorit</div>
          <h2 class="section-title">Destinasi Populer Pilihan Terbaik</h2>
          <p class="section-subtitle">Temukan pesona alam eksotis Lampung hingga destinasi favorit Jawa dan Nusantara bersama biro perjalanan berizin resmi.</p>
        </div>

        <div class="destinations-grid" id="destGrid">
          @forelse($featuredPackages as $pkg)
            @php
              $categorySlug = $pkg->category ? Str::slug($pkg->category->name) : 'lampung';
            @endphp
            <article class="dest-card" data-category="{{ $categorySlug }}" data-id="{{ $pkg->slug }}">
              <div class="dest-thumb">
                <a href="{{ route('packages.show', $pkg->slug) }}" style="display: block; width: 100%; height: 100%;">
                  <img src="{{ $pkg->thumbnail_url }}" alt="{{ $pkg->title }}" loading="lazy" decoding="async">
                </a>
                <span class="dest-category"><i class="fa-solid fa-map-pin"></i> {{ $pkg->category->name ?? 'Wisata Populer' }}</span>
                @if($pkg->badge)
                  <span class="dest-badge-rec">{{ $pkg->badge }}</span>
                @endif
              </div>
              <div class="dest-body">
                <div class="dest-meta">
                  <span><i class="fa-solid fa-location-dot"></i> {{ $pkg->destination_location ?? 'Lampung' }}</span>
                  <span><i class="fa-solid fa-clock"></i> {{ $pkg->duration_label }}</span>
                </div>
                <h3 class="dest-title">
                  <a href="{{ route('packages.show', $pkg->slug) }}" style="color: inherit; text-decoration: none;">{{ $pkg->title }}</a>
                </h3>
                <p class="dest-desc">
                  {{ Str::limit($pkg->summary, 135) }}
                </p>
                @if(!empty($pkg->includes) && is_array($pkg->includes))
                  <div class="dest-highlights">
                    @foreach(array_slice($pkg->includes, 0, 3) as $includeItem)
                      <span><i class="fa-solid fa-check-circle"></i> {{ Str::limit($includeItem, 32) }}</span>
                    @endforeach
                  </div>
                @endif
                <div class="dest-footer">
                  <div class="dest-pricing">
                    <span class="label">Mulai dari</span>
                    <span class="price">{{ $pkg->formatted_price }} <small>/ pax</small></span>
                  </div>
                  <div class="dest-action-group">
                    <a href="{{ route('packages.show', $pkg->slug) }}" class="btn btn-outline btn-sm" aria-label="Lihat Rundown Paket {{ $pkg->title }}">
                      <i class="fa-solid fa-list-check"></i> Detail & Rundown
                    </a>
                    <a href="#" class="btn btn-primary btn-sm wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin info paket wisata ke {{ $pkg->title }}.">
                      <i class="fa-brands fa-whatsapp"></i> Tanya Paket
                    </a>
                  </div>
                </div>
              </div>
            </article>
          @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px 20px; background: #FFF; border-radius: 12px; border: 1px solid var(--border-light);">
              <p style="color: #64748b;">Belum ada paket wisata aktif yang ditampilkan di beranda.</p>
            </div>
          @endforelse
        </div>

        <!-- Tombol Aksi Lihat Destinasi Lainnya -->
        <div class="dest-more-wrapper">
          <a href="{{ route('packages.index') }}" class="btn btn-outline btn-lg">
            <span>Lihat Destinasi Lainnya</span>
            <i class="fa-solid fa-arrow-right"></i>
          </a>
          <p class="dest-more-note">
            Punya rencana destinasi khusus lainnya? 
            <a href="#" class="wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin konsultasi paket wisata custom ke destinasi khusus.">
              Konsultasi Custom Trip via WhatsApp <i class="fa-solid fa-arrow-right"></i>
            </a>
          </p>
        </div>
      </div>
    </section>

    <!-- ========================================================
         6. KEUNGGULAN SECTION
         ======================================================== -->
    <section class="section reasons-section relative overflow-hidden" id="keunggulan">
      <!-- Background Pemandangan Candi / Wisata dengan Perpaduan Merah Maroon Mewah -->
      <div class="reasons-bg-container" aria-hidden="true">
        <picture>
          @if(!empty($settings['reasons_background_image']))
            <img src="{{ str_starts_with($settings['reasons_background_image'], 'http') ? $settings['reasons_background_image'] : asset('storage/' . $settings['reasons_background_image']) }}" 
                 alt="Background Keunggulan Nirwana Tour" 
                 class="reasons-bg-image" 
                 loading="lazy" 
                 decoding="async">
          @else
            <source srcset="{{ asset('assets/images/hero/prambanan-hero.webp') }}" type="image/webp">
            <img src="{{ asset('assets/images/hero/prambanan-hero.jpg') }}" 
                 alt="Background Keunggulan Candi Prambanan Nirwana Tour" 
                 class="reasons-bg-image" 
                 loading="lazy" 
                 decoding="async">
          @endif
        </picture>
        <div class="reasons-maroon-overlay"></div>
        <div class="reasons-ambient-overlay"></div>
        <div class="reasons-dots-overlay"></div>
      </div>

      <div class="container relative z-10">
        <div class="section-header text-center">
          <div class="section-tag inline-block">Mengapa Memilih Kami</div>
          <h2 class="section-title text-white">Keunggulan Nirwana Tour Lampung</h2>
          <p class="section-subtitle text-[#FCE7EB]">Komitmen kami dalam memberikan standar mutu perjalanan tertinggi tanpa kompromi.</p>
        </div>
      </div>

      <!-- Marquee Keunggulan Berjalan Sejajar ke Kanan -->
      <div class="reasons-marquee-wrap relative z-10" title="Sorot kursor untuk menjeda putaran">
        <div class="reasons-track">
          <!-- ================= SET 1 ================= -->
          <div class="reason-card">
            <div class="reason-icon">
              <i class="fa-solid fa-certificate"></i>
            </div>
            <h3 class="reason-title">Biro Resmi & Legalitas Terjamin</h3>
            <p class="reason-desc">
              Perusahaan resmi berbadan hukum dengan izin usaha pariwisata lengkap. Menjamin transaksi aman dan kepastian jadwal keberangkatan tanpa rasa was-was.
            </p>
          </div>

          <div class="reason-card">
            <div class="reason-icon">
              <i class="fa-solid fa-user-shield"></i>
            </div>
            <h3 class="reason-title">Tour Leader & Kru Bersertifikat</h3>
            <p class="reason-desc">
              Dipandu oleh tim lokal yang ramah, berlisensi, menguasai medan, sigap membantu kebutuhan rombongan, serta dibekali pelatihan pertolongan pertama (P3K).
            </p>
          </div>

          <div class="reason-card">
            <div class="reason-icon">
              <i class="fa-solid fa-bus"></i>
            </div>
            <h3 class="reason-title">Armada Nyaman & Terawat Prima</h3>
            <p class="reason-desc">
              Kendaraan HiAce dan bus pariwisata keluaran terbaru dengan fasilitas AC dingin, reclining seat, audio video karaoke, charger port, serta uji kelaikan berkala.
            </p>
          </div>

          <div class="reason-card">
            <div class="reason-icon">
              <i class="fa-solid fa-sliders"></i>
            </div>
            <h3 class="reason-title">Itinerary Fleksibel & Custom</h3>
            <p class="reason-desc">
              Jadwal perjalanan dapat disesuaikan sepenuhnya dengan preferensi destinasi, waktu, dan batas anggaran kelompok kerja, sekolah, maupun keluarga Anda.
            </p>
          </div>

          <div class="reason-card">
            <div class="reason-icon">
              <i class="fa-solid fa-camera-retro"></i>
            </div>
            <h3 class="reason-title">Dokumentasi Menarik & Berkualitas</h3>
            <p class="reason-desc">
              Kami sediakan fasilitas dokumentasi kamera DSLR, mirrorless, GoPro underwater, hingga drone (paket tertentu) agar memori liburan Anda tersimpan abadi.
            </p>
          </div>

          <div class="reason-card">
            <div class="reason-icon">
              <i class="fa-solid fa-headset"></i>
            </div>
            <h3 class="reason-title">Konsultasi Responsif & Cepat 24/7</h3>
            <p class="reason-desc">
              Admin kami selalu siap melayani pertanyaan, permintaan penawaran proposal, dan reservasi dadakan via WhatsApp dengan respons cepat dan ramah.
            </p>
          </div>

          <!-- ================= SET 2 (CLONE FOR INFINITE MARQUEE) ================= -->
          <div class="reason-card" aria-hidden="true">
            <div class="reason-icon">
              <i class="fa-solid fa-certificate"></i>
            </div>
            <h3 class="reason-title">Biro Resmi & Legalitas Terjamin</h3>
            <p class="reason-desc">
              Perusahaan resmi berbadan hukum dengan izin usaha pariwisata lengkap. Menjamin transaksi aman dan kepastian jadwal keberangkatan tanpa rasa was-was.
            </p>
          </div>

          <div class="reason-card" aria-hidden="true">
            <div class="reason-icon">
              <i class="fa-solid fa-user-shield"></i>
            </div>
            <h3 class="reason-title">Tour Leader & Kru Bersertifikat</h3>
            <p class="reason-desc">
              Dipandu oleh tim lokal yang ramah, berlisensi, menguasai medan, sigap membantu kebutuhan rombongan, serta dibekali pelatihan pertolongan pertama (P3K).
            </p>
          </div>

          <div class="reason-card" aria-hidden="true">
            <div class="reason-icon">
              <i class="fa-solid fa-bus"></i>
            </div>
            <h3 class="reason-title">Armada Nyaman & Terawat Prima</h3>
            <p class="reason-desc">
              Kendaraan HiAce dan bus pariwisata keluaran terbaru dengan fasilitas AC dingin, reclining seat, audio video karaoke, charger port, serta uji kelaikan berkala.
            </p>
          </div>

          <div class="reason-card" aria-hidden="true">
            <div class="reason-icon">
              <i class="fa-solid fa-sliders"></i>
            </div>
            <h3 class="reason-title">Itinerary Fleksibel & Custom</h3>
            <p class="reason-desc">
              Jadwal perjalanan dapat disesuaikan sepenuhnya dengan preferensi destinasi, waktu, dan batas anggaran kelompok kerja, sekolah, maupun keluarga Anda.
            </p>
          </div>

          <div class="reason-card" aria-hidden="true">
            <div class="reason-icon">
              <i class="fa-solid fa-camera-retro"></i>
            </div>
            <h3 class="reason-title">Dokumentasi Menarik & Berkualitas</h3>
            <p class="reason-desc">
              Kami sediakan fasilitas dokumentasi kamera DSLR, mirrorless, GoPro underwater, hingga drone (paket tertentu) agar memori liburan Anda tersimpan abadi.
            </p>
          </div>

          <div class="reason-card" aria-hidden="true">
            <div class="reason-icon">
              <i class="fa-solid fa-headset"></i>
            </div>
            <h3 class="reason-title">Konsultasi Responsif & Cepat 24/7</h3>
            <p class="reason-desc">
              Admin kami selalu siap melayani pertanyaan, permintaan penawaran proposal, dan reservasi dadakan via WhatsApp dengan respons cepat dan ramah.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- ========================================================
         7. GALERI VIDEO KEGIATAN SECTION (DINAMIS DARI DATABASE)
         ======================================================== -->
    <section class="section gallery-section" id="galeri">
      <div class="container">
        <div class="section-header text-center">
          <div class="section-tag">Video Dokumentasi Nyata</div>
          <h2 class="section-title">Galeri Video & Momen Keseruan Tour</h2>
          <p class="section-subtitle">Saksikan langsung cuplikan video keceriaan dan kehangatan rombongan wisatawan saat menjelajahi ragam destinasi impian bersama Nirwana Tour Lampung.</p>
        </div>

        <!-- Video Marquee Auto-Scroll ke Kiri (Video Berjalan Seamless) -->
        <div class="video-marquee-wrapper" id="videoMarqueeWrapper">
          <div class="video-marquee-track">
            
            <!-- Group 1: Video Cards Dinamis -->
            <div class="video-marquee-group">
              @forelse($galleryVideos as $video)
                <article class="video-card">
                  <div class="video-player-wrapper">
                    @if($video->is_instagram)
                      <div class="instagram-reel-frame" style="width: 100%; aspect-ratio: 9/16; background: #000; border-radius: 12px; overflow: hidden; position: relative;">
                        <iframe src="{{ $video->instagram_embed_url }}"
                                style="width: 100%; height: 100%; border: 0;"
                                allowtransparency="true"
                                allowfullscreen="true"
                                loading="lazy"
                                title="{{ $video->title }}">
                        </iframe>
                      </div>
                    @elseif($video->media_type === 'image')
                      <div style="width: 100%; aspect-ratio: 9/16; background: #000; border-radius: 12px; overflow: hidden; position: relative;">
                        <img src="{{ $video->file_url }}" alt="{{ $video->title }}" style="width: 100%; height: 100%; object-fit: cover; display: block;" loading="lazy">
                      </div>
                    @else
                      <video class="gallery-video" controls playsinline preload="metadata"@if($video->thumbnail) poster="{{ $video->thumbnail_url }}"@endif>
                        <source src="{{ $video->file_url }}" type="video/mp4">
                        Browser Anda tidak mendukung pemutar video HTML5.
                      </video>
                    @endif
                  </div>
                  <div class="video-card-body">
                    <span class="video-tag">{{ $video->caption ?? 'Dokumentasi Tour' }}</span>
                    <h3 class="video-title">{{ $video->title }}</h3>
                    <p class="video-desc">Momen autentik keceriaan rombongan saat menikmati perjalanan wisata bersama Nirwana Tour Lampung.</p>
                    @if($video->is_instagram)
                      <a href="{{ $video->file_url }}" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; font-size: 0.78rem; font-weight: 700; color: #E1306C; margin-top: 6px; text-decoration: none;">
                        <i class="fa-brands fa-instagram"></i> Tonton di Instagram
                      </a>
                    @endif
                  </div>
                </article>
              @empty
                <article class="video-card">
                  <div class="video-player-wrapper">
                    <div style="width: 100%; aspect-ratio: 9/16; background: #0f172a; border-radius: 12px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 24px; color: #fff;">
                      <i class="fa-brands fa-instagram" style="font-size: 3rem; color: #E1306C; margin-bottom: 12px;"></i>
                      <p style="font-size: 0.88rem; font-weight: 700; margin-bottom: 6px;">Instagram Reels</p>
                      <p style="font-size: 0.75rem; color: #94a3b8; margin-bottom: 14px;">Tonton video keseruan tour terbaru di Instagram kami.</p>
                      <a href="{{ $settings['instagram'] ?? 'https://www.instagram.com/nirwana_tourlampung/' }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm" style="font-size: 0.75rem; padding: 6px 14px;">
                        <i class="fa-brands fa-instagram"></i> Buka Profil
                      </a>
                    </div>
                  </div>
                  <div class="video-card-body">
                    <span class="video-tag">Instagram Video</span>
                    <h3 class="video-title">Keseruan Eksplorasi Wisata Nirwana Tour</h3>
                    <p class="video-desc">Momen autentik keceriaan rombongan saat menikmati perjalanan wisata bersama Nirwana Tour Lampung.</p>
                  </div>
                </article>
              @endforelse
            </div>

            <!-- Group 2: Duplikasi Video Cards untuk Seamless Infinite Loop -->
            <div class="video-marquee-group" aria-hidden="true">
              @forelse($galleryVideos as $video)
                <article class="video-card">
                  <div class="video-player-wrapper">
                    @if($video->is_instagram)
                      <div class="instagram-reel-frame" style="width: 100%; aspect-ratio: 9/16; background: #000; border-radius: 12px; overflow: hidden; position: relative;">
                        <iframe src="{{ $video->instagram_embed_url }}"
                                style="width: 100%; height: 100%; border: 0;"
                                allowtransparency="true"
                                allowfullscreen="true"
                                loading="lazy"
                                title="{{ $video->title }}">
                        </iframe>
                      </div>
                    @elseif($video->media_type === 'image')
                      <div style="width: 100%; aspect-ratio: 9/16; background: #000; border-radius: 12px; overflow: hidden; position: relative;">
                        <img src="{{ $video->file_url }}" alt="{{ $video->title }}" style="width: 100%; height: 100%; object-fit: cover; display: block;" loading="lazy">
                      </div>
                    @else
                      <video class="gallery-video" controls playsinline preload="metadata"@if($video->thumbnail) poster="{{ $video->thumbnail_url }}"@endif>
                        <source src="{{ $video->file_url }}" type="video/mp4">
                        Browser Anda tidak mendukung pemutar video HTML5.
                      </video>
                    @endif
                  </div>
                  <div class="video-card-body">
                    <span class="video-tag">{{ $video->caption ?? 'Dokumentasi Tour' }}</span>
                    <h3 class="video-title">{{ $video->title }}</h3>
                    <p class="video-desc">Momen autentik keceriaan rombongan saat menikmati perjalanan wisata bersama Nirwana Tour Lampung.</p>
                    @if($video->is_instagram)
                      <a href="{{ $video->file_url }}" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; font-size: 0.78rem; font-weight: 700; color: #E1306C; margin-top: 6px; text-decoration: none;">
                        <i class="fa-brands fa-instagram"></i> Tonton di Instagram
                      </a>
                    @endif
                  </div>
                </article>
              @empty
                <article class="video-card">
                  <div class="video-player-wrapper">
                    <div style="width: 100%; aspect-ratio: 9/16; background: #0f172a; border-radius: 12px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 24px; color: #fff;">
                      <i class="fa-brands fa-instagram" style="font-size: 3rem; color: #E1306C; margin-bottom: 12px;"></i>
                      <p style="font-size: 0.88rem; font-weight: 700; margin-bottom: 6px;">Instagram Reels</p>
                      <p style="font-size: 0.75rem; color: #94a3b8; margin-bottom: 14px;">Tonton video keseruan tour terbaru di Instagram kami.</p>
                      <a href="{{ $settings['instagram'] ?? 'https://www.instagram.com/nirwana_tourlampung/' }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm" style="font-size: 0.75rem; padding: 6px 14px;">
                        <i class="fa-brands fa-instagram"></i> Buka Profil
                      </a>
                    </div>
                  </div>
                  <div class="video-card-body">
                    <span class="video-tag">Instagram Video</span>
                    <h3 class="video-title">Keseruan Eksplorasi Wisata Nirwana Tour</h3>
                    <p class="video-desc">Momen autentik keceriaan rombongan saat menikmati perjalanan wisata bersama Nirwana Tour Lampung.</p>
                  </div>
                </article>
              @endforelse
            </div>

          </div>
        </div>

        <div class="gallery-video-cta text-center">
          <p class="gallery-cta-note">
            Ingin rombongan Anda merasakan keseruan liburan berkelas seperti ini? 
            <a href="#" class="wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin reservasi paket wisata rombongan kami.">
              Hubungi Tim Nirwana Tour via WhatsApp <i class="fa-solid fa-arrow-right"></i>
            </a>
          </p>
        </div>
      </div>
    </section>

    <!-- ========================================================
         6.5 ARTIKEL & TIPS WISATA SECTION (DINAMIS DARI DATABASE)
         ======================================================== -->
    <section class="section articles-section relative overflow-hidden" id="artikel">
      <!-- Background Pemandangan Wisata dengan Perpaduan Merah Maroon Mewah -->
      <div class="articles-bg-container" aria-hidden="true">
        <picture>
          @if(!empty($settings['articles_background_image']))
            <img src="{{ str_starts_with($settings['articles_background_image'], 'http') ? $settings['articles_background_image'] : asset('storage/' . $settings['articles_background_image']) }}" 
                 alt="Background Informasi & Edukasi Nirwana Tour" 
                 class="articles-bg-image" 
                 loading="lazy" 
                 decoding="async">
          @else
            <source srcset="{{ asset('assets/images/hero/bromo-hero.webp') }}" type="image/webp">
            <img src="{{ asset('assets/images/hero/bromo-hero.jpg') }}" 
                 alt="Background Wisata Alam Bromo Nirwana Tour" 
                 class="articles-bg-image" 
                 loading="lazy" 
                 decoding="async">
          @endif
        </picture>
        <div class="articles-maroon-overlay"></div>
        <div class="articles-ambient-overlay"></div>
        <div class="articles-dots-overlay"></div>
      </div>

      <div class="container relative z-10">
        <div class="section-header text-center">
          <div class="section-tag inline-block">Informasi & Edukasi</div>
          <h2 class="section-title text-white">Berita & Tips Wisata Terbaru</h2>
          <p class="section-subtitle text-[#FCE7EB]">Dapatkan panduan liburan praktis, tips destinasi populer, dan wawasan seru seputar wisata Lampung & Nusantara.</p>
        </div>

        <div class="articles-grid">
          @forelse($posts as $post)
            <article class="article-card">
              <div class="article-thumb">
                <a href="{{ route('posts.show', $post->slug) }}" style="display: block; width: 100%; height: 100%;">
                  <img src="{{ $post->cover_image_url }}" alt="{{ $post->title }}" class="article-img" loading="lazy" decoding="async">
                </a>
                <span class="article-tag">{{ $post->category_name ?: ($post->category->name ?? 'Tips Wisata') }}</span>
              </div>
              <div class="article-body">
                <div class="article-meta">
                  <span><i class="fa-regular fa-calendar"></i> {{ $post->published_at ? $post->published_at->format('d M Y') : date('d M Y') }}</span>
                  <span><i class="fa-regular fa-clock"></i> {{ $post->reading_time }}</span>
                </div>
                <h3 class="article-title">
                  <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                </h3>
                <p class="article-excerpt">
                  {{ Str::limit($post->excerpt ?: strip_tags($post->content), 125) }}
                </p>
                <div class="article-footer">
                  <a href="{{ route('posts.show', $post->slug) }}" class="btn-read-more">
                    Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </article>
          @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px 20px; background: #fff; border-radius: 12px; border: 1px solid var(--border-light);">
              <p style="color: var(--text-muted); font-size: 0.95rem;">Belum ada artikel atau tips wisata yang dipublikasikan saat ini.</p>
            </div>
          @endforelse
        </div>

        <!-- Tombol Aksi Buka Semua Artikel -->
        <div class="article-more-wrapper">
          <a href="{{ route('posts.index') }}" class="btn btn-outline btn-lg">
            <span>Buka Semua Berita & Tips Wisata</span>
            <i class="fa-solid fa-arrow-right"></i>
          </a>
          <p class="article-more-note">
            Ingin panduan atau tips destinasi khusus lainnya? 
            <a href="#" class="wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin menanyakan panduan dan tips seputar destinasi wisata.">
              Tanya Tim Nirwana Tour via WhatsApp <i class="fa-solid fa-arrow-right"></i>
            </a>
          </p>
        </div>
      </div>
    </section>

    <!-- ========================================================
         8. TESTIMONI WISATAWAN (DINAMIS DARI DATABASE)
         ======================================================== -->
    <section class="section testimonials-section" id="testimoni">
      <div class="container">
        <div class="testimonials-split-wrapper">
          <!-- SISI KIRI: Tulisan & Ringkasan Kepuasan -->
          <div class="testimonials-left-col">
            <div class="section-tag">Cerita Bahagia Wisatawan</div>
            <h2 class="section-title">Apa Kata Mereka Tentang Nirwana Tour?</h2>
            <p class="section-subtitle">
              Pengalaman nyata dari sekolah, instansi, BUMN, dan keluarga yang telah mempercayakan perjalanan liburan serta agenda rombongannya kepada kami.
            </p>

            @if(session('review_success'))
              <div style="background: #ECFDF5; border: 1px solid #10B981; color: #065F46; padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; font-size: 0.9rem; display: flex; align-items: center; gap: 10px;">
                <i class="fa-solid fa-circle-check" style="font-size: 1.2rem; color: #10B981;"></i>
                <span>{{ session('review_success') }}</span>
              </div>
            @endif

            <!-- Social Proof Trust Card -->
            <div class="testi-trust-card">
              <!-- Google Reviews Badge -->
              <div class="google-review-badge" style="display: flex; align-items: center; gap: 12px; background: #FFFFFF; border: 1px solid #E2E8F0; padding: 12px 16px; border-radius: 14px; margin-bottom: 18px; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.05);">
                <i class="fa-brands fa-google" style="font-size: 1.8rem; color: #4285F4;"></i>
                <div style="line-height: 1.35;">
                  <div style="font-size: 0.92rem; font-weight: 800; color: #0F172A; display: flex; align-items: center; gap: 6px;">
                    <span>{{ $settings['google_maps_rating'] ?? '4.9' }}</span>
                    <span style="color: #F59E0B; font-size: 0.85rem;">★★★★★</span>
                    <span style="font-size: 0.78rem; color: #64748B; font-weight: 600;">({{ $settings['google_maps_reviews_count'] ?? '250+' }} Ulasan Google)</span>
                  </div>
                  <a href="{{ $settings['google_maps_review_url'] ?? 'https://maps.google.com/?q=Nirwana+Tour+Lampung' }}" target="_blank" rel="noopener noreferrer" style="font-size: 0.8rem; color: #2563EB; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; margin-top: 2px;">
                    Lihat Review Google Maps <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.68rem;"></i>
                  </a>
                </div>
              </div>

              <div class="trust-card-score">
                <span class="trust-number">4.9</span>
                <div class="trust-stars-wrap">
                  <div class="trust-stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                  </div>
                  <span class="trust-label">{{ $settings['social_proof_headline'] ?? 'Kepuasan 99% dari 500+ Rombongan' }}</span>
                </div>
              </div>

              <div class="trust-benefits">
                <div class="trust-benefit-item">
                  <i class="fa-solid fa-circle-check"></i>
                  <span>100% Legalitas Resmi PT Biro Perjalanan</span>
                </div>
                <div class="trust-benefit-item">
                  <i class="fa-solid fa-circle-check"></i>
                  <span>Tour Leader & Kru Berlisensi Ramah</span>
                </div>
                <div class="trust-benefit-item">
                  <i class="fa-solid fa-circle-check"></i>
                  <span>Armada Bus & Mobil Wisata Terawat Prima</span>
                </div>
              </div>

              <div class="trust-card-cta" style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="#kontak" class="btn btn-primary btn-md">
                  <span>Konsultasi Liburan</span>
                  <i class="fa-solid fa-arrow-right"></i>
                </a>
                <button type="button" class="btn btn-outline-primary btn-md" onclick="document.getElementById('reviewModal').style.display='flex'">
                  <i class="fa-solid fa-pen-to-square"></i>
                  <span>Beri Ulasan Anda</span>
                </button>
              </div>
            </div>
          </div>

          <!-- SISI KANAN: Testimoni Berjalan Kebawah (Vertical Downward Marquee Dinamis) -->
          <div class="testimonials-right-col">
            <div class="testimonials-viewport" id="testimonialsViewport">
              @php
                $testiHalf = max(1, (int) ceil($testimonials->count() / 2));
                $testiCol1 = $testimonials->slice(0, $testiHalf);
                $testiCol2 = $testimonials->slice($testiHalf);
                if ($testiCol2->isEmpty()) {
                    $testiCol2 = $testiCol1;
                }
              @endphp

              <div class="testi-track-grid">
                <!-- Kolom Track 1: Bergerak Kebawah -->
                <div class="testi-col-track track-col-1">
                  <div class="testi-track-inner">
                    <div class="testi-group">
                      @foreach($testiCol1 as $testi)
                        <div class="testimonial-card">
                          <div class="testimonial-card-top">
                            <div class="testi-author">
                              @if($testi->avatar)
                                <img src="{{ $testi->avatar_url }}" alt="{{ $testi->client_name }}" loading="lazy" decoding="async" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover;">
                              @else
                                <div class="author-avatar avatar-{{ ($loop->index % 4) + 1 }}">
                                  {{ strtoupper(substr($testi->client_name, 0, 2)) }}
                                </div>
                              @endif
                              <div>
                                <h4 class="author-name">{{ $testi->client_name }}</h4>
                                <p class="author-role">{{ $testi->role ? $testi->role . ' - ' : '' }}{{ $testi->organization }}</p>
                              </div>
                            </div>
                          </div>
                          <p class="testi-text">
                            "{{ $testi->comment }}"
                          </p>
                          <div class="testi-stars">
                            @for($s = 0; $s < ($testi->rating ?? 5); $s++)
                              <i class="fa-solid fa-star"></i>
                            @endfor
                          </div>
                          @if($testi->trip_name)
                            <div class="testi-trip-badge">
                              <i class="fa-solid fa-location-dot"></i> {{ $testi->trip_name }}
                            </div>
                          @endif
                        </div>
                      @endforeach
                    </div>

                    <!-- Group 1 Clone (Infinite Loop) -->
                    <div class="testi-group" aria-hidden="true">
                      @foreach($testiCol1 as $testi)
                        <div class="testimonial-card">
                          <div class="testimonial-card-top">
                            <div class="testi-author">
                              @if($testi->avatar)
                                <img src="{{ $testi->avatar_url }}" alt="{{ $testi->client_name }}" loading="lazy" decoding="async" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover;">
                              @else
                                <div class="author-avatar avatar-{{ ($loop->index % 4) + 1 }}">
                                  {{ strtoupper(substr($testi->client_name, 0, 2)) }}
                                </div>
                              @endif
                              <div>
                                <h4 class="author-name">{{ $testi->client_name }}</h4>
                                <p class="author-role">{{ $testi->role ? $testi->role . ' - ' : '' }}{{ $testi->organization }}</p>
                              </div>
                            </div>
                          </div>
                          <p class="testi-text">
                            "{{ $testi->comment }}"
                          </p>
                          <div class="testi-stars">
                            @for($s = 0; $s < ($testi->rating ?? 5); $s++)
                              <i class="fa-solid fa-star"></i>
                            @endfor
                          </div>
                          @if($testi->trip_name)
                            <div class="testi-trip-badge">
                              <i class="fa-solid fa-location-dot"></i> {{ $testi->trip_name }}
                            </div>
                          @endif
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>

                <!-- Kolom Track 2: Bergerak Kebawah -->
                <div class="testi-col-track track-col-2">
                  <div class="testi-track-inner">
                    <div class="testi-group">
                      @foreach($testiCol2 as $testi)
                        <div class="testimonial-card">
                          <div class="testimonial-card-top">
                            <div class="testi-author">
                              @if($testi->avatar)
                                <img src="{{ $testi->avatar_url }}" alt="{{ $testi->client_name }}" loading="lazy" decoding="async" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover;">
                              @else
                                <div class="author-avatar avatar-{{ (($loop->index + 2) % 4) + 1 }}">
                                  {{ strtoupper(substr($testi->client_name, 0, 2)) }}
                                </div>
                              @endif
                              <div>
                                <h4 class="author-name">{{ $testi->client_name }}</h4>
                                <p class="author-role">{{ $testi->role ? $testi->role . ' - ' : '' }}{{ $testi->organization }}</p>
                              </div>
                            </div>
                          </div>
                          <p class="testi-text">
                            "{{ $testi->comment }}"
                          </p>
                          <div class="testi-stars">
                            @for($s = 0; $s < ($testi->rating ?? 5); $s++)
                              <i class="fa-solid fa-star"></i>
                            @endfor
                          </div>
                          @if($testi->trip_name)
                            <div class="testi-trip-badge">
                              <i class="fa-solid fa-location-dot"></i> {{ $testi->trip_name }}
                            </div>
                          @endif
                        </div>
                      @endforeach
                    </div>

                    <!-- Group 2 Clone (Infinite Loop) -->
                    <div class="testi-group" aria-hidden="true">
                      @foreach($testiCol2 as $testi)
                        <div class="testimonial-card">
                          <div class="testimonial-card-top">
                            <div class="testi-author">
                              @if($testi->avatar)
                                <img src="{{ $testi->avatar_url }}" alt="{{ $testi->client_name }}" loading="lazy" decoding="async" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover;">
                              @else
                                <div class="author-avatar avatar-{{ (($loop->index + 2) % 4) + 1 }}">
                                  {{ strtoupper(substr($testi->client_name, 0, 2)) }}
                                </div>
                              @endif
                              <div>
                                <h4 class="author-name">{{ $testi->client_name }}</h4>
                                <p class="author-role">{{ $testi->role ? $testi->role . ' - ' : '' }}{{ $testi->organization }}</p>
                              </div>
                            </div>
                          </div>
                          <p class="testi-text">
                            "{{ $testi->comment }}"
                          </p>
                          <div class="testi-stars">
                            @for($s = 0; $s < ($testi->rating ?? 5); $s++)
                              <i class="fa-solid fa-star"></i>
                            @endfor
                          </div>
                          @if($testi->trip_name)
                            <div class="testi-trip-badge">
                              <i class="fa-solid fa-location-dot"></i> {{ $testi->trip_name }}
                            </div>
                          @endif
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="testi-hint">
              <i class="fa-solid fa-hand-pointer"></i>
              <span>Arahkan kursor atau sentuh untuk menjeda ulasan</span>
            </div>
          </div>
        </div>
      </div>

      <!-- MODAL TULIS ULASAN / TESTIMONI -->
      <div id="reviewModal" style="display: none; position: fixed; inset: 0; z-index: 9999; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 20px;">
        <div style="background: #FFFFFF; border-radius: 20px; width: 100%; max-width: 540px; max-height: 90vh; overflow-y: auto; padding: 32px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); position: relative;">
          <!-- Close Button -->
          <button type="button" onclick="document.getElementById('reviewModal').style.display='none'" style="position: absolute; top: 20px; right: 20px; border: none; background: #F1F5F9; color: #64748B; width: 34px; height: 34px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 1rem; transition: background 0.2s;">
            <i class="fa-solid fa-xmark"></i>
          </button>

          <div style="margin-bottom: 22px;">
            <span style="display: inline-block; background: rgba(128,0,32,0.08); color: var(--primary, #800020); font-weight: 700; font-size: 0.78rem; padding: 4px 12px; border-radius: 12px; text-transform: uppercase; margin-bottom: 8px;">
              Kepuasan Pelanggan
            </span>
            <h3 style="font-size: 1.35rem; font-weight: 800; color: #0F172A; margin: 0 0 6px 0;">Bagikan Pengalaman Trip Anda</h3>
            <p style="color: #64748B; font-size: 0.88rem; margin: 0; line-height: 1.5;">
              Ceritakan keseruan liburan Anda bersama Nirwana Tour Lampung. Ulasan Anda membantu kami terus memberikan pelayanan terbaik!
            </p>
          </div>

          <form action="{{ route('testimonial.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="_hp_check" style="display:none !important;" tabindex="-1" autocomplete="off">

            <!-- Rating Stars Picker -->
            <div style="margin-bottom: 18px; text-align: center; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 14px; padding: 14px;">
              <label style="display: block; font-size: 0.84rem; font-weight: 700; color: #334155; margin-bottom: 8px;">Berapa Bintang untuk Layanan Kami?</label>
              <div id="starRatingPicker" style="display: inline-flex; gap: 8px; font-size: 1.6rem; cursor: pointer; color: #F59E0B;">
                <input type="hidden" name="rating" id="ratingInput" value="5">
                <i class="fa-solid fa-star star-btn" data-val="1"></i>
                <i class="fa-solid fa-star star-btn" data-val="2"></i>
                <i class="fa-solid fa-star star-btn" data-val="3"></i>
                <i class="fa-solid fa-star star-btn" data-val="4"></i>
                <i class="fa-solid fa-star star-btn" data-val="5"></i>
              </div>
              <div id="ratingText" style="font-size: 0.8rem; font-weight: 600; color: #64748B; margin-top: 4px;">5 / 5 - Luar Biasa Sangat Puas!</div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px;">
              <div>
                <label style="display: block; font-weight: 600; font-size: 0.84rem; margin-bottom: 5px; color: #334155;">Nama Lengkap *</label>
                <input type="text" name="client_name" required placeholder="Contoh: Budi Santoso" style="width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 0.88rem; outline: none;">
              </div>
              <div>
                <label style="display: block; font-weight: 600; font-size: 0.84rem; margin-bottom: 5px; color: #334155;">Instansi / Asal Kota</label>
                <input type="text" name="organization" placeholder="Contoh: Jakarta / Bank Mandiri" style="width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 0.88rem; outline: none;">
              </div>
            </div>

            <div style="margin-bottom: 14px;">
              <label style="display: block; font-weight: 600; font-size: 0.84rem; margin-bottom: 5px; color: #334155;">Nama Paket / Trip yang Diikuti</label>
              <input type="text" name="trip_name" placeholder="Contoh: Paket Snorkeling Pahawang 2D1N / Sewa HiAce" style="width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 0.88rem; outline: none;">
            </div>

            <div style="margin-bottom: 14px;">
              <label style="display: block; font-weight: 600; font-size: 0.84rem; margin-bottom: 5px; color: #334155;">Ulasan / Kesan Perjalanan Anda *</label>
              <textarea name="comment" rows="3" required placeholder="Ceritakan bagaimana pelayanan tour leader, armada, makanan, dan keseruan destinasinya..." style="width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 0.88rem; outline: none;"></textarea>
            </div>

            <div style="margin-bottom: 20px;">
              <label style="display: block; font-weight: 600; font-size: 0.84rem; margin-bottom: 5px; color: #334155;">Foto Profil / Kenangan Trip (Opsional)</label>
              <input type="file" name="avatar" accept="image/png,image/jpeg,image/webp" style="width: 100%; font-size: 0.84rem; color: #64748B;">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-weight: 700; border-radius: 10px; display: flex; align-items: center; justify-content: center; gap: 8px;">
              <i class="fa-solid fa-paper-plane"></i>
              <span>Kirim Ulasan Saya</span>
            </button>
          </form>
        </div>
      </div>
    </section>

    <!-- ========================================================
         8. KONTAK SECTION (DINAMIS DENGAN PENYIMPANAN DATABASE)
         ======================================================== -->
    <section class="section contact-section bg-alt" id="kontak">
      <div class="container">
        <div class="section-header text-center">
          <div class="section-tag">Hubungi Kami</div>
          <h2 class="section-title">Mari Rencanakan Perjalanan Anda Bersama Kami</h2>
          <p class="section-subtitle">Tim konsultasi Nirwana Tour Lampung siap membantu menyusun paket liburan dan proposal penawaran terbaik untuk Anda.</p>
        </div>

        <div class="contact-grid">
          <!-- Info Kontak -->
          <div class="contact-info-card">
            <h3 class="contact-card-title">Informasi Kontak & Kantor</h3>
            <p class="contact-lead-text">
              Punya pertanyaan seputar paket wisata, reservasi armada, atau penawaran khusus rombongan? Hubungi kami langsung melalui saluran resmi berikut:
            </p>

            <div class="contact-items-list">
              <!-- Item 1: Alamat -->
              <div class="contact-item">
                <div class="contact-item-icon icon-location">
                  <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="contact-item-content">
                  <strong>Alamat Kantor Resmi</strong>
                  <p>{{ $settings['address'] ?? 'Jl. Pangeran Antasari No. 88, Kedamaian, Kota Bandar Lampung, Lampung 35122' }}</p>
                </div>
              </div>

              <!-- Item 2: WhatsApp -->
              <div class="contact-item">
                <div class="contact-item-icon icon-whatsapp">
                  <i class="fa-brands fa-whatsapp"></i>
                </div>
                <div class="contact-item-content">
                  <strong>WhatsApp & Telepon</strong>
                  <p>
                    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6282269616188' }}" target="_blank" rel="noopener noreferrer">
                      +{{ $settings['whatsapp_number'] ?? '6282269616188' }}
                    </a>
                  </p>
                </div>
              </div>

              <!-- Item 3: Email -->
              <div class="contact-item">
                <div class="contact-item-icon icon-email">
                  <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="contact-item-content">
                  <strong>Email Resmi</strong>
                  <p>
                    <a href="mailto:{{ $settings['email'] ?? 'info@nirwanatour.com' }}">
                      {{ $settings['email'] ?? 'info@nirwanatour.com' }}
                    </a>
                  </p>
                </div>
              </div>

              <!-- Item 4: Jam Operasional -->
              <div class="contact-item">
                <div class="contact-item-icon icon-clock">
                  <i class="fa-solid fa-clock"></i>
                </div>
                <div class="contact-item-content">
                  <strong>Jam Operasional Kantor</strong>
                  <p>
                    {{ $settings['operating_hours'] ?? 'Senin - Sabtu: 08:00 - 17:00 WIB' }}
                    <br><span style="font-size: 0.8rem; color: #64748b;">Konsultasi Online WhatsApp: Siaga 24 Jam</span>
                  </p>
                </div>
              </div>
            </div>

            <!-- WhatsApp Conversion Action Button -->
            <div class="contact-wa-action">
              <a href="#" class="btn btn-whatsapp btn-block btn-lg wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin konsultasi perjalanan wisata.">
                <i class="fa-brands fa-whatsapp"></i> Chat Langsung via WhatsApp
              </a>
            </div>

            <!-- Social Links in Card -->
            <div class="contact-social-wrap">
              <span>Ikuti Saluran Resmi Kami:</span>
              <div class="social-icons-row">
                <a href="{{ $settings['instagram'] ?? 'https://www.instagram.com/nirwana_tourlampung/?utm_source=ig_web_button_share_sheet' }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram Nirwana Tour"><i class="fa-brands fa-instagram"></i></a>
                <a href="{{ $settings['tiktok'] ?? 'https://www.tiktok.com/@nirwana_tour_travel?is_from_webapp=1&sender_device=pc' }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok Nirwana Tour"><i class="fa-brands fa-tiktok"></i></a>
                <a href="{{ $settings['youtube'] ?? 'https://youtube.com/@nirwanatourlampung?si=ZMFi9b5dvpn0NKfr' }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube Nirwana Tour"><i class="fa-brands fa-youtube"></i></a>
              </div>
            </div>
          </div>

          <!-- Form Kontak Cepat (Tersimpan ke Database & Langsung WA) -->
          <div class="contact-form-card">
            <h3 class="contact-card-title">Kirim Pesan & Pengajuan Proposal</h3>
            <p class="form-instruction">Isi formulir ringkas ini. Permintaan Anda otomatis tercatat di sistem kami dan langsung diteruskan ke WhatsApp konsultan.</p>

            <form action="{{ route('inquiry.store') }}" method="POST" class="contact-form">
              @csrf
              <input type="hidden" name="source" value="homepage_contact">
              {{-- Anti-Spam Honeypot Field --}}
              <input type="text" name="_hp_security_check" style="display:none !important;" tabindex="-1" autocomplete="off">

              <div class="form-group">
                <label for="formName">Nama Lengkap / Instansi <span class="required">*</span></label>
                <div class="input-icon-group">
                  <i class="fa-solid fa-user"></i>
                  <input type="text" id="formName" name="name" class="form-control" placeholder="Contoh: Budi Santoso / PT Maju Jaya" required>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="formPhone">Nomor WhatsApp <span class="required">*</span></label>
                  <div class="input-icon-group">
                    <i class="fa-solid fa-phone"></i>
                    <input type="tel" id="formPhone" name="phone" class="form-control" placeholder="0812-xxxx-xxxx" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="formService">Pilihan Paket / Layanan</label>
                  <div class="input-icon-group">
                    <i class="fa-solid fa-compass"></i>
                    <select id="formService" name="tour_package_id" class="form-control">
                      <option value="">-- Pilih Paket Wisata / Layanan --</option>
                      @foreach($packages as $pkg)
                        <option value="{{ $pkg->id }}">{{ $pkg->title }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="formParticipants">Estimasi Jumlah Peserta</label>
                <div class="input-icon-group">
                  <i class="fa-solid fa-users"></i>
                  <input type="number" id="formParticipants" name="participants" class="form-control" placeholder="Contoh: 35" min="1" value="1">
                </div>
              </div>

              <div class="form-group">
                <label for="formNotes">Catatan / Rencana Tanggal Keberangkatan</label>
                <textarea id="formNotes" name="message" class="form-control" rows="3" placeholder="Tuliskan tanggal rencana liburan atau kebutuhan fasilitas khusus..."></textarea>
              </div>

              <button type="submit" class="btn btn-primary btn-block btn-lg contact-submit-btn">
                <i class="fa-brands fa-whatsapp"></i> Kirim Konsultasi ke WhatsApp
              </button>
            </form>
          </div>
        </div>

        <!-- Peta Lokasi Kantor Mandiri & Luas -->
        <div class="contact-map-banner">
          <div class="contact-map-header">
            <div class="contact-map-title-wrap">
              <div class="contact-map-icon">
                <i class="fa-solid fa-map-location-dot"></i>
              </div>
              <div>
                <h4 class="contact-map-title">Lokasi Kantor Resmi Nirwana Tour Lampung</h4>
                <p class="contact-map-subtitle">{{ $settings['address'] ?? 'Jl. Pangeran Antasari No. 88, Kedamaian, Kota Bandar Lampung, Lampung 35122' }}</p>
              </div>
            </div>
            <a href="https://maps.google.com/?q={{ urlencode($settings['address'] ?? 'Nirwana Tour Bandar Lampung') }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline btn-sm contact-map-btn">
              <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Google Maps
            </a>
          </div>
          <div class="contact-map-frame-wrap">
            <iframe 
              title="Peta Lokasi Nirwana Tour Lampung"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127118.81423406987!2d105.18788934440026!3d-5.419086111369344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40da4290c58e77%3A0xb696f5341cf60f4e!2sBandar%20Lampung%2C%20Kota%20Bandar%20Lampung%2C%20Lampung!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
              width="100%" 
              height="280" 
              style="border:0;" 
              allowfullscreen="" 
              loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
