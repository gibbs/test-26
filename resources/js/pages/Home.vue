<script setup lang="ts">
import Layout from '@/components/Layout.vue';
import Pagination from '@/components/Pagination.vue';
import Results from '@/components/Results.vue';
import Card from '@/components/Card.vue';
import SelectFilter from '@/components/SelectFilter.vue';
import InputSearch from '@/components/InputSearch.vue';
import StatusPill from '@/components/StatusPill.vue';
import type { CardDetail, Character, Filters, Paginated } from '@/types';
import { useFilters } from '@/composables/useFilters';

const props = defineProps<{
    filters: Filters;
    characters: Paginated<Character>;
}>();
const { filters, page, loading, error, goToPage } = useFilters(
    {
        name: '',
        status: '',
        gender: '',
        type: '',
    },
    props.filters,
    'characters',
);

function details(character: Character): CardDetail[] {
    return [
        { icon: 'species', label: 'Species', text: character.species },
        { icon: 'gender', label: 'Gender', text: character.gender },
        { icon: 'location', label: 'Location', text: character.location },
    ];
}
</script>

<template>
    <Layout :title="$page.props.appName">
        <form
            role="search"
            aria-label="Filter characters"
            class="sticky top-0 z-10 mb-6 flex flex-wrap gap-3 border-b-2 border-emerald-900 border-dashed bg-neutral-950/90 py-5 sm:flex-nowrap"
            @submit.prevent
        >
            <InputSearch v-model="filters.name" label="Search characters" class="min-w-0 flex-1" />
            <Pagination
                :page="page"
                :pages="characters.pages"
                class="sm:order-last"
                @change="goToPage"
            />
            <div class="grid w-full grid-cols-2 gap-3 sm:flex sm:w-auto">
                <SelectFilter
                    v-model="filters.status"
                    label="Status"
                    :options="['Alive', 'Dead', 'Unknown']"
                />
                <SelectFilter
                    v-model="filters.gender"
                    label="Gender"
                    :options="['Female', 'Male', 'Genderless', 'Unknown']"
                />
            </div>
        </form>

        <Results :data="characters" :loading="loading" :error="error" v-slot="{ item }">
            <Card :title="item.name" :image="item.image" :details="details(item)">
                <template #badge>
                    <StatusPill :status="item.status" />
                </template>
            </Card>
        </Results>
    </Layout>
</template>
