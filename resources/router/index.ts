import responseShow from "../js/pages/responses/show.vue";
import responseOverview from "../js/pages/responses/overview.vue";
import responseIndex from "../js/pages/responses/index.vue";

import ticketCreate from "../js/pages/tickets/create.vue";
import ticketEdit from "../js/pages/tickets/edit.vue";
import ticketIndex from "../js/pages/tickets/index.vue";
import ticketOverview from "../js/pages/tickets/overview.vue";
import ticketShow from "../js/pages/tickets/show.vue";

import categoryCreate from "../js/pages/categories/create.vue";
import categoryEdit from "../js/pages/categories/edit.vue";
import categoryIndex from "../js/pages/categories/index.vue";
import categoryOverview from "../js/pages/categories/overview.vue";

import login from "../js/pages/users/index.vue";
import { store as authStore } from "../js/store/authStore";

export const routes = [
  {
    path: "/category",
    component: categoryIndex,

    beforeEnter: (to: any, from: any, next: any) => {
      // The user can only visit category pages if logged in as Admin.
      console.log(authStore.getters.me?.value.is_admin);
      if (authStore.getters.me?.value.is_admin) {
        next();
      } else {
        next("/login");
      }
    },
    redirect: "/category/overview",
    children: [
      {
        path: "overview",
        name: "category.overview",
        component: categoryOverview,
      },
      { path: "create", name: "category.create", component: categoryCreate },
      { path: "edit/:id", name: "category.edit", component: categoryEdit },
    ],
  },

  { path: "/login", name: "login", component: login },

  {
    path: "/responses",
    component: responseIndex,

    redirect: "/responses/overview",
    children: [
      {
        path: "overview",
        name: "response.overview",
        component: responseOverview,
      },

      { path: ":id", name: "response.show", component: responseShow },
    ],
  },

  {
    path: "/ticket",
    component: ticketIndex,
    redirect: "/ticket/overview",
    children: [
      { path: "overview", name: "ticket.overview", component: ticketOverview },
      { path: "create", name: "ticket.create", component: ticketCreate },
      { path: "edit/:id", name: "ticket.edit", component: ticketEdit },
      { path: ":id", name: "ticket.show", component: ticketShow },
    ],
  },
];
