import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { route } from './routes';

createInertiaApp({
    title: (title) => (title ? `${title} - Nirwana Admin` : 'Nirwana Tour - Portal Admin'),
    resolve: (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
        const page = pages[`./Pages/${name}.vue`];
        if (!page) {
            throw new Error(`Inertia page not found: ./Pages/${name}.vue`);
        }
        return page.default ?? page;
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app.use(plugin);
        app.config.globalProperties.route = route;
        app.mount(el);
    },
    progress: {
        color: '#DE0171',
        showSpinner: true,
    },
});
