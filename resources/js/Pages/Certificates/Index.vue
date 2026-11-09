<script setup>
import { ref } from 'vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { route } from '@/routes';

const props = defineProps({
  certificates: Array,
});

const isModalOpen = ref(false);
const editingCertificate = ref(null);

const form = useForm({
  title: '',
  issuer: '',
  certificate_number: '',
  badge: 'Terverifikasi',
  icon: 'fa-solid fa-certificate',
  description: '',
  order: 0,
  is_active: true,
  image: null,
  file: null,
});

const imagePreview = ref(null);

const commonIcons = [
  { label: 'Sertifikat Standar', value: 'fa-solid fa-certificate' },
  { label: 'Kartu Izin / ID', value: 'fa-solid fa-id-card-clip' },
  { label: 'Kontrak / Dokumen', value: 'fa-solid fa-file-contract' },
  { label: 'Lisensi Guide', value: 'fa-solid fa-users-gear' },
  { label: 'Izin Bus / Dishub', value: 'fa-solid fa-bus' },
  { label: 'Asuransi', value: 'fa-solid fa-shield-virus' },
  { label: 'Pajak / NPWP', value: 'fa-solid fa-file-invoice-dollar' },
  { label: 'Piala / Penghargaan', value: 'fa-solid fa-award' },
];

const openAddModal = () => {
  editingCertificate.value = null;
  form.reset();
  form.badge = 'Terverifikasi';
  form.icon = 'fa-solid fa-certificate';
  form.is_active = true;
  imagePreview.value = null;
  isModalOpen.value = true;
};

const openEditModal = (c) => {
  editingCertificate.value = c;
  form.title = c.title;
  form.issuer = c.issuer || '';
  form.certificate_number = c.certificate_number || '';
  form.badge = c.badge || '';
  form.icon = c.icon || 'fa-solid fa-certificate';
  form.description = c.description || '';
  form.order = c.order;
  form.is_active = c.is_active;
  form.image = null;
  form.file = null;
  imagePreview.value = c.image_url;
  isModalOpen.value = true;
};

const handleImageChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    form.image = file;
    imagePreview.value = URL.createObjectURL(file);
  }
};

const handleFileChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    form.file = file;
  }
};

const submit = () => {
  if (editingCertificate.value) {
    form.transform((data) => ({ ...data, _method: 'PUT' }))
      .post(route('admin.certificates.update', editingCertificate.value.id), {
        onSuccess: () => { isModalOpen.value = false; },
      });
  } else {
    form.post(route('admin.certificates.store'), {
      onSuccess: () => { isModalOpen.value = false; },
    });
  }
};

const deleteCertificate = (c) => {
  if (confirm(`Hapus dokumen "${c.title}"?`)) {
    router.delete(route('admin.certificates.destroy', c.id));
  }
};

const toggleActive = (c) => {
  router.post(route('admin.certificates.toggle', c.id));
};
</script>

<template>
  <Head title="Legalitas & Sertifikasi Usaha" />

  <AdminLayout>
    <template #header-title>
      <div class="flex items-center gap-2">
        <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">Legalitas Resmi & Sertifikasi Usaha</h1>
        <span class="text-xs px-2.5 py-0.5 rounded-full bg-slate-200 text-slate-700 font-bold">
          {{ certificates.length }} Dokumen
        </span>
      </div>
    </template>

    <div class="space-y-5">
      <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
        <p class="text-xs text-slate-500">
          Dokumen legalitas, izin OSS BKPM, TDUP, lisensi pemandu HPI, dan asuransi yang tampil di halaman publik <strong>/sertifikasi</strong>.
        </p>

        <button
          type="button"
          @click="openAddModal"
          class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white text-xs font-bold shadow-md shadow-[#DE0171]/25 hover:opacity-95 transition shrink-0"
        >
          <i class="fa-solid fa-plus text-xs"></i>
          <span>Tambah Dokumen Baru</span>
        </button>
      </div>

      <!-- Certificates Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div
          v-for="cert in certificates"
          :key="cert.id"
          class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden flex flex-col transition hover:shadow-md"
        >
          <!-- Optional Image banner -->
          <div v-if="cert.image_url" class="h-36 bg-slate-100 overflow-hidden relative border-b border-slate-100">
            <img :src="cert.image_url" :alt="cert.title" class="w-full h-full object-cover" />
            <span
              :class="[
                cert.is_active ? 'bg-emerald-500 text-white' : 'bg-slate-500 text-white',
                'absolute top-2.5 right-2.5 text-[10px] font-bold px-2 py-0.5 rounded-full shadow-xs'
              ]"
            >
              {{ cert.is_active ? 'Aktif' : 'Nonaktif' }}
            </span>
          </div>

          <div class="p-5 flex-1 flex flex-col justify-between">
            <div>
              <div class="flex items-start justify-between gap-2 mb-2">
                <div class="flex items-center gap-2.5">
                  <div class="w-8 h-8 rounded-lg bg-[#DE0171]/10 text-[#DE0171] flex items-center justify-center shrink-0 text-sm">
                    <i :class="cert.icon"></i>
                  </div>
                  <div>
                    <h3 class="font-bold text-slate-900 text-sm leading-snug">{{ cert.title }}</h3>
                    <span v-if="cert.issuer" class="text-[11px] text-slate-500 block">{{ cert.issuer }}</span>
                  </div>
                </div>
                <span
                  v-if="!cert.image_url"
                  :class="[
                    cert.is_active ? 'bg-emerald-500 text-white' : 'bg-slate-500 text-white',
                    'text-[10px] font-bold px-2 py-0.5 rounded-full shrink-0'
                  ]"
                >
                  {{ cert.is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
              </div>

              <!-- Meta badges -->
              <div class="flex flex-wrap items-center gap-1.5 my-2">
                <span v-if="cert.badge" class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-emerald-200/60">
                  <i class="fa-solid fa-circle-check text-[9px] mr-1"></i>{{ cert.badge }}
                </span>
                <span v-if="cert.certificate_number" class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 font-mono text-[10px]">
                  # {{ cert.certificate_number }}
                </span>
              </div>

              <p class="text-xs text-slate-600 line-clamp-3 mt-2 leading-relaxed">
                {{ cert.description }}
              </p>

              <!-- File attachment if available -->
              <div v-if="cert.file_url" class="mt-3 pt-2.5 border-t border-slate-100">
                <a
                  :href="cert.file_url"
                  target="_blank"
                  class="inline-flex items-center gap-1.5 text-xs font-bold text-[#DE0171] hover:underline"
                >
                  <i class="fa-solid fa-file-pdf text-rose-500"></i>
                  <span>Lihat / Unduh Dokumen</span>
                </a>
              </div>
            </div>

            <!-- Card Actions -->
            <div class="flex items-center gap-2 pt-4 mt-3 border-t border-slate-100">
              <button
                type="button"
                @click="toggleActive(cert)"
                class="flex-1 py-1.5 px-2 rounded-lg text-[11px] font-bold border border-slate-200 text-slate-700 hover:bg-slate-50 transition"
              >
                <i :class="['fa-solid mr-1', cert.is_active ? 'fa-eye-slash text-slate-400' : 'fa-eye text-emerald-600']"></i>
                {{ cert.is_active ? 'Sembunyikan' : 'Tampilkan' }}
              </button>
              <button
                type="button"
                @click="openEditModal(cert)"
                class="p-1.5 px-2.5 rounded-lg text-xs font-bold bg-slate-100 text-slate-700 hover:bg-slate-200 transition"
                title="Edit"
              >
                <i class="fa-solid fa-pen-to-square"></i>
              </button>
              <button
                type="button"
                @click="deleteCertificate(cert)"
                class="p-1.5 px-2.5 rounded-lg text-xs font-bold bg-rose-50 text-rose-600 hover:bg-rose-100 transition"
                title="Hapus"
              >
                <i class="fa-solid fa-trash-can"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Empty state -->
        <div
          v-if="certificates.length === 0"
          class="col-span-full bg-white p-12 text-center rounded-2xl border border-slate-200/80 shadow-xs"
        >
          <div class="w-14 h-14 mx-auto mb-3 rounded-full bg-[#DE0171]/10 text-[#DE0171] flex items-center justify-center text-xl">
            <i class="fa-solid fa-certificate"></i>
          </div>
          <h3 class="text-sm font-bold text-slate-900 mb-1">Belum Ada Dokumen Sertifikasi</h3>
          <p class="text-xs text-slate-500 max-w-sm mx-auto mb-4">Unggah dokumen NIB, TDUP, atau sertifikasi HPI untuk meningkatkan kepercayaan pelanggan.</p>
          <button
            type="button"
            @click="openAddModal"
            class="px-4 py-2 rounded-xl bg-[#DE0171] text-white text-xs font-bold shadow hover:bg-[#b8015e]"
          >
            Tambah Dokumen Pertama
          </button>
        </div>
      </div>
    </div>

    <!-- Modal Form Tambah / Edit -->
    <div
      v-if="isModalOpen"
      class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs"
      @click.self="isModalOpen = false"
    >
      <div class="bg-white rounded-2xl border border-slate-200 shadow-2xl max-w-lg w-full overflow-hidden max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
          <h3 class="font-extrabold text-slate-900 text-sm">
            {{ editingCertificate ? 'Edit Dokumen Sertifikasi' : 'Tambah Dokumen Sertifikasi Baru' }}
          </h3>
          <button @click="isModalOpen = false" class="text-slate-400 hover:text-slate-600">
            <i class="fa-solid fa-xmark text-base"></i>
          </button>
        </div>

        <form @submit.prevent="submit" class="p-6 space-y-4 overflow-y-auto">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Dokumen / Izin <span class="text-rose-500">*</span></label>
            <input
              v-model="form.title"
              type="text"
              required
              placeholder="Contoh: Nomor Induk Berusaha (NIB)"
              class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>

          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Instansi Penerbit</label>
              <input
                v-model="form.issuer"
                type="text"
                placeholder="Contoh: OSS BKPM RI"
                class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
              />
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Dokumen / Lisensi</label>
              <input
                v-model="form.certificate_number"
                type="text"
                placeholder="Contoh: KBLI 79120"
                class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
              />
            </div>
          </div>

          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Badge Status (Tag Hijau)</label>
              <input
                v-model="form.badge"
                type="text"
                placeholder="Contoh: OSS BKPM / BNSP & HPI"
                class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
              />
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Ikon Tampilan</label>
              <select
                v-model="form.icon"
                class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
              >
                <option v-for="ico in commonIcons" :key="ico.value" :value="ico.value">
                  {{ ico.label }}
                </option>
              </select>
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Keterangan / Penjelasan Singkat</label>
            <textarea
              v-model="form.description"
              rows="3"
              placeholder="Jelaskan legalitas atau sertifikasi ini untuk meyakinkan calon klien instansi/sekolah..."
              class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            ></textarea>
          </div>

          <!-- Upload Gambar & Berkas Dokumen -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 border-t border-slate-100">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Foto / Sampul Sertifikat</label>
              <div v-if="imagePreview" class="w-full h-24 mb-2 rounded-xl overflow-hidden border border-slate-200">
                <img :src="imagePreview" class="w-full h-full object-cover" />
              </div>
              <input
                type="file"
                accept="image/*"
                @change="handleImageChange"
                class="text-xs text-slate-600 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-[#DE0171]/10 file:text-[#DE0171] hover:file:bg-[#DE0171]/20 cursor-pointer w-full"
              />
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Lampiran Berkas (PDF / Gambar)</label>
              <p class="text-[10px] text-slate-400 mb-2">Disediakan tombol unduh bagi klien yang ingin melihat berkas asli.</p>
              <input
                type="file"
                accept=".pdf,.jpg,.jpeg,.png"
                @change="handleFileChange"
                class="text-xs text-slate-600 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer w-full"
              />
            </div>
          </div>

          <div class="grid grid-cols-2 gap-3 pt-2 border-t border-slate-100">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Urutan</label>
              <input
                v-model.number="form.order"
                type="number"
                class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
              />
            </div>
            <div class="flex items-center pt-5">
              <label class="inline-flex items-center gap-2 cursor-pointer">
                <input v-model="form.is_active" type="checkbox" class="rounded text-[#DE0171] focus:ring-[#DE0171] w-4 h-4" />
                <span class="text-xs font-bold text-slate-700">Tampilkan di Website</span>
              </label>
            </div>
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
              {{ editingCertificate ? 'Simpan Perubahan' : 'Tambah Dokumen' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>
