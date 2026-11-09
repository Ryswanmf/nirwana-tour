<script setup>
import { ref, watch } from 'vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { route } from '@/routes';

const props = defineProps({
  users: Object,
  filters: Object,
  currentAdminId: Number,
});

const search = ref(props.filters.search || '');

let searchTimer = null;
watch(search, () => {
  clearTimeout(searchTimer);
  searchTimer = setTimeout(() => {
    router.get(
      route('admin.users.index'),
      { search: search.value },
      { preserveState: true, replace: true }
    );
  }, 300);
});

// Modal State
const isModalOpen = ref(false);
const editingUser = ref(null);

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const openCreateModal = () => {
  editingUser.value = null;
  form.reset();
  form.clearErrors();
  isModalOpen.value = true;
};

const openEditModal = (user) => {
  editingUser.value = user;
  form.reset();
  form.clearErrors();
  form.name = user.name;
  form.email = user.email;
  isModalOpen.value = true;
};

const closeModal = () => {
  isModalOpen.value = false;
  editingUser.value = null;
  form.reset();
  form.clearErrors();
};

const submitForm = () => {
  if (editingUser.value) {
    form.put(route('admin.users.update', editingUser.value.id), {
      onSuccess: () => closeModal(),
    });
  } else {
    form.post(route('admin.users.store'), {
      onSuccess: () => closeModal(),
    });
  }
};

const deleteUser = (user) => {
  if (user.id === props.currentAdminId) {
    alert('Anda tidak dapat menghapus akun Anda sendiri.');
    return;
  }

  if (confirm(`Apakah Anda yakin ingin menghapus akun admin "${user.name}" (${user.email})?`)) {
    router.delete(route('admin.users.destroy', user.id));
  }
};

const getInitials = (name) => {
  if (!name) return 'A';
  const parts = name.trim().split(' ');
  if (parts.length >= 2) {
    return (parts[0][0] + parts[1][0]).toUpperCase();
  }
  return name.substring(0, 2).toUpperCase();
};
</script>

<template>
  <Head title="Kelola Pengguna Administrator" />

  <AdminLayout>
    <template #header-title>
      <div class="flex items-center gap-2">
        <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">Kelola Pengguna Administrator</h1>
        <span class="text-xs px-2.5 py-0.5 rounded-full bg-pink-100 text-[#DE0171] font-bold">
          {{ users.total }} Admin Terdaftar
        </span>
      </div>
    </template>

    <div class="space-y-5">
      <!-- Search & Action Toolbar -->
      <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="relative w-full sm:w-80">
          <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
            <i class="fa-solid fa-magnifying-glass text-xs"></i>
          </span>
          <input
            v-model="search"
            type="text"
            placeholder="Cari nama atau email admin..."
            class="w-full pl-9 pr-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
          />
        </div>

        <button
          type="button"
          @click="openCreateModal"
          class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] hover:opacity-95 text-white font-bold text-xs shadow-sm transition"
        >
          <i class="fa-solid fa-user-plus text-xs"></i>
          <span>Tambah Admin Baru</span>
        </button>
      </div>

      <!-- Users Table -->
      <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-left text-xs">
            <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-bold border-b border-slate-200/80">
              <tr>
                <th class="py-3.5 px-4">Nama Administrator</th>
                <th class="py-3.5 px-4">Alamat Email</th>
                <th class="py-3.5 px-4">Terdaftar Sejak</th>
                <th class="py-3.5 px-4 text-center">Status Sesi</th>
                <th class="py-3.5 px-4 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
              <tr v-for="user in users.data" :key="user.id" class="hover:bg-slate-50/70 transition">
                <td class="py-3.5 px-4">
                  <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-[#DE0171] to-slate-800 text-white font-black text-xs flex items-center justify-center shrink-0 shadow-xs">
                      {{ getInitials(user.name) }}
                    </div>
                    <div>
                      <div class="font-bold text-slate-900 flex items-center gap-1.5">
                        <span>{{ user.name }}</span>
                        <span v-if="user.is_current_user" class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-[10px] font-extrabold border border-emerald-200">
                          Akun Anda
                        </span>
                      </div>
                      <div class="text-[11px] text-slate-400">ID Pengguna: #{{ user.id }}</div>
                    </div>
                  </div>
                </td>

                <td class="py-3.5 px-4 font-mono text-slate-600">
                  {{ user.email }}
                </td>

                <td class="py-3.5 px-4 text-slate-500">
                  {{ user.created_at }}
                </td>

                <td class="py-3.5 px-4 text-center">
                  <span
                    :class="[
                      user.is_current_user ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-slate-100 text-slate-600 border-slate-200',
                      'px-2.5 py-1 rounded-full text-[11px] font-bold border inline-flex items-center gap-1.5'
                    ]"
                  >
                    <span class="w-1.5 h-1.5 rounded-full" :class="user.is_current_user ? 'bg-emerald-500' : 'bg-slate-400'"></span>
                    {{ user.is_current_user ? 'Aktif Sekarang' : 'Administrator' }}
                  </span>
                </td>

                <td class="py-3.5 px-4 text-right">
                  <div class="flex items-center justify-end gap-1.5">
                    <button
                      type="button"
                      @click="openEditModal(user)"
                      class="w-7 h-7 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition"
                      title="Edit Data Admin"
                    >
                      <i class="fa-solid fa-pen text-[10px]"></i>
                    </button>

                    <button
                      v-if="!user.is_current_user"
                      type="button"
                      @click="deleteUser(user)"
                      class="w-7 h-7 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 flex items-center justify-center transition"
                      title="Hapus Akun Admin"
                    >
                      <i class="fa-solid fa-trash text-[10px]"></i>
                    </button>
                    <span
                      v-else
                      class="w-7 h-7 rounded-lg bg-slate-100 text-slate-300 flex items-center justify-center cursor-not-allowed"
                      title="Tidak dapat menghapus akun sendiri"
                    >
                      <i class="fa-solid fa-lock text-[10px]"></i>
                    </span>
                  </div>
                </td>
              </tr>

              <tr v-if="users.data.length === 0">
                <td colspan="5" class="py-12 text-center text-slate-400">
                  <i class="fa-solid fa-user-slash text-3xl mb-2 text-slate-300"></i>
                  <p>Tidak ada pengguna yang sesuai kata kunci pencarian.</p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <Pagination :data="users" label="admin" />
      </div>
    </div>

    <!-- Create / Edit User Modal -->
    <div v-if="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-xs">
      <div class="bg-white rounded-3xl border border-slate-200 shadow-2xl w-full max-w-md overflow-hidden animate-in fade-in zoom-in-95 duration-150">
        <div class="px-6 py-4 bg-slate-50 border-b border-slate-200/80 flex items-center justify-between">
          <h3 class="font-extrabold text-sm text-slate-900">
            {{ editingUser ? 'Edit Akun Administrator' : 'Tambah Administrator Baru' }}
          </h3>
          <button @click="closeModal" type="button" class="text-slate-400 hover:text-slate-600 transition">
            <i class="fa-solid fa-xmark text-sm"></i>
          </button>
        </div>

        <form @submit.prevent="submitForm" class="p-6 space-y-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap *</label>
            <input
              v-model="form.name"
              type="text"
              required
              placeholder="Contoh: Budi Santoso"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
            <div v-if="form.errors.name" class="text-[11px] text-rose-600 mt-1">{{ form.errors.name }}</div>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Email Login *</label>
            <input
              v-model="form.email"
              type="email"
              required
              placeholder="admin@nirwanatour.com"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
            <div v-if="form.errors.email" class="text-[11px] text-rose-600 mt-1">{{ form.errors.email }}</div>
          </div>

          <div>
            <div class="flex items-center justify-between mb-1">
              <label class="block text-xs font-bold text-slate-700">
                Password {{ editingUser ? '(Opsional)' : '*' }}
              </label>
              <span v-if="editingUser" class="text-[10px] text-slate-400">Kosongkan jika tak diubah</span>
            </div>
            <input
              v-model="form.password"
              type="password"
              :required="!editingUser"
              placeholder="Minimal 8 karakter..."
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
            <div v-if="form.errors.password" class="text-[11px] text-rose-600 mt-1">{{ form.errors.password }}</div>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">
              Konfirmasi Password {{ editingUser ? '(Opsional)' : '*' }}
            </label>
            <input
              v-model="form.password_confirmation"
              type="password"
              :required="Boolean(form.password)"
              placeholder="Ulangi password di atas..."
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
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
              {{ form.processing ? 'Menyimpan...' : (editingUser ? 'Perbarui Akun' : 'Buat Akun Admin') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>
