<script setup>
import { ref, watch } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { route } from '@/routes';

const props = defineProps({
  services: Object,
  filters: Object,
});

const search = ref(props.filters.search);

let searchTimer = null;
watch(search, (val) => {
  clearTimeout(searchTimer);
  searchTimer = setTimeout(() => {
    router.get(route('admin.services.index'), { search: val }, { preserveState: true, replace: true });
  }, 300);
});

const deleteService = (item) => {
  if (confirm(`Hapus layanan "${item.title}"?`)) {
    router.delete(route('admin.services.destroy', item.id));
  }
};

const toggleService = (item) => {
  router.post(route('admin.services.toggle', item.id), {}, { preserveScroll: true });
};
</script>

<template>
  <Head title="Manajemen Layanan Perjalanan" />

  <AdminLayout>
    <template #header-title>
      <div class="flex items-center gap-2">
        <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">Manajemen Layanan</h1>
        <span class="text-xs px-2.5 py-0.5 rounded-full bg-slate-200 text-slate-700 font-bold">
          {{ services.total }} Layanan
        </span>
      </div>
    </template>

    <div class="space-y-5">
      <!-- Toolbar -->
      <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="relative w-full sm:w-64">
          <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
            <i class="fa-solid fa-magnifying-glass text-xs"></i>
          </span>
          <input
            v-model="search"
            type="text"
            placeholder="Cari nama layanan..."
            class="w-full pl-9 pr-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
          />
        </div>

        <Link
          :href="route('admin.services.create')"
          class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white text-xs font-bold shadow-md shadow-[#DE0171]/25 hover:opacity-95 transition shrink-0 w-full sm:w-auto justify-center"
        >
          <i class="fa-solid fa-plus text-xs"></i>
          <span>Tambah Layanan Baru</span>
        </Link>
      </div>

      <!-- Services Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        <div
          v-for="item in services.data"
          :key="item.id"
          class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden flex flex-col justify-between hover:shadow-md transition"
        >
          <div class="relative h-44 bg-slate-100 overflow-hidden">
            <img :src="item.image_url" :alt="item.title" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
            <div class="absolute top-3 left-3">
              <div class="w-9 h-9 rounded-xl bg-white/90 backdrop-blur-sm text-[#DE0171] flex items-center justify-center text-sm shadow">
                <i :class="item.icon"></i>
              </div>
            </div>
            <div class="absolute bottom-3 left-3 right-3 text-white">
              <h3 class="font-extrabold text-base leading-tight">{{ item.title }}</h3>
            </div>
          </div>

          <div class="p-4 flex-1 flex flex-col justify-between space-y-3">
            <p class="text-xs text-slate-600 line-clamp-2">
              {{ item.summary || 'Tidak ada deskripsi singkat.' }}
            </p>

            <div class="flex items-center justify-between pt-3 border-t border-slate-100 text-xs">
              <button
                @click="toggleService(item)"
                :class="[
                  item.is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600',
                  'px-2.5 py-1 rounded-full text-[10px] font-bold transition hover:opacity-80'
                ]"
              >
                {{ item.is_active ? 'Aktif' : 'Draft' }}
              </button>

              <div class="flex items-center gap-1.5">
                <a
                  :href="`/layanan/${item.slug}`"
                  target="_blank"
                  title="Lihat di Web"
                  class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-100"
                >
                  <i class="fa-solid fa-eye text-xs"></i>
                </a>
                <Link
                  :href="route('admin.services.edit', item.id)"
                  title="Edit Layanan"
                  class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:text-[#DE0171] hover:bg-pink-50"
                >
                  <i class="fa-solid fa-pen-to-square text-xs"></i>
                </Link>
                <button
                  type="button"
                  @click="deleteService(item)"
                  title="Hapus Layanan"
                  class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:bg-rose-50"
                >
                  <i class="fa-solid fa-trash-can text-xs"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Pagination -->
      <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <Pagination :data="services" label="layanan wisata" />
      </div>
    </div>
  </AdminLayout>
</template>
