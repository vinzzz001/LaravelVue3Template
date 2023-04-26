<script setup lang="ts">
import { getErrorByProperty } from "services/error";
defineProps<{ name: string }>();
</script>

<template>
  <div>
    <div
      v-for="error in getErrorByProperty(name).value"
      :key="error"
      class="d-block invalid-feedback"
    >
      {{ error }}
    </div>
  </div>
</template>
