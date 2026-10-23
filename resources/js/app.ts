import '../css/app.css';
import { createInertiaApp } from '@inertiajs/vue3';
import { createApp, h, type DefineComponent } from 'vue';

const pages = import.meta.glob<DefineComponent>('./pages/**/*.vue', {
    eager: true,
    import: 'default'
});

createInertiaApp({
    title: (title) => `${title}`,
    resolve: (name) => pages[`./pages/${name}.vue`]!,
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) }).use(plugin).mount(el);
    },
    progress: { color: '#84cc16' },
});
