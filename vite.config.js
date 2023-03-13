import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import fs from 'fs';

export default defineConfig({
    server: {
        host: true,
        hmr: {
            host: 'booking.hxx.li',
        },
        https: {
            key: fs.readFileSync('./resources/ssl/hxx.li.key'),
            cert: fs.readFileSync('./resources/ssl/hxx.li.crt'),
        },
    },
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    },
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            ssr: 'resources/js/ssr.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
