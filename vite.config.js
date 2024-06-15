import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

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
      ],
      refresh: true,
    }),
  ],
});
