<script setup lang="ts">
import { ref } from "vue";
import { ResetCredentials } from "../types";

import passwordInput from "domains/auth/components/passwordInput.vue";
import emailInput from "domains/auth/components/emailInput.vue";
import baseFormError from "components/form/error.vue";
import { authStore } from "..";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();
const token: string = route?.params.token as string;
const credentials = ref<ResetCredentials>({
  email: "",
  password: "",
  token: token,
});

const resetPassword = async () => {
  if (credentials.value.passwordConfirmation != credentials.value.password)
    return; //Generate Error
  const response = await authStore.actions.resetPassword(credentials.value);
  console.log(response);
  router.push({ name: "login" }); //needs to point to the new recovery page.
};
</script>

<template>
  <h1>Reset Password Page</h1>
  Type the email, password, and repeat password, before submitting the reset.
  <div class="row g-2 justify-content-center">
    <div class="col-auto">
      <div class="d-flex align-items-center">
        <email-input v-model="credentials.email" />
      </div>
      <base-form-error name="email" />
    </div>

    <div class="col-auto">
      <password-input v-model="credentials.password"></password-input>
      <password-input
        v-model="credentials.passwordConfirmation"
      ></password-input>
      <base-form-error name="password" />
    </div>
    <div class="col-auto d-flex align-items-center">
      <button class="btn btn-outline-primary" @click.prevent="resetPassword()">
        Reset Password
      </button>
    </div>
  </div>
</template>
