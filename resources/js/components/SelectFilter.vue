<script setup lang="ts">
const model = defineModel<string>({ default: '' });

defineProps<{ label: string; options: string[] }>();
</script>

<template>
    <select
        data-testid="select-filter"
        v-model="model"
        :aria-label="label"
        class="rounded-md font-semibold border-2 border-emerald-900 hover:border-lime-600 bg-neutral-900 px-3 py-2 text-sm focus:border-lime-600 focus:ring-1 focus:ring-lime-600 focus:outline-none"
    >
        <option value="">Any {{ label.toLowerCase() }}</option>
        <option v-for="option in options" :key="option" :value="option.toLowerCase()">
            {{ option }}
        </option>
    </select>
</template>
