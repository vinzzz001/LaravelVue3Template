<script setup lang="ts">
import { ref } from "vue";
import emailInput from "domains/auth/components/emailInput.vue";
import { authStore } from "..";
import baseFormError from "components/form/error.vue";

const email = ref<string>("");

const sendRecoveryMail = () => {
  authStore.actions.forgotPassword(email.value);
};
</script>

<template>
  <h1>Forgotten Password</h1>

  <div class="row g-2 justify-content-center">
    <div class="col-auto">
      <email-input v-model="email" />
      <base-form-error name="email" />
    </div>
  </div>
  <button class="btn btn-outline-primary" @click.prevent="sendRecoveryMail()">
    Send
  </button>
</template>
