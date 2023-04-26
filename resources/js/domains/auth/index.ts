import { computed, ref } from "vue";
import { getRequest, putRequest } from "services/http";
import type { Credentials, ResetCredentials } from "domains/auth/types";
import { User } from "domains/users/types";
import login from "domains/auth/pages/login.vue";
import forgotPassword from "domains/auth/pages/forgotPassword.vue";
import resetPassword from "domains/auth/pages/resetPassword.vue";

// #region routes
export const authRoutes = [
  { path: "/auth/login", name: "login", component: login },
  {
    path: "/auth/forgot",
    name: "login.forgot",
    component: forgotPassword,
  },
  {
    path: "/auth/reset/:token",
    name: "login.reset",
    component: resetPassword,
  },
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
    const { data } = await putRequest("auth/login", credentials);
    if (!data) return;
    setters.setAuth(data.user);
  },

  logout: async () => {
    const { data } = await getRequest("auth/logout");
    setters.unsetAuth();
  },

  forgotPassword: async (email: string) => {
    const { data } = await putRequest("auth/forgot", { email: email });
  },

  resetPassword: async (credentials: ResetCredentials) => {
    const { data } = await putRequest("auth/reset", credentials);
    //todo: contiue here. Some kind of check of a token?
  },

  me: async () => {
    const { data } = await getRequest("auth/me");
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
