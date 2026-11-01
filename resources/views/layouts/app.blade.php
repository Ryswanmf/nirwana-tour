<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Nirwana Tour Lampung - Biro Wisata, Paket Tour & Sewa Bus Terpercaya')</title>
  <meta name="description" content="@yield('meta_description', 'Biro perjalanan wisata resmi di Lampung. Melayani paket wisata Lampung & Nusantara, study tour sekolah, gathering perusahaan, dan sewa transportasi pariwisata.')">
  <meta name="keywords" content="@yield('meta_keywords', 'Nirwana Tour Lampung, Tour Lampung, Paket Wisata Lampung, Wisata Pahawang, Teluk Kiluan, Gigi Hiu, Sewa Bus Lampung, Study Tour Lampung')">
  <meta name="author" content="Nirwana Tour Lampung">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="@yield('canonical_url', url()->current())">
  @if(!empty($settings['google_site_verification']))
    <meta name="google-site-verification" content="{{ $settings['google_site_verification'] }}">
  @endif
  
  <!-- Open Graph / Meta Sosial (Facebook, WhatsApp, LinkedIn) -->
  <meta property="og:type" content="@yield('og_type', 'website')">
  <meta property="og:site_name" content="Nirwana Tour & Travel Lampung">
  <meta property="og:url" content="@yield('canonical_url', url()->current())">
  <meta property="og:title" content="@yield('title', 'Nirwana Tour Lampung - Biro Wisata, Paket Tour & Sewa Bus Terpercaya')">
  <meta property="og:description" content="@yield('meta_description', 'Biro perjalanan wisata resmi di Lampung. Melayani paket wisata Lampung & Nusantara, study tour sekolah, gathering perusahaan, dan sewa armada bus pariwisata terpercaya.')">
  <meta property="og:image" content="@yield('og_image', asset('assets/images/destinasi/pahawang.jpg'))">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:locale" content="id_ID">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="@yield('canonical_url', url()->current())">
  <meta name="twitter:title" content="@yield('title', 'Nirwana Tour Lampung - Biro Wisata, Paket Tour & Sewa Bus Terpercaya')">
  <meta name="twitter:description" content="@yield('meta_description', 'Biro perjalanan wisata resmi di Lampung. Melayani paket wisata Lampung & Nusantara, study tour sekolah, gathering perusahaan, dan sewa armada bus pariwisata terpercaya.')">
  <meta name="twitter:image" content="@yield('og_image', asset('assets/images/destinasi/pahawang.jpg'))">

  <!-- Schema.org JSON-LD Structured Data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "TravelAgency",
    "name": "Nirwana Tour & Travel Lampung",
    "image": "{{ asset('assets/logo/Logo-Nirwana.png') }}",
    "@id": "{{ url('/') }}",
    "url": "{{ url('/') }}",
    "telephone": "{{ $settings['phone'] ?? '0822-6961-6188' }}",
    "priceRange": "$$",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Jl. Pangeran Antasari No. 88, Kedamaian",
      "addressLocality": "Bandar Lampung",
      "addressRegion": "Lampung",
      "postalCode": "35122",
      "addressCountry": "ID"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": -5.4124,
      "longitude": 105.2828
    },
    "openingHoursSpecification": {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": [
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday"
      ],
      "opens": "08:00",
      "closes": "17:00"
    },
    "sameAs": [
      "{{ $settings['instagram'] ?? 'https://www.instagram.com/nirwana_tourlampung/' }}",
      "{{ $settings['tiktok'] ?? 'https://www.tiktok.com/@nirwana_tour_travel' }}",
      "{{ $settings['youtube'] ?? 'https://youtube.com/@nirwanatourlampung' }}"
    ]
  }
  </script>
  @stack('jsonld')
  
  <!-- Favicon, PWA & Mobile Web Manifest -->
  <link rel="icon" type="image/png" href="{{ asset('assets/logo/Logo-Nirwana.png') }}">
  <link rel="apple-touch-icon" href="{{ asset('assets/logo/Logo-Nirwana.png') }}">
  <link rel="manifest" href="{{ asset('manifest.json') }}">
  <meta name="theme-color" content="#800020">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="apple-mobile-web-app-title" content="Nirwana Tour">
  
  <!-- Google Fonts: Plus Jakarta Sans & Playfair Display -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,500;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- Font Awesome Icons (Non-blocking) -->
  <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" as="style" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" media="print" onload="this.media='all'">
  <noscript>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
  </noscript>
  
  <!-- Stylesheet (Cache Busted) -->
  <link rel="stylesheet" href="{{ file_exists(public_path('css/style.min.css')) ? asset('css/style.min.css') : asset('css/style.css') }}?v={{ file_exists(public_path('css/style.min.css')) ? filemtime(public_path('css/style.min.css')) : time() }}">
  @stack('styles')

  @if(!empty($settings['google_analytics_id']))
    <!-- Google Analytics 4 (GA4) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings['google_analytics_id'] }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ $settings['google_analytics_id'] }}');
    </script>
  @endif

  @if(!empty($settings['meta_pixel_id']))
    <!-- Meta Pixel (Facebook & Instagram Ads) -->
    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '{{ $settings['meta_pixel_id'] }}');
      fbq('track', 'PageView');
    </script>
    <noscript>
      <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ $settings['meta_pixel_id'] }}&ev=PageView&noscript=1"/>
    </noscript>
  @endif
</head>
<body>
  @php
    $cleanWaNumber = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188');
  @endphp

  <!-- ========================================================
       1. NAVBAR (EXACT FROM INDEX.HTML)
       ======================================================== -->
  <header class="site-header" id="header">
    <div class="header-container container">
      <!-- Logo Brand -->
      <a href="{{ route('home') }}#hero" class="brand-logo" aria-label="Nirwana Tour Lampung Beranda">
        <img src="{{ asset('assets/logo/Logo-Nirwana.png') }}" alt="Nirwana Tour Lampung" class="logo-emblem">
        <div class="brand-text">
          <span class="brand-title">Nirwana <strong>Tour Travel</strong></span>
          <span class="brand-sub">Jelajahi Dunia, Ciptakan Cerita Tak Terlupakan</span>
        </div>
      </a>

      <!-- Desktop Navigation Menu -->
      <nav class="nav-menu" id="navMenu" aria-label="Navigasi Utama">
        <ul class="nav-list">
          <li class="nav-item"><a href="{{ route('home') }}#hero" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
          <li class="nav-item"><a href="{{ route('packages.index') }}" class="nav-link {{ request()->routeIs('packages.*') || request()->routeIs('destinations.*') ? 'active' : '' }}">Paket Wisata</a></li>
          <li class="nav-item"><a href="{{ route('services.index') }}" class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}">Layanan</a></li>
          <li class="nav-item"><a href="{{ route('posts.index') }}" class="nav-link {{ request()->routeIs('posts.*') ? 'active' : '' }}">Berita</a></li>
          <li class="nav-item nav-dropdown">
            <a href="javascript:void(0)" class="nav-link nav-dropdown-toggle {{ request()->routeIs('profile') || request()->routeIs('management') || request()->routeIs('certificates') || request()->routeIs('about') || request()->routeIs('gallery.*') ? 'active' : '' }}" id="tentangDropdown" role="button" aria-expanded="false" aria-haspopup="true">
              <span>Tentang</span>
              <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="tentangDropdown">
              <li>
                <a href="{{ route('profile') }}" class="dropdown-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                  <i class="fa-solid fa-building-columns"></i>
                  <span>Profil Nirwana</span>
                </a>
              </li>
              <li>
                <a href="{{ route('management') }}" class="dropdown-item {{ request()->routeIs('management') ? 'active' : '' }}">
                  <i class="fa-solid fa-user-tie"></i>
                  <span>Manajemen</span>
                </a>
              </li>
              <li>
                <a href="{{ route('certificates') }}" class="dropdown-item {{ request()->routeIs('certificates') ? 'active' : '' }}">
                  <i class="fa-solid fa-certificate"></i>
                  <span>Sertifikasi</span>
                </a>
              </li>
              <li>
                <a href="{{ route('gallery.index') }}" class="dropdown-item {{ request()->routeIs('gallery.*') ? 'active' : '' }}">
                  <i class="fa-solid fa-images"></i>
                  <span>Gallery</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Kontak</a></li>
        </ul>
        <div class="nav-mobile-cta">
          <a href="https://wa.me/{{ $cleanWaNumber }}?text={{ rawurlencode('Halo Nirwana Tour, saya ingin konsultasi perjalanan.') }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin konsultasi perjalanan.">
            <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
          </a>
        </div>
      </nav>

      <!-- Header CTA & Mobile Toggle -->
      <div class="header-actions">
        <a href="https://wa.me/{{ $cleanWaNumber }}?text={{ rawurlencode('Halo Nirwana Tour, saya ingin konsultasi perjalanan.') }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm desktop-only wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin konsultasi perjalanan.">
          <i class="fa-brands fa-whatsapp"></i> Rencanakan Perjalanan
        </a>
        <button class="nav-toggle" id="navToggle" type="button" aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="navMenu">
          <span class="hamburger-bar"></span>
          <span class="hamburger-bar"></span>
          <span class="hamburger-bar"></span>
        </button>
      </div>
    </div>
  </header>

  <!-- MAIN BODY -->
  @yield('content')

  <!-- ========================================================
       FOOTER (EXACT FROM INDEX.HTML)
       ======================================================== -->
  <footer class="site-footer">
    <div class="container footer-container">
      <div class="footer-top">
        <div class="footer-grid">
          <!-- Col 1: Brand & Bio -->
          <div class="footer-col col-brand">
            <a href="{{ route('home') }}#hero" class="footer-logo" aria-label="Nirwana Tour Lampung">
              <img src="{{ asset('assets/logo/Logo-Nirwana.png') }}" alt="Nirwana Tour Lampung" class="footer-logo-emblem">
              <div class="footer-brand-text">
                <span class="footer-brand-title">Nirwana <span class="highlight">Tour Travel</span></span>
                <span class="footer-brand-sub">Jelajahi Dunia, Ciptakan Cerita Tak Terlupakan</span>
              </div>
            </a>
            <p class="footer-bio">
              Nirwana Tour Lampung adalah biro perjalanan wisata tepercaya yang melayani paket wisata nusantara, study tour, gathering perusahaan, dan transportasi pariwisata berkelas di Provinsi Lampung.
            </p>
            <div class="footer-legal-badge">
              <span>Biro Perjalanan Wisata Resmi Terdaftar</span>
            </div>
            <div class="footer-cert-logos">
              <div class="footer-cert-item" title="Wonderful Indonesia">
                <img src="{{ asset('assets/images/wonderful.png') }}" alt="Wonderful Indonesia" class="footer-cert-logo">
              </div>
              <div class="footer-cert-item" title="Pariwisata Lampung">
                <img src="{{ asset('assets/images/lampung.png') }}" alt="Pariwisata Lampung" class="footer-cert-logo">
              </div>
              <div class="footer-cert-item" title="ASITA (Association of The Indonesian Tour and Travel Agencies)">
                <img src="{{ asset('assets/images/asita.png') }}" alt="ASITA" class="footer-cert-logo">
              </div>
            </div>
          </div>

          <!-- Col 2: Layanan Populer -->
          <div class="footer-col">
            <h4 class="footer-title">Layanan Unggulan</h4>
            <ul class="footer-links">
              @if(isset($footerServices) && $footerServices->isNotEmpty())
                @foreach($footerServices as $fService)
                  <li>
                    <a href="{{ route('services.show', $fService->slug) }}">
                      <i class="fa-solid fa-angle-right"></i> {{ $fService->title }}
                    </a>
                  </li>
                @endforeach
                <li>
                  <a href="{{ route('services.index') }}" style="font-weight: 600; color: #F59E0B;">
                    <i class="fa-solid fa-arrow-right"></i> Lihat Semua Layanan
                  </a>
                </li>
              @else
                <li><a href="{{ route('services.show', 'paket-wisata-domestik-lampung') }}"><i class="fa-solid fa-angle-right"></i> Paket Wisata Domestik & Lampung</a></li>
                <li><a href="{{ route('services.show', 'study-tour-field-trip-sekolah') }}"><i class="fa-solid fa-angle-right"></i> Study Tour & Field Trip Sekolah</a></li>
                <li><a href="{{ route('services.show', 'family-gathering-corporate-event') }}"><i class="fa-solid fa-angle-right"></i> Family Gathering & Corporate Event</a></li>
                <li><a href="{{ route('services.show', 'sewa-bus-transportasi-pariwisata') }}"><i class="fa-solid fa-angle-right"></i> Sewa Bus & Transportasi Pariwisata</a></li>
                <li><a href="{{ route('services.index') }}" style="font-weight: 600; color: #F59E0B;"><i class="fa-solid fa-arrow-right"></i> Lihat Semua Layanan</a></li>
              @endif
            </ul>
          </div>

          <!-- Col 4: Hubungi Kami -->
          <div class="footer-col col-contact">
            <h4 class="footer-title">Kontak & Reservasi</h4>
            <ul class="footer-contact-info">
              <li>
                <i class="fa-solid fa-location-dot"></i>
                <a href="https://maps.google.com/?q={{ urlencode($settings['address'] ?? 'Jl. Pangeran Antasari No. 88, Kedamaian, Kota Bandar Lampung, Lampung 35122') }}" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   title="Buka Lokasi di Google Maps"
                   style="color: inherit; text-decoration: none;">
                  {{ $settings['address'] ?? 'Jl. Pangeran Antasari No. 88, Kedamaian, Kota Bandar Lampung, Lampung 35122' }}
                </a>
              </li>
              <li>
                <i class="fa-brands fa-whatsapp"></i>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188') }}?text={{ rawurlencode('Halo Nirwana Tour, saya ingin konsultasi perjalanan.') }}" 
                   target="_blank" 
                   rel="noopener noreferrer">
                  +{{ $settings['whatsapp_number'] ?? '6282269616188' }}
                </a>
              </li>
              <li>
                <i class="fa-solid fa-envelope"></i>
                <a href="mailto:{{ $settings['email'] ?? 'info@nirwanatourlampung.com' }}">{{ $settings['email'] ?? 'info@nirwanatourlampung.com' }}</a>
              </li>
            </ul>

            <!-- Google Maps Embed Footer Widget -->
            <div class="footer-map-box" style="margin-bottom: 22px; border-radius: 12px; overflow: hidden; border: 1px solid rgba(255, 255, 255, 0.14); box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);">
              <iframe
                src="{{ $settings['google_maps_embed_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127118.81423406987!2d105.18788934440026!3d-5.419086111369344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40da4290c58e77%3A0xb696f5341cf60f4e!2sBandar%20Lampung%2C%20Kota%20Bandar%20Lampung%2C%20Lampung!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid' }}"
                width="100%"
                height="120"
                style="border: 0; display: block;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Peta Lokasi Google Maps Nirwana Tour Lampung">
              </iframe>
              <a href="https://maps.google.com/?q={{ urlencode($settings['address'] ?? 'Jl. Pangeran Antasari No. 88, Kedamaian, Kota Bandar Lampung, Lampung 35122') }}"
                 target="_blank"
                 rel="noopener noreferrer"
                 style="display: flex; align-items: center; justify-content: center; gap: 6px; padding: 7px 10px; background: rgba(255, 255, 255, 0.08); color: #F1F5F9; font-size: 0.78rem; font-weight: 600; text-decoration: none; border-top: 1px solid rgba(255, 255, 255, 0.1); transition: background 0.2s ease;">
                <i class="fa-solid fa-map-location-dot" style="color: #D4AF37;"></i>
                <span>Petunjuk Arah Google Maps</span>
              </a>
            </div>

            <h5 class="social-header-title">Ikuti Kami</h5>
            <div class="footer-social-icons">
              <a href="{{ $settings['instagram'] ?? 'https://www.instagram.com/nirwana_tourlampung/?utm_source=ig_web_button_share_sheet' }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
              <a href="{{ $settings['tiktok'] ?? 'https://www.tiktok.com/@nirwana_tour_travel?is_from_webapp=1&sender_device=pc' }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
              <a href="{{ $settings['youtube'] ?? 'https://youtube.com/@nirwanatourlampung?si=ZMFi9b5dvpn0NKfr' }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer Bottom Copyright -->
      <div class="footer-bottom">
        <p>&copy; <span id="currentYear">{{ date('Y') }}</span> <strong>Nirwana Tour Lampung</strong>. Hak Cipta Dilindungi Undang-Undang.</p>
        <p class="footer-tagline">Dibuat oleh <a href="https://www.instagram.com/swiftcode.lpg?utm_source=ig_web_button_share_sheet&rpxt=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer">Swift Code Lampung</a></p>
      </div>
    </div>
  </footer>

  <!-- ========================================================
       FLOATING WHATSAPP MULTI-LAYANAN CONCIERGE WIDGET
       ======================================================== -->
  @php
    $cleanWaNumber = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188');
  @endphp
  <div class="floating-wa-wrapper" id="floatingWA">
    <!-- Pop-up Multi-Channel Concierge Card -->
    <div class="wa-concierge-card" id="waConciergeCard" style="display: none;">
      <!-- Card Header -->
      <div class="wa-concierge-header">
        <div class="wa-concierge-avatar-wrap">
          <div class="wa-concierge-avatar">
            <i class="fa-solid fa-headset"></i>
          </div>
          <span class="wa-status-dot"></span>
        </div>
        <div class="wa-concierge-header-info">
          <h4 class="wa-concierge-title">Konsultan Nirwana Tour</h4>
          <span class="wa-concierge-subtitle"><i class="fa-solid fa-circle" style="color: #22C55E; font-size: 0.5rem;"></i> Online • Siap Membantu</span>
        </div>
        <button type="button" class="wa-concierge-close" id="waConciergeClose" aria-label="Tutup Menu WhatsApp">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>

      <!-- Card Body: Service Options -->
      <div class="wa-concierge-body">
        <p class="wa-concierge-prompt">Halo! Silakan pilih layanan konsultasi:</p>

        <div class="wa-concierge-options">
          <!-- Opsi 1: Paket Wisata & Open Trip -->
          <a href="https://wa.me/{{ $cleanWaNumber }}?text={{ rawurlencode('Halo Nirwana Tour, saya tertarik konsultasi paket wisata & open trip di Lampung. Boleh info jadwal & penawarannya?') }}"
             target="_blank" rel="noopener noreferrer" class="wa-option-item">
            <div class="wa-option-icon wa-icon-tour">
              <i class="fa-solid fa-umbrella-beach"></i>
            </div>
            <div class="wa-option-text">
              <strong>Paket Wisata & Open Trip</strong>
              <span>Pahawang, Kiluan, Krakatau, dll</span>
            </div>
            <i class="fa-solid fa-angle-right wa-option-arrow"></i>
          </a>

          <!-- Opsi 2: Sewa Bus & Armada -->
          <a href="https://wa.me/{{ $cleanWaNumber }}?text={{ rawurlencode('Halo Nirwana Tour, saya ingin sewa armada bus pariwisata / HiAce. Boleh info unit & tarifnya?') }}"
             target="_blank" rel="noopener noreferrer" class="wa-option-item">
            <div class="wa-option-icon wa-icon-bus">
              <i class="fa-solid fa-bus-simple"></i>
            </div>
            <div class="wa-option-text">
              <strong>Sewa Bus & HiAce Pariwisata</strong>
              <span>Big Bus, Medium Bus, HiAce Premio</span>
            </div>
            <i class="fa-solid fa-angle-right wa-option-arrow"></i>
          </a>

          <!-- Opsi 3: Corporate Gathering & Outbound -->
          <a href="https://wa.me/{{ $cleanWaNumber }}?text={{ rawurlencode('Halo Nirwana Tour, kami berencana menyelenggarakan gathering / outbound instansi. Boleh minta proposal penawarannya?') }}"
             target="_blank" rel="noopener noreferrer" class="wa-option-item">
            <div class="wa-option-icon wa-icon-corporate">
              <i class="fa-solid fa-building"></i>
            </div>
            <div class="wa-option-text">
              <strong>Gathering Kantor & Outbound</strong>
              <span>BUMN, Perusahaan, Study Tour</span>
            </div>
            <i class="fa-solid fa-angle-right wa-option-arrow"></i>
          </a>

          <!-- Opsi 4: Bantuan & CS Umum -->
          <a href="https://wa.me/{{ $cleanWaNumber }}?text={{ rawurlencode('Halo Nirwana Tour, saya ingin konsultasi perjalanan.') }}"
             target="_blank" rel="noopener noreferrer" class="wa-option-item">
            <div class="wa-option-icon wa-icon-cs">
              <i class="fa-solid fa-comments"></i>
            </div>
            <div class="wa-option-text">
              <strong>Bantuan & Info Umum</strong>
              <span>Chat langsung customer service</span>
            </div>
            <i class="fa-solid fa-angle-right wa-option-arrow"></i>
          </a>
        </div>
      </div>

      <!-- Card Footer -->
      <div class="wa-concierge-footer">
        <span><i class="fa-solid fa-shield-halved" style="color: #10B981;"></i> Biro Resmi Terdaftar • Respon Cepat</span>
      </div>
    </div>

    <!-- Floating Bubble Notification -->
    <div class="floating-wa-bubble" id="floatingWABubble">
      <span>Butuh bantuan liburan? Chat kami!</span>
    </div>

    <!-- Toggle Button -->
    <button type="button" class="floating-wa-btn" id="floatingWABtn" aria-label="Buka Chat WhatsApp Konsultan" aria-expanded="false" style="border: none; cursor: pointer;">
      <i class="fa-brands fa-whatsapp" id="floatingWAIcon"></i>
      <span class="online-indicator"></span>
    </button>
  </div>

  <!-- Back to top button -->
  <button class="back-to-top" id="backToTop" aria-label="Kembali ke atas">
    <i class="fa-solid fa-arrow-up"></i>
  </button>

  <!-- Config JS Global Dinamis -->
  <script>
    window.NIRWANA_CONFIG = {
      whatsappNumber: "{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188') }}",
      defaultWaMessage: "Halo Nirwana Tour, saya ingin konsultasi perjalanan."
    };
  </script>

  <!-- Alpine.js (Reactive UI) -->
  <script src="{{ asset('js/alpine.min.js') }}" defer></script>

  <!-- Script JS -->
  <script src="{{ file_exists(public_path('js/script.min.js')) ? asset('js/script.min.js') : asset('js/script.js') }}" defer></script>

  <!-- PWA Service Worker Registration -->
  <script>
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', function() {
        navigator.serviceWorker.register('{{ asset("sw.js") }}?v={{ file_exists(public_path("sw.js")) ? filemtime(public_path("sw.js")) : time() }}').catch(function() {});
      });
    }
  </script>
  @stack('scripts')
</body>
</html>
