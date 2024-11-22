import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/css/app.css',
                'resources/sass/app.scss',

                'resources/admin/admin.js',
                'resources/admin/admin.css',
                'resources/admin/admin.scss',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '$':'jQuery'
        },
    },
});
