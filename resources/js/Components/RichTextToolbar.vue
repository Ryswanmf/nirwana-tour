<script setup>
const props = defineProps({
  textareaId: {
    type: String,
    required: true,
  },
});

const emit = defineEmits(['insert']);

const applyFormat = (type) => {
  const textarea = document.getElementById(props.textareaId);
  if (!textarea) return;

  const start = textarea.selectionStart;
  const end = textarea.selectionEnd;
  const selectedText = textarea.value.substring(start, end);
  let replacement = '';

  switch (type) {
    case 'bold':
      replacement = `<strong>${selectedText || 'Teks Tebal'}</strong>`;
      break;
    case 'italic':
      replacement = `<em>${selectedText || 'Teks Miring'}</em>`;
      break;
    case 'h2':
      replacement = `\n<h2>${selectedText || 'Subjudul H2 Utama'}</h2>\n`;
      break;
    case 'h3':
      replacement = `\n<h3>${selectedText || 'Subjudul H3 Detail'}</h3>\n`;
      break;
    case 'ul':
      replacement = `\n<ul>\n  <li>${selectedText || 'Poin pertama'}</li>\n  <li>Poin kedua</li>\n</ul>\n`;
      break;
    case 'ol':
      replacement = `\n<ol>\n  <li>${selectedText || 'Langkah satu'}</li>\n  <li>Langkah dua</li>\n</ol>\n`;
      break;
    case 'quote':
      replacement = `\n<blockquote>"${selectedText || 'Kutipan atau poin penting perjalanan'}"</blockquote>\n`;
      break;
    case 'table':
      replacement = `\n<table>\n  <thead>\n    <tr>\n      <th>Hari</th>\n      <th>Tujuan Wisata</th>\n      <th>Fasilitas</th>\n    </tr>\n  </thead>\n  <tbody>\n    <tr>\n      <td>Hari 1</td>\n      <td>Teluk Kiluan / Pahawang</td>\n      <td>Snorkeling & Makan Siang</td>\n    </tr>\n  </tbody>\n</table>\n`;
      break;
    case 'link':
      replacement = `<a href="https://nirwanatourlampung.com">${selectedText || 'Teks Tautan'}</a>`;
      break;
    default:
      return;
  }

  // Update value in DOM and emit input event so v-model updates cleanly
  const currentVal = textarea.value;
  textarea.value = currentVal.substring(0, start) + replacement + currentVal.substring(end);
  textarea.focus();
  textarea.setSelectionRange(start + replacement.length, start + replacement.length);

  textarea.dispatchEvent(new Event('input', { bubbles: true }));
};
</script>

<template>
  <div class="flex flex-wrap items-center gap-1.5 p-2 bg-slate-100 rounded-t-xl border border-b-0 border-slate-200 text-xs">
    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mr-1 select-none">
      <i class="fa-solid fa-wand-magic-sparkles text-[#DE0171] mr-1"></i> Format:
    </span>

    <button
      type="button"
      @click="applyFormat('h2')"
      class="px-2 py-1 rounded bg-white hover:bg-slate-200 border border-slate-200 text-slate-800 font-extrabold text-[11px] transition"
      title="Subjudul H2"
    >
      H2
    </button>

    <button
      type="button"
      @click="applyFormat('h3')"
      class="px-2 py-1 rounded bg-white hover:bg-slate-200 border border-slate-200 text-slate-800 font-extrabold text-[11px] transition"
      title="Subjudul H3"
    >
      H3
    </button>

    <div class="h-4 w-px bg-slate-300 mx-0.5"></div>

    <button
      type="button"
      @click="applyFormat('bold')"
      class="w-7 h-6 rounded bg-white hover:bg-slate-200 border border-slate-200 text-slate-800 font-black text-xs transition flex items-center justify-center"
      title="Teks Tebal (Bold)"
    >
      <i class="fa-solid fa-bold text-[11px]"></i>
    </button>

    <button
      type="button"
      @click="applyFormat('italic')"
      class="w-7 h-6 rounded bg-white hover:bg-slate-200 border border-slate-200 text-slate-800 italic font-bold text-xs transition flex items-center justify-center"
      title="Teks Miring (Italic)"
    >
      <i class="fa-solid fa-italic text-[11px]"></i>
    </button>

    <div class="h-4 w-px bg-slate-300 mx-0.5"></div>

    <button
      type="button"
      @click="applyFormat('ul')"
      class="px-2 py-1 rounded bg-white hover:bg-slate-200 border border-slate-200 text-slate-800 text-[11px] transition flex items-center gap-1"
      title="Daftar Poin (Bullet List)"
    >
      <i class="fa-solid fa-list-ul text-[10px]"></i>
      <span class="text-[10px] font-semibold">List</span>
    </button>

    <button
      type="button"
      @click="applyFormat('ol')"
      class="px-2 py-1 rounded bg-white hover:bg-slate-200 border border-slate-200 text-slate-800 text-[11px] transition flex items-center gap-1"
      title="Daftar Angka (Numbered List)"
    >
      <i class="fa-solid fa-list-ol text-[10px]"></i>
      <span class="text-[10px] font-semibold">Angka</span>
    </button>

    <button
      type="button"
      @click="applyFormat('quote')"
      class="w-7 h-6 rounded bg-white hover:bg-slate-200 border border-slate-200 text-slate-800 text-xs transition flex items-center justify-center"
      title="Kutipan (Quote)"
    >
      <i class="fa-solid fa-quote-left text-[10px]"></i>
    </button>

    <button
      type="button"
      @click="applyFormat('table')"
      class="px-2 py-1 rounded bg-white hover:bg-slate-200 border border-slate-200 text-slate-800 text-[11px] transition flex items-center gap-1"
      title="Sisipkan Tabel Rapi"
    >
      <i class="fa-solid fa-table text-[10px] text-emerald-600"></i>
      <span class="text-[10px] font-semibold">Tabel</span>
    </button>

    <button
      type="button"
      @click="applyFormat('link')"
      class="w-7 h-6 rounded bg-white hover:bg-slate-200 border border-slate-200 text-slate-800 text-xs transition flex items-center justify-center"
      title="Sisipkan Tautan / Link"
    >
      <i class="fa-solid fa-link text-[10px] text-sky-600"></i>
    </button>
  </div>
</template>
