<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

defineProps<{ appName: string }>();
</script>

<template>
    <Head title="Home" />
    <main class="flex min-h-screen items-center justify-center bg-slate-950 text-slate-100">
        <h1 class="text-4xl font-bold">{{ appName }}</h1>
    </main>
</template>
