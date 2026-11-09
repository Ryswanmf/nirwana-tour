<script setup>
import { ref } from 'vue';
import { useForm, Head } from '@inertiajs/vue3';

const showPassword = ref(false);

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post('/admin/login', {
    onFinish: () => form.reset('password'),
  });
};
</script>

<template>
  <Head title="Masuk Portal Admin" />

  <div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-[#36021B] flex items-center justify-center p-4 selection:bg-[#DE0171] selection:text-white">
    <!-- Card Container -->
    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden">
      <!-- Top Header Branding -->
      <div class="p-8 pb-6 text-center bg-radial from-pink-50/60 to-white border-b border-slate-100 relative">
        <div class="w-16 h-16 mx-auto mb-4 p-2.5 rounded-2xl bg-white shadow-lg shadow-pink-500/10 border border-pink-100 flex items-center justify-center">
          <img :src="'/assets/logo/Logo-Nirwana.png'" alt="Nirwana Tour Lampung" class="w-full h-full object-contain" />
        </div>
        <h1 class="text-xl font-black text-slate-900 tracking-tight">
          Nirwana <span class="text-[#DE0171]">Admin</span>
        </h1>
        <p class="text-xs text-slate-600 mt-1">Portal Manajemen Resmi Nirwana Tour Lampung</p>
      </div>

      <!-- Login Form -->
      <form @submit.prevent="submit" class="p-8 pt-6 space-y-5">
        <!-- Flash Info / Logout Message -->
        <div v-if="$page.props.flash?.info" class="p-3.5 rounded-xl bg-sky-50 border border-sky-200 text-sky-800 text-xs flex items-center gap-2.5 animate-in fade-in">
          <i class="fa-solid fa-circle-info text-sky-500 text-sm shrink-0"></i>
          <span>{{ $page.props.flash.info }}</span>
        </div>

        <div v-if="$page.props.flash?.success" class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-2.5 animate-in fade-in">
          <i class="fa-solid fa-circle-check text-emerald-500 text-sm shrink-0"></i>
          <span>{{ $page.props.flash.success }}</span>
        </div>

        <!-- Error General / Banner -->
        <div v-if="form.errors.email || form.errors.password" class="p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs flex items-center gap-2.5">
          <i class="fa-solid fa-circle-exclamation text-rose-500 text-sm shrink-0"></i>
          <span>{{ form.errors.email || form.errors.password }}</span>
        </div>

        <!-- Field Email -->
        <div>
          <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
            Alamat Email
          </label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
              <i class="fa-solid fa-envelope text-xs"></i>
            </span>
            <input
              id="email"
              v-model="form.email"
              type="email"
              required
              autofocus
              placeholder="admin@nirwanatour.com"
              class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171] focus:ring-2 focus:ring-[#DE0171]/20 transition"
            />
          </div>
        </div>

        <!-- Field Password -->
        <div>
          <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
            Kata Sandi
          </label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
              <i class="fa-solid fa-lock text-xs"></i>
            </span>
            <input
              id="password"
              v-model="form.password"
              :type="showPassword ? 'text' : 'password'"
              required
              placeholder="••••••••"
              class="w-full pl-10 pr-10 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171] focus:ring-2 focus:ring-[#DE0171]/20 transition"
            />
            <button
              type="button"
              @click="showPassword = !showPassword"
              class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 transition"
              title="Lihat / Sembunyikan Sandi"
            >
              <i :class="showPassword ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'" class="text-xs"></i>
            </button>
          </div>
        </div>

        <!-- Remember Me Checkbox -->
        <div class="flex items-center justify-between text-xs">
          <label class="flex items-center gap-2 cursor-pointer select-none text-slate-600">
            <input
              type="checkbox"
              v-model="form.remember"
              class="rounded border-slate-300 text-[#DE0171] focus:ring-[#DE0171]"
            />
            <span>Ingat saya di perangkat ini</span>
          </label>

          <a href="/" class="text-slate-500 hover:text-[#DE0171] transition font-medium">
            Ke Beranda &rarr;
          </a>
        </div>

        <!-- Submit Button -->
        <button
          type="submit"
          :disabled="form.processing"
          class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] hover:opacity-95 text-white font-bold text-sm tracking-wide shadow-lg shadow-[#DE0171]/30 transition transform active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
        >
          <i v-if="form.processing" class="fa-solid fa-circle-notch fa-spin text-sm"></i>
          <span>{{ form.processing ? 'Memverifikasi...' : 'Masuk ke Portal Admin' }}</span>
        </button>
      </form>

      <!-- Footer Info -->
      <div class="px-8 py-4 bg-slate-50/80 border-t border-slate-100 text-center">
        <p class="text-[11px] text-slate-600 font-medium">
          &copy; {{ new Date().getFullYear() }} Nirwana Tour Lampung. Hak Cipta Dilindungi.
        </p>
      </div>
    </div>
  </div>
</template>
