<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import background from '../../images/bg.jpg';

defineProps<{ title: string }>();
</script>

<template>
    <div data-testid="layout" class="mx-auto max-w-7xl px-4 sm:px-8">
        <Head :title="title" />

        <div aria-hidden="true" class="pointer-events-none fixed inset-0 -z-10">
            <div
                class="absolute inset-0 bg-cover bg-center opacity-35 saturate-70"
                :style="{ backgroundImage: `url(${background})` }"
            />
            <div class="absolute inset-0 bg-linear-to-b from-transparent to-neutral-950" />
        </div>

        <header class="pt-4 pb-6 sm:pt-12">
            <h1
                class="text-center text-5xl font-semibold tracking-tight text-emerald-200 text-shadow-lg text-shadow-black/60"
            >
                <Link href="/">{{ title }}</Link>
            </h1>
        </header>
        <main class="pb-12">
            <slot />
        </main>
    </div>
</template>
