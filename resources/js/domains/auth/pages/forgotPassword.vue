<script setup lang="ts">
import { ref } from "vue";
import emailInput from "domains/auth/components/emailInput.vue";

const email = ref<string>("");
const sendRecoveryMail = () => {
  console.log(email.value);
};
</script>

<template>
  <h1>Forgotten Password</h1>

  <div class="row g-2 justify-content-center">
    <div class="col-auto">
      <email-input v-model="email" />
    </div>
  </div>
  <button class="btn btn-outline-primary" @click.prevent="sendRecoveryMail()">
    Send
  </button>
</template>
