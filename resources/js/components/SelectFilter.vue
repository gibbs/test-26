<script setup lang="ts">
const model = defineModel<string>({ default: '' });

defineProps<{ label: string; options: string[] }>();
</script>

<template>
    <select data-testid="select-filter" v-model="model">
        <option value="">Any {{ label.toLowerCase() }}</option>
        <option v-for="option in options" :key="option" :value="option.toLowerCase()">
            {{ option }}
        </option>
    </select>
</template>
