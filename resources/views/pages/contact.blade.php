@extends('layouts.app')

@section('title', 'Hubungi Kami - ' . ($settings['site_name'] ?? 'Nirwana Tour Lampung') . ' | Biro Perjalanan Wisata Terpercaya')
@section('meta_description', 'Kontak dan alamat resmi kantor Nirwana Tour Lampung. Konsultasikan liburan keluarga, paket wisata, study tour, gathering instansi, dan sewa bus pariwisata.')

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
          <span class="current">Hubungi Kami</span>
        </nav>
        <h1 class="page-hero-title">Hubungi Kami</h1>
        <p class="page-hero-desc">
          Konsultasikan ide perjalanan liburan, rencana study tour sekolah, agenda gathering instansi, hingga reservasi transportasi pariwisata bersama tim profesional Nirwana Tour Lampung.
        </p>
      </div>
    </section>

    <!-- ========================================================
         CONTACT SECTION & FORM
         ======================================================== -->
    <section class="section contact-section bg-alt" id="kontak-utama">
      <div class="container">
        <div class="contact-grid">
          <!-- Kolom Kiri: Informasi Kontak & Kantor -->
          <div class="contact-info-card">
            <h3 class="contact-card-title">Informasi Kantor & Kontak Resmi</h3>
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
                  <strong>WhatsApp & Layanan 24 Jam</strong>
                  <p>
                    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6282269616188' }}" target="_blank" rel="noopener noreferrer">
                      +{{ $settings['whatsapp_number'] ?? '6282269616188' }}
                    </a>
                  </p>
                </div>
              </div>

              <!-- Item 3: Telepon Kantor -->
              <div class="contact-item">
                <div class="contact-item-icon icon-clock" style="background: rgba(14, 165, 233, 0.12); color: #0284c7;">
                  <i class="fa-solid fa-phone"></i>
                </div>
                <div class="contact-item-content">
                  <strong>Telepon Kantor</strong>
                  <p>
                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $settings['phone'] ?? '082269616188') }}">
                      {{ $settings['phone'] ?? '0822-6961-6188' }}
                    </a>
                  </p>
                </div>
              </div>

              <!-- Item 4: Email Resmi -->
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

              <!-- Item 5: Jam Pelayanan -->
              <div class="contact-item">
                <div class="contact-item-icon icon-clock">
                  <i class="fa-solid fa-clock"></i>
                </div>
                <div class="contact-item-content">
                  <strong>Jam Pelayanan Kantor</strong>
                  <p>
                    {{ $settings['operating_hours'] ?? 'Senin - Sabtu: 08:00 - 17:00 WIB' }}
                    <br><span style="font-size: 0.82rem; color: #64748b;">Konsultasi Online WhatsApp Siaga 24 Jam</span>
                  </p>
                </div>
              </div>
            </div>

            <!-- WhatsApp Action Button -->
            <div class="contact-wa-action">
              <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6282269616188' }}?text={{ urlencode('Halo Nirwana Tour Lampung, saya ingin berkonsultasi mengenai rencana perjalanan wisata.') }}" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-block btn-lg">
                <i class="fa-brands fa-whatsapp"></i> Chat Langsung via WhatsApp
              </a>
            </div>

            <!-- Social Media Channels -->
            <div class="contact-social-wrap">
              <span>Ikuti Saluran Resmi Kami:</span>
              <div class="social-icons-row">
                <a href="{{ $settings['instagram'] ?? 'https://www.instagram.com/nirwana_tourlampung/?utm_source=ig_web_button_share_sheet' }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram Nirwana Tour"><i class="fa-brands fa-instagram"></i></a>
                <a href="{{ $settings['tiktok'] ?? 'https://www.tiktok.com/@nirwana_tour_travel?is_from_webapp=1&sender_device=pc' }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok Nirwana Tour"><i class="fa-brands fa-tiktok"></i></a>
                <a href="{{ $settings['youtube'] ?? 'https://youtube.com/@nirwanatourlampung?si=ZMFi9b5dvpn0NKfr' }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube Nirwana Tour"><i class="fa-brands fa-youtube"></i></a>
              </div>
            </div>
          </div>

          <!-- Kolom Kanan: Formulir Pengajuan Proposal & Pesan -->
          <div class="contact-form-card">
            <h3 class="contact-card-title">Kirim Pesan & Konsultasi Perjalanan</h3>
            <p class="form-instruction">
              Isi data di bawah ini. Permintaan Anda akan tercatat dalam sistem dan langsung diarahkan ke WhatsApp konsultan kami.
            </p>

            <form action="{{ route('inquiry.store') }}" method="POST" class="contact-form">
              @csrf
              <input type="hidden" name="source" value="contact_page">

              <div class="form-group">
                <label for="pageFormName">Nama Lengkap / Instansi <span class="required">*</span></label>
                <div class="input-icon-group">
                  <i class="fa-solid fa-user"></i>
                  <input type="text" id="pageFormName" name="name" class="form-control" placeholder="Contoh: Budi Santoso / PT Maju Sejahtera" required>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="pageFormPhone">Nomor WhatsApp <span class="required">*</span></label>
                  <div class="input-icon-group">
                    <i class="fa-solid fa-phone"></i>
                    <input type="tel" id="pageFormPhone" name="phone" class="form-control" placeholder="0812-xxxx-xxxx" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="pageFormEmail">Alamat Email (Opsional)</label>
                  <div class="input-icon-group">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" id="pageFormEmail" name="email" class="form-control" placeholder="nama@email.com">
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="pageFormPackage">Pilihan Layanan / Paket Wisata</label>
                  <div class="input-icon-group">
                    <i class="fa-solid fa-compass"></i>
                    <select id="pageFormPackage" name="package_name" class="form-control">
                      <option value="Paket Wisata Lampung">Paket Wisata Lampung</option>
                      <option value="Study Tour Sekolah">Study Tour Sekolah</option>
                      <option value="Gathering Perusahaan">Gathering Perusahaan / Outbound</option>
                      <option value="Sewa Bus Pariwisata & HiAce">Sewa Bus Pariwisata & HiAce</option>
                      <option value="Custom Trip Rombongan">Custom Trip Rombongan</option>
                      @if(isset($packages) && $packages->count() > 0)
                        <optgroup label="Paket Populer Pilihan:">
                          @foreach($packages as $pkg)
                            <option value="{{ $pkg->title }}">{{ $pkg->title }}</option>
                          @endforeach
                        </optgroup>
                      @endif
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="pageFormParticipants">Estimasi Jumlah Peserta</label>
                  <div class="input-icon-group">
                    <i class="fa-solid fa-users"></i>
                    <input type="number" id="pageFormParticipants" name="participants" value="10" min="1" class="form-control" placeholder="Contoh: 30">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="pageFormMessage">Rencana Tanggal & Catatan Kebutuhan Khusus</label>
                <textarea id="pageFormMessage" name="message" class="form-control" rows="4" placeholder="Tuliskan estimasi tanggal keberangkatan, destinasi tujuan, atau fasilitas khusus yang dibutuhkan..."></textarea>
              </div>

              <button type="submit" class="btn btn-primary btn-block btn-lg contact-submit-btn">
                <i class="fa-brands fa-whatsapp"></i> Kirim Permintaan ke WhatsApp
              </button>
            </form>
          </div>
        </div>

        <!-- Banner Peta Mandiri & Luas -->
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
              height="340" 
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