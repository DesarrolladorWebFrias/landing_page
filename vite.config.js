import { defineConfig } from 'vite';

import laravel from 'laravel-vite-plugin';
// ⚠️ MANTENER SOLO UNA VEZ ESTA LÍNEA 
import tailwindcss from '@tailwindcss/vite'; 

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                // Filament requiere que sus propios assets se incluyan en el input
                'resources/css/filament/admin/theme.css', 
            ],
            refresh: true,
        }),
        // ⚠️ MANTENER SOLO UNA VEZ ESTA LÍNEA
        tailwindcss(), 
    ],
});


