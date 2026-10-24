import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { fileURLToPath } from 'node:url';
import { defineConfig } from 'vitest/config';

// Vitest runs Vite as a dev server, which laravel-vite-plugin refuses to do in CI
const testing = process.env.VITEST !== undefined;

export default defineConfig({
    plugins: [
        testing
            ? null
            : laravel({
                  input: ['resources/css/app.css', 'resources/js/app.ts'],
                  refresh: true,
              }),
        tailwindcss(),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./resources/js', import.meta.url)),
        },
    },
    test: {
        environment: 'jsdom',
        include: ['resources/js/**/__tests__/**/*.spec.ts'],
        setupFiles: ['resources/js/vitest.setup.ts'],
    },
});
