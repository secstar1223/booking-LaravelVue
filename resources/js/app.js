import './bootstrap';
import '../css/app.css';

import { setupCalendar, Calendar, DatePicker } from 'v-calendar';
import 'v-calendar/style.css';

// Import our custom CSS
import '../scss/app.scss'
import * as bootstrap from 'bootstrap'

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import ProductLayout from './Layouts/ProductLayout.vue';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(setupCalendar, {})
            .component('VCalendar', Calendar)
            .component('VDatePicker', DatePicker)
	    .component('ProductLayout', ProductLayout)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
