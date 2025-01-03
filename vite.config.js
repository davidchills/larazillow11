import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import path from 'path';
import vueDevTools from 'vite-plugin-vue-devtools'

export default defineConfig({
    plugins: [
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
        vueDevTools(),
    ],
    resolve: {
        alias: {
            ziggy: path.resolve(__dirname, 'vendor/tightenco/ziggy/dist/index.esm.js'),
        },
    },
});
