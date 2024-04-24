import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

<<<<<<< HEAD
const appName = import.meta.env.VITE_APP_NAME || 'Deliveboo';

createInertiaApp({
    title: (title) => `${appName} - ${title}`,
=======
const appName = import.meta.env.VITE_APP_NAME || 'DeliveBoo';

createInertiaApp({
    title: (title) => `${appName} | ${title}`,
>>>>>>> df05db9 (feat Title page)
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
