<script setup lang="ts" generic="TItem extends { id: number }">
import Pagination from '@/components/Pagination.vue';
import type { Paginated } from '@/types';

defineProps<{
    data: Paginated<TItem>;
    loading: boolean;
    page: number;
    error?: string | null;
}>();
defineEmits<{
    change: [page: number];
}>();
defineSlots<{ default(props: { item: TItem }): unknown }>();
</script>

<template>
    <div>
        <p v-if="error">{{ error }}</p>
        <section data-testid="results">
            <p v-if="!data.results.length">No results found.</p>
            <template v-else>
                <div>
                    <template v-for="item in data.results" :key="item.id">
                        <slot :item="item" />
                    </template>
                </div>

                <Pagination :page="page" :pages="data.pages" @change="$emit('change', $event)" />
            </template>
        </section>
    </div>
</template>
