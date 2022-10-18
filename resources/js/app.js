import axios from "axios";
window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import { createApp } from "vue";
// import { createRouter } from "vue-router";

import App from "./App.vue";

const app = createApp(App);

// const routes = [{ path: '/', name: 'Home', component: indexPage },]
// const router = createRouter(
//     {
//         history: createWebHashHistory(),
//         routes
//     }
// )


// app.use(router)
app.mount("#app");
