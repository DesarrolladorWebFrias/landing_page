export default {
    plugins: {
        // Asegura que Tailwind v4 se cargue como un plugin PostCSS dedicado
        '@tailwindcss/postcss': {}, 
        
        // Mantén el autoprefixer, que suele ser necesario
        'autoprefixer': {},
    },
};
