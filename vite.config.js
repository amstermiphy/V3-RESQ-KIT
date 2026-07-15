import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
import fg from "fast-glob";

const imageEntries = fg.sync(
    "resources/images/**/*.{png,jpg,jpeg,svg,webp,gif}",
);

console.log("Gambar yang ke-detect:", imageEntries);

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                ...imageEntries,
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ["**/storage/framework/views/**"],
        },
    },
});
