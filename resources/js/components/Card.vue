<script setup lang="ts">
import { computed, ref } from 'vue';
import placeholder from '../../images/placeholder.jpeg';

const props = defineProps<{
    title: string;
    details: string[];
    image?: string;
}>();

const loaded = ref(false);
const failed = ref(false);

const src = computed(() => (failed.value ? placeholder : props.image));
</script>

<template>
    <article data-testid="card">
        <div v-if="image">
            <img
                :src="src"
                :alt="title"
                :class="loaded ? 'loading' : 'loaded'"
                @load="loaded = true"
                @error="failed = true"
                loading="lazy"
            />
        </div>

        <div>
            <h2>{{ title }}</h2>
            <p v-for="detail in details" :key="detail">{{ detail }}</p>
        </div>
    </article>
</template>
