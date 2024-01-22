const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: "1rem",
                lg: "75px",
                xl: "100px",
            },
        },
        extend: {
            colors: {
                primary: "#1D5D9B",
                secondary: "#75C2F6",
                success: "#4FD3C4",
                warning: "#FFD754",
                danger: "#FC2947",
                text_black: "#0C3256",
                text_semiblack: "#556F89",
                text_gray: "#CED6DD",
                text_lightgray: "#F5F6F6",
                text_white: "#FFFFFF",
                grey: "#CED6DD",
                darkGrey: "#F5F6F6",
                background: "#EDF2F7",
            },
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
                poppins: "Poppins, sans-serif",
            },
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
