<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  data: {
    type: Object,
    required: true,
  },
  label: {
    type: String,
    default: 'data',
  },
});
</script>

<template>
  <div
    v-if="data && (data.total > 0 || (data.links && data.links.length > 3))"
    class="px-4 py-3 bg-white border-t border-slate-200/80 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs"
  >
    <div class="text-slate-500 font-medium text-center sm:text-left">
      Menampilkan <span class="font-bold text-slate-900">{{ data.from || 0 }}</span> - <span class="font-bold text-slate-900">{{ data.to || 0 }}</span> dari total <span class="font-bold text-[#DE0171]">{{ data.total || 0 }}</span> {{ label }}
    </div>

    <div v-if="data.links && data.links.length > 3" class="flex flex-wrap items-center justify-center gap-1">
      <template v-for="(link, idx) in data.links" :key="idx">
        <Link
          v-if="link.url"
          :href="link.url"
          v-html="link.label"
          preserve-scroll
          preserve-state
          :class="[
            link.active
              ? 'bg-gradient-to-r from-[#DE0171] to-[#FC028B] text-white font-bold shadow-xs'
              : 'bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 hover:border-slate-300',
            'min-w-8 h-8 px-2.5 rounded-lg flex items-center justify-center transition font-medium select-none'
          ]"
        />
        <span
          v-else
          v-html="link.label"
          class="min-w-8 h-8 px-2.5 rounded-lg flex items-center justify-center text-slate-300 border border-slate-100 cursor-not-allowed select-none"
        />
      </template>
    </div>
  </div>
</template>
