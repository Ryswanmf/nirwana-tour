<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { route } from '@/routes';

const props = defineProps({
  item: Object,
  categories: Array,
});

const isEditing = Boolean(props.item);

const form = useForm({
  title: props.item?.title ?? '',
  category_id: props.item?.category_id ?? '',
  media_type: props.item?.media_type ?? 'image',
  video_url: props.item?.video_url ?? '',
  caption: props.item?.caption ?? '',
  order: props.item?.order ?? 0,
  is_featured: props.item?.is_featured ?? false,
  file: null,
  thumbnail: null,
});

const filePreview = ref(props.item?.preview_url ?? null);
const thumbPreview = ref(props.item?.thumb_preview ?? null);
const selectedFileName = ref('');

const handleFileChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    form.file = file;
    selectedFileName.value = file.name;
    if (form.media_type === 'image') {
      filePreview.value = URL.createObjectURL(file);
    } else {
      filePreview.value = URL.createObjectURL(file);
    }
  }
};

const handleThumbChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    form.thumbnail = file;
    thumbPreview.value = URL.createObjectURL(file);
  }
};

const submit = () => {
  if (isEditing) {
    form.transform((data) => ({ ...data, _method: 'PUT' }))
      .post(route('admin.gallery.update', props.item.id));
  } else {
    form.post(route('admin.gallery.store'));
  }
};
</script>

<template>
  <Head :title="isEditing ? `Edit: ${form.title}` : 'Upload Media Galeri'" />

  <AdminLayout>
    <template #header-title>
      <div class="flex items-center gap-2">
        <Link :href="route('admin.gallery.index')" class="text-slate-400 hover:text-slate-700">
          <i class="fa-solid fa-arrow-left text-xs"></i>
        </Link>
        <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">
          {{ isEditing ? 'Edit Media Galeri' : 'Upload Media Galeri Baru' }}
        </h1>
      </div>
    </template>

    <form @submit.prevent="submit" class="space-y-6 max-w-3xl">
      <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">
            Judul / Keterangan Dokumentasi <span class="text-rose-500">*</span>
          </label>
          <input
            v-model="form.title"
            type="text"
            required
            placeholder="Contoh: Keseruan Tour Siswa di Pulau Pahawang"
            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
          />
          <p v-if="form.errors.title" class="text-rose-500 text-xs font-bold mt-1">{{ form.errors.title }}</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Kategori Dokumentasi</label>
            <select
              v-model="form.category_id"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
            >
              <option value="">Pilih Kategori</option>
              <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
            </select>
            <p v-if="form.errors.category_id" class="text-rose-500 text-xs font-bold mt-1">{{ form.errors.category_id }}</p>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Format Media</label>
            <select
              v-model="form.media_type"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
            >
              <option value="image">Foto (Gambar)</option>
              <option value="video">Upload Video File (.MP4 / WebM)</option>
              <option value="reel">Instagram Reels / Tautan Eksternal</option>
            </select>
          </div>
        </div>

        <!-- File Upload (Video MP4) -->
        <div v-if="form.media_type === 'video'" class="space-y-3 pt-2">
          <label class="block text-xs font-bold text-slate-700">
            File Video (.mp4, .webm, .mov) <span class="text-rose-500">*</span>
          </label>
          <div class="p-4 rounded-xl border border-slate-200 bg-slate-50 space-y-3">
            <div class="flex items-center gap-4">
              <div class="w-32 h-20 rounded-xl bg-slate-200 overflow-hidden shrink-0 flex items-center justify-center">
                <video v-if="filePreview" :src="filePreview" class="w-full h-full object-cover" muted></video>
                <i v-else class="fa-solid fa-video text-slate-400 text-xl"></i>
              </div>
              <div class="space-y-1">
                <input
                  type="file"
                  accept="video/mp4,video/webm,video/quicktime,video/*"
                  @change="handleFileChange"
                  class="block w-full text-xs text-slate-500 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-pink-50 file:text-[#DE0171] file:font-bold cursor-pointer"
                />
                <p class="text-[11px] text-slate-400">Format yang didukung: MP4, WebM, MOV (Maksimal 100 MB).</p>
                <p v-if="selectedFileName" class="text-xs font-bold text-slate-700">File dipilih: {{ selectedFileName }}</p>
              </div>
            </div>
            <p v-if="form.errors.file" class="text-rose-500 text-xs font-bold">{{ form.errors.file }}</p>
          </div>

          <!-- Opsi Tambahan Tautan Video / Fallback -->
          <div class="pt-1">
            <label class="block text-[11px] font-bold text-slate-500 mb-1">
              Atau Gunakan Tautan URL Video Langsung (Opsional jika tidak upload file):
            </label>
            <input
              v-model="form.video_url"
              type="url"
              placeholder="https://... (URL video langsung)"
              class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-700 focus:outline-none focus:border-[#DE0171]"
            />
          </div>
        </div>

        <!-- Video / Reels URL -->
        <div v-if="form.media_type === 'reel'" class="space-y-1 pt-2">
          <label class="block text-xs font-bold text-slate-700 mb-1">
            Tautan / URL Reels Instagram <span class="text-rose-500">*</span>
          </label>
          <input
            v-model="form.video_url"
            type="url"
            required
            placeholder="https://www.instagram.com/reel/... atau https://www.instagram.com/p/..."
            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
          />
          <p v-if="form.errors.video_url" class="text-rose-500 text-xs font-bold">{{ form.errors.video_url }}</p>
        </div>

        <!-- File Upload (Image) -->
        <div v-if="form.media_type === 'image'" class="space-y-3 pt-2">
          <label class="block text-xs font-bold text-slate-700">File Foto</label>
          <div class="flex items-center gap-4">
            <div class="w-28 h-20 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden shrink-0 flex items-center justify-center">
              <img v-if="filePreview" :src="filePreview" class="w-full h-full object-cover" />
              <i v-else class="fa-solid fa-image text-slate-300"></i>
            </div>
            <input
              type="file"
              accept="image/*"
              @change="handleFileChange"
              class="block w-full text-xs text-slate-500 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-pink-50 file:text-[#DE0171] file:font-bold cursor-pointer"
            />
          </div>
          <p v-if="form.errors.file" class="text-rose-500 text-xs font-bold">{{ form.errors.file }}</p>
        </div>

        <!-- Thumbnail Upload (for Reels / Video) -->
        <div v-if="form.media_type !== 'image'" class="space-y-3 pt-2">
          <label class="block text-xs font-bold text-slate-700">Cover Thumbnail Video (Poster)</label>
          <div class="flex items-center gap-4">
            <div class="w-28 h-20 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden shrink-0 flex items-center justify-center">
              <img v-if="thumbPreview" :src="thumbPreview" class="w-full h-full object-cover" />
              <i v-else class="fa-solid fa-video text-slate-300"></i>
            </div>
            <div class="space-y-1">
              <input
                type="file"
                accept="image/*"
                @change="handleThumbChange"
                class="block w-full text-xs text-slate-500 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-pink-50 file:text-[#DE0171] file:font-bold cursor-pointer"
              />
              <p class="text-[11px] text-slate-400">Gambar yang tampil sebelum video diputar (JPG, PNG, WebP maks 5 MB).</p>
            </div>
          </div>
          <p v-if="form.errors.thumbnail" class="text-rose-500 text-xs font-bold">{{ form.errors.thumbnail }}</p>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Caption / Keterangan Singkat</label>
          <textarea
            v-model="form.caption"
            rows="2"
            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
          ></textarea>
          <p v-if="form.errors.caption" class="text-rose-500 text-xs font-bold">{{ form.errors.caption }}</p>
        </div>

        <!-- Upload Progress Indicator -->
        <div v-if="form.progress" class="p-3 bg-pink-50/70 rounded-xl border border-pink-100 space-y-1.5">
          <div class="flex justify-between text-xs font-bold text-[#DE0171]">
            <span>Sedang mengunggah media...</span>
            <span>{{ form.progress.percentage }}%</span>
          </div>
          <div class="w-full bg-pink-200/60 rounded-full h-2 overflow-hidden">
            <div
              class="bg-gradient-to-r from-[#DE0171] to-[#FC028B] h-full transition-all duration-200"
              :style="{ width: `${form.progress.percentage}%` }"
            ></div>
          </div>
        </div>
      </div>

      <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
        <label class="flex items-center gap-2.5 cursor-pointer text-xs font-bold text-slate-800 select-none">
          <input type="checkbox" v-model="form.is_featured" class="rounded text-amber-500 focus:ring-amber-500" />
          <span>Tampilkan di Beranda (Media Pilihan)</span>
        </label>

        <div class="flex items-center gap-3">
          <Link :href="route('admin.gallery.index')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-700">
            Batal
          </Link>
          <button
            type="submit"
            :disabled="form.processing"
            class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white text-xs font-bold shadow-md shadow-[#DE0171]/25 hover:opacity-95 disabled:opacity-50 flex items-center gap-2"
          >
            <i v-if="form.processing" class="fa-solid fa-spinner fa-spin text-xs"></i>
            <span>{{ isEditing ? 'Simpan Perubahan' : 'Upload Media' }}</span>
          </button>
        </div>
      </div>
    </form>
  </AdminLayout>
</template>
