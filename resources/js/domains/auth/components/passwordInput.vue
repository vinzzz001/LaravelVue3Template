<script setup lang="ts">
import { ref } from "vue";

defineProps(["modelValue"]);
defineEmits(["update:modelValue"]);

const passwordFieldType = ref<string>("password");

const switchType = () =>
  (passwordFieldType.value =
    passwordFieldType.value === "password" ? "current-password" : "password");
</script>

<template>
  <!-- Password -->
  <div class="input-group" v-if="modelValue != null">
    <label for="passwordInput" class="input-group-text">Password</label>
    <input
      class="form-control"
      :type="passwordFieldType"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target?.value)"
    />
    <button
      class="btn btn-outline-primary"
      @click="switchType()"
      @keypress.prevent
    >
      👁
    </button>
  </div>
</template>
