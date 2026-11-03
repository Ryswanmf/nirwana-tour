<div class="nirwana-auth-container">
  <!-- FontAwesome 6 for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    /* Kunci layar agar pas 100vh tanpa scroll di desktop */
    html, body {
      height: 100vh !important;
      max-height: 100vh !important;
      overflow: hidden !important;
      margin: 0 !important;
      padding: 0 !important;
    }

    .nirwana-auth-container {
      display: flex;
      height: 100vh !important;
      max-height: 100vh !important;
      width: 100vw;
      overflow: hidden !important;
      background: #FFFFFF;
      font-family: var(--font-family, 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif);
      color: #0F172A;
    }

    /* ========================================================
       PANEL KIRI (SHOWCASE BRAND & DESTINASI)
       ======================================================== */
    .nirwana-auth-banner {
      position: relative;
      width: 48%;
      height: 100vh !important;
      max-height: 100vh !important;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 40px 48px;
      box-sizing: border-box;
      overflow: hidden;
      color: #FFFFFF;
      background-color: #4A0012;
    }

    .nirwana-auth-banner-bg {
      position: absolute;
      inset: 0;
      background-image: url('{{ asset("assets/images/destinasi/pahawang.jpg") }}');
      background-size: cover;
      background-position: center;
      filter: saturate(1.15);
      z-index: 1;
    }

    .nirwana-auth-banner-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(150deg, rgba(15, 23, 42, 0.94) 0%, rgba(128, 0, 32, 0.90) 55%, rgba(60, 0, 15, 0.96) 100%);
      z-index: 2;
    }

    .nirwana-auth-banner-content {
      position: relative;
      z-index: 3;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 100%;
    }

    /* Brand Header Kiri */
    .banner-brand {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .banner-logo {
      height: 48px;
      width: auto;
      object-fit: contain;
      filter: drop-shadow(0 4px 8px rgba(0,0,0,0.25));
    }

    .banner-brand-title {
      display: block;
      font-size: 1.25rem;
      font-weight: 800;
      letter-spacing: 0.5px;
      color: #FFFFFF;
      line-height: 1.1;
    }

    .banner-brand-sub {
      display: block;
      font-size: 0.72rem;
      font-weight: 600;
      letter-spacing: 1.8px;
      color: #F87171;
      text-transform: uppercase;
      margin-top: 3px;
    }

    /* Teks Tengah Kiri */
    .banner-middle {
      max-width: 500px;
    }

    .banner-tag {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: 0.78rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      color: #FBBF24;
      border-left: 3px solid #FBBF24;
      padding-left: 10px;
      margin-bottom: 14px;
    }

    .banner-heading {
      font-size: clamp(1.75rem, 2.3vw, 2.3rem);
      font-weight: 800;
      line-height: 1.25;
      color: #FFFFFF;
      margin-bottom: 14px;
      letter-spacing: -0.5px;
    }

    .banner-desc {
      font-size: 0.92rem;
      line-height: 1.6;
      color: #E2E8F0;
      margin: 0;
    }

    /* Footer Kiri & Logo Sertifikasi */
    .banner-bottom {
      padding-top: 18px;
      border-top: 1px solid rgba(255, 255, 255, 0.15);
    }

    .banner-badges-label {
      display: block;
      font-size: 0.72rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1.2px;
      color: rgba(255, 255, 255, 0.7);
      margin-bottom: 10px;
    }

    .banner-badges-row {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 12px;
      flex-wrap: wrap;
    }

    .banner-cert-pill {
      background: #FFFFFF;
      border-radius: 8px;
      padding: 5px 12px;
      height: 36px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
      border: 1px solid rgba(255, 255, 255, 0.2);
      transition: transform 0.2s ease;
    }

    .banner-cert-pill:hover {
      transform: translateY(-2px);
    }

    .banner-cert-pill img {
      height: 22px;
      max-width: 80px;
      width: auto;
      object-fit: contain;
      display: block;
    }

    .banner-copyright {
      font-size: 0.78rem;
      color: #94A3B8;
      margin: 0;
    }

    /* ========================================================
       PANEL KANAN (FORM LOGIN ELEGAN & PAS 100VH)
       ======================================================== */
    .nirwana-auth-form-panel {
      width: 52%;
      height: 100vh !important;
      max-height: 100vh !important;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 28px 48px;
      box-sizing: border-box;
      background: #FFFFFF;
      overflow-y: auto;
    }

    .form-panel-header {
      display: flex;
      align-items: center;
      justify-content: flex-start;
      margin-bottom: 10px;
    }

    .back-home-link {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: 0.84rem;
      font-weight: 600;
      color: #475569;
      text-decoration: none;
      padding: 6px 14px;
      border-radius: 20px;
      background: #F8FAFC;
      border: 1px solid #E2E8F0;
      transition: all 0.2s ease;
    }

    .back-home-link:hover {
      color: #800020;
      background: #FFF5F7;
      border-color: rgba(128, 0, 32, 0.3);
      transform: translateX(-3px);
    }

    .form-panel-body {
      width: 100%;
      max-width: 400px;
      margin: auto;
      padding: 0;
    }

    .form-logo-wrap {
      margin-bottom: 8px;
      text-align: center;
    }

    .form-logo {
      height: 52px;
      width: auto;
      object-fit: contain;
      margin: 0 auto;
      filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.08));
    }

    .form-title {
      font-size: 1.45rem;
      font-weight: 800;
      color: #0F172A;
      margin-bottom: 4px;
      letter-spacing: -0.3px;
      text-align: center;
    }

    .form-subtitle {
      font-size: 0.86rem;
      color: #64748B;
      margin-bottom: 18px;
      line-height: 1.4;
      text-align: center;
    }

    /* ========================================================
       PERAPIHAN FIELD FORMULIR & PENJAJARAN LUPA SANDI
       ======================================================== */
    .nirwana-auth-form-panel .fi-form {
      display: flex !important;
      flex-direction: column !important;
      gap: 14px !important;
    }

    .nirwana-auth-form-panel .fi-fo-component-ctn {
      display: flex !important;
      flex-direction: column !important;
      gap: 14px !important;
    }

    .nirwana-auth-form-panel .fi-fo-field-wrp {
      display: flex !important;
      flex-direction: column !important;
    }

    /* Penjajaran Header Field (Label di kiri, Lupa Sandi sejajar di kanan) */
    .nirwana-auth-form-panel [data-field-wrapper] > div > .flex {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      width: 100% !important;
      margin-bottom: 6px !important;
    }

    .nirwana-auth-form-panel .fi-fo-field-wrp-label {
      width: auto !important;
      margin: 0 !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 4px !important;
    }

    .nirwana-auth-form-panel .fi-fo-field-wrp-label span {
      font-size: 0.88rem !important;
      font-weight: 700 !important;
      color: #1E293B !important;
      letter-spacing: -0.1px !important;
      line-height: 1.4 !important;
    }

    .nirwana-auth-form-panel .fi-fo-field-wrp-label sup {
      color: #DC2626 !important;
      font-weight: 700 !important;
      margin-left: 2px !important;
    }

    .nirwana-auth-form-panel .fi-fo-field-wrp-hint {
      margin: 0 !important;
      display: inline-flex !important;
      align-items: center !important;
    }

    .nirwana-auth-form-panel .fi-fo-field-wrp-hint a {
      font-size: 0.82rem !important;
      font-weight: 700 !important;
      color: #800020 !important;
      text-decoration: none !important;
      display: inline-flex !important;
      align-items: center !important;
      line-height: 1.4 !important;
      transition: color 0.2s ease, text-decoration 0.2s ease !important;
    }

    .nirwana-auth-form-panel .fi-fo-field-wrp-hint a:hover {
      color: #B91C1C !important;
      text-decoration: underline !important;
    }

    /* Input Field Container Modern & Elegan */
    .nirwana-auth-form-panel .fi-input-wrp {
      background-color: #F8FAFC !important;
      border: 1.5px solid #E2E8F0 !important;
      border-radius: 12px !important;
      height: 44px !important;
      box-shadow: none !important;
      transition: all 0.2s ease !important;
      display: flex !important;
      align-items: center !important;
      overflow: hidden !important;
    }

    .nirwana-auth-form-panel .fi-input-wrp:hover {
      border-color: #CBD5E1 !important;
      background-color: #FFFFFF !important;
    }

    .nirwana-auth-form-panel .fi-input-wrp:focus-within {
      border-color: #800020 !important;
      background-color: #FFFFFF !important;
      box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.12) !important;
    }

    .nirwana-auth-form-panel .fi-input {
      font-size: 0.9rem !important;
      color: #0F172A !important;
      padding: 0 14px !important;
      background: transparent !important;
      height: 100% !important;
      border: none !important;
      outline: none !important;
      box-shadow: none !important;
    }

    .nirwana-auth-form-panel .fi-input::placeholder {
      color: #94A3B8 !important;
      font-size: 0.86rem !important;
    }

    .nirwana-auth-form-panel .fi-input-wrp-suffix {
      border-inline-start: 1px solid #E2E8F0 !important;
      padding-right: 10px !important;
      padding-left: 10px !important;
      display: flex !important;
      align-items: center !important;
      height: 100% !important;
    }

    .nirwana-auth-form-panel .fi-icon-btn {
      color: #64748B !important;
      transition: color 0.2s ease !important;
    }

    .nirwana-auth-form-panel .fi-icon-btn:hover {
      color: #800020 !important;
    }

    /* Checkbox Ingat Saya */
    .nirwana-auth-form-panel .fi-fo-checkbox {
      margin-top: 2px !important;
    }

    .nirwana-auth-form-panel .fi-fo-checkbox label {
      font-size: 0.84rem !important;
      font-weight: 500 !important;
      color: #475569 !important;
      cursor: pointer !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 8px !important;
    }

    .nirwana-auth-form-panel input[type="checkbox"] {
      border-radius: 4px !important;
      border: 1.5px solid #CBD5E1 !important;
      width: 16px !important;
      height: 16px !important;
      color: #800020 !important;
      cursor: pointer !important;
    }

    /* Tombol Submit Login */
    .nirwana-auth-form-panel .fi-form-actions {
      margin-top: 4px !important;
    }

    .nirwana-auth-form-panel .fi-btn {
      width: 100% !important;
      height: 44px !important;
      border-radius: 12px !important;
      background: linear-gradient(135deg, #800020 0%, #630018 100%) !important;
      color: #FFFFFF !important;
      font-size: 0.94rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.2px !important;
      box-shadow: 0 6px 18px rgba(128, 0, 32, 0.25) !important;
      border: none !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 8px !important;
      transition: all 0.25s ease !important;
      cursor: pointer !important;
    }

    .nirwana-auth-form-panel .fi-btn:hover {
      background: linear-gradient(135deg, #630018 0%, #4A0012 100%) !important;
      transform: translateY(-2px) !important;
      box-shadow: 0 10px 24px rgba(128, 0, 32, 0.35) !important;
    }

    .nirwana-auth-form-panel .fi-btn:active {
      transform: translateY(0) !important;
    }

    /* ========================================================
       BANTUAN AKSES WHATSAPP (SLIM & ELEGAN)
       ======================================================== */
    .login-help-section {
      margin-top: 16px;
    }

    .login-help-divider {
      position: relative;
      text-align: center;
      margin-bottom: 12px;
    }

    .login-help-divider::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 0;
      right: 0;
      height: 1px;
      background: #E2E8F0;
      z-index: 1;
    }

    .login-help-divider span {
      position: relative;
      z-index: 2;
      background: #FFFFFF;
      padding: 0 10px;
      font-size: 0.74rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      color: #94A3B8;
    }

    .wa-pill-btn {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 8px 12px;
      background: #F0FDF4;
      border: 1px solid #BBF7D0;
      border-radius: 12px;
      text-decoration: none;
      transition: all 0.25s ease;
    }

    .wa-pill-btn:hover {
      background: #DCFCE7;
      border-color: #86EFAC;
      transform: translateY(-1px);
      box-shadow: 0 4px 10px rgba(22, 163, 74, 0.12);
    }

    .wa-pill-icon {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      background: #16A34A;
      color: #FFFFFF;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      flex-shrink: 0;
      box-shadow: 0 2px 4px rgba(22, 163, 74, 0.2);
    }

    .wa-pill-content {
      display: flex;
      flex-direction: column;
      text-align: left;
      flex-grow: 1;
    }

    .wa-pill-label {
      font-size: 0.74rem;
      font-weight: 600;
      color: #166534;
      line-height: 1.3;
    }

    .wa-pill-number {
      font-size: 0.88rem;
      font-weight: 800;
      color: #14532D;
      line-height: 1.2;
    }

    .wa-pill-arrow {
      color: #16A34A;
      font-size: 0.76rem;
      transition: transform 0.2s ease;
    }

    .wa-pill-btn:hover .wa-pill-arrow {
      transform: translateX(3px);
    }

    .form-panel-footer {
      font-size: 0.78rem;
      color: #94A3B8;
      padding-top: 12px;
      margin-top: 12px;
      border-top: 1px solid #F1F5F9;
      text-align: center;
    }

    /* ========================================================
       RESPONSIVE (TABLET & MOBILE)
       ======================================================== */
    @media (max-width: 1024px) {
      html, body {
        height: auto !important;
        overflow: auto !important;
      }
      .nirwana-auth-container {
        height: auto !important;
        overflow: auto !important;
      }
      .nirwana-auth-banner {
        display: none;
      }
      .nirwana-auth-form-panel {
        width: 100%;
        height: auto !important;
        min-height: 100vh;
        padding: 32px 20px;
        overflow: auto;
      }
    }
  </style>

  <!-- Panel Kiri: Showcase Brand & Destinasi Lampung -->
  <div class="nirwana-auth-banner">
    <div class="nirwana-auth-banner-bg"></div>
    <div class="nirwana-auth-banner-overlay"></div>
    
    <div class="nirwana-auth-banner-content">
      <!-- Top Logo -->
      <div class="banner-brand">
        <img src="{{ asset('assets/logo/Logo-Nirwana.png') }}" alt="Logo Nirwana Tour" class="banner-logo">
        <div>
          <span class="banner-brand-title">NIRWANA TOUR</span>
          <span class="banner-brand-sub">Lampung &bull; Indonesia</span>
        </div>
      </div>

      <!-- Center Text -->
      <div class="banner-middle">
        <div class="banner-tag">
          <i class="fa-solid fa-compass"></i> Panel Pengelola Resmi
        </div>
        <h1 class="banner-heading">Kelola Perjalanan Terbaik, Hadirkan Cerita Tak Terlupakan</h1>
        <p class="banner-desc">
          Sistem manajemen terpadu Nirwana Tour & Travel Lampung untuk mengelola katalog paket wisata, reservasi WhatsApp, artikel berita, dan armada pariwisata.
        </p>
      </div>

      <!-- Bottom Badges Rapi & Hak Cipta -->
      <div class="banner-bottom">
        <span class="banner-badges-label">Sertifikasi & Kemitraan Resmi</span>
        <div class="banner-badges-row">
          <div class="banner-cert-pill" title="Wonderful Indonesia - Kementerian Pariwisata RI">
            <img src="{{ asset('assets/images/wonderful.png') }}" alt="Wonderful Indonesia" loading="lazy" decoding="async">
          </div>
          <div class="banner-cert-pill" title="Pariwisata Provinsi Lampung">
            <img src="{{ asset('assets/images/lampung.png') }}" alt="Pariwisata Lampung" loading="lazy" decoding="async">
          </div>
          <div class="banner-cert-pill" title="ASITA (Association of The Indonesian Tour and Travel Agencies)">
            <img src="{{ asset('assets/images/asita.png') }}" alt="ASITA" loading="lazy" decoding="async">
          </div>
        </div>
        <p class="banner-copyright">&copy; {{ date('Y') }} Nirwana Tour & Travel Lampung. Hak cipta dilindungi.</p>
      </div>
    </div>
  </div>

  <!-- Panel Kanan: Form Login Modern, Rapi & Sejajar -->
  <div class="nirwana-auth-form-panel">
    <div class="form-panel-header">
      <a href="{{ route('home') }}" class="back-home-link">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Website
      </a>
    </div>

    <div class="form-panel-body">
      <div class="form-logo-wrap">
        <img src="{{ asset('assets/logo/Logo-Nirwana.png') }}" alt="Logo Nirwana Tour" class="form-logo">
      </div>
      <h2 class="form-title">Masuk ke Panel Pengelola</h2>
      <p class="form-subtitle">Silakan masukkan akun email dan kata sandi Anda</p>

      <!-- Form Livewire Filament -->
      <x-filament-panels::form id="form" wire:submit="authenticate">
        {{ $this->form }}

        <x-filament-panels::form.actions
          :actions="$this->getCachedFormActions()"
          :full-width="true"
        />
      </x-filament-panels::form>

      <!-- Seksi Bantuan WhatsApp Slim & Elegan -->
      <div class="login-help-section">
        <div class="login-help-divider">
          <span>Bantuan Pemulihan Akun</span>
        </div>

        <a href="https://wa.me/6289515915699?text=Halo%20Admin%20Nirwana%20Tour%2C%20saya%20membutuhkan%20bantuan%20reset%20kata%20sandi%20akun%20CMS%20Nirwana." 
           target="_blank" 
           rel="noopener noreferrer" 
           class="wa-pill-btn">
          <div class="wa-pill-icon">
            <i class="fa-brands fa-whatsapp"></i>
          </div>
          <div class="wa-pill-content">
            <span class="wa-pill-label">Lupa kata sandi? Chat WhatsApp Admin</span>
            <span class="wa-pill-number">0895-1591-5699</span>
          </div>
          <i class="fa-solid fa-chevron-right wa-pill-arrow"></i>
        </a>
      </div>
    </div>

    <div class="form-panel-footer">
      <p style="margin: 0;">Nirwana Tour & Travel Lampung &bull; Sistem Panel CMS Terpadu</p>
    </div>
  </div>

  @if (! $this instanceof \Filament\Tables\Contracts\HasTable)
    <x-filament-actions::modals />
  @endif
</div>
