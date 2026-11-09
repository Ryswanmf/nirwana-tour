<script setup>
import { ref } from 'vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import RichTextToolbar from '@/Components/RichTextToolbar.vue';
import { route } from '@/routes';

const props = defineProps({
  package: Object,
  categories: Array,
});

const isEditing = Boolean(props.package);

const form = useForm({
  title: props.package?.title ?? '',
  slug: props.package?.slug ?? '',
  category_id: props.package?.category_id ?? '',
  badge: props.package?.badge ?? '',
  destination_location: props.package?.destination_location ?? '',
  price_from: props.package?.price_from ?? 0,
  duration_days: props.package?.duration_days ?? 1,
  duration_nights: props.package?.duration_nights ?? 0,
  min_pax: props.package?.min_pax ?? 1,
  summary: props.package?.summary ?? '',
  description: props.package?.description ?? '',
  thumbnail: null,
  is_featured: props.package?.is_featured ?? false,
  is_active: props.package?.is_active ?? true,
  order: props.package?.order ?? 0,
  itinerary: Array.isArray(props.package?.itinerary) ? props.package.itinerary : [],
  includes: Array.isArray(props.package?.includes) ? props.package.includes : [],
  excludes: Array.isArray(props.package?.excludes) ? props.package.excludes : [],
  faqs: Array.isArray(props.package?.faqs) ? props.package.faqs : [],
});

const thumbnailPreview = ref(props.package?.thumbnail_url ?? null);

const handleThumbnailChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    form.thumbnail = file;
    thumbnailPreview.value = URL.createObjectURL(file);
  }
};

// Itinerary helpers
const addItineraryDay = () => {
  form.itinerary.push({
    day: form.itinerary.length + 1,
    title: '',
    description: '',
  });
};
const removeItineraryDay = (index) => {
  form.itinerary.splice(index, 1);
};

// Includes / Excludes helpers
const newInclude = ref('');
const addInclude = () => {
  if (newInclude.value.trim()) {
    form.includes.push(newInclude.value.trim());
    newInclude.value = '';
  }
};
const removeInclude = (idx) => form.includes.splice(idx, 1);

const newExclude = ref('');
const addExclude = () => {
  if (newExclude.value.trim()) {
    form.excludes.push(newExclude.value.trim());
    newExclude.value = '';
  }
};
const removeExclude = (idx) => form.excludes.splice(idx, 1);

// FAQs helpers
const addFaq = () => {
  form.faqs.push({ question: '', answer: '' });
};
const removeFaq = (idx) => form.faqs.splice(idx, 1);

const submit = () => {
  if (isEditing) {
    // Gunakan POST dengan _method: PUT untuk menangani multipart/form-data upload file
    form.transform((data) => ({
      ...data,
      _method: 'PUT',
    })).post(route('admin.packages.update', props.package.id));
  } else {
    form.post(route('admin.packages.store'));
  }
};
</script>

<template>
  <Head :title="isEditing ? `Edit: ${form.title}` : 'Tambah Paket Wisata'" />

  <AdminLayout>
    <template #header-title>
      <div class="flex items-center gap-2">
        <Link :href="route('admin.packages.index')" class="text-slate-400 hover:text-slate-700">
          <i class="fa-solid fa-arrow-left text-xs"></i>
        </Link>
        <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">
          {{ isEditing ? 'Edit Paket Wisata' : 'Tambah Paket Wisata Baru' }}
        </h1>
      </div>
    </template>

    <form @submit.prevent="submit" class="space-y-6 max-w-5xl">
      <!-- Section 1: Informasi Utama -->
      <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
        <h2 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2 border-b border-slate-100 pb-3">
          <i class="fa-solid fa-circle-info text-[#DE0171]"></i>
          <span>Informasi Dasar Paket</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <!-- Title -->
          <div class="md:col-span-2">
            <label class="block text-xs font-bold text-slate-700 mb-1">
              Nama Paket Wisata <span class="text-rose-500">*</span>
            </label>
            <input
              v-model="form.title"
              type="text"
              required
              placeholder="Contoh: Paket Wisata Pulau Pahawang Snorkeling 2D1N"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171] focus:ring-1 focus:ring-[#DE0171]"
            />
            <span v-if="form.errors.title" class="text-xs text-rose-500 mt-1">{{ form.errors.title }}</span>
          </div>

          <!-- Kategori -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Kategori Destinasi</label>
            <select
              v-model="form.category_id"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
            >
              <option value="">Pilih Kategori</option>
              <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
            </select>
          </div>

          <!-- Badge -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Badge / Tag Promosi</label>
            <input
              v-model="form.badge"
              type="text"
              placeholder="Contoh: Best Seller, Favorit Keluarga, Populer"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>

          <!-- Lokasi Destinasi -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Lokasi / Wilayah Destinasi</label>
            <input
              v-model="form.destination_location"
              type="text"
              placeholder="Contoh: Pesawaran, Lampung"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>

          <!-- Harga Mulai -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">
              Harga Mulai Dari (Rp) <span class="text-rose-500">*</span>
            </label>
            <input
              v-model.number="form.price_from"
              type="number"
              min="0"
              required
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
            <span v-if="form.errors.price_from" class="text-xs text-rose-500 mt-1">{{ form.errors.price_from }}</span>
          </div>

          <!-- Durasi Hari & Malam -->
          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Durasi Hari</label>
              <input
                v-model.number="form.duration_days"
                type="number"
                min="1"
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
              />
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Durasi Malam</label>
              <input
                v-model.number="form.duration_nights"
                type="number"
                min="0"
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
              />
            </div>
          </div>

          <!-- Min Pax & Urutan -->
          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Minimal Peserta (Pax)</label>
              <input
                v-model.number="form.min_pax"
                type="number"
                min="1"
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
              />
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Urutan Tampil</label>
              <input
                v-model.number="form.order"
                type="number"
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
              />
            </div>
          </div>
        </div>

        <!-- Ringkasan Singkat -->
        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Ringkasan Singkat (Summary)</label>
          <textarea
            v-model="form.summary"
            rows="2"
            placeholder="Jelaskan daya tarik utama paket ini dalam 1-2 kalimat..."
            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
          ></textarea>
        </div>

        <!-- Deskripsi Lengkap -->
        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Lengkap / Overview</label>
          <RichTextToolbar textarea-id="package_description" />
          <textarea
            id="package_description"
            v-model="form.description"
            rows="6"
            placeholder="Tuliskan gambaran umum perjalanan, keunikan destinasi, dsb..."
            class="w-full px-3.5 py-2.5 rounded-b-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171] font-mono leading-relaxed"
          ></textarea>
        </div>
      </div>

      <!-- Section 2: Foto Thumbnail -->
      <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
        <h2 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2 border-b border-slate-100 pb-3">
          <i class="fa-solid fa-image text-[#DE0171]"></i>
          <span>Foto Utama (Thumbnail)</span>
        </h2>

        <div class="flex flex-col sm:flex-row items-center gap-6">
          <div class="w-36 h-28 rounded-2xl bg-slate-100 border-2 border-dashed border-slate-300 overflow-hidden flex items-center justify-center shrink-0">
            <img v-if="thumbnailPreview" :src="thumbnailPreview" alt="Preview" class="w-full h-full object-cover" />
            <div v-else class="text-center text-slate-400 p-2">
              <i class="fa-solid fa-cloud-arrow-up text-xl mb-1"></i>
              <div class="text-[10px]">Belum ada foto</div>
            </div>
          </div>

          <div class="space-y-2 flex-1">
            <input
              type="file"
              accept="image/*"
              @change="handleThumbnailChange"
              class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-pink-50 file:text-[#DE0171] hover:file:bg-pink-100 cursor-pointer"
            />
            <p class="text-[11px] text-slate-400">
              Format JPG, PNG, atau WEBP. Maksimal ukuran 3MB. Disarankan rasio 16:9 atau 4:3.
            </p>
            <span v-if="form.errors.thumbnail" class="text-xs text-rose-500 block">{{ form.errors.thumbnail }}</span>
          </div>
        </div>
      </div>

      <!-- Section 3: Jadwal Perjalanan (Itinerary) -->
      <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
          <h2 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2">
            <i class="fa-solid fa-calendar-days text-[#DE0171]"></i>
            <span>Itinerary / Rencana Perjalanan</span>
          </h2>
          <button
            type="button"
            @click="addItineraryDay"
            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-pink-50 text-[#DE0171] hover:bg-pink-100 text-xs font-bold transition"
          >
            <i class="fa-solid fa-plus text-[10px]"></i>
            <span>Tambah Hari</span>
          </button>
        </div>

        <div v-if="form.itinerary.length > 0" class="space-y-3">
          <div
            v-for="(day, idx) in form.itinerary"
            :key="idx"
            class="p-4 rounded-xl border border-slate-200 bg-slate-50/50 space-y-2 relative"
          >
            <div class="flex items-center justify-between">
              <span class="text-xs font-bold text-slate-700">Hari ke-{{ idx + 1 }}</span>
              <button
                type="button"
                @click="removeItineraryDay(idx)"
                class="text-xs text-rose-500 hover:underline"
              >
                Hapus
              </button>
            </div>
            <input
              v-model="day.title"
              type="text"
              placeholder="Judul / Destinasi Hari Ini (Contoh: Penjemputan & Wisata Snorkeling)"
              class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs bg-white text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
            <textarea
              v-model="day.description"
              rows="2"
              placeholder="Rincian aktivitas jam ke jam..."
              class="w-full px-3 py-2 rounded-lg border border-slate-200 text-xs bg-white text-slate-900 focus:outline-none focus:border-[#DE0171]"
            ></textarea>
          </div>
        </div>
        <div v-else class="text-center py-6 text-slate-400 text-xs">
          Belum ada jadwal perjalanan. Klik tombol "+ Tambah Hari" di atas.
        </div>
      </div>

      <!-- Section 4: Fasilitas Termasuk & Tidak Termasuk -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Fasilitas Termasuk -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-3">
          <h2 class="text-sm font-extrabold text-emerald-800 uppercase tracking-wider flex items-center gap-2 border-b border-slate-100 pb-3">
            <i class="fa-solid fa-circle-check text-emerald-500"></i>
            <span>Fasilitas Termasuk (Include)</span>
          </h2>
          <div class="flex items-center gap-2">
            <input
              v-model="newInclude"
              @keydown.enter.prevent="addInclude"
              type="text"
              placeholder="Contoh: Tiket Kapal Penyeberangan"
              class="flex-1 px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-emerald-500"
            />
            <button
              type="button"
              @click="addInclude"
              class="px-3 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold"
            >
              +
            </button>
          </div>
          <ul class="space-y-1.5 pt-2">
            <li
              v-for="(inc, idx) in form.includes"
              :key="idx"
              class="flex items-center justify-between p-2 rounded-lg bg-emerald-50 text-emerald-900 text-xs font-medium"
            >
              <span>{{ inc }}</span>
              <button type="button" @click="removeInclude(idx)" class="text-emerald-700 hover:text-rose-500">
                <i class="fa-solid fa-xmark text-xs"></i>
              </button>
            </li>
          </ul>
        </div>

        <!-- Fasilitas Tidak Termasuk -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-3">
          <h2 class="text-sm font-extrabold text-rose-800 uppercase tracking-wider flex items-center gap-2 border-b border-slate-100 pb-3">
            <i class="fa-solid fa-circle-xmark text-rose-500"></i>
            <span>Tidak Termasuk (Exclude)</span>
          </h2>
          <div class="flex items-center gap-2">
            <input
              v-model="newExclude"
              @keydown.enter.prevent="addExclude"
              type="text"
              placeholder="Contoh: Pengeluaran Pribadi & Tips Driver"
              class="flex-1 px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-rose-500"
            />
            <button
              type="button"
              @click="addExclude"
              class="px-3 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold"
            >
              +
            </button>
          </div>
          <ul class="space-y-1.5 pt-2">
            <li
              v-for="(exc, idx) in form.excludes"
              :key="idx"
              class="flex items-center justify-between p-2 rounded-lg bg-rose-50 text-rose-900 text-xs font-medium"
            >
              <span>{{ exc }}</span>
              <button type="button" @click="removeExclude(idx)" class="text-rose-700 hover:text-rose-900">
                <i class="fa-solid fa-xmark text-xs"></i>
              </button>
            </li>
          </ul>
        </div>
      </div>

      <!-- Section 5: Status Publikasi -->
      <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center gap-6">
          <label class="flex items-center gap-2.5 cursor-pointer text-xs font-bold text-slate-800 select-none">
            <input
              type="checkbox"
              v-model="form.is_active"
              class="w-4 h-4 rounded text-[#DE0171] focus:ring-[#DE0171]"
            />
            <span>Publikasikan Paket Ini (Aktif)</span>
          </label>

          <label class="flex items-center gap-2.5 cursor-pointer text-xs font-bold text-slate-800 select-none">
            <input
              type="checkbox"
              v-model="form.is_featured"
              class="w-4 h-4 rounded text-amber-500 focus:ring-amber-500"
            />
            <span>Tampilkan Sebagai Paket Unggulan (Beranda)</span>
          </label>
        </div>

        <div class="flex items-center gap-3">
          <Link
            :href="route('admin.packages.index')"
            class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-bold transition"
          >
            Batal
          </Link>
          <button
            type="submit"
            :disabled="form.processing"
            class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white text-xs font-bold shadow-md shadow-[#DE0171]/25 hover:opacity-95 transition disabled:opacity-50 flex items-center gap-2"
          >
            <i v-if="form.processing" class="fa-solid fa-circle-notch fa-spin text-xs"></i>
            <span>{{ isEditing ? 'Simpan Perubahan' : 'Terbitkan Paket' }}</span>
          </button>
        </div>
      </div>
    </form>
  </AdminLayout>
</template>
