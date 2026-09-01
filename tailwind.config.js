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
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Palet warna Dispora Jatim — Tosca
                dispora: {
                    50:  '#effefb',
                    100: '#c8fff4',
                    light: '#c8fff4',
                    200: '#91fee9',
                    300: '#52f5db',
                    400: '#1ee0c7',
                    DEFAULT: '#0bbead',
                    500: '#0bbead',
                    600: '#049a90',
                    700: '#087b75',
                    dark: '#065f5c',
                    800: '#0a4c4a',
                    900: '#0d403e',
                    950: '#002726',
                },
            },
            animation: {
                'float': 'float 6s ease-in-out infinite',
                'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-20px)' },
                },
            },
        },
    },

    plugins: [forms],
};
