import { defineConfig } from 'vite';
import vueDevTools from 'vite-plugin-vue-devtools'
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import path from 'path';

export default defineConfig({
    plugins: [
        vueDevTools(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            transformAssetUrls: {
                base: null,
                includeAbsolute: false
            }
        }),
    ],
    resolve: {
        alias: {
            ziggy: path.resolve(__dirname, 'vendor/tightenco/ziggy/dist/index.esm.js'),
            //'ziggy-js': path.resolve('vendor/tightenco/ziggy')
        },
    },
});
