<x-filament-widgets::widget>
    <div class="nirwana-welcome-card relative overflow-hidden rounded-2xl p-6 text-white shadow-xl shadow-red-950/20 border border-white/10"
         style="background: linear-gradient(135deg, #800020 0%, #5B0016 55%, #3B000E 100%) !important; color: #FFFFFF !important;">
        <!-- Background Ambient Glow -->
        <div class="pointer-events-none absolute -right-10 -bottom-10 h-64 w-64 rounded-full bg-white/5 blur-3xl"></div>
        <div class="pointer-events-none absolute top-0 right-1/3 h-40 w-40 rounded-full bg-amber-400/10 blur-2xl"></div>

        <div class="relative z-10 flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
            <div class="space-y-3">
                <!-- Baris Status & Tanggal (Sangat Jelas & Kontras Tinggi) -->
                <div class="flex flex-wrap items-center gap-2.5">
                    <span class="nirwana-badge-status inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-bold"
                          style="background: rgba(255, 255, 255, 0.18) !important; border: 1px solid rgba(255, 255, 255, 0.35) !important; color: #FEF08A !important;">
                        <span class="nirwana-pulse-dot h-2 w-2 rounded-full animate-pulse"
                              style="background-color: #34D399 !important; box-shadow: 0 0 8px #34D399 !important;"></span>
                        Operasional Aktif
                    </span>

                    <span class="nirwana-date-text text-xs md:text-sm font-semibold"
                          style="color: #FFFFFF !important; opacity: 0.95 !important; font-weight: 600 !important;">
                        {{ now()->translatedFormat('l, d F Y') }}
                    </span>
                </div>

                <!-- Judul Sapaan -->
                <h2 class="text-xl md:text-2xl font-black tracking-tight flex items-center gap-2"
                    style="color: #FFFFFF !important;">
                    <span>Selamat Datang, {{ auth()->user()->name ?? 'Administrator' }}!</span>
                    <span class="text-xl">👋</span>
                </h2>

                <!-- Deskripsi Singkat -->
                <p class="max-w-2xl text-xs md:text-sm leading-relaxed"
                   style="color: rgba(255, 255, 255, 0.9) !important;">
                    Panel kendali resmi <strong class="font-bold" style="color: #FDE047 !important;">PT Nirwana Tour Lampung</strong>. Pantau reservasi masuk, kelola katalog destinasi, armada transportasi, dan ulasan tamu dalam satu tempat.
                </p>

                <!-- Status alert badges -->
                <div class="flex flex-wrap items-center gap-2 pt-1">
                    @if($pendingInquiries > 0)
                        <a href="{{ $inquiriesUrl }}"
                           class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-1 text-xs font-bold transition hover:opacity-90"
                           style="background: rgba(245, 158, 11, 0.28) !important; border: 1px solid rgba(251, 191, 36, 0.5) !important; color: #FEF08A !important;">
                            <span class="h-2 w-2 rounded-full" style="background-color: #F59E0B !important;"></span>
                            {{ $pendingInquiries }} Pesanan Baru Perlu Dihubungi
                        </a>
                    @else
                        <span class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-1 text-xs font-semibold"
                              style="background: rgba(16, 185, 129, 0.22) !important; border: 1px solid rgba(52, 211, 153, 0.45) !important; color: #A7F3D0 !important;">
                            ✓ Semua Pesanan Sudah Ditindaklanjuti
                        </span>
                    @endif

                    @if($pendingTestimonials > 0)
                        <a href="{{ $testimonialsUrl }}"
                           class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-1 text-xs font-bold transition hover:opacity-90"
                           style="background: rgba(244, 63, 94, 0.28) !important; border: 1px solid rgba(251, 113, 133, 0.5) !important; color: #FECDD3 !important;">
                            <span class="h-2 w-2 rounded-full" style="background-color: #F43F5E !important;"></span>
                            {{ $pendingTestimonials }} Ulasan Tamu Menunggu Persetujuan
                        </a>
                    @endif
                </div>
            </div>

            <!-- Quick Action Buttons -->
            <div class="flex flex-wrap items-center gap-2 shrink-0">
                <a href="{{ $createPackageUrl }}"
                   class="inline-flex items-center gap-2 rounded-xl px-4 py-2.5 text-xs md:text-sm font-bold shadow-md transition transform hover:-translate-y-0.5"
                   style="background-color: #FFFFFF !important; color: #800020 !important;">
                    <x-heroicon-m-plus class="h-4 w-4" style="color: #800020 !important;" />
                    <span>Tambah Paket</span>
                </a>
                <a href="{{ $inquiriesUrl }}"
                   class="inline-flex items-center gap-2 rounded-xl px-3.5 py-2.5 text-xs md:text-sm font-bold backdrop-blur-md transition hover:bg-white/25"
                   style="background: rgba(255, 255, 255, 0.18) !important; border: 1px solid rgba(255, 255, 255, 0.35) !important; color: #FFFFFF !important;">
                    <x-heroicon-m-inbox-arrow-down class="h-4 w-4" style="color: #FFFFFF !important;" />
                    <span>Daftar Leads</span>
                </a>
                <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 rounded-xl px-3 py-2.5 text-xs md:text-sm font-semibold transition hover:bg-white/20"
                   style="background: rgba(255, 255, 255, 0.12) !important; border: 1px solid rgba(255, 255, 255, 0.25) !important; color: #FFFFFF !important;"
                   title="Buka Website Publik">
                    <x-heroicon-m-arrow-top-right-on-square class="h-4 w-4" style="color: #FFFFFF !important;" />
                    <span class="hidden sm:inline">Website</span>
                </a>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
