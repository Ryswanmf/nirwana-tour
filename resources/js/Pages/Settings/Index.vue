<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { route } from '@/routes';

const props = defineProps({
  settings: Object,
  imageUrls: Object,
});

const activeTab = ref('general');

const tabs = [
  { id: 'general', name: 'Kontak & Legalitas', icon: 'fa-solid fa-address-book' },
  { id: 'hero', name: 'Hero Banner Beranda', icon: 'fa-solid fa-image' },
  { id: 'founder', name: 'Pimpinan & Founder', icon: 'fa-solid fa-user-tie' },
  { id: 'profile', name: 'Profil & Statistik', icon: 'fa-solid fa-building-columns' },
  { id: 'vision', name: 'Visi, Misi & Nilai', icon: 'fa-solid fa-bullseye' },
  { id: 'social', name: 'Medsos & SEO', icon: 'fa-solid fa-share-nodes' },
];

const form = useForm({
  // 1. Identitas & Kontak
  site_name: props.settings.site_name ?? 'Nirwana Tour Lampung',
  tagline: props.settings.tagline ?? 'Biro Wisata, Paket Tour & Sewa Bus Terpercaya',
  phone: props.settings.phone ?? '0822-6961-6188',
  whatsapp_number: props.settings.whatsapp_number ?? '6282269616188',
  email: props.settings.email ?? 'info@nirwanatourlampung.com',
  address: props.settings.address ?? 'Jl. Pangeran Antasari No. 88, Kedamaian, Bandar Lampung',
  operating_hours: props.settings.operating_hours ?? 'Senin - Sabtu: 08:00 - 17:00 WIB',
  company_legal_name: props.settings.company_legal_name ?? 'Nirwana Tour Travel',
  company_founded_year: props.settings.company_founded_year ?? '2016 (8+ Tahun Pengalaman)',
  company_legal_license: props.settings.company_legal_license ?? 'Resmi OSS BKPM & TDUP',
  company_domicile: props.settings.company_domicile ?? 'Bandar Lampung, Lampung',

  // 2. Hero Section
  hero_badge: props.settings.hero_badge ?? 'Biro Perjalanan Wisata Resmi Lampung',
  hero_title: props.settings.hero_title ?? 'Biro Perjalanan Wisata & Tour Travel Lampung Terpercaya',
  hero_subtitle: props.settings.hero_subtitle ?? 'Wujudkan momen liburan terbaik Anda bersama Nirwana Tour Lampung. Kami menghadirkan paket wisata eksotis, study tour edukatif, gathering perusahaan, serta persewaan armada transportasi nyaman dan profesional.',
  hero_cta_wa_text: props.settings.hero_cta_wa_text ?? 'Konsultasi via WhatsApp',
  hero_cta_dest_text: props.settings.hero_cta_dest_text ?? 'Lihat Destinasi',
  hero_feature_1: props.settings.hero_feature_1 ?? 'Legalitas Berizin Resmi',
  hero_feature_2: props.settings.hero_feature_2 ?? 'Armada Bus Nyaman & Terawat',
  hero_feature_3: props.settings.hero_feature_3 ?? 'Tour Leader Berpengalaman',
  hero_background_image: null,

  // 3. Founder / Pimpinan
  owner_name: props.settings.owner_name ?? 'Kiki M Alfin',
  owner_role: props.settings.owner_role ?? 'Pimpinan & Founder - Nirwana Tour Lampung • Sejak 2016',
  owner_quote: props.settings.owner_quote ?? 'Selamat datang di Nirwana Tour Lampung. Bagi kami, setiap perjalanan bukan sekadar mengantar Anda ke destinasi, melainkan sebuah amanah untuk menghadirkan rasa aman, kenyamanan prima, dan kenangan indah yang abadi bersama orang-orang tercinta.',
  owner_photo: null,

  // 4. Profil & Statistik
  about_story_title: props.settings.about_story_title ?? 'Berawal dari Kecintaan Mendalam pada Pesona Bumi Ruwa Jurai',
  about_description: props.settings.about_description ?? 'Nirwana Tour Lampung didirikan atas sebuah visi sederhana namun kuat: mengenalkan keindahan alam dan kekayaan budaya Lampung kepada wisatawan Nusantara dan mancanegara dengan standar layanan yang ramah, profesional, serta transparan.',
  about_team_photo: null,
  stat_years_count: props.settings.stat_years_count ?? '8+',
  stat_years_label: props.settings.stat_years_label ?? 'Tahun Pengalaman',
  stat_tourists_count: props.settings.stat_tourists_count ?? '15.000+',
  stat_tourists_label: props.settings.stat_tourists_label ?? 'Wisatawan Terlayani',
  stat_trips_count: props.settings.stat_trips_count ?? '500+',
  stat_trips_label: props.settings.stat_trips_label ?? 'Trip Sukses Dijalankan',
  stat_legal_count: props.settings.stat_legal_count ?? '100%',
  stat_legal_label: props.settings.stat_legal_label ?? 'Legalitas Resmi',

  // 5. Visi & Misi & Nilai
  company_vision: props.settings.company_vision ?? 'Menjadi biro perjalanan wisata terdepan, tepercaya, dan bereputasi prima di Lampung serta Indonesia, yang dikenal atas keunggulan layanan, integritas bisnis, standar keselamatan tinggi, dan kontribusi nyata dalam memajukan potensi pariwisata lokal yang berkelanjutan.',
  company_mission_1: props.settings.company_mission_1 ?? 'Pelayanan Profesional & Berhati: Menyediakan layanan wisata dengan keramahan khas Indonesia serta pendampingan tour leader yang terlatih dan berlisensi.',
  company_mission_2: props.settings.company_mission_2 ?? 'Keselamatan Nomor Satu: Mengedepankan standar operasional prosedur (SOP) keselamatan ketat pada seluruh armada darat, kapal laut, dan aktivitas outdoor.',
  company_mission_3: props.settings.company_mission_3 ?? 'Transparansi & Nilai Maksimal: Menghadirkan paket wisata berkualitas tinggi dengan rincian harga jujur tanpa biaya siluman (no hidden fees).',
  company_mission_4: props.settings.company_mission_4 ?? 'Pemberdayaan Lokal Berkelanjutan: Menggandeng masyarakat setempat, pemandu lokal, dan UMKM daerah untuk memajukan ekosistem ekonomi pariwisata.',
  value_1_title: props.settings.value_1_title ?? 'Integritas & Kejujuran',
  value_1_desc: props.settings.value_1_desc ?? 'Kami menjunjung tinggi keterbukaan informasi. Fasilitas, jadwal, dan biaya yang kami sampaikan di awal adalah apa yang benar-benar Anda terima di lapangan.',
  value_2_title: props.settings.value_2_title ?? 'Keselamatan Utama',
  value_2_desc: props.settings.value_2_desc ?? 'Kesiapan armada prima, kelengkapan life jacket standar, kotak P3K lengkap, serta asuransi perjalanan menjamin ketenangan keluarga dan rombongan Anda.',
  value_3_title: props.settings.value_3_title ?? 'Hospitalitas Tulus',
  value_3_desc: props.settings.value_3_desc ?? 'Senyum, sapa, dan kepedulian dari tim guide kami bukan sekadar tuntutan kerja, melainkan komitmen hati untuk membuat Anda merasa seperti keluarga.',
  value_4_title: props.settings.value_4_title ?? 'Fleksibilitas Solutif',
  value_4_desc: props.settings.value_4_desc ?? 'Kami memahami kebutuhan setiap rombongan unik. Kami siap merancang itinerary kustom yang tepat guna sesuai durasi, preferensi, dan anggaran Anda.',

  // 6. Medsos & SEO
  instagram: props.settings.instagram ?? 'https://www.instagram.com/nirwana_tourlampung/',
  tiktok: props.settings.tiktok ?? 'https://www.tiktok.com/@nirwana_tour_travel',
  youtube: props.settings.youtube ?? 'https://youtube.com/@nirwanatourlampung',
  google_maps_review_url: props.settings.google_maps_review_url ?? '',
  google_analytics_id: props.settings.google_analytics_id ?? '',
  meta_pixel_id: props.settings.meta_pixel_id ?? '',
  google_site_verification: props.settings.google_site_verification ?? '',
});

const previewOwnerPhoto = ref(props.imageUrls?.owner_photo_url || null);
const previewTeamPhoto = ref(props.imageUrls?.about_team_photo_url || null);
const previewHeroBg = ref(props.imageUrls?.hero_background_image_url || null);

const handleFile = (key, event, previewRef) => {
  const file = event.target.files[0];
  if (file) {
    form[key] = file;
    previewRef.value = URL.createObjectURL(file);
  }
};

const submit = () => {
  form.post(route('admin.settings.update'), {
    preserveScroll: true,
  });
};
</script>

<template>
  <Head title="Pengaturan Website & Profil Perusahaan" />

  <AdminLayout>
    <template #header-title>
      <div class="flex items-center gap-2">
        <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">Pengaturan Website & Profil Perusahaan</h1>
      </div>
    </template>

    <div class="space-y-6 max-w-5xl">
      <!-- Tabs Navigation -->
      <div class="flex items-center gap-1.5 p-1.5 bg-slate-200/70 rounded-2xl overflow-x-auto">
        <button
          v-for="tab in tabs"
          :key="tab.id"
          type="button"
          @click="activeTab = tab.id"
          :class="[
            activeTab === tab.id
              ? 'bg-white text-slate-900 font-bold shadow-xs'
              : 'text-slate-600 hover:text-slate-900 font-semibold',
            'flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs whitespace-nowrap transition'
          ]"
        >
          <i :class="[tab.icon, activeTab === tab.id ? 'text-[#DE0171]' : 'text-slate-400']"></i>
          <span>{{ tab.name }}</span>
        </button>
      </div>

      <form @submit.prevent="submit" class="space-y-6">
        <!-- ================= TAB 1: KONTAK & IDENTITAS ================= -->
        <div v-show="activeTab === 'general'" class="space-y-6">
          <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
            <h2 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2 border-b border-slate-100 pb-3">
              <i class="fa-solid fa-address-book text-[#DE0171]"></i>
              <span>Informasi Kontak & Legalitas Perusahaan</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Brand / Website</label>
                <input v-model="form.site_name" type="text" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Tagline SEO</label>
                <input v-model="form.tagline" type="text" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nomor WhatsApp Konsultasi (Awali 62)</label>
                <input v-model="form.whatsapp_number" type="text" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Telepon Kantor</label>
                <input v-model="form.phone" type="text" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Email Resmi</label>
                <input v-model="form.email" type="email" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Jam Operasional Layanan</label>
                <input v-model="form.operating_hours" type="text" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
              </div>

              <div class="md:col-span-2">
                <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Kantor Fisik</label>
                <textarea v-model="form.address" rows="2" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"></textarea>
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Badan Usaha (Profil)</label>
                <input v-model="form.company_legal_name" type="text" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Tahun Berdiri & Pengalaman</label>
                <input v-model="form.company_founded_year" type="text" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Ringkasan Legalitas Usaha</label>
                <input v-model="form.company_legal_license" type="text" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Domisili Kantor</label>
                <input v-model="form.company_domicile" type="text" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
              </div>
            </div>
          </div>
        </div>

        <!-- ================= TAB 2: HERO BANNER BERANDA ================= -->
        <div v-show="activeTab === 'hero'" class="space-y-6">
          <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
            <h2 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2 border-b border-slate-100 pb-3">
              <i class="fa-solid fa-image text-[#DE0171]"></i>
              <span>Banner Utama & Pesan Penjualan Beranda</span>
            </h2>

            <div class="space-y-4">
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Badge Hero (Pill Pink)</label>
                <input v-model="form.hero_badge" type="text" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Judul Utama Hero (H1)</label>
                <input v-model="form.hero_title" type="text" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Subjudul / Paragraf Hero</label>
                <textarea v-model="form.hero_subtitle" rows="3" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"></textarea>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label class="block text-xs font-bold text-slate-700 mb-1">Teks Tombol WhatsApp</label>
                  <input v-model="form.hero_cta_wa_text" type="text" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
                </div>
                <div>
                  <label class="block text-xs font-bold text-slate-700 mb-1">Teks Tombol Destinasi</label>
                  <input v-model="form.hero_cta_dest_text" type="text" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-3 gap-3 pt-2 border-t border-slate-100">
                <div>
                  <label class="block text-xs font-bold text-slate-700 mb-1">Fitur Mini 1</label>
                  <input v-model="form.hero_feature_1" type="text" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs" />
                </div>
                <div>
                  <label class="block text-xs font-bold text-slate-700 mb-1">Fitur Mini 2</label>
                  <input v-model="form.hero_feature_2" type="text" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs" />
                </div>
                <div>
                  <label class="block text-xs font-bold text-slate-700 mb-1">Fitur Mini 3</label>
                  <input v-model="form.hero_feature_3" type="text" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs" />
                </div>
              </div>

              <div class="pt-2 border-t border-slate-100">
                <label class="block text-xs font-bold text-slate-700 mb-1">Foto Background Hero</label>
                <div v-if="previewHeroBg" class="h-36 w-full max-w-md rounded-xl overflow-hidden border border-slate-200 mb-2">
                  <img :src="previewHeroBg" class="w-full h-full object-cover" />
                </div>
                <input
                  type="file"
                  accept="image/*"
                  @change="(e) => handleFile('hero_background_image', e, previewHeroBg)"
                  class="text-xs text-slate-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#DE0171]/10 file:text-[#DE0171]"
                />
              </div>
            </div>
          </div>
        </div>

        <!-- ================= TAB 3: FOUNDER / PIMPINAN ================= -->
        <div v-show="activeTab === 'founder'" class="space-y-6">
          <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
            <h2 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2 border-b border-slate-100 pb-3">
              <i class="fa-solid fa-user-tie text-[#DE0171]"></i>
              <span>Profil Pimpinan & Sambutan Hangat Founder</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Pimpinan / Founder</label>
                <input v-model="form.owner_name" type="text" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Jabatan & Subtitle</label>
                <input v-model="form.owner_role" type="text" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
              </div>

              <div class="md:col-span-2">
                <label class="block text-xs font-bold text-slate-700 mb-1">Kutipan Sambutan Pimpinan</label>
                <textarea v-model="form.owner_quote" rows="4" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"></textarea>
              </div>

              <div class="md:col-span-2 pt-2 border-t border-slate-100">
                <label class="block text-xs font-bold text-slate-700 mb-1">Foto Pimpinan / Founder</label>
                <div class="flex items-center gap-4">
                  <div class="w-20 h-24 rounded-xl overflow-hidden border border-slate-200 bg-slate-50 shrink-0">
                    <img v-if="previewOwnerPhoto" :src="previewOwnerPhoto" class="w-full h-full object-cover object-top" />
                    <div v-else class="w-full h-full flex items-center justify-center text-slate-300"><i class="fa-solid fa-user text-2xl"></i></div>
                  </div>
                  <input
                    type="file"
                    accept="image/*"
                    @change="(e) => handleFile('owner_photo', e, previewOwnerPhoto)"
                    class="text-xs text-slate-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#DE0171]/10 file:text-[#DE0171]"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ================= TAB 4: PROFIL & STATISTIK ================= -->
        <div v-show="activeTab === 'profile'" class="space-y-6">
          <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
            <h2 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2 border-b border-slate-100 pb-3">
              <i class="fa-solid fa-building-columns text-[#DE0171]"></i>
              <span>Cerita Sejarah & Statistik Pencapaian</span>
            </h2>

            <div class="space-y-4">
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Judul Cerita Perusahaan</label>
                <input v-model="form.about_story_title" type="text" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Narasi Lengkap Perusahaan</label>
                <textarea v-model="form.about_description" rows="5" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"></textarea>
              </div>

              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Foto Bersama Tim Operasional (About Showcase)</label>
                <div v-if="previewTeamPhoto" class="h-32 w-48 rounded-xl overflow-hidden border border-slate-200 mb-2">
                  <img :src="previewTeamPhoto" class="w-full h-full object-cover" />
                </div>
                <input
                  type="file"
                  accept="image/*"
                  @change="(e) => handleFile('about_team_photo', e, previewTeamPhoto)"
                  class="text-xs text-slate-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#DE0171]/10 file:text-[#DE0171]"
                />
              </div>

              <!-- 4 Statistik Angka -->
              <div class="pt-4 border-t border-slate-100">
                <label class="block text-xs font-extrabold text-slate-900 mb-3 uppercase tracking-wider">4 Counter Statistik Kunci</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/60 grid grid-cols-2 gap-2">
                    <div>
                      <label class="block text-[11px] font-bold text-slate-600 mb-1">Angka 1</label>
                      <input v-model="form.stat_years_count" type="text" class="w-full px-2.5 py-1.5 bg-white rounded-lg border border-slate-200 text-xs font-bold" />
                    </div>
                    <div>
                      <label class="block text-[11px] font-bold text-slate-600 mb-1">Label 1</label>
                      <input v-model="form.stat_years_label" type="text" class="w-full px-2.5 py-1.5 bg-white rounded-lg border border-slate-200 text-xs" />
                    </div>
                  </div>

                  <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/60 grid grid-cols-2 gap-2">
                    <div>
                      <label class="block text-[11px] font-bold text-slate-600 mb-1">Angka 2</label>
                      <input v-model="form.stat_tourists_count" type="text" class="w-full px-2.5 py-1.5 bg-white rounded-lg border border-slate-200 text-xs font-bold" />
                    </div>
                    <div>
                      <label class="block text-[11px] font-bold text-slate-600 mb-1">Label 2</label>
                      <input v-model="form.stat_tourists_label" type="text" class="w-full px-2.5 py-1.5 bg-white rounded-lg border border-slate-200 text-xs" />
                    </div>
                  </div>

                  <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/60 grid grid-cols-2 gap-2">
                    <div>
                      <label class="block text-[11px] font-bold text-slate-600 mb-1">Angka 3</label>
                      <input v-model="form.stat_trips_count" type="text" class="w-full px-2.5 py-1.5 bg-white rounded-lg border border-slate-200 text-xs font-bold" />
                    </div>
                    <div>
                      <label class="block text-[11px] font-bold text-slate-600 mb-1">Label 3</label>
                      <input v-model="form.stat_trips_label" type="text" class="w-full px-2.5 py-1.5 bg-white rounded-lg border border-slate-200 text-xs" />
                    </div>
                  </div>

                  <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/60 grid grid-cols-2 gap-2">
                    <div>
                      <label class="block text-[11px] font-bold text-slate-600 mb-1">Angka 4</label>
                      <input v-model="form.stat_legal_count" type="text" class="w-full px-2.5 py-1.5 bg-white rounded-lg border border-slate-200 text-xs font-bold" />
                    </div>
                    <div>
                      <label class="block text-[11px] font-bold text-slate-600 mb-1">Label 4</label>
                      <input v-model="form.stat_legal_label" type="text" class="w-full px-2.5 py-1.5 bg-white rounded-lg border border-slate-200 text-xs" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ================= TAB 5: VISI, MISI & NILAI ================= -->
        <div v-show="activeTab === 'vision'" class="space-y-6">
          <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
            <h2 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2 border-b border-slate-100 pb-3">
              <i class="fa-solid fa-bullseye text-[#DE0171]"></i>
              <span>Visi & Misi Perusahaan</span>
            </h2>

            <div class="space-y-4">
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Visi Perusahaan</label>
                <textarea v-model="form.company_vision" rows="3" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"></textarea>
              </div>

              <div class="space-y-3 pt-2 border-t border-slate-100">
                <label class="block text-xs font-extrabold text-slate-900 uppercase tracking-wider">4 Poin Misi Utama</label>
                <div>
                  <label class="block text-[11px] font-bold text-slate-600 mb-1">Misi 1</label>
                  <textarea v-model="form.company_mission_1" rows="2" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs"></textarea>
                </div>
                <div>
                  <label class="block text-[11px] font-bold text-slate-600 mb-1">Misi 2</label>
                  <textarea v-model="form.company_mission_2" rows="2" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs"></textarea>
                </div>
                <div>
                  <label class="block text-[11px] font-bold text-slate-600 mb-1">Misi 3</label>
                  <textarea v-model="form.company_mission_3" rows="2" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs"></textarea>
                </div>
                <div>
                  <label class="block text-[11px] font-bold text-slate-600 mb-1">Misi 4</label>
                  <textarea v-model="form.company_mission_4" rows="2" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs"></textarea>
                </div>
              </div>

              <!-- 4 Nilai Utama -->
              <div class="pt-4 border-t border-slate-100 space-y-3">
                <label class="block text-xs font-extrabold text-slate-900 uppercase tracking-wider">4 Nilai-Nilai Utama (Core Values)</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/60 space-y-2">
                    <input v-model="form.value_1_title" type="text" placeholder="Judul Nilai 1" class="w-full px-2.5 py-1.5 bg-white rounded-lg border border-slate-200 text-xs font-bold" />
                    <textarea v-model="form.value_1_desc" rows="2" placeholder="Deskripsi Nilai 1" class="w-full px-2.5 py-1.5 bg-white rounded-lg border border-slate-200 text-xs"></textarea>
                  </div>
                  <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/60 space-y-2">
                    <input v-model="form.value_2_title" type="text" placeholder="Judul Nilai 2" class="w-full px-2.5 py-1.5 bg-white rounded-lg border border-slate-200 text-xs font-bold" />
                    <textarea v-model="form.value_2_desc" rows="2" placeholder="Deskripsi Nilai 2" class="w-full px-2.5 py-1.5 bg-white rounded-lg border border-slate-200 text-xs"></textarea>
                  </div>
                  <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/60 space-y-2">
                    <input v-model="form.value_3_title" type="text" placeholder="Judul Nilai 3" class="w-full px-2.5 py-1.5 bg-white rounded-lg border border-slate-200 text-xs font-bold" />
                    <textarea v-model="form.value_3_desc" rows="2" placeholder="Deskripsi Nilai 3" class="w-full px-2.5 py-1.5 bg-white rounded-lg border border-slate-200 text-xs"></textarea>
                  </div>
                  <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/60 space-y-2">
                    <input v-model="form.value_4_title" type="text" placeholder="Judul Nilai 4" class="w-full px-2.5 py-1.5 bg-white rounded-lg border border-slate-200 text-xs font-bold" />
                    <textarea v-model="form.value_4_desc" rows="2" placeholder="Deskripsi Nilai 4" class="w-full px-2.5 py-1.5 bg-white rounded-lg border border-slate-200 text-xs"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ================= TAB 6: MEDSOS & ANALYTICS ================= -->
        <div v-show="activeTab === 'social'" class="space-y-6">
          <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
            <h2 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2 border-b border-slate-100 pb-3">
              <i class="fa-solid fa-share-nodes text-[#DE0171]"></i>
              <span>Media Sosial & Kode Tracking SEO</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1"><i class="fa-brands fa-instagram text-pink-600 mr-1"></i>Instagram URL</label>
                <input v-model="form.instagram" type="url" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1"><i class="fa-brands fa-tiktok text-slate-900 mr-1"></i>TikTok URL</label>
                <input v-model="form.tiktok" type="url" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1"><i class="fa-brands fa-youtube text-red-600 mr-1"></i>YouTube URL</label>
                <input v-model="form.youtube" type="url" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
              </div>
            </div>

            <div class="space-y-3 pt-3 border-t border-slate-100">
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Google Maps Review Link</label>
                <input v-model="form.google_maps_review_url" type="url" placeholder="https://maps.app.goo.gl/..." class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]" />
              </div>
              <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <div>
                  <label class="block text-xs font-bold text-slate-700 mb-1">Google Analytics ID (GA4)</label>
                  <input v-model="form.google_analytics_id" type="text" placeholder="G-XXXXXXXXXX" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs" />
                </div>
                <div>
                  <label class="block text-xs font-bold text-slate-700 mb-1">Meta Pixel ID (FB Ads)</label>
                  <input v-model="form.meta_pixel_id" type="text" placeholder="1234567890" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs" />
                </div>
                <div>
                  <label class="block text-xs font-bold text-slate-700 mb-1">Google Site Verification Code</label>
                  <input v-model="form.google_site_verification" type="text" placeholder="verification-code" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs" />
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Sticky Save Button Bar -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between gap-4 sticky bottom-4 z-20">
          <p class="text-xs text-slate-500">
            Perubahan pengaturan akan langsung diterapkan secara real-time ke seluruh halaman website publik.
          </p>

          <button
            type="submit"
            :disabled="form.processing"
            class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white text-xs font-bold shadow-md shadow-[#DE0171]/25 hover:opacity-95 shrink-0 flex items-center gap-2"
          >
            <i class="fa-solid fa-floppy-disk"></i>
            <span>{{ form.processing ? 'Menyimpan...' : 'Simpan Semua Pengaturan' }}</span>
          </button>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>
