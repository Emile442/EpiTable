const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        /*pagination: theme => ({
            // Customize the color only. (optional)
            color: theme('colors.teal.600'),

            // Customize styling using @apply. (optional)
            wrapper: 'flex justify-center',

            // Customize styling using CSS-in-JS. (optional)
            wrapper: {
                'display': 'flex',
                'justify-items': 'center',
            },
        })*/
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    plugins: [
        require('@tailwindcss/ui'),
        require('tailwindcss-plugins/pagination')
    ],
};
