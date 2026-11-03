@extends('layouts.app')

@section('title', 'Profil Nirwana Tour Lampung - Biro Perjalanan Wisata Terpercaya')
@section('meta_description', 'Profil lengkap Nirwana Tour Lampung. Biro perjalanan wisata resmi berizin di Bandar Lampung dengan pengalaman lebih dari 8 tahun melayani ribuan wisatawan Nusantara.')

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
          <span class="current">Profil Nirwana</span>
        </nav>
        <h1 class="page-hero-title">Profil Nirwana Tour Lampung</h1>
        <p class="page-hero-desc">
          Mengenal Nirwana Tour Lampung lebih dekat — biro perjalanan wisata berizin resmi di Bandar Lampung yang berdedikasi menciptakan perjalanan aman, nyaman, berkesan, dan penuh kehangatan sejak 2016.
        </p>
      </div>
    </section>

    <!-- ========================================================
         RINGKASAN IDENTITAS PERUSAHAAN (COMPANY IDENTITY)
         ======================================================== -->
    <section class="section" style="padding-bottom: 0;">
      <div class="container">
        <div style="background: #FFFFFF; border-radius: 20px; border: 1px solid var(--border-color); box-shadow: var(--shadow-md); padding: 32px 36px; margin-top: -60px; position: relative; z-index: 10;">
          <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 24px; align-items: center;">
            <div style="display: flex; align-items: center; gap: 16px;">
              <div style="width: 52px; height: 52px; border-radius: 14px; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.35rem; flex-shrink: 0;">
                <i class="fa-solid fa-building"></i>
              </div>
              <div>
                <span style="display: block; font-size: 0.76rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted); letter-spacing: 0.05em;">Badan Usaha</span>
                <strong style="display: block; font-size: 0.98rem; color: var(--text-main);">{{ $settings['company_legal_name'] ?? 'Nirwana Tour Travel' }}</strong>
              </div>
            </div>

            <div style="display: flex; align-items: center; gap: 16px;">
              <div style="width: 52px; height: 52px; border-radius: 14px; background: rgba(245, 158, 11, 0.12); color: var(--accent-gold); display: flex; align-items: center; justify-content: center; font-size: 1.35rem; flex-shrink: 0;">
                <i class="fa-solid fa-calendar-check"></i>
              </div>
              <div>
                <span style="display: block; font-size: 0.76rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted); letter-spacing: 0.05em;">Tahun Berdiri</span>
                <strong style="display: block; font-size: 0.98rem; color: var(--text-main);">{{ $settings['company_founded_year'] ?? '2016 (8+ Tahun Pengalaman)' }}</strong>
              </div>
            </div>

            <div style="display: flex; align-items: center; gap: 16px;">
              <div style="width: 52px; height: 52px; border-radius: 14px; background: var(--emerald-light); color: var(--emerald); display: flex; align-items: center; justify-content: center; font-size: 1.35rem; flex-shrink: 0;">
                <i class="fa-solid fa-shield-check"></i>
              </div>
              <div>
                <span style="display: block; font-size: 0.76rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted); letter-spacing: 0.05em;">Legalitas Usaha</span>
                <strong style="display: block; font-size: 0.98rem; color: var(--text-main);">{{ $settings['company_legal_license'] ?? 'Resmi OSS BKPM & TDUP' }}</strong>
              </div>
            </div>

            <div style="display: flex; align-items: center; gap: 16px;">
              <div style="width: 52px; height: 52px; border-radius: 14px; background: var(--rose-light); color: var(--rose); display: flex; align-items: center; justify-content: center; font-size: 1.35rem; flex-shrink: 0;">
                <i class="fa-solid fa-location-dot"></i>
              </div>
              <div>
                <span style="display: block; font-size: 0.76rem; text-transform: uppercase; font-weight: 700; color: var(--text-muted); letter-spacing: 0.05em;">Domisili Kantor</span>
                <strong style="display: block; font-size: 0.98rem; color: var(--text-main);">{{ $settings['company_domicile'] ?? ($settings['address'] ?? 'Bandar Lampung, Lampung') }}</strong>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ========================================================
         CERITA & SEJARAH PERUSAHAAN
         ======================================================== -->
    <section class="section" id="cerita">
      <div class="container">
        <div class="story-grid">
          <!-- Text Narrative -->
          <div class="story-content">
            <div class="section-tag"><i class="fa-solid fa-book-open"></i> Cerita Kami</div>
            <h2 class="section-title">{{ $settings['about_story_title'] ?? 'Berawal dari Kecintaan Mendalam pada Pesona Bumi Ruwa Jurai' }}</h2>
            @if(!empty($settings['about_description']))
              <div class="story-lead" style="white-space: pre-line; margin-bottom: 24px; line-height: 1.8;">
                {!! nl2br(e($settings['about_description'])) !!}
              </div>
            @else
              <p class="story-lead">
                <strong>Nirwana Tour Lampung</strong> didirikan atas sebuah visi sederhana namun kuat: mengenalkan keindahan alam dan kekayaan budaya Lampung kepada wisatawan Nusantara dan mancanegara dengan standar layanan yang ramah, profesional, serta transparan.
              </p>
              <p class="story-text">
                Nama <em>"Nirwana"</em> terinspirasi dari keindahan surga bahari Lampung—mulai dari pasir putih Pulau Pahawang, atraksi lumba-lumba liar Teluk Kiluan, hingga megahnya tebing purba Gigi Hiu. Kami meyakini bahwa setiap perjalanan bukan sekadar mengunjungi tempat baru, melainkan proses merajut cerita indah yang dikenang seumur hidup.
              </p>
              <p class="story-text">
                Selama lebih dari 8 tahun perjalanan, Nirwana Tour berkembang dari operator lokal menjadi biro perjalanan wisata berizin resmi dengan jejaring kemitraan luas, mencakup perhotelan bintang, armada transportasi pariwisata berstandar Dishub, pemandu bersertifikasi HPI, serta pengelola destinasi di berbagai penjuru Indonesia.
              </p>
            @endif
            
            <div class="story-quote-card">
              <p>"{{ $settings['owner_quote'] ?? 'Bagi kami, keberhasilan sebuah perjalanan bukan hanya tentang sampai di tujuan, tetapi bagaimana setiap tamu kami tersenyum bahagia dan merasa aman di setiap langkahnya.' }}"</p>
              <span>— {{ $settings['owner_name'] ?? 'Kiki M Alfin' }} ({{ $settings['owner_role'] ?? 'Pimpinan & Founder Nirwana Tour Lampung' }})</span>
            </div>

            <div class="story-action">
              <a href="{{ route('packages.index') }}" class="btn btn-primary">
                <i class="fa-solid fa-compass"></i> Lihat Paket Wisata
              </a>
              @php
                $cleanWa = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188');
              @endphp
              <a href="https://wa.me/{{ $cleanWa }}?text={{ rawurlencode('Halo Nirwana Tour, saya ingin konsultasi perjalanan rombongan.') }}"
                 class="btn btn-outline"
                 target="_blank"
                 rel="noopener noreferrer">
                <i class="fa-brands fa-whatsapp"></i> Hubungi Tim Kami
              </a>
            </div>
          </div>

          <!-- Media Showcase -->
          <div class="story-media">
            <div class="about-img-wrapper">
              @php
                $teamPhotoSrc = !empty($settings['about_team_photo']) ? storage_or_asset($settings['about_team_photo']) : (!empty($settings['owner_photo']) ? storage_or_asset($settings['owner_photo']) : asset('assets/images/hero/about-team.jpg'));
              @endphp
              <img src="{{ $teamPhotoSrc }}" alt="Tim Nirwana Tour Lampung" class="about-main-img" loading="lazy" decoding="async">
              <div class="about-founder-label">
                <strong>Manajemen & Tim Operasional</strong>
                <span>{{ $settings['site_name'] ?? 'Nirwana Tour Lampung' }}</span>
              </div>
              <div class="about-badge-exp">
                <span class="exp-number">{{ $settings['stat_years_count'] ?? '8+' }}</span>
                <span class="exp-text">{{ $settings['stat_years_label'] ?? 'Tahun Melayani Nusantara' }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Key Stats Counter -->
        <div class="about-stats-grid">
          <div class="about-stat-card">
            <div class="about-stat-icon">
              <i class="fa-solid fa-calendar-check"></i>
            </div>
            <span class="about-stat-num">{{ $settings['stat_years_count'] ?? '8+' }}</span>
            <h4 class="about-stat-title">{{ $settings['stat_years_label'] ?? 'Tahun Pengalaman' }}</h4>
            <p>Konsisten melayani sejak {{ $settings['company_founded_year'] ?? '2016' }} di industri pariwisata</p>
          </div>

          <div class="about-stat-card">
            <div class="about-stat-icon">
              <i class="fa-solid fa-users"></i>
            </div>
            <span class="about-stat-num">{{ $settings['stat_tourists_count'] ?? '15.000+' }}</span>
            <h4 class="about-stat-title">{{ $settings['stat_tourists_label'] ?? 'Wisatawan Terlayani' }}</h4>
            <p>Keluarga, komunitas, sekolah, dan perusahaan</p>
          </div>

          <div class="about-stat-card">
            <div class="about-stat-icon">
              <i class="fa-solid fa-route"></i>
            </div>
            <span class="about-stat-num">{{ $settings['stat_trips_count'] ?? '500+' }}</span>
            <h4 class="about-stat-title">{{ $settings['stat_trips_label'] ?? 'Trip Sukses Dijalankan' }}</h4>
            <p>Paket bahari Lampung hingga domestik Nusantara</p>
          </div>

          <div class="about-stat-card">
            <div class="about-stat-icon">
              <i class="fa-solid fa-shield-halved"></i>
            </div>
            <span class="about-stat-num">{{ $settings['stat_legal_count'] ?? '100%' }}</span>
            <h4 class="about-stat-title">{{ $settings['stat_legal_label'] ?? 'Legalitas Resmi' }}</h4>
            <p>Terdaftar resmi di OSS Kemeninvestasi & Kemenparekraf</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ========================================================
         VISI & MISI PERUSAHAAN
         ======================================================== -->
    <section class="section bg-alt" id="visimisi">
      <div class="container">
        <div class="section-header text-center">
          <div class="section-tag"><i class="fa-solid fa-bullseye"></i> Komitmen Jangka Panjang</div>
          <h2 class="section-title">Visi & Misi {{ $settings['site_name'] ?? 'Nirwana Tour Lampung' }}</h2>
          <p class="section-subtitle">Landasan utama kami dalam berkarya dan memberikan pelayanan pariwisata terbaik bagi setiap pelanggan.</p>
        </div>

        <div class="vision-mission-grid">
          <!-- Visi Card -->
          <div class="vm-card">
            <div class="vm-header">
              <div class="vm-icon">
                <i class="fa-solid fa-eye"></i>
              </div>
              <h3>Visi Kami</h3>
            </div>
            <div class="vm-body">
              <p style="margin-bottom: 24px;">
                {{ $settings['company_vision'] ?? 'Menjadi biro perjalanan wisata terdepan, tepercaya, dan bereputasi prima di Lampung serta Indonesia, yang dikenal atas keunggulan layanan, integritas bisnis, standar keselamatan tinggi, dan kontribusi nyata dalam memajukan potensi pariwisata lokal yang berkelanjutan.' }}
              </p>
              <div style="margin-top: auto; border-top: 1px solid var(--border-light); padding-top: 20px;">
                <div style="font-size: 0.82rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--primary); margin-bottom: 12px;">Pilar Komitmen Utama:</div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                  <div style="display: flex; align-items: center; gap: 8px; font-size: 0.88rem; font-weight: 600; color: var(--text-main);">
                    <i class="fa-solid fa-circle-check" style="color: var(--primary); font-size: 0.95rem;"></i> Integritas Bisnis
                  </div>
                  <div style="display: flex; align-items: center; gap: 8px; font-size: 0.88rem; font-weight: 600; color: var(--text-main);">
                    <i class="fa-solid fa-circle-check" style="color: var(--primary); font-size: 0.95rem;"></i> Standar Zero Accident
                  </div>
                  <div style="display: flex; align-items: center; gap: 8px; font-size: 0.88rem; font-weight: 600; color: var(--text-main);">
                    <i class="fa-solid fa-circle-check" style="color: var(--primary); font-size: 0.95rem;"></i> Kepuasan Tamu 99%
                  </div>
                  <div style="display: flex; align-items: center; gap: 8px; font-size: 0.88rem; font-weight: 600; color: var(--text-main);">
                    <i class="fa-solid fa-circle-check" style="color: var(--primary); font-size: 0.95rem;"></i> Legalitas & Lisensi Resmi
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Misi Card -->
          <div class="vm-card mission-card">
            <div class="vm-header">
              <div class="vm-icon">
                <i class="fa-solid fa-crosshairs"></i>
              </div>
              <h3>Misi Kami</h3>
            </div>
            <div class="vm-body">
              <ul class="mission-list">
                <li class="mission-item">
                  <span class="mission-bullet">1</span>
                  <div class="mission-text">
                    {{ $settings['company_mission_1'] ?? 'Pelayanan Profesional & Berhati: Menyediakan layanan wisata dengan keramahan khas Indonesia serta pendampingan tour leader yang terlatih dan berlisensi.' }}
                  </div>
                </li>
                <li class="mission-item">
                  <span class="mission-bullet">2</span>
                  <div class="mission-text">
                    {{ $settings['company_mission_2'] ?? 'Keselamatan Nomor Satu: Mengedepankan standar operasional prosedur (SOP) keselamatan ketat pada seluruh armada darat, kapal laut, dan aktivitas outdoor.' }}
                  </div>
                </li>
                <li class="mission-item">
                  <span class="mission-bullet">3</span>
                  <div class="mission-text">
                    {{ $settings['company_mission_3'] ?? 'Transparansi & Nilai Maksimal: Menghadirkan paket wisata berkualitas tinggi dengan rincian harga jujur tanpa biaya siluman (no hidden fees).' }}
                  </div>
                </li>
                <li class="mission-item">
                  <span class="mission-bullet">4</span>
                  <div class="mission-text">
                    {{ $settings['company_mission_4'] ?? 'Pemberdayaan Lokal Berkelanjutan: Menggandeng masyarakat setempat, pemandu lokal, dan UMKM daerah untuk memajukan ekosistem ekonomi pariwisata.' }}
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ========================================================
         NILAI-NILAI UTAMA (CORE VALUES)
         ======================================================== -->
    <section class="section" id="nilai">
      <div class="container">
        <div class="section-header text-center">
          <div class="section-tag"><i class="fa-solid fa-gem"></i> Prinsip Kerja</div>
          <h2 class="section-title">Nilai-Nilai Utama Perusahaan</h2>
          <p class="section-subtitle">Empat pilar budaya kerja yang kami pegang teguh dalam setiap interaksi dan operasional trip.</p>
        </div>

        <div class="values-grid">
          <div class="value-card">
            <div class="value-icon-box">
              <i class="fa-solid fa-handshake"></i>
            </div>
            <h3 class="value-title">{{ $settings['value_1_title'] ?? 'Integritas & Kejujuran' }}</h3>
            <p class="value-desc">
              {{ $settings['value_1_desc'] ?? 'Kami menjunjung tinggi keterbukaan informasi. Fasilitas, jadwal, dan biaya yang kami sampaikan di awal adalah apa yang benar-benar Anda terima di lapangan.' }}
            </p>
          </div>

          <div class="value-card">
            <div class="value-icon-box">
              <i class="fa-solid fa-shield-heart"></i>
            </div>
            <h3 class="value-title">{{ $settings['value_2_title'] ?? 'Keselamatan Utama' }}</h3>
            <p class="value-desc">
              {{ $settings['value_2_desc'] ?? 'Kesiapan armada prima, kelengkapan life jacket standar, kotak P3K lengkap, serta asuransi perjalanan menjamin ketenangan keluarga dan rombongan Anda.' }}
            </p>
          </div>

          <div class="value-card">
            <div class="value-icon-box">
              <i class="fa-solid fa-smile-beam"></i>
            </div>
            <h3 class="value-title">{{ $settings['value_3_title'] ?? 'Hospitalitas Tulus' }}</h3>
            <p class="value-desc">
              {{ $settings['value_3_desc'] ?? 'Senyum, sapa, dan kepedulian dari tim guide kami bukan sekadar tuntutan kerja, melainkan komitmen hati untuk membuat Anda merasa seperti keluarga.' }}
            </p>
          </div>

          <div class="value-card">
            <div class="value-icon-box">
              <i class="fa-solid fa-sliders"></i>
            </div>
            <h3 class="value-title">{{ $settings['value_4_title'] ?? 'Fleksibilitas Solutif' }}</h3>
            <p class="value-desc">
              {{ $settings['value_4_desc'] ?? 'Kami memahami kebutuhan setiap rombongan unik. Kami siap merancang itinerary kustom yang tepat guna sesuai durasi, preferensi, dan anggaran Anda.' }}
            </p>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
