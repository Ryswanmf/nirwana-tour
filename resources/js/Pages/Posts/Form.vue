<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import RichTextToolbar from '@/Components/RichTextToolbar.vue';
import { route } from '@/routes';

const props = defineProps({
  post: Object,
  categories: Array,
});

const isEditing = Boolean(props.post);

const form = useForm({
  title: props.post?.title ?? '',
  slug: props.post?.slug ?? '',
  category_id: props.post?.category_id ?? '',
  category_name: props.post?.category_name ?? '',
  author_name: props.post?.author_name ?? 'Admin Nirwana',
  excerpt: props.post?.excerpt ?? '',
  content: props.post?.content ?? '',
  is_published: props.post?.is_published ?? true,
  is_featured: props.post?.is_featured ?? false,
  cover_image: null,
});

const coverPreview = ref(props.post?.cover_image_url ?? null);

const handleCoverChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    form.cover_image = file;
    coverPreview.value = URL.createObjectURL(file);
  }
};

const submit = () => {
  if (isEditing) {
    form.transform((data) => ({ ...data, _method: 'PUT' }))
      .post(route('admin.posts.update', props.post.id));
  } else {
    form.post(route('admin.posts.store'));
  }
};
</script>

<template>
  <Head :title="isEditing ? `Edit: ${form.title}` : 'Tulis Artikel Baru'" />

  <AdminLayout>
    <template #header-title>
      <div class="flex items-center gap-2">
        <Link :href="route('admin.posts.index')" class="text-slate-400 hover:text-slate-700">
          <i class="fa-solid fa-arrow-left text-xs"></i>
        </Link>
        <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">
          {{ isEditing ? 'Edit Artikel' : 'Tulis Artikel & Tips Wisata Baru' }}
        </h1>
      </div>
    </template>

    <form @submit.prevent="submit" class="space-y-6 max-w-4xl">
      <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">
            Judul Artikel <span class="text-rose-500">*</span>
          </label>
          <input
            v-model="form.title"
            type="text"
            required
            placeholder="Contoh: 7 Spot Snorkeling Terbaik di Pulau Pahawang Lampung"
            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
          />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Kategori Artikel</label>
            <select
              v-model="form.category_id"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
            >
              <option value="">Pilih Kategori</option>
              <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
            </select>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Penulis</label>
            <input
              v-model="form.author_name"
              type="text"
              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
            />
          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Ringkasan Singkat (Excerpt)</label>
          <textarea
            v-model="form.excerpt"
            rows="2"
            placeholder="Kutipan pembuka yang menarik untuk kartu artikel..."
            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171]"
          ></textarea>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">
            Isi Konten Artikel <span class="text-rose-500">*</span>
          </label>
          <RichTextToolbar textarea-id="post_content" />
          <textarea
            id="post_content"
            v-model="form.content"
            rows="12"
            required
            placeholder="Tulis artikel lengkap di sini (mendukung paragraf, tips perjalanan, rute, dll)..."
            class="w-full px-3.5 py-2.5 rounded-b-xl border border-slate-200 text-sm text-slate-900 focus:outline-none focus:border-[#DE0171] font-mono leading-relaxed"
          ></textarea>
        </div>
      </div>

      <!-- Foto Cover -->
      <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Foto Sampul Artikel</h3>
        <div class="flex flex-col sm:flex-row items-center gap-6">
          <div class="w-36 h-28 rounded-2xl bg-slate-100 border-2 border-dashed border-slate-300 overflow-hidden flex items-center justify-center shrink-0">
            <img v-if="coverPreview" :src="coverPreview" alt="Preview" class="w-full h-full object-cover" />
            <div v-else class="text-center text-slate-400 p-2 text-xs">Belum ada foto</div>
          </div>
          <div class="space-y-2 flex-1">
            <input
              type="file"
              accept="image/*"
              @change="handleCoverChange"
              class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-pink-50 file:text-[#DE0171]"
            />
            <p class="text-[11px] text-slate-400">JPG, PNG, atau WEBP. Maksimal 3MB.</p>
          </div>
        </div>
      </div>

      <!-- Footer Action -->
      <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center gap-6">
          <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-800 select-none">
            <input type="checkbox" v-model="form.is_published" class="rounded text-[#DE0171] focus:ring-[#DE0171]" />
            <span>Terbitkan Sekarang (Publik)</span>
          </label>
          <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-800 select-none">
            <input type="checkbox" v-model="form.is_featured" class="rounded text-amber-500 focus:ring-amber-500" />
            <span>Artikel Pilihan / Unggulan</span>
          </label>
        </div>

        <div class="flex items-center gap-3">
          <Link :href="route('admin.posts.index')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-700">
            Batal
          </Link>
          <button
            type="submit"
            :disabled="form.processing"
            class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white text-xs font-bold shadow-md shadow-[#DE0171]/25 hover:opacity-95"
          >
            {{ isEditing ? 'Simpan Perubahan' : 'Terbitkan Artikel' }}
          </button>
        </div>
      </div>
    </form>
  </AdminLayout>
</template>
