<script setup lang="ts">
import { ref } from "vue";
import type { Credentials } from "../../types";
import { store as createAuthStore } from "../../store/authStore";

const authStore = createAuthStore;

//Todo: Remove the temporary email/password
const credentials = ref<Credentials>({
  email: "vinzzz001@gmail.com",
  password: "password",
});
const passwordFieldType = ref<"password" | "current-password">("password");

const loginForm = () => authStore.actions.login(credentials.value);
const logout = () => authStore.actions.logout();
const switchType = () =>
  (passwordFieldType.value =
    passwordFieldType.value === "password" ? "current-password" : "password");

/**
 * Switches password type between visible and protected text.
 */
</script>

<template>
  <pre>{{ authStore.getters.me }}</pre>

  Remove temp password/email later

  <form @submit.prevent="loginForm()" class="col-auto">
    <div class="row g-2 justify-content-center">
      <div class="col-auto">
        <label for="emailInput" class="col-form-label">Email</label>
        <input
          id="emailInput"
          class="form-control"
          type="text"
          name="email"
          v-model="credentials.email"
        />
      </div>

      <div class="col-auto">
        <label for="passwordInput" class="col-form-label">Password</label>
        <input
          class="form-control"
          :type="passwordFieldType"
          v-model="credentials.password"
        />
      </div>
    </div>

    <div class="col-auto"></div>
    <!-- Todo: Some kind of toggle between submit and logout -->
    <button class="btn btn-outline-primary" type="submit">Submit</button>
    <button class="btn btn-outline-primary" @click="logout()">Logout</button>
    <button class="btn btn-outline-primary" @click.prevent="switchType()">
      Show Password
    </button>
  </form>
</template>
