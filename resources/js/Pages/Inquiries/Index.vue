<script setup>
import { ref, watch } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { route } from '@/routes';

const props = defineProps({
  inquiries: Object,
  filters: Object,
  statusCounts: Object,
});

const search = ref(props.filters.search);
const selectedStatus = ref(props.filters.status);

let searchTimer = null;
watch([search, selectedStatus], () => {
  clearTimeout(searchTimer);
  searchTimer = setTimeout(() => {
    router.get(
      route('admin.inquiries.index'),
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

const updateStatus = (inq, newStatus) => {
  router.patch(
    route('admin.inquiries.status', inq.id),
    { status: newStatus },
    { preserveScroll: true }
  );
};

const deleteInquiry = (inq) => {
  if (confirm(`Hapus data konsultasi dari "${inq.name}"?`)) {
    router.delete(route('admin.inquiries.destroy', inq.id));
  }
};

// Bulk Selection & Deletion
const selectedIds = ref([]);
const selectAll = ref(false);

const toggleSelectAll = () => {
  if (selectAll.value) {
    selectedIds.value = props.inquiries.data.map((item) => item.id);
  } else {
    selectedIds.value = [];
  }
};

watch(() => props.inquiries.data, () => {
  selectedIds.value = [];
  selectAll.value = false;
});

const bulkDelete = () => {
  if (selectedIds.value.length === 0) return;
  if (
    confirm(
      `Apakah Anda yakin ingin menghapus ${selectedIds.value.length} pesan konsultasi yang dipilih sekaligus? Tindakan ini tidak dapat dibatalkan.`
    )
  ) {
    router.post(
      route('admin.inquiries.bulk-delete'),
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
  <Head title="Pesan & Konsultasi Masuk" />

  <AdminLayout>
    <template #header-title>
      <div class="flex items-center gap-2">
        <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">Pesan & Konsultasi Masuk</h1>
        <span class="text-xs px-2.5 py-0.5 rounded-full bg-pink-100 text-[#DE0171] font-bold">
          {{ inquiries.total }} Pesan
        </span>
      </div>
    </template>

    <div class="space-y-5">
      <!-- Status Summary Tabs -->
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        <button
          type="button"
          @click="selectedStatus = ''"
          :class="[
            selectedStatus === '' ? 'bg-slate-900 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200/80',
            'p-4 rounded-2xl text-left transition'
          ]"
        >
          <div class="text-[11px] font-bold uppercase tracking-wider opacity-70">Semua Pesan</div>
          <div class="text-xl font-black mt-1">{{ statusCounts.all }}</div>
        </button>

        <button
          type="button"
          @click="selectedStatus = 'pending'"
          :class="[
            selectedStatus === 'pending' ? 'bg-amber-500 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200/80',
            'p-4 rounded-2xl text-left transition'
          ]"
        >
          <div class="text-[11px] font-bold uppercase tracking-wider opacity-70">Perlu Dihubungi</div>
          <div class="text-xl font-black mt-1">{{ statusCounts.pending }}</div>
        </button>

        <button
          type="button"
          @click="selectedStatus = 'contacted'"
          :class="[
            selectedStatus === 'contacted' ? 'bg-sky-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200/80',
            'p-4 rounded-2xl text-left transition'
          ]"
        >
          <div class="text-[11px] font-bold uppercase tracking-wider opacity-70">Sedang Diproses</div>
          <div class="text-xl font-black mt-1">{{ statusCounts.contacted }}</div>
        </button>

        <button
          type="button"
          @click="selectedStatus = 'completed'"
          :class="[
            selectedStatus === 'completed' ? 'bg-emerald-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200/80',
            'p-4 rounded-2xl text-left transition'
          ]"
        >
          <div class="text-[11px] font-bold uppercase tracking-wider opacity-70">Selesai / Deal</div>
          <div class="text-xl font-black mt-1">{{ statusCounts.completed }}</div>
        </button>
      </div>

      <!-- Search Toolbar -->
      <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="relative w-full sm:w-80">
          <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
            <i class="fa-solid fa-magnifying-glass text-xs"></i>
          </span>
          <input
            v-model="search"
            type="text"
            placeholder="Cari nama, no WhatsApp, email, pesan..."
            class="w-full pl-9 pr-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
          />
        </div>

        <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
          <a
            :href="route('admin.inquiries.export', selectedStatus ? `status=${selectedStatus}` : '')"
            class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 text-emerald-800 font-bold text-xs transition shadow-xs"
            title="Unduh data konsultasi dalam format CSV / Excel"
          >
            <i class="fa-solid fa-file-excel text-emerald-600 text-sm"></i>
            <span>Unduh CSV / Excel</span>
          </a>
        </div>
      </div>

      <!-- Bulk Action Bar -->
      <div
        v-if="selectedIds.length > 0"
        class="p-3.5 bg-pink-50 border border-pink-200 rounded-2xl flex items-center justify-between shadow-xs animate-in fade-in"
      >
        <div class="flex items-center gap-2 text-xs font-bold text-[#DE0171]">
          <i class="fa-solid fa-check-double text-sm"></i>
          <span>{{ selectedIds.length }} pesan konsultasi dipilih</span>
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

      <!-- Inquiries Table -->
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
                <th class="py-3.5 px-4">Pengirim / Klien</th>
                <th class="py-3.5 px-4">Paket Pilihan & Pax</th>
                <th class="py-3.5 px-4">Tgl Rencana</th>
                <th class="py-3.5 px-4">Isi Permintaan</th>
                <th class="py-3.5 px-4">Status</th>
                <th class="py-3.5 px-4">Diterima</th>
                <th class="py-3.5 px-4 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              <tr
                v-for="inq in inquiries.data"
                :key="inq.id"
                class="hover:bg-slate-50/70 transition"
                :class="{ 'bg-pink-50/40': selectedIds.includes(inq.id) }"
              >
                <td class="py-3.5 px-4 text-center">
                  <input
                    type="checkbox"
                    :value="inq.id"
                    v-model="selectedIds"
                    class="w-4 h-4 rounded text-[#DE0171] focus:ring-[#DE0171] border-slate-300"
                  />
                </td>
                <!-- Klien Info -->
                <td class="py-3.5 px-4">
                  <div class="font-bold text-slate-900 text-sm">{{ inq.name }}</div>
                  <div class="text-[11px] text-slate-500 flex items-center gap-2 mt-0.5">
                    <span><i class="fa-solid fa-phone text-slate-400 mr-1 text-[10px]"></i> {{ inq.phone }}</span>
                    <span v-if="inq.email">&bull; {{ inq.email }}</span>
                  </div>
                </td>

                <!-- Paket & Pax -->
                <td class="py-3.5 px-4">
                  <div class="font-semibold text-slate-800 line-clamp-1">{{ inq.package_title }}</div>
                  <div class="text-[11px] text-slate-500 mt-0.5">
                    <i class="fa-solid fa-users text-[#DE0171] mr-1 text-[10px]"></i> {{ inq.participants }} Orang
                  </div>
                </td>

                <!-- Tgl Rencana -->
                <td class="py-3.5 px-4 text-slate-700 font-medium">
                  {{ inq.travel_date }}
                </td>

                <!-- Pesan -->
                <td class="py-3.5 px-4 max-w-xs">
                  <p class="text-slate-600 line-clamp-2 italic">
                    "{{ inq.message || 'Tanpa catatan tambahan' }}"
                  </p>
                </td>

                <!-- Status Dropdown -->
                <td class="py-3.5 px-4">
                  <select
                    :value="inq.status"
                    @change="updateStatus(inq, $event.target.value)"
                    :class="[
                      inq.status === 'pending' ? 'bg-amber-50 text-amber-800 border-amber-200' :
                      inq.status === 'contacted' ? 'bg-sky-50 text-sky-800 border-sky-200' :
                      inq.status === 'completed' ? 'bg-emerald-50 text-emerald-800 border-emerald-200' :
                      'bg-slate-50 text-slate-700 border-slate-200',
                      'text-xs font-bold py-1 px-2.5 rounded-lg border focus:outline-none cursor-pointer'
                    ]"
                  >
                    <option value="pending">Menunggu</option>
                    <option value="contacted">Dihubungi</option>
                    <option value="completed">Selesai</option>
                    <option value="cancelled">Batal</option>
                  </select>
                </td>

                <!-- Waktu Diterima -->
                <td class="py-3.5 px-4 text-slate-400 text-[11px]">
                  {{ inq.created_at }}
                </td>

                <!-- Aksi (WhatsApp & Delete) -->
                <td class="py-3.5 px-4 text-right">
                  <div class="inline-flex items-center gap-1.5">
                    <a
                      :href="inq.whatsapp_url"
                      target="_blank"
                      title="Hubungi via WhatsApp"
                      class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 font-bold text-xs transition"
                    >
                      <i class="fa-brands fa-whatsapp text-sm"></i>
                      <span class="hidden sm:inline">Balas</span>
                    </a>
                    <button
                      type="button"
                      @click="deleteInquiry(inq)"
                      title="Hapus Pesan"
                      class="w-7 h-7 rounded-lg flex items-center justify-center text-slate-400 hover:text-rose-600 hover:bg-rose-50"
                    >
                      <i class="fa-solid fa-trash-can text-xs"></i>
                    </button>
                  </div>
                </td>
              </tr>

              <tr v-if="inquiries.data.length === 0">
                <td colspan="7" class="p-8 text-center text-slate-400">
                  Tidak ada pesan masuk yang sesuai dengan kriteria filter.
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <Pagination :data="inquiries" label="pesan konsultasi" />
      </div>
    </div>
  </AdminLayout>
</template>
