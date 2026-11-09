<script setup>
import { ref, computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { route } from '@/routes';

const props = defineProps({
  categories: Array,
  galleryImagesCount: {
    type: Number,
    default: 0,
  },
});

const form = useForm({
  titles_raw: '',
  category_id: '',
  category_name: '',
  start_date: new Date(Date.now() + 86400000).toISOString().split('T')[0], // Besok
  interval_days: 1, // 1 hari sekali
  status: 'published',
  feature_first: false,
  images: [],
});

const imagePreviews = ref([]);

// Deteksi jumlah judul
const detectedTitles = computed(() => {
  return form.titles_raw
    .split(/\r?\n/)
    .map((t) => t.trim())
    .filter((t) => t.length > 0);
});

// Hitung rentang jadwal rilis
const scheduleRange = computed(() => {
  const count = detectedTitles.value.length;
  if (count === 0 || !form.start_date) return null;

  const start = new Date(form.start_date + 'T09:00:00');
  const interval = parseInt(form.interval_days) || 0;

  if (interval === 0 || count === 1) {
    return {
      start: formatDate(start),
      end: formatDate(start),
      text: `Semua ${count} artikel akan terbit serentak pada ${formatDate(start)}.`,
    };
  }

  const end = new Date(start);
  end.setDate(end.getDate() + (count - 1) * interval);

  return {
    start: formatDate(start),
    end: formatDate(end),
    text: `${count} artikel akan dirilis berkala mulai ${formatDate(start)} hingga ${formatDate(end)} (tiap ${interval} hari sekali).`,
  };
});

const formatDate = (date) => {
  return date.toLocaleDateString('id-ID', {
    day: 'numeric',
    month: 'short',
    year: 'numeric',
  });
};

// Handle Multi-file Upload
const handleFilesSelect = (event) => {
  const files = Array.from(event.target.files || []);
  if (!files.length) return;

  for (const file of files) {
    form.images.push(file);
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreviews.value.push({
        name: file.name,
        size: (file.size / 1024).toFixed(0) + ' KB',
        url: e.target.result,
      });
    };
    reader.readAsDataURL(file);
  }
};

const removeImage = (index) => {
  form.images.splice(index, 1);
  imagePreviews.value.splice(index, 1);
};

// Preset Contoh Judul
const presets = {
  bahari: [
    '10 Spot Snorkeling Terbaik di Pulau Pahawang yang Wajib Masuk Bucket List',
    'Sensasi Berlayar Melihat Kawanan Lumba-Lumba Bebas di Teluk Kiluan',
    'Panduan Menjelajahi Tebing Karang Eksotis Pantai Gigi Hiu Lampung',
    'Tips Memilih Paket Open Trip Pulau Pahawang Murah & Terpercaya',
    'Eksplorasi Keindahan Pasir Timbul Pulau Kelagian & Pulau Balak',
  ],
  tips: [
    '7 Persiapan Penting Sebelum Ikut One Day Tour Pahawang Bareng Keluarga',
    'Panduan Rute & Transportasi dari Jakarta ke Bandar Lampung Tanpa Ribet',
    'Tips Berburu Foto Underwater Instagramable saat Snorkeling di Lampung',
    'Estimasi Biaya Liburan Akhir Pekan 2 Hari 1 Malam ke Lampung',
    'Etika Berwisata Bahari untuk Menjaga Kelestarian Terumbu Karang',
  ],
  kuliner: [
    'Daftar Kuliner Khas Lampung yang Menggugah Selera dan Wajib Dicicipi',
    'Sensasi Kenikmatan Makan Seruit Khas Lampung Bersama Rombongan',
    'Rekomendasi Pusat Oleh-Oleh Keripik Pisang Aneka Rasa Terkenal di Lampung',
    'Menikmati Kopi Robusta Asli Lampung dengan Aroma Khas yang Memikat',
    'Spot Wisata Kuliner Malam Hits di Kota Bandar Lampung',
  ],
};

const appendPreset = (key) => {
  const titles = presets[key] || [];
  const existing = form.titles_raw.trim();
  const added = titles.join('\n');
  form.titles_raw = existing ? `${existing}\n${added}` : added;
};

const clearTitles = () => {
  if (confirm('Kosongkan daftar judul?')) {
    form.titles_raw = '';
  }
};

const submitForm = () => {
  form.post(route('admin.posts.generate'), {
    forceFormData: true,
    preserveScroll: true,
  });
};
</script>

<template>
  <AdminLayout title="Generator Artikel Otomatis">
    <Head title="Generator Artikel Otomatis - Nirwana Tour" />

    <div class="space-y-6 max-w-5xl mx-auto">
      <!-- Breadcrumb & Header -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <div class="flex items-center gap-2 text-xs text-slate-500 mb-1">
            <Link :href="route('admin.posts.index')" class="hover:text-[#DE0171] transition flex items-center gap-1">
              <i class="fa-solid fa-arrow-left text-[10px]"></i>
              <span>Kembali ke Kelola Artikel</span>
            </Link>
            <span>/</span>
            <span class="text-slate-800 font-semibold">Generator Otomatis</span>
          </div>
          <h1 class="text-2xl font-extrabold text-slate-900 flex items-center gap-2.5">
            <span class="w-9 h-9 rounded-xl bg-gradient-to-tr from-[#DE0171] to-[#FC028B] text-white flex items-center justify-center text-sm shadow-md">
              <i class="fa-solid fa-wand-magic-sparkles"></i>
            </span>
            <span>Generator Artikel Otomatis</span>
          </h1>
          <p class="text-xs text-slate-500 mt-1">
            Generate banyak artikel sekaligus dengan struktur SEO lengkap, penjadwalan otomatis, dan pengacakan gambar cover.
          </p>
        </div>

        <Link
          :href="route('admin.posts.index')"
          class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-semibold shadow-xs transition"
        >
          <i class="fa-solid fa-list text-xs text-slate-400"></i>
          <span>Lihat Semua Artikel</span>
        </Link>
      </div>

      <form @submit.prevent="submitForm" class="space-y-6">
        <!-- Section 1: Daftar Judul Artikel -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs p-6 space-y-4">
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 border-b border-slate-100 pb-3">
            <div>
              <h2 class="text-sm font-extrabold text-slate-900 flex items-center gap-2">
                <span class="w-6 h-6 rounded-lg bg-pink-50 text-[#DE0171] flex items-center justify-center text-xs font-bold">1</span>
                <span>Daftar Judul Artikel (Satu Judul per Baris)</span>
                <span class="text-rose-500">*</span>
              </h2>
              <p class="text-[11px] text-slate-500 mt-0.5">
                Ketik atau tempel beberapa judul artikel. Setiap baris baru akan diproses menjadi 1 artikel terpisah.
              </p>
            </div>

            <div class="flex items-center gap-2">
              <span
                :class="[
                  detectedTitles.length > 0 ? 'bg-pink-50 text-[#DE0171] border-pink-200' : 'bg-slate-100 text-slate-500 border-slate-200',
                  'px-3 py-1 rounded-full text-xs font-bold border'
                ]"
              >
                {{ detectedTitles.length }} artikel terdeteksi
              </span>
              <button
                v-if="detectedTitles.length > 0"
                type="button"
                @click="clearTitles"
                class="text-xs text-slate-400 hover:text-rose-600 transition"
                title="Hapus semua"
              >
                <i class="fa-solid fa-trash-can text-xs"></i>
              </button>
            </div>
          </div>

          <!-- Preset Ide Judul Cepat -->
          <div class="flex flex-wrap items-center gap-1.5 text-xs">
            <span class="text-slate-400 text-[11px] font-medium mr-1">+ Tambah Preset Judul:</span>
            <button
              type="button"
              @click="appendPreset('bahari')"
              class="px-2.5 py-1 rounded-lg bg-slate-50 hover:bg-pink-50 text-slate-600 hover:text-[#DE0171] border border-slate-200 hover:border-pink-200 text-[11px] font-medium transition"
            >
              🌊 5 Wisata Bahari
            </button>
            <button
              type="button"
              @click="appendPreset('tips')"
              class="px-2.5 py-1 rounded-lg bg-slate-50 hover:bg-pink-50 text-slate-600 hover:text-[#DE0171] border border-slate-200 hover:border-pink-200 text-[11px] font-medium transition"
            >
              💡 5 Tips & Panduan
            </button>
            <button
              type="button"
              @click="appendPreset('kuliner')"
              class="px-2.5 py-1 rounded-lg bg-slate-50 hover:bg-pink-50 text-slate-600 hover:text-[#DE0171] border border-slate-200 hover:border-pink-200 text-[11px] font-medium transition"
            >
              🍲 5 Kuliner & Oleh-Oleh
            </button>
          </div>

          <div>
            <textarea
              v-model="form.titles_raw"
              rows="7"
              class="w-full px-4 py-3 rounded-2xl border border-slate-200 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#DE0171]/20 focus:border-[#DE0171] transition font-mono leading-relaxed"
              placeholder="Contoh:&#10;10 Tempat Snorkeling Terbaik di Pulau Pahawang Lampung&#10;Panduan Lengkap Wisata Melihat Lumba-Lumba di Teluk Kiluan&#10;Eksplorasi Keajaiban Gunung Anak Krakatau Bersama Nirwana Tour&#10;Rekomendasi Oleh-Oleh Khas Lampung yang Wajib Dibeli"
              required
            ></textarea>
            <p v-if="form.errors.titles_raw" class="text-[11px] text-rose-500 mt-1 font-medium">
              {{ form.errors.titles_raw }}
            </p>
          </div>
        </div>

        <!-- Section 2: Upload Koleksi Foto (Random Image Pool) -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs p-6 space-y-4">
          <div class="border-b border-slate-100 pb-3">
            <h2 class="text-sm font-extrabold text-slate-900 flex items-center gap-2">
              <span class="w-6 h-6 rounded-lg bg-pink-50 text-[#DE0171] flex items-center justify-center text-xs font-bold">2</span>
              <span>Koleksi Foto Cover (Acak Otomatis)</span>
            </h2>
            <p class="text-[11px] text-slate-500 mt-0.5">
              Unggah beberapa foto sekaligus. Sistem akan mengacak foto-foto ini ke setiap artikel yang dibuat.
            </p>
          </div>

          <!-- Upload Dropzone -->
          <div class="relative border-2 border-dashed border-slate-200 hover:border-[#DE0171]/60 rounded-2xl p-6 text-center transition bg-slate-50/50 hover:bg-pink-50/20">
            <input
              type="file"
              multiple
              accept="image/png,image/jpeg,image/webp"
              @change="handleFilesSelect"
              class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
            />
            <div class="space-y-2 pointer-events-none">
              <div class="w-12 h-12 rounded-2xl bg-white border border-slate-200 text-[#DE0171] flex items-center justify-center mx-auto shadow-xs text-lg">
                <i class="fa-solid fa-cloud-arrow-up"></i>
              </div>
              <div class="text-xs font-bold text-slate-800">
                Klik atau seret beberapa foto ke sini
              </div>
              <div class="text-[11px] text-slate-400">
                Mendukung JPG, PNG, atau WebP (bisa pilih banyak file sekaligus)
              </div>
            </div>
          </div>

          <!-- Info Fallback Galeri -->
          <div class="p-3.5 bg-sky-50/80 border border-sky-100 rounded-2xl flex items-start gap-3 text-xs text-sky-800">
            <i class="fa-solid fa-circle-info text-sky-500 mt-0.5"></i>
            <div class="space-y-0.5 text-[11px] leading-relaxed">
              <p class="font-bold">Sistem Pool & Fallback Cerdas:</p>
              <p class="text-sky-700">
                Jika jumlah artikel lebih banyak daripada foto yang diunggah (atau jika Anda tidak mengunggah foto tambahan), sistem akan otomatis memadukannya secara acak dengan <strong>{{ galleryImagesCount }} foto galeri wisata</strong> dan aset destinasi yang tersedia di sistem.
              </p>
            </div>
          </div>

          <!-- Preview Grid Foto Terpilih -->
          <div v-if="imagePreviews.length > 0" class="space-y-2 pt-2">
            <div class="flex items-center justify-between text-xs text-slate-600 font-semibold">
              <span>{{ imagePreviews.length }} foto baru siap diacak:</span>
              <button
                type="button"
                @click="form.images = []; imagePreviews = [];"
                class="text-rose-500 hover:text-rose-700 text-[11px] font-medium"
              >
                Hapus Semua Foto
              </button>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3">
              <div
                v-for="(img, idx) in imagePreviews"
                :key="idx"
                class="relative group rounded-xl overflow-hidden border border-slate-200 aspect-video bg-slate-100 shadow-2xs"
              >
                <img :src="img.url" class="w-full h-full object-cover" />
                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-1.5 p-1">
                  <button
                    type="button"
                    @click="removeImage(idx)"
                    class="w-6 h-6 rounded-md bg-rose-600 text-white flex items-center justify-center text-[10px] hover:bg-rose-700 transition"
                    title="Hapus foto ini"
                  >
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </div>
                <div class="absolute bottom-0 inset-x-0 bg-slate-900/70 text-white text-[9px] px-1.5 py-0.5 truncate">
                  {{ img.name }}
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Section 3: Pengaturan Penjadwalan & Kategori -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs p-6 space-y-5">
          <div class="border-b border-slate-100 pb-3">
            <h2 class="text-sm font-extrabold text-slate-900 flex items-center gap-2">
              <span class="w-6 h-6 rounded-lg bg-pink-50 text-[#DE0171] flex items-center justify-center text-xs font-bold">3</span>
              <span>Pengaturan Penjadwalan & Metadata</span>
            </h2>
            <p class="text-[11px] text-slate-500 mt-0.5">
              Atur waktu tayang berkala agar konten terbit secara konsisten untuk mendongkrak SEO website.
            </p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- Tanggal Mulai -->
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1.5">
                Tanggal Mulai Terbit *
              </label>
              <input
                v-model="form.start_date"
                type="date"
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#DE0171]/20 focus:border-[#DE0171] transition"
                required
              />
              <p class="text-[10px] text-slate-400 mt-1">Tanggal artikel pertama mulai tayang</p>
            </div>

            <!-- Interval Penjadwalan -->
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1.5">
                Interval Penjadwalan (Drip Feed) *
              </label>
              <select
                v-model="form.interval_days"
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#DE0171]/20 focus:border-[#DE0171] transition bg-white"
              >
                <option :value="1">Setiap 1 Hari Sekali (Rekomendasi SEO)</option>
                <option :value="2">Setiap 2 Hari Sekali</option>
                <option :value="3">Setiap 3 Hari Sekali</option>
                <option :value="7">Setiap 1 Minggu Sekali (7 Hari)</option>
                <option :value="0">Terbit Serentak Sekarang (Interval 0 Hari)</option>
              </select>
              <p class="text-[10px] text-slate-400 mt-1">Jarak waktu antar publikasi artikel</p>
            </div>

            <!-- Kategori -->
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1.5">
                Kategori Utama
              </label>
              <select
                v-model="form.category_id"
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#DE0171]/20 focus:border-[#DE0171] transition bg-white"
              >
                <option value="">Otomatis Sesuai Kata Kunci Judul</option>
                <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                  {{ cat.name }}
                </option>
              </select>
              <p class="text-[10px] text-slate-400 mt-1">Bisa otomatis mendeteksi topik artikel</p>
            </div>
          </div>

          <!-- Status & Opsi Unggulan -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
            <div class="p-3.5 bg-slate-50 border border-slate-200/80 rounded-2xl flex items-center justify-between">
              <div>
                <div class="text-xs font-bold text-slate-800">Status Artikel</div>
                <div class="text-[11px] text-slate-500">Tayang sesuai jadwal atau simpan draft</div>
              </div>
              <div class="flex items-center gap-2">
                <label class="inline-flex items-center gap-1.5 text-xs text-slate-700 cursor-pointer">
                  <input
                    type="radio"
                    v-model="form.status"
                    value="published"
                    class="text-[#DE0171] focus:ring-[#DE0171]"
                  />
                  <span class="font-bold text-[#DE0171]">Terjadwal</span>
                </label>
                <label class="inline-flex items-center gap-1.5 text-xs text-slate-700 cursor-pointer ml-2">
                  <input
                    type="radio"
                    v-model="form.status"
                    value="draft"
                    class="text-[#DE0171] focus:ring-[#DE0171]"
                  />
                  <span>Draft</span>
                </label>
              </div>
            </div>

            <div class="p-3.5 bg-slate-50 border border-slate-200/80 rounded-2xl flex items-center justify-between">
              <div>
                <div class="text-xs font-bold text-slate-800">Artikel Pertama Unggulan</div>
                <div class="text-[11px] text-slate-500">Tampilkan artikel ke-1 di beranda</div>
              </div>
              <label class="relative inline-flex items-center cursor-pointer">
                <input
                  type="checkbox"
                  v-model="form.feature_first"
                  class="sr-only peer"
                />
                <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#DE0171]"></div>
              </label>
            </div>
          </div>

          <!-- Live Schedule Preview Card -->
          <div v-if="scheduleRange" class="p-4 bg-gradient-to-r from-pink-50 to-purple-50 border border-pink-200 rounded-2xl flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-white text-[#DE0171] flex items-center justify-center shrink-0 shadow-xs text-sm">
              <i class="fa-solid fa-calendar-days"></i>
            </div>
            <div class="text-xs text-slate-800">
              <p class="font-bold text-[#DE0171]">Simulasi Jadwal Penayangan:</p>
              <p class="text-slate-600 mt-0.5">{{ scheduleRange.text }}</p>
            </div>
          </div>
        </div>

        <!-- Submit Action Bar -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 p-4 bg-white rounded-3xl border border-slate-200/80 shadow-xs">
          <div class="text-xs text-slate-500">
            <span v-if="detectedTitles.length > 0">
              Siap memproses <strong class="text-slate-900 font-bold">{{ detectedTitles.length }} artikel</strong> dengan format SEO lengkap dan CTA WhatsApp Nirwana.
            </span>
            <span v-else class="text-amber-600 font-medium">
              Silakan masukkan minimal 1 judul artikel pada kotak teks di atas.
            </span>
          </div>

          <div class="flex items-center gap-3 w-full sm:w-auto">
            <Link
              :href="route('admin.posts.index')"
              class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition w-full sm:w-auto text-center"
            >
              Batal
            </Link>

            <button
              type="submit"
              :disabled="form.processing || detectedTitles.length === 0"
              class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] hover:opacity-95 text-white text-xs font-extrabold shadow-md hover:shadow-lg transition disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <i v-if="form.processing" class="fa-solid fa-spinner fa-spin text-xs"></i>
              <i v-else class="fa-solid fa-wand-magic-sparkles text-xs"></i>
              <span>
                {{ form.processing ? 'Sedang Memproses Artikel...' : `Generate ${detectedTitles.length > 0 ? detectedTitles.length : ''} Artikel Sekarang` }}
              </span>
            </button>
          </div>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>
