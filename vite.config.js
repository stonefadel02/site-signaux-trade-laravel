import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import fs from "fs-extra";
export default defineConfig({
  plugins: [
    laravel({
      input: ["resources/css/app.css", "resources/js/app.js"],
      refresh: true,
    }),
  ],
  build: {
    rollupOptions: {
      plugins: [
        {
          name: "copy-tabler-icons",
          buildStart() {
            fs.copySync("node_modules/tabler-icons/icons", "public/icons");
          },
        },
      ],
    },
  },
});
