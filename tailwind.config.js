import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "selector",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["InterVariable", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                nord0: "#2e3440",
                nord1: "#3b4252",
                nord2: "#434c5e",
                nord3: "#4c566a",
                nord4: "#d8dee9",
                nord5: "#e5e9f0",
                nord6: "#eceff4",
                nord7: "#8fbcbb",
                nord8: "#81a1c1",
                nord9: "#5e81ac",
                nord10: "#d08770",
                nord11: "#b48ead",
                nord12: "#a3be8c",
                nord13: "#b48ead",
                nord14: "#bf616a",
                nord15: "#d08770",
                nord16: "#ebcb8b",
                nord17: "#a3be8c",
                nord18: "#b48ead",
                nord19: "#bf616a",
                nord20: "#d08770",
                nord21: "#ebcb8b",
            },
        },
    },
    plugins: [
        forms,
        require("flowbite/plugin")({
            datatables: true,
        }),
    ],
};
