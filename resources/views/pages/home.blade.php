@extends('layouts.app')

@section('title', 'Nirwana Tour Lampung - Jelajahi Dunia, Ciptakan Cerita')

@section('content')
  <main>
    <!-- ========================================================
         2. HERO SECTION
         ======================================================== -->
    <section class="hero-section" id="hero">
      <div class="hero-overlay"></div>
      <div class="container hero-container">
        <div class="hero-content">
          <div class="hero-badge">
            Biro Perjalanan Wisata Resmi Lampung
          </div>
          <h1 class="hero-title">
            Selamat Datang di Website <br>
            <span class="text-gradient">Nirwana Tour and Travel</span> Lampung
          </h1>
          <p class="hero-description">
            Wujudkan momen liburan terbaik Anda bersama Nirwana Tour Lampung. Kami menghadirkan paket wisata eksotis, study tour edukatif, gathering perusahaan, serta persewaan armada transportasi nyaman dan profesional.
          </p>
          <div class="hero-buttons">
            <a href="#" class="btn btn-whatsapp btn-lg wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin konsultasi perjalanan.">
              <i class="fa-brands fa-whatsapp"></i> Konsultasi via WhatsApp
            </a>
            <a href="#destinasi" class="btn btn-outline btn-lg">
              <i class="fa-solid fa-map-location-dot"></i> Lihat Destinasi
            </a>
          </div>

          <!-- Hero Highlights / Mini Badges -->
          <div class="hero-features">
            <div class="hero-feature-item">
              <i class="fa-solid fa-shield-halved"></i>
              <span>Legalitas Berizin Resmi</span>
            </div>
            <div class="hero-feature-item">
              <i class="fa-solid fa-bus-simple"></i>
              <span>Armada Bus Nyaman & Terawat</span>
            </div>
            <div class="hero-feature-item">
              <i class="fa-solid fa-user-tie"></i>
              <span>Tour Leader Berpengalaman</span>
            </div>
          </div>
        </div>

        <!-- Hero Visual (Transparent Cutout) -->
        <div class="hero-visual">
          <div class="hero-image-wrapper">
            <img src="{{ asset('assets/images/hero-right.png') }}" alt="Armada Wisata Nirwana Tour Lampung" class="hero-image-cutout">
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
          
          <!-- ================= BARIS 1 (ATAS) ================= -->
          <div class="mitra-marquee-wrap">
            <div class="mitra-track track-left">
              <!-- SET 1 (BARIS 1) -->
              <!-- 1. Telkom Indonesia -->
              <div class="mitra-card">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="18" cy="18" r="16" fill="#FEE2E2"/>
                    <path d="M18 6C11.37 6 6 11.37 6 18C6 24.63 11.37 30 18 30C23.18 30 27.58 26.71 29.21 22.1H24.5C23.23 24.67 20.82 26.2 18 26.2C13.47 26.2 9.8 22.53 9.8 18C9.8 13.47 13.47 9.8 18 9.8C20.61 9.8 22.86 11.02 24.28 12.92L27.65 10.42C25.43 7.7 21.94 6 18 6Z" fill="#DC2626"/>
                    <circle cx="19" cy="18" r="4.5" fill="#475569"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">PT Telkom Indonesia</span>
                  <span class="mitra-sub">BUMN Telekomunikasi</span>
                </div>
              </div>

              <!-- 2. Bank Mandiri -->
              <div class="mitra-card">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#00387A"/>
                    <path d="M8 22V14H11.5L14 18.5L16.5 14H20V22H17.5V17.2L15 21.2H13L10.5 17.2V22H8Z" fill="#FFFFFF"/>
                    <path d="M19 13C22 13 25.5 14.5 28 17.5C25.5 18.5 22.5 18 20 16.5C18.5 15.6 18 14 19 13Z" fill="#F59E0B"/>
                    <path d="M21 17C24 17 27.5 19 29 22C26.5 22.5 23.5 21.5 21.5 19.8C20.5 19 20 17.8 21 17Z" fill="#FBBF24"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">Bank Mandiri (Persero)</span>
                  <span class="mitra-sub">BUMN Perbankan</span>
                </div>
              </div>

              <!-- 3. Universitas Lampung (UNILA) -->
              <div class="mitra-card">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#ECFDF5"/>
                    <path d="M18 5L28 9V17C28 23.5 23.7 28.5 18 31C12.3 28.5 8 23.5 8 17V9L18 5Z" fill="#047857"/>
                    <path d="M18 8L25.5 11.2V17C25.5 22 22.2 26 18 28.2C13.8 26 10.5 22 10.5 17V11.2L18 8Z" fill="#065F46"/>
                    <path d="M18 11C18.8 12.2 19.5 13.5 18 15C16.5 13.5 17.2 12.2 18 11Z" fill="#F59E0B"/>
                    <path d="M14 19C15.5 18 17 18.5 18 19.5C19 18.5 20.5 18 22 19V24C20.5 23 19 23.5 18 24.5C17 23.5 15.5 23 14 24V19Z" fill="#FBBF24"/>
                    <rect x="17.2" y="15" width="1.6" height="4" rx="0.8" fill="#F59E0B"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">Universitas Lampung</span>
                  <span class="mitra-sub">Perguruan Tinggi Negeri</span>
                </div>
              </div>

              <!-- 4. PT PLN (Persero) -->
              <div class="mitra-card">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#FEF9C3"/>
                    <path d="M18 5L29 11V23L18 31L7 23V11L18 5Z" fill="#FACC15" stroke="#EAB308" stroke-width="1.2"/>
                    <path d="M10 20C12 18.5 14 21.5 16 20C18 18.5 20 21.5 22 20C24 18.5 25 20 26 19.5" stroke="#0284C7" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M19.5 8L12.5 19H17.5L15 28L24 16.5H18.5L21.5 8H19.5Z" fill="#DC2626"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">PT PLN (Persero)</span>
                  <span class="mitra-sub">BUMN Ketenagalistrikan</span>
                </div>
              </div>

              <!-- 5. PT Bukit Asam Tbk -->
              <div class="mitra-card">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#FFF1F2"/>
                    <path d="M18 6L25 18H11L18 6Z" fill="#DC2626"/>
                    <path d="M18 13L27 28H19L18 13Z" fill="#EA580C"/>
                    <path d="M18 13L9 28H17L18 13Z" fill="#B91C1C"/>
                    <circle cx="18" cy="20" r="3.5" fill="#FDE047"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">PT Bukit Asam Tbk</span>
                  <span class="mitra-sub">BUMN Pertambangan & Energi</span>
                </div>
              </div>

              <!-- 6. Dinas Pendidikan Prov. Lampung -->
              <div class="mitra-card">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#EFF6FF"/>
                    <circle cx="18" cy="18" r="14" fill="#1E40AF"/>
                    <path d="M18 8C19 10 19.5 11.5 18 13C16.5 11.5 17 10 18 8Z" fill="#F59E0B"/>
                    <path d="M18 13.5L14 17L18 20L22 17L18 13.5Z" fill="#FBBF24"/>
                    <path d="M10 16C12 18 14 20 18 20C22 20 24 18 26 16C24.5 21 21.5 25 18 26C14.5 25 11.5 21 10 16Z" fill="#F59E0B"/>
                    <circle cx="18" cy="17" r="1.5" fill="#1E40AF"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">Dinas Pendidikan Prov. Lampung</span>
                  <span class="mitra-sub">Instansi Pemerintah Daerah</span>
                </div>
              </div>

              <!-- 7. PT ASDP Indonesia Ferry -->
              <div class="mitra-card">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#0284C7"/>
                    <path d="M6 24C10 22 14 26 18 24C22 22 26 26 30 24V27C26 29 22 25 18 27C14 29 10 25 6 27V24Z" fill="#F97316"/>
                    <path d="M9 19L18 9L27 19H22L18 13L14 19H9Z" fill="#FFFFFF"/>
                    <circle cx="18" cy="18" r="2" fill="#F97316"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">PT ASDP Indonesia Ferry</span>
                  <span class="mitra-sub">BUMN Penyeberangan & Logistik</span>
                </div>
              </div>

              <!-- 8. RSUD Dr. H. Abdul Moeloek -->
              <div class="mitra-card">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#ECFDF5"/>
                    <circle cx="18" cy="18" r="13" fill="#059669"/>
                    <rect x="15" y="10" width="6" height="16" rx="2" fill="#FFFFFF"/>
                    <rect x="10" y="15" width="16" height="6" rx="2" fill="#FFFFFF"/>
                    <circle cx="18" cy="18" r="2.5" fill="#F59E0B"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">RSUD Dr. H. Abdul Moeloek</span>
                  <span class="mitra-sub">Rumah Sakit Rujukan Lampung</span>
                </div>
              </div>

              <!-- DUPLIKAT BARIS 1 (UNTUK SEAMLESS LOOP) -->
              <!-- 1. Telkom Indonesia -->
              <div class="mitra-card" aria-hidden="true">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="18" cy="18" r="16" fill="#FEE2E2"/>
                    <path d="M18 6C11.37 6 6 11.37 6 18C6 24.63 11.37 30 18 30C23.18 30 27.58 26.71 29.21 22.1H24.5C23.23 24.67 20.82 26.2 18 26.2C13.47 26.2 9.8 22.53 9.8 18C9.8 13.47 13.47 9.8 18 9.8C20.61 9.8 22.86 11.02 24.28 12.92L27.65 10.42C25.43 7.7 21.94 6 18 6Z" fill="#DC2626"/>
                    <circle cx="19" cy="18" r="4.5" fill="#475569"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">PT Telkom Indonesia</span>
                  <span class="mitra-sub">BUMN Telekomunikasi</span>
                </div>
              </div>

              <!-- 2. Bank Mandiri -->
              <div class="mitra-card" aria-hidden="true">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#00387A"/>
                    <path d="M8 22V14H11.5L14 18.5L16.5 14H20V22H17.5V17.2L15 21.2H13L10.5 17.2V22H8Z" fill="#FFFFFF"/>
                    <path d="M19 13C22 13 25.5 14.5 28 17.5C25.5 18.5 22.5 18 20 16.5C18.5 15.6 18 14 19 13Z" fill="#F59E0B"/>
                    <path d="M21 17C24 17 27.5 19 29 22C26.5 22.5 23.5 21.5 21.5 19.8C20.5 19 20 17.8 21 17Z" fill="#FBBF24"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">Bank Mandiri (Persero)</span>
                  <span class="mitra-sub">BUMN Perbankan</span>
                </div>
              </div>

              <!-- 3. Universitas Lampung (UNILA) -->
              <div class="mitra-card" aria-hidden="true">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#ECFDF5"/>
                    <path d="M18 5L28 9V17C28 23.5 23.7 28.5 18 31C12.3 28.5 8 23.5 8 17V9L18 5Z" fill="#047857"/>
                    <path d="M18 8L25.5 11.2V17C25.5 22 22.2 26 18 28.2C13.8 26 10.5 22 10.5 17V11.2L18 8Z" fill="#065F46"/>
                    <path d="M18 11C18.8 12.2 19.5 13.5 18 15C16.5 13.5 17.2 12.2 18 11Z" fill="#F59E0B"/>
                    <path d="M14 19C15.5 18 17 18.5 18 19.5C19 18.5 20.5 18 22 19V24C20.5 23 19 23.5 18 24.5C17 23.5 15.5 23 14 24V19Z" fill="#FBBF24"/>
                    <rect x="17.2" y="15" width="1.6" height="4" rx="0.8" fill="#F59E0B"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">Universitas Lampung</span>
                  <span class="mitra-sub">Perguruan Tinggi Negeri</span>
                </div>
              </div>

              <!-- 4. PT PLN (Persero) -->
              <div class="mitra-card" aria-hidden="true">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#FEF9C3"/>
                    <path d="M18 5L29 11V23L18 31L7 23V11L18 5Z" fill="#FACC15" stroke="#EAB308" stroke-width="1.2"/>
                    <path d="M10 20C12 18.5 14 21.5 16 20C18 18.5 20 21.5 22 20C24 18.5 25 20 26 19.5" stroke="#0284C7" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M19.5 8L12.5 19H17.5L15 28L24 16.5H18.5L21.5 8H19.5Z" fill="#DC2626"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">PT PLN (Persero)</span>
                  <span class="mitra-sub">BUMN Ketenagalistrikan</span>
                </div>
              </div>

              <!-- 5. PT Bukit Asam Tbk -->
              <div class="mitra-card" aria-hidden="true">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#FFF1F2"/>
                    <path d="M18 6L25 18H11L18 6Z" fill="#DC2626"/>
                    <path d="M18 13L27 28H19L18 13Z" fill="#EA580C"/>
                    <path d="M18 13L9 28H17L18 13Z" fill="#B91C1C"/>
                    <circle cx="18" cy="20" r="3.5" fill="#FDE047"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">PT Bukit Asam Tbk</span>
                  <span class="mitra-sub">BUMN Pertambangan & Energi</span>
                </div>
              </div>

              <!-- 6. Dinas Pendidikan Prov. Lampung -->
              <div class="mitra-card" aria-hidden="true">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#EFF6FF"/>
                    <circle cx="18" cy="18" r="14" fill="#1E40AF"/>
                    <path d="M18 8C19 10 19.5 11.5 18 13C16.5 11.5 17 10 18 8Z" fill="#F59E0B"/>
                    <path d="M18 13.5L14 17L18 20L22 17L18 13.5Z" fill="#FBBF24"/>
                    <path d="M10 16C12 18 14 20 18 20C22 20 24 18 26 16C24.5 21 21.5 25 18 26C14.5 25 11.5 21 10 16Z" fill="#F59E0B"/>
                    <circle cx="18" cy="17" r="1.5" fill="#1E40AF"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">Dinas Pendidikan Prov. Lampung</span>
                  <span class="mitra-sub">Instansi Pemerintah Daerah</span>
                </div>
              </div>

              <!-- 7. PT ASDP Indonesia Ferry -->
              <div class="mitra-card" aria-hidden="true">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#0284C7"/>
                    <path d="M6 24C10 22 14 26 18 24C22 22 26 26 30 24V27C26 29 22 25 18 27C14 29 10 25 6 27V24Z" fill="#F97316"/>
                    <path d="M9 19L18 9L27 19H22L18 13L14 19H9Z" fill="#FFFFFF"/>
                    <circle cx="18" cy="18" r="2" fill="#F97316"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">PT ASDP Indonesia Ferry</span>
                  <span class="mitra-sub">BUMN Penyeberangan & Logistik</span>
                </div>
              </div>

              <!-- 8. RSUD Dr. H. Abdul Moeloek -->
              <div class="mitra-card" aria-hidden="true">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#ECFDF5"/>
                    <circle cx="18" cy="18" r="13" fill="#059669"/>
                    <rect x="15" y="10" width="6" height="16" rx="2" fill="#FFFFFF"/>
                    <rect x="10" y="15" width="16" height="6" rx="2" fill="#FFFFFF"/>
                    <circle cx="18" cy="18" r="2.5" fill="#F59E0B"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">RSUD Dr. H. Abdul Moeloek</span>
                  <span class="mitra-sub">Rumah Sakit Rujukan Lampung</span>
                </div>
              </div>
            </div>
          </div>

          <!-- ================= BARIS 2 (DIBAWAHNYA) ================= -->
          <div class="mitra-marquee-wrap">
            <div class="mitra-track track-right">
              <!-- SET 1 (BARIS 2) -->
              <!-- 1. Pertamina -->
              <div class="mitra-card">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#F8FAFC"/>
                    <path d="M8 8L16 6L14 16L6 14L8 8Z" fill="#0284C7"/>
                    <path d="M18 6L28 10L23 18L15 15L18 6Z" fill="#16A34A"/>
                    <path d="M12 18L24 16L26 27L16 29L12 18Z" fill="#DC2626"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">PT Pertamina (Persero)</span>
                  <span class="mitra-sub">BUMN Energi & Migas</span>
                </div>
              </div>

              <!-- 2. Bank Lampung -->
              <div class="mitra-card">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#0F2C59"/>
                    <path d="M6 23C8 22 11 21.5 18 21.5C25 21.5 28 22 30 23V25H6V23Z" fill="#F59E0B"/>
                    <path d="M18 9L21 16L24 11L26 18L29 15L28 22H8L7 15L10 18L12 11L15 16L18 9Z" fill="#FBBF24"/>
                    <circle cx="18" cy="12" r="1.5" fill="#DC2626"/>
                    <circle cx="12" cy="14" r="1" fill="#DC2626"/>
                    <circle cx="24" cy="14" r="1" fill="#DC2626"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">PT Bank Lampung</span>
                  <span class="mitra-sub">Bank Pembangunan Daerah</span>
                </div>
              </div>

              <!-- 3. ITERA -->
              <div class="mitra-card">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#FFF1F2"/>
                    <path d="M18 6L29 12V24L18 30L7 24V12L18 6Z" fill="#881337"/>
                    <path d="M18 9L26 13.5V22.5L18 27L10 22.5V13.5L18 9Z" fill="#9F1239"/>
                    <path d="M18 12L23 16V20L18 23L13 20V16L18 12Z" fill="#F59E0B"/>
                    <path d="M16 16L18 14L20 16V20L18 18L16 20V16Z" fill="#FFFFFF"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">Institut Teknologi Sumatera</span>
                  <span class="mitra-sub">Perguruan Tinggi Negeri</span>
                </div>
              </div>

              <!-- 4. Pelindo (Pelabuhan Indonesia) -->
              <div class="mitra-card">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#0369A1"/>
                    <circle cx="18" cy="18" r="11" stroke="#38BDF8" stroke-width="2"/>
                    <path d="M18 10V26M10 18H26" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="18" cy="18" r="4.5" fill="#38BDF8"/>
                    <circle cx="18" cy="18" r="2" fill="#FFFFFF"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">PT Pelabuhan Indonesia</span>
                  <span class="mitra-sub">BUMN Kepelabuhanan & Logistik</span>
                </div>
              </div>

              <!-- 5. Semen Baturaja -->
              <div class="mitra-card">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#F1F5F9"/>
                    <path d="M8 26V13L16 8L24 13V17H28V26H8Z" fill="#B91C1C"/>
                    <rect x="12" y="17" width="5" height="9" fill="#FFFFFF"/>
                    <rect x="19" y="19" width="4" height="7" fill="#FFFFFF"/>
                    <circle cx="26" cy="20" r="1.5" fill="#F59E0B"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">PT Semen Baturaja Tbk</span>
                  <span class="mitra-sub">BUMN Industri Semen</span>
                </div>
              </div>

              <!-- 6. SMA Al Kautsar -->
              <div class="mitra-card">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#F0FDF4"/>
                    <path d="M18 6L21 11L26 9L24 14L29 16L25 20L28 24L22 25L21 30L17 27L13 29L14 24L9 22L12 18L8 15L13 14L12 9L17 11L18 6Z" fill="#047857"/>
                    <circle cx="18" cy="18" r="6" fill="#FBBF24"/>
                    <path d="M18 14L19.2 16.5L22 17L20 18.8L20.5 21.5L18 20.2L15.5 21.5L16 18.8L14 17L16.8 16.5L18 14Z" fill="#065F46"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">SMA Al Kautsar Lampung</span>
                  <span class="mitra-sub">Institusi Pendidikan Unggulan</span>
                </div>
              </div>

              <!-- 7. PT Pupuk Sriwidjaja (Pusri) -->
              <div class="mitra-card">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#15803D"/>
                    <path d="M18 7C14 12 12 18 18 29C24 18 22 12 18 7Z" fill="#EAB308"/>
                    <path d="M18 11V26M14 16L18 19M22 16L18 19M13 21L18 23M23 21L18 23" stroke="#15803D" stroke-width="1.4" stroke-linecap="round"/>
                    <circle cx="18" cy="11" r="1.5" fill="#FFFFFF"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">PT Pupuk Sriwidjaja</span>
                  <span class="mitra-sub">BUMN Pupuk Nusantara</span>
                </div>
              </div>

              <!-- 8. UIN Raden Intan Lampung -->
              <div class="mitra-card">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#047857"/>
                    <path d="M18 7C14 11 11 15 11 19H25C25 15 22 11 18 7Z" fill="#FBBF24"/>
                    <path d="M10 22C14 20 17 21 18 22C19 21 22 20 26 22V26C22 24 19 25 18 26C17 25 14 24 10 26V22Z" fill="#FFFFFF"/>
                    <circle cx="18" cy="13" r="1.8" fill="#047857"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">UIN Raden Intan Lampung</span>
                  <span class="mitra-sub">Perguruan Tinggi Keagamaan Negeri</span>
                </div>
              </div>

              <!-- DUPLIKAT BARIS 2 (UNTUK SEAMLESS LOOP) -->
              <!-- 1. Pertamina -->
              <div class="mitra-card" aria-hidden="true">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#F8FAFC"/>
                    <path d="M8 8L16 6L14 16L6 14L8 8Z" fill="#0284C7"/>
                    <path d="M18 6L28 10L23 18L15 15L18 6Z" fill="#16A34A"/>
                    <path d="M12 18L24 16L26 27L16 29L12 18Z" fill="#DC2626"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">PT Pertamina (Persero)</span>
                  <span class="mitra-sub">BUMN Energi & Migas</span>
                </div>
              </div>

              <!-- 2. Bank Lampung -->
              <div class="mitra-card" aria-hidden="true">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#0F2C59"/>
                    <path d="M6 23C8 22 11 21.5 18 21.5C25 21.5 28 22 30 23V25H6V23Z" fill="#F59E0B"/>
                    <path d="M18 9L21 16L24 11L26 18L29 15L28 22H8L7 15L10 18L12 11L15 16L18 9Z" fill="#FBBF24"/>
                    <circle cx="18" cy="12" r="1.5" fill="#DC2626"/>
                    <circle cx="12" cy="14" r="1" fill="#DC2626"/>
                    <circle cx="24" cy="14" r="1" fill="#DC2626"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">PT Bank Lampung</span>
                  <span class="mitra-sub">Bank Pembangunan Daerah</span>
                </div>
              </div>

              <!-- 3. ITERA -->
              <div class="mitra-card" aria-hidden="true">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#FFF1F2"/>
                    <path d="M18 6L29 12V24L18 30L7 24V12L18 6Z" fill="#881337"/>
                    <path d="M18 9L26 13.5V22.5L18 27L10 22.5V13.5L18 9Z" fill="#9F1239"/>
                    <path d="M18 12L23 16V20L18 23L13 20V16L18 12Z" fill="#F59E0B"/>
                    <path d="M16 16L18 14L20 16V20L18 18L16 20V16Z" fill="#FFFFFF"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">Institut Teknologi Sumatera</span>
                  <span class="mitra-sub">Perguruan Tinggi Negeri</span>
                </div>
              </div>

              <!-- 4. Pelindo (Pelabuhan Indonesia) -->
              <div class="mitra-card" aria-hidden="true">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#0369A1"/>
                    <circle cx="18" cy="18" r="11" stroke="#38BDF8" stroke-width="2"/>
                    <path d="M18 10V26M10 18H26" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="18" cy="18" r="4.5" fill="#38BDF8"/>
                    <circle cx="18" cy="18" r="2" fill="#FFFFFF"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">PT Pelabuhan Indonesia</span>
                  <span class="mitra-sub">BUMN Kepelabuhanan & Logistik</span>
                </div>
              </div>

              <!-- 5. Semen Baturaja -->
              <div class="mitra-card" aria-hidden="true">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#F1F5F9"/>
                    <path d="M8 26V13L16 8L24 13V17H28V26H8Z" fill="#B91C1C"/>
                    <rect x="12" y="17" width="5" height="9" fill="#FFFFFF"/>
                    <rect x="19" y="19" width="4" height="7" fill="#FFFFFF"/>
                    <circle cx="26" cy="20" r="1.5" fill="#F59E0B"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">PT Semen Baturaja Tbk</span>
                  <span class="mitra-sub">BUMN Industri Semen</span>
                </div>
              </div>

              <!-- 6. SMA Al Kautsar -->
              <div class="mitra-card" aria-hidden="true">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#F0FDF4"/>
                    <path d="M18 6L21 11L26 9L24 14L29 16L25 20L28 24L22 25L21 30L17 27L13 29L14 24L9 22L12 18L8 15L13 14L12 9L17 11L18 6Z" fill="#047857"/>
                    <circle cx="18" cy="18" r="6" fill="#FBBF24"/>
                    <path d="M18 14L19.2 16.5L22 17L20 18.8L20.5 21.5L18 20.2L15.5 21.5L16 18.8L14 17L16.8 16.5L18 14Z" fill="#065F46"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">SMA Al Kautsar Lampung</span>
                  <span class="mitra-sub">Institusi Pendidikan Unggulan</span>
                </div>
              </div>

              <!-- 7. PT Pupuk Sriwidjaja (Pusri) -->
              <div class="mitra-card" aria-hidden="true">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#15803D"/>
                    <path d="M18 7C14 12 12 18 18 29C24 18 22 12 18 7Z" fill="#EAB308"/>
                    <path d="M18 11V26M14 16L18 19M22 16L18 19M13 21L18 23M23 21L18 23" stroke="#15803D" stroke-width="1.4" stroke-linecap="round"/>
                    <circle cx="18" cy="11" r="1.5" fill="#FFFFFF"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">PT Pupuk Sriwidjaja</span>
                  <span class="mitra-sub">BUMN Pupuk Nusantara</span>
                </div>
              </div>

              <!-- 8. UIN Raden Intan Lampung -->
              <div class="mitra-card" aria-hidden="true">
                <div class="mitra-logo-wrap">
                  <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="36" height="36" rx="8" fill="#047857"/>
                    <path d="M18 7C14 11 11 15 11 19H25C25 15 22 11 18 7Z" fill="#FBBF24"/>
                    <path d="M10 22C14 20 17 21 18 22C19 21 22 20 26 22V26C22 24 19 25 18 26C17 25 14 24 10 26V22Z" fill="#FFFFFF"/>
                    <circle cx="18" cy="13" r="1.8" fill="#047857"/>
                  </svg>
                </div>
                <div class="mitra-meta">
                  <span class="mitra-name">UIN Raden Intan Lampung</span>
                  <span class="mitra-sub">Perguruan Tinggi Keagamaan Negeri</span>
                </div>
              </div>
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
                <img src="{{ asset('assets/images/pemilik-nirwana.JPG') }}" alt="Pimpinan & Founder Nirwana Tour Lampung - Kiki M Alfin" class="owner-photo">
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
                  "Selamat datang di Nirwana Tour Lampung. Bagi kami, setiap perjalanan bukan sekadar mengantar Anda ke destinasi, melainkan sebuah amanah untuk menghadirkan rasa aman, kenyamanan prima, dan kenangan indah yang abadi bersama orang-orang tercinta."
                </blockquote>

                <div class="owner-profile-footer">
                  <div class="owner-details">
                    <strong class="owner-name">Pimpinan & Founder - Kiki M Alfin</strong>
                    <span class="owner-role">Nirwana Tour Lampung &bull; Sejak 2016</span>
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
              <strong>Nirwana Tour Lampung</strong> adalah biro perjalanan wisata resmi dan berizin lengkap yang berbasis di Bandar Lampung, berdedikasi menciptakan pengalaman liburan yang aman, nyaman, dan berkesan tinggi bagi setiap rombongan.
            </p>
            <p class="about-desc">
              Dengan pengalaman lebih dari 8 tahun, kami telah melayani ribuan pelanggan mulai dari keluarga, sekolah, universitas, instansi pemerintahan, hingga BUMN & perusahaan swasta nasional. Setiap rencana perjalanan kami susun secara terstruktur dengan pemandu berlisensi dan armada transportasi pariwisata terawat.
            </p>

            <!-- Highlights / Mini Stats Bar -->
            <div class="about-mini-stats">
              <div class="mini-stat">
                <span class="mini-stat-num" data-counter-target="8" data-counter-suffix="+">8+</span>
                <span class="mini-stat-lbl">Tahun Pengalaman</span>
              </div>
              <div class="mini-stat-sep"></div>
              <div class="mini-stat">
                <span class="mini-stat-num" data-counter-target="1500" data-counter-suffix="+" data-counter-dot="true">1.500+</span>
                <span class="mini-stat-lbl">Trip Terlaksana</span>
              </div>
              <div class="mini-stat-sep"></div>
              <div class="mini-stat">
                <span class="mini-stat-num" data-counter-target="99" data-counter-suffix="%">99%</span>
                <span class="mini-stat-lbl">Kepuasan Pelanggan</span>
              </div>
              <div class="mini-stat-sep"></div>
              <div class="mini-stat">
                <span class="mini-stat-num" data-counter-target="100" data-counter-suffix="%">100%</span>
                <span class="mini-stat-lbl">Legalitas Resmi</span>
              </div>
            </div>

            <!-- Logo Sertifikasi, Asosiasi & Kemitraan Resmi -->
            <div class="about-cert-logos">
              <span class="cert-logos-label">
                <i class="fa-solid fa-shield-halved"></i> Sertifikasi & Asosiasi Resmi
              </span>
              <div class="cert-logos-row">
                <div class="cert-logo-item" title="Nirwana Tour Lampung - Biro Perjalanan Wisata Resmi">
                  <img src="assets/logo/Logo-Nirwana.png" alt="Logo Nirwana Tour Lampung" class="cert-logo-img">
                </div>
                <div class="cert-logo-item" title="ASITA (Association of The Indonesian Tours and Travel Agencies)">
                  <img src="assets/images/asita.png" alt="Logo ASITA Indonesia" class="cert-logo-img">
                </div>
                <div class="cert-logo-item" title="Wonderful Indonesia - Kementerian Pariwisata RI">
                  <img src="assets/images/wonderful.png" alt="Logo Wonderful Indonesia" class="cert-logo-img">
                </div>
                <div class="cert-logo-item" title="Pariwisata Provinsi Lampung - The Treasure of Sumatra">
                  <img src="assets/images/lampung.png" alt="Logo Pariwisata Lampung" class="cert-logo-img">
                </div>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="about-cta-row">
              <a href="{{ route('about') }}" class="btn btn-primary">
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
         4. LAYANAN SECTION
         ======================================================== -->
    <section class="section services-section" id="layanan">
      <div class="container">
        <div class="section-header text-center">
          <div class="section-tag">Solusi Perjalanan Lengkap</div>
          <h2 class="section-title">Layanan Terbaik Nirwana Tour Lampung</h2>
          <p class="section-subtitle">Pilihan komprehensif untuk liburan keluarga, kegiatan pendidikan, gathering kantor, hingga sewa transportasi VIP.</p>
        </div>

        <div class="services-grid">
          <!-- Layanan 1: Paket Wisata -->
          <div class="service-card">
            <div class="service-card-top">
              <div class="service-icon-box">
                <i class="fa-solid fa-umbrella-beach"></i>
              </div>
              <span class="service-chip">Open & Private Trip</span>
            </div>
            <h3 class="service-title">Paket Wisata Lampung & Domestik</h3>
            <p class="service-desc">
              Jelajahi surga bahari Lampung (Pahawang, Kiluan, Gigi Hiu) hingga destinasi nasional seperti Bali & Jogja dengan jadwal tertata rapi.
            </p>
            <ul class="service-perks">
              <li><i class="fa-solid fa-check"></i> Tiket wisata & retribusi all-in</li>
              <li><i class="fa-solid fa-check"></i> Penginapan hotel / homestay nyaman</li>
              <li><i class="fa-solid fa-check"></i> Makan, snack, & dokumentasi</li>
              <li><i class="fa-solid fa-check"></i> Tour Leader ramah bersertifikat</li>
            </ul>
            <div class="service-action">
              <a href="#" class="btn btn-primary btn-block wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya tertarik dengan layanan Paket Wisata.">
                <i class="fa-brands fa-whatsapp"></i> Pesan Layanan Ini
              </a>
            </div>
          </div>

          <!-- Layanan 2: Study Tour -->
          <div class="service-card">
            <div class="service-card-top">
              <div class="service-icon-box accent-emerald">
                <i class="fa-solid fa-graduation-cap"></i>
              </div>
              <span class="service-chip">Sekolah & Kampus</span>
            </div>
            <h3 class="service-title">Study Tour & Edukasi Pelajar</h3>
            <p class="service-desc">
              Program belajar di luar kelas yang edukatif, seru, dan aman untuk siswa TK hingga mahasiswa dengan panduan fasilitator berpengalaman.
            </p>
            <ul class="service-perks">
              <li><i class="fa-solid fa-check"></i> Destinasi sejarah, sains & budaya</li>
              <li><i class="fa-solid fa-check"></i> Lembar edukasi / LKPD terarah</li>
              <li><i class="fa-solid fa-check"></i> Tim medis P3K & asuransi lengkap</li>
              <li><i class="fa-solid fa-check"></i> Free seat guru & modul terpadu</li>
            </ul>
            <div class="service-action">
              <a href="#" class="btn btn-primary btn-block wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya tertarik dengan layanan Study Tour.">
                <i class="fa-brands fa-whatsapp"></i> Pesan Layanan Ini
              </a>
            </div>
          </div>

          <!-- Layanan 3: Kunjungan Industri & Gathering -->
          <div class="service-card">
            <div class="service-card-top">
              <div class="service-icon-box accent-amber">
                <i class="fa-solid fa-people-roof"></i>
              </div>
              <span class="service-chip">Corporate & Instansi</span>
            </div>
            <h3 class="service-title">Kunjungan Industri & Gathering</h3>
            <p class="service-desc">
              Paket outbound team building, fun games, family gathering kantor, dan perizinan instansi untuk mempererat kekompakan tim kerja Anda.
            </p>
            <ul class="service-perks">
              <li><i class="fa-solid fa-check"></i> MC & game master profesional</li>
              <li><i class="fa-solid fa-check"></i> Sound system & entertainment</li>
              <li><i class="fa-solid fa-check"></i> Spanduk, kaos seragam & plakat</li>
              <li><i class="fa-solid fa-check"></i> Fasilitas koordinasi perizinan instansi</li>
            </ul>
            <div class="service-action">
              <a href="#" class="btn btn-primary btn-block wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya tertarik dengan layanan Kunjungan Industri & Gathering.">
                <i class="fa-brands fa-whatsapp"></i> Pesan Layanan Ini
              </a>
            </div>
          </div>

          <!-- Layanan 4: Sewa Transportasi -->
          <div class="service-card">
            <div class="service-card-top">
              <div class="service-icon-box accent-rose">
                <i class="fa-solid fa-van-shuttle"></i>
              </div>
              <span class="service-chip">Armada Pariwisata</span>
            </div>
            <h3 class="service-title">Sewa Transportasi Rombongan</h3>
            <p class="service-desc">
              Penyewaan armada pariwisata prima dalam dan luar kota didampingi kru ramah yang berpengalaman rute Lampung, Jawa, dan Bali.
            </p>
            <ul class="service-perks">
              <li><i class="fa-solid fa-check"></i> Toyota HiAce Premio (14 Seat)</li>
              <li><i class="fa-solid fa-check"></i> Medium Bus Pariwisata (31-35 Seat)</li>
              <li><i class="fa-solid fa-check"></i> Big Bus Executive (45-50 Seat)</li>
              <li><i class="fa-solid fa-check"></i> Full AC, audio karaoke & charger HP</li>
            </ul>
            <div class="service-action">
              <a href="#" class="btn btn-primary btn-block wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya tertarik dengan layanan Sewa Transportasi.">
                <i class="fa-brands fa-whatsapp"></i> Pesan Layanan Ini
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ========================================================
         5. DESTINASI WISATA SECTION
         ======================================================== -->
    <section class="section destination-section" id="destinasi">
      <div class="container">
        <div class="section-header text-center">
          <div class="section-tag">Inspirasi Wisata Favorit</div>
          <h2 class="section-title">Destinasi Populer Pilihan Terbaik</h2>
          <p class="section-subtitle">Temukan pesona alam eksotis Lampung hingga destinasi favorit Jawa dan Nusantara bersama biro perjalanan berizin resmi.</p>
        </div>

        <div class="destinations-grid" id="destGrid">
          <!-- Destinasi 1: Pulau Pahawang -->
          <article class="dest-card" data-category="lampung" data-id="pahawang">
            <div class="dest-thumb">
              <img src="assets/images/destinasi/pahawang.jpg" alt="Pulau Pahawang Lampung">
              <span class="dest-category"><i class="fa-solid fa-water"></i> Bahari & Snorkeling</span>
              <span class="dest-badge-rec">Favorit Wisatawan</span>
            </div>
            <div class="dest-body">
              <div class="dest-meta">
                <span><i class="fa-solid fa-location-dot"></i> Pesawaran, Lampung</span>
                <span><i class="fa-solid fa-clock"></i> 1 Hari / 2H1M</span>
              </div>
              <h3 class="dest-title">Pulau Pahawang & Kelagian</h3>
              <p class="dest-desc">
                Surga snorkeling dengan air kristal bening, taman terumbu karang warna-warni, foto underwater bersama ikan nemo, dan keindahan pasir timbul yang memesona.
              </p>
              <div class="dest-highlights">
                <span><i class="fa-solid fa-check-circle"></i> Snorkeling Spot Nemo</span>
                <span><i class="fa-solid fa-check-circle"></i> Villa Apung</span>
                <span><i class="fa-solid fa-check-circle"></i> Pasir Timbul</span>
              </div>
              <div class="dest-footer">
                <div class="dest-pricing">
                  <span class="label">Mulai dari</span>
                  <span class="price">Rp175.000 <small>/ pax</small></span>
                </div>
                <div class="dest-action-group">
                  <button type="button" class="btn btn-outline btn-sm btn-itinerary" data-dest-id="pahawang" aria-label="Lihat Rundown Paket Pulau Pahawang">
                    <i class="fa-solid fa-list-check"></i> Rundown
                  </button>
                  <a href="#" class="btn btn-primary btn-sm wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin info paket wisata ke Pulau Pahawang.">
                    <i class="fa-brands fa-whatsapp"></i> Tanya Paket
                  </a>
                </div>
              </div>
            </div>
          </article>

          <!-- Destinasi 2: Teluk Kiluan -->
          <article class="dest-card" data-category="lampung" data-id="kiluan">
            <div class="dest-thumb">
              <img src="assets/images/destinasi/kiluan.jpg" alt="Teluk Kiluan Lumba-Lumba">
              <span class="dest-category"><i class="fa-solid fa-ship"></i> Dolphin Safari</span>
            </div>
            <div class="dest-body">
              <div class="dest-meta">
                <span><i class="fa-solid fa-location-dot"></i> Tanggamus, Lampung</span>
                <span><i class="fa-solid fa-clock"></i> 2 Hari 1 Malam</span>
              </div>
              <h3 class="dest-title">Teluk Kiluan & Laguna Gayau</h3>
              <p class="dest-desc">
                Sensasi menaiki jukung tradisional di lautan lepas menyapa kawanan lumba-lumba liar yang berenang bebas, serta berenang di kolam renang alami Laguna Gayau.
              </p>
              <div class="dest-highlights">
                <span><i class="fa-solid fa-check-circle"></i> Atraksi Lumba-lumba Liar</span>
                <span><i class="fa-solid fa-check-circle"></i> Laguna Gayau</span>
                <span><i class="fa-solid fa-check-circle"></i> Homestay View Laut</span>
              </div>
              <div class="dest-footer">
                <div class="dest-pricing">
                  <span class="label">Mulai dari</span>
                  <span class="price">Rp450.000 <small>/ pax</small></span>
                </div>
                <div class="dest-action-group">
                  <button type="button" class="btn btn-outline btn-sm btn-itinerary" data-dest-id="kiluan" aria-label="Lihat Rundown Paket Teluk Kiluan">
                    <i class="fa-solid fa-list-check"></i> Rundown
                  </button>
                  <a href="#" class="btn btn-primary btn-sm wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin info paket wisata ke Teluk Kiluan.">
                    <i class="fa-brands fa-whatsapp"></i> Tanya Paket
                  </a>
                </div>
              </div>
            </div>
          </article>

          <!-- Destinasi 3: Pantai Gigi Hiu -->
          <article class="dest-card" data-category="lampung" data-id="gigi-hiu">
            <div class="dest-thumb">
              <img src="assets/images/destinasi/gigi-hiu.jpg" alt="Pantai Gigi Hiu Pegadungan">
              <span class="dest-category"><i class="fa-solid fa-mountain-sun"></i> Geowisata Eksotis</span>
            </div>
            <div class="dest-body">
              <div class="dest-meta">
                <span><i class="fa-solid fa-location-dot"></i> Tanggamus, Lampung</span>
                <span><i class="fa-solid fa-clock"></i> 1 Hari / Sunrise Tour</span>
              </div>
              <h3 class="dest-title">Pantai Gigi Hiu (Pegadungan)</h3>
              <p class="dest-desc">
                Gugusan tebing karang runcing menjulang yang diterpa deburan ombak Samudera Hindia. Ikon fotografi landscape kelas dunia dengan panorama matahari terbit spektakuler.
              </p>
              <div class="dest-highlights">
                <span><i class="fa-solid fa-check-circle"></i> Tebing Karang Eksotis</span>
                <span><i class="fa-solid fa-check-circle"></i> Spot Foto Instagramable</span>
                <span><i class="fa-solid fa-check-circle"></i> Sunrise Adventure</span>
              </div>
              <div class="dest-footer">
                <div class="dest-pricing">
                  <span class="label">Mulai dari</span>
                  <span class="price">Rp375.000 <small>/ pax</small></span>
                </div>
                <div class="dest-action-group">
                  <button type="button" class="btn btn-outline btn-sm btn-itinerary" data-dest-id="gigi-hiu" aria-label="Lihat Rundown Paket Pantai Gigi Hiu">
                    <i class="fa-solid fa-list-check"></i> Rundown
                  </button>
                  <a href="#" class="btn btn-primary btn-sm wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin info paket wisata ke Pantai Gigi Hiu.">
                    <i class="fa-brands fa-whatsapp"></i> Tanya Paket
                  </a>
                </div>
              </div>
            </div>
          </article>

          <!-- Destinasi 4: Way Kambas -->
          <article class="dest-card" data-category="lampung edukasi" data-id="way-kambas">
            <div class="dest-thumb">
              <img src="assets/images/destinasi/way-kambas.jpg" alt="Taman Nasional Way Kambas">
              <span class="dest-category"><i class="fa-solid fa-tree"></i> Ekowisata & Edukasi</span>
            </div>
            <div class="dest-body">
              <div class="dest-meta">
                <span><i class="fa-solid fa-location-dot"></i> Lampung Timur</span>
                <span><i class="fa-solid fa-clock"></i> 1 Hari Wisata</span>
              </div>
              <h3 class="dest-title">Taman Nasional Way Kambas</h3>
              <p class="dest-desc">
                Pusat konservasi dan pelatihan gajah Sumatera tertua di Indonesia. Pengunjung diajak berinteraksi langsung, memandikan gajah, dan mempelajari ekosistem hutan rimba.
              </p>
              <div class="dest-highlights">
                <span><i class="fa-solid fa-check-circle"></i> Interaksi Bersama Gajah</span>
                <span><i class="fa-solid fa-check-circle"></i> Konservasi Hutan Alam</span>
                <span><i class="fa-solid fa-check-circle"></i> Cocok untuk Edukasi Anak</span>
              </div>
              <div class="dest-footer">
                <div class="dest-pricing">
                  <span class="label">Mulai dari</span>
                  <span class="price">Rp250.000 <small>/ pax</small></span>
                </div>
                <div class="dest-action-group">
                  <button type="button" class="btn btn-outline btn-sm btn-itinerary" data-dest-id="way-kambas" aria-label="Lihat Rundown Paket Way Kambas">
                    <i class="fa-solid fa-list-check"></i> Rundown
                  </button>
                  <a href="#" class="btn btn-primary btn-sm wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin info paket wisata ke Taman Nasional Way Kambas.">
                    <i class="fa-brands fa-whatsapp"></i> Tanya Paket
                  </a>
                </div>
              </div>
            </div>
          </article>

          <!-- Destinasi 5: Yogyakarta -->
          <article class="dest-card" data-category="nusantara edukasi" data-id="jogja">
            <div class="dest-thumb">
              <img src="assets/images/destinasi/jogja.jpg" alt="Wisata Budaya Candi Yogyakarta">
              <span class="dest-category"><i class="fa-solid fa-landmark"></i> Budaya & Edukasi</span>
              <span class="dest-badge-rec">Favorit Sekolah</span>
            </div>
            <div class="dest-body">
              <div class="dest-meta">
                <span><i class="fa-solid fa-location-dot"></i> D.I. Yogyakarta</span>
                <span><i class="fa-solid fa-clock"></i> 4 Hari 3 Malam</span>
              </div>
              <h3 class="dest-title">Eksotika Pelajar & Budaya Yogyakarta</h3>
              <p class="dest-desc">
                Petualangan legendaris menyusuri keagungan Candi Borobudur/Prambanan, keseruan Lava Tour Jeep Merapi, panorama HeHa Sky View, dan belanja asyik di Malioboro.
              </p>
              <div class="dest-highlights">
                <span><i class="fa-solid fa-check-circle"></i> Candi Prambanan / Borobudur</span>
                <span><i class="fa-solid fa-check-circle"></i> Lava Tour Jeep Merapi</span>
                <span><i class="fa-solid fa-check-circle"></i> Malioboro & Tebing Breksi</span>
              </div>
              <div class="dest-footer">
                <div class="dest-pricing">
                  <span class="label">Mulai dari</span>
                  <span class="price">Rp1.450.000 <small>/ pax</small></span>
                </div>
                <div class="dest-action-group">
                  <button type="button" class="btn btn-outline btn-sm btn-itinerary" data-dest-id="jogja" aria-label="Lihat Rundown Paket Yogyakarta">
                    <i class="fa-solid fa-list-check"></i> Rundown
                  </button>
                  <a href="#" class="btn btn-primary btn-sm wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin info paket wisata Yogyakarta 4H3M.">
                    <i class="fa-brands fa-whatsapp"></i> Tanya Paket
                  </a>
                </div>
              </div>
            </div>
          </article>

          <!-- Destinasi 6: Malang & Bromo -->
          <article class="dest-card" data-category="nusantara edukasi" data-id="bromo">
            <div class="dest-thumb">
              <img src="assets/images/destinasi/bromo.jpg" alt="Sunrise Gunung Bromo Malang">
              <span class="dest-category"><i class="fa-solid fa-volcano"></i> Alam & Petualangan</span>
              <span class="dest-badge-rec">Best Gathering</span>
            </div>
            <div class="dest-body">
              <div class="dest-meta">
                <span><i class="fa-solid fa-location-dot"></i> Malang & TN Bromo Semeru, Jatim</span>
                <span><i class="fa-solid fa-clock"></i> 4 Hari 3 Malam</span>
              </div>
              <h3 class="dest-title">Malang & Bromo Sunrise Adventure</h3>
              <p class="dest-desc">
                Menyaksikan matahari terbit spektakuler Penanjakan Bromo dengan Jeep 4x4, menjelajahi Pasir Berbisik, petik apel di Kota Batu, dan wahana seru Museum Angkut.
              </p>
              <div class="dest-highlights">
                <span><i class="fa-solid fa-check-circle"></i> Golden Sunrise Jeep Bromo</span>
                <span><i class="fa-solid fa-check-circle"></i> Museum Angkut & Jatim Park</span>
                <span><i class="fa-solid fa-check-circle"></i> Wisata Petik Apel Batu</span>
              </div>
              <div class="dest-footer">
                <div class="dest-pricing">
                  <span class="label">Mulai dari</span>
                  <span class="price">Rp1.850.000 <small>/ pax</small></span>
                </div>
                <div class="dest-action-group">
                  <button type="button" class="btn btn-outline btn-sm btn-itinerary" data-dest-id="bromo" aria-label="Lihat Rundown Paket Malang Bromo">
                    <i class="fa-solid fa-list-check"></i> Rundown
                  </button>
                  <a href="#" class="btn btn-primary btn-sm wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin info paket wisata Malang Bromo 4H3M.">
                    <i class="fa-brands fa-whatsapp"></i> Tanya Paket
                  </a>
                </div>
              </div>
            </div>
          </article>

          <!-- Destinasi Extra 1: Krakatau & Sebesi -->
          <article class="dest-card" data-category="lampung" data-id="krakatau">
            <div class="dest-thumb">
              <img src="assets/images/destinasi/krakatau.jpg" alt="Gunung Anak Krakatau dan Pulau Sebesi">
              <span class="dest-category"><i class="fa-solid fa-volcano"></i> Ekspedisi Geologi</span>
            </div>
            <div class="dest-body">
              <div class="dest-meta">
                <span><i class="fa-solid fa-location-dot"></i> Selat Sunda, Lampung</span>
                <span><i class="fa-solid fa-clock"></i> 2 Hari 1 Malam</span>
              </div>
              <h3 class="dest-title">Gunung Krakatau & Pulau Sebesi</h3>
              <p class="dest-desc">
                Petualangan legendaris menyusuri Selat Sunda menuju cagar alam geologi Gunung Anak Krakatau, berpadu snorkeling di Laguna Cabe dan keindahan pulau tropis Sebesi.
              </p>
              <div class="dest-highlights">
                <span><i class="fa-solid fa-check-circle"></i> View Gunung Api Vulkanik</span>
                <span><i class="fa-solid fa-check-circle"></i> Snorkeling Spot Cabe</span>
                <span><i class="fa-solid fa-check-circle"></i> Sunset Selat Sunda</span>
              </div>
              <div class="dest-footer">
                <div class="dest-pricing">
                  <span class="label">Mulai dari</span>
                  <span class="price">Rp520.000 <small>/ pax</small></span>
                </div>
                <div class="dest-action-group">
                  <button type="button" class="btn btn-outline btn-sm btn-itinerary" data-dest-id="krakatau" aria-label="Lihat Rundown Paket Krakatau">
                    <i class="fa-solid fa-list-check"></i> Rundown
                  </button>
                  <a href="#" class="btn btn-primary btn-sm wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin info paket wisata ke Krakatau & Sebesi.">
                    <i class="fa-brands fa-whatsapp"></i> Tanya Paket
                  </a>
                </div>
              </div>
            </div>
          </article>

          <!-- Destinasi Extra 2: Krui Pesisir Barat -->
          <article class="dest-card" data-category="lampung" data-id="krui">
            <div class="dest-thumb">
              <img src="assets/images/destinasi/krui.jpg" alt="Pantai Krui Pesisir Barat Lampung">
              <span class="dest-category"><i class="fa-solid fa-umbrella-beach"></i> Pantai & Surfing</span>
            </div>
            <div class="dest-body">
              <div class="dest-meta">
                <span><i class="fa-solid fa-location-dot"></i> Pesisir Barat, Lampung</span>
                <span><i class="fa-solid fa-clock"></i> 3 Hari 2 Malam</span>
              </div>
              <h3 class="dest-title">Pantai Krui & Pulau Pisang</h3>
              <p class="dest-desc">
                Pantai berpasir putih alami dengan gulungan ombak kelas dunia. Menikmati kelapa muda di Pantai Labuhan Jukung serta menyeberang ke Pulau Pisang yang damai.
              </p>
              <div class="dest-highlights">
                <span><i class="fa-solid fa-check-circle"></i> Labuhan Jukung Sunset</span>
                <span><i class="fa-solid fa-check-circle"></i> Jelajah Pulau Pisang</span>
                <span><i class="fa-solid fa-check-circle"></i> Kuliner Ikan Tuhuk Khas</span>
              </div>
              <div class="dest-footer">
                <div class="dest-pricing">
                  <span class="label">Mulai dari</span>
                  <span class="price">Rp650.000 <small>/ pax</small></span>
                </div>
                <div class="dest-action-group">
                  <button type="button" class="btn btn-outline btn-sm btn-itinerary" data-dest-id="krui" aria-label="Lihat Rundown Paket Krui">
                    <i class="fa-solid fa-list-check"></i> Rundown
                  </button>
                  <a href="#" class="btn btn-primary btn-sm wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin info paket wisata ke Krui & Pesisir Barat.">
                    <i class="fa-brands fa-whatsapp"></i> Tanya Paket
                  </a>
                </div>
              </div>
            </div>
          </article>

          <!-- Destinasi Extra 3: Jakarta - Bandung -->
          <article class="dest-card" data-category="nusantara edukasi" data-id="jakarta-bandung">
            <div class="dest-thumb">
              <img src="assets/images/destinasi/jakarta-bandung.jpg" alt="Tour Jakarta Bandung Lembang">
              <span class="dest-category"><i class="fa-solid fa-city"></i> Kunjungan & Wisata</span>
              <span class="dest-badge-rec">Tol & Ferry All-In</span>
            </div>
            <div class="dest-body">
              <div class="dest-meta">
                <span><i class="fa-solid fa-location-dot"></i> DKI Jakarta & Bandung, Jabar</span>
                <span><i class="fa-solid fa-clock"></i> 3 Hari 2 Malam</span>
              </div>
              <h3 class="dest-title">Jakarta & Bandung Smart Tour</h3>
              <p class="dest-desc">
                Paket wisata terpadu kunjungan industri/instansi, eksplorasi Tangkuban Perahu, Floating Market Lembang, jalan-jalan heritage Jalan Braga, dan belanja Pasar Baru.
              </p>
              <div class="dest-highlights">
                <span><i class="fa-solid fa-check-circle"></i> Kunjungan Industri / Monas</span>
                <span><i class="fa-solid fa-check-circle"></i> Tangkuban Perahu & Lembang</span>
                <span><i class="fa-solid fa-check-circle"></i> Hotel Bintang 3 + Bus VIP</span>
              </div>
              <div class="dest-footer">
                <div class="dest-pricing">
                  <span class="label">Mulai dari</span>
                  <span class="price">Rp1.250.000 <small>/ pax</small></span>
                </div>
                <div class="dest-action-group">
                  <button type="button" class="btn btn-outline btn-sm btn-itinerary" data-dest-id="jakarta-bandung" aria-label="Lihat Rundown Paket Jakarta Bandung">
                    <i class="fa-solid fa-list-check"></i> Rundown
                  </button>
                  <a href="#" class="btn btn-primary btn-sm wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin info paket wisata Jakarta - Bandung 3H2M.">
                    <i class="fa-brands fa-whatsapp"></i> Tanya Paket
                  </a>
                </div>
              </div>
            </div>
          </article>
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
         MODAL RUNDOWN & DETAIL ITINERARY
         ======================================================== -->
    <div class="itinerary-modal" id="itineraryModal" role="dialog" aria-modal="true" aria-labelledby="itineraryModalTitle" hidden>
      <div class="itinerary-backdrop" id="itineraryBackdrop"></div>
      <div class="itinerary-dialog">
        <button class="itinerary-close-btn" id="itineraryClose" aria-label="Tutup detail itinerary">
          <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="itinerary-header">
          <span class="itinerary-badge" id="itineraryCategory">Wisata Bahari</span>
          <h3 class="itinerary-modal-title" id="itineraryModalTitle">Paket Wisata Pulau Pahawang</h3>
          <p class="itinerary-duration" id="itineraryDuration"><i class="fa-solid fa-clock"></i> 1 Hari (One Day Tour)</p>
        </div>
        <div class="itinerary-body">
          <div class="itinerary-section">
            <h4 class="itinerary-subheading"><i class="fa-solid fa-route"></i> Rencana Perjalanan (Rundown Kegiatan)</h4>
            <div class="timeline-list" id="itineraryTimeline">
              <!-- Dynamically populated via JS -->
            </div>
          </div>
          <div class="itinerary-section">
            <h4 class="itinerary-subheading"><i class="fa-solid fa-circle-check"></i> Fasilitas Termasuk (Include)</h4>
            <ul class="itinerary-perks-list" id="itineraryIncludes">
              <!-- Dynamically populated via JS -->
            </ul>
          </div>
          <div class="itinerary-section">
            <h4 class="itinerary-subheading"><i class="fa-solid fa-circle-xmark"></i> Tidak Termasuk (Exclude)</h4>
            <ul class="itinerary-excludes-list" id="itineraryExcludes">
              <!-- Dynamically populated via JS -->
            </ul>
          </div>
        </div>
        <div class="itinerary-footer">
          <div class="itinerary-footer-price">
            <span class="lbl">Mulai dari:</span>
            <strong class="val" id="itineraryPriceDisplay">Rp175.000 / pax</strong>
          </div>
          <a href="#" class="btn btn-whatsapp btn-md" id="itineraryWaBtn" target="_blank" rel="noopener noreferrer">
            <i class="fa-brands fa-whatsapp"></i> Tanya / Booking Paket Ini
          </a>
        </div>
      </div>
    </div>

    <!-- ========================================================
         6. KEUNGGULAN SECTION
         ======================================================== -->
    <section class="section reasons-section" id="keunggulan">
      <div class="container">
        <div class="section-header text-center">
          <div class="section-tag">Mengapa Memilih Kami</div>
          <h2 class="section-title">Keunggulan Nirwana Tour Lampung</h2>
          <p class="section-subtitle">Komitmen kami dalam memberikan standar mutu perjalanan tertinggi tanpa kompromi.</p>
        </div>
      </div>

      <!-- Marquee Keunggulan Berjalan Sejajar ke Kanan -->
      <div class="reasons-marquee-wrap" title="Sorot kursor untuk menjeda putaran">
        <div class="reasons-track">
          <!-- ================= SET 1 ================= -->
          <!-- Item 1 -->
          <div class="reason-card">
            <div class="reason-icon">
              <i class="fa-solid fa-certificate"></i>
            </div>
            <h3 class="reason-title">Biro Resmi & Legalitas Terjamin</h3>
            <p class="reason-desc">
              Perusahaan resmi berbadan hukum dengan izin usaha pariwisata lengkap. Menjamin transaksi aman dan kepastian jadwal keberangkatan tanpa rasa was-was.
            </p>
          </div>

          <!-- Item 2 -->
          <div class="reason-card">
            <div class="reason-icon">
              <i class="fa-solid fa-user-shield"></i>
            </div>
            <h3 class="reason-title">Tour Leader & Kru Bersertifikat</h3>
            <p class="reason-desc">
              Dipandu oleh tim lokal yang ramah, berlisensi, menguasai medan, sigap membantu kebutuhan rombongan, serta dibekali pelatihan pertolongan pertama (P3K).
            </p>
          </div>

          <!-- Item 3 -->
          <div class="reason-card">
            <div class="reason-icon">
              <i class="fa-solid fa-bus"></i>
            </div>
            <h3 class="reason-title">Armada Nyaman & Terawat Prima</h3>
            <p class="reason-desc">
              Kendaraan HiAce dan bus pariwisata keluaran terbaru dengan fasilitas AC dingin, reclining seat, audio video karaoke, charger port, serta uji kelaikan berkala.
            </p>
          </div>

          <!-- Item 4 -->
          <div class="reason-card">
            <div class="reason-icon">
              <i class="fa-solid fa-sliders"></i>
            </div>
            <h3 class="reason-title">Itinerary Fleksibel & Custom</h3>
            <p class="reason-desc">
              Jadwal perjalanan dapat disesuaikan sepenuhnya dengan preferensi destinasi, waktu, dan batas anggaran kelompok kerja, sekolah, maupun keluarga Anda.
            </p>
          </div>

          <!-- Item 5 -->
          <div class="reason-card">
            <div class="reason-icon">
              <i class="fa-solid fa-camera-retro"></i>
            </div>
            <h3 class="reason-title">Dokumentasi Menarik & Berkualitas</h3>
            <p class="reason-desc">
              Kami sediakan fasilitas dokumentasi kamera DSLR, mirrorless, GoPro underwater, hingga drone (paket tertentu) agar memori liburan Anda tersimpan abadi.
            </p>
          </div>

          <!-- Item 6 -->
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
          <!-- Item 1 -->
          <div class="reason-card" aria-hidden="true">
            <div class="reason-icon">
              <i class="fa-solid fa-certificate"></i>
            </div>
            <h3 class="reason-title">Biro Resmi & Legalitas Terjamin</h3>
            <p class="reason-desc">
              Perusahaan resmi berbadan hukum dengan izin usaha pariwisata lengkap. Menjamin transaksi aman dan kepastian jadwal keberangkatan tanpa rasa was-was.
            </p>
          </div>

          <!-- Item 2 -->
          <div class="reason-card" aria-hidden="true">
            <div class="reason-icon">
              <i class="fa-solid fa-user-shield"></i>
            </div>
            <h3 class="reason-title">Tour Leader & Kru Bersertifikat</h3>
            <p class="reason-desc">
              Dipandu oleh tim lokal yang ramah, berlisensi, menguasai medan, sigap membantu kebutuhan rombongan, serta dibekali pelatihan pertolongan pertama (P3K).
            </p>
          </div>

          <!-- Item 3 -->
          <div class="reason-card" aria-hidden="true">
            <div class="reason-icon">
              <i class="fa-solid fa-bus"></i>
            </div>
            <h3 class="reason-title">Armada Nyaman & Terawat Prima</h3>
            <p class="reason-desc">
              Kendaraan HiAce dan bus pariwisata keluaran terbaru dengan fasilitas AC dingin, reclining seat, audio video karaoke, charger port, serta uji kelaikan berkala.
            </p>
          </div>

          <!-- Item 4 -->
          <div class="reason-card" aria-hidden="true">
            <div class="reason-icon">
              <i class="fa-solid fa-sliders"></i>
            </div>
            <h3 class="reason-title">Itinerary Fleksibel & Custom</h3>
            <p class="reason-desc">
              Jadwal perjalanan dapat disesuaikan sepenuhnya dengan preferensi destinasi, waktu, dan batas anggaran kelompok kerja, sekolah, maupun keluarga Anda.
            </p>
          </div>

          <!-- Item 5 -->
          <div class="reason-card" aria-hidden="true">
            <div class="reason-icon">
              <i class="fa-solid fa-camera-retro"></i>
            </div>
            <h3 class="reason-title">Dokumentasi Menarik & Berkualitas</h3>
            <p class="reason-desc">
              Kami sediakan fasilitas dokumentasi kamera DSLR, mirrorless, GoPro underwater, hingga drone (paket tertentu) agar memori liburan Anda tersimpan abadi.
            </p>
          </div>

          <!-- Item 6 -->
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
         7. GALERI VIDEO KEGIATAN SECTION
         ======================================================== -->
    <section class="section gallery-section" id="galeri">
      <div class="container">
        <div class="section-header text-center">
          <div class="section-tag">Video Dokumentasi Nyata</div>
          <h2 class="section-title">Galeri Video & Momen Keseruan Tour</h2>
          <p class="section-subtitle">Saksikan langsung cuplikan video keceriaan dan kehangatan rombongan wisatawan saat menjelajahi ragam destinasi impian bersama Nirwana Tour Lampung.</p>
        </div>

        <!-- Video Marquee Auto-Scroll ke Kiri (4 Video Berjalan Seamless) -->
        <div class="video-marquee-wrapper" id="videoMarqueeWrapper">
          <div class="video-marquee-track">
            
            <!-- Group 1: 4 Video Cards Utama -->
            <div class="video-marquee-group">
              <!-- Video 1 -->
              <article class="video-card">
                <div class="video-player-wrapper">
                  <video class="gallery-video" controls playsinline preload="metadata" poster="{{ asset('assets/images/galeri/video1-poster.jpg') }}">
                    <source src="{{ asset('assets/images/galeri/video1.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutar video HTML5.
                  </video>
                  <div class="video-duration-badge"><i class="fa-solid fa-clock"></i> 01:33</div>
                </div>
                <div class="video-card-body">
                  <span class="video-tag">Wisata Bahari & Snorkeling</span>
                  <h3 class="video-title">Keseruan Eksplorasi Wisata Rombongan Lampung</h3>
                  <p class="video-desc">Momen autentik keceriaan rombongan saat menikmati perjalanan bahari, snorkeling di perairan jernih, dan kebersamaan hangat peserta trip.</p>
                </div>
              </article>

              <!-- Video 2 -->
              <article class="video-card">
                <div class="video-player-wrapper">
                  <video class="gallery-video" controls playsinline preload="metadata" poster="{{ asset('assets/images/galeri/video2-poster.jpg') }}">
                    <source src="{{ asset('assets/images/galeri/video2.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutar video HTML5.
                  </video>
                  <div class="video-duration-badge"><i class="fa-solid fa-clock"></i> 00:59</div>
                </div>
                <div class="video-card-body">
                  <span class="video-tag">Study Tour & Edukasi</span>
                  <h3 class="video-title">Keceriaan Agenda Study Tour Edukasi Pelajar</h3>
                  <p class="video-desc">Pendampingan penuh kehangatan oleh tim tour leader Nirwana Tour dalam membimbing siswa belajar dan berpetualang dengan riang gembira.</p>
                </div>
              </article>

              <!-- Video 3 -->
              <article class="video-card">
                <div class="video-player-wrapper">
                  <video class="gallery-video" controls playsinline preload="metadata" poster="{{ asset('assets/images/galeri/video3-poster.jpg') }}">
                    <source src="{{ asset('assets/images/galeri/video3.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutar video HTML5.
                  </video>
                  <div class="video-duration-badge"><i class="fa-solid fa-clock"></i> 01:00</div>
                </div>
                <div class="video-card-body">
                  <span class="video-tag">Momen Liburan Tropis</span>
                  <h3 class="video-title">Eksplorasi Panorama & Keindahan Bahari Tropis</h3>
                  <p class="video-desc">Menyusuri deburan ombak dan pesona alam nusantara, menghadirkan memori manis dan cerita tak terlupakan bagi setiap rombongan wisatawan.</p>
                </div>
              </article>

              <!-- Video 4 -->
              <article class="video-card">
                <div class="video-player-wrapper">
                  <video class="gallery-video" controls playsinline preload="metadata" poster="{{ asset('assets/images/galeri/video4-poster.jpg') }}">
                    <source src="{{ asset('assets/images/galeri/video4.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutar video HTML5.
                  </video>
                  <div class="video-duration-badge"><i class="fa-solid fa-clock"></i> 01:15</div>
                </div>
                <div class="video-card-body">
                  <span class="video-tag">Gathering & Outbound</span>
                  <h3 class="video-title">Keseruan Outbound & Gathering Perusahaan</h3>
                  <p class="video-desc">Aktivitas fun team building, kekompakan karyawan instansi, dan malam kebersamaan rombongan yang penuh tawa dan keakraban.</p>
                </div>
              </article>
            </div>

            <!-- Group 2: Duplikasi 4 Video Cards untuk Seamless Infinite Loop -->
            <div class="video-marquee-group" aria-hidden="true">
              <!-- Video 1 (Clone) -->
              <article class="video-card">
                <div class="video-player-wrapper">
                  <video class="gallery-video" controls playsinline preload="metadata" poster="{{ asset('assets/images/galeri/video1-poster.jpg') }}">
                    <source src="{{ asset('assets/images/galeri/video1.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutar video HTML5.
                  </video>
                  <div class="video-duration-badge"><i class="fa-solid fa-clock"></i> 01:33</div>
                </div>
                <div class="video-card-body">
                  <span class="video-tag">Wisata Bahari & Snorkeling</span>
                  <h3 class="video-title">Keseruan Eksplorasi Wisata Rombongan Lampung</h3>
                  <p class="video-desc">Momen autentik keceriaan rombongan saat menikmati perjalanan bahari, snorkeling di perairan jernih, dan kebersamaan hangat peserta trip.</p>
                </div>
              </article>

              <!-- Video 2 (Clone) -->
              <article class="video-card">
                <div class="video-player-wrapper">
                  <video class="gallery-video" controls playsinline preload="metadata" poster="{{ asset('assets/images/galeri/video2-poster.jpg') }}">
                    <source src="{{ asset('assets/images/galeri/video2.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutar video HTML5.
                  </video>
                  <div class="video-duration-badge"><i class="fa-solid fa-clock"></i> 00:59</div>
                </div>
                <div class="video-card-body">
                  <span class="video-tag">Study Tour & Edukasi</span>
                  <h3 class="video-title">Keceriaan Agenda Study Tour Edukasi Pelajar</h3>
                  <p class="video-desc">Pendampingan penuh kehangatan oleh tim tour leader Nirwana Tour dalam membimbing siswa belajar dan berpetualang dengan riang gembira.</p>
                </div>
              </article>

              <!-- Video 3 (Clone) -->
              <article class="video-card">
                <div class="video-player-wrapper">
                  <video class="gallery-video" controls playsinline preload="metadata" poster="{{ asset('assets/images/galeri/video3-poster.jpg') }}">
                    <source src="{{ asset('assets/images/galeri/video3.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutar video HTML5.
                  </video>
                  <div class="video-duration-badge"><i class="fa-solid fa-clock"></i> 01:00</div>
                </div>
                <div class="video-card-body">
                  <span class="video-tag">Momen Liburan Tropis</span>
                  <h3 class="video-title">Eksplorasi Panorama & Keindahan Bahari Tropis</h3>
                  <p class="video-desc">Menyusuri deburan ombak dan pesona alam nusantara, menghadirkan memori manis dan cerita tak terlupakan bagi setiap rombongan wisatawan.</p>
                </div>
              </article>

              <!-- Video 4 (Clone) -->
              <article class="video-card">
                <div class="video-player-wrapper">
                  <video class="gallery-video" controls playsinline preload="metadata" poster="{{ asset('assets/images/galeri/video4-poster.jpg') }}">
                    <source src="{{ asset('assets/images/galeri/video4.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutar video HTML5.
                  </video>
                  <div class="video-duration-badge"><i class="fa-solid fa-clock"></i> 01:15</div>
                </div>
                <div class="video-card-body">
                  <span class="video-tag">Gathering & Outbound</span>
                  <h3 class="video-title">Keseruan Outbound & Gathering Perusahaan</h3>
                  <p class="video-desc">Aktivitas fun team building, kekompakan karyawan instansi, dan malam kebersamaan rombongan yang penuh tawa dan keakraban.</p>
                </div>
              </article>
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
         6.5 ARTIKEL & TIPS WISATA SECTION
         ======================================================== -->
    <section class="section articles-section" id="artikel">
      <div class="container">
        <div class="section-header text-center">
          <div class="section-tag">Informasi & Edukasi</div>
          <h2 class="section-title">Berita & Tips Wisata Terbaru</h2>
          <p class="section-subtitle">Dapatkan panduan liburan praktis, tips destinasi populer, dan wawasan seru seputar wisata Lampung & Nusantara.</p>
        </div>

        <div class="articles-grid">
          @forelse($posts as $post)
            <article class="article-card">
              <div class="article-thumb">
                <a href="{{ route('posts.show', $post->slug) }}" style="display: block; width: 100%; height: 100%;">
                  <img src="{{ $post->cover_image ? asset($post->cover_image) : asset('assets/images/destinasi/pahawang.jpg') }}" alt="{{ $post->title }}" class="article-img" loading="lazy">
                </a>
                <span class="article-tag">{{ $post->category->name ?? 'Tips Wisata' }}</span>
              </div>
              <div class="article-body">
                <div class="article-meta">
                  <span><i class="fa-regular fa-calendar"></i> {{ $post->published_at ? $post->published_at->format('d M Y') : date('d M Y') }}</span>
                  <span><i class="fa-regular fa-clock"></i> {{ ceil(str_word_count(strip_tags($post->content ?? '')) / 150) ?: 4 }} Menit Baca</span>
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
         8. TESTIMONI WISATAWAN (CERITA BAHAGIA WISATAWAN)
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

            <!-- Social Proof Trust Card -->
            <div class="testi-trust-card">
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
                  <span class="trust-label">Kepuasan 99% dari 500+ Rombongan</span>
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

              <div class="trust-card-cta">
                <a href="#kontak" class="btn btn-primary btn-md">
                  <span>Konsultasi Liburan Rombongan</span>
                  <i class="fa-solid fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <!-- SISI KANAN: Testimoni Berjalan Kebawah (Vertical Downward Marquee) -->
          <div class="testimonials-right-col">
            <div class="testimonials-viewport" id="testimonialsViewport">
              <div class="testi-track-grid">
                <!-- Kolom Track 1: Bergerak Kebawah -->
                <div class="testi-col-track track-col-1">
                  <div class="testi-track-inner">
                    <!-- Group 1 -->
                    <div class="testi-group">
                      <!-- Card 1: Sekolah -->
                      <div class="testimonial-card">
                        <div class="testimonial-card-top">
                          <div class="testi-author">
                            <div class="author-avatar avatar-1">RJ</div>
                            <div>
                              <h4 class="author-name">Dra. Hj. Ratna Juwita, M.Pd</h4>
                              <p class="author-role">Kepala SMA Negeri di Bandar Lampung</p>
                            </div>
                          </div>
                        </div>
                        <p class="testi-text">
                          "Pelayanan Nirwana Tour sangat profesional dan amanah saat mendampingi study tour 120 siswa kami ke Yogyakarta. Kunjungan edukasi tepat waktu, armada bus executive prima, serta tour leader sigap mengayomi siswa."
                        </p>
                        <div class="testi-stars">
                          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <div class="testi-trip-badge">
                          <i class="fa-solid fa-graduation-cap"></i> Study Tour Edukasi (120 Siswa)
                        </div>
                      </div>

                      <!-- Card 2: BUMN / Corporate -->
                      <div class="testimonial-card">
                        <div class="testimonial-card-top">
                          <div class="testi-author">
                            <div class="author-avatar avatar-2">DW</div>
                            <div>
                              <h4 class="author-name">Dimas Wicaksono, S.T.</h4>
                              <p class="author-role">Ketua Panitia Gathering BUMN Lampung</p>
                            </div>
                          </div>
                        </div>
                        <p class="testi-text">
                          "Employee gathering perusahaan kami ke Teluk Kiluan terlaksana sukses dan sangat berkesan. Kegiatan outbound seru, akomodasi bersih dan nyaman, serta koordinasi tim di lapangan sangat rapi."
                        </p>
                        <div class="testi-stars">
                          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <div class="testi-trip-badge">
                          <i class="fa-solid fa-people-group"></i> Corporate Gathering (45 Peserta)
                        </div>
                      </div>

                      <!-- Card 3: Keluarga Luar Kota -->
                      <div class="testimonial-card">
                        <div class="testimonial-card-top">
                          <div class="testi-author">
                            <div class="author-avatar avatar-3">HK</div>
                            <div>
                              <h4 class="author-name">dr. Hendra Kurniawan, Sp.A</h4>
                              <p class="author-role">Wisatawan Keluarga (Jakarta)</p>
                            </div>
                          </div>
                        </div>
                        <p class="testi-text">
                          "Liburan keluarga besar kami ke Pulau Pahawang terasa sangat praktis dan menyenangkan. Layanan penjemputan di Bandara Radin Inten II tepat waktu dengan armada HiAce Premio yang bersih dan nyaman."
                        </p>
                        <div class="testi-stars">
                          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <div class="testi-trip-badge">
                          <i class="fa-solid fa-umbrella-beach"></i> Family Private Trip Pahawang
                        </div>
                      </div>
                    </div>

                    <!-- Group 1 Clone (Infinite Loop) -->
                    <div class="testi-group" aria-hidden="true">
                      <!-- Card 1: Sekolah -->
                      <div class="testimonial-card">
                        <div class="testimonial-card-top">
                          <div class="testi-author">
                            <div class="author-avatar avatar-1">RJ</div>
                            <div>
                              <h4 class="author-name">Dra. Hj. Ratna Juwita, M.Pd</h4>
                              <p class="author-role">Kepala SMA Negeri di Bandar Lampung</p>
                            </div>
                          </div>
                        </div>
                        <p class="testi-text">
                          "Pelayanan Nirwana Tour sangat profesional dan amanah saat mendampingi study tour 120 siswa kami ke Yogyakarta. Kunjungan edukasi tepat waktu, armada bus executive prima, serta tour leader sigap mengayomi siswa."
                        </p>
                        <div class="testi-stars">
                          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <div class="testi-trip-badge">
                          <i class="fa-solid fa-graduation-cap"></i> Study Tour Edukasi (120 Siswa)
                        </div>
                      </div>

                      <!-- Card 2: BUMN / Corporate -->
                      <div class="testimonial-card">
                        <div class="testimonial-card-top">
                          <div class="testi-author">
                            <div class="author-avatar avatar-2">DW</div>
                            <div>
                              <h4 class="author-name">Dimas Wicaksono, S.T.</h4>
                              <p class="author-role">Ketua Panitia Gathering BUMN Lampung</p>
                            </div>
                          </div>
                        </div>
                        <p class="testi-text">
                          "Employee gathering perusahaan kami ke Teluk Kiluan terlaksana sukses dan sangat berkesan. Kegiatan outbound seru, akomodasi bersih dan nyaman, serta koordinasi tim di lapangan sangat rapi."
                        </p>
                        <div class="testi-stars">
                          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <div class="testi-trip-badge">
                          <i class="fa-solid fa-people-group"></i> Corporate Gathering (45 Peserta)
                        </div>
                      </div>

                      <!-- Card 3: Keluarga Luar Kota -->
                      <div class="testimonial-card">
                        <div class="testimonial-card-top">
                          <div class="testi-author">
                            <div class="author-avatar avatar-3">HK</div>
                            <div>
                              <h4 class="author-name">dr. Hendra Kurniawan, Sp.A</h4>
                              <p class="author-role">Wisatawan Keluarga (Jakarta)</p>
                            </div>
                          </div>
                        </div>
                        <p class="testi-text">
                          "Liburan keluarga besar kami ke Pulau Pahawang terasa sangat praktis dan menyenangkan. Layanan penjemputan di Bandara Radin Inten II tepat waktu dengan armada HiAce Premio yang bersih dan nyaman."
                        </p>
                        <div class="testi-stars">
                          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <div class="testi-trip-badge">
                          <i class="fa-solid fa-umbrella-beach"></i> Family Private Trip Pahawang
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Kolom Track 2: Bergerak Kebawah -->
                <div class="testi-col-track track-col-2">
                  <div class="testi-track-inner">
                    <!-- Group 2 -->
                    <div class="testi-group">
                      <!-- Card 4: Instansi / Kedinasan -->
                      <div class="testimonial-card">
                        <div class="testimonial-card-top">
                          <div class="testi-author">
                            <div class="author-avatar avatar-4">NH</div>
                            <div>
                              <h4 class="author-name">Nurdin Hidayat, S.Sos., M.M.</h4>
                              <p class="author-role">Koordinator Kunker Instansi Kedinasan</p>
                            </div>
                          </div>
                        </div>
                        <p class="testi-text">
                          "Agenda study banding dan capacity building tim kami ke Bromo & Malang berjalan tertib, aman, dan sangat berkesan. Nirwana Tour sangat profesional dalam penyusunan SPJ administrasi resmi dinas."
                        </p>
                        <div class="testi-stars">
                          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <div class="testi-trip-badge">
                          <i class="fa-solid fa-landmark"></i> Capacity Building & Kunker (35 Peserta)
                        </div>
                      </div>

                      <!-- Card 5: Corporate Gathering HRD -->
                      <div class="testimonial-card">
                        <div class="testimonial-card-top">
                          <div class="testi-author">
                            <div class="author-avatar avatar-2">RD</div>
                            <div>
                              <h4 class="author-name">Ratna Dewi Kusuma</h4>
                              <p class="author-role">Divisi HRD Bank Mandiri Area Lampung</p>
                            </div>
                          </div>
                        </div>
                        <p class="testi-text">
                          "Family gathering tahunan karyawan di Pulau Pahawang sangat sukses! Games outbound-nya seru, makanan seafood segar melimpah, serta dokumentasi drone dan foto underwater-nya luar biasa."
                        </p>
                        <div class="testi-stars">
                          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <div class="testi-trip-badge">
                          <i class="fa-solid fa-building"></i> Company Gathering Pahawang
                        </div>
                      </div>

                      <!-- Card 6: Reuni & Sewa Bus Pariwisata -->
                      <div class="testimonial-card">
                        <div class="testimonial-card-top">
                          <div class="testi-author">
                            <div class="author-avatar avatar-3">BP</div>
                            <div>
                              <h4 class="author-name">Budi Prasetyo, S.T.</h4>
                              <p class="author-role">Ikatan Alumni Universitas Lampung</p>
                            </div>
                          </div>
                        </div>
                        <p class="testi-text">
                          "Pelayanan sewa bus pariwisatanya istimewa. Kondisi armada Big Bus Jetbus sangat bersih, AC dingin, dan suspensi empuk untuk perjalanan jauh ke Bromo-Malang. Sangat terpercaya."
                        </p>
                        <div class="testi-stars">
                          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <div class="testi-trip-badge">
                          <i class="fa-solid fa-bus"></i> Reuni & Overland Trip Bromo
                        </div>
                      </div>
                    </div>

                    <!-- Group 2 Clone (Infinite Loop) -->
                    <div class="testi-group" aria-hidden="true">
                      <!-- Card 4: Instansi / Kedinasan -->
                      <div class="testimonial-card">
                        <div class="testimonial-card-top">
                          <div class="testi-author">
                            <div class="author-avatar avatar-4">NH</div>
                            <div>
                              <h4 class="author-name">Nurdin Hidayat, S.Sos., M.M.</h4>
                              <p class="author-role">Koordinator Kunker Instansi Kedinasan</p>
                            </div>
                          </div>
                        </div>
                        <p class="testi-text">
                          "Agenda study banding dan capacity building tim kami ke Bromo & Malang berjalan tertib, aman, dan sangat berkesan. Nirwana Tour sangat profesional dalam penyusunan SPJ administrasi resmi dinas."
                        </p>
                        <div class="testi-stars">
                          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <div class="testi-trip-badge">
                          <i class="fa-solid fa-landmark"></i> Capacity Building & Kunker (35 Peserta)
                        </div>
                      </div>

                      <!-- Card 5: Corporate Gathering HRD -->
                      <div class="testimonial-card">
                        <div class="testimonial-card-top">
                          <div class="testi-author">
                            <div class="author-avatar avatar-2">RD</div>
                            <div>
                              <h4 class="author-name">Ratna Dewi Kusuma</h4>
                              <p class="author-role">Divisi HRD Bank Mandiri Area Lampung</p>
                            </div>
                          </div>
                        </div>
                        <p class="testi-text">
                          "Family gathering tahunan karyawan di Pulau Pahawang sangat sukses! Games outbound-nya seru, makanan seafood segar melimpah, serta dokumentasi drone dan foto underwater-nya luar biasa."
                        </p>
                        <div class="testi-stars">
                          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <div class="testi-trip-badge">
                          <i class="fa-solid fa-building"></i> Company Gathering Pahawang
                        </div>
                      </div>

                      <!-- Card 6: Reuni & Sewa Bus Pariwisata -->
                      <div class="testimonial-card">
                        <div class="testimonial-card-top">
                          <div class="testi-author">
                            <div class="author-avatar avatar-3">BP</div>
                            <div>
                              <h4 class="author-name">Budi Prasetyo, S.T.</h4>
                              <p class="author-role">Ikatan Alumni Universitas Lampung</p>
                            </div>
                          </div>
                        </div>
                        <p class="testi-text">
                          "Pelayanan sewa bus pariwisatanya istimewa. Kondisi armada Big Bus Jetbus sangat bersih, AC dingin, dan suspensi empuk untuk perjalanan jauh ke Bromo-Malang. Sangat terpercaya."
                        </p>
                        <div class="testi-stars">
                          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <div class="testi-trip-badge">
                          <i class="fa-solid fa-bus"></i> Reuni & Overland Trip Bromo
                        </div>
                      </div>
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
    </section>

    <!-- ========================================================
         FAQ (PERTANYAAN YANG SERING DIAJUKAN - DISEMBUNYIKAN)
         ======================================================== -->
    <section class="section faq-section bg-alt" id="faq" style="display: none;" aria-hidden="true">
      <div class="container">
        <div class="section-header text-center">
          <div class="section-tag"><i class="fa-solid fa-circle-question"></i> Bantuan & Informasi</div>
          <h2 class="section-title">Pertanyaan yang Sering Diajukan (FAQ)</h2>
          <p class="section-subtitle">Temukan jawaban cepat seputar pemesanan paket wisata, armada transportasi, fasilitas, dan syarat perjalanan bersama kami.</p>
        </div>

        <div class="faq-accordion-wrapper">
          <!-- Item 1 -->
          <div class="faq-item">
            <button class="faq-question-btn" type="button" aria-expanded="false">
              <span>Bagaimana alur pemesanan paket wisata di Nirwana Tour Lampung?</span>
              <i class="fa-solid fa-chevron-down faq-arrow"></i>
            </button>
            <div class="faq-answer-panel">
              <p>
                Pemesanan sangat mudah dan cepat! Anda cukup menghubungi konsultan kami via WhatsApp atau mengisi form kontak di website. Tim kami akan mengonfirmasi pilihan destinasi, tanggal berangkat, dan jumlah peserta, lalu mengirimkan proposal penawaran resmi beserta invoice.
              </p>
            </div>
          </div>

          <!-- Item 2 -->
          <div class="faq-item">
            <button class="faq-question-btn" type="button" aria-expanded="false">
              <span>Berapa minimal jumlah peserta untuk Private Trip atau Rombongan?</span>
              <i class="fa-solid fa-chevron-down faq-arrow"></i>
            </button>
            <div class="faq-answer-panel">
              <p>
                Untuk Private Trip, tidak ada batas minimal. Kami melayani mulai dari pasangan (2 orang), keluarga (4–15 orang), hingga ratusan peserta untuk instansi sekolah maupun kantor. Tanggal dan titik penjemputan bebas Anda tentukan sendiri.
              </p>
            </div>
          </div>

          <!-- Item 3 -->
          <div class="faq-item">
            <button class="faq-question-btn" type="button" aria-expanded="false">
              <span>Apakah melayani penjemputan dari luar kota seperti Jakarta atau Palembang?</span>
              <i class="fa-solid fa-chevron-down faq-arrow"></i>
            </button>
            <div class="faq-answer-panel">
              <p>
                Ya, tentu saja! Kami melayani penjemputan dari Bandara Radin Inten II, Stasiun Tanjung Karang, Pelabuhan Bakauheni, maupun penjemputan langsung dari kota asal Anda (Jakarta, Bogor, Tangerang, Bekasi, atau Palembang) menggunakan armada bus pariwisata VIP kami.
              </p>
            </div>
          </div>

          <!-- Item 4 -->
          <div class="faq-item">
            <button class="faq-question-btn" type="button" aria-expanded="false">
              <span>Bagaimana sistem pembayaran dan ketentuan Down Payment (DP)?</span>
              <i class="fa-solid fa-chevron-down faq-arrow"></i>
            </button>
            <div class="faq-answer-panel">
              <p>
                Pemesanan resmi dilakukan dengan pembayaran DP sebesar 30%–50% setelah proposal disetujui. Sisa pelunasan dapat dibayarkan H-3 sebelum keberangkatan atau saat hari H penjemputan. Kami menerbitkan kuitansi dan invoice resmi berstempel perusahaan legal.
              </p>
            </div>
          </div>

          <!-- Item 5 -->
          <div class="faq-item">
            <button class="faq-question-btn" type="button" aria-expanded="false">
              <span>Apa saja perlengkapan yang disediakan saat trip snorkeling (misal: Pahawang)?</span>
              <i class="fa-solid fa-chevron-down faq-arrow"></i>
            </button>
            <div class="faq-answer-panel">
              <p>
                Paket wisata bahari kami sudah lengkap (All-In): sewa perahu jelajah, pelampung (life jacket), kacamata masker snorkel, pemandu underwater, dokumentasi kamera bawah air GoPro (foto bersama nemo), makan siang prasmanan, air mineral, dan P3K darurat.
              </p>
            </div>
          </div>

          <!-- Item 6 -->
          <div class="faq-item">
            <button class="faq-question-btn" type="button" aria-expanded="false">
              <span>Bagaimana jika terjadi cuaca ekstrem atau kendala alam (Force Majeure)?</span>
              <i class="fa-solid fa-chevron-down faq-arrow"></i>
            </button>
            <div class="faq-answer-panel">
              <p>
                Keselamatan wisatawan adalah prioritas mutlak. Jika otoritas pelabuhan/BMKG melarang pelayaran karena cuaca buruk, trip dapat dijadwalkan ulang (*reschedule*) tanpa hangus atau dialihkan ke destinasi darat alternatif secara fleksibel sesuai kesepakatan bersama.
              </p>
            </div>
          </div>
        </div>

        <div class="faq-contact-card">
          <div class="faq-contact-text">
            <h4>Punya pertanyaan spesifik lainnya?</h4>
            <p>Konsultan wisata Nirwana Tour siap membantu dan memberikan solusi perjalanan terbaik untuk Anda.</p>
          </div>
          <a href="#" class="btn btn-whatsapp wa-link-btn" data-wa-msg="Halo Nirwana Tour, saya ingin bertanya lebih lanjut mengenai paket wisata.">
            <i class="fa-brands fa-whatsapp"></i> Chat Admin Sekarang
          </a>
        </div>
      </div>
    </section>

    <!-- ========================================================
         8. KONTAK SECTION
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

          <!-- Form Kontak Cepat -->
          <div class="contact-form-card">
            <h3 class="contact-card-title">Kirim Pesan & Pengajuan Proposal</h3>
            <p class="form-instruction">Isi formulir ringkas ini untuk langsung mengarahkan pesan terstruktur ke WhatsApp konsultan kami.</p>

            <form id="contactForm" class="contact-form">
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
                  <label for="formService">Jenis Layanan</label>
                  <div class="input-icon-group">
                    <i class="fa-solid fa-compass"></i>
                    <select id="formService" name="service" class="form-control">
                      <option value="Paket Wisata Lampung">Paket Wisata Lampung</option>
                      <option value="Study Tour Sekolah">Study Tour Sekolah</option>
                      <option value="Gathering Perusahaan">Gathering Perusahaan</option>
                      <option value="Sewa Bus & HiAce">Sewa Bus & HiAce Pariwisata</option>
                      <option value="Custom Trip Rombongan">Custom Trip Rombongan</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="formParticipants">Estimasi Jumlah Peserta & Rencana Tanggal</label>
                <div class="input-icon-group">
                  <i class="fa-solid fa-calendar-days"></i>
                  <input type="text" id="formParticipants" name="details" class="form-control" placeholder="Contoh: 35 Orang, rencana tgl 20 November">
                </div>
              </div>

              <div class="form-group">
                <label for="formNotes">Catatan / Kebutuhan Khusus</label>
                <textarea id="formNotes" name="notes" class="form-control" rows="3" placeholder="Tuliskan tujuan yang diinginkan atau fasilitas khusus yang dibutuhkan..."></textarea>
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
