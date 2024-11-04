import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                'sm': '440px',    // Small devices
                'md': '768px',    // Medium devices
                'lg': '1024px',   // Large devices
                'xl': '1280px',   // Extra large devices
                '2xl': '1536px',  // Double extra large devices
                'custom': '900px' // Your custom breakpoint
            },
        },
    },

    plugins: [forms],
};
