import { computed, ref } from "vue";
import { getRequest, postRequest } from "services/http";
import type { Credentials, User } from "domains/auth/types";
import login from "domains/auth/pages/login.vue";
import forgotPassword from "domains/auth/pages/forgotPassword.vue";

// #region routes
export const authRoutes = [
  { path: "/login", name: "login", component: login },
  { path: "/login/forgot", name: "login.forgot", component: forgotPassword },
];
// #endregion

// #region authStore
const state = ref(<User>{});
const getters = {
  me: computed(() => state.value),
};

/** Set the user login data. */
const setters = {
  setAuth: (user: User) => {
    state.value = Object.freeze(user);
  },

  unsetAuth: () => {
    state.value = Object.freeze(<User>{});
  },
  //todo: create a re-set-data function called refresh?
};

const actions = {
  login: async (credentials: Credentials) => {
    const { data } = await postRequest("login", credentials);
    if (!data) return;
    setters.setAuth(data.user);
  },

  logout: async () => {
    const { data } = await getRequest("logout");
    setters.unsetAuth();
  },

  me: async () => {
    const { data } = await getRequest("me");
    if (!data) return;
    setters.setAuth(data);
  },
};

export const authStore = {
  getters,
  //setters, //Setters shouldn't be accesible externally, right?
  actions,
};
// #endregion
