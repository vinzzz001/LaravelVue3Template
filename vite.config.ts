import { defineConfig } from "vite";
import { fileURLToPath } from "url";
import laravel from "laravel-vite-plugin";
import path from "path";
import vue from "@vitejs/plugin-vue";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const srcPath = path.resolve("./resources/js");

export default defineConfig({
  plugins: [
    laravel({
      input: ["resources/css/app.scss", "resources/js/app.js"],
      refresh: true,
    }),
    vue(),
  ],
  resolve: {
    alias: {
      "@": path.resolve(__dirname, "resources/js"),

      // shared aliases
      routes: path.join(srcPath, "routes"),
      components: path.join(srcPath, "components"),
      constants: path.join(srcPath, "constants"),

      // domains
      domains: path.join(srcPath, "domains"),

      // general aliases
      services: path.join(srcPath, "services"),
      types: path.join(srcPath, "types"),
      // errors: path.join(srcPath, "errors"),
      // helpers: path.join(srcPath, "helpers"),
    },
  },
});
