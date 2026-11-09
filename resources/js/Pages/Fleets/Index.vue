<script setup>
import { ref } from 'vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { route } from '@/routes';

const props = defineProps({
  fleets: Array,
});

const isModalOpen = ref(false);
const editingFleet = ref(null);

const form = useForm({
  name: '',
  type: 'Big Bus Pariwisata',
  capacity: '48-50 Seat',
  facilities: [],
  order: 0,
  is_active: true,
  image: null,
});

const imagePreview = ref(null);
const newFacility = ref('');

const addFacility = () => {
  if (newFacility.value.trim()) {
    form.facilities.push(newFacility.value.trim());
    newFacility.value = '';
  }
};
const removeFacility = (idx) => form.facilities.splice(idx, 1);

const openAddModal = () => {
  editingFleet.value = null;
  form.reset();
  form.facilities = ['AC Dingin', 'Reclining Seat', 'Audio & Karaoke', 'USB Charger'];
  form.is_active = true;
  imagePreview.value = null;
  isModalOpen.value = true;
};

const openEditModal = (f) => {
  editingFleet.value = f;
  form.name = f.name;
  form.type = f.type;
  form.capacity = f.capacity;
  form.facilities = Array.isArray(f.facilities) ? [...f.facilities] : [];
  form.order = f.order;
  form.is_active = f.is_active;
  form.image = null;
  imagePreview.value = f.image_url;
  isModalOpen.value = true;
};

const handleImageChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    form.image = file;
    imagePreview.value = URL.createObjectURL(file);
  }
};

const submit = () => {
  if (editingFleet.value) {
    form.transform((data) => ({ ...data, _method: 'PUT' }))
      .post(route('admin.fleets.update', editingFleet.value.id), {
        onSuccess: () => { isModalOpen.value = false; },
      });
  } else {
    form.post(route('admin.fleets.store'), {
      onSuccess: () => { isModalOpen.value = false; },
    });
  }
};

const deleteFleet = (f) => {
  if (confirm(`Hapus armada "${f.name}"?`)) {
    router.delete(route('admin.fleets.destroy', f.id));
  }
};
</script>

<template>
  <Head title="Manajemen Armada Transportasi" />

  <AdminLayout>
    <template #header-title>
      <div class="flex items-center gap-2">
        <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">Armada Transportasi</h1>
        <span class="text-xs px-2.5 py-0.5 rounded-full bg-slate-200 text-slate-700 font-bold">
          {{ fleets.length }} Unit
        </span>
      </div>
    </template>

    <div class="space-y-5">
      <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between gap-3">
        <p class="text-xs text-slate-500">
          Daftar bus pariwisata, medium bus, dan HiAce yang siap melayani rombongan perjalanan wisata di Lampung & Jawa.
        </p>

        <button
          type="button"
          @click="openAddModal"
          class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white text-xs font-bold shadow-md shadow-[#DE0171]/25 hover:opacity-95 transition shrink-0"
        >
          <i class="fa-solid fa-plus text-xs"></i>
          <span>Tambah Armada Baru</span>
        </button>
      </div>

      <!-- Fleets Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        <div
          v-for="f in fleets"
          :key="f.id"
          class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden flex flex-col justify-between hover:shadow-md transition"
        >
          <div class="relative h-44 bg-slate-100 overflow-hidden">
            <img :src="f.image_url" :alt="f.name" class="w-full h-full object-cover" />
            <div class="absolute top-3 left-3">
              <span class="px-2.5 py-1 rounded-lg bg-slate-900/80 text-white font-bold text-xs backdrop-blur-sm">
                {{ f.type }}
              </span>
            </div>
            <div class="absolute bottom-3 right-3">
              <span class="px-2.5 py-1 rounded-lg bg-[#DE0171] text-white font-bold text-xs shadow">
                {{ f.capacity }}
              </span>
            </div>
          </div>

          <div class="p-4 flex-1 flex flex-col justify-between space-y-3">
            <div>
              <h3 class="font-bold text-slate-900 text-sm">{{ f.name }}</h3>
              <div class="flex flex-wrap gap-1.5 mt-2">
                <span
                  v-for="(fac, idx) in f.facilities"
                  :key="idx"
                  class="text-[10px] px-2 py-0.5 rounded bg-slate-100 text-slate-600 font-medium"
                >
                  {{ fac }}
                </span>
              </div>
            </div>

            <div class="flex items-center justify-between pt-3 border-t border-slate-100 text-xs">
              <span
                :class="f.is_active ? 'text-emerald-700 bg-emerald-50' : 'text-slate-600 bg-slate-100'"
                class="px-2 py-0.5 rounded text-[10px] font-bold"
              >
                {{ f.is_active ? 'Siap Operasi' : 'Nonaktif' }}
              </span>

              <div class="flex items-center gap-1.5">
                <button
                  type="button"
                  @click="openEditModal(f)"
                  class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:text-[#DE0171] hover:bg-pink-50"
                  title="Edit"
                >
                  <i class="fa-solid fa-pen-to-square text-xs"></i>
                </button>
                <button
                  type="button"
                  @click="deleteFleet(f)"
                  class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:bg-rose-50"
                  title="Hapus"
                >
                  <i class="fa-solid fa-trash-can text-xs"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Form -->
    <div
      v-if="isModalOpen"
      class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-xs"
      role="dialog"
    >
      <div class="bg-white rounded-2xl w-full max-w-lg p-6 shadow-2xl border border-slate-100 space-y-4">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
          <h3 class="font-extrabold text-slate-900 text-sm">
            {{ editingFleet ? 'Edit Armada' : 'Tambah Unit Armada Baru' }}
          </h3>
          <button @click="isModalOpen = false" class="text-slate-400 hover:text-slate-700">
            <i class="fa-solid fa-xmark text-sm"></i>
          </button>
        </div>

        <form @submit.prevent="submit" class="space-y-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Armada <span class="text-rose-500">*</span></label>
            <input
              v-model="form.name"
              type="text"
              required
              placeholder="Contoh: Big Bus Jetbus 5 HDD Luxury"
              class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>

          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Tipe Kendaraan</label>
              <input
                v-model="form.type"
                type="text"
                placeholder="Big Bus / Medium / HiAce"
                class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
              />
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Kapasitas Kursi</label>
              <input
                v-model="form.capacity"
                type="text"
                placeholder="Contoh: 50 Seat"
                class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
              />
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Foto Bus</label>
            <div class="flex items-center gap-3">
              <div class="w-16 h-12 rounded-xl bg-slate-50 border border-slate-200 overflow-hidden flex items-center justify-center shrink-0">
                <img v-if="imagePreview" :src="imagePreview" class="w-full h-full object-cover" />
                <i v-else class="fa-solid fa-bus text-slate-300"></i>
              </div>
              <input
                type="file"
                accept="image/*"
                @change="handleImageChange"
                class="block w-full text-xs text-slate-500 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-pink-50 file:text-[#DE0171] file:font-bold"
              />
            </div>
          </div>

          <!-- Fasilitas -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Fasilitas Bus</label>
            <div class="flex items-center gap-2">
              <input
                v-model="newFacility"
                @keydown.enter.prevent="addFacility"
                type="text"
                placeholder="Ketik fasilitas lalu tekan Enter / Tambah"
                class="flex-1 px-3 py-1.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
              />
              <button type="button" @click="addFacility" class="px-3 py-1.5 bg-[#DE0171] text-white rounded-xl text-xs font-bold">
                +
              </button>
            </div>
            <div class="flex flex-wrap gap-1.5 mt-2">
              <span
                v-for="(fac, idx) in form.facilities"
                :key="idx"
                class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 text-[11px]"
              >
                <span>{{ fac }}</span>
                <button type="button" @click="removeFacility(idx)" class="text-slate-400 hover:text-rose-500">
                  <i class="fa-solid fa-xmark text-[10px]"></i>
                </button>
              </span>
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
              {{ editingFleet ? 'Simpan' : 'Tambah Armada' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>
