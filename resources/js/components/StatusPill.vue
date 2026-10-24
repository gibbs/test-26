<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps<{ status: string }>();

const styles: Record<string, string> = {
    alive: 'bg-emerald-950/90 text-emerald-300 ring-emerald-700',
    dead: 'bg-red-950/90 text-red-300 ring-red-700',
    unknown: 'bg-neutral-900/90 text-neutral-300 ring-neutral-600',
};

const style = computed(function () {
    return styles[props.status.toLowerCase()] ?? styles.unknown;
});
</script>

<template>
    <span
        data-testid="status-pill"
        class="inline-flex items-center gap-1 rounded-lg px-2 py-1 text-xs font-semibold capitalize ring-1"
        :class="style"
    >
        <span class="size-1.5 rounded-full bg-current" aria-hidden="true" />
        {{ status }}
    </span>
</template>
