<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Nirwana Tour Lampung - Jelajahi Dunia, Ciptakan Cerita')</title>
  <meta name="description" content="@yield('meta_description', 'Biro perjalanan wisata resmi di Lampung. Melayani paket wisata Lampung & Nusantara, study tour sekolah, gathering perusahaan, dan sewa transportasi pariwisata.')">
  <meta name="keywords" content="Nirwana Tour Lampung, Tour Lampung, Paket Wisata Lampung, Wisata Pahawang, Teluk Kiluan, Gigi Hiu, Sewa Bus Lampung, Study Tour Lampung">
  <meta name="author" content="Nirwana Tour Lampung">
  
  <!-- Open Graph / Meta Sosial -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="@yield('title', 'Nirwana Tour Lampung - Jelajahi Dunia, Ciptakan Cerita')">
  <meta property="og:description" content="@yield('meta_description', 'Paket wisata Lampung, study tour sekolah, gathering instansi, dan sewa armada bus pariwisata terpercaya.')">
  <meta property="og:image" content="@yield('og_image', asset('assets/images/hero/hero-bg.jpg'))">
  
  <!-- Favicon & Theme Color -->
  <link rel="icon" type="image/png" href="{{ asset('assets/logo/Logo-Nirwana.png') }}">
  <meta name="theme-color" content="#800020">
  
  <!-- Google Fonts: Plus Jakarta Sans & Playfair Display -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,500;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <!-- Stylesheet -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  @stack('styles')
</head>
<body>

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
          <a href="#" class="btn btn-primary btn-sm wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin konsultasi perjalanan.">
            <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
          </a>
        </div>
      </nav>

      <!-- Header CTA & Mobile Toggle -->
      <div class="header-actions">
        <a href="#" class="btn btn-primary btn-sm desktop-only wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin konsultasi perjalanan.">
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
              <li><a href="{{ route('packages.show', 'pulau-pahawang-snorkeling-paradise') }}"><i class="fa-solid fa-angle-right"></i> Trip Pulau Pahawang</a></li>
              <li><a href="{{ route('packages.show', 'teluk-kiluan-dolphin-tour') }}"><i class="fa-solid fa-angle-right"></i> Dolphin Safari Teluk Kiluan</a></li>
              <li><a href="{{ route('packages.show', 'pantai-gigi-hiu-eksotisme-karang') }}"><i class="fa-solid fa-angle-right"></i> Tour Tebing Gigi Hiu</a></li>
              <li><a href="{{ route('services.show', 'study-tour-field-trip-sekolah') }}"><i class="fa-solid fa-angle-right"></i> Study Tour Sekolah TK-SMA</a></li>
              <li><a href="{{ route('services.show', 'family-gathering-corporate-event') }}"><i class="fa-solid fa-angle-right"></i> Outbound & Gathering Kantor</a></li>
              <li><a href="{{ route('services.show', 'sewa-bus-transportasi-pariwisata') }}"><i class="fa-solid fa-angle-right"></i> Sewa Bus & HiAce Lampung</a></li>
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
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127118.81423406987!2d105.18788934440026!3d-5.419086111369344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40da4290c58e77%3A0xb696f5341cf60f4e!2sBandar%20Lampung%2C%20Kota%20Bandar%20Lampung%2C%20Lampung!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
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
       FLOATING WHATSAPP BUTTON (TITIK KONVERSI UTAMA)
       ======================================================== -->
  <div class="floating-wa-wrapper" id="floatingWA">
    <div class="floating-wa-bubble">
      <span>Butuh bantuan liburan? Chat kami!</span>
    </div>
    <a href="#" class="floating-wa-btn wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin konsultasi perjalanan." aria-label="Chat WhatsApp Admin">
      <i class="fa-brands fa-whatsapp"></i>
      <span class="online-indicator"></span>
    </a>
  </div>

  <!-- Back to top button -->
  <button class="back-to-top" id="backToTop" aria-label="Kembali ke atas">
    <i class="fa-solid fa-arrow-up"></i>
  </button>

  <!-- Script JS -->
  <script src="{{ asset('js/script.js') }}"></script>
  @stack('scripts')
</body>
</html>
