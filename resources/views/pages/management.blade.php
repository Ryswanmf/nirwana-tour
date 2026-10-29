@extends('layouts.app')

@section('title', 'Manajemen & Tim Profesional - ' . ($settings['site_name'] ?? 'Nirwana Tour Lampung'))
@section('meta_description', 'Mengenal jajaran manajemen dan tim pemandu profesional berlisensi HPI di Nirwana Tour Lampung yang siap menemani perjalanan wisata Anda.')

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
          <span class="current">Manajemen & Tim</span>
        </nav>
        <h1 class="page-hero-title">Manajemen & Tim Profesional</h1>
        <p class="page-hero-desc">
          Mengenal lebih dekat pribadi-pribadi berdedikasi di balik layanan prima Nirwana Tour Lampung—mulai dari pimpinan, tour leader berlisensi HPI, hingga spesialis keselamatan bahari yang siap menemani liburan Anda.
        </p>
      </div>
    </section>

    <!-- ========================================================
         PROFIL PIMPINAN & FOUNDER UTAMA
         ======================================================== -->
    <section class="section" id="founder">
      <div class="container">
        <div class="story-grid" style="align-items: center;">
          <!-- Foto Pimpinan -->
          <div class="story-media">
            <div class="about-img-wrapper" style="max-width: 440px;">
              <img src="{{ asset('assets/images/pemilik-nirwana.JPG') }}" alt="Pimpinan & Founder Nirwana Tour - Kiki M Alfin" class="about-main-img" style="height: 480px; object-position: center top;">
              <div class="about-founder-label">
                <strong>Kiki M Alfin</strong>
                <span>Pimpinan & Founder Nirwana Tour Lampung</span>
              </div>
              <div class="about-badge-exp">
                <span class="exp-number">8+</span>
                <span class="exp-text">Tahun Memimpin</span>
              </div>
            </div>
          </div>

          <!-- Deskripsi Pimpinan -->
          <div class="story-content">
            <div class="section-tag"><i class="fa-solid fa-user-tie"></i> Kepemimpinan Eksekutif</div>
            <h2 class="section-title">Dedikasi Penuh untuk Pelayanan Wisata Berkelas & Berintegritas</h2>
            <p class="story-lead">
              Dipimpin oleh <strong>Kiki M Alfin</strong>, Nirwana Tour Lampung bertumbuh berlandaskan komitmen tulus dalam memajukan pariwisata Lampung dan Indonesia dengan standar keselamatan tinggi serta kejujuran transaksi.
            </p>
            <p class="story-text">
              Di bawah kepemimpinannya selama lebih dari 8 tahun, Nirwana Tour berhasil melayani lebih dari 15.000 wisatawan nusantara, membangun sinergi kuat dengan puluhan instansi BUMN, kementerian, sekolah, kampus, dan korporasi swasta, serta menggerakkan roda ekonomi masyarakat lokal di destinasi wisata.
            </p>

            <div class="story-quote-card">
              <p>"Bagi kami, keberhasilan sebuah perjalanan bukan hanya tentang sampai di tujuan, tetapi bagaimana setiap tamu kami tersenyum bahagia, merasa nyaman, dan terlindungi di setiap langkahnya."</p>
              <span>— Kiki M Alfin (Pimpinan & Founder Nirwana Tour Lampung)</span>
            </div>

            @php
              $cleanWa = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188');
            @endphp
            <div class="story-action">
              <a href="https://wa.me/{{ $cleanWa }}?text={{ rawurlencode('Halo Nirwana Tour, saya ingin berdiskusi rencana perjalanan rombongan dengan manajemen.') }}"
                 class="btn btn-primary"
                 target="_blank"
                 rel="noopener noreferrer">
                <i class="fa-brands fa-whatsapp"></i> Hubungi Manajemen
              </a>
              <a href="{{ route('profile') }}" class="btn btn-outline">
                <i class="fa-solid fa-building-columns"></i> Lihat Profil Perusahaan
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ========================================================
         SUSUNAN DIVISI & TIM OPERASIONAL
         ======================================================== -->
    <section class="section bg-alt" id="divisi-tim">
      <div class="container">
        <div class="section-header text-center">
          <div class="section-tag"><i class="fa-solid fa-users-gear"></i> Divisi Kerja</div>
          <h2 class="section-title">Struktur Tim Operasional & Lapangan</h2>
          <p class="section-subtitle">Setiap divisi dipimpin oleh tenaga berpengalaman yang mengutamakan keamanan dan kepuasan wisatawan di setiap agenda tour.</p>
        </div>

        <div class="team-grid">
          <!-- Tim 1: Pimpinan & Founder -->
          <div class="team-card">
            <div class="team-card-header">
              <h3 class="team-name">Kiki M Alfin</h3>
              <p class="team-role">Pimpinan & Founder @ Nirwana Tour</p>
            </div>
            <div class="team-photo-wrap">
              <img src="{{ asset('assets/images/pemilik-nirwana.JPG') }}" alt="Pimpinan & Founder Nirwana Tour - Kiki M Alfin" class="team-photo">
            </div>
            <div class="team-social-links">
              <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
              <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
              <a href="#" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a>
            </div>
          </div>

          <!-- Tim 2: Tim Tour Leader & Guide HPI -->
          <div class="team-card">
            <div class="team-card-header">
              <h3 class="team-name">Tim Tour Leader & Guide</h3>
              <p class="team-role">Head Tour Guide @ HPI Lampung</p>
            </div>
            <div class="team-photo-wrap">
              <img src="{{ asset('assets/images/galeri/galeri-1.jpg') }}" alt="Tim Tour Leader Bersertifikat HPI" class="team-photo">
            </div>
            <div class="team-social-links">
              <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
              <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
              <a href="#" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a>
            </div>
          </div>

          <!-- Tim 3: Koordinator Wisata Bahari -->
          <div class="team-card">
            <div class="team-card-header">
              <h3 class="team-name">Koordinator Wisata Bahari</h3>
              <p class="team-role">Marine Safety Specialist @ Teluk Lampung</p>
            </div>
            <div class="team-photo-wrap">
              <img src="{{ asset('assets/images/galeri/galeri-3.jpg') }}" alt="Koordinator Wisata Bahari" class="team-photo">
            </div>
            <div class="team-social-links">
              <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
              <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
              <a href="#" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a>
            </div>
          </div>

          <!-- Tim 4: Customer Care & Reservasi -->
          <div class="team-card">
            <div class="team-card-header">
              <h3 class="team-name">Konsultan Wisata & Reservasi</h3>
              <p class="team-role">Customer Care & Trip Planner @ Nirwana Tour</p>
            </div>
            <div class="team-photo-wrap">
              <img src="{{ asset('assets/images/galeri/galeri-5.jpg') }}" alt="Trip Consultant & Reservasi" class="team-photo">
            </div>
            <div class="team-social-links">
              <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
              <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
              <a href="#" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ========================================================
         STANDAR KOMPETENSI & ETIKA PELAYANAN
         ======================================================== -->
    <section class="section" id="standar-pelayanan">
      <div class="container">
        <div class="section-header text-center">
          <div class="section-tag"><i class="fa-solid fa-award"></i> Etika Kerja</div>
          <h2 class="section-title">4 Standar Pelayanan Pemandu Kami</h2>
          <p class="section-subtitle">Setiap pemandu wisata Nirwana Tour dibekali pembekalan berkala demi menjamin kenyamanan seluruh peserta.</p>
        </div>

        <div class="values-grid">
          <div class="value-card">
            <div class="value-icon-box">
              <i class="fa-solid fa-heart"></i>
            </div>
            <h3 class="value-title">Hospitalitas Tulus</h3>
            <p class="value-desc">
              Menyambut dan mendampingi wisatawan dengan senyum hangat, keramahan khas Indonesia, serta perhatian tulus kepada anak-anak dan lansia.
            </p>
          </div>

          <div class="value-card">
            <div class="value-icon-box">
              <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
            <h3 class="value-title">Disiplin Waktu & Rundown</h3>
            <p class="value-desc">
              Mengelola ketepatan waktu keberangkatan, rute perjalanan, waktu makan, hingga agenda rekreasi secara presisi dan fleksibel di lapangan.
            </p>
          </div>

          <div class="value-card">
            <div class="value-icon-box">
              <i class="fa-solid fa-kit-medical"></i>
            </div>
            <h3 class="value-title">Tanggap Darurat & P3K</h3>
            <p class="value-desc">
              Seluruh guide memiliki sertifikat pertolongan pertama (First Aid/P3K) dan memahami protokol evakuasi cepat saat kondisi darurat.
            </p>
          </div>

          <div class="value-card">
            <div class="value-icon-box">
              <i class="fa-solid fa-book-bookmark"></i>
            </div>
            <h3 class="value-title">Wawasan Destinasi Kaya</h3>
            <p class="value-desc">
              Menyampaikan informasi sejarah, kearifan lokal, dan ekosistem bahari secara edukatif, komunikatif, dan menarik bagi semua peserta.
            </p>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
