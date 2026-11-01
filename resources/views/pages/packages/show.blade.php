@extends('layouts.app')

@section('title', $package->title . ' - ' . ($settings['site_name'] ?? 'Nirwana Tour Lampung') . ' | Paket Wisata Pilihan')
@section('meta_description', Str::limit($package->summary, 160))
@section('og_image', $package->thumbnail_url)
@section('og_type', 'article')

@php
  $faqsList = !empty($package->faqs) ? $package->faqs : [
    [
      'question' => 'Apa saja perlengkapan yang wajib dibawa saat trip ini?',
      'answer' => 'Disarankan membawa pakaian ganti, pakaian renang / snorkeling, alas kaki anti-selip / sandal gunung, tabir surya (sunblock), kacamata hitam, obat-obatan pribadi, casing tahan air untuk smartphone, dan uang tunai secukupnya.'
    ],
    [
      'question' => 'Apakah paket wisata ini aman untuk anak-anak dan lansia?',
      'answer' => 'Sangat aman. Setiap perjalanan didampingi oleh pemandu wisata profesional Nirwana Tour Lampung yang berpengalaman, lengkap dengan rompi pelampung (life jacket) berstandar SNI serta kotak P3K darurat.'
    ],
    [
      'question' => 'Bagaimana ketentuan pembayaran dan pelunasan paket?',
      'answer' => 'Pemesanan dapat dikonfirmasi dengan pembayaran uang muka (DP) sebesar 30% - 50%. Pelunasan dapat diselesaikan H-2 sebelum keberangkatan atau saat hari H penjemputan sesuai kesepakatan invoice resmi.'
    ],
    [
      'question' => 'Bagaimana jika kondisi cuaca buruk pada hari keberangkatan?',
      'answer' => 'Keselamatan wisatawan adalah prioritas utama. Jika otoritas pelabuhan atau BMKG melarang penyeberangan karena faktor cuaca, tour dapat dijadwalkan ulang (reschedule) tanpa biaya tambahan atau dialihkan ke rute alternatif yang aman.'
    ],
  ];
@endphp

@push('jsonld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "TouristTrip",
  "name": "{{ $package->title }}",
  "description": "{{ $package->summary }}",
  "touristType": "Semua Usia",
  "offers": {
    "@type": "Offer",
    "price": "{{ $package->price_from }}",
    "priceCurrency": "IDR",
    "availability": "https://schema.org/InStock",
    "validFrom": "{{ date('Y-01-01') }}"
  },
  "provider": {
    "@type": "TravelAgency",
    "name": "Nirwana Tour Lampung",
    "url": "{{ url('/') }}"
  }
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    @foreach($faqsList as $faq)
    {
      "@type": "Question",
      "name": {!! json_encode($faq['question'] ?? '') !!},
      "acceptedAnswer": {
        "@type": "Answer",
        "text": {!! json_encode($faq['answer'] ?? '') !!}
      }
    }{{ !$loop->last ? ',' : '' }}
    @endforeach
  ]
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
          <a href="{{ route('packages.index') }}">Paket Wisata</a>
          <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
          <span class="current">{{ $package->title }}</span>
        </nav>

        <h1 class="page-hero-title">{{ $package->title }}</h1>
        <p class="page-hero-desc" style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; gap: 14px;">
          <span><i class="fa-solid fa-location-dot"></i> {{ $package->destination_location ?? 'Lampung' }}</span>
          <span>&bull;</span>
          <span><i class="fa-solid fa-clock"></i> {{ $package->duration_label }}</span>
          <span>&bull;</span>
          <span><i class="fa-solid fa-users"></i> Min. {{ $package->min_pax }} Pax</span>
        </p>
      </div>
    </section>

    <!-- ========================================================
         CONTENT DETAIL & BOOKING FORM
         ======================================================== -->
    <section class="section bg-alt" id="detail-paket">
      <div class="container">
        <div class="detail-page-layout">
          
          <!-- KOLOM KIRI: FOTO, DESKRIPSI, ITINERARY, FASILITAS -->
          <div>
            <!-- Foto Utama -->
            <div style="border-radius: 20px; overflow: hidden; margin-bottom: 30px; box-shadow: 0 6px 25px rgba(0,0,0,0.06); border: 1px solid #E2E8F0;">
              <img src="{{ $package->thumbnail_url }}"
                   alt="{{ $package->title }}"
                   style="width: 100%; max-height: 440px; object-fit: cover; display: block;">
            </div>

            <!-- Deskripsi Paket -->
            <div style="background: #FFFFFF; border-radius: 20px; padding: 35px; margin-bottom: 30px; border: 1px solid #E2E8F0; box-shadow: 0 4px 18px rgba(0,0,0,0.03);">
              <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; padding-bottom: 14px; border-bottom: 1px solid #F1F5F9;">
                <h2 style="font-size: 1.35rem; font-weight: 800; color: #0F172A; margin: 0;">
                  Gambaran Umum Paket
                </h2>
                @if($package->badge)
                  <span class="dest-badge-rec" style="position: static; box-shadow: none;">{{ $package->badge }}</span>
                @endif
              </div>

              <p style="color: #475569; line-height: 1.8; font-size: 0.98rem; margin-bottom: 16px;">
                {{ $package->summary }}
              </p>

              @if($package->description)
                <div style="color: #475569; line-height: 1.8; font-size: 0.98rem;" class="rich-content">
                  {!! $package->description !!}
                </div>
              @endif
            </div>

            <!-- Rundown Itinerary Harian -->
            @if(!empty($package->itinerary))
              <div style="background: #FFFFFF; border-radius: 20px; padding: 35px; margin-bottom: 30px; border: 1px solid #E2E8F0; box-shadow: 0 4px 18px rgba(0,0,0,0.03);">
                <h2 style="font-size: 1.35rem; font-weight: 800; color: #0F172A; margin-bottom: 22px;">
                  Rencana Perjalanan (Rundown Itinerary)
                </h2>

                <div style="display: flex; flex-direction: column; gap: 20px;">
                  @foreach($package->itinerary as $item)
                    <div style="display: flex; gap: 16px; border-left: 3px solid var(--primary, #800020); padding-left: 20px; position: relative;">
                      <div style="flex-grow: 1;">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
                          <span style="background: rgba(128,0,32,0.08); color: var(--primary, #800020); padding: 3px 12px; border-radius: 12px; font-size: 0.78rem; font-weight: 800;">
                            HARI {{ $item['day'] ?? ($loop->index + 1) }}
                          </span>
                          <h4 style="margin: 0; font-size: 1.05rem; font-weight: 700; color: #0F172A;">
                            {{ $item['title'] ?? 'Agenda Wisata' }}
                          </h4>
                        </div>
                        <p style="margin: 0; color: #64748B; line-height: 1.6; font-size: 0.92rem;">
                          {{ $item['activities'] ?? '' }}
                        </p>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            @endif

            <!-- Fasilitas Include & Exclude -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-bottom: 30px;">
              <!-- Include -->
              <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-top: 4px solid #10B981; border-radius: 18px; padding: 26px; box-shadow: 0 4px 16px rgba(0,0,0,0.03);">
                <h3 style="font-size: 1.15rem; font-weight: 800; color: #065F46; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                  <i class="fa-solid fa-circle-check" style="color: #10B981;"></i>
                  <span>Fasilitas Termasuk (Include)</span>
                </h3>
                @if(!empty($package->includes))
                  <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 9px;">
                    @foreach($package->includes as $inc)
                      <li style="font-size: 0.88rem; color: #334155; display: flex; align-items: flex-start; gap: 8px;">
                        <i class="fa-solid fa-check" style="color: #10B981; margin-top: 3px; font-size: 0.82rem;"></i>
                        <span>{{ $inc }}</span>
                      </li>
                    @endforeach
                  </ul>
                @else
                  <p style="color: #64748B; font-size: 0.88rem;">Fasilitas standar paket pariwisata all-in.</p>
                @endif
              </div>

              <!-- Exclude -->
              <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-top: 4px solid #EF4444; border-radius: 18px; padding: 26px; box-shadow: 0 4px 16px rgba(0,0,0,0.03);">
                <h3 style="font-size: 1.15rem; font-weight: 800; color: #991B1B; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                  <i class="fa-solid fa-circle-xmark" style="color: #EF4444;"></i>
                  <span>Tidak Termasuk (Exclude)</span>
                </h3>
                @if(!empty($package->excludes))
                  <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 9px;">
                    @foreach($package->excludes as $exc)
                      <li style="font-size: 0.88rem; color: #334155; display: flex; align-items: flex-start; gap: 8px;">
                        <i class="fa-solid fa-xmark" style="color: #EF4444; margin-top: 3px; font-size: 0.82rem;"></i>
                        <span>{{ $exc }}</span>
                      </li>
                    @endforeach
                  </ul>
                @else
                  <p style="color: #64748B; font-size: 0.88rem;">Pengeluaran pribadi di luar program acara.</p>
                @endif
              </div>
            </div>

            <!-- PERTANYAAN UMUM (FAQ) -->
            <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 20px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); margin-bottom: 30px;">
              <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 22px; flex-wrap: wrap; gap: 10px;">
                <div>
                  <h3 style="font-size: 1.25rem; font-weight: 800; color: #0F172A; margin: 0 0 6px 0; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-circle-question" style="color: var(--primary, #800020);"></i>
                    <span>Pertanyaan Umum (FAQ)</span>
                  </h3>
                  <p style="color: #64748B; font-size: 0.88rem; margin: 0;">Hal yang sering ditanyakan wisatawan seputar paket ini.</p>
                </div>
                <span style="font-size: 0.78rem; font-weight: 700; background: #F1F5F9; color: #475569; padding: 4px 12px; border-radius: 20px;">
                  {{ count($faqsList) }} Pertanyaan
                </span>
              </div>

              <div class="faq-accordion-group" style="display: flex; flex-direction: column; gap: 12px;">
                @foreach($faqsList as $faqIndex => $faq)
                  <details class="faq-details-item" {{ $faqIndex === 0 ? 'open' : '' }} style="border: 1px solid #E2E8F0; border-radius: 12px; overflow: hidden; background: #F8FAFC; transition: all 0.25s ease;">
                    <summary style="padding: 16px 20px; font-weight: 700; color: #1E293B; cursor: pointer; display: flex; align-items: center; justify-content: space-between; gap: 12px; user-select: none; font-size: 0.94rem;">
                      <span style="display: flex; align-items: center; gap: 10px;">
                        <span style="width: 24px; height: 24px; border-radius: 50%; background: rgba(128,0,32,0.1); color: var(--primary, #800020); display: inline-flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 800; flex-shrink: 0;">
                          {{ $faqIndex + 1 }}
                        </span>
                        {{ $faq['question'] ?? '' }}
                      </span>
                      <i class="fa-solid fa-chevron-down faq-chevron" style="color: #64748B; font-size: 0.85rem; transition: transform 0.2s ease;"></i>
                    </summary>
                    <div style="padding: 14px 20px 18px 54px; color: #475569; font-size: 0.9rem; line-height: 1.65; border-top: 1px solid #E2E8F0; background: #FFFFFF;">
                      {!! nl2br(e($faq['answer'] ?? '')) !!}
                    </div>
                  </details>
                @endforeach
              </div>
            </div>
          </div>

          <!-- KOLOM KANAN: STICKY BOOKING CARD -->
          <div class="detail-sidebar-sticky">
            <div style="background: #FFFFFF; border-radius: 20px; padding: 30px; border: 1px solid #E2E8F0; box-shadow: 0 8px 30px rgba(0,0,0,0.06);">
              
              <!-- Harga Highlight Header -->
              <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 14px; padding: 18px 20px; text-align: center; margin-bottom: 22px;">
                <span style="display: block; font-size: 0.82rem; color: #64748B; text-transform: uppercase; font-weight: 700; letter-spacing: 0.04em;">Harga Paket Mulai Dari</span>
                <span style="font-size: 1.9rem; font-weight: 800; color: var(--primary, #800020); display: block; line-height: 1.2; margin-top: 4px;">
                  {{ $package->formatted_price }}
                </span>
                <small style="color: #64748B; font-size: 0.82rem;">per orang / pax</small>
              </div>

              <div style="text-align: center; margin-bottom: 20px;">
                <h3 style="font-size: 1.25rem; font-weight: 800; color: #0F172A; margin: 0 0 4px 0;">Pesan Paket Wisata Ini</h3>
                <p style="color: #64748B; font-size: 0.84rem; margin: 0;">Isi formulir singkat untuk langsung terhubung dengan admin kami:</p>
              </div>

              <!-- Form Lead / Booking -->
              <form action="{{ route('inquiry.store') }}" method="POST">
                @csrf
                <input type="hidden" name="tour_package_id" value="{{ $package->id }}">
                <input type="hidden" name="package_name" value="{{ $package->title }}">
                <input type="hidden" name="source" value="package_detail">
                {{-- Anti-Spam Honeypot Field --}}
                <input type="text" name="_hp_security_check" style="display:none !important;" tabindex="-1" autocomplete="off">

                <div style="margin-bottom: 14px;">
                  <label style="display: block; font-weight: 600; font-size: 0.84rem; margin-bottom: 5px; color: #334155;">Nama Pemesan / Instansi *</label>
                  <input type="text" name="name" required class="form-control" placeholder="Nama Anda / Instansi" style="width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 0.88rem; outline: none;">
                </div>

                <div style="margin-bottom: 14px;">
                  <label style="display: block; font-weight: 600; font-size: 0.84rem; margin-bottom: 5px; color: #334155;">Nomor WhatsApp *</label>
                  <input type="tel" name="phone" required class="form-control" placeholder="08xxxxxxxxxx" style="width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 0.88rem; outline: none;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 14px;">
                  <div>
                    <label style="display: block; font-weight: 600; font-size: 0.84rem; margin-bottom: 5px; color: #334155;">Jml Peserta</label>
                    <input type="number" name="participants" value="{{ $package->min_pax }}" min="1" class="form-control" style="width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 0.88rem; outline: none;">
                  </div>
                  <div>
                    <label style="display: block; font-weight: 600; font-size: 0.84rem; margin-bottom: 5px; color: #334155;">Armada</label>
                    <select name="fleet_type" class="form-control" style="width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 0.88rem; outline: none;">
                      <option value="Termasuk Bus/Mobil">Termasuk Bus</option>
                      <option value="HiAce Premio">HiAce Premio</option>
                      <option value="Medium Bus">Medium Bus</option>
                      <option value="Big Bus SHD">Big Bus SHD</option>
                      <option value="Tanpa Transportasi">Tanpa Transport</option>
                    </select>
                  </div>
                </div>

                <div style="margin-bottom: 18px;">
                  <label style="display: block; font-weight: 600; font-size: 0.84rem; margin-bottom: 5px; color: #334155;">Rencana Tanggal / Catatan</label>
                  <textarea name="message" rows="2" class="form-control" placeholder="Tuliskan tanggal rencana liburan atau permintaan khusus..." style="width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 0.88rem; outline: none;"></textarea>
                </div>

                <button type="submit"
                        class="btn btn-primary"
                        style="width: 100%; padding: 12px; font-weight: 700; border-radius: 10px; font-size: 0.92rem; display: flex; align-items: center; justify-content: center; gap: 8px;">
                  <span>Lanjut Konsultasi WhatsApp</span>
                  <i class="fa-solid fa-arrow-right"></i>
                </button>
              </form>

              <div style="margin-top: 18px; text-align: center; border-top: 1px solid #F1F5F9; padding-top: 14px;">
                @php
                  $cleanWa = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188');
                  $quickMsg = rawurlencode("Halo Nirwana Tour, saya ingin konsultasi paket: {$package->title}");
                @endphp
                <a href="https://wa.me/{{ $cleanWa }}?text={{ $quickMsg }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   style="color: #25D366; text-decoration: none; font-size: 0.84rem; font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">
                  <i class="fa-brands fa-whatsapp" style="font-size: 1.1rem;"></i>
                  <span>Chat Langsung dengan Konsultan</span>
                </a>
              </div>
            </div>

            <!-- 1-Click Social Share Card -->
            <div style="background: #FFFFFF; border-radius: 16px; padding: 20px; border: 1px solid #E2E8F0; margin-top: 20px; box-shadow: 0 4px 16px rgba(0,0,0,0.04);">
              <span style="display: block; font-weight: 700; color: #1E293B; font-size: 0.88rem; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                <i class="fa-solid fa-share-nodes" style="color: var(--primary, #800020);"></i> Bagikan Paket Wisata Ini:
              </span>
              <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px;">
                <!-- WhatsApp -->
                <a href="https://api.whatsapp.com/send?text={{ rawurlencode($package->title . ' - Liburan Seru bersama Nirwana Tour Lampung: ' . url()->current()) }}"
                   target="_blank" rel="noopener noreferrer"
                   title="Bagikan ke WhatsApp"
                   style="background: #25D366; color: #FFFFFF; padding: 10px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 1.15rem; transition: transform 0.2s;">
                  <i class="fa-brands fa-whatsapp"></i>
                </a>
                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ rawurlencode(url()->current()) }}"
                   target="_blank" rel="noopener noreferrer"
                   title="Bagikan ke Facebook"
                   style="background: #1877F2; color: #FFFFFF; padding: 10px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 1.15rem; transition: transform 0.2s;">
                  <i class="fa-brands fa-facebook-f"></i>
                </a>
                <!-- Telegram -->
                <a href="https://t.me/share/url?url={{ rawurlencode(url()->current()) }}&text={{ rawurlencode($package->title) }}"
                   target="_blank" rel="noopener noreferrer"
                   title="Bagikan ke Telegram"
                   style="background: #229ED9; color: #FFFFFF; padding: 10px; border-radius: 10px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 1.15rem; transition: transform 0.2s;">
                  <i class="fa-brands fa-telegram"></i>
                </a>
                <!-- Copy Link Button -->
                <button type="button"
                        onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan paket wisata berhasil disalin ke clipboard!');"
                        title="Salin Tautan"
                        style="background: #F1F5F9; color: #475569; border: 1px solid #CBD5E1; padding: 10px; border-radius: 10px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 1.15rem; transition: transform 0.2s;">
                  <i class="fa-solid fa-link"></i>
                </button>
              </div>
            </div>
          </div>

        </div>

        <!-- PAKET TERKAIT LAINNYA -->
        @if(isset($relatedPackages) && $relatedPackages->isNotEmpty())
          <div style="margin-top: 70px; border-top: 1px solid #E2E8F0; padding-top: 45px;">
            <div class="section-header text-center" style="max-width: 650px; margin: 0 auto 35px auto;">
              <h2 class="section-title">Pilihan Paket Wisata Terkait Lainnya</h2>
              <p class="section-subtitle">Jelajahi opsi paket wisata menarik lainnya yang berada dalam kategori yang sama.</p>
            </div>
            <div class="destinations-grid">
              @foreach($relatedPackages as $rel)
                <x-package-card :package="$rel" />
              @endforeach
            </div>
          </div>
        @endif

      </div>
    </section>
  </main>
@endsection
