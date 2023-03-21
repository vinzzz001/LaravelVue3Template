import { createApp } from "vue";
import { createRouter, createWebHashHistory } from "vue-router";
import { authStore } from "domains/auth";
import { routes } from "../router";
import "bootstrap";

import App from "./App.vue";

const app = createApp(App);

//todo: use the router 'helper?'
const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

//todo: Move the authstore action somewhere else? Maybe in the App.vue?
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
