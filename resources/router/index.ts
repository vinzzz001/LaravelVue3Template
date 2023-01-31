import ticketCreate from "../js/pages/tickets/create.vue";
import ticketEdit from "../js/pages/tickets/edit.vue";
import ticketIndex from "../js/pages/tickets/index.vue";
import ticketOverview from "../js/pages/tickets/overview.vue";
import ticketShow from "../js/pages/tickets/show.vue";

import categoryCreate from "../js/pages/categories/create.vue";
import categoryEdit from "../js/pages/categories/edit.vue";
import categoryOverview from "../js/pages/categories/overview.vue";
import categoryShow from "../js/pages/categories/show.vue";

import login from "../js/pages/users/index.vue";
import { routerKey } from "vue-router";

export const routes = [
  {
    path: "/category",
    // name: "category", //Strictly, no name is needed for the parent.
    redirect: "/category/overview",
    children: [
      {
        path: "overview",
        name: "category.overview",
        component: categoryOverview,
      },
      { path: "create", name: "category.create", component: categoryCreate },
      { path: "edit/:id", name: "category.edit", component: categoryEdit },
      { path: ":id", name: "category.show", component: categoryShow },
    ],
  },

  { path: "/login", name: "login", component: login },

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
