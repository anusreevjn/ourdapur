/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                // The "My Smart Pantry" Palette
                border: "hsl(30 20% 88%)",
                input: "hsl(30 20% 88%)",
                ring: "hsl(20 85% 52%)",
                background: "hsl(30 25% 97%)", // Warm cream background
                foreground: "hsl(25 30% 12%)",
                primary: {
                    DEFAULT: "hsl(20 85% 52%)", // Terracotta Orange
                    foreground: "hsl(0 0% 100%)",
                },
                secondary: {
                    DEFAULT: "hsl(35 30% 92%)",
                    foreground: "hsl(25 30% 15%)",
                },
                card: {
                    DEFAULT: "hsl(30 20% 99%)",
                    foreground: "hsl(25 30% 12%)",
                },
            },
            fontFamily: {
                sans: ['"Instrument Sans"', 'sans-serif'],
            }
        },
    },
    plugins: [],
};