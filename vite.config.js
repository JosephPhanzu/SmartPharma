import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js', 'resources/css/app.css'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '$': 'jquery',
            'jQuery': 'jquery',
            'path': 'path-browserify',
            'source-map-js': 'source-map-js',
        },
    },
});
