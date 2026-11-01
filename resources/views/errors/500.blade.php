@extends('layouts.app')

@section('title', '500 - Kendala Teknis Server | ' . ($settings['site_name'] ?? 'Nirwana Tour Lampung'))
@section('meta_description', 'Sedang terjadi sinkronisasi sistem atau pemeliharaan server sementara pada Nirwana Tour Lampung.')

@section('content')
<div class="error-page-wrapper" style="min-height: 75vh; display: flex; align-items: center; justify-content: center; padding: 130px 20px 80px; background: linear-gradient(180deg, #F8FAFC 0%, #FFFFFF 100%);">
  <div class="container" style="max-width: 760px; text-align: center;">
    
    <!-- Icon & Badge 500 -->
    <div style="position: relative; display: inline-block; margin-bottom: 24px;">
      <div style="width: 110px; height: 110px; border-radius: 50%; background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(245, 158, 11, 0.15) 100%); display: flex; align-items: center; justify-content: center; margin: 0 auto; border: 2px dashed rgba(239, 68, 68, 0.3);">
        <i class="fa-solid fa-screwdriver-wrench" style="font-size: 2.8rem; color: #DC2626;"></i>
      </div>
      <span style="position: absolute; bottom: -8px; right: calc(50% - 40px); background: #DC2626; color: #FFFFFF; font-weight: 800; font-size: 0.95rem; padding: 3px 14px; border-radius: 999px; letter-spacing: 1px; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.35);">
        500
      </span>
    </div>

    <!-- Judul & Keterangan -->
    <h1 style="font-size: clamp(1.8rem, 4vw, 2.5rem); font-weight: 800; color: #0F172A; line-height: 1.25; margin-bottom: 14px;">
      Kendala Teknis Sementara
    </h1>
    <p style="font-size: clamp(0.95rem, 1.8vw, 1.05rem); color: #64748B; max-width: 560px; margin: 0 auto 32px auto; line-height: 1.65;">
      Sistem kami sedang melakukan sinkronisasi data atau optimasi server berkala. Mohon coba muat ulang halaman beberapa saat lagi atau hubungi layanan pelanggan kami.
    </p>

    <!-- Tombol Aksi Cepat -->
    <div style="display: flex; align-items: center; justify-content: center; gap: 14px; flex-wrap: wrap;">
      <a href="javascript:location.reload();" class="btn btn-primary" style="padding: 12px 24px; font-weight: 700; border-radius: 12px; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-rotate-right"></i> Muat Ulang Halaman
      </a>
      <a href="{{ route('home') }}" class="btn btn-outline" style="padding: 12px 24px; font-weight: 700; border-radius: 12px; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-house"></i> Halaman Utama
      </a>
      @php
        $cleanWa = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188');
      @endphp
      <a href="https://wa.me/{{ $cleanWa }}?text={{ rawurlencode('Halo CS Nirwana Tour, saya mengalami kendala teknis saat membuka website dan ingin melanjutkan pemesanan paket wisata via WhatsApp.') }}" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp" style="padding: 12px 24px; font-weight: 700; border-radius: 12px; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-brands fa-whatsapp"></i> Bantuan CS WhatsApp
      </a>
    </div>

  </div>
</div>
@endsection
