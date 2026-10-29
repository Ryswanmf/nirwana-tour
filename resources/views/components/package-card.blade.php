@props(['package'])

@php
  $cleanWa = preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '6282269616188');
  $waMsg = rawurlencode("Halo Nirwana Tour, saya tertarik dan ingin info paket wisata: {$package->title}");
  $imgSrc = $package->thumbnail ? asset($package->thumbnail) : asset('assets/images/destinasi/pahawang.jpg');
@endphp

<article class="dest-card" data-category="{{ $package->category->slug ?? 'lampung' }}">
  <div class="dest-thumb">
    <img src="{{ $imgSrc }}" alt="{{ $package->title }}" loading="lazy">
    @if($package->category)
      <span class="dest-category">
        <i class="fa-solid fa-compass"></i> {{ $package->category->name }}
      </span>
    @endif
    @if($package->badge)
      <span class="dest-badge-rec">{{ $package->badge }}</span>
    @endif
  </div>

  <div class="dest-body">
    <div class="dest-meta">
      <span><i class="fa-solid fa-location-dot"></i> {{ $package->destination_location ?? 'Lampung' }}</span>
      <span><i class="fa-solid fa-clock"></i> {{ $package->duration_label }}</span>
    </div>

    <h3 class="dest-title">
      <a href="{{ route('packages.show', $package->slug) }}" style="color: inherit; text-decoration: none;">
        {{ $package->title }}
      </a>
    </h3>

    <p class="dest-desc">
      {{ Str::limit($package->summary, 95) }}
    </p>

    @if(!empty($package->includes))
      <div class="dest-highlights">
        @foreach(array_slice($package->includes, 0, 3) as $inc)
          <span><i class="fa-solid fa-circle-check"></i> {{ $inc }}</span>
        @endforeach
      </div>
    @endif

    <div class="dest-footer">
      <div class="dest-pricing">
        <span class="label">Mulai dari</span>
        <span class="price">{{ $package->formatted_price }} <small>/ pax</small></span>
      </div>
      <div class="dest-action-group">
        <a href="{{ route('packages.show', $package->slug) }}" class="btn btn-outline btn-sm">
          Detail
        </a>
        <a href="https://wa.me/{{ $cleanWa }}?text={{ $waMsg }}"
           target="_blank"
           rel="noopener noreferrer"
           class="btn btn-primary btn-sm"
           title="Pesan Paket via WhatsApp">
          <i class="fa-brands fa-whatsapp"></i> Pesan
        </a>
      </div>
    </div>
  </div>
</article>
