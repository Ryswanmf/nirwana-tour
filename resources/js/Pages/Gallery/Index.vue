<script setup>
import { ref, watch } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { route } from '@/routes';

const props = defineProps({
  items: Object,
  filters: Object,
  categories: Array,
});

const search = ref(props.filters.search);
const type = ref(props.filters.type);

let searchTimer = null;
watch([search, type], () => {
  clearTimeout(searchTimer);
  searchTimer = setTimeout(() => {
    router.get(
      route('admin.gallery.index'),
      { search: search.value, type: type.value },
      { preserveState: true, replace: true }
    );
  }, 300);
});

const deleteItem = (item) => {
  if (confirm(`Hapus media "${item.title}" dari galeri?`)) {
    router.delete(route('admin.gallery.destroy', item.id));
  }
};

const toggleFeatured = (item) => {
  router.post(route('admin.gallery.toggle', item.id), {}, { preserveScroll: true });
};

// Bulk Selection & Deletion
const selectedIds = ref([]);
const selectAll = ref(false);

const toggleSelectAll = () => {
  if (selectAll.value) {
    selectedIds.value = props.items.data.map((item) => item.id);
  } else {
    selectedIds.value = [];
  }
};

watch(() => props.items.data, () => {
  selectedIds.value = [];
  selectAll.value = false;
});

const bulkDelete = () => {
  if (selectedIds.value.length === 0) return;
  if (
    confirm(
      `Apakah Anda yakin ingin menghapus ${selectedIds.value.length} media galeri yang dipilih sekaligus? Tindakan ini tidak dapat dibatalkan.`
    )
  ) {
    router.post(
      route('admin.gallery.bulk-delete'),
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
  <Head title="Manajemen Galeri Dokumentasi" />

  <AdminLayout>
    <template #header-title>
      <div class="flex items-center gap-2">
        <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">Galeri Dokumentasi</h1>
        <span class="text-xs px-2.5 py-0.5 rounded-full bg-slate-200 text-slate-700 font-bold">
          {{ items.total }} Media
        </span>
      </div>
    </template>

    <div class="space-y-5">
      <!-- Toolbar -->
      <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="flex flex-wrap items-center gap-2.5 w-full sm:w-auto">
          <label class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-slate-50 border border-slate-200 text-xs font-bold text-slate-700 cursor-pointer hover:bg-slate-100 transition select-none">
            <input
              type="checkbox"
              v-model="selectAll"
              @change="toggleSelectAll"
              class="w-4 h-4 rounded text-[#DE0171] focus:ring-[#DE0171] border-slate-300"
            />
            <span>Pilih Semua</span>
          </label>

          <div class="relative w-full sm:w-64">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
              <i class="fa-solid fa-magnifying-glass text-xs"></i>
            </span>
            <input
              v-model="search"
              type="text"
              placeholder="Cari judul dokumentasi..."
              class="w-full pl-9 pr-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>

          <select
            v-model="type"
            class="py-2 px-3 rounded-xl border border-slate-200 text-xs text-slate-700 focus:outline-none focus:border-[#DE0171]"
          >
            <option value="">Semua Format Media</option>
            <option value="image">Foto (Gambar)</option>
            <option value="reel">Instagram Reels</option>
            <option value="video">Video YouTube / MP4</option>
          </select>
        </div>

        <Link
          :href="route('admin.gallery.create')"
          class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white text-xs font-bold shadow-md shadow-[#DE0171]/25 hover:opacity-95 transition shrink-0 w-full sm:w-auto justify-center"
        >
          <i class="fa-solid fa-plus text-xs"></i>
          <span>Upload Media Baru</span>
        </Link>
      </div>

      <!-- Bulk Action Bar -->
      <div
        v-if="selectedIds.length > 0"
        class="p-3.5 bg-pink-50 border border-pink-200 rounded-2xl flex items-center justify-between shadow-xs animate-in fade-in"
      >
        <div class="flex items-center gap-2 text-xs font-bold text-[#DE0171]">
          <i class="fa-solid fa-check-double text-sm"></i>
          <span>{{ selectedIds.length }} media galeri dipilih</span>
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

      <!-- Gallery Grid -->
      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
        <div
          v-for="item in items.data"
          :key="item.id"
          class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden flex flex-col justify-between group hover:shadow-md transition relative"
          :class="{ 'ring-2 ring-[#DE0171]': selectedIds.includes(item.id) }"
        >
          <div class="relative aspect-4/3 bg-slate-100 overflow-hidden">
            <img :src="item.preview_url" :alt="item.title" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" />
            <div class="absolute top-2.5 left-2.5 flex items-center gap-1.5">
              <input
                type="checkbox"
                :value="item.id"
                v-model="selectedIds"
                class="w-4 h-4 rounded text-[#DE0171] focus:ring-[#DE0171] border-slate-300 bg-white/90 shadow-sm cursor-pointer"
              />
              <span class="px-2 py-0.5 rounded-md bg-slate-900/80 backdrop-blur-sm text-white text-[10px] font-bold uppercase tracking-wider">
                <i v-if="item.media_type === 'image'" class="fa-solid fa-image mr-1 text-sky-400"></i>
                <i v-else-if="item.media_type === 'reel'" class="fa-brands fa-instagram mr-1 text-pink-400"></i>
                <i v-else class="fa-solid fa-video mr-1 text-amber-400"></i>
                {{ item.media_type }}
              </span>
            </div>
            <button
              @click="toggleFeatured(item)"
              :class="item.is_featured ? 'text-amber-400 bg-slate-900/80' : 'text-white/60 bg-slate-900/40 hover:text-amber-400'"
              class="absolute top-2.5 right-2.5 w-7 h-7 rounded-lg flex items-center justify-center text-xs backdrop-blur-sm transition"
              title="Toggle Unggulan"
            >
              <i class="fa-solid fa-star"></i>
            </button>
          </div>

          <div class="p-3.5 space-y-2">
            <div class="font-bold text-slate-900 text-xs line-clamp-1" :title="item.title">
              {{ item.title }}
            </div>
            <div class="text-[10px] text-slate-400 flex items-center justify-between">
              <span>{{ item.category_name }}</span>
              <div class="flex items-center gap-1">
                <Link
                  :href="route('admin.gallery.edit', item.id)"
                  class="w-6 h-6 rounded flex items-center justify-center text-slate-400 hover:text-[#DE0171] hover:bg-pink-50"
                  title="Edit"
                >
                  <i class="fa-solid fa-pen-to-square text-[11px]"></i>
                </Link>
                <button
                  type="button"
                  @click="deleteItem(item)"
                  class="w-6 h-6 rounded flex items-center justify-center text-slate-400 hover:text-rose-600 hover:bg-rose-50"
                  title="Hapus"
                >
                  <i class="fa-solid fa-trash-can text-[11px]"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Pagination -->
      <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <Pagination :data="items" label="media galeri" />
      </div>
    </div>
  </AdminLayout>
</template>
