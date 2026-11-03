@extends('layouts.app')

@section('title', 'Paket Wisata - ' . ($settings['site_name'] ?? 'Nirwana Tour Lampung') . ' | Biro Perjalanan Terpercaya')
@section('meta_description', 'Pilihan paket wisata unggulan di Lampung, Jawa, Bromo, Malang, Jogja, Bali, dan karya wisata edukatif sekolah bersama Nirwana Tour Lampung.')

@push('styles')
<style>
  /* ========================================================
     MODERN FILTER CARD (CLEAN, SYMMETRICAL & RESPONSIVE)
     ======================================================== */
  .packages-filter-box {
    max-width: 1040px;
    margin: 0 auto 36px auto;
    background: #FFFFFF;
    border: 1.5px solid #E2E8F0;
    border-radius: 20px;
    padding: 22px 24px;
    box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.05), 0 4px 10px -2px rgba(15, 23, 42, 0.02);
    transition: box-shadow 0.25s ease;
  }
  .packages-filter-box:hover {
    box-shadow: 0 16px 36px -6px rgba(15, 23, 42, 0.08), 0 6px 14px -3px rgba(15, 23, 42, 0.03);
  }
  .pfilter-search-wrap {
    display: flex;
    align-items: center;
    background: #F8FAFC;
    border: 1.5px solid #E2E8F0;
    border-radius: 12px;
    padding: 0 16px;
    height: 48px;
    box-sizing: border-box;
    transition: all 0.2s ease;
    position: relative;
  }
  .pfilter-search-wrap:focus-within {
    border-color: var(--primary, #800020);
    background: #FFFFFF;
    box-shadow: 0 0 0 4px rgba(128, 0, 32, 0.08);
  }
  .pfilter-search-icon {
    color: var(--primary, #800020);
    font-size: 0.95rem;
    flex-shrink: 0;
  }
  .pfilter-search-input {
    width: 100%;
    border: none;
    background: transparent;
    outline: none;
    font-size: 0.9rem;
    font-weight: 500;
    color: #0F172A;
    font-family: inherit;
    padding-left: 12px;
  }
  .pfilter-search-input::placeholder {
    color: #94A3B8;
  }
  .pfilter-clear-btn {
    color: #94A3B8;
    padding: 4px;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: color 0.15s ease;
    flex-shrink: 0;
  }
  .pfilter-clear-btn:hover {
    color: #EF4444;
  }

  /* Grid Baris Kedua: 4 Dropdowns Sejajar + Tombol Cari */
  .pfilter-controls-grid {
    display: grid;
    grid-template-columns: 1.2fr 1fr 1fr 1fr auto;
    gap: 12px;
    margin-top: 14px;
    align-items: flex-end;
  }
  .pfilter-col {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }
  .pfilter-label {
    font-size: 0.74rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #64748B;
    display: flex;
    align-items: center;
    gap: 6px;
    margin: 0;
    line-height: 1;
  }
  .pfilter-label i {
    color: var(--primary, #800020);
    font-size: 0.78rem;
  }
  .pfilter-select-wrap {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
  }
  .pfilter-select {
    width: 100%;
    height: 44px;
    background: #F8FAFC;
    border: 1.5px solid #E2E8F0;
    border-radius: 10px;
    padding: 0 32px 0 12px;
    font-size: 0.84rem;
    font-weight: 600;
    color: #334155;
    font-family: inherit;
    outline: none;
    cursor: pointer;
    appearance: none;
    -webkit-appearance: none;
    transition: all 0.2s ease;
    box-sizing: border-box;
  }
  .pfilter-select:hover {
    border-color: #CBD5E1;
    background: #FFFFFF;
  }
  .pfilter-select:focus {
    border-color: var(--primary, #800020);
    background: #FFFFFF;
    box-shadow: 0 0 0 3px rgba(128, 0, 32, 0.08);
  }
  .pfilter-select.is-active {
    border-color: var(--primary, #800020);
    background: #FFF5F7;
    color: var(--primary, #800020);
    font-weight: 700;
  }
  .pfilter-select-arrow {
    position: absolute;
    right: 12px;
    color: #94A3B8;
    font-size: 0.7rem;
    pointer-events: none;
    transition: transform 0.2s ease;
  }
  .pfilter-btn-group {
    display: flex;
    align-items: center;
    gap: 8px;
    height: 44px;
  }
  .pfilter-submit-btn {
    height: 44px;
    padding: 0 20px;
    background: var(--primary, #800020);
    color: #FFFFFF;
    border: none;
    border-radius: 10px;
    font-size: 0.88rem;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(128, 0, 32, 0.22);
    transition: all 0.2s ease;
    white-space: nowrap;
  }
  .pfilter-submit-btn:hover {
    background: #660019;
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(128, 0, 32, 0.32);
  }
  .pfilter-reset-btn {
    height: 44px;
    width: 44px;
    background: #F1F5F9;
    border: 1px solid #E2E8F0;
    border-radius: 10px;
    color: #64748B;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 0.88rem;
    transition: all 0.2s ease;
    flex-shrink: 0;
  }
  .pfilter-reset-btn:hover {
    background: #E2E8F0;
    color: #0F172A;
  }

  /* Baris Ketiga: Chips Tag & Counter */
  .pfilter-chips-row {
    margin-top: 14px;
    padding-top: 12px;
    border-top: 1px dashed rgba(226, 232, 240, 0.9);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
  }
  .pfilter-chips-left {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
    font-size: 0.84rem;
    color: #64748B;
  }
  .pfilter-chip {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 3px 10px;
    background: rgba(128, 0, 32, 0.06);
    border: 1px solid rgba(128, 0, 32, 0.18);
    border-radius: 999px;
    color: var(--primary, #800020);
    font-size: 0.78rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.15s ease;
  }
  .pfilter-chip:hover {
    background: rgba(128, 0, 32, 0.12);
    border-color: var(--primary, #800020);
  }
  .pfilter-chip i {
    font-size: 0.7rem;
    opacity: 0.8;
  }
  .pfilter-reset-all-link {
    font-size: 0.8rem;
    font-weight: 600;
    color: #EF4444;
    text-decoration: none;
    padding: 2px 6px;
    border-radius: 4px;
  }
  .pfilter-reset-all-link:hover {
    text-decoration: underline;
  }

  /* Responsif Tablet & HP */
  @media (max-width: 991px) {
    .pfilter-controls-grid {
      grid-template-columns: 1fr 1fr;
    }
    .pfilter-btn-group {
      grid-column: 1 / -1;
      width: 100%;
    }
    .pfilter-submit-btn {
      flex: 1;
      justify-content: center;
    }
  }
  @media (max-width: 600px) {
    .packages-filter-box {
      padding: 16px 14px;
      border-radius: 16px;
    }
    .pfilter-controls-grid {
      grid-template-columns: 1fr;
      gap: 10px;
    }
    .pfilter-chips-row {
      flex-direction: column;
      align-items: flex-start;
    }
  }
</style>
@endpush

@section('content')
  <main>
    <!-- ========================================================
         PAGE HERO BANNER & BREADCRUMB (BACKGROUND DIENG)
         ======================================================== -->
    <section class="page-hero page-hero-packages relative overflow-hidden" id="packages-hero">
      <div class="page-hero-bg-container" aria-hidden="true">
        <picture>
          <source srcset="{{ asset('assets/images/hero/dieng-hero.webp') }}" type="image/webp">
          <img src="{{ asset('assets/images/hero/dieng-hero.jpg') }}" 
               alt="Background Paket Wisata Dieng Nirwana Tour" 
               class="page-hero-bg-image" 
               loading="eager" 
               fetchpriority="high" 
               decoding="async">
        </picture>
        <div class="page-hero-maroon-overlay"></div>
        <div class="page-hero-ambient-overlay"></div>
        <div class="page-hero-dots-overlay"></div>
      </div>

      <div class="container page-hero-content relative z-10">
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
         LISTING SECTION & FILTER PENCARIAN TERPADU
         ======================================================== -->
    <section class="section bg-alt" id="katalog-destinasi">
      <div class="container">

        <!-- FILTER CARD RAPI & TERSTRUKTUR -->
        <div class="packages-filter-box">
          <form action="{{ route('packages.index') }}" method="GET" id="packagesFilterForm">
            
            <!-- BARIS 1: INPUT DESTINASI / KATA KUNCI -->
            <div class="pfilter-search-wrap">
              <i class="fa-solid fa-magnifying-glass pfilter-search-icon"></i>
              <input type="text"
                     name="q"
                     value="{{ request('q') }}"
                     placeholder="Cari nama paket atau destinasi wisata (misal: Pahawang, Kiluan, Bromo, Malang, Jogja)..."
                     class="pfilter-search-input"
                     autocomplete="off"
                     aria-label="Cari paket wisata">
              @if(request('q'))
                <a href="{{ route('packages.index', request()->except(['q', 'page'])) }}" class="pfilter-clear-btn" title="Hapus kata kunci">
                  <i class="fa-solid fa-xmark"></i>
                </a>
              @endif
            </div>

            <!-- BARIS 2: 4 DROPDOWN SEJAJAR + TOMBOL AKSI -->
            <div class="pfilter-controls-grid">
              
              <!-- Kolom 1: Kategori Wisata -->
              <div class="pfilter-col">
                <label for="pfilterCategory" class="pfilter-label">
                  <i class="fa-solid fa-compass"></i> Kategori Wisata
                </label>
                <div class="pfilter-select-wrap">
                  <select name="kategori" id="pfilterCategory" class="pfilter-select {{ request('kategori') ? 'is-active' : '' }}" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @if(isset($categories))
                      @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ request('kategori') == $cat->slug ? 'selected' : '' }}>
                          {{ $cat->name }}
                        </option>
                      @endforeach
                    @endif
                  </select>
                  <i class="fa-solid fa-chevron-down pfilter-select-arrow"></i>
                </div>
              </div>

              <!-- Kolom 2: Durasi Trip -->
              <div class="pfilter-col">
                <label for="pfilterDuration" class="pfilter-label">
                  <i class="fa-regular fa-clock"></i> Durasi Trip
                </label>
                <div class="pfilter-select-wrap">
                  <select name="durasi" id="pfilterDuration" class="pfilter-select {{ request('durasi') ? 'is-active' : '' }}" onchange="this.form.submit()">
                    <option value="">Semua Durasi Trip</option>
                    <option value="oneday" {{ request('durasi') === 'oneday' || request('durasi') === '1' ? 'selected' : '' }}>1 Hari (One Day)</option>
                    <option value="2d1n" {{ request('durasi') === '2d1n' ? 'selected' : '' }}>2 Hari 1 Malam (2D1N)</option>
                    <option value="3d2n" {{ request('durasi') === '3d2n' ? 'selected' : '' }}>3 Hari 2 Malam (3D2N)</option>
                    <option value="multidays" {{ request('durasi') === 'multidays' ? 'selected' : '' }}>4+ Hari (Long Trip)</option>
                  </select>
                  <i class="fa-solid fa-chevron-down pfilter-select-arrow"></i>
                </div>
              </div>

              <!-- Kolom 3: Rentang Biaya -->
              <div class="pfilter-col">
                <label for="pfilterBudget" class="pfilter-label">
                  <i class="fa-solid fa-wallet"></i> Rentang Biaya
                </label>
                <div class="pfilter-select-wrap">
                  <select name="budget" id="pfilterBudget" class="pfilter-select {{ request('budget') ? 'is-active' : '' }}" onchange="this.form.submit()">
                    <option value="">Semua Rentang Biaya</option>
                    <option value="under_500k" {{ request('budget') === 'under_500k' ? 'selected' : '' }}>&lt; Rp 500.000</option>
                    <option value="500k_1500k" {{ request('budget') === '500k_1500k' ? 'selected' : '' }}>Rp 500rb - 1.5jt</option>
                    <option value="above_1500k" {{ request('budget') === 'above_1500k' ? 'selected' : '' }}>&gt; Rp 1.500.000</option>
                  </select>
                  <i class="fa-solid fa-chevron-down pfilter-select-arrow"></i>
                </div>
              </div>

              <!-- Kolom 4: Urutan -->
              <div class="pfilter-col">
                <label for="pfilterSort" class="pfilter-label">
                  <i class="fa-solid fa-arrow-down-short-wide"></i> Urutkan
                </label>
                <div class="pfilter-select-wrap">
                  <select name="sort" id="pfilterSort" class="pfilter-select {{ request('sort') ? 'is-active' : '' }}" onchange="this.form.submit()">
                    <option value="">Rekomendasi Terbaik</option>
                    <option value="termurah" {{ request('sort') === 'termurah' ? 'selected' : '' }}>Harga: Termurah</option>
                    <option value="termahal" {{ request('sort') === 'termahal' ? 'selected' : '' }}>Harga: Tertinggi</option>
                  </select>
                  <i class="fa-solid fa-chevron-down pfilter-select-arrow"></i>
                </div>
              </div>

              <!-- Kolom 5: Tombol Aksi (Cari & Reset) -->
              <div class="pfilter-col">
                <div class="pfilter-btn-group">
                  <button type="submit" class="pfilter-submit-btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>Cari</span>
                  </button>
                  @if(request('q') || request('kategori') || request('durasi') || request('budget') || request('sort'))
                    <a href="{{ route('packages.index') }}" class="pfilter-reset-btn" title="Reset semua filter">
                      <i class="fa-solid fa-rotate-left"></i>
                    </a>
                  @endif
                </div>
              </div>

            </div>
          </form>

          <!-- BARIS 3: METADATA & CHIPS FILTER AKTIF -->
          <div class="pfilter-chips-row">
            <div class="pfilter-chips-left">
              <span>Menampilkan <strong>{{ $packages->total() }}</strong> paket wisata</span>
              
              @if(request('kategori') || request('q') || request('durasi') || request('budget') || request('sort'))
                <span style="color: #CBD5E1;">•</span>
                
                @if(request('kategori'))
                  <a href="{{ route('packages.index', request()->except(['kategori', 'page'])) }}" class="pfilter-chip" title="Hapus filter kategori">
                    <span>{{ $categories->firstWhere('slug', request('kategori'))->name ?? request('kategori') }}</span>
                    <i class="fa-solid fa-xmark"></i>
                  </a>
                @endif

                @if(request('q'))
                  <a href="{{ route('packages.index', request()->except(['q', 'page'])) }}" class="pfilter-chip" title="Hapus kata kunci">
                    <span>"{{ request('q') }}"</span>
                    <i class="fa-solid fa-xmark"></i>
                  </a>
                @endif

                @if(request('durasi'))
                  @php
                    $dMap = ['oneday' => '1 Hari', '1' => '1 Hari', '2d1n' => '2D1N', '3d2n' => '3D2N', 'multidays' => '4+ Hari'];
                  @endphp
                  <a href="{{ route('packages.index', request()->except(['durasi', 'page'])) }}" class="pfilter-chip" title="Hapus filter durasi">
                    <span>Durasi: {{ $dMap[request('durasi')] ?? request('durasi') }}</span>
                    <i class="fa-solid fa-xmark"></i>
                  </a>
                @endif

                @if(request('budget'))
                  @php
                    $bMap = ['under_500k' => '< 500rb', '500k_1500k' => '500rb-1.5jt', 'above_1500k' => '> 1.5jt'];
                  @endphp
                  <a href="{{ route('packages.index', request()->except(['budget', 'page'])) }}" class="pfilter-chip" title="Hapus filter budget">
                    <span>Budget: {{ $bMap[request('budget')] ?? request('budget') }}</span>
                    <i class="fa-solid fa-xmark"></i>
                  </a>
                @endif

                @if(request('sort'))
                  <a href="{{ route('packages.index', request()->except(['sort', 'page'])) }}" class="pfilter-chip" title="Kembalikan urutan default">
                    <span>Urut: {{ request('sort') === 'termurah' ? 'Harga: Termurah' : 'Harga Tertinggi' }}</span>
                    <i class="fa-solid fa-xmark"></i>
                  </a>
                @endif

                <a href="{{ route('packages.index') }}" class="pfilter-reset-all-link">
                  Reset Semua
                </a>
              @endif
            </div>

            @if(request('q') || request('kategori') || request('durasi') || request('budget') || request('sort'))
              <div style="font-size: 0.8rem; color: #94A3B8;">
                <i class="fa-solid fa-circle-check" style="color: #10B981;"></i> Filter diterapkan
              </div>
            @endif
          </div>
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
        <div style="margin-top: 60px; background: #FFFFFF; border-radius: 20px; border: 1px solid #E2E8F0; padding: 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 24px;">
          <div style="max-width: 650px;">
            <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(128, 0, 32, 0.08); color: var(--primary, #800020); padding: 5px 14px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
              <i class="fa-solid fa-wand-magic-sparkles"></i> Custom Trip Planner
            </div>
            <h3 style="font-size: 1.5rem; font-weight: 800; color: #0F172A; margin-bottom: 8px;">
              Punya Destinasi Impian Sendiri Bersama Rombongan?
            </h3>
            <p style="font-size: 0.92rem; color: #64748B; line-height: 1.6; margin: 0;">
              Konsultasikan jadwal, rute wisata khusus, dan preferensi armada bus Anda bersama travel consultant kami secara gratis.
            </p>
          </div>
          <div>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188') }}?text={{ urlencode('Halo Nirwana Tour, saya ingin konsultasi paket wisata kustom untuk rombongan.') }}" 
               target="_blank" 
               rel="noopener noreferrer" 
               class="btn btn-success"
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
