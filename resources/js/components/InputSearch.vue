<script setup lang="ts">
import { onBeforeUnmount, ref, watch } from 'vue';

const model = defineModel<string>({ default: '' });
const props = withDefaults(
    defineProps<{
        label: string;
        delay?: number;
    }>(),
    { delay: 300 },
);

const value = ref(model.value);
let timer: ReturnType<typeof setTimeout> | undefined;

watch(value, (next) => {
    clearTimeout(timer);
    timer = setTimeout(() => (model.value = next), props.delay);
});

onBeforeUnmount(() => clearTimeout(timer));
</script>

<template>
    <input
        data-testid="input-search"
        v-model.trim="value"
        type="search"
        maxlength="100"
        :aria-label="label"
        :placeholder="label"
        class="w-full rounded-md border-2 border-emerald-900 hover:border-lime-600 bg-neutral-900 px-3 py-2 text-sm placeholder:text-neutral-500 focus:border-lime-600 focus:ring-1 focus:ring-lime-600 focus:outline-none"
    />
</template>
