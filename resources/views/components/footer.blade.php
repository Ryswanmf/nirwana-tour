<footer class="site-footer" id="footer">
  <div class="container footer-container">
    <!-- Kolom 1: Profil Brand -->
    <div class="footer-col footer-brand-col">
      <div class="footer-brand">
        <img src="{{ asset('assets/logo/Logo-Nirwana.png') }}" alt="Nirwana Tour Lampung" class="footer-logo">
        <div class="brand-text">
          <span class="brand-title">Nirwana <strong>Tour Travel</strong></span>
          <span class="brand-sub">Jelajahi Dunia, Ciptakan Cerita Tak Terlupakan</span>
        </div>
      </div>
      <p class="footer-desc">
        {{ $settings['hero_subtitle'] ?? 'Biro perjalanan wisata resmi berizin di Lampung. Melayani paket wisata Lampung & Nusantara, study tour sekolah, family gathering, dan sewa transportasi pariwisata.' }}
      </p>
      <div class="footer-socials">
        @if(!empty($settings['instagram']))
          <a href="{{ $settings['instagram'] }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram Nirwana Tour"><i class="fa-brands fa-instagram"></i></a>
        @endif
        @if(!empty($settings['tiktok']))
          <a href="{{ $settings['tiktok'] }}" target="_blank" rel="noopener noreferrer" aria-label="TikTok Nirwana Tour"><i class="fa-brands fa-tiktok"></i></a>
        @endif
        @if(!empty($settings['youtube']))
          <a href="{{ $settings['youtube'] }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube Nirwana Tour"><i class="fa-brands fa-youtube"></i></a>
        @endif
      </div>
    </div>

    <!-- Kolom 2: Layanan Kami -->
    <div class="footer-col">
      <h3 class="footer-title">Layanan Unggulan</h3>
      <ul class="footer-links">
        <li><a href="{{ route('packages.index', ['kategori' => 'wisata-lampung']) }}">Tour Pulau Pahawang</a></li>
        <li><a href="{{ route('packages.index', ['kategori' => 'wisata-lampung']) }}">Dolphin Tour Kiluan</a></li>
        <li><a href="{{ route('packages.index', ['kategori' => 'study-tour-edukasi']) }}">Study Tour Sekolah</a></li>
        <li><a href="{{ route('packages.index', ['kategori' => 'wisata-nusantara']) }}">Paket Tour Jogja & Bromo</a></li>
        <li><a href="{{ route('services.index') }}">Sewa Bus Pariwisata</a></li>
      </ul>
    </div>

    <!-- Kolom 4: Kontak & Kantor -->
    <div class="footer-col">
      <h3 class="footer-title">Kantor Operasional</h3>
      <ul class="footer-contact-list">
        <li>
          <i class="fa-solid fa-location-dot"></i>
          <span>{{ $settings['address'] ?? 'Jl. Pangeran Antasari No. 88, Bandar Lampung' }}</span>
        </li>
        <li>
          <i class="fa-solid fa-phone"></i>
          <span>{{ $settings['phone'] ?? '0822-6961-6188' }}</span>
        </li>
        <li>
          <i class="fa-brands fa-whatsapp"></i>
          <span>+{{ $settings['whatsapp_number'] ?? '6282269616188' }}</span>
        </li>
        <li>
          <i class="fa-solid fa-envelope"></i>
          <span>{{ $settings['email'] ?? 'info@nirwanatour.com' }}</span>
        </li>
        <li>
          <i class="fa-solid fa-clock"></i>
          <span>{{ $settings['operating_hours'] ?? 'Senin - Sabtu: 08:00 - 17:00 WIB' }}</span>
        </li>
      </ul>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="container footer-bottom-container">
      <p>&copy; {{ date('Y') }} <strong>{{ $settings['site_name'] ?? 'Nirwana Tour Lampung' }}</strong>. Seluruh Hak Cipta Dilindungi Undang-Undang.</p>
      <div class="footer-legal-links">
        <span>Dibuat oleh <a href="https://www.instagram.com/swiftcode.lpg?utm_source=ig_web_button_share_sheet&rpxt=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer" style="color: inherit; font-weight: 600;">Swift Code Lampung</a></span>
        <span>&bull;</span>
        <a href="{{ route('about') }}">Legalitas Resmi</a>
        <span>&bull;</span>
        <a href="{{ route('contact') }}">Bantuan & Konsultasi</a>
      </div>
    </div>
  </div>
</footer>
