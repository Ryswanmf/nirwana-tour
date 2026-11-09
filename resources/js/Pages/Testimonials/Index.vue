<script setup>
import { ref, watch } from 'vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { route } from '@/routes.js';

const props = defineProps({
  testimonials: Object,
  filters: Object,
  stats: Object,
});

const search = ref(props.filters.search || '');
const selectedStatus = ref(props.filters.status || '');

let searchTimer = null;
watch([search, selectedStatus], () => {
  clearTimeout(searchTimer);
  searchTimer = setTimeout(() => {
    router.get(
      route('admin.testimonials.index'),
      {
        search: search.value,
        status: selectedStatus.value,
      },
      {
        preserveState: true,
        replace: true,
      }
    );
  }, 300);
});

// Modal State
const isModalOpen = ref(false);
const editingTestimonial = ref(null);

const form = useForm({
  client_name: '',
  organization: '',
  role: '',
  trip_name: '',
  rating: 5,
  comment: '',
  avatar: null,
  is_active: true,
  order: 0,
});

const openCreateModal = () => {
  editingTestimonial.value = null;
  form.reset();
  form.rating = 5;
  form.is_active = true;
  form.order = 0;
  isModalOpen.value = true;
};

const openEditModal = (item) => {
  editingTestimonial.value = item;
  form.client_name = item.client_name;
  form.organization = item.organization || '';
  form.role = item.role || '';
  form.trip_name = item.trip_name || '';
  form.rating = item.rating;
  form.comment = item.comment;
  form.avatar = null;
  form.is_active = item.is_active;
  form.order = item.order;
  isModalOpen.value = true;
};

const closeModal = () => {
  isModalOpen.value = false;
  editingTestimonial.value = null;
  form.reset();
};

const submitForm = () => {
  if (editingTestimonial.value) {
    form.transform((data) => ({
      ...data,
      _method: 'PUT',
    })).post(route('admin.testimonials.update', editingTestimonial.value.id), {
      onSuccess: () => closeModal(),
      forceFormData: true,
    });
  } else {
    form.post(route('admin.testimonials.store'), {
      onSuccess: () => closeModal(),
      forceFormData: true,
    });
  }
};

const toggleStatus = (item) => {
  router.post(route('admin.testimonials.toggle', item.id), {}, { preserveScroll: true });
};

const deleteItem = (item) => {
  if (confirm(`Hapus ulasan dari "${item.client_name}"?`)) {
    router.delete(route('admin.testimonials.destroy', item.id));
  }
};

// Bulk Selection & Deletion
const selectedIds = ref([]);
const selectAll = ref(false);

const toggleSelectAll = () => {
  if (selectAll.value) {
    selectedIds.value = props.testimonials.data.map((item) => item.id);
  } else {
    selectedIds.value = [];
  }
};

watch(() => props.testimonials.data, () => {
  selectedIds.value = [];
  selectAll.value = false;
});

const bulkDelete = () => {
  if (selectedIds.value.length === 0) return;
  if (
    confirm(
      `Apakah Anda yakin ingin menghapus ${selectedIds.value.length} ulasan yang dipilih sekaligus? Tindakan ini tidak dapat dibatalkan.`
    )
  ) {
    router.post(
      route('admin.testimonials.bulk-delete'),
      { ids: selectedIds.value },
      {
        onSuccess: () => {
          selectedIds.value = [];
          selectAll.value = false;
        },
      }
    );
  }
};
</script>

<template>
  <Head title="Manajemen Testimoni & Ulasan" />

  <AdminLayout>
    <template #header-title>
      <div class="flex items-center gap-2">
        <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">Ulasan & Testimoni Pelanggan</h1>
        <span class="text-xs px-2.5 py-0.5 rounded-full bg-pink-100 text-[#DE0171] font-bold">
          {{ testimonials.total }} Total
        </span>
      </div>
    </template>

    <div class="space-y-5">
      <!-- Summary Stats & Actions -->
      <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
        <button
          type="button"
          @click="selectedStatus = ''"
          :class="[
            selectedStatus === '' ? 'bg-slate-900 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200/80',
            'p-4 rounded-2xl text-left transition'
          ]"
        >
          <div class="text-[11px] font-bold uppercase tracking-wider opacity-70">Semua Ulasan</div>
          <div class="text-xl font-black mt-1">{{ stats.total }}</div>
        </button>

        <button
          type="button"
          @click="selectedStatus = 'active'"
          :class="[
            selectedStatus === 'active' ? 'bg-[#DE0171] text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200/80',
            'p-4 rounded-2xl text-left transition'
          ]"
        >
          <div class="text-[11px] font-bold uppercase tracking-wider opacity-70">Aktif di Website</div>
          <div class="text-xl font-black mt-1">{{ stats.active }}</div>
        </button>

        <button
          type="button"
          @click="selectedStatus = 'inactive'"
          :class="[
            selectedStatus === 'inactive' ? 'bg-amber-500 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200/80',
            'p-4 rounded-2xl text-left transition col-span-2 sm:col-span-1'
          ]"
        >
          <div class="text-[11px] font-bold uppercase tracking-wider opacity-70">Disembunyikan</div>
          <div class="text-xl font-black mt-1">{{ stats.pending }}</div>
        </button>
      </div>

      <!-- Search & Add Bar -->
      <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="relative w-full sm:w-80">
          <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
            <i class="fa-solid fa-magnifying-glass text-xs"></i>
          </span>
          <input
            v-model="search"
            type="text"
            placeholder="Cari nama, instansi, paket, ulasan..."
            class="w-full pl-9 pr-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
          />
        </div>

        <button
          type="button"
          @click="openCreateModal"
          class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] hover:opacity-95 text-white font-bold text-xs shadow-sm transition"
        >
          <i class="fa-solid fa-plus text-xs"></i>
          <span>Tambah Testimoni Baru</span>
        </button>
      </div>

      <!-- Bulk Action Bar -->
      <div
        v-if="selectedIds.length > 0"
        class="p-3.5 bg-pink-50 border border-pink-200 rounded-2xl flex items-center justify-between shadow-xs animate-in fade-in"
      >
        <div class="flex items-center gap-2 text-xs font-bold text-[#DE0171]">
          <i class="fa-solid fa-check-double text-sm"></i>
          <span>{{ selectedIds.length }} ulasan dipilih</span>
        </div>
        <div class="flex items-center gap-2">
          <button
            type="button"
            @click="selectedIds = []; selectAll = false;"
            class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 text-xs font-semibold transition"
          >
            Batal
          </button>
          <button
            type="button"
            @click="bulkDelete"
            class="px-3.5 py-1.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold shadow-xs transition inline-flex items-center gap-1.5"
          >
            <i class="fa-solid fa-trash text-xs"></i>
            <span>Hapus Terpilih ({{ selectedIds.length }})</span>
          </button>
        </div>
      </div>

      <!-- Testimonials Table -->
      <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-left text-xs">
            <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-bold border-b border-slate-200/80">
              <tr>
                <th class="py-3.5 px-4 w-10 text-center">
                  <input
                    type="checkbox"
                    v-model="selectAll"
                    @change="toggleSelectAll"
                    class="w-4 h-4 rounded text-[#DE0171] focus:ring-[#DE0171] border-slate-300"
                    title="Pilih Semua di Halaman Ini"
                  />
                </th>
                <th class="py-3.5 px-4">Klien / Lembaga</th>
                <th class="py-3.5 px-4">Trip / Perjalanan</th>
                <th class="py-3.5 px-4 text-center">Rating</th>
                <th class="py-3.5 px-4">Isi Ulasan</th>
                <th class="py-3.5 px-4 text-center">Status</th>
                <th class="py-3.5 px-4 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              <tr
                v-for="item in testimonials.data"
                :key="item.id"
                class="hover:bg-slate-50/70 transition"
                :class="{ 'bg-pink-50/40': selectedIds.includes(item.id) }"
              >
                <td class="py-3.5 px-4 text-center">
                  <input
                    type="checkbox"
                    :value="item.id"
                    v-model="selectedIds"
                    class="w-4 h-4 rounded text-[#DE0171] focus:ring-[#DE0171] border-slate-300"
                  />
                </td>
                <td class="py-3.5 px-4">
                  <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full overflow-hidden bg-slate-100 border border-slate-200 shrink-0 flex items-center justify-center">
                      <img v-if="item.avatar_url" :src="item.avatar_url" :alt="item.client_name" class="w-full h-full object-cover" />
                      <i v-else class="fa-solid fa-user text-slate-400 text-xs"></i>
                    </div>
                    <div>
                      <div class="font-bold text-slate-900">{{ item.client_name }}</div>
                      <div class="text-[11px] text-slate-500">
                        {{ item.organization || item.role || 'Pelanggan Nirwana' }}
                      </div>
                    </div>
                  </div>
                </td>

                <td class="py-3.5 px-4">
                  <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 text-[11px] font-semibold">
                    <i class="fa-solid fa-map-location-dot text-[#DE0171] text-[10px]"></i>
                    {{ item.trip_name || 'Paket Wisata Umum' }}
                  </span>
                </td>

                <td class="py-3.5 px-4 text-center">
                  <div class="inline-flex items-center gap-0.5 text-amber-400">
                    <i v-for="i in 5" :key="i" class="fa-solid fa-star text-[11px]" :class="i <= item.rating ? 'text-amber-400' : 'text-slate-200'"></i>
                  </div>
                </td>

                <td class="py-3.5 px-4 max-w-xs">
                  <p class="text-slate-600 line-clamp-2 leading-relaxed">
                    "{{ item.comment }}"
                  </p>
                </td>

                <td class="py-3.5 px-4 text-center">
                  <button
                    type="button"
                    @click="toggleStatus(item)"
                    :class="[
                      item.is_active ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-slate-100 text-slate-600 border-slate-200',
                      'px-2.5 py-1 rounded-full text-[11px] font-bold border transition hover:opacity-80 inline-flex items-center gap-1.5'
                    ]"
                  >
                    <span class="w-1.5 h-1.5 rounded-full" :class="item.is_active ? 'bg-emerald-500' : 'bg-slate-400'"></span>
                    {{ item.is_active ? 'Tampil' : 'Draft' }}
                  </button>
                </td>

                <td class="py-3.5 px-4 text-right">
                  <div class="flex items-center justify-end gap-1.5">
                    <button
                      type="button"
                      @click="openEditModal(item)"
                      class="w-7 h-7 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition"
                      title="Edit Testimoni"
                    >
                      <i class="fa-solid fa-pen text-[10px]"></i>
                    </button>
                    <button
                      type="button"
                      @click="deleteItem(item)"
                      class="w-7 h-7 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 flex items-center justify-center transition"
                      title="Hapus Testimoni"
                    >
                      <i class="fa-solid fa-trash text-[10px]"></i>
                    </button>
                  </div>
                </td>
              </tr>

              <tr v-if="testimonials.data.length === 0">
                <td colspan="6" class="py-12 text-center text-slate-400">
                  <i class="fa-solid fa-comments text-3xl mb-2 text-slate-300"></i>
                  <p>Tidak ada testimoni yang sesuai pencarian.</p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <Pagination :data="testimonials" label="ulasan testimoni" />
      </div>
    </div>

    <!-- Create / Edit Modal -->
    <div v-if="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-xs">
      <div class="bg-white rounded-3xl border border-slate-200 shadow-2xl w-full max-w-lg overflow-hidden animate-in fade-in zoom-in-95 duration-150">
        <div class="px-6 py-4 bg-slate-50 border-b border-slate-200/80 flex items-center justify-between">
          <h3 class="font-extrabold text-sm text-slate-900">
            {{ editingTestimonial ? 'Edit Ulasan Klien' : 'Tambah Testimoni Baru' }}
          </h3>
          <button @click="closeModal" type="button" class="text-slate-400 hover:text-slate-600 transition">
            <i class="fa-solid fa-xmark text-sm"></i>
          </button>
        </div>

        <form @submit.prevent="submitForm" class="p-6 space-y-4 max-h-[80vh] overflow-y-auto">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Klien / Lembaga *</label>
            <input
              v-model="form.client_name"
              type="text"
              required
              placeholder="Contoh: Drs. Hendra Setiawan"
              class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-[#DE0171]"
            />
            <div v-if="form.errors.client_name" class="text-[11px] text-rose-600 mt-1">{{ form.errors.client_name }}</div>
          </div>

          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Instansi / Perusahaan</label>
              <input
                v-model="form.organization"
                type="text"
                placeholder="Contoh: SMAN 2 Bandar Lampung"
                class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-[#DE0171]"
              />
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Jabatan / Role</label>
              <input
                v-model="form.role"
                type="text"
                placeholder="Contoh: Wakil Kepala Sekolah"
                class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-[#DE0171]"
              />
            </div>
          </div>

          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Nama Trip / Paket</label>
              <input
                v-model="form.trip_name"
                type="text"
                placeholder="Contoh: Study Tour Jogja 2025"
                class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-[#DE0171]"
              />
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Rating Bintang *</label>
              <select
                v-model="form.rating"
                class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-[#DE0171]"
              >
                <option :value="5">⭐⭐⭐⭐⭐ (5 Bintang - Sempurna)</option>
                <option :value="4">⭐⭐⭐⭐ (4 Bintang - Sangat Baik)</option>
                <option :value="3">⭐⭐⭐ (3 Bintang - Baik)</option>
                <option :value="2">⭐⭐ (2 Bintang - Cukup)</option>
                <option :value="1">⭐ (1 Bintang - Kurang)</option>
              </select>
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Isi Testimoni / Ulasan *</label>
            <textarea
              v-model="form.comment"
              required
              rows="4"
              placeholder="Ceritakan pengalaman kepuasan pelanggan terhadap pelayanan Nirwana Tour..."
              class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-[#DE0171]"
            ></textarea>
            <div v-if="form.errors.comment" class="text-[11px] text-rose-600 mt-1">{{ form.errors.comment }}</div>
          </div>

          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Foto Klien / Logo (Opsional)</label>
              <input
                @input="form.avatar = $event.target.files[0]"
                type="file"
                accept="image/*"
                class="w-full text-xs text-slate-600 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-pink-50 file:text-[#DE0171]"
              />
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Urutan Tampilan</label>
              <input
                v-model="form.order"
                type="number"
                class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-[#DE0171]"
              />
            </div>
          </div>

          <div class="flex items-center gap-2 pt-2">
            <input
              v-model="form.is_active"
              type="checkbox"
              id="is_active_checkbox"
              class="w-4 h-4 rounded text-[#DE0171] focus:ring-[#DE0171] border-slate-300"
            />
            <label for="is_active_checkbox" class="text-xs font-bold text-slate-700">
              Tampilkan langsung di halaman beranda website
            </label>
          </div>

          <div class="pt-4 flex items-center justify-end gap-2 border-t border-slate-100">
            <button
              type="button"
              @click="closeModal"
              class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition"
            >
              Batal
            </button>
            <button
              type="submit"
              :disabled="form.processing"
              class="px-5 py-2 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] hover:opacity-95 text-white font-bold text-xs shadow-sm transition disabled:opacity-50"
            >
              {{ form.processing ? 'Menyimpan...' : (editingTestimonial ? 'Simpan Perubahan' : 'Tambah Testimoni') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>
