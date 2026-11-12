import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  plugins: [
    laravel({
      input: [
        "resources/css/site.css",
        "resources/js/site.ts",
        "resources/css/pages/home.css",
        "resources/js/pages/home.ts",
        "resources/css/pages/artist.css",
      ],
      refresh: true,
    }),
    tailwindcss(),
  ],
  server: {
    hmr: {
      host: "localhost",
    },
  },
});
