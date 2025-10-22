// tailwind.config.js
import defaultTheme from 'tailwindcss/defaultTheme';


/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        // 👇 Añade esta línea para escanear los archivos JS de Flowbite en busca de clases
        "./node_modules/flowbite/**/*.js" 
    ],
    
    theme: {
        extend: {
            // Tus extensiones de tema...
        },
    },
    plugins: [
        // 👇 Requiere el plugin Flowbite
        require('flowbite/plugin'),
    ],
}