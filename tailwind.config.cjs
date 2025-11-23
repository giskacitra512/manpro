module.exports = {
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './resources/css/**/*.css',
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    50: '#fee2e2',
                    100: '#fecaca',
                    200: '#fca5a5',
                    300: '#f87171',
                    400: '#ef4444',
                    500: '#dc2626',
                    600: '#b91c1c',
                    700: '#991b1b',
                    800: '#7f1d1d',
                    900: '#450a0a',
                },
                beige: {
                    50: '#fdfcf9',
                    100: '#faf8f3',
                    200: '#f5f1e8',
                    300: '#ede7d8',
                    400: '#e3d9c3',
                    500: '#d4c5a9',
                    600: '#c0ab8e',
                    700: '#a88f6f',
                    800: '#8a7459',
                    900: '#6b5a45',
                },
            },
            fontFamily: {
                sans: [
                    'Instrument Sans',
                    'ui-sans-serif',
                    'system-ui',
                    'sans-serif',
                    'Apple Color Emoji',
                    'Segoe UI Emoji',
                    'Segoe UI Symbol',
                    'Noto Color Emoji',
                ],
            },
        },
    },
    plugins: [],
};
