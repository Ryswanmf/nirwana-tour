<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { route } from '@/routes';

const props = defineProps({
  stats: Object,
  recentInquiries: Array,
  featuredPackages: Array,
});

const statusBadge = (status) => {
  switch (status) {
    case 'pending':
      return { text: 'Menunggu', class: 'bg-amber-100 text-amber-800 border-amber-200' };
    case 'contacted':
      return { text: 'Dihubungi', class: 'bg-sky-100 text-sky-800 border-sky-200' };
    case 'completed':
      return { text: 'Selesai', class: 'bg-emerald-100 text-emerald-800 border-emerald-200' };
    default:
      return { text: status, class: 'bg-slate-100 text-slate-700 border-slate-200' };
  }
};
</script>

<template>
  <Head title="Dashboard Ringkasan" />

  <AdminLayout>
    <template #header-title>
      <div class="flex items-center gap-2">
        <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">Dashboard Ringkasan</h1>
        <span class="text-xs px-2 py-0.5 rounded-full bg-pink-100 text-[#DE0171] font-bold">Vue SPA</span>
      </div>
    </template>

    <div class="space-y-6">
      <!-- Welcome Banner -->
      <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-900 via-slate-800 to-[#36021B] text-white p-6 sm:p-8 shadow-xl">
        <div class="relative z-10 max-w-2xl">
          <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-pink-300 text-xs font-semibold backdrop-blur-sm mb-3">
            <i class="fa-solid fa-sparkles text-[10px]"></i> Selamat Datang di Portal Admin Nirwana
          </span>
          <h2 class="text-xl sm:text-2xl font-black tracking-tight text-white mb-2">
            Kelola Paket Wisata & Interaksi Pelanggan Lebih Cepat
          </h2>
          <p class="text-xs sm:text-sm text-slate-300 leading-relaxed mb-5">
            Semua perubahan paket wisata, galeri, dan pemantauan pesan masuk langsung tersinkronisasi ke website publik tanpa loading lama.
          </p>
          <div class="flex flex-wrap items-center gap-3">
            <Link
              :href="route('admin.packages.create')"
              class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white text-xs font-bold shadow-md shadow-[#DE0171]/30 hover:opacity-95 transition"
            >
              <i class="fa-solid fa-plus text-xs"></i>
              <span>Tambah Paket Baru</span>
            </Link>
            <Link
              :href="route('admin.inquiries.index')"
              class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-semibold backdrop-blur-sm transition"
            >
              <i class="fa-solid fa-inbox text-xs"></i>
              <span>Lihat Semua Pesan ({{ stats.inquiries_pending }} Baru)</span>
            </Link>
          </div>
        </div>

        <!-- Decorative background glow -->
        <div class="absolute -right-10 -bottom-10 w-64 h-64 rounded-full bg-[#DE0171]/20 blur-3xl pointer-events-none"></div>
      </div>

      <!-- Stat Cards Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        <!-- Card 1: Paket Wisata -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition">
          <div class="flex items-center justify-between">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Paket Wisata</span>
            <div class="w-10 h-10 rounded-xl bg-pink-50 text-[#DE0171] flex items-center justify-center text-base">
              <i class="fa-solid fa-map-location-dot"></i>
            </div>
          </div>
          <div class="mt-3 flex items-baseline gap-2">
            <span class="text-2xl sm:text-3xl font-black text-slate-900">{{ stats.packages_total }}</span>
            <span class="text-xs text-emerald-600 font-semibold">{{ stats.packages_active }} Aktif</span>
          </div>
          <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
            <Link :href="route('admin.packages.index')" class="text-[#DE0171] hover:underline font-semibold">
              Kelola Paket &rarr;
            </Link>
          </div>
        </div>

        <!-- Card 2: Pesan Masuk / Inquiries -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition">
          <div class="flex items-center justify-between">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Pesan / Konsultasi</span>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-base">
              <i class="fa-solid fa-envelope-open-text"></i>
            </div>
          </div>
          <div class="mt-3 flex items-baseline gap-2">
            <span class="text-2xl sm:text-3xl font-black text-slate-900">{{ stats.inquiries_total }}</span>
            <span class="text-xs px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 font-bold">
              {{ stats.inquiries_pending }} Menunggu
            </span>
          </div>
          <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
            <Link :href="route('admin.inquiries.index')" class="text-amber-600 hover:underline font-semibold">
              Buka Kotak Masuk &rarr;
            </Link>
          </div>
        </div>

        <!-- Card 3: Layanan Wisata -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition">
          <div class="flex items-center justify-between">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Layanan Perjalanan</span>
            <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center text-base">
              <i class="fa-solid fa-bell-concierge"></i>
            </div>
          </div>
          <div class="mt-3 flex items-baseline gap-2">
            <span class="text-2xl sm:text-3xl font-black text-slate-900">{{ stats.services_total }}</span>
            <span class="text-xs text-slate-500">Kategori Layanan</span>
          </div>
          <div class="mt-3 pt-3 border-t border-slate-100 text-xs text-slate-500">
            <span>Paket tour, sewa bus, outbound</span>
          </div>
        </div>

        <!-- Card 4: Armada Bus -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition">
          <div class="flex items-center justify-between">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Armada Transportasi</span>
            <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-base">
              <i class="fa-solid fa-bus-simple"></i>
            </div>
          </div>
          <div class="mt-3 flex items-baseline gap-2">
            <span class="text-2xl sm:text-3xl font-black text-slate-900">{{ stats.fleets_total }}</span>
            <span class="text-xs text-slate-500">Unit Siap Jalan</span>
          </div>
          <div class="mt-3 pt-3 border-t border-slate-100 text-xs text-slate-500">
            <span>Bus Pariwisata & HiAce</span>
          </div>
        </div>
      </div>

      <!-- Two Columns: Inquiries List & Featured Packages -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Inquiries / Pesan Terbaru (2 Cols) -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
          <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <div>
              <h3 class="font-bold text-slate-900 text-sm sm:text-base">Pesan & Permintaan Konsultasi Terbaru</h3>
              <p class="text-xs text-slate-500">Calon klien yang mengirimkan formulir dari website</p>
            </div>
            <Link :href="route('admin.inquiries.index')" class="text-xs text-[#DE0171] hover:underline font-bold">
              Lihat Semua
            </Link>
          </div>

          <div v-if="recentInquiries && recentInquiries.length > 0" class="divide-y divide-slate-100">
            <div
              v-for="inq in recentInquiries"
              :key="inq.id"
              class="p-4 sm:p-5 hover:bg-slate-50/70 transition flex flex-col sm:flex-row sm:items-center justify-between gap-3"
            >
              <div class="space-y-1 min-w-0">
                <div class="flex items-center gap-2">
                  <span class="font-bold text-slate-900 text-sm">{{ inq.name }}</span>
                  <span
                    :class="['text-[10px] font-bold px-2 py-0.5 rounded-full border', statusBadge(inq.status).class]"
                  >
                    {{ statusBadge(inq.status).text }}
                  </span>
                </div>
                <div class="text-xs text-slate-600 flex flex-wrap items-center gap-3">
                  <span><i class="fa-solid fa-phone text-slate-400 mr-1 text-[11px]"></i> {{ inq.phone }}</span>
                  <span v-if="inq.tour_package">
                    <i class="fa-solid fa-map-pin text-[#DE0171] mr-1 text-[11px]"></i> {{ inq.tour_package.title }}
                  </span>
                  <span><i class="fa-solid fa-users text-slate-400 mr-1 text-[11px]"></i> {{ inq.participants ?? 1 }} Pax</span>
                </div>
                <p v-if="inq.message" class="text-xs text-slate-500 line-clamp-1 italic">
                  "{{ inq.message }}"
                </p>
              </div>

              <div class="flex items-center gap-2 shrink-0">
                <a
                  :href="`https://wa.me/${inq.phone.replace(/[^0-9]/g, '')}`"
                  target="_blank"
                  class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 text-xs font-semibold transition"
                >
                  <i class="fa-brands fa-whatsapp text-sm"></i>
                  <span>WhatsApp</span>
                </a>
              </div>
            </div>
          </div>
          <div v-else class="p-8 text-center text-slate-400 text-xs">
            Belum ada pesan masuk dari pengunjung.
          </div>
        </div>

        <!-- Featured Packages Quick Preview (1 Col) -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
          <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <div>
              <h3 class="font-bold text-slate-900 text-sm">Paket Wisata Unggulan</h3>
              <p class="text-xs text-slate-500">Tampil di beranda utama</p>
            </div>
            <Link :href="route('admin.packages.create')" class="text-xs text-[#DE0171] hover:underline font-bold">
              + Tambah
            </Link>
          </div>

          <div v-if="featuredPackages && featuredPackages.length > 0" class="p-4 space-y-3">
            <div
              v-for="pkg in featuredPackages"
              :key="pkg.id"
              class="flex items-center gap-3 p-2.5 rounded-xl border border-slate-100 hover:border-pink-200 transition"
            >
              <div class="w-12 h-12 rounded-lg bg-slate-100 overflow-hidden shrink-0">
                <img
                  :src="pkg.thumbnail ? (pkg.thumbnail.startsWith('http') ? pkg.thumbnail : `/storage/${pkg.thumbnail}`) : '/assets/images/destinasi/pahawang.jpg'"
                  :alt="pkg.title"
                  class="w-full h-full object-cover"
                />
              </div>
              <div class="min-w-0 flex-1">
                <div class="text-xs font-bold text-slate-900 truncate">{{ pkg.title }}</div>
                <div class="text-[11px] text-[#DE0171] font-semibold mt-0.5">
                  Rp {{ Number(pkg.price_from).toLocaleString('id-ID') }}
                </div>
              </div>
              <Link
                :href="route('admin.packages.edit', pkg.id)"
                class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:text-[#DE0171] hover:bg-pink-50 text-xs"
                title="Edit Paket"
              >
                <i class="fa-solid fa-pen-to-square"></i>
              </Link>
            </div>
          </div>
          <div v-else class="p-8 text-center text-slate-400 text-xs">
            Belum ada paket unggulan yang ditandai.
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
