<script setup lang="ts">
import { ref } from "vue";
import { RouterLink } from "vue-router";
import type { Credentials } from "domains/auth/types";
import { authStore } from "domains/auth";
import passwordInput from "domains/auth/components/passwordInput.vue";
import emailInput from "domains/auth/components/emailInput.vue";

authStore.actions.me();
const me = authStore.getters.me;

//Todo: Empty the temporary email/password
const credentials = ref<Credentials>({
  email: "vinzzz001@gmail.com",
  password: "password",
});

const loginForm = () => authStore.actions.login(credentials.value);
const logout = () => authStore.actions.logout();

/**
 * Switches password type between visible and protected text.
 */
</script>

<template>
  <!-- Login Information -->
  <pre>{{ authStore.getters.me?.value }}</pre>

  <!-- Login Form -->
  <form @submit.prevent="loginForm()" class="col-auto">
    <!-- Email & Password-->
    <div v-if="!me.id" class="row g-2 justify-content-center">
      <div class="col-auto">
        <email-input v-model="credentials.email" />
      </div>

      <div class="col-auto">
        <password-input v-model="credentials.password" />
      </div>
    </div>

    <!-- Login/Logout Buttons -->
    <div class="col-auto">
      <button v-if="!me.id" class="btn btn-outline-primary" type="submit">
        Submit
      </button>
      <button
        v-if="me.id"
        class="btn btn-outline-primary"
        @click.prevent="logout()"
      >
        Logout
      </button>
      <p></p>
      <router-link v-if="!me.id" :to="{ name: 'login.forgot' }"
        >Forgot Password?</router-link
      >
    </div>
  </form>
</template>
