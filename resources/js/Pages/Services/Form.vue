<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { route } from '@/routes';

const props = defineProps({
  service: Object,
});

const isEditing = Boolean(props.service);

const form = useForm({
  title: props.service?.title ?? '',
  slug: props.service?.slug ?? '',
  icon: props.service?.icon ?? 'fa-solid fa-bus-simple',
  summary: props.service?.summary ?? '',
  description: props.service?.description ?? '',
  features: Array.isArray(props.service?.features) ? props.service.features : [],
  is_active: props.service?.is_active ?? true,
  order: props.service?.order ?? 0,
  image: null,
});

const imagePreview = ref(props.service?.image_url ?? null);

const handleImageChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    form.image = file;
    imagePreview.value = URL.createObjectURL(file);
  }
};

const newFeature = ref('');
const addFeature = () => {
  if (newFeature.value.trim()) {
    form.features.push(newFeature.value.trim());
    newFeature.value = '';
  }
};
const removeFeature = (idx) => form.features.splice(idx, 1);

const submit = () => {
  if (isEditing) {
    form.transform((data) => ({ ...data, _method: 'PUT' }))
      .post(route('admin.services.update', props.service.id));
  } else {
    form.post(route('admin.services.store'));
  }
};
</script>

<template>
  <Head :title="isEditing ? `Edit: ${form.title}` : 'Tambah Layanan'" />

  <AdminLayout>
    <template #header-title>
      <div class="flex items-center gap-2">
        <Link :href="route('admin.services.index')" class="text-slate-400 hover:text-slate-700">
          <i class="fa-solid fa-arrow-left text-xs"></i>
        </Link>
        <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">
          {{ isEditing ? 'Edit Layanan' : 'Tambah Layanan Perjalanan Baru' }}
        </h1>
      </div>
    </template>

    <form @submit.prevent="submit" class="space-y-6 max-w-4xl">
      <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="md:col-span-2">
            <label class="block text-xs font-bold text-slate-700 mb-1">
              Nama Layanan <span class="text-rose-500">*</span>
            </label>
            <input
              v-model="form.title"
              type="text"
              required
              placeholder="Contoh: Sewa Bus Pariwisata Lampung"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Ikon FontAwesome</label>
            <input
              v-model="form.icon"
              type="text"
              placeholder="fa-solid fa-bus-simple"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Urutan Tampil</label>
            <input
              v-model.number="form.order"
              type="number"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Ringkasan Layanan</label>
          <textarea
            v-model="form.summary"
            rows="2"
            placeholder="Jelaskan ringkasan layanan dalam 1-2 kalimat..."
            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
          ></textarea>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Lengkap</label>
          <textarea
            v-model="form.description"
            rows="5"
            placeholder="Rincian lengkap fasilitas armada, jangkauan rute, driver profesional, dsb..."
            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
          ></textarea>
        </div>
      </div>

      <!-- Foto Cover -->
      <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Foto Sampul Layanan</h3>
        <div class="flex flex-col sm:flex-row items-center gap-6">
          <div class="w-36 h-28 rounded-2xl bg-slate-100 border-2 border-dashed border-slate-300 overflow-hidden flex items-center justify-center shrink-0">
            <img v-if="imagePreview" :src="imagePreview" alt="Preview" class="w-full h-full object-cover" />
            <div v-else class="text-center text-slate-400 p-2 text-xs">Belum ada foto</div>
          </div>
          <div class="space-y-2 flex-1">
            <input
              type="file"
              accept="image/*"
              @change="handleImageChange"
              class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-pink-50 file:text-[#DE0171]"
            />
            <p class="text-[11px] text-slate-400">JPG, PNG, atau WEBP. Maksimal 3MB.</p>
          </div>
        </div>
      </div>

      <!-- Keunggulan / Poin Fitur -->
      <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-3">
        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Poin Keunggulan Layanan</h3>
        <div class="flex items-center gap-2">
          <input
            v-model="newFeature"
            @keydown.enter.prevent="addFeature"
            type="text"
            placeholder="Contoh: AC Dingin & Audio Karaoke Nyaman"
            class="flex-1 px-3.5 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
          />
          <button type="button" @click="addFeature" class="px-4 py-2 rounded-xl bg-[#DE0171] text-white text-xs font-bold">
            + Tambah
          </button>
        </div>
        <ul class="space-y-1.5 pt-2">
          <li
            v-for="(feat, idx) in form.features"
            :key="idx"
            class="flex items-center justify-between p-2 rounded-lg bg-slate-50 text-slate-800 text-xs"
          >
            <span><i class="fa-solid fa-check text-emerald-500 mr-2"></i>{{ feat }}</span>
            <button type="button" @click="removeFeature(idx)" class="text-slate-400 hover:text-rose-500">
              <i class="fa-solid fa-xmark text-xs"></i>
            </button>
          </li>
        </ul>
      </div>

      <!-- Action Footer -->
      <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
        <label class="flex items-center gap-2.5 cursor-pointer text-xs font-bold text-slate-800 select-none">
          <input type="checkbox" v-model="form.is_active" class="rounded text-[#DE0171] focus:ring-[#DE0171]" />
          <span>Status Aktif (Tampil di Website)</span>
        </label>

        <div class="flex items-center gap-3">
          <Link :href="route('admin.services.index')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-700">
            Batal
          </Link>
          <button
            type="submit"
            :disabled="form.processing"
            class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white text-xs font-bold shadow-md shadow-[#DE0171]/25 hover:opacity-95"
          >
            {{ isEditing ? 'Simpan Perubahan' : 'Terbitkan Layanan' }}
          </button>
        </div>
      </div>
    </form>
  </AdminLayout>
</template>
