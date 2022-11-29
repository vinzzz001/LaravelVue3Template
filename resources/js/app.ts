import { createApp } from "vue";
import { createRouter, createWebHashHistory } from 'vue-router';
import { routes } from '../router/index';
import App from "./App.vue";

//todo: Check authentications cookie

const app = createApp(App);
const router = createRouter(
    {
        history: createWebHashHistory(),
        routes
    }
)

app.use(router)
app.mount('#app');