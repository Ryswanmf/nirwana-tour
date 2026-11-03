@props(['partners'])

@if($partners->isNotEmpty())
<section class="mitra-section" id="mitra" aria-label="Mitra & Instansi Rekanan Nirwana Tour Lampung">
  <div class="container mitra-container">
    <div class="mitra-header">
      <span class="mitra-eyebrow"><i class="fa-solid fa-shield-halved"></i> Social Proof & Kredibilitas</span>
      <h3 class="mitra-title">Dipercaya Puluhan Instansi Pemerintah, BUMN, Kampus & Sekolah</h3>
    </div>
    <div class="ticker-wrapper" aria-label="Logo mitra rekanan berjalan">
      <div class="ticker-track">
        @foreach($partners as $partner)
          <div class="ticker-item">
            @if($partner->logo)
              <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="partner-logo" loading="lazy" decoding="async">
            @else
              <span class="partner-text"><i class="fa-solid fa-building"></i> {{ $partner->name }}</span>
            @endif
          </div>
        @endforeach
        {{-- Duplicate track for smooth continuous loop --}}
        @foreach($partners as $partner)
          <div class="ticker-item" aria-hidden="true">
            @if($partner->logo)
              <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="partner-logo" loading="lazy" decoding="async">
            @else
              <span class="partner-text"><i class="fa-solid fa-building"></i> {{ $partner->name }}</span>
            @endif
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endif
