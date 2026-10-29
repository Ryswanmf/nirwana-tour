@extends('layouts.app')

@section('title', $service->title . ' - ' . ($settings['site_name'] ?? 'Nirwana Tour Lampung') . ' | Layanan Profesional')
@section('meta_description', Str::limit($service->short_description, 160))

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
          <a href="{{ route('services.index') }}">Layanan Perjalanan</a>
          <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
          <span class="current">{{ $service->title }}</span>
        </nav>
        <h1 class="page-hero-title">{{ $service->title }}</h1>
        <p class="page-hero-desc">{{ $service->short_description }}</p>
      </div>
    </section>

    <!-- ========================================================
         SERVICE DETAIL CONTENT & INQUIRY FORM
         ======================================================== -->
    <section class="section bg-alt" id="detail-layanan">
      <div class="container">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px; align-items: start;">
          
          <!-- KOLOM KIRI: DESKRIPSI & KEUNGGULAN -->
          <div>
            <div style="background: #FFFFFF; border-radius: 20px; padding: 36px; border: 1px solid #E2E8F0; box-shadow: 0 4px 20px rgba(0,0,0,0.03); margin-bottom: 30px;">
              
              <div style="display: flex; align-items: center; gap: 18px; margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid #F1F5F9;">
                <div style="width: 58px; height: 58px; border-radius: 14px; background: rgba(128,0,32,0.08); color: var(--primary, #800020); display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0;">
                  <i class="{{ $service->icon }}"></i>
                </div>
                <div>
                  <span style="font-size: 0.82rem; font-weight: 700; color: var(--primary, #800020); text-transform: uppercase; letter-spacing: 0.05em;">Layanan Resmi</span>
                  <h2 style="font-size: 1.45rem; font-weight: 800; color: #0F172A; margin: 4px 0 0 0;">Tentang Layanan Ini</h2>
                </div>
              </div>

              <div style="color: #475569; line-height: 1.8; font-size: 0.98rem;">
                <p style="margin-bottom: 16px;">{{ $service->short_description }}</p>
                @if($service->full_description)
                  <div class="rich-content" style="margin-top: 16px;">
                    {!! $service->full_description !!}
                  </div>
                @endif
              </div>

              @if(!empty($service->features))
                <div style="margin-top: 32px; border-top: 1px dashed #E2E8F0; padding-top: 26px;">
                  <h3 style="font-size: 1.15rem; font-weight: 800; color: #0F172A; margin-bottom: 18px;">
                    Fasilitas & Poin Keunggulan
                  </h3>
                  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 12px;">
                    @foreach($service->features as $feat)
                      <div style="display: flex; align-items: center; gap: 10px; background: #F8FAFC; padding: 12px 16px; border-radius: 12px; border: 1px solid #E2E8F0; font-size: 0.88rem; color: #334155; font-weight: 600;">
                        <i class="fa-solid fa-circle-check" style="color: #10B981; font-size: 0.92rem;"></i>
                        <span>{{ $feat }}</span>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endif
            </div>

            <!-- Jaminan Layanan Nirwana Tour -->
            <div style="background: #FFFFFF; border-radius: 20px; padding: 30px; border: 1px solid #E2E8F0; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
              <h3 style="font-size: 1.15rem; font-weight: 800; color: #0F172A; margin-bottom: 16px;">
                Komitmen Standar Pelayanan Kami
              </h3>
              <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 18px;">
                <div style="display: flex; gap: 12px; align-items: flex-start;">
                  <i class="fa-solid fa-shield-halved" style="color: var(--primary, #800020); font-size: 1.2rem; margin-top: 2px;"></i>
                  <div>
                    <strong style="display: block; font-size: 0.9rem; color: #0F172A; margin-bottom: 2px;">Legalitas Resmi</strong>
                    <span style="font-size: 0.82rem; color: #64748B;">Perusahaan berizin resmi dengan rekam jejak terpercaya.</span>
                  </div>
                </div>
                <div style="display: flex; gap: 12px; align-items: flex-start;">
                  <i class="fa-solid fa-handshake-angle" style="color: var(--primary, #800020); font-size: 1.2rem; margin-top: 2px;"></i>
                  <div>
                    <strong style="display: block; font-size: 0.9rem; color: #0F172A; margin-bottom: 2px;">Tim Profesional</strong>
                    <span style="font-size: 0.82rem; color: #64748B;">Didampingi tour leader bersertifikasi dan ramah.</span>
                  </div>
                </div>
                <div style="display: flex; gap: 12px; align-items: flex-start;">
                  <i class="fa-solid fa-file-invoice-dollar" style="color: var(--primary, #800020); font-size: 1.2rem; margin-top: 2px;"></i>
                  <div>
                    <strong style="display: block; font-size: 0.9rem; color: #0F172A; margin-bottom: 2px;">Biaya Transparan</strong>
                    <span style="font-size: 0.82rem; color: #64748B;">Tanpa biaya tersembunyi, rincian jelas sejak awal penawaran.</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- KOLOM KANAN: FORM KONSULTASI / BOOKING -->
          <div style="position: sticky; top: 100px;">
            <div style="background: #FFFFFF; border-radius: 20px; padding: 30px; border: 1px solid #E2E8F0; box-shadow: 0 8px 30px rgba(0,0,0,0.06);">
              <div style="text-align: center; margin-bottom: 22px;">
                <h3 style="font-size: 1.25rem; font-weight: 800; color: #0F172A; margin: 0 0 6px 0;">Ajukan Penawaran Layanan</h3>
                <p style="color: #64748B; font-size: 0.84rem; margin: 0; line-height: 1.5;">
                  Isi data singkat berikut untuk menerima estimasi biaya dan rencana itinerary dari konsultan kami.
                </p>
              </div>

              <form action="{{ route('inquiry.store') }}" method="POST">
                @csrf
                <input type="hidden" name="package_name" value="Layanan: {{ $service->title }}">
                <input type="hidden" name="source" value="service_detail">

                <div style="margin-bottom: 14px;">
                  <label style="display: block; font-weight: 600; font-size: 0.84rem; margin-bottom: 6px; color: #334155;">Nama Lengkap / Instansi *</label>
                  <input type="text" name="name" required class="form-control" placeholder="Contoh: Budi Santoso (SMA N 1)" style="width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 0.88rem; outline: none;">
                </div>

                <div style="margin-bottom: 14px;">
                  <label style="display: block; font-weight: 600; font-size: 0.84rem; margin-bottom: 6px; color: #334155;">Nomor WhatsApp *</label>
                  <input type="tel" name="phone" required class="form-control" placeholder="08xxxxxxxxxx" style="width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 0.88rem; outline: none;">
                </div>

                <div style="margin-bottom: 14px;">
                  <label style="display: block; font-weight: 600; font-size: 0.84rem; margin-bottom: 6px; color: #334155;">Estimasi Jumlah Peserta</label>
                  <input type="number" name="participants" value="25" min="1" class="form-control" style="width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 0.88rem; outline: none;">
                </div>

                <div style="margin-bottom: 18px;">
                  <label style="display: block; font-weight: 600; font-size: 0.84rem; margin-bottom: 6px; color: #334155;">Rencana Destinasi & Kebutuhan</label>
                  <textarea name="message" rows="3" class="form-control" placeholder="Tuliskan kota tujuan, durasi hari, dan tanggal rencana kegiatan..." style="width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #CBD5E1; font-size: 0.88rem; outline: none;"></textarea>
                </div>

                <button type="submit"
                        class="btn btn-primary"
                        style="width: 100%; padding: 12px; font-weight: 700; border-radius: 10px; font-size: 0.92rem; display: flex; align-items: center; justify-content: center; gap: 8px;">
                  <span>Kirim & Konsultasi WhatsApp</span>
                  <i class="fa-solid fa-arrow-right"></i>
                </button>
              </form>

              <div style="margin-top: 18px; text-align: center; border-top: 1px solid #F1F5F9; padding-top: 14px;">
                @php
                  $cleanWa = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188');
                  $quickMsg = rawurlencode("Halo Nirwana Tour, saya ingin tanya langsung mengenai layanan: {$service->title}");
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

        <!-- ========================================================
             LAYANAN LAINNYA
             ======================================================== -->
        @if(isset($otherServices) && $otherServices->isNotEmpty())
          <div style="margin-top: 70px; border-top: 1px solid #E2E8F0; padding-top: 50px;">
            <div class="section-header text-center" style="max-width: 650px; margin: 0 auto 35px auto;">
              <h2 class="section-title">Layanan Perjalanan Lainnya</h2>
              <p class="section-subtitle">Jelajahi opsi layanan pariwisata lainnya yang sesuai dengan kebutuhan agenda kegiatan Anda.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
              @foreach($otherServices as $other)
                <div style="background: #FFFFFF; border-radius: 16px; padding: 24px; border: 1px solid #E2E8F0; box-shadow: 0 4px 16px rgba(0,0,0,0.03); display: flex; flex-direction: column; justify-content: space-between;">
                  <div>
                    <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(128,0,32,0.07); color: var(--primary, #800020); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 16px;">
                      <i class="{{ $other->icon }}"></i>
                    </div>
                    <h4 style="font-size: 1.15rem; font-weight: 700; color: #0F172A; margin: 0 0 8px 0;">{{ $other->title }}</h4>
                    <p style="font-size: 0.86rem; color: #64748B; line-height: 1.55; margin: 0 0 16px 0;">
                      {{ Str::limit($other->short_description, 100) }}
                    </p>
                  </div>
                  <a href="{{ route('services.show', $other->slug) }}" class="btn btn-outline btn-sm" style="width: 100%; justify-content: center;">
                    <span>Lihat Layanan</span>
                    <i class="fa-solid fa-arrow-right"></i>
                  </a>
                </div>
              @endforeach
            </div>
          </div>
        @endif

      </div>
    </section>
  </main>
@endsection
