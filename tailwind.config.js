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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                serif: ['Georgia', 'Cambria', 'Times New Roman', 'Times', 'serif'],
            },
            colors: {
                'medium-green': '#1A8917',
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
