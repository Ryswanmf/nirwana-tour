<script setup>
import { ref } from 'vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { route } from '@/routes';

const props = defineProps({
  partners: Array,
});

const isModalOpen = ref(false);
const editingPartner = ref(null);

const form = useForm({
  name: '',
  category: 'Instansi / Perusahaan',
  order: 0,
  is_active: true,
  logo: null,
});

const logoPreview = ref(null);

const openAddModal = () => {
  editingPartner.value = null;
  form.reset();
  form.is_active = true;
  logoPreview.value = null;
  isModalOpen.value = true;
};

const openEditModal = (p) => {
  editingPartner.value = p;
  form.name = p.name;
  form.category = p.category;
  form.order = p.order;
  form.is_active = p.is_active;
  form.logo = null;
  logoPreview.value = p.logo_url;
  isModalOpen.value = true;
};

const handleLogoChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    form.logo = file;
    logoPreview.value = URL.createObjectURL(file);
  }
};

const submit = () => {
  if (editingPartner.value) {
    form.transform((data) => ({ ...data, _method: 'PUT' }))
      .post(route('admin.partners.update', editingPartner.value.id), {
        onSuccess: () => { isModalOpen.value = false; },
      });
  } else {
    form.post(route('admin.partners.store'), {
      onSuccess: () => { isModalOpen.value = false; },
    });
  }
};

const deletePartner = (p) => {
  if (confirm(`Hapus mitra "${p.name}"?`)) {
    router.delete(route('admin.partners.destroy', p.id));
  }
};
</script>

<template>
  <Head title="Manajemen Mitra & Klien Rekanan" />

  <AdminLayout>
    <template #header-title>
      <div class="flex items-center gap-2">
        <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">Mitra & Instansi Rekanan</h1>
        <span class="text-xs px-2.5 py-0.5 rounded-full bg-slate-200 text-slate-700 font-bold">
          {{ partners.length }} Mitra
        </span>
      </div>
    </template>

    <div class="space-y-5">
      <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between gap-3">
        <p class="text-xs text-slate-500">
          Logo mitra akan otomatis muncul di running marquee pada beranda utama (*Dipercaya Berbagai Instansi & Perusahaan*).
        </p>

        <button
          type="button"
          @click="openAddModal"
          class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white text-xs font-bold shadow-md shadow-[#DE0171]/25 hover:opacity-95 transition shrink-0"
        >
          <i class="fa-solid fa-plus text-xs"></i>
          <span>Tambah Mitra Baru</span>
        </button>
      </div>

      <!-- Partners Grid -->
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        <div
          v-for="p in partners"
          :key="p.id"
          class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-xs flex flex-col items-center justify-between text-center group hover:shadow-md transition"
        >
          <div class="w-16 h-16 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center p-2 mb-3">
            <img v-if="p.logo_url" :src="p.logo_url" :alt="p.name" class="max-h-full max-w-full object-contain" />
            <div v-else class="text-xs font-black text-[#DE0171] uppercase">
              {{ p.name.substring(0, 2) }}
            </div>
          </div>

          <div class="min-w-0 w-full mb-3">
            <div class="font-bold text-slate-900 text-xs truncate" :title="p.name">{{ p.name }}</div>
            <div class="text-[10px] text-slate-400 truncate">{{ p.category }}</div>
          </div>

          <div class="flex items-center gap-2 pt-2 border-t border-slate-100 w-full justify-center">
            <button
              type="button"
              @click="openEditModal(p)"
              class="w-6 h-6 rounded flex items-center justify-center text-slate-400 hover:text-[#DE0171] hover:bg-pink-50"
              title="Edit"
            >
              <i class="fa-solid fa-pen-to-square text-[11px]"></i>
            </button>
            <button
              type="button"
              @click="deletePartner(p)"
              class="w-6 h-6 rounded flex items-center justify-center text-slate-400 hover:text-rose-600 hover:bg-rose-50"
              title="Hapus"
            >
              <i class="fa-solid fa-trash-can text-[11px]"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Form Tambah / Edit -->
    <div
      v-if="isModalOpen"
      class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-xs"
      role="dialog"
    >
      <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl border border-slate-100 space-y-4">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
          <h3 class="font-extrabold text-slate-900 text-sm">
            {{ editingPartner ? 'Edit Data Mitra' : 'Tambah Mitra Rekanan Baru' }}
          </h3>
          <button @click="isModalOpen = false" class="text-slate-400 hover:text-slate-700">
            <i class="fa-solid fa-xmark text-sm"></i>
          </button>
        </div>

        <form @submit.prevent="submit" class="space-y-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Mitra / Instansi <span class="text-rose-500">*</span></label>
            <input
              v-model="form.name"
              type="text"
              required
              placeholder="Contoh: PT Semen Baturaja Tbk"
              class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Kategori Mitra</label>
            <input
              v-model="form.category"
              type="text"
              placeholder="Contoh: BUMN / Instansi Pemerintah / Kampus"
              class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Logo Mitra (PNG Transparan)</label>
            <div class="flex items-center gap-3">
              <div class="w-14 h-14 rounded-xl bg-slate-50 border border-slate-200 overflow-hidden flex items-center justify-center p-1 shrink-0">
                <img v-if="logoPreview" :src="logoPreview" class="max-h-full max-w-full object-contain" />
                <i v-else class="fa-solid fa-building text-slate-300"></i>
              </div>
              <input
                type="file"
                accept="image/*"
                @change="handleLogoChange"
                class="block w-full text-xs text-slate-500 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-pink-50 file:text-[#DE0171] file:font-bold"
              />
            </div>
          </div>

          <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
            <button
              type="button"
              @click="isModalOpen = false"
              class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-700"
            >
              Batal
            </button>
            <button
              type="submit"
              :disabled="form.processing"
              class="px-5 py-2 rounded-xl bg-[#DE0171] text-white text-xs font-bold hover:opacity-90"
            >
              {{ editingPartner ? 'Simpan' : 'Tambah' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>
