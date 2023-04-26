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
import { putRequest } from "../../services/http";
const baseCategoryStore = storeModuleFactory<Category>("categories");

export const categoryStore = {
  getters: baseCategoryStore.getters,
  setters: baseCategoryStore.setters,
  actions: {
    ...baseCategoryStore.actions,

    delete: async (category: Category) => {
      const { data } = await putRequest(
        `categories/${category.id}/delete`,
        category
      );

      if (!data) return;
      categoryStore.setters.setAll(data);
    },
  },
};

// #endregion
