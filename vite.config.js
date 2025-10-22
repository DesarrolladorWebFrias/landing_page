// C:\laragon\www\landing_page\vite.config.js

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'; // ⬅️ DEBE ESTAR IMPORTADO

// 1. Importar el plugin de Tailwind v4
import tailwindcss from '@tailwindcss/vite'; 

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        // 2. Añadir el plugin de Tailwind
        tailwindcss(), 
    ],
});

