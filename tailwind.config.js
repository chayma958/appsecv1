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
            colors: {
                'gray-800': '#1f2937',
                'gray-700': '#374151',
                'gray-600': '#4b5563',
                'gray-900': '#111827',
                'indigo-600': '#4f46e5',
                'indigo-700': '#4338ca',
              },
        },
    },

    plugins: [forms],
};
