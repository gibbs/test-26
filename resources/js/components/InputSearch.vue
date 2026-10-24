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
        :placeholder="label"
    />
</template>
