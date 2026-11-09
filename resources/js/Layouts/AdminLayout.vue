<script setup>
import { ref, computed } from 'vue';
import { Link, usePage, router } from '@inertiajs/vue3';
import { route } from '@/routes';

const page = usePage();
const user = computed(() => page.props.auth?.user);
const flash = computed(() => page.props.flash);

const isMobileMenuOpen = ref(false);

const navigation = [
  { name: 'Dashboard', route: 'admin.dashboard', icon: 'fa-solid fa-chart-pie' },
  { name: 'Paket Wisata', route: 'admin.packages.index', icon: 'fa-solid fa-map-location-dot' },
  { name: 'Layanan Wisata', route: 'admin.services.index', icon: 'fa-solid fa-bell-concierge' },
  { name: 'Artikel & Tips', route: 'admin.posts.index', icon: 'fa-solid fa-newspaper' },
  { name: 'Galeri Media', route: 'admin.gallery.index', icon: 'fa-solid fa-images' },
  { name: 'Mitra Rekanan', route: 'admin.partners.index', icon: 'fa-solid fa-handshake' },
  { name: 'Armada Bus', route: 'admin.fleets.index', icon: 'fa-solid fa-bus-simple' },
  { name: 'Pesan / Inquiry', route: 'admin.inquiries.index', icon: 'fa-solid fa-envelope-open-text' },
  { name: 'Ulasan / Testimoni', route: 'admin.testimonials.index', icon: 'fa-solid fa-comment-dots' },
  { name: 'Kelola Admin', route: 'admin.users.index', icon: 'fa-solid fa-user-shield' },
  { name: 'Pengaturan Web', route: 'admin.settings.index', icon: 'fa-solid fa-sliders' },
];

const logout = () => {
  if (confirm('Apakah Anda yakin ingin keluar dari sesi admin?')) {
    router.post('/admin/logout');
  }
};
</script>

<template>
  <div class="min-h-screen bg-slate-50 flex">
    <!-- Desktop Sidebar -->
    <aside class="hidden lg:flex flex-col w-64 bg-slate-900 border-r border-slate-800 text-slate-300 shrink-0">
      <!-- Sidebar Header / Logo -->
      <div class="h-18 flex items-center px-6 gap-3 border-b border-slate-800/80 bg-slate-950/40">
        <img :src="'/assets/logo/Logo-Nirwana.png'" alt="Nirwana Tour" class="w-9 h-9 object-contain drop-shadow" />
        <div class="leading-tight">
          <div class="font-bold text-white text-base tracking-tight flex items-center gap-1">
            <span>Nirwana</span>
            <span class="text-[#DE0171] font-extrabold">Admin</span>
          </div>
          <div class="text-[10px] text-slate-400 font-medium uppercase tracking-wider">Tour & Travel Lampung</div>
        </div>
      </div>

      <!-- Navigation Links -->
      <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
        <div class="px-3 pb-2 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Menu Utama</div>

        <Link
          v-for="item in navigation"
          :key="item.name"
          :href="route(item.route)"
          :class="[
            route().current(item.route + '*')
              ? 'bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white shadow-md shadow-[#DE0171]/25 font-semibold'
              : 'text-slate-300 hover:bg-slate-800/70 hover:text-white',
            'flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm transition-all duration-150'
          ]"
        >
          <i :class="[item.icon, 'w-5 text-center text-sm']"></i>
          <span>{{ item.name }}</span>
        </Link>

        <div class="pt-6 px-3 pb-2 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Akses Publik</div>

        <a
          href="/"
          target="_blank"
          class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm text-slate-300 hover:bg-slate-800/70 hover:text-white transition-all duration-150"
        >
          <div class="flex items-center gap-3">
            <i class="fa-solid fa-arrow-up-right-from-square w-5 text-center text-xs"></i>
            <span>Lihat Website</span>
          </div>
          <span class="text-[10px] px-1.5 py-0.5 rounded bg-slate-800 text-slate-400">Publik</span>
        </a>
      </nav>

      <!-- Sidebar User Footer -->
      <div class="p-4 border-t border-slate-800/80 bg-slate-950/30 flex items-center justify-between">
        <div class="flex items-center gap-3 min-w-0">
          <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-[#DE0171] to-[#FC028B] flex items-center justify-center text-white font-bold text-xs uppercase shadow">
            {{ user?.name ? user.name.substring(0, 2) : 'AD' }}
          </div>
          <div class="min-w-0 truncate">
            <div class="text-xs font-bold text-white truncate">{{ user?.name ?? 'Admin' }}</div>
            <div class="text-[11px] text-slate-400 truncate">{{ user?.email }}</div>
          </div>
        </div>
        <button
          @click="logout"
          title="Keluar"
          class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 transition"
        >
          <i class="fa-solid fa-right-from-bracket text-xs"></i>
        </button>
      </div>
    </aside>

    <!-- Mobile Drawer Sidebar -->
    <div
      v-if="isMobileMenuOpen"
      class="fixed inset-0 z-50 lg:hidden flex"
      role="dialog"
      aria-modal="true"
      @keydown.escape.window="isMobileMenuOpen = false"
    >
      <div class="fixed inset-0 bg-slate-900/70 backdrop-blur-sm transition-opacity" @click="isMobileMenuOpen = false"></div>

      <aside class="relative flex flex-col w-72 max-w-[85vw] bg-slate-900 text-slate-300 z-10 shadow-2xl animate-in slide-in-from-left duration-200">
        <div class="h-16 flex items-center justify-between px-6 border-b border-slate-800">
          <div class="flex items-center gap-2.5">
            <img :src="'/assets/logo/Logo-Nirwana.png'" alt="Nirwana" class="w-8 h-8 object-contain" />
            <span class="font-bold text-white">Nirwana <span class="text-[#DE0171]">Admin</span></span>
          </div>
          <button @click="isMobileMenuOpen = false" class="text-slate-400 hover:text-white">
            <i class="fa-solid fa-xmark text-lg"></i>
          </button>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
          <Link
            v-for="item in navigation"
            :key="item.name"
            :href="route(item.route)"
            @click="isMobileMenuOpen = false"
            :class="[
              route().current(item.route + '*')
                ? 'bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white font-semibold'
                : 'text-slate-300 hover:bg-slate-800/70 hover:text-white',
              'flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm'
            ]"
          >
            <i :class="[item.icon, 'w-5 text-center text-sm']"></i>
            <span>{{ item.name }}</span>
          </Link>

          <a
            href="/"
            target="_blank"
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm text-slate-300 hover:bg-slate-800/70"
          >
            <i class="fa-solid fa-arrow-up-right-from-square w-5 text-center text-xs"></i>
            <span>Lihat Website</span>
          </a>
        </nav>

        <div class="p-4 border-t border-slate-800 flex items-center justify-between">
          <div class="text-xs truncate">
            <div class="font-bold text-white truncate">{{ user?.name }}</div>
            <div class="text-[11px] text-slate-400 truncate">{{ user?.email }}</div>
          </div>
          <button @click="logout" class="text-xs text-rose-400 hover:underline">
            Keluar
          </button>
        </div>
      </aside>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
      <!-- Topbar Header -->
      <header class="h-16 bg-white border-b border-slate-200 px-4 sm:px-6 flex items-center justify-between sticky top-0 z-30 shadow-xs">
        <div class="flex items-center gap-3">
          <button
            @click="isMobileMenuOpen = true"
            class="lg:hidden w-9 h-9 rounded-lg flex items-center justify-center text-slate-600 hover:bg-slate-100"
            aria-label="Buka Menu"
          >
            <i class="fa-solid fa-bars text-base"></i>
          </button>

          <div>
            <slot name="header-title">
              <h1 class="text-base sm:text-lg font-bold text-slate-900 tracking-tight">Portal Admin Nirwana</h1>
            </slot>
          </div>
        </div>

        <div class="flex items-center gap-3">
          <a
            href="/"
            target="_blank"
            class="hidden sm:inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-lg border border-slate-200 text-slate-700 hover:border-[#DE0171] hover:text-[#DE0171] transition"
          >
            <i class="fa-solid fa-globe text-[11px]"></i>
            <span>Lihat Web</span>
          </a>

          <div class="h-4 w-px bg-slate-200 hidden sm:block"></div>

          <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full bg-[#DE0171] text-white flex items-center justify-center font-bold text-xs uppercase shadow-sm">
              {{ user?.name ? user.name.substring(0, 1) : 'A' }}
            </div>
            <span class="text-xs font-semibold text-slate-800 hidden md:inline-block">{{ user?.name ?? 'Admin' }}</span>
          </div>

          <!-- Tombol Logout Cepat di Header -->
          <button
            @click="logout"
            type="button"
            title="Keluar dari Akun Admin"
            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200/80 text-xs font-bold transition shadow-2xs ml-1"
          >
            <i class="fa-solid fa-right-from-bracket text-xs"></i>
            <span class="hidden sm:inline">Keluar</span>
          </button>
        </div>
      </header>

      <!-- Flash Notification Banner -->
      <div v-if="flash?.success || flash?.error || flash?.info" class="px-4 sm:px-6 pt-4">
        <div
          v-if="flash.success"
          class="flex items-center gap-3 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium shadow-xs"
        >
          <i class="fa-solid fa-circle-check text-emerald-500 text-base shrink-0"></i>
          <span>{{ flash.success }}</span>
        </div>

        <div
          v-if="flash.error"
          class="flex items-center gap-3 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-medium shadow-xs"
        >
          <i class="fa-solid fa-triangle-exclamation text-rose-500 text-base shrink-0"></i>
          <span>{{ flash.error }}</span>
        </div>

        <div
          v-if="flash.info"
          class="flex items-center gap-3 p-3.5 rounded-xl bg-sky-50 border border-sky-200 text-sky-800 text-sm font-medium shadow-xs"
        >
          <i class="fa-solid fa-circle-info text-sky-500 text-base shrink-0"></i>
          <span>{{ flash.info }}</span>
        </div>
      </div>

      <!-- Page Content Slot -->
      <main class="flex-1 p-4 sm:p-6 lg:p-8">
        <slot />
      </main>
    </div>
  </div>
</template>
