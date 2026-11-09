<script setup>
import { ref, watch } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { route } from '@/routes';

const props = defineProps({
  packages: Object,
  categories: Array,
  filters: Object,
});

const search = ref(props.filters.search);
const category = ref(props.filters.category);
const status = ref(props.filters.status);

let searchTimeout = null;
watch([search, category, status], () => {
  clearTimeout(searchTimeout);
  searchTimeout = setTimeout(() => {
    router.get(
      route('admin.packages.index'),
      {
        search: search.value,
        category: category.value,
        status: status.value,
      },
      {
        preserveState: true,
        replace: true,
      }
    );
  }, 300);
});

const deletePackage = (pkg) => {
  if (confirm(`Hapus paket wisata "${pkg.title}"? Data yang dihapus tidak dapat dipulihkan.`)) {
    router.delete(route('admin.packages.destroy', pkg.id));
  }
};

const toggleField = (pkg, field) => {
  router.post(
    route('admin.packages.toggle', pkg.id),
    { field },
    { preserveScroll: true }
  );
};

// Bulk Selection & Deletion
const selectedIds = ref([]);
const selectAll = ref(false);

const toggleSelectAll = () => {
  if (selectAll.value) {
    selectedIds.value = props.packages.data.map((item) => item.id);
  } else {
    selectedIds.value = [];
  }
};

watch(() => props.packages.data, () => {
  selectedIds.value = [];
  selectAll.value = false;
});

const bulkDelete = () => {
  if (selectedIds.value.length === 0) return;
  if (
    confirm(
      `Apakah Anda yakin ingin menghapus ${selectedIds.value.length} paket wisata yang dipilih sekaligus? Tindakan ini tidak dapat dibatalkan.`
    )
  ) {
    router.post(
      route('admin.packages.bulk-delete'),
      { ids: selectedIds.value },
      {
        onSuccess: () => {
          selectedIds.value = [];
          selectAll.value = false;
        },
      }
    );
  }
};
</script>

<template>
  <Head title="Manajemen Paket Wisata" />

  <AdminLayout>
    <template #header-title>
      <div class="flex items-center gap-2">
        <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">Manajemen Paket Wisata</h1>
        <span class="text-xs px-2.5 py-0.5 rounded-full bg-slate-200 text-slate-700 font-bold">
          {{ packages.total }} Paket
        </span>
      </div>
    </template>

    <div class="space-y-5">
      <!-- Toolbar: Search, Filters & Action -->
      <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col md:flex-row items-center justify-between gap-3">
        <!-- Search & Filter inputs -->
        <div class="flex flex-wrap items-center gap-2.5 w-full md:w-auto">
          <!-- Search Box -->
          <div class="relative w-full sm:w-64">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
              <i class="fa-solid fa-magnifying-glass text-xs"></i>
            </span>
            <input
              v-model="search"
              type="text"
              placeholder="Cari nama paket/lokasi..."
              class="w-full pl-9 pr-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171] focus:ring-1 focus:ring-[#DE0171]"
            />
          </div>

          <!-- Category Filter -->
          <select
            v-model="category"
            class="py-2 px-3 rounded-xl border border-slate-200 text-xs text-slate-700 focus:outline-none focus:border-[#DE0171]"
          >
            <option value="">Semua Kategori</option>
            <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
          </select>

          <!-- Status Filter -->
          <select
            v-model="status"
            class="py-2 px-3 rounded-xl border border-slate-200 text-xs text-slate-700 focus:outline-none focus:border-[#DE0171]"
          >
            <option value="">Semua Status</option>
            <option value="1">Aktif (Tampil)</option>
            <option value="0">Draft (Sembunyi)</option>
          </select>
        </div>

        <!-- Add Button -->
        <Link
          :href="route('admin.packages.create')"
          class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white text-xs font-bold shadow-md shadow-[#DE0171]/25 hover:opacity-95 transition shrink-0 w-full sm:w-auto justify-center"
        >
          <i class="fa-solid fa-plus text-xs"></i>
          <span>Tambah Paket Wisata</span>
        </Link>
      </div>

      <!-- Bulk Action Bar -->
      <div
        v-if="selectedIds.length > 0"
        class="p-3.5 bg-pink-50 border border-pink-200 rounded-2xl flex items-center justify-between shadow-xs animate-in fade-in"
      >
        <div class="flex items-center gap-2 text-xs font-bold text-[#DE0171]">
          <i class="fa-solid fa-check-double text-sm"></i>
          <span>{{ selectedIds.length }} paket wisata dipilih</span>
        </div>
        <div class="flex items-center gap-2">
          <button
            type="button"
            @click="selectedIds = []; selectAll = false;"
            class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 text-xs font-semibold transition"
          >
            Batal
          </button>
          <button
            type="button"
            @click="bulkDelete"
            class="px-3.5 py-1.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold shadow-xs transition inline-flex items-center gap-1.5"
          >
            <i class="fa-solid fa-trash text-xs"></i>
            <span>Hapus Terpilih ({{ selectedIds.length }})</span>
          </button>
        </div>
      </div>

      <!-- Packages Table -->
      <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-left text-xs">
            <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-bold border-b border-slate-200/80">
              <tr>
                <th class="py-3.5 px-4 w-10 text-center">
                  <input
                    type="checkbox"
                    v-model="selectAll"
                    @change="toggleSelectAll"
                    class="w-4 h-4 rounded text-[#DE0171] focus:ring-[#DE0171] border-slate-300"
                    title="Pilih Semua di Halaman Ini"
                  />
                </th>
                <th class="py-3.5 px-4 w-12 text-center">Foto</th>
                <th class="py-3.5 px-4">Nama Paket & Lokasi</th>
                <th class="py-3.5 px-4">Kategori</th>
                <th class="py-3.5 px-4">Harga Mulai</th>
                <th class="py-3.5 px-4">Durasi</th>
                <th class="py-3.5 px-4 text-center">Unggulan</th>
                <th class="py-3.5 px-4 text-center">Status</th>
                <th class="py-3.5 px-4 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              <tr
                v-for="pkg in packages.data"
                :key="pkg.id"
                class="hover:bg-slate-50/70 transition"
                :class="{ 'bg-pink-50/40': selectedIds.includes(pkg.id) }"
              >
                <td class="py-3 px-4 text-center">
                  <input
                    type="checkbox"
                    :value="pkg.id"
                    v-model="selectedIds"
                    class="w-4 h-4 rounded text-[#DE0171] focus:ring-[#DE0171] border-slate-300"
                  />
                </td>
                <!-- Thumbnail -->
                <td class="py-3 px-4 text-center">
                  <div class="w-12 h-12 rounded-xl bg-slate-100 overflow-hidden mx-auto shadow-xs border border-slate-200">
                    <img :src="pkg.thumbnail_url" :alt="pkg.title" class="w-full h-full object-cover" />
                  </div>
                </td>

                <!-- Title & Location -->
                <td class="py-3 px-4">
                  <div class="font-bold text-slate-900 text-sm hover:text-[#DE0171] transition">
                    <Link :href="route('admin.packages.edit', pkg.id)">{{ pkg.title }}</Link>
                  </div>
                  <div class="text-[11px] text-slate-500 flex items-center gap-2 mt-0.5">
                    <span v-if="pkg.destination_location">
                      <i class="fa-solid fa-location-dot text-[#DE0171] mr-1"></i> {{ pkg.destination_location }}
                    </span>
                    <span v-if="pkg.badge" class="px-1.5 py-0.5 rounded bg-pink-50 text-[#DE0171] font-bold text-[10px]">
                      {{ pkg.badge }}
                    </span>
                  </div>
                </td>

                <!-- Category -->
                <td class="py-3 px-4">
                  <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold text-[11px]">
                    {{ pkg.category_name }}
                  </span>
                </td>

                <!-- Price -->
                <td class="py-3 px-4">
                  <span class="font-extrabold text-[#DE0171] text-xs">
                    {{ pkg.price_formatted }}
                  </span>
                  <div class="text-[10px] text-slate-400">/ orang</div>
                </td>

                <!-- Duration -->
                <td class="py-3 px-4 text-slate-600 font-medium">
                  {{ pkg.duration }}
                </td>

                <!-- Featured Toggle -->
                <td class="py-3 px-4 text-center">
                  <button
                    @click="toggleField(pkg, 'is_featured')"
                    :title="pkg.is_featured ? 'Hapus dari unggulan' : 'Jadikan unggulan di beranda'"
                    class="p-1.5 rounded-lg text-sm transition"
                    :class="pkg.is_featured ? 'text-amber-500 bg-amber-50' : 'text-slate-300 hover:text-amber-400'"
                  >
                    <i class="fa-solid fa-star"></i>
                  </button>
                </td>

                <!-- Active Toggle -->
                <td class="py-3 px-4 text-center">
                  <button
                    @click="toggleField(pkg, 'is_active')"
                    :class="[
                      pkg.is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600',
                      'px-2.5 py-1 rounded-full text-[10px] font-bold transition hover:opacity-80'
                    ]"
                  >
                    {{ pkg.is_active ? 'Aktif' : 'Draft' }}
                  </button>
                </td>

                <!-- Actions -->
                <td class="py-3 px-4 text-right">
                  <div class="inline-flex items-center gap-1.5">
                    <a
                      :href="`/paket-wisata/${pkg.slug}`"
                      target="_blank"
                      title="Lihat di Web Publik"
                      class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-100"
                    >
                      <i class="fa-solid fa-eye text-xs"></i>
                    </a>
                    <Link
                      :href="route('admin.packages.edit', pkg.id)"
                      title="Edit Paket"
                      class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:text-[#DE0171] hover:bg-pink-50"
                    >
                      <i class="fa-solid fa-pen-to-square text-xs"></i>
                    </Link>
                    <button
                      @click="deletePackage(pkg)"
                      title="Hapus Paket"
                      class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:bg-rose-50"
                    >
                      <i class="fa-solid fa-trash-can text-xs"></i>
                    </button>
                  </div>
                </td>
              </tr>

              <tr v-if="packages.data.length === 0">
                <td colspan="8" class="p-8 text-center text-slate-400">
                  Tidak ada paket wisata yang cocok dengan filter atau kata kunci.
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <Pagination :data="packages" label="paket wisata" />
      </div>
    </div>
  </AdminLayout>
</template>
