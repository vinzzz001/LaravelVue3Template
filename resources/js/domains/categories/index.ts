import categoryCreate from "domains/categories/pages/create.vue";
import categoryEdit from "domains/categories/pages/edit.vue";
import categoryOverview from "domains/categories/pages/overview.vue";

// #region routes
export const categoryRoutes = [
  { path: "/category", name: "category.overview", component: categoryOverview },
  {
    path: "/category/create",
    name: "category.create",
    component: categoryCreate,
  },
  {
    path: "/category/edit/:id",
    name: "category.edit",
    component: categoryEdit,
  },
];
// #endregion

// #region Store
import type { Category } from "./types";
import { storeModuleFactory } from "services/store";
export const categoryStore = storeModuleFactory<Category>("categories");
// #endregion
