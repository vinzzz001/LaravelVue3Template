//todo: create some paths
import ticketOverviewPage from "../js/pages/tickets/overview.vue";
import ticketShowPage from "../js/pages/tickets/show.vue";
import ticketCreatePage from "../js/pages/tickets/create.vue";
import ticketEditPage from "../js/pages/tickets/edit.vue";

import loginPage from "../js/pages/users/index.vue";
import random from "../js/pages/tickets/random.vue";

// { path: string, name: string, component: Component, props ?: boolean }
export const routes = [
  { path: "/ticket/overview", name: "Tickets", component: ticketOverviewPage },
  { path: "/ticket/create", name: "TicketCreate", component: ticketCreatePage },
  { path: "/ticket/edit/:id", name: "TicketEdit", component: ticketEditPage },

  {
    path: "/ticket/:id",
    name: "TicketShow",
    component: ticketShowPage,
    //todo: add authentication here?
    // beforeEnter: (to: any, from: any, next: any) => {
    //   if () next();
    //   else "/ticket/overview";
    // },
  },

  { path: "/random", name: "random", component: random },
  { path: "/login", name: "Login", component: loginPage },
];
