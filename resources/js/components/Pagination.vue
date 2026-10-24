<script setup lang="ts">
import Icon from '@/components/Icon.vue';

defineProps<{
    page: number;
    pages: number;
}>();
defineEmits<{
    change: [page: number];
}>();

const button =
    'cursor-pointer rounded-lg border-2 border-emerald-900 bg-neutral-900 p-2.5 transition hover:border-lime-600 hover:bg-emerald-950 disabled:pointer-events-none disabled:opacity-20';
</script>

<template>
    <nav
        data-testid="pagination"
        v-if="pages > 1"
        aria-label="Pagination"
        class="flex items-center gap-1"
    >
        <button
            type="button"
            :class="button"
            :disabled="page <= 1"
            aria-label="Previous page"
            @click="$emit('change', page - 1)"
        >
            <Icon name="chevron-left" />
        </button>

        <span class="min-w-14 text-center text-sm text-neutral-400 tabular-nums">
            {{ page }} / {{ pages }}
        </span>

        <button
            type="button"
            :class="button"
            :disabled="page >= pages"
            aria-label="Next page"
            @click="$emit('change', page + 1)"
        >
            <Icon name="chevron-right" />
        </button>
    </nav>
</template>
