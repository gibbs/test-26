import { router } from '@inertiajs/vue3';
import { reactive, ref, watch } from 'vue';
import type { Filters } from '@/types';

// Drop empty values for cleaner URLs
function withoutEmpty(query: Filters): Filters {
    const result: Filters = {};

    for (const [key, value] of Object.entries(query)) {
        if (value !== '' && value !== null && value !== undefined) {
            result[key] = value;
        }
    }

    return result;
}

// Generic error messages
function errorMessage(status: number): string {
    if (status === 429) {
        return 'Too many requests, please try again shortly.';
    }

    return 'Something went wrong, please try again.';
}

export function useFilters<TFilters extends Filters>(
    defaults: TFilters,
    initial: Filters,
    prop: string,
) {
    const { page: initialPage, ...current } = initial;

    const filters = reactive({ ...defaults, ...current }) as TFilters;
    const page = ref(Number(initialPage ?? 1));
    const loading = ref(false);
    const error = ref<string | null>(null);

    function visit(to = 1, preserveScroll = true) {
        page.value = to;

        const query = withoutEmpty({ ...filters, page: to });

        router.get(window.location.pathname, query, {
            only: [prop, 'filters'],
            preserveState: true,
            preserveScroll,
            replace: true,
            onStart() {
                loading.value = true;
                error.value = null;
            },
            onFinish() {
                loading.value = false;
            },
            onHttpException(response) {
                error.value = errorMessage(response.status);

                return false;
            },
        });
    }

    // A new page starts at the top, unlike filter changes which keep the scroll position
    function goToPage(to: number) {
        visit(to, false);
    }

    // Any filter change starts again from page 1
    watch(filters, function () {
        visit();
    });

    return { filters, page, loading, error, visit, goToPage };
}
