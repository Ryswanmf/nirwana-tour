@extends('layouts.app')

@section('title', 'Legalitas Resmi & Sertifikasi - ' . ($settings['site_name'] ?? 'Nirwana Tour Lampung'))
@section('meta_description', 'Dokumen legalitas resmi, izin usaha OSS, sertifikasi pemandu HPI, izin armada Dishub, dan asuransi resmi Nirwana Tour Lampung.')

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
          <span class="current">Legalitas & Sertifikasi</span>
        </nav>
        <h1 class="page-hero-title">Legalitas Resmi & Sertifikasi Usaha</h1>
        <p class="page-hero-desc">
          Komitmen penuh Nirwana Tour Lampung terhadap kepatuhan regulasi pemerintah, standar keamanan operasional pariwisata, serta jaminan perlindungan perjalanan bagi seluruh wisatawan.
        </p>
      </div>
    </section>

    <!-- ========================================================
         RINGKASAN STATUS LEGALITAS (TRUST SEAL)
         ======================================================== -->
    <section class="section" style="padding-bottom: 0;">
      <div class="container">
        <div style="background: linear-gradient(135deg, #0B1329 0%, #1E293B 100%); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1); box-shadow: var(--shadow-xl); padding: 36px 40px; margin-top: -60px; position: relative; z-index: 10; color: #FFFFFF;">
          <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 24px;">
            <div style="max-width: 650px;">
              <div style="display: inline-flex; align-items: center; gap: 8px; background: transparent; color: #34D399; font-size: 0.85rem; font-weight: 700; padding: 3px 0 3px 12px; border-left: 3px solid #34D399; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 1px;">
                <i class="fa-solid fa-circle-check"></i> Status Perizinan: 100% Aktif & Terverifikasi
              </div>
              <h2 style="font-size: 1.5rem; font-weight: 800; color: #FFFFFF; margin-bottom: 8px;">
                Biro Perjalanan Wisata Terdaftar Secara Hukum di NKRI
              </h2>
              <p style="font-size: 0.94rem; color: #CBD5E1; line-height: 1.6; margin: 0;">
                Seluruh aktivitas operasional Nirwana Tour Lampung dilindungi oleh izin biro perjalanan wisata resmi, terintegrasi pada sistem OSS BKPM, serta memenuhi standar keamanan pariwisata nasional.
              </p>
            </div>

            @php
              $cleanWa = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188');
            @endphp
            <div>
              <a href="https://wa.me/{{ $cleanWa }}?text={{ rawurlencode('Halo Nirwana Tour, saya ingin meminta berkas legalitas dan company profile resmi perusahaan.') }}"
                 class="btn btn-primary"
                 target="_blank"
                 rel="noopener noreferrer"
                 style="white-space: nowrap; padding: 14px 24px; font-weight: 700;">
                <i class="fa-solid fa-file-arrow-down"></i> Minta Berkas Legalitas
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ========================================================
         6 PILAR DOKUMEN LEGALITAS LENGKAP
         ======================================================== -->
    <section class="section" id="dokumen-legalitas">
      <div class="container">
        <div class="section-header text-center">
          <div class="section-tag"><i class="fa-solid fa-certificate"></i> Dokumen Resmi</div>
          <h2 class="section-title">Dokumen Perizinan & Sertifikasi Resmi</h2>
          <p class="section-subtitle">Kredibilitas teruji untuk kebutuhan pengadaan wisata instansi pemerintah, BUMN, lembaga pendidikan, maupun korporasi swasta.</p>
        </div>

        <div class="legal-grid">
          <!-- 1. NIB OSS -->
          <div class="legal-card" style="background: #FFFFFF; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); color: var(--text-main);">
            <div class="legal-card-header">
              <i class="fa-solid fa-id-card-clip legal-icon" style="color: var(--primary);"></i>
              <h4 style="color: var(--text-main);">Nomor Induk Berusaha (NIB)</h4>
              <span style="margin-left: auto; background: rgba(16, 185, 129, 0.15); color: #059669; font-size: 0.72rem; padding: 3px 8px; border-radius: 6px; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;"><i class="fa-solid fa-check"></i> OSS BKPM</span>
            </div>
            <p style="color: var(--text-muted);">
              Terdaftar secara sah pada sistem OSS (Online Single Submission) Kementerian Investasi/BKPM Republik Indonesia dengan klasifikasi baku KBLI 79120 (Biro Perjalanan Wisata).
            </p>
          </div>

          <!-- 2. TDUP Pariwisata -->
          <div class="legal-card" style="background: #FFFFFF; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); color: var(--text-main);">
            <div class="legal-card-header">
              <i class="fa-solid fa-file-contract legal-icon" style="color: var(--primary);"></i>
              <h4 style="color: var(--text-main);">Izin Usaha Pariwisata (TDUP)</h4>
              <span style="margin-left: auto; background: rgba(16, 185, 129, 0.15); color: #059669; font-size: 0.72rem; padding: 3px 8px; border-radius: 6px; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;"><i class="fa-solid fa-check"></i> Pemda Aktif</span>
            </div>
            <p style="color: var(--text-muted);">
              Memiliki Tanda Daftar Usaha Pariwisata yang diakui Dinas Kebudayaan dan Pariwisata Pemerintah Kota Bandar Lampung untuk menyelenggarakan jasa tur dan perjalanan.
            </p>
          </div>

          <!-- 3. Lisensi HPI -->
          <div class="legal-card" style="background: #FFFFFF; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); color: var(--text-main);">
            <div class="legal-card-header">
              <i class="fa-solid fa-users-gear legal-icon" style="color: var(--primary);"></i>
              <h4 style="color: var(--text-main);">Lisensi Pemandu Resmi HPI</h4>
              <span style="margin-left: auto; background: rgba(16, 185, 129, 0.15); color: #059669; font-size: 0.72rem; padding: 3px 8px; border-radius: 6px; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;"><i class="fa-solid fa-check"></i> BNSP & HPI</span>
            </div>
            <p style="color: var(--text-muted);">
              Seluruh Tour Leader dan koordinator pemandu lapangan memegang kartu lisensi kompetensi dari DPD Himpunan Pramuwisata Indonesia (HPI) Provinsi Lampung.
            </p>
          </div>

          <!-- 4. Izin Armada Dishub -->
          <div class="legal-card" style="background: #FFFFFF; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); color: var(--text-main);">
            <div class="legal-card-header">
              <i class="fa-solid fa-bus legal-icon" style="color: var(--primary);"></i>
              <h4 style="color: var(--text-main);">Armada Berizin Resmi Dishub</h4>
              <span style="margin-left: auto; background: rgba(16, 185, 129, 0.15); color: #059669; font-size: 0.72rem; padding: 3px 8px; border-radius: 6px; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;"><i class="fa-solid fa-check"></i> Uji KIR Aktif</span>
            </div>
            <p style="color: var(--text-muted);">
              Seluruh bus dan HiAce pariwisata yang kami operasikan memiliki izin trayek pariwisata resmi dari Dinas Perhubungan, uji KIR berkala aktif, dan pengemudi profesional.
            </p>
          </div>

          <!-- 5. Asuransi Perjalanan -->
          <div class="legal-card" style="background: #FFFFFF; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); color: var(--text-main);">
            <div class="legal-card-header">
              <i class="fa-solid fa-shield-virus legal-icon" style="color: var(--primary);"></i>
              <h4 style="color: var(--text-main);">Jaminan Asuransi Resmi</h4>
              <span style="margin-left: auto; background: rgba(16, 185, 129, 0.15); color: #059669; font-size: 0.72rem; padding: 3px 8px; border-radius: 6px; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;"><i class="fa-solid fa-check"></i> Terproteksi</span>
            </div>
            <p style="color: var(--text-muted);">
              Perlindungan asuransi kecelakaan diri perjalanan wisata resmi untuk menjamin keselamatan dan kenyamanan seluruh rombongan selama masa trip berlangsung.
            </p>
          </div>

          <!-- 6. Faktur Pajak B2B -->
          <div class="legal-card" style="background: #FFFFFF; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); color: var(--text-main);">
            <div class="legal-card-header">
              <i class="fa-solid fa-file-invoice-dollar legal-icon" style="color: var(--primary);"></i>
              <h4 style="color: var(--text-main);">Kelayakan Transaksi B2B</h4>
              <span style="margin-left: auto; background: rgba(16, 185, 129, 0.15); color: #059669; font-size: 0.72rem; padding: 3px 8px; border-radius: 6px; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;"><i class="fa-solid fa-check"></i> NPWP & Faktur</span>
            </div>
            <p style="color: var(--text-muted);">
              Memiliki NPWP Badan Usaha aktif, rekening bank resmi atas nama perusahaan, dan siap menerbitkan MoU, proposal penawaran, invoice resmi, faktur pajak, serta kwitansi bermaterai.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- ========================================================
         ASOSIASI & JEJARING PARIWISATA
         ======================================================== -->
    <section class="section bg-alt" id="asosiasi">
      <div class="container">
        <div class="section-header text-center">
          <div class="section-tag"><i class="fa-solid fa-handshake"></i> Standar Kemitraan</div>
          <h2 class="section-title">Kemitraan & Afiliasi Resmi</h2>
          <p class="section-subtitle">Mendukung program pariwisata nasional dan berkolaborasi dengan asosiasi kepariwisataan resmi di Indonesia.</p>
        </div>

        <div style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; gap: 36px; padding: 20px 0;">
          <div style="background: #FFFFFF; padding: 20px 30px; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); display: flex; align-items: center; gap: 14px;">
            <img src="{{ asset('assets/images/wonderful.png') }}" alt="Wonderful Indonesia" style="height: 48px; width: auto; object-fit: contain;" loading="lazy" decoding="async">
            <div>
              <strong style="display: block; font-size: 0.94rem; color: var(--text-main);">Wonderful Indonesia</strong>
              <span style="font-size: 0.78rem; color: var(--text-muted);">Kemenparekraf RI</span>
            </div>
          </div>

          <div style="background: #FFFFFF; padding: 20px 30px; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); display: flex; align-items: center; gap: 14px;">
            <img src="{{ asset('assets/images/lampung.png') }}" alt="Pariwisata Lampung" style="height: 48px; width: auto; object-fit: contain;" loading="lazy" decoding="async">
            <div>
              <strong style="display: block; font-size: 0.94rem; color: var(--text-main);">Pariwisata Lampung</strong>
              <span style="font-size: 0.78rem; color: var(--text-muted);">Dinas Pariwisata Daerah</span>
            </div>
          </div>

          <div style="background: #FFFFFF; padding: 20px 30px; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); display: flex; align-items: center; gap: 14px;">
            <img src="{{ asset('assets/images/asita.png') }}" alt="ASITA" style="height: 48px; width: auto; object-fit: contain;" loading="lazy" decoding="async">
            <div>
              <strong style="display: block; font-size: 0.94rem; color: var(--text-main);">ASITA Indonesia</strong>
              <span style="font-size: 0.78rem; color: var(--text-muted);">Asosiasi Tour & Travel</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ========================================================
         FAQ LEGALITAS & KEAMANAN
         ======================================================== -->
    <section class="section" id="faq-legalitas">
      <div class="container">
        <div class="section-header text-center" style="max-width: 680px; margin: 0 auto 40px auto;">
          <div class="section-tag"><i class="fa-solid fa-circle-question"></i> Tanya Jawab</div>
          <h2 class="section-title">Pertanyaan Seputar Legalitas & Keamanan</h2>
          <p class="section-subtitle">Penjelasan transparan seputar aspek legalitas transaksi dan jaminan keselamatan rombongan Anda.</p>
        </div>

        <div style="max-width: 820px; margin: 0 auto; display: flex; flex-direction: column; gap: 18px;">
          <div style="background: #FFFFFF; border-radius: 16px; border: 1px solid var(--border-color); padding: 24px 28px; box-shadow: var(--shadow-sm);">
            <h4 style="font-size: 1.05rem; font-weight: 700; color: var(--text-main); margin-bottom: 8px;">
              Apakah Nirwana Tour Lampung dapat menerbitkan Invoice dan Faktur Pajak resmi untuk instansi?
            </h4>
            <p style="font-size: 0.92rem; color: var(--text-muted); line-height: 1.65; margin: 0;">
              Ya, tentu. Kami memiliki NPWP Badan Usaha aktif dan rekening giro resmi perusahaan. Kami siap menerbitkan proposal penawaran, MoU kerjasama, Surat Perjanjian Kerja (SPK), invoice resmi, faktur pajak, dan kwitansi bermaterai untuk kebutuhan audit administrasi kantor Anda.
            </p>
          </div>

          <div style="background: #FFFFFF; border-radius: 16px; border: 1px solid var(--border-color); padding: 24px 28px; box-shadow: var(--shadow-sm);">
            <h4 style="font-size: 1.05rem; font-weight: 700; color: var(--text-main); margin-bottom: 8px;">
              Bagaimana jaminan keamanan dan keselamatan selama trip bahari berlangsung?
            </h4>
            <p style="font-size: 0.92rem; color: var(--text-muted); line-height: 1.65; margin: 0;">
              Keselamatan adalah prioritas nomor satu. Kami hanya menggunakan kapal tradisional bermesin ganda terawat dengan nakhoda berlisensi bahari, life jacket standar SNI untuk setiap peserta, alat snorkeling steril, serta kotak P3K lengkap. Kami juga memantau info cuaca maritim BMKG secara real-time sebelum pelayaran dilakukan.
            </p>
          </div>

          <div style="background: #FFFFFF; border-radius: 16px; border: 1px solid var(--border-color); padding: 24px 28px; box-shadow: var(--shadow-sm);">
            <h4 style="font-size: 1.05rem; font-weight: 700; color: var(--text-main); margin-bottom: 8px;">
              Apakah pembayaran DP dan pelunasan dijamin aman?
            </h4>
            <p style="font-size: 0.92rem; color: var(--text-muted); line-height: 1.65; margin: 0;">
              Sangat aman. Seluruh transaksi pembayaran ditujukan ke rekening resmi perusahaan yang terverifikasi. Setelah pembayaran diterima, tim keuangan kami segera menerbitkan tanda terima pembayaran resmi (*Official Receipt*) dan dokumen konfirmasi pemesanan trip.
            </p>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
