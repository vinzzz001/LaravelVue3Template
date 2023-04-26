// #region store
import type { NewUser, User } from "./types";
import { storeModuleFactory } from "services/store";
const baseUserStore = storeModuleFactory<User>("users");
import { postRequest } from "../../services/http";

export const userStore = {
  getters: baseUserStore.getters,
  setters: baseUserStore.setters,
  actions: {
    ...baseUserStore.actions,

    createUser: async (user: Omit<NewUser, "id">) => {
      console.log(user);
      const { data } = await postRequest(`users/create`, user);

      if (!data) return;
      userStore.setters.setById(data);
      return; //This blank return is needed to ensure awaits funciton;
    },
  },
};

// #endregion

// #region routes
import Overview from "domains/users/pages/overview.vue";
import Create from "domains/users/pages/create.vue";
import Edit from "domains/users/pages/edit.vue";
import Show from "domains/users/pages/show.vue";

export const userRoutes = [
  { path: "/user", name: "user.overview", component: Overview },
  { path: "/user/create", name: "user.create", component: Create },
  { path: "/user/edit/:id", name: "user.edit", component: Edit },
  { path: "/user/:id", name: "user.show", component: Show },
];

// #endregion
