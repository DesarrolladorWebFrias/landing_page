// C:\laragon\www\landing_page\vite.config.js

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'; // ⬅️ DEBE ESTAR IMPORTADO

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(), // ⬅️ DEBE ESTAR AÑADIDO AQUÍ
    ],
});

