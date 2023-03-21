import { ticketRoutes } from "domains/tickets";
import { authRoutes } from "domains/auth";
import { categoryRoutes } from "domains/categories";

export const routes = [
  // {
  //   path: "/category",
  //   component: categoryIndex,

  //   beforeEnter: (to: any, from: any, next: any) => {
  //     // The user can only visit category pages if logged in as Admin.
  //     console.log(authStore.getters.me?.value.is_admin);
  //     if (authStore.getters.me?.value.is_admin) {
  //       next();
  //     } else {
  //       next("/login");
  //     }
  //   },
  //   redirect: "/category/overview",
  //   children: [
  //     {
  //       path: "overview",
  //       name: "category.overview",
  //       component: categoryOverview,
  //     },
  //     { path: "create", name: "category.create", component: categoryCreate },
  //     { path: "edit/:id", name: "category.edit", component: categoryEdit },
  //   ],
  // },

  // { path: "/login", name: "login", component: login },

  // {
  //   path: "/responses",
  //   redirect: "/responses/overview",
  //   children: [
  //     {
  //       path: "overview",
  //       name: "response.overview",
  //       component: responseOverview,
  //     },

  //     { path: ":id", name: "response.show", component: responseShow },
  //   ],
  // },
  ...authRoutes,
  ...categoryRoutes,
  // ...responseRoutes,
  ...ticketRoutes,
];
