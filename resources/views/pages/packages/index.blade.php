@extends('layouts.app')

@section('title', 'Paket Wisata - ' . ($settings['site_name'] ?? 'Nirwana Tour Lampung') . ' | Biro Perjalanan Terpercaya')
@section('meta_description', 'Pilihan paket wisata unggulan di Lampung, Jawa, Bromo, Malang, Jogja, Bali, dan karya wisata edukatif sekolah bersama Nirwana Tour Lampung.')

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
          <span class="current">Paket Wisata</span>
        </nav>
        <h1 class="page-hero-title">Daftar Paket Wisata</h1>
        <p class="page-hero-desc">
          Eksplorasi ragam pilihan paket wisata unggulan di Lampung dan Nusantara dengan fasilitas lengkap, jadwal fleksibel, dan jaminan kenyamanan perjalanan Anda.
        </p>
      </div>
    </section>

    <!-- ========================================================
         LISTING SECTION & FILTER SEJAJAR
         ======================================================== -->
    <section class="section bg-alt" id="katalog-destinasi">
      <div class="container">

        <!-- FILTER & PENCARIAN DESTINASI SEJAJAR -->
        <div class="news-filter-container">
          <form action="{{ route('packages.index') }}" method="GET" class="news-filter-bar">
            <!-- Filter Kategori Custom Dropdown -->
            <div class="news-filter-group news-filter-group-category">
              <div class="news-custom-dropdown" id="destCategoryDropdown">
                <input type="hidden" name="kategori" id="destCategoryInput" value="{{ request('kategori') }}">
                <button type="button" class="news-dropdown-trigger" id="destCategoryTrigger" aria-haspopup="listbox" aria-expanded="false" title="Pilih Kategori Paket Wisata">
                  <span class="news-dropdown-selected-text">
                    <i class="fa-solid fa-compass news-filter-icon"></i>
                    <span class="news-dropdown-label">
                      {{ request('kategori') && $categories->firstWhere('slug', request('kategori')) ? $categories->firstWhere('slug', request('kategori'))->name : 'Semua Paket Wisata' }}
                    </span>
                  </span>
                  <i class="fa-solid fa-chevron-down news-dropdown-arrow"></i>
                </button>

                <div class="news-dropdown-menu" id="destCategoryMenu" role="listbox">
                  <!-- Quick search/filter inside category dropdown -->
                  <div class="news-dropdown-search-wrap">
                    <i class="fa-solid fa-magnifying-glass news-dropdown-search-icon"></i>
                    <input type="text" id="destDropdownFilterInput" placeholder="Cari kategori paket..." class="news-dropdown-search-input" autocomplete="off">
                  </div>
                  <!-- Scrollable Category List -->
                  <div class="news-dropdown-scroll" id="destCategoryList">
                    <div class="news-dropdown-item {{ !request('kategori') ? 'active' : '' }}" data-value="" data-label="Semua Paket Wisata" role="option">
                      <span>Semua Paket Wisata</span>
                      @if(!request('kategori'))
                        <i class="fa-solid fa-check news-dropdown-check"></i>
                      @endif
                    </div>
                    @if(isset($categories))
                      @foreach($categories as $cat)
                        <div class="news-dropdown-item {{ request('kategori') == $cat->slug ? 'active' : '' }}" 
                             data-value="{{ $cat->slug }}" 
                             data-label="{{ $cat->name }}" 
                             role="option">
                          <span>{{ $cat->name }}</span>
                          @if(request('kategori') == $cat->slug)
                            <i class="fa-solid fa-check news-dropdown-check"></i>
                          @endif
                        </div>
                      @endforeach
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <!-- Divider -->
            <div class="news-filter-divider"></div>

            <!-- Input Pencarian -->
            <div class="news-filter-group news-filter-group-search">
              <i class="fa-solid fa-magnifying-glass news-filter-icon"></i>
              <input type="text"
                     name="q"
                     value="{{ request('q') }}"
                     placeholder="Cari nama paket wisata atau kota tujuan (misal: Pahawang, Bromo, Jogja)..."
                     class="news-filter-input"
                     aria-label="Cari paket wisata">
            </div>

            <!-- Tombol Aksi -->
            <div class="news-filter-actions">
              <button type="submit" class="btn btn-primary news-filter-btn">
                <i class="fa-solid fa-magnifying-glass"></i> Cari
              </button>
              @if(request('q') || request('kategori'))
                <a href="{{ route('packages.index') }}" class="news-filter-reset" title="Reset filter">
                  <i class="fa-solid fa-rotate-left"></i> Reset
                </a>
              @endif
            </div>
          </form>

          <!-- Info Filter Aktif -->
          @if(request('q') || request('kategori'))
            <div class="news-filter-meta">
              <div>
                <span>Menampilkan hasil filter:</span>
                @if(request('kategori'))
                  <strong style="color: var(--primary, #800020); margin-left: 4px;">
                    Kategori "{{ $categories->firstWhere('slug', request('kategori'))->name ?? request('kategori') }}"
                  </strong>
                @endif
                @if(request('q'))
                  <span style="margin-left: 6px;">Kata kunci: <strong style="color: #0F172A;">"{{ request('q') }}"</strong></span>
                @endif
                <span style="margin-left: 6px;">({{ $packages->total() }} paket wisata ditemukan)</span>
              </div>
              <a href="{{ route('packages.index') }}" style="color: #EF4444; text-decoration: none; font-weight: 600; font-size: 0.82rem;">
                Hapus Filter &times;
              </a>
            </div>
          @endif
        </div>

        <!-- DESTINATIONS GRID -->
        @if($packages->isNotEmpty())
          <div class="destinations-grid">
            @foreach($packages as $pkg)
              <x-package-card :package="$pkg" />
            @endforeach
          </div>

          <!-- PAGINATION -->
          @if($packages->hasPages())
            <div style="margin-top: 50px; display: flex; justify-content: center;">
              {{ $packages->links() }}
            </div>
          @endif
        @else
          <div style="text-align: center; padding: 60px 20px; background: #FFFFFF; border-radius: 18px; border: 1px solid #E2E8F0; box-shadow: 0 4px 18px rgba(0,0,0,0.03);">
            <div style="font-size: 2.8rem; color: #94A3B8; margin-bottom: 14px;">
              <i class="fa-solid fa-map-location-dot"></i>
            </div>
            <h3 style="font-size: 1.3rem; font-weight: 800; color: #0F172A; margin-bottom: 8px;">Tidak Ada Paket Wisata yang Sesuai</h3>
            <p style="font-size: 0.92rem; color: #64748B; margin-bottom: 22px;">Silakan coba kata kunci lain atau pilih kategori paket wisata lainnya.</p>
            <a href="{{ route('packages.index') }}" class="btn btn-primary btn-sm">
              Tampilkan Semua Paket Wisata
            </a>
          </div>
        @endif

        <!-- CTA HUBUNGI KAMI / KONSULTASI DESTINASI KUSTOM -->
        <div style="margin-top: 60px; background: linear-gradient(135deg, #4A0012 0%, #800020 100%); border-radius: 22px; padding: 44px 38px; color: #FFFFFF; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 26px; box-shadow: 0 14px 32px rgba(128,0,32,0.2);">
          <div style="max-width: 660px;">
            <h3 style="font-size: 1.5rem; font-weight: 800; color: #FFFFFF; margin: 0 0 10px 0;">
              Ingin Destinasi Khusus atau Rencana Custom Itinerary?
            </h3>
            <p style="margin: 0; font-size: 0.95rem; color: #FCE7EB; line-height: 1.65;">
              Konsultasikan jadwal wisata impian rombongan keluarga, instansi, atau sekolah Anda. Tim konsultan Nirwana Tour siap menyusun itinerary terbaik sesuai kebutuhan anggaran Anda.
            </p>
          </div>
          <div style="display: flex; gap: 12px; flex-wrap: wrap;">
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg" style="background: #FFFFFF; color: var(--primary, #800020); border: none; font-weight: 700; white-space: nowrap;">
              Hubungi Kami
            </a>
            @php
              $cleanWa = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188');
              $destWaMsg = rawurlencode("Halo Nirwana Tour, saya ingin konsultasi rencana paket liburan khusus.");
            @endphp
            <a href="https://wa.me/{{ $cleanWa }}?text={{ $destWaMsg }}"
               target="_blank"
               rel="noopener noreferrer"
               class="btn btn-lg"
               style="background: #25D366; color: #FFFFFF; border: none; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; white-space: nowrap;">
              <i class="fa-brands fa-whatsapp"></i>
              <span>Konsultasi WhatsApp</span>
            </a>
          </div>
        </div>

      </div>
    </section>
  </main>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const dropdown = document.getElementById('destCategoryDropdown');
    if (!dropdown) return;

    const trigger = document.getElementById('destCategoryTrigger');
    const input = document.getElementById('destCategoryInput');
    const label = trigger ? trigger.querySelector('.news-dropdown-label') : null;
    const items = dropdown.querySelectorAll('.news-dropdown-item');
    const searchFilter = document.getElementById('destDropdownFilterInput');
    const form = dropdown.closest('form');

    // Toggle Dropdown Menu
    if (trigger) {
      trigger.addEventListener('click', function (e) {
        e.stopPropagation();
        const isOpen = dropdown.classList.toggle('is-open');
        trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        if (isOpen && searchFilter) {
          setTimeout(function () {
            searchFilter.focus();
          }, 100);
        }
      });
    }

    // Klik di luar untuk menutup dropdown
    document.addEventListener('click', function (e) {
      if (!dropdown.contains(e.target)) {
        dropdown.classList.remove('is-open');
        if (trigger) trigger.setAttribute('aria-expanded', 'false');
      }
    });

    // Tutup dengan Escape
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && dropdown.classList.contains('is-open')) {
        dropdown.classList.remove('is-open');
        if (trigger) trigger.setAttribute('aria-expanded', 'false');
      }
    });

    // Pilih item kategori
    items.forEach(function (item) {
      item.addEventListener('click', function () {
        const val = item.getAttribute('data-value') || '';
        const text = item.getAttribute('data-label') || 'Semua Destinasi';

        if (input) input.value = val;
        if (label) label.textContent = text;

        items.forEach(function (i) {
          i.classList.remove('active');
          const check = i.querySelector('.news-dropdown-check');
          if (check) check.remove();
        });

        item.classList.add('active');
        const checkIcon = document.createElement('i');
        checkIcon.className = 'fa-solid fa-check news-dropdown-check';
        item.appendChild(checkIcon);

        dropdown.classList.remove('is-open');
        if (trigger) trigger.setAttribute('aria-expanded', 'false');

        if (form) form.submit();
      });
    });

    // Pencarian cepat dalam daftar kategori
    if (searchFilter) {
      searchFilter.addEventListener('input', function () {
        const query = this.value.toLowerCase().trim();
        items.forEach(function (item) {
          const text = (item.getAttribute('data-label') || '').toLowerCase();
          if (text.includes(query)) {
            item.style.display = 'flex';
          } else {
            item.style.display = 'none';
          }
        });
      });

      searchFilter.addEventListener('click', function (e) {
        e.stopPropagation();
      });
    }
  });
</script>
@endpush
