import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                orange: {
                    500: '#e64a19',
                    600: '#d84315',
                    50: '#fef5ee',
                    100: '#fde9d7',
                    200: '#f9cfaf',
                    300: '#f6ad7b',
                    400: '#f18146',
                    700: '#b83416',
                    800: '#932b19',
                    900: '#762618',
                    950: '#40100a',
                },
                'custom-orange': '#f5f5dc',  // Aquí se agrega el color personalizado
            },
        },
    },

    plugins: [forms, typography],
};
