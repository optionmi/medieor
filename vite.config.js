import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";

export default defineConfig({
  plugins: [
    laravel({
      input: [
        "resources/sass/app.scss",
        "resources/css/app.css",
        "resources/js/app.js",
        "resources/js/admin.js",
        "resources/css/admin.css",
        "resources/css/home.css",
        "resources/css/community-home.css",
        "resources/js/groupDetail.js",
        "resources/js/app.jsx",
        "resources/js/events.js",
      ],
      refresh: true,
    }),
    react(),
  ],
});
