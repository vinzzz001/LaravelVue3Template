import { computed, ref } from "vue";
import axios from "axios";
import { Credentials, User } from "../types";

const state = ref({ user: <User>{} });

const getters = {
  me: computed(() => state.value.user),
};

/** Set the user login data. */
const setters = {
  setAuth: (user: User) => {
    //todo: setting the correct types.
    state.value.user = user;
  },

  unsetAuth: () => {
    state.value = {
      user: <User>{},
    };
  },
  //todo: create a re-set-data function called refresh
};

const actions = {
  login: async (credentials: Credentials) => {
    const { data } = await axios.post("api/login", credentials);
    if (!data) return;
    setters.setAuth(data.user);
  },

  logout: async () => {
    const { data } = await axios.get("api/logout");
    setters.unsetAuth();
  },

  me: async () => {
    const { data } = await axios.get("api/me");
    console.log(data);
    if (!data) return;
    setters.setAuth(data);
  },
};

export const store = {
  getters,
  setters,
  actions,
};
