@extends('layouts.app')

@section('title', $package->title . ' - ' . ($settings['site_name'] ?? 'Nirwana Tour Lampung') . ' | Paket Wisata Pilihan')
@section('meta_description', Str::limit($package->summary, 160))
@section('og_image', $package->thumbnail ? asset($package->thumbnail) : asset('assets/images/destinasi/pahawang.jpg'))

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
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px; align-items: start;">
          
          <!-- KOLOM KIRI: FOTO, DESKRIPSI, ITINERARY, FASILITAS -->
          <div>
            <!-- Foto Utama -->
            <div style="border-radius: 20px; overflow: hidden; margin-bottom: 30px; box-shadow: 0 6px 25px rgba(0,0,0,0.06); border: 1px solid #E2E8F0;">
              <img src="{{ $package->thumbnail ? asset($package->thumbnail) : asset('assets/images/destinasi/pahawang.jpg') }}"
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
          </div>

          <!-- KOLOM KANAN: STICKY BOOKING CARD -->
          <div style="position: sticky; top: 100px;">
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
