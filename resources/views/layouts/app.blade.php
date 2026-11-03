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

  <!-- Config JS Global Dinamis -->
  <script>
    window.NIRWANA_CONFIG = {
      whatsappNumber: "{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188') }}",
      defaultWaMessage: "Halo Nirwana Tour, saya ingin konsultasi perjalanan."
    };
  </script>

  <!-- Tailwind CSS & Alpine.js via Vite -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

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
  <header class="site-header fixed top-0 inset-x-0 z-50 transition-all duration-300" id="header" x-data="navigation" :class="{ 'scrolled bg-white/95 backdrop-blur-md shadow-md border-b border-slate-200': scrolled, 'bg-white/85 backdrop-blur-sm': !scrolled }" @scroll.window="updateScroll()">
    <div class="header-container container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between transition-all duration-300">
      <!-- Logo Brand -->
      <a href="{{ route('home') }}#hero" class="brand-logo flex items-center gap-3 group text-decoration-none" aria-label="Nirwana Tour Lampung Beranda">
        <img src="{{ asset('assets/logo/Logo-Nirwana.png') }}" alt="Nirwana Tour Lampung" class="logo-emblem transition-transform duration-300 group-hover:scale-105 group-hover:rotate-3">
        <div class="brand-text flex flex-col">
          <span class="brand-title text-base sm:text-lg font-bold text-slate-900 tracking-tight leading-tight">Nirwana <strong class="text-[#800020]">Tour Travel</strong></span>
          <span class="brand-sub text-xs text-slate-500 hidden sm:inline leading-tight">Jelajahi Dunia, Ciptakan Cerita Tak Terlupakan</span>
        </div>
      </a>

      <!-- Desktop Navigation Menu -->
      <nav class="nav-menu" id="navMenu" :class="{ 'open': mobileOpen }" aria-label="Navigasi Utama">
        <ul class="nav-list flex items-center gap-1 list-none m-0 p-0">
          <li class="nav-item"><a href="{{ route('home') }}#hero" class="nav-link px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('home') ? 'active text-[#800020] font-bold bg-[#800020]/10' : 'text-slate-600 hover:text-[#800020] hover:bg-[#800020]/5' }}" @click="closeMobile()">Beranda</a></li>
          <li class="nav-item"><a href="{{ route('packages.index') }}" class="nav-link px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('packages.*') || request()->routeIs('destinations.*') ? 'active text-[#800020] font-bold bg-[#800020]/10' : 'text-slate-600 hover:text-[#800020] hover:bg-[#800020]/5' }}" @click="closeMobile()">Paket Wisata</a></li>
          <li class="nav-item"><a href="{{ route('services.index') }}" class="nav-link px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('services.*') ? 'active text-[#800020] font-bold bg-[#800020]/10' : 'text-slate-600 hover:text-[#800020] hover:bg-[#800020]/5' }}" @click="closeMobile()">Layanan</a></li>
          <li class="nav-item"><a href="{{ route('posts.index') }}" class="nav-link px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('posts.*') ? 'active text-[#800020] font-bold bg-[#800020]/10' : 'text-slate-600 hover:text-[#800020] hover:bg-[#800020]/5' }}" @click="closeMobile()">Berita</a></li>
          <li class="nav-item nav-dropdown" x-data="{ dropdownOpen: false }">
            <a href="javascript:void(0)" class="nav-link nav-dropdown-toggle px-3.5 py-2 text-sm font-semibold rounded-lg flex items-center gap-1.5 transition-colors {{ request()->routeIs('profile') || request()->routeIs('management') || request()->routeIs('certificates') || request()->routeIs('about') || request()->routeIs('gallery.*') ? 'active text-[#800020] font-bold bg-[#800020]/10' : 'text-slate-600 hover:text-[#800020] hover:bg-[#800020]/5' }}" id="tentangDropdown" role="button" @click="dropdownOpen = !dropdownOpen" :aria-expanded="dropdownOpen" aria-haspopup="true">
              <span>Tentang</span>
              <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="{ 'rotate-180': dropdownOpen }"></i>
            </a>
            <ul class="dropdown-menu" :class="{ 'open': dropdownOpen }" @click.outside="dropdownOpen = false" aria-labelledby="tentangDropdown">
              <li>
                <a href="{{ route('profile') }}" class="dropdown-item {{ request()->routeIs('profile') ? 'active' : '' }}" @click="closeMobile()">
                  <i class="fa-solid fa-building-columns"></i>
                  <span>Profil Nirwana</span>
                </a>
              </li>
              <li>
                <a href="{{ route('management') }}" class="dropdown-item {{ request()->routeIs('management') ? 'active' : '' }}" @click="closeMobile()">
                  <i class="fa-solid fa-user-tie"></i>
                  <span>Manajemen</span>
                </a>
              </li>
              <li>
                <a href="{{ route('certificates') }}" class="dropdown-item {{ request()->routeIs('certificates') ? 'active' : '' }}" @click="closeMobile()">
                  <i class="fa-solid fa-certificate"></i>
                  <span>Sertifikasi</span>
                </a>
              </li>
              <li>
                <a href="{{ route('gallery.index') }}" class="dropdown-item {{ request()->routeIs('gallery.*') ? 'active' : '' }}" @click="closeMobile()">
                  <i class="fa-solid fa-images"></i>
                  <span>Gallery</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link px-3.5 py-2 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('contact') ? 'active text-[#800020] font-bold bg-[#800020]/10' : 'text-slate-600 hover:text-[#800020] hover:bg-[#800020]/5' }}" @click="closeMobile()">Kontak</a></li>
        </ul>
        <div class="nav-mobile-cta">
          <a href="https://wa.me/{{ $cleanWaNumber }}?text={{ rawurlencode('Halo Nirwana Tour, saya ingin konsultasi perjalanan.') }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm wa-link-btn inline-flex items-center gap-2 bg-[#800020] hover:bg-[#630018] text-white font-semibold px-4 py-2 rounded-xl text-sm transition-all" data-wa-msg="Halo Nirwana Tour, saya ingin konsultasi perjalanan.">
            <i class="fa-brands fa-whatsapp text-emerald-400"></i> Chat WhatsApp
          </a>
        </div>
      </nav>

      <!-- Header CTA & Mobile Toggle -->
      <div class="header-actions flex items-center gap-3">
        <a href="https://wa.me/{{ $cleanWaNumber }}?text={{ rawurlencode('Halo Nirwana Tour, saya ingin konsultasi perjalanan.') }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm desktop-only wa-link-btn inline-flex items-center gap-2 bg-[#800020] hover:bg-[#630018] text-white font-semibold px-4 py-2.5 rounded-xl text-sm transition-all shadow-sm hover:shadow" data-wa-msg="Halo Nirwana Tour, saya ingin konsultasi perjalanan.">
          <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i> Rencanakan Perjalanan
        </a>
        <button class="nav-toggle" id="navToggle" type="button" @click="toggleMobile()" :class="{ 'active': mobileOpen }" :aria-expanded="mobileOpen" aria-label="Buka menu navigasi" aria-controls="navMenu">
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
  <footer class="site-footer bg-[#800020] text-slate-100 pt-16 pb-12 overflow-hidden border-t-4 border-[#F59E0B]">
    <div class="container footer-container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="footer-top mb-12">
        <div class="footer-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
          <!-- Col 1: Brand & Bio -->
          <div class="footer-col col-brand lg:col-span-2">
            <a href="{{ route('home') }}#hero" class="footer-logo inline-flex items-center gap-3 mb-4 text-decoration-none" aria-label="Nirwana Tour Lampung">
              <img src="{{ asset('assets/logo/Logo-Nirwana.png') }}" alt="Nirwana Tour Lampung" class="footer-logo-emblem h-12 w-12 object-contain">
              <div class="footer-brand-text flex flex-col">
                <span class="footer-brand-title text-xl font-bold text-white tracking-tight">Nirwana <span class="highlight text-[#F59E0B]">Tour Travel</span></span>
                <span class="footer-brand-sub text-xs text-slate-300">Jelajahi Dunia, Ciptakan Cerita Tak Terlupakan</span>
              </div>
            </a>
            <p class="footer-bio text-sm text-slate-300 leading-relaxed mb-5 max-w-md">
              Nirwana Tour Lampung adalah biro perjalanan wisata tepercaya yang melayani paket wisata nusantara, study tour, gathering perusahaan, dan transportasi pariwisata berkelas di Provinsi Lampung.
            </p>
            <div class="footer-legal-badge inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-white/10 text-white border border-white/20 mb-6">
              <span>Biro Perjalanan Wisata Resmi Terdaftar</span>
            </div>
            <div class="footer-cert-logos flex items-center gap-4 flex-wrap">
              <div class="footer-cert-item bg-white/90 p-2 rounded-lg" title="Wonderful Indonesia">
                <img src="{{ asset('assets/images/wonderful.png') }}" alt="Wonderful Indonesia" class="footer-cert-logo h-7 object-contain">
              </div>
              <div class="footer-cert-item bg-white/90 p-2 rounded-lg" title="Pariwisata Lampung">
                <img src="{{ asset('assets/images/lampung.png') }}" alt="Pariwisata Lampung" class="footer-cert-logo h-7 object-contain">
              </div>
              <div class="footer-cert-item bg-white/90 p-2 rounded-lg" title="ASITA (Association of The Indonesian Tour and Travel Agencies)">
                <img src="{{ asset('assets/images/asita.png') }}" alt="ASITA" class="footer-cert-logo h-7 object-contain">
              </div>
            </div>
          </div>

          <!-- Col 2: Layanan Populer -->
          <div class="footer-col">
            <h4 class="footer-title text-lg font-bold text-white mb-5 flex items-center gap-2">Layanan Unggulan</h4>
            <ul class="footer-links list-none p-0 m-0 space-y-2.5 text-sm">
              @if(isset($footerServices) && $footerServices->isNotEmpty())
                @foreach($footerServices as $fService)
                  <li>
                    <a href="{{ route('services.show', $fService->slug) }}" class="text-slate-300 hover:text-white transition-colors flex items-center gap-2">
                      <i class="fa-solid fa-angle-right text-xs text-[#F59E0B]"></i> {{ $fService->title }}
                    </a>
                  </li>
                @endforeach
                <li>
                  <a href="{{ route('services.index') }}" class="font-semibold text-[#F59E0B] hover:text-white transition-colors flex items-center gap-2">
                    <i class="fa-solid fa-arrow-right text-xs"></i> Lihat Semua Layanan
                  </a>
                </li>
              @else
                <li><a href="{{ route('services.show', 'paket-wisata-domestik-lampung') }}" class="text-slate-300 hover:text-white transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-[#F59E0B]"></i> Paket Wisata Domestik & Lampung</a></li>
                <li><a href="{{ route('services.show', 'study-tour-field-trip-sekolah') }}" class="text-slate-300 hover:text-white transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-[#F59E0B]"></i> Study Tour & Field Trip Sekolah</a></li>
                <li><a href="{{ route('services.show', 'family-gathering-corporate-event') }}" class="text-slate-300 hover:text-white transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-[#F59E0B]"></i> Family Gathering & Corporate Event</a></li>
                <li><a href="{{ route('services.show', 'sewa-bus-transportasi-pariwisata') }}" class="text-slate-300 hover:text-white transition-colors flex items-center gap-2"><i class="fa-solid fa-angle-right text-xs text-[#F59E0B]"></i> Sewa Bus & Transportasi Pariwisata</a></li>
                <li><a href="{{ route('services.index') }}" class="font-semibold text-[#F59E0B] hover:text-white transition-colors flex items-center gap-2"><i class="fa-solid fa-arrow-right text-xs"></i> Lihat Semua Layanan</a></li>
              @endif
            </ul>
          </div>

          <!-- Col 4: Hubungi Kami -->
          <div class="footer-col col-contact">
            <h4 class="footer-title text-lg font-bold text-white mb-5 flex items-center gap-2">Kontak & Reservasi</h4>
            <ul class="footer-contact-info list-none p-0 m-0 space-y-3 text-sm text-slate-300 mb-6">
              <li class="flex items-start gap-2.5">
                <i class="fa-solid fa-location-dot text-[#F59E0B] mt-1"></i>
                <a href="https://maps.google.com/?q={{ urlencode($settings['address'] ?? 'Jl. Pangeran Antasari No. 88, Kedamaian, Kota Bandar Lampung, Lampung 35122') }}" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   title="Buka Lokasi di Google Maps"
                   class="hover:text-white transition-colors leading-relaxed">
                  {{ $settings['address'] ?? 'Jl. Pangeran Antasari No. 88, Kedamaian, Kota Bandar Lampung, Lampung 35122' }}
                </a>
              </li>
              <li class="flex items-center gap-2.5">
                <i class="fa-brands fa-whatsapp text-emerald-400"></i>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188') }}?text={{ rawurlencode('Halo Nirwana Tour, saya ingin konsultasi perjalanan.') }}" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="hover:text-white transition-colors">
                  +{{ $settings['whatsapp_number'] ?? '6282269616188' }}
                </a>
              </li>
              <li class="flex items-center gap-2.5">
                <i class="fa-solid fa-envelope text-[#F59E0B]"></i>
                <a href="mailto:{{ $settings['email'] ?? 'info@nirwanatourlampung.com' }}" class="hover:text-white transition-colors">{{ $settings['email'] ?? 'info@nirwanatourlampung.com' }}</a>
              </li>
            </ul>

            <!-- Google Maps Embed Footer Widget -->
            <div class="footer-map-box mb-5 rounded-xl overflow-hidden border border-white/15 shadow-md">
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
                 class="flex items-center justify-center gap-2 py-2 px-3 bg-white/10 hover:bg-white/15 text-slate-200 text-xs font-semibold border-t border-white/10 transition-colors">
                <i class="fa-solid fa-map-location-dot text-[#F59E0B]"></i>
                <span>Petunjuk Arah Google Maps</span>
              </a>
            </div>

            <h5 class="social-header-title text-xs font-bold uppercase tracking-wider text-slate-300 mb-3">Ikuti Kami</h5>
            <div class="footer-social-icons flex items-center gap-3">
              <a href="{{ $settings['instagram'] ?? 'https://www.instagram.com/nirwana_tourlampung/?utm_source=ig_web_button_share_sheet' }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#F59E0B] text-white flex items-center justify-center transition-all"><i class="fa-brands fa-instagram"></i></a>
              <a href="{{ $settings['tiktok'] ?? 'https://www.tiktok.com/@nirwana_tour_travel?is_from_webapp=1&sender_device=pc' }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#F59E0B] text-white flex items-center justify-center transition-all"><i class="fa-brands fa-tiktok"></i></a>
              <a href="{{ $settings['youtube'] ?? 'https://youtube.com/@nirwanatourlampung?si=ZMFi9b5dvpn0NKfr' }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#F59E0B] text-white flex items-center justify-center transition-all"><i class="fa-brands fa-youtube"></i></a>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer Bottom Copyright -->
      <div class="footer-bottom border-t border-white/10 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-400">
        <p>&copy; <span id="currentYear">{{ date('Y') }}</span> <strong class="text-white">Nirwana Tour Lampung</strong>. Hak Cipta Dilindungi Undang-Undang.</p>
        <p class="footer-tagline">Dibuat oleh <a href="https://www.instagram.com/swiftcode.lpg?utm_source=ig_web_button_share_sheet&rpxt=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer" class="text-slate-300 hover:text-white underline">Swift Code Lampung</a></p>
      </div>
    </div>
  </footer>

  <!-- ========================================================
       FLOATING WHATSAPP MULTI-LAYANAN CONCIERGE WIDGET
       ======================================================== -->
  @php
    $cleanWaNumber = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188');
  @endphp
  <div class="floating-wa-wrapper" id="floatingWA" x-data="floatingWhatsApp" @click.outside="close()">
    <!-- Pop-up Multi-Channel Concierge Card -->
    <div class="wa-concierge-card" id="waConciergeCard" :style="open ? 'display: block;' : 'display: none;'">
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
        <button type="button" class="wa-concierge-close" id="waConciergeClose" @click="close()" aria-label="Tutup Menu WhatsApp">
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
    <div class="floating-wa-bubble" id="floatingWABubble" :style="open ? 'opacity: 0;' : ''">
      <span>Butuh bantuan liburan? Chat kami!</span>
    </div>

    <!-- Toggle Button -->
    <button type="button" class="floating-wa-btn" id="floatingWABtn" @click="toggle()" aria-label="Buka Chat WhatsApp Konsultan" :aria-expanded="open" style="border: none; cursor: pointer;">
      <i class="fa-brands fa-whatsapp" id="floatingWAIcon"></i>
      <span class="online-indicator"></span>
    </button>
  </div>

  <!-- Back to top button -->
  <button class="back-to-top" id="backToTop" :class="{ 'show': showBackToTop }" @click="scrollToTop()" aria-label="Kembali ke atas">
    <i class="fa-solid fa-arrow-up"></i>
  </button>


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
