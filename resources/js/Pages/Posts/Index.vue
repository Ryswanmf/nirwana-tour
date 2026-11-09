<script setup>
import { ref, watch } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { route } from '@/routes';

const props = defineProps({
  posts: Object,
  categories: Array,
  filters: Object,
});

const search = ref(props.filters.search);
const category = ref(props.filters.category);

let searchTimer = null;
watch([search, category], () => {
  clearTimeout(searchTimer);
  searchTimer = setTimeout(() => {
    router.get(
      route('admin.posts.index'),
      { search: search.value, category: category.value },
      { preserveState: true, replace: true }
    );
  }, 300);
});

const deletePost = (item) => {
  if (confirm(`Hapus artikel "${item.title}"?`)) {
    router.delete(route('admin.posts.destroy', item.id));
  }
};

const toggleField = (item, field) => {
  router.post(route('admin.posts.toggle', item.id), { field }, { preserveScroll: true });
};

// Bulk Selection & Deletion
const selectedIds = ref([]);
const selectAll = ref(false);

const toggleSelectAll = () => {
  if (selectAll.value) {
    selectedIds.value = props.posts.data.map((item) => item.id);
  } else {
    selectedIds.value = [];
  }
};

watch(() => props.posts.data, () => {
  selectedIds.value = [];
  selectAll.value = false;
});

const bulkDelete = () => {
  if (selectedIds.value.length === 0) return;
  if (
    confirm(
      `Apakah Anda yakin ingin menghapus ${selectedIds.value.length} artikel yang dipilih sekaligus? Tindakan ini tidak dapat dibatalkan.`
    )
  ) {
    router.post(
      route('admin.posts.bulk-delete'),
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
  <Head title="Manajemen Berita & Artikel" />

  <AdminLayout>
    <template #header-title>
      <div class="flex items-center gap-2">
        <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">Manajemen Artikel & Tips Wisata</h1>
        <span class="text-xs px-2.5 py-0.5 rounded-full bg-slate-200 text-slate-700 font-bold">
          {{ posts.total }} Artikel
        </span>
      </div>
    </template>

    <div class="space-y-5">
      <!-- Toolbar -->
      <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col md:flex-row items-center justify-between gap-3">
        <div class="flex flex-wrap items-center gap-2.5 w-full md:w-auto">
          <div class="relative w-full sm:w-64">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
              <i class="fa-solid fa-magnifying-glass text-xs"></i>
            </span>
            <input
              v-model="search"
              type="text"
              placeholder="Cari judul artikel..."
              class="w-full pl-9 pr-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>

          <select
            v-model="category"
            class="py-2 px-3 rounded-xl border border-slate-200 text-xs text-slate-700 focus:outline-none focus:border-[#DE0171]"
          >
            <option value="">Semua Kategori</option>
            <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
          </select>
        </div>

        <div class="flex items-center gap-2 w-full sm:w-auto shrink-0">
          <Link
            :href="route('admin.posts.generator')"
            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-purple-50 hover:bg-purple-100 text-purple-700 border border-purple-200 text-xs font-bold transition justify-center flex-1 sm:flex-none shadow-xs"
          >
            <i class="fa-solid fa-wand-magic-sparkles text-xs text-purple-600"></i>
            <span>Generate Otomatis</span>
          </Link>

          <Link
            :href="route('admin.posts.create')"
            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white text-xs font-bold shadow-md shadow-[#DE0171]/25 hover:opacity-95 transition justify-center flex-1 sm:flex-none"
          >
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Tulis Artikel Baru</span>
          </Link>
        </div>
      </div>

      <!-- Bulk Action Bar -->
      <div
        v-if="selectedIds.length > 0"
        class="p-3.5 bg-pink-50 border border-pink-200 rounded-2xl flex items-center justify-between shadow-xs animate-in fade-in"
      >
        <div class="flex items-center gap-2 text-xs font-bold text-[#DE0171]">
          <i class="fa-solid fa-check-double text-sm"></i>
          <span>{{ selectedIds.length }} artikel dipilih</span>
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

      <!-- Table -->
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
                <th class="py-3.5 px-4 w-12 text-center">Cover</th>
                <th class="py-3.5 px-4">Judul Artikel</th>
                <th class="py-3.5 px-4">Kategori</th>
                <th class="py-3.5 px-4">Penulis</th>
                <th class="py-3.5 px-4 text-center">Unggulan</th>
                <th class="py-3.5 px-4 text-center">Status</th>
                <th class="py-3.5 px-4">Tanggal</th>
                <th class="py-3.5 px-4 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              <tr v-for="item in posts.data" :key="item.id" class="hover:bg-slate-50/70 transition" :class="{ 'bg-pink-50/40': selectedIds.includes(item.id) }">
                <td class="py-3 px-4 text-center">
                  <input
                    type="checkbox"
                    :value="item.id"
                    v-model="selectedIds"
                    class="w-4 h-4 rounded text-[#DE0171] focus:ring-[#DE0171] border-slate-300"
                  />
                </td>
                <td class="py-3 px-4 text-center">
                  <div class="w-12 h-12 rounded-xl bg-slate-100 overflow-hidden mx-auto border border-slate-200">
                    <img :src="item.cover_image_url" :alt="item.title" class="w-full h-full object-cover" />
                  </div>
                </td>

                <td class="py-3 px-4">
                  <div class="font-bold text-slate-900 text-sm hover:text-[#DE0171] transition">
                    <Link :href="route('admin.posts.edit', item.id)">{{ item.title }}</Link>
                  </div>
                  <div class="text-[11px] text-slate-400 mt-0.5">/artikel/{{ item.slug }}</div>
                </td>

                <td class="py-3 px-4">
                  <span class="px-2.5 py-1 rounded-lg bg-pink-50 text-[#DE0171] font-semibold text-[11px]">
                    {{ item.category_name }}
                  </span>
                </td>

                <td class="py-3 px-4 text-slate-600 font-medium">
                  {{ item.author_name }}
                </td>

                <td class="py-3 px-4 text-center">
                  <button
                    @click="toggleField(item, 'is_featured')"
                    :class="item.is_featured ? 'text-amber-500 bg-amber-50' : 'text-slate-300 hover:text-amber-400'"
                    class="p-1.5 rounded-lg text-sm transition"
                  >
                    <i class="fa-solid fa-star"></i>
                  </button>
                </td>

                <td class="py-3 px-4 text-center">
                  <button
                    @click="toggleField(item, 'is_published')"
                    :class="[
                      item.is_scheduled ? 'bg-purple-100 text-purple-800 border border-purple-200' :
                      item.is_published ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600',
                      'px-2.5 py-1 rounded-full text-[10px] font-bold transition hover:opacity-80 inline-flex items-center gap-1'
                    ]"
                  >
                    <i v-if="item.is_scheduled" class="fa-solid fa-clock text-[9px]"></i>
                    {{ item.is_scheduled ? 'Terjadwal' : (item.is_published ? 'Publik' : 'Draft') }}
                  </button>
                </td>

                <td class="py-3 px-4 text-slate-500 text-[11px]">
                  {{ item.published_at }}
                </td>

                <td class="py-3 px-4 text-right">
                  <div class="inline-flex items-center gap-1.5">
                    <a
                      :href="`/artikel/${item.slug}`"
                      target="_blank"
                      title="Lihat di Web"
                      class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-100"
                    >
                      <i class="fa-solid fa-eye text-xs"></i>
                    </a>
                    <Link
                      :href="route('admin.posts.edit', item.id)"
                      title="Edit Artikel"
                      class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:text-[#DE0171] hover:bg-pink-50"
                    >
                      <i class="fa-solid fa-pen-to-square text-xs"></i>
                    </Link>
                    <button
                      type="button"
                      @click="deletePost(item)"
                      title="Hapus Artikel"
                      class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:bg-rose-50"
                    >
                      <i class="fa-solid fa-trash-can text-xs"></i>
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <Pagination :data="posts" label="artikel" />
      </div>
    </div>
  </AdminLayout>
</template>
