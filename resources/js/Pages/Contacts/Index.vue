<script setup>
import { ref } from 'vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { route } from '@/routes';

const props = defineProps({
  contacts: Array,
});

const isModalOpen = ref(false);
const editingContact = ref(null);

const form = useForm({
  name: '',
  type: 'Kantor Pusat',
  address: '',
  city: 'Bandar Lampung',
  phone: '',
  whatsapp: '',
  email: '',
  operating_hours: 'Senin - Sabtu: 08:00 - 17:00 WIB',
  google_maps_embed: '',
  google_maps_url: '',
  description: '',
  is_primary: false,
  is_active: true,
  order: 0,
});

const officeTypes = [
  'Kantor Pusat',
  'Kantor Cabang',
  'Unit Layanan Wisata',
  'Pos / Pool Armada Bus',
  'Customer Service Online',
];

const openAddModal = () => {
  editingContact.value = null;
  form.reset();
  form.type = 'Kantor Cabang';
  form.city = 'Bandar Lampung';
  form.operating_hours = 'Senin - Sabtu: 08:00 - 17:00 WIB';
  form.is_primary = false;
  form.is_active = true;
  isModalOpen.value = true;
};

const openEditModal = (c) => {
  editingContact.value = c;
  form.name = c.name;
  form.type = c.type;
  form.address = c.address;
  form.city = c.city || 'Bandar Lampung';
  form.phone = c.phone || '';
  form.whatsapp = c.whatsapp || '';
  form.email = c.email || '';
  form.operating_hours = c.operating_hours || 'Senin - Sabtu: 08:00 - 17:00 WIB';
  form.google_maps_embed = c.google_maps_embed || '';
  form.google_maps_url = c.google_maps_url || '';
  form.description = c.description || '';
  form.is_primary = Boolean(c.is_primary);
  form.is_active = Boolean(c.is_active);
  form.order = c.order || 0;
  isModalOpen.value = true;
};

const submit = () => {
  if (editingContact.value) {
    form.transform((data) => ({ ...data, _method: 'PUT' }))
      .post(route('admin.contacts.update', editingContact.value.id), {
        onSuccess: () => { isModalOpen.value = false; },
      });
  } else {
    form.post(route('admin.contacts.store'), {
      onSuccess: () => { isModalOpen.value = false; },
    });
  }
};

const deleteContact = (c) => {
  if (confirm(`Hapus kontak/cabang "${c.name}"?`)) {
    router.delete(route('admin.contacts.destroy', c.id));
  }
};

const toggleActive = (c) => {
  router.post(route('admin.contacts.toggle', c.id));
};
</script>

<template>
  <Head title="Manajemen Kantor & Kontak Cabang" />

  <AdminLayout>
    <template #header-title>
      <div class="flex items-center gap-2">
        <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">Kantor & Kontak Cabang</h1>
        <span class="text-xs px-2.5 py-0.5 rounded-full bg-slate-200 text-slate-700 font-bold">
          {{ contacts.length }} Lokasi
        </span>
      </div>
    </template>

    <div class="space-y-5">
      <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
        <p class="text-xs text-slate-500">
          Kelola kantor pusat, cabang, nomor WhatsApp operasional, dan lokasi Google Maps yang tampil di halaman <strong>/kontak</strong>.
        </p>

        <button
          type="button"
          @click="openAddModal"
          class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white text-xs font-bold shadow-md shadow-[#DE0171]/25 hover:opacity-95 transition shrink-0"
        >
          <i class="fa-solid fa-plus text-xs"></i>
          <span>Tambah Cabang / Kontak</span>
        </button>
      </div>

      <!-- Contacts List -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div
          v-for="c in contacts"
          :key="c.id"
          class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-5 flex flex-col justify-between transition hover:shadow-md"
        >
          <div>
            <div class="flex items-start justify-between gap-3 mb-3">
              <div>
                <div class="flex items-center gap-2">
                  <span
                    v-if="c.is_primary"
                    class="px-2 py-0.5 rounded-md bg-amber-50 text-amber-700 text-[10px] font-extrabold border border-amber-200"
                  >
                    <i class="fa-solid fa-star text-[9px] mr-1"></i>Kantor Utama
                  </span>
                  <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 text-[10px] font-bold">
                    {{ c.type }}
                  </span>
                </div>
                <h3 class="font-extrabold text-slate-900 text-sm mt-1.5 leading-snug">{{ c.name }}</h3>
              </div>

              <span
                :class="[
                  c.is_active ? 'bg-emerald-500 text-white' : 'bg-slate-400 text-white',
                  'text-[10px] font-bold px-2 py-0.5 rounded-full shrink-0'
                ]"
              >
                {{ c.is_active ? 'Aktif' : 'Nonaktif' }}
              </span>
            </div>

            <!-- Detail Info -->
            <div class="space-y-1.5 text-xs text-slate-600 mb-3">
              <div class="flex items-start gap-2">
                <i class="fa-solid fa-location-dot text-[#DE0171] mt-0.5 shrink-0"></i>
                <span>{{ c.address }}</span>
              </div>
              <div v-if="c.whatsapp" class="flex items-center gap-2">
                <i class="fa-brands fa-whatsapp text-emerald-500 shrink-0"></i>
                <a :href="`https://wa.me/${c.whatsapp.replace(/[^0-9]/g, '')}`" target="_blank" class="hover:underline font-semibold">
                  +{{ c.whatsapp }}
                </a>
              </div>
              <div v-if="c.phone" class="flex items-center gap-2">
                <i class="fa-solid fa-phone text-sky-500 shrink-0"></i>
                <span>{{ c.phone }}</span>
              </div>
              <div v-if="c.email" class="flex items-center gap-2">
                <i class="fa-solid fa-envelope text-slate-400 shrink-0"></i>
                <span>{{ c.email }}</span>
              </div>
              <div v-if="c.operating_hours" class="flex items-center gap-2 text-slate-500 text-[11px]">
                <i class="fa-solid fa-clock text-slate-400 shrink-0"></i>
                <span>{{ c.operating_hours }}</span>
              </div>
            </div>

            <p v-if="c.description" class="text-xs text-slate-500 italic bg-slate-50 p-2 rounded-lg mb-3">
              "{{ c.description }}"
            </p>
          </div>

          <!-- Actions -->
          <div class="flex items-center gap-2 pt-3 border-t border-slate-100">
            <button
              type="button"
              @click="toggleActive(c)"
              class="flex-1 py-1.5 px-2 rounded-lg text-[11px] font-bold border border-slate-200 text-slate-700 hover:bg-slate-50 transition"
            >
              <i :class="['fa-solid mr-1', c.is_active ? 'fa-eye-slash text-slate-400' : 'fa-eye text-emerald-600']"></i>
              {{ c.is_active ? 'Sembunyikan' : 'Aktifkan' }}
            </button>
            <button
              type="button"
              @click="openEditModal(c)"
              class="p-1.5 px-3 rounded-lg text-xs font-bold bg-slate-100 text-slate-700 hover:bg-slate-200 transition"
              title="Edit"
            >
              <i class="fa-solid fa-pen-to-square"></i>
            </button>
            <button
              type="button"
              @click="deleteContact(c)"
              class="p-1.5 px-3 rounded-lg text-xs font-bold bg-rose-50 text-rose-600 hover:bg-rose-100 transition"
              title="Hapus"
            >
              <i class="fa-solid fa-trash-can"></i>
            </button>
          </div>
        </div>

        <!-- Empty State -->
        <div
          v-if="contacts.length === 0"
          class="col-span-full bg-white p-12 text-center rounded-2xl border border-slate-200/80 shadow-xs"
        >
          <div class="w-14 h-14 mx-auto mb-3 rounded-full bg-[#DE0171]/10 text-[#DE0171] flex items-center justify-center text-xl">
            <i class="fa-solid fa-location-dot"></i>
          </div>
          <h3 class="text-sm font-bold text-slate-900 mb-1">Belum Ada Kantor / Cabang</h3>
          <p class="text-xs text-slate-500 max-w-sm mx-auto mb-4">Tambahkan kantor operasional atau kontak layanan pelanggan resmi.</p>
          <button
            type="button"
            @click="openAddModal"
            class="px-4 py-2 rounded-xl bg-[#DE0171] text-white text-xs font-bold shadow hover:bg-[#b8015e]"
          >
            Tambah Kantor Utama
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
            {{ editingContact ? 'Edit Kantor / Kontak' : 'Tambah Kantor / Kontak Baru' }}
          </h3>
          <button @click="isModalOpen = false" class="text-slate-400 hover:text-slate-600">
            <i class="fa-solid fa-xmark text-base"></i>
          </button>
        </div>

        <form @submit.prevent="submit" class="p-6 space-y-4 overflow-y-auto">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Kantor / Saluran Kontak <span class="text-rose-500">*</span></label>
            <input
              v-model="form.name"
              type="text"
              required
              placeholder="Contoh: Kantor Pusat Nirwana Tour & Travel Lampung"
              class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>

          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Tipe Kantor</label>
              <select
                v-model="form.type"
                class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
              >
                <option v-for="t in officeTypes" :key="t" :value="t">{{ t }}</option>
              </select>
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Kota / Domisili</label>
              <input
                v-model="form.city"
                type="text"
                placeholder="Bandar Lampung"
                class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
              />
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Fisik Lengkap <span class="text-rose-500">*</span></label>
            <textarea
              v-model="form.address"
              rows="2"
              required
              placeholder="Jl. Pangeran Antasari No. 88, Kedamaian, Kota Bandar Lampung"
              class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            ></textarea>
          </div>

          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Nomor WhatsApp</label>
              <input
                v-model="form.whatsapp"
                type="text"
                placeholder="6282269616188"
                class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
              />
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Telepon Kantor</label>
              <input
                v-model="form.phone"
                type="text"
                placeholder="0822-6961-6188"
                class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
              />
            </div>
          </div>

          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Email Resmi</label>
              <input
                v-model="form.email"
                type="email"
                placeholder="info@nirwanatour.com"
                class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
              />
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Jam Operasional Layanan</label>
              <input
                v-model="form.operating_hours"
                type="text"
                placeholder="Senin - Sabtu: 08:00 - 17:00 WIB"
                class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
              />
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Google Maps Embed URL / Iframe</label>
            <input
              v-model="form.google_maps_embed"
              type="text"
              placeholder="https://www.google.com/maps/embed?pb=..."
              class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Link Tautan Buka di Google Maps</label>
            <input
              v-model="form.google_maps_url"
              type="url"
              placeholder="https://maps.google.com/?q=..."
              class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>

          <div class="grid grid-cols-2 gap-3 pt-2 border-t border-slate-100">
            <div class="space-y-2">
              <label class="inline-flex items-center gap-2 cursor-pointer">
                <input v-model="form.is_primary" type="checkbox" class="rounded text-[#DE0171] focus:ring-[#DE0171] w-4 h-4" />
                <span class="text-xs font-bold text-slate-700">Jadikan Kantor Utama</span>
              </label>
              <br />
              <label class="inline-flex items-center gap-2 cursor-pointer">
                <input v-model="form.is_active" type="checkbox" class="rounded text-[#DE0171] focus:ring-[#DE0171] w-4 h-4" />
                <span class="text-xs font-bold text-slate-700">Aktif Tampil di Web</span>
              </label>
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Urutan</label>
              <input
                v-model.number="form.order"
                type="number"
                class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
              />
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
              {{ editingContact ? 'Simpan Perubahan' : 'Tambah Kantor' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>
