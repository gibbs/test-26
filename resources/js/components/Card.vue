<script setup lang="ts">
import { computed, ref } from 'vue';
import Icon from '@/components/Icon.vue';
import type { CardDetail } from '@/types';
import placeholder from '../../images/placeholder.jpeg';

const props = defineProps<{
    title: string;
    details: CardDetail[];
    image?: string;
    srcset?: string;
}>();

defineSlots<{ badge?(): unknown }>();

const loaded = ref(false);
const failed = ref(false);

const src = computed(() => (failed.value ? placeholder : props.image));
</script>

<template>
    <article
        data-testid="card"
        class="overflow-hidden rounded border-2 border-emerald-900 bg-neutral-900/80 transition hover:border-lime-600"
    >
        <div v-if="image" class="relative aspect-square bg-neutral-800">
            <img
                :src="src"
                :srcset="failed ? undefined : srcset"
                sizes="(min-width: 1280px) 230px, (min-width: 1024px) 25vw, (min-width: 640px) 33vw, 50vw"
                :alt="title"
                class="h-full w-full object-cover transition-opacity duration-300"
                :class="loaded ? 'opacity-100' : 'opacity-0'"
                @load="loaded = true"
                @error="failed = true"
                loading="lazy"
            />
            <div v-if="$slots.badge" class="absolute right-2 bottom-2">
                <slot name="badge" />
            </div>
        </div>

        <div class="space-y-1.5 p-3">
            <h2 class="truncate text-xl font-normal text-white">{{ title }}</h2>
            <p
                v-for="detail in details"
                :key="detail.label"
                class="flex items-center gap-1 text-sm text-neutral-400"
            >
                <Icon :name="detail.icon" class="text-neutral-600" />
                <span class="sr-only">{{ detail.label }}:</span>
                <span class="truncate">{{ detail.text }}</span>
            </p>
        </div>
    </article>
</template>
