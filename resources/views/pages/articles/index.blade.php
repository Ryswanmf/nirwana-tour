@extends('layouts.app')

@section('title', 'Berita & Tips Wisata - ' . ($settings['site_name'] ?? 'Nirwana Tour Lampung') . ' | Biro Perjalanan Wisata Terpercaya')
@section('meta_description', 'Kumpulan artikel, tips traveling, panduan destinasi, dan kabar terbaru seputar wisata Lampung serta Nusantara dari Nirwana Tour Lampung.')

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
          <span class="current">Berita & Artikel</span>
        </nav>
        <h1 class="page-hero-title">Berita & Tips Liburan</h1>
        <p class="page-hero-desc">
          Panduan perjalanan praktis, tips liburan hemat dan aman, serta kabar terbaru seputar destinasi wisata unggulan di Lampung dan Nusantara.
        </p>
      </div>
    </section>

    <!-- ========================================================
         ARTICLES LIST SECTION
         ======================================================== -->
    <section class="section bg-alt" id="berita-list">
      <div class="container">

        <!-- FILTER & PENCARIAN BERITA SEJAJAR -->
        <div class="news-filter-container">
          <form action="{{ route('posts.index') }}" method="GET" class="news-filter-bar">
            @if(request('sort'))
              <input type="hidden" name="sort" value="{{ request('sort') }}">
            @endif

            <!-- Filter Kategori Custom Dropdown (Scrollable > 5 item + Quick Filter) -->
            <div class="news-filter-group news-filter-group-category">
              <div class="news-custom-dropdown" id="newsCategoryDropdown">
                <input type="hidden" name="category" id="newsCategoryInput" value="{{ request('category') }}">
                <button type="button" class="news-dropdown-trigger" id="newsCategoryTrigger" aria-haspopup="listbox" aria-expanded="false" title="Pilih Kategori">
                  <span class="news-dropdown-selected-text">
                    <i class="fa-solid fa-layer-group news-filter-icon"></i>
                    <span class="news-dropdown-label">
                      {{ request('category') && $categories->firstWhere('slug', request('category')) ? $categories->firstWhere('slug', request('category'))->name : 'Semua Kategori' }}
                    </span>
                  </span>
                  <i class="fa-solid fa-chevron-down news-dropdown-arrow"></i>
                </button>

                <div class="news-dropdown-menu" id="newsCategoryMenu" role="listbox">
                  <!-- Quick search/filter inside category dropdown -->
                  <div class="news-dropdown-search-wrap">
                    <i class="fa-solid fa-magnifying-glass news-dropdown-search-icon"></i>
                    <input type="text" id="newsDropdownFilterInput" placeholder="Cari kategori..." class="news-dropdown-search-input" autocomplete="off">
                  </div>
                  <!-- Scrollable Category List (Maksimal 5 item tampil, selebihnya dapat di-scroll halus) -->
                  <div class="news-dropdown-scroll" id="newsCategoryList">
                    <div class="news-dropdown-item {{ !request('category') ? 'active' : '' }}" data-value="" data-label="Semua Kategori" role="option">
                      <span>Semua Kategori</span>
                      @if(!request('category'))
                        <i class="fa-solid fa-check news-dropdown-check"></i>
                      @endif
                    </div>
                    @if(isset($categories))
                      @foreach($categories as $cat)
                        <div class="news-dropdown-item {{ request('category') == $cat->slug ? 'active' : '' }}" 
                             data-value="{{ $cat->slug }}" 
                             data-label="{{ $cat->name }}" 
                             role="option">
                          <span>{{ $cat->name }}</span>
                          @if(request('category') == $cat->slug)
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
                     placeholder="Cari berita atau tips liburan..." 
                     class="news-filter-input"
                     aria-label="Cari berita">
            </div>

            <!-- Tombol Aksi -->
            <div class="news-filter-actions">
              <button type="submit" class="btn btn-primary news-filter-btn">
                <i class="fa-solid fa-magnifying-glass"></i> Cari
              </button>
              @if(request('q') || request('category'))
                <a href="{{ route('posts.index') }}" class="news-filter-reset" title="Reset filter">
                  <i class="fa-solid fa-rotate-left"></i> Reset
                </a>
              @endif
            </div>
          </form>

          <!-- Info Filter Aktif -->
          @if(request('q') || request('category'))
            <div class="news-filter-meta">
              <div>
                <span>Menampilkan hasil:</span>
                @if(request('category'))
                  <strong style="color: var(--primary, #800020); margin-left: 4px;">
                    Kategori "{{ $categories->firstWhere('slug', request('category'))->name ?? request('category') }}"
                  </strong>
                @endif
                @if(request('q'))
                  <span style="margin-left: 6px;">Kata kunci: <strong style="color: #0F172A;">"{{ request('q') }}"</strong></span>
                @endif
                <span style="margin-left: 6px;">({{ $posts->total() }} berita ditemukan)</span>
              </div>
              <a href="{{ route('posts.index') }}" style="color: #EF4444; text-decoration: none; font-weight: 600; font-size: 0.82rem;">
                Hapus Filter &times;
              </a>
            </div>
          @endif
        </div>

        @if($posts->count() > 0)
          <div class="articles-grid">
            @foreach($posts as $post)
              <article class="article-card">
                <div class="article-thumb">
                  <img src="{{ $post->cover_image_url }}" 
                       alt="{{ $post->title }}" 
                       class="article-img"
                       loading="lazy"
                       decoding="async">
                  <span class="article-tag">{{ $post->category_name ?: ($post->category->name ?? 'Info Wisata') }}</span>
                </div>
                <div class="article-body">
                  <div class="article-meta">
                    <span><i class="fa-regular fa-calendar"></i> {{ $post->published_at ? $post->published_at->format('d M Y') : date('d M Y') }}</span>
                    <span><i class="fa-regular fa-clock"></i> {{ $post->reading_time }}</span>
                  </div>
                  <h3 class="article-title">
                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                  </h3>
                  <p class="article-excerpt">
                    {{ Str::limit($post->excerpt ?? strip_tags($post->content), 125) }}
                  </p>
                  <div class="article-footer">
                    <a href="{{ route('posts.show', $post->slug) }}" class="btn-read-more">
                      Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                    </a>
                  </div>
                </div>
              </article>
            @endforeach
          </div>

          <!-- Pagination -->
          @if($posts->hasPages())
            <div style="margin-top: 48px; display: flex; justify-content: center;">
              {{ $posts->links() }}
            </div>
          @endif
        @else
          <div style="text-align: center; padding: 60px 20px; background: #fff; border-radius: 16px; border: 1px solid #e2e8f0;">
            <div style="font-size: 2.5rem; color: #94a3b8; margin-bottom: 14px;">
              <i class="fa-regular fa-newspaper"></i>
            </div>
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-bottom: 8px;">Tidak Ada Artikel Ditemukan</h3>
            <p style="font-size: 0.92rem; color: #64748b; margin-bottom: 24px;">Silakan gunakan kata kunci lain atau pilih kategori berita lainnya.</p>
            <a href="{{ route('posts.index') }}" class="btn btn-primary btn-sm">
              Tampilkan Semua Berita
            </a>
          </div>
        @endif

        <!-- CTA Hubungi Kami di Halaman Berita -->
        <div style="margin-top: 60px; background: linear-gradient(135deg, #4A0012 0%, #800020 100%); border-radius: 20px; padding: 40px; color: #FFFFFF; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 24px; box-shadow: 0 12px 30px rgba(128,0,32,0.2);">
          <div style="max-width: 680px;">
            <h3 style="font-size: 1.45rem; font-weight: 800; color: #FFFFFF; margin: 0 0 8px 0;">Ingin Merencanakan Liburan ke Destinasi Impian?</h3>
            <p style="margin: 0; font-size: 0.95rem; color: #FCE7EB; line-height: 1.6;">
              Konsultasikan rencana perjalanan Anda bersama konsultan Nirwana Tour Lampung. Kami siap membantu menyusun jadwal liburan, akomodasi, hingga sewa armada pariwisata.
            </p>
          </div>
          <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg" style="background: #FFFFFF; color: var(--primary, #800020); border: none; font-weight: 700; white-space: nowrap;">
            Hubungi Kami Sekarang
          </a>
        </div>

      </div>
    </section>
  </main>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const dropdown = document.getElementById('newsCategoryDropdown');
    if (!dropdown) return;

    const trigger = document.getElementById('newsCategoryTrigger');
    const menu = document.getElementById('newsCategoryMenu');
    const input = document.getElementById('newsCategoryInput');
    const label = trigger ? trigger.querySelector('.news-dropdown-label') : null;
    const items = dropdown.querySelectorAll('.news-dropdown-item');
    const searchFilter = document.getElementById('newsDropdownFilterInput');
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

    // Tutup dengan tombol Escape
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && dropdown.classList.contains('is-open')) {
        dropdown.classList.remove('is-open');
        if (trigger) trigger.setAttribute('aria-expanded', 'false');
      }
    });

    // Pemilihan item kategori
    items.forEach(function (item) {
      item.addEventListener('click', function () {
        const val = item.getAttribute('data-value') || '';
        const text = item.getAttribute('data-label') || 'Semua Kategori';

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

    // Pencarian instan (auto-filter) dalam daftar kategori
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

      // Jangan tutup dropdown saat klik di dalam input pencarian
      searchFilter.addEventListener('click', function (e) {
        e.stopPropagation();
      });
    }
  });
</script>
@endpush