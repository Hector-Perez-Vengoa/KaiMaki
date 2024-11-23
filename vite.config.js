import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/carousel.css', // Agrega este
                'resources/js/carousel.js',   // Agrega este
            ],
            refresh: true,
        }),
    ],
});
