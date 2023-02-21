import { createApp } from "vue";
import { createRouter, createWebHashHistory } from "vue-router";
import { store as authStore } from "./store/authStore";
import { routes } from "../router/index";

import App from "./App.vue";

//todo: Check authentications cookie

const app = createApp(App);
const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

/**
 * Try to recover login if the site gets (re)loaded
 */
try {
  await authStore.actions.me();
} catch {
  // Nope
} finally {
  app.use(router);
  app.mount("#app");
}
