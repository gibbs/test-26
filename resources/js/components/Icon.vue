<script setup lang="ts">
import type { IconName } from '@/types';

defineProps<{ name: IconName }>();
</script>

<template>
    <svg
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="1.75"
        stroke-linecap="round"
        stroke-linejoin="round"
        aria-hidden="true"
        class="size-4 shrink-0"
    >
        <!-- Map pin -->
        <template v-if="name === 'location'">
            <path d="M12 21s-7-6.2-7-11.5a7 7 0 0 1 14 0C19 14.8 12 21 12 21Z" />
            <circle cx="12" cy="9.5" r="2.5" />
        </template>

        <!-- Combined male/female symbol -->
        <template v-else-if="name === 'gender'">
            <circle cx="10" cy="13" r="5" />
            <path d="M13.5 9.5 20 3M15 3h5v5M10 18v4M8 20h4" />
        </template>

        <!-- DNA helix -->
        <template v-else-if="name === 'species'">
            <path d="M7 2c0 5 10 5 10 10S7 17 7 22M17 2c0 5-10 5-10 10s10 5 10 10" />
            <path d="M9 5.5h6M9 18.5h6" />
        </template>

        <template v-else-if="name === 'chevron-left'">
            <path d="m15 18-6-6 6-6" />
        </template>

        <template v-else-if="name === 'chevron-right'">
            <path d="m9 18 6-6-6-6" />
        </template>
    </svg>
</template>
