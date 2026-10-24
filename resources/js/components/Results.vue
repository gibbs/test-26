<script setup lang="ts" generic="TItem extends { id: number }">
import type { Paginated } from '@/types';

defineProps<{
    data: Paginated<TItem>;
    loading: boolean;
    error?: string | null;
}>();
defineSlots<{ default(props: { item: TItem }): unknown }>();
</script>

<template>
    <div class="space-y-6">
        <p v-if="error" role="alert" class="rounded-lg bg-red-950 p-3 text-sm text-red-200">
            {{ error }}
        </p>
        <section
            data-testid="results"
            :aria-busy="loading"
            class="transition-opacity"
            :class="loading ? 'opacity-50' : 'opacity-100'"
        >
            <p v-if="!data.results.length" class="text-neutral-400">No results found.</p>
            <template v-else>
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                    <template v-for="item in data.results" :key="item.id">
                        <slot :item="item" />
                    </template>
                </div>
            </template>
        </section>
    </div>
</template>
