@extends('layouts.app')

@section('title', $post->title . ' - ' . ($settings['site_name'] ?? 'Nirwana Tour Lampung'))
@section('meta_description', Str::limit($post->excerpt ?? strip_tags($post->content), 160))
@section('og_image', $post->cover_image_url)
@section('og_type', 'article')

@push('jsonld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "headline": "{{ $post->title }}",
  "image": [
    "{{ $post->cover_image_url }}"
  ],
  "datePublished": "{{ $post->published_at ? $post->published_at->toIso8601String() : now()->toIso8601String() }}",
  "dateModified": "{{ $post->updated_at ? $post->updated_at->toIso8601String() : now()->toIso8601String() }}",
  "author": [{
      "@type": "Person",
      "name": "{{ $post->author ?? 'Tim Redaksi Nirwana' }}"
  }],
  "publisher": {
      "@type": "Organization",
      "name": "Nirwana Tour & Travel Lampung",
      "logo": {
        "@type": "ImageObject",
        "url": "{{ asset('assets/logo/Logo-Nirwana.png') }}"
      }
  },
  "description": "{{ Str::limit($post->excerpt ?? strip_tags($post->content), 160) }}"
}
</script>
@endpush

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
          <a href="{{ route('posts.index') }}">Berita</a>
          <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
          <span class="current">{{ Str::limit($post->title, 32) }}</span>
        </nav>
        <span style="display: inline-block; padding: 4px 14px; border-radius: 20px; background: rgba(255,255,255,0.15); color: #FDA4AF; font-size: 0.8rem; font-weight: 700; margin-bottom: 14px; text-transform: uppercase; letter-spacing: 0.5px;">
          {{ $post->category_name ?: ($post->category->name ?? 'Tips Wisata') }}
        </span>
        <h1 class="page-hero-title" style="font-size: clamp(1.8rem, 3.5vw, 2.6rem); max-width: 820px; margin: 0 auto 16px auto;">
          {{ $post->title }}
        </h1>
        <div style="display: flex; align-items: center; justify-content: center; gap: 20px; font-size: 0.88rem; color: #F1F5F9; flex-wrap: wrap;">
          <span><i class="fa-regular fa-user" style="color: var(--accent-gold); margin-right: 6px;"></i> Oleh {{ $post->author ?? 'Tim Nirwana' }}</span>
          <span><i class="fa-regular fa-calendar" style="color: var(--accent-gold); margin-right: 6px;"></i> {{ $post->published_at ? $post->published_at->format('d F Y') : date('d F Y') }}</span>
        </div>
      </div>
    </section>

    <!-- ========================================================
         ARTICLE CONTENT SECTION
         ======================================================== -->
    <section class="section bg-alt" id="artikel-detail">
      <div class="container" style="max-width: 920px;">
        
        <!-- FOTO DOKUMENTASI ARTIKEL (1 FOTO JIKA HANYA COVER, ATAU LEBIH JIKA ADA GALERI TAMBAHAN) -->
        @php
          $articlePhotos = $post->photos;
          $mainPhoto = $articlePhotos[0] ?? $post->cover_image;
          $subPhotos = array_slice($articlePhotos, 1);
        @endphp
        @if($mainPhoto)
          <div class="article-gallery-showcase">
            <!-- Foto Utama (1) -->
            <div class="article-main-photo">
              <img src="{{ storage_or_asset($mainPhoto) }}" alt="{{ $post->title }}" loading="lazy" decoding="async">
            </div>

            <!-- Foto Pendukung (HANYA tampil jika admin menambahkan beberapa foto galeri) -->
            @if(!empty($subPhotos))
              <div class="article-sub-photos">
                @foreach($subPhotos as $index => $subPhoto)
                  <div class="article-sub-photo-item">
                    <img src="{{ storage_or_asset($subPhoto) }}" alt="Dokumentasi {{ $post->title }} Foto {{ $index + 2 }}" loading="lazy" decoding="async">
                  </div>
                @endforeach
              </div>
            @endif
          </div>
        @endif

        <!-- ISI KONTEN ARTIKEL -->
        <article style="background: #FFFFFF; border-radius: 20px; padding: 45px 40px; border: 1px solid #E2E8F0; box-shadow: 0 6px 20px rgba(0,0,0,0.04); line-height: 1.85; font-size: 1.05rem; color: #334155;">
          @if($post->excerpt)
            <div style="font-size: 1.12rem; font-weight: 500; color: var(--primary, #800020); border-left: 4px solid var(--primary, #800020); padding-left: 20px; margin-bottom: 30px; line-height: 1.7; background: rgba(128,0,32,0.03); padding-top: 14px; padding-bottom: 14px; border-radius: 0 12px 12px 0;">
              {{ $post->excerpt }}
            </div>
          @endif

          <div class="rich-content" style="line-height: 1.9;">
            {!! $post->content !!}
          </div>
        </article>

        <!-- 1-Click Social Share Card untuk Artikel -->
        <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 16px; padding: 20px 24px; margin-top: 24px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px; box-shadow: 0 4px 14px rgba(0,0,0,0.03);">
          <div style="display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-share-nodes" style="color: var(--primary, #800020); font-size: 1.2rem;"></i>
            <span style="font-weight: 700; color: #1E293B; font-size: 0.92rem;">Bagikan Tips & Berita Ini:</span>
          </div>
          <div style="display: flex; gap: 10px; align-items: center;">
            <!-- WhatsApp -->
            <a href="https://api.whatsapp.com/send?text={{ rawurlencode($post->title . ' - Baca selengkapnya di Nirwana Tour: ' . url()->current()) }}"
               target="_blank" rel="noopener noreferrer"
               title="Bagikan ke WhatsApp"
               style="background: #25D366; color: #FFFFFF; width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 1.15rem; transition: transform 0.2s;">
              <i class="fa-brands fa-whatsapp"></i>
            </a>
            <!-- Facebook -->
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ rawurlencode(url()->current()) }}"
               target="_blank" rel="noopener noreferrer"
               title="Bagikan ke Facebook"
               style="background: #1877F2; color: #FFFFFF; width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 1.15rem; transition: transform 0.2s;">
              <i class="fa-brands fa-facebook-f"></i>
            </a>
            <!-- Telegram -->
            <a href="https://t.me/share/url?url={{ rawurlencode(url()->current()) }}&text={{ rawurlencode($post->title) }}"
               target="_blank" rel="noopener noreferrer"
               title="Bagikan ke Telegram"
               style="background: #229ED9; color: #FFFFFF; width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 1.15rem; transition: transform 0.2s;">
              <i class="fa-brands fa-telegram"></i>
            </a>
            <!-- Copy Link Button -->
            <button type="button"
                    onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan artikel berhasil disalin!');"
                    title="Salin Tautan"
                    style="background: #F1F5F9; color: #475569; border: 1px solid #CBD5E1; width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 1.15rem; transition: transform 0.2s;">
              <i class="fa-solid fa-link"></i>
            </button>
          </div>
        </div>

        <!-- BERITA LAINNYA / RELATED POSTS -->
        @if(isset($recentPosts) && $recentPosts->isNotEmpty())
          <div style="margin-top: 56px;">
            <div class="section-tag" style="margin-bottom: 10px;">Artikel Pilihan Lainnya</div>
            <h3 style="font-size: 1.45rem; font-weight: 800; color: #0F172A; margin-bottom: 24px;">Rekomendasi Berita & Tips Terkait</h3>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 24px;">
              @foreach($recentPosts as $rec)
                <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 16px; padding: 22px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 4px 14px rgba(0,0,0,0.03); transition: transform 0.25s ease, box-shadow 0.25s ease;">
                  <div>
                    <span style="font-size: 0.75rem; color: var(--primary, #800020); font-weight: 700; text-transform: uppercase;">
                      {{ $rec->category_name ?: ($rec->category->name ?? 'Info Wisata') }}
                    </span>
                    <h4 style="margin: 10px 0 12px; font-size: 1.02rem; font-weight: 700; line-height: 1.4;">
                      <a href="{{ route('posts.show', $rec->slug) }}" style="color: #0F172A; text-decoration: none;">
                        {{ $rec->title }}
                      </a>
                    </h4>
                  </div>
                  <div style="padding-top: 12px; border-top: 1px solid #F1F5F9; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.8rem; color: #94A3B8;">{{ $rec->published_at ? $rec->published_at->format('d M Y') : '' }}</span>
                    <a href="{{ route('posts.show', $rec->slug) }}" class="btn-read-more" style="font-size: 0.82rem;">
                      Baca <i class="fa-solid fa-arrow-right"></i>
                    </a>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endif

      </div>
    </section>
  </main>
@endsection