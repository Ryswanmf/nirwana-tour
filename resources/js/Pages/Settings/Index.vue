<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { route } from '@/routes';

const props = defineProps({
  settings: Object,
});

const form = useForm({
  phone: props.settings.phone ?? '0822-6961-6188',
  whatsapp_number: props.settings.whatsapp_number ?? '6282269616188',
  email: props.settings.email ?? 'admin@nirwanatour.com',
  address: props.settings.address ?? 'Jl. Pangeran Antasari No. 88, Kedamaian, Bandar Lampung',
  office_hours: props.settings.office_hours ?? 'Senin - Sabtu: 08.00 - 17.00 WIB',
  instagram: props.settings.instagram ?? 'https://www.instagram.com/nirwana_tourlampung/',
  tiktok: props.settings.tiktok ?? 'https://www.tiktok.com/@nirwana_tour_travel',
  youtube: props.settings.youtube ?? 'https://youtube.com/@nirwanatourlampung',
  google_maps_review_url: props.settings.google_maps_review_url ?? '',
  google_analytics_id: props.settings.google_analytics_id ?? '',
});

const submit = () => {
  form.post(route('admin.settings.update'));
};
</script>

<template>
  <Head title="Pengaturan Kontak & Website" />

  <AdminLayout>
    <template #header-title>
      <div class="flex items-center gap-2">
        <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">Pengaturan Website & Profil</h1>
      </div>
    </template>

    <form @submit.prevent="submit" class="space-y-6 max-w-4xl">
      <!-- Section 1: Kontak & Kantor -->
      <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
        <h2 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2 border-b border-slate-100 pb-3">
          <i class="fa-solid fa-address-book text-[#DE0171]"></i>
          <span>Informasi Kontak & Kantor Resmi</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Telepon Kantor</label>
            <input
              v-model="form.phone"
              type="text"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nomor WhatsApp Konsultasi (Awali 62)</label>
            <input
              v-model="form.whatsapp_number"
              type="text"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>

          <div class="md:col-span-2">
            <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Email Resmi</label>
            <input
              v-model="form.email"
              type="email"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>

          <div class="md:col-span-2">
            <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Kantor Fisik</label>
            <textarea
              v-model="form.address"
              rows="2"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
            ></textarea>
          </div>

          <div class="md:col-span-2">
            <label class="block text-xs font-bold text-slate-700 mb-1">Jam Operasional Layanan</label>
            <input
              v-model="form.office_hours"
              type="text"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>
        </div>
      </div>

      <!-- Section 2: Media Sosial -->
      <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
        <h2 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2 border-b border-slate-100 pb-3">
          <i class="fa-solid fa-share-nodes text-[#DE0171]"></i>
          <span>Tautan Media Sosial Resmi</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Instagram</label>
            <input
              v-model="form.instagram"
              type="url"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">TikTok</label>
            <input
              v-model="form.tiktok"
              type="url"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">YouTube</label>
            <input
              v-model="form.youtube"
              type="url"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>
        </div>
      </div>

      <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-end">
        <button
          type="submit"
          :disabled="form.processing"
          class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white text-xs font-bold shadow-md shadow-[#DE0171]/25 hover:opacity-95"
        >
          Simpan Semua Pengaturan
        </button>
      </div>
    </form>
  </AdminLayout>
</template>
