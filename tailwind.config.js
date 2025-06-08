const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'Figtree', 'system-ui', '-apple-system', 'BlinkMacSystemFont', ...defaultTheme.fontFamily.sans],
                serif: ['Charter', 'Georgia', 'Cambria', 'Times New Roman', 'Times', 'serif'],
                title: ['sohne', 'Helvetica Neue', 'Arial', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'medium-green': '#1A8917',
            },
            fontWeight: {
                'bold-medium': '700',
                'extrabold': '800',
                'black': '900',
            },
            fontSize: {
                'title-large': '2.5rem',    // 40px - Even larger titles
                'title-medium': '2rem',     // 32px - Larger medium titles
                'bold-large': '1.5rem',     // 24px - Larger bold text
            },
            letterSpacing: {
                'title': '-0.022em', // Medium's title letter spacing
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
