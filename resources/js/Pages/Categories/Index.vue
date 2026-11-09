<script setup>
import { ref, computed } from 'vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { route } from '@/routes';

const props = defineProps({
  categories: Array,
  filters: Object,
});

const isModalOpen = ref(false);
const editingCategory = ref(null);
const activeTab = ref(props.filters.type || 'all');

const form = useForm({
  name: '',
  type: 'tour',
  description: '',
});

const typeOptions = [
  { value: 'tour', label: 'Paket Wisata', badgeColor: 'bg-emerald-50 text-emerald-700 border-emerald-200' },
  { value: 'article', label: 'Artikel & Tips', badgeColor: 'bg-sky-50 text-sky-700 border-sky-200' },
  { value: 'gallery', label: 'Galeri Media', badgeColor: 'bg-purple-50 text-purple-700 border-purple-200' },
];

const filteredCategories = computed(() => {
  if (activeTab.value === 'all') return props.categories;
  return props.categories.filter((c) => c.type === activeTab.value);
});

const openAddModal = () => {
  editingCategory.value = null;
  form.reset();
  form.type = activeTab.value !== 'all' ? activeTab.value : 'tour';
  isModalOpen.value = true;
};

const openEditModal = (c) => {
  editingCategory.value = c;
  form.name = c.name;
  form.type = c.type;
  form.description = c.description || '';
  isModalOpen.value = true;
};

const submit = () => {
  if (editingCategory.value) {
    form.transform((data) => ({ ...data, _method: 'PUT' }))
      .post(route('admin.categories.update', editingCategory.value.id), {
        onSuccess: () => { isModalOpen.value = false; },
      });
  } else {
    form.post(route('admin.categories.store'), {
      onSuccess: () => { isModalOpen.value = false; },
    });
  }
};

const deleteCategory = (c) => {
  const total = (c.tour_packages_count || 0) + (c.posts_count || 0) + (c.gallery_items_count || 0);
  if (total > 0) {
    alert(`Kategori "${c.name}" tidak dapat dihapus karena masih digunakan oleh ${total} data konten.`);
    return;
  }

  if (confirm(`Hapus kategori "${c.name}"?`)) {
    router.delete(route('admin.categories.destroy', c.id));
  }
};

const getTypeBadge = (type) => {
  const opt = typeOptions.find((t) => t.value === type);
  return opt ? opt.badgeColor : 'bg-slate-100 text-slate-700 border-slate-200';
};

const getTypeName = (type) => {
  const opt = typeOptions.find((t) => t.value === type);
  return opt ? opt.label : type;
};
</script>

<template>
  <Head title="Manajemen Kategori" />

  <AdminLayout>
    <template #header-title>
      <div class="flex items-center gap-2">
        <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">Kategori Konten & Paket</h1>
        <span class="text-xs px-2.5 py-0.5 rounded-full bg-slate-200 text-slate-700 font-bold">
          {{ categories.length }} Kategori
        </span>
      </div>
    </template>

    <div class="space-y-5">
      <!-- Toolbar & Filter Tabs -->
      <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <!-- Tabs -->
        <div class="flex items-center gap-1.5 p-1 bg-slate-100 rounded-xl overflow-x-auto max-w-full">
          <button
            type="button"
            @click="activeTab = 'all'"
            :class="[
              activeTab === 'all'
                ? 'bg-white text-slate-900 font-bold shadow-xs'
                : 'text-slate-600 hover:text-slate-900 font-medium',
              'px-3 py-1.5 rounded-lg text-xs transition'
            ]"
          >
            Semua ({{ categories.length }})
          </button>
          <button
            v-for="tab in typeOptions"
            :key="tab.value"
            type="button"
            @click="activeTab = tab.value"
            :class="[
              activeTab === tab.value
                ? 'bg-white text-slate-900 font-bold shadow-xs'
                : 'text-slate-600 hover:text-slate-900 font-medium',
              'px-3 py-1.5 rounded-lg text-xs transition'
            ]"
          >
            {{ tab.label }}
          </button>
        </div>

        <button
          type="button"
          @click="openAddModal"
          class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white text-xs font-bold shadow-md shadow-[#DE0171]/25 hover:opacity-95 transition shrink-0"
        >
          <i class="fa-solid fa-plus text-xs"></i>
          <span>Tambah Kategori</span>
        </button>
      </div>

      <!-- Categories Table / Cards -->
      <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="border-b border-slate-100 bg-slate-50/75 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                <th class="py-3 px-4">Nama Kategori</th>
                <th class="py-3 px-4">Slug URL</th>
                <th class="py-3 px-4">Tipe Modul</th>
                <th class="py-3 px-4">Deskripsi</th>
                <th class="py-3 px-4 text-center">Konten Terkait</th>
                <th class="py-3 px-4 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
              <tr
                v-for="cat in filteredCategories"
                :key="cat.id"
                class="hover:bg-slate-50/60 transition"
              >
                <td class="py-3 px-4 font-bold text-slate-900">
                  {{ cat.name }}
                </td>
                <td class="py-3 px-4 font-mono text-slate-500 text-[11px]">
                  {{ cat.slug }}
                </td>
                <td class="py-3 px-4">
                  <span
                    :class="[
                      getTypeBadge(cat.type),
                      'px-2.5 py-0.5 rounded-md text-[10px] font-extrabold border'
                    ]"
                  >
                    {{ getTypeName(cat.type) }}
                  </span>
                </td>
                <td class="py-3 px-4 max-w-xs truncate text-slate-500">
                  {{ cat.description || '-' }}
                </td>
                <td class="py-3 px-4 text-center">
                  <span v-if="cat.type === 'tour'" class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 font-bold text-[10px]">
                    {{ cat.tour_packages_count }} Paket
                  </span>
                  <span v-else-if="cat.type === 'article'" class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 font-bold text-[10px]">
                    {{ cat.posts_count }} Artikel
                  </span>
                  <span v-else class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 font-bold text-[10px]">
                    {{ cat.gallery_items_count }} Foto
                  </span>
                </td>
                <td class="py-3 px-4 text-right whitespace-nowrap">
                  <div class="inline-flex items-center gap-1.5">
                    <button
                      type="button"
                      @click="openEditModal(cat)"
                      class="p-1.5 px-2.5 rounded-lg text-xs font-bold bg-slate-100 text-slate-700 hover:bg-slate-200 transition"
                      title="Edit"
                    >
                      <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button
                      type="button"
                      @click="deleteCategory(cat)"
                      class="p-1.5 px-2.5 rounded-lg text-xs font-bold bg-rose-50 text-rose-600 hover:bg-rose-100 transition"
                      title="Hapus"
                    >
                      <i class="fa-solid fa-trash-can"></i>
                    </button>
                  </div>
                </td>
              </tr>

              <tr v-if="filteredCategories.length === 0">
                <td colspan="6" class="py-10 text-center text-slate-400">
                  <i class="fa-solid fa-folder-open text-2xl mb-2 block"></i>
                  <span>Tidak ada kategori dalam tab ini.</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal Form Tambah / Edit -->
    <div
      v-if="isModalOpen"
      class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs"
      @click.self="isModalOpen = false"
    >
      <div class="bg-white rounded-2xl border border-slate-200 shadow-2xl max-w-md w-full overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
          <h3 class="font-extrabold text-slate-900 text-sm">
            {{ editingCategory ? 'Edit Kategori' : 'Tambah Kategori Baru' }}
          </h3>
          <button @click="isModalOpen = false" class="text-slate-400 hover:text-slate-600">
            <i class="fa-solid fa-xmark text-base"></i>
          </button>
        </div>

        <form @submit.prevent="submit" class="p-6 space-y-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Kategori <span class="text-rose-500">*</span></label>
            <input
              v-model="form.name"
              type="text"
              required
              placeholder="Contoh: Wisata Bahari / Edukasi"
              class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Tipe Modul <span class="text-rose-500">*</span></label>
            <select
              v-model="form.type"
              class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            >
              <option v-for="t in typeOptions" :key="t.value" :value="t.value">{{ t.label }} ({{ t.value }})</option>
            </select>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Singkat</label>
            <textarea
              v-model="form.description"
              rows="2"
              placeholder="Deskripsi tema kategori ini..."
              class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            ></textarea>
          </div>

          <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2">
            <button
              type="button"
              @click="isModalOpen = false"
              class="px-4 py-2 rounded-xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50"
            >
              Batal
            </button>
            <button
              type="submit"
              :disabled="form.processing"
              class="px-5 py-2 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white text-xs font-bold shadow-md shadow-[#DE0171]/25 hover:opacity-95"
            >
              {{ editingCategory ? 'Simpan Perubahan' : 'Tambah Kategori' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>
