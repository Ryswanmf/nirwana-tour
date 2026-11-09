<script setup>
import { ref } from 'vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { route } from '@/routes';

const props = defineProps({
  teamMembers: Array,
});

const isModalOpen = ref(false);
const editingMember = ref(null);

const form = useForm({
  name: '',
  role: '',
  division: 'Operasional Lapangan',
  order: 0,
  is_active: true,
  linkedin_url: '',
  facebook_url: '',
  tiktok_url: '',
  twitter_url: '',
  photo: null,
});

const photoPreview = ref(null);

const openAddModal = () => {
  editingMember.value = null;
  form.reset();
  form.division = 'Operasional Lapangan';
  form.is_active = true;
  photoPreview.value = null;
  isModalOpen.value = true;
};

const openEditModal = (m) => {
  editingMember.value = m;
  form.name = m.name;
  form.role = m.role;
  form.division = m.division || 'Operasional Lapangan';
  form.order = m.order;
  form.is_active = m.is_active;
  form.linkedin_url = m.linkedin_url || '';
  form.facebook_url = m.facebook_url || '';
  form.tiktok_url = m.tiktok_url || '';
  form.twitter_url = m.twitter_url || '';
  form.photo = null;
  photoPreview.value = m.photo_url;
  isModalOpen.value = true;
};

const handlePhotoChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    form.photo = file;
    photoPreview.value = URL.createObjectURL(file);
  }
};

const submit = () => {
  if (editingMember.value) {
    form.transform((data) => ({ ...data, _method: 'PUT' }))
      .post(route('admin.team-members.update', editingMember.value.id), {
        onSuccess: () => { isModalOpen.value = false; },
      });
  } else {
    form.post(route('admin.team-members.store'), {
      onSuccess: () => { isModalOpen.value = false; },
    });
  }
};

const deleteMember = (m) => {
  if (confirm(`Hapus anggota tim "${m.name}"?`)) {
    router.delete(route('admin.team-members.destroy', m.id));
  }
};

const toggleActive = (m) => {
  router.post(route('admin.team-members.toggle', m.id));
};
</script>

<template>
  <Head title="Manajemen & Tim Profesional" />

  <AdminLayout>
    <template #header-title>
      <div class="flex items-center gap-2">
        <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">Manajemen & Tim Profesional</h1>
        <span class="text-xs px-2.5 py-0.5 rounded-full bg-slate-200 text-slate-700 font-bold">
          {{ teamMembers.length }} Anggota
        </span>
      </div>
    </template>

    <div class="space-y-5">
      <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
        <p class="text-xs text-slate-500">
          Kelola jajaran manajemen, tour leader berlisensi HPI, hingga staf lapangan yang tampil di halaman <strong>/manajemen</strong>.
        </p>

        <button
          type="button"
          @click="openAddModal"
          class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white text-xs font-bold shadow-md shadow-[#DE0171]/25 hover:opacity-95 transition shrink-0"
        >
          <i class="fa-solid fa-user-plus text-xs"></i>
          <span>Tambah Anggota Tim</span>
        </button>
      </div>

      <!-- Team Members Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        <div
          v-for="member in teamMembers"
          :key="member.id"
          class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden flex flex-col transition hover:shadow-md"
        >
          <!-- Card Header & Photo -->
          <div class="relative h-48 bg-slate-100 flex items-center justify-center overflow-hidden group">
            <img
              :src="member.photo_url"
              :alt="member.name"
              class="w-full h-full object-cover object-top transition duration-300 group-hover:scale-105"
            />
            <div class="absolute top-2.5 right-2.5 flex items-center gap-1.5">
              <span
                :class="[
                  member.is_active ? 'bg-emerald-500 text-white' : 'bg-slate-500 text-white',
                  'text-[10px] font-bold px-2 py-0.5 rounded-full shadow-xs'
                ]"
              >
                {{ member.is_active ? 'Aktif' : 'Nonaktif' }}
              </span>
            </div>
            <div v-if="member.division" class="absolute bottom-2.5 left-2.5">
              <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-slate-900/80 text-white backdrop-blur-xs">
                {{ member.division }}
              </span>
            </div>
          </div>

          <!-- Body -->
          <div class="p-4 flex-1 flex flex-col justify-between">
            <div>
              <h3 class="font-bold text-slate-900 text-sm leading-snug">{{ member.name }}</h3>
              <p class="text-xs text-[#DE0171] font-semibold mt-0.5">{{ member.role }}</p>

              <!-- Social links preview -->
              <div class="flex items-center gap-2 mt-3 text-xs text-slate-400">
                <span v-if="member.linkedin_url" title="LinkedIn" class="hover:text-sky-600"><i class="fa-brands fa-linkedin"></i></span>
                <span v-if="member.facebook_url" title="Facebook" class="hover:text-blue-600"><i class="fa-brands fa-facebook"></i></span>
                <span v-if="member.tiktok_url" title="TikTok" class="hover:text-slate-900"><i class="fa-brands fa-tiktok"></i></span>
                <span v-if="member.twitter_url" title="X / Twitter" class="hover:text-slate-900"><i class="fa-brands fa-x-twitter"></i></span>
                <span class="ml-auto text-[11px] text-slate-400 font-mono">Urutan: {{ member.order }}</span>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-2 pt-4 mt-3 border-t border-slate-100">
              <button
                type="button"
                @click="toggleActive(member)"
                class="flex-1 py-1.5 px-2 rounded-lg text-[11px] font-bold border border-slate-200 text-slate-700 hover:bg-slate-50 transition"
              >
                <i :class="['fa-solid mr-1', member.is_active ? 'fa-eye-slash text-slate-400' : 'fa-eye text-emerald-600']"></i>
                {{ member.is_active ? 'Sembunyikan' : 'Tampilkan' }}
              </button>
              <button
                type="button"
                @click="openEditModal(member)"
                class="p-1.5 px-2.5 rounded-lg text-xs font-bold bg-slate-100 text-slate-700 hover:bg-slate-200 transition"
                title="Edit"
              >
                <i class="fa-solid fa-pen-to-square"></i>
              </button>
              <button
                type="button"
                @click="deleteMember(member)"
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
          v-if="teamMembers.length === 0"
          class="col-span-full bg-white p-12 text-center rounded-2xl border border-slate-200/80 shadow-xs"
        >
          <div class="w-14 h-14 mx-auto mb-3 rounded-full bg-[#DE0171]/10 text-[#DE0171] flex items-center justify-center text-xl">
            <i class="fa-solid fa-user-group"></i>
          </div>
          <h3 class="text-sm font-bold text-slate-900 mb-1">Belum Ada Anggota Tim</h3>
          <p class="text-xs text-slate-500 max-w-sm mx-auto mb-4">Tambahkan pimpinan, tour leader, atau kru lapangan untuk ditampilkan di website.</p>
          <button
            type="button"
            @click="openAddModal"
            class="px-4 py-2 rounded-xl bg-[#DE0171] text-white text-xs font-bold shadow hover:bg-[#b8015e]"
          >
            Tambah Anggota Pertama
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
            {{ editingMember ? 'Edit Anggota Tim' : 'Tambah Anggota Tim Baru' }}
          </h3>
          <button @click="isModalOpen = false" class="text-slate-400 hover:text-slate-600">
            <i class="fa-solid fa-xmark text-base"></i>
          </button>
        </div>

        <form @submit.prevent="submit" class="p-6 space-y-4 overflow-y-auto">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap <span class="text-rose-500">*</span></label>
            <input
              v-model="form.name"
              type="text"
              required
              placeholder="Contoh: Kiki M Alfin"
              class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>

          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Jabatan / Role <span class="text-rose-500">*</span></label>
              <input
                v-model="form.role"
                type="text"
                required
                placeholder="Contoh: Senior Tour Leader HPI"
                class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
              />
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Divisi Kerja</label>
              <input
                v-model="form.division"
                type="text"
                placeholder="Contoh: Operasional Lapangan"
                class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
              />
            </div>
          </div>

          <!-- Upload Foto Profil -->
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Foto Anggota Tim</label>
            <div class="flex items-center gap-4">
              <div class="w-16 h-16 rounded-xl border border-slate-200 overflow-hidden bg-slate-50 flex items-center justify-center shrink-0">
                <img v-if="photoPreview" :src="photoPreview" class="w-full h-full object-cover" />
                <i v-else class="fa-solid fa-user text-slate-300 text-2xl"></i>
              </div>
              <input
                type="file"
                accept="image/*"
                @change="handlePhotoChange"
                class="text-xs text-slate-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#DE0171]/10 file:text-[#DE0171] hover:file:bg-[#DE0171]/20 cursor-pointer"
              />
            </div>
          </div>

          <!-- Media Sosial (Opsional) -->
          <div class="space-y-2 pt-2 border-t border-slate-100">
            <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider">Tautan Media Sosial (Opsional)</label>
            <div class="grid grid-cols-2 gap-2">
              <div class="flex items-center gap-2 border border-slate-200 rounded-xl px-2.5 py-1.5">
                <i class="fa-brands fa-linkedin text-sky-600 text-xs"></i>
                <input v-model="form.linkedin_url" type="url" placeholder="URL LinkedIn" class="w-full text-xs outline-none" />
              </div>
              <div class="flex items-center gap-2 border border-slate-200 rounded-xl px-2.5 py-1.5">
                <i class="fa-brands fa-facebook text-blue-600 text-xs"></i>
                <input v-model="form.facebook_url" type="url" placeholder="URL Facebook" class="w-full text-xs outline-none" />
              </div>
              <div class="flex items-center gap-2 border border-slate-200 rounded-xl px-2.5 py-1.5">
                <i class="fa-brands fa-tiktok text-slate-800 text-xs"></i>
                <input v-model="form.tiktok_url" type="url" placeholder="URL TikTok" class="w-full text-xs outline-none" />
              </div>
              <div class="flex items-center gap-2 border border-slate-200 rounded-xl px-2.5 py-1.5">
                <i class="fa-brands fa-x-twitter text-slate-800 text-xs"></i>
                <input v-model="form.twitter_url" type="url" placeholder="URL Twitter/X" class="w-full text-xs outline-none" />
              </div>
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
              {{ editingMember ? 'Simpan Perubahan' : 'Tambah Anggota' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>
