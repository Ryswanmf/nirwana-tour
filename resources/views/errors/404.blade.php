@extends('layouts.app')

@section('title', '404 - Halaman Tidak Ditemukan | ' . ($settings['site_name'] ?? 'Nirwana Tour Lampung'))
@section('meta_description', 'Halaman atau destinasi wisata yang Anda cari tidak ditemukan. Temukan pilihan paket wisata Lampung dan luar kota terbaik bersama Nirwana Tour Lampung.')

@section('content')
<div class="error-page-wrapper" style="min-height: 75vh; display: flex; align-items: center; justify-content: center; padding: 130px 20px 80px; background: linear-gradient(180deg, #F8FAFC 0%, #FFFFFF 100%);">
  <div class="container" style="max-width: 820px; text-align: center;">
    
    <!-- Icon & Badge 404 -->
    <div style="position: relative; display: inline-block; margin-bottom: 24px;">
      <div style="width: 110px; height: 110px; border-radius: 50%; background: linear-gradient(135deg, rgba(128, 0, 32, 0.1) 0%, rgba(245, 158, 11, 0.15) 100%); display: flex; align-items: center; justify-content: center; margin: 0 auto; border: 2px dashed rgba(128, 0, 32, 0.3);">
        <i class="fa-solid fa-compass-drafting" style="font-size: 3rem; color: var(--primary, #800020);"></i>
      </div>
      <span style="position: absolute; bottom: -8px; right: calc(50% - 40px); background: var(--primary, #800020); color: #FFFFFF; font-weight: 800; font-size: 0.95rem; padding: 3px 14px; border-radius: 999px; letter-spacing: 1px; box-shadow: 0 4px 12px rgba(128,0,32,0.35);">
        404
      </span>
    </div>

    <!-- Judul & Keterangan -->
    <h1 style="font-size: clamp(1.8rem, 4vw, 2.6rem); font-weight: 800; color: #0F172A; line-height: 1.25; margin-bottom: 14px;">
      Ups! Destinasi Belum Ditemukan
    </h1>
    <p style="font-size: clamp(0.95rem, 1.8vw, 1.1rem); color: #64748B; max-width: 580px; margin: 0 auto 32px auto; line-height: 1.65;">
      Rute wisata atau halaman yang Anda tuju mungkin sudah dipindahkan, diubah jadwalnya, atau tautannya keliru. Jangan biarkan rencana liburan Anda terhenti di sini!
    </p>

    <!-- Search Box Paket Wisata -->
    <div style="max-width: 520px; margin: 0 auto 36px auto;">
      <form action="{{ route('packages.index') }}" method="GET" style="display: flex; gap: 8px; background: #FFFFFF; border: 2px solid #E2E8F0; border-radius: 999px; padding: 6px 8px 6px 20px; box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.08); transition: border-color 0.2s ease;">
        <input type="text" name="q" placeholder="Cari destinasi (Pahawang, Kiluan, Jogja, Bromo...)" style="flex: 1; border: none; background: transparent; outline: none; font-size: 0.92rem; color: #0F172A; font-family: inherit;">
        <button type="submit" class="btn btn-primary" style="border-radius: 999px; padding: 10px 22px; font-weight: 700; font-size: 0.88rem; display: inline-flex; align-items: center; gap: 6px;">
          <i class="fa-solid fa-magnifying-glass"></i>
          <span>Cari</span>
        </button>
      </form>
    </div>

    <!-- Tombol Aksi Cepat -->
    <div style="display: flex; align-items: center; justify-content: center; gap: 14px; flex-wrap: wrap; margin-bottom: 48px;">
      <a href="{{ route('home') }}" class="btn btn-primary" style="padding: 12px 24px; font-weight: 700; border-radius: 12px; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-house"></i> Kembali ke Beranda
      </a>
      <a href="{{ route('packages.index') }}" class="btn btn-outline" style="padding: 12px 24px; font-weight: 700; border-radius: 12px; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-map-location-dot"></i> Lihat Semua Paket Wisata
      </a>
      @php
        $cleanWa = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188');
      @endphp
      <a href="https://wa.me/{{ $cleanWa }}?text={{ rawurlencode('Halo CS Nirwana Tour, saya mengalami kendala mencari halaman di website dan ingin menanyakan rekomendasi paket wisata.') }}" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp" style="padding: 12px 24px; font-weight: 700; border-radius: 12px; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-brands fa-whatsapp"></i> Tanya CS via WhatsApp
      </a>
    </div>

    <!-- Pintasan Destinasi Favorit -->
    <div style="border-top: 1px dashed #CBD5E1; padding-top: 28px;">
      <p style="font-size: 0.84rem; font-weight: 700; color: #94A3B8; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 12px;">
        Pilihan Populer Wisatawan:
      </p>
      <div style="display: flex; align-items: center; justify-content: center; gap: 8px; flex-wrap: wrap;">
        <a href="{{ route('packages.index', ['q' => 'Pahawang']) }}" style="font-size: 0.82rem; font-weight: 600; color: var(--primary, #800020); background: rgba(128,0,32,0.06); padding: 6px 14px; border-radius: 999px; text-decoration: none; border: 1px solid rgba(128,0,32,0.15);">
          Pulau Pahawang
        </a>
        <a href="{{ route('packages.index', ['q' => 'Kiluan']) }}" style="font-size: 0.82rem; font-weight: 600; color: var(--primary, #800020); background: rgba(128,0,32,0.06); padding: 6px 14px; border-radius: 999px; text-decoration: none; border: 1px solid rgba(128,0,32,0.15);">
          Teluk Kiluan Lumba-Lumba
        </a>
        <a href="{{ route('packages.index', ['q' => 'Jogja']) }}" style="font-size: 0.82rem; font-weight: 600; color: var(--primary, #800020); background: rgba(128,0,32,0.06); padding: 6px 14px; border-radius: 999px; text-decoration: none; border: 1px solid rgba(128,0,32,0.15);">
          Study Tour Jogja
        </a>
        <a href="{{ route('packages.index', ['q' => 'Bromo']) }}" style="font-size: 0.82rem; font-weight: 600; color: var(--primary, #800020); background: rgba(128,0,32,0.06); padding: 6px 14px; border-radius: 999px; text-decoration: none; border: 1px solid rgba(128,0,32,0.15);">
          Bromo & Malang
        </a>
        <a href="{{ route('packages.index', ['q' => 'Bali']) }}" style="font-size: 0.82rem; font-weight: 600; color: var(--primary, #800020); background: rgba(128,0,32,0.06); padding: 6px 14px; border-radius: 999px; text-decoration: none; border: 1px solid rgba(128,0,32,0.15);">
          Tour Eksotis Bali
        </a>
      </div>
    </div>

  </div>
</div>
@endsection
