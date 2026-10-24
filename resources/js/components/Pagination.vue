<script setup lang="ts">
defineProps<{
    page: number;
    pages: number;
}>();
defineEmits<{
    change: [page: number];
}>();
</script>

<template>
    <nav data-testid="pagination" v-if="pages > 1">
        <button type="button" :disabled="page <= 1" @click="$emit('change', page - 1)">
            Previous
        </button>

        <span>Page {{ page }} of {{ pages }}</span>

        <button type="button" :disabled="page >= pages" @click="$emit('change', page + 1)">
            Next
        </button>
    </nav>
</template>
