<script setup lang="ts">
import Layout from '@/components/Layout.vue';
import Results from '@/components/Results.vue';
import Card from '@/components/Card.vue';
import SelectFilter from '@/components/SelectFilter.vue';
import InputSearch from '@/components/InputSearch.vue';
import type { Character, Filters, Paginated } from '@/types';
import { useFilters } from '@/composables/useFilters';

const props = defineProps<{
    filters: Filters;
    characters: Paginated<Character>;
}>();
const { filters, page, loading, error, visit } = useFilters(
    {
        name: '',
        status: '',
        gender: '',
        type: '',
    },
    props.filters,
    'characters',
);
</script>

<template>
    <Layout :title="$page.props.appName">
        <div>
            <InputSearch v-model="filters.name" label="Search characters" />
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

        <Results
            :data="characters"
            :loading="loading"
            :page="page"
            :error="error"
            @change="visit"
            v-slot="{ item }"
        >
            <Card
                :title="item.name"
                :image="item.image"
                :details="[`${item.status} · ${item.species}`, item.gender, item.location]"
            />
        </Results>
    </Layout>
</template>
