<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

defineProps<{ title: string }>();
</script>

<template>
    <div data-testid="layout">
        <Head :title="title" />
        <h1>{{ title }}</h1>
        <slot />
    </div>
</template>
