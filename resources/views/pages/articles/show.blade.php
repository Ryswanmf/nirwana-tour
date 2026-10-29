@extends('layouts.app')

@section('title', $post->title . ' - ' . ($settings['site_name'] ?? 'Nirwana Tour Lampung'))
@section('meta_description', Str::limit($post->excerpt ?? strip_tags($post->content), 160))
@section('og_image', $post->cover_image ? asset($post->cover_image) : asset('assets/images/destinasi/pahawang.jpg'))

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
          {{ $post->category->name ?? 'Tips Wisata' }}
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
        
        <!-- GALERI 4 FOTO DOKUMENTASI ARTIKEL -->
        @php
          $articlePhotos = $post->photos;
        @endphp
        <div class="article-gallery-showcase">
          <!-- Foto Utama (1) -->
          <div class="article-main-photo">
            <img src="{{ asset($articlePhotos[0] ?? $post->cover_image) }}" alt="{{ $post->title }}">
          </div>

          <!-- 3 Foto Pendukung Dokumentasi (2, 3, 4) -->
          <div class="article-sub-photos">
            @for($i = 1; $i < 4; $i++)
              @if(isset($articlePhotos[$i]))
                <div class="article-sub-photo-item">
                  <img src="{{ asset($articlePhotos[$i]) }}" alt="Dokumentasi {{ $post->title }} Foto {{ $i + 1 }}" loading="lazy">
                </div>
              @endif
            @endfor
          </div>
        </div>

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

        <!-- CTA KONSULTASI DESTINASI -->
        <div style="background: linear-gradient(135deg, #4A0012 0%, #800020 100%); color: #FFFFFF; border-radius: 20px; padding: 36px 32px; margin-top: 40px; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 20px; box-shadow: 0 12px 28px rgba(128,0,32,0.22);">
          <div style="max-width: 580px;">
            <h3 style="margin: 0 0 6px; font-size: 1.35rem; font-weight: 800; color: #FFFFFF;">Tertarik Mengunjungi Destinasi Ini?</h3>
            <p style="margin: 0; color: #FCE7EB; font-size: 0.92rem; line-height: 1.55;">
              Konsultasikan rencana liburan Anda bersama konsultan Nirwana Tour Lampung untuk mendapatkan jadwal perjalanan terbaik dan penawaran hemat.
            </p>
          </div>
          @php
            $cleanWa = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188');
            $msg = rawurlencode("Halo Nirwana Tour Lampung, saya membaca artikel '{$post->title}' dan ingin informasi paket wisata terkait.");
          @endphp
          <a href="https://wa.me/{{ $cleanWa }}?text={{ $msg }}"
             target="_blank"
             rel="noopener noreferrer"
             class="btn btn-whatsapp btn-lg"
             style="border-radius: 12px; padding: 13px 24px; font-weight: 700; font-size: 0.95rem; white-space: nowrap;">
            <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp Admin
          </a>
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
                      {{ $rec->category->name ?? 'Info Wisata' }}
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