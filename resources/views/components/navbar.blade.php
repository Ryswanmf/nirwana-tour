<header class="site-header" id="header">
  <div class="header-container container">
    <!-- Logo Brand -->
    <a href="{{ route('home') }}" class="brand-logo" aria-label="Nirwana Tour Lampung Beranda">
      <img src="{{ asset('assets/logo/Logo-Nirwana.png') }}" alt="Nirwana Tour Lampung" class="logo-emblem">
      <div class="brand-text">
        <span class="brand-title">Nirwana <strong>Tour Travel</strong></span>
        <span class="brand-sub">Jelajahi Dunia, Ciptakan Cerita Tak Terlupakan</span>
      </div>
    </a>

    <!-- Desktop Navigation Menu -->
    <nav class="nav-menu" id="navMenu" aria-label="Navigasi Utama">
      <ul class="nav-list">
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('packages.index') }}" class="nav-link {{ request()->routeIs('packages.*') ? 'active' : '' }}">Paket Wisata</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('services.index') }}" class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}">Layanan</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('posts.index') }}" class="nav-link {{ request()->routeIs('posts.*') ? 'active' : '' }}">Berita</a>
        </li>
        <li class="nav-item nav-dropdown" x-data="{ dropdownOpen: false }" :class="{ 'open': dropdownOpen }" @click.outside="dropdownOpen = false">
          <a href="javascript:void(0)" class="nav-link nav-dropdown-toggle {{ request()->routeIs('profile') || request()->routeIs('management') || request()->routeIs('certificates') || request()->routeIs('about') || request()->routeIs('gallery.*') ? 'active' : '' }}" id="tentangDropdownComponent" role="button" @click.prevent.stop="dropdownOpen = !dropdownOpen" :aria-expanded="dropdownOpen" aria-haspopup="true">
            <span>Tentang</span>
            <i class="fa-solid fa-chevron-down dropdown-arrow transition-transform duration-200" :class="{ 'rotate-180': dropdownOpen }"></i>
          </a>
          <ul class="dropdown-menu" :class="{ 'open': dropdownOpen }" aria-labelledby="tentangDropdownComponent">
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
        <li class="nav-item">
          <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Kontak</a>
        </li>
      </ul>
      <div class="nav-mobile-cta">
        @php
          $cleanWa = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188');
        @endphp
        <a href="https://wa.me/{{ $cleanWa }}?text={{ rawurlencode('Halo Nirwana Tour, saya ingin konsultasi perjalanan.') }}"
           class="btn btn-primary btn-sm" target="_blank" rel="noopener noreferrer">
          <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
        </a>
      </div>
    </nav>

    <!-- Header Actions (CTA & Mobile Toggle) -->
    <div class="header-actions">
      @php
        $cleanWa = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188');
      @endphp
      <a href="https://wa.me/{{ $cleanWa }}?text={{ rawurlencode('Halo Nirwana Tour, saya ingin konsultasi perjalanan.') }}"
         class="btn btn-primary btn-sm nav-cta-desktop" target="_blank" rel="noopener noreferrer">
        <i class="fa-brands fa-whatsapp"></i> Konsultasi
      </a>

      <!-- Hamburger Button -->
      <button class="hamburger-btn" id="hamburgerBtn" aria-label="Toggle Menu" aria-expanded="false" aria-controls="navMenu">
        <span class="hamburger-bar"></span>
        <span class="hamburger-bar"></span>
        <span class="hamburger-bar"></span>
      </button>
    </div>
  </div>
</header>
