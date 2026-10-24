<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import Icon from '@/components/Icon.vue';
import Layout from '@/components/Layout.vue';
import StatusPill from '@/components/StatusPill.vue';
import { buttonClass } from '@/styles';
import type { Character, Episode } from '@/types';
import placeholder from '../../images/placeholder.jpeg';

const props = defineProps<{ character: Character; episodes: Episode[] }>();

const details = computed(() => ({
    Species: props.character.species,
    Type: props.character.type || '—',
    Gender: props.character.gender,
    Origin: props.character.origin,
    Location: props.character.location,
}));

const imageFailed = ref(false);
</script>

<template>
    <Layout :title="character.name">
        <div class="space-y-8">
            <Link
                href="/"
                :class="[buttonClass, 'inline-flex items-center gap-2 px-4 py-2 text-sm']"
            >
                <Icon name="chevron-left" />
                All characters
            </Link>

            <div class="grid gap-8 md:grid-cols-[300px_1fr]">
                <img
                    :src="imageFailed ? placeholder : character.image"
                    :alt="character.name"
                    class="aspect-square w-full rounded border-2 border-emerald-900 bg-neutral-800 object-cover"
                    @error="imageFailed = true"
                />

                <dl
                    class="grid grid-cols-[auto_1fr] items-center gap-x-6 gap-y-3 self-start rounded border-2 border-emerald-900 bg-neutral-900/90 p-5"
                >
                    <dt class="text-neutral-400">Status</dt>
                    <dd><StatusPill :status="character.status" /></dd>

                    <template v-for="(value, label) in details" :key="label">
                        <dt class="text-neutral-400">{{ label }}</dt>
                        <dd>{{ value }}</dd>
                    </template>
                </dl>
            </div>

            <section class="space-y-4">
                <h2 class="text-2xl font-semibold text-emerald-200">
                    Episodes ({{ episodes.length }})
                </h2>
                <ul
                    class="divide-y divide-emerald-900/60 rounded border-2 border-emerald-900 bg-neutral-900/90"
                    aria-label="Episodes"
                >
                    <li
                        v-for="episode in episodes"
                        :key="episode.id"
                        class="flex flex-wrap items-baseline gap-x-4 px-4 py-3"
                    >
                        <span class="w-16 font-mono text-sm text-emerald-500">
                            {{ episode.episode }}
                        </span>
                        <span class="flex-1">{{ episode.name }}</span>
                        <span class="text-sm text-neutral-400">{{ episode.airDate }}</span>
                    </li>
                </ul>
            </section>
        </div>
    </Layout>
</template>
