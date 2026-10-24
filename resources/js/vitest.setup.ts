import { config } from '@vue/test-utils';
import { vi } from 'vitest';

// Fail on Vue warnings
config.global.config.warnHandler = function (message) {
    throw new Error(message);
};

// Replace Inertia requirements
vi.mock('@inertiajs/vue3', async function (importOriginal) {
    const inertia = await importOriginal<typeof import('@inertiajs/vue3')>();
    const Head = {
        render() {
            return null;
        },
    };

    return { ...inertia, Head };
});

config.global.mocks = { $page: { props: { appName: 'Test App' } } };
