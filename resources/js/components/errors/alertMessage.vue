<script setup lang="ts">
defineProps(["message"]);
</script>

<template>
  <div class="alert alert-danger alert-dismissible" role="alert">
    {{ message }}
    <div v-if="!message">
      <slot>Alert Message Is missing</slot>
    </div>

    <button
      type="button"
      class="btn-close"
      data-bs-dismiss="alert"
      aria-label="Close"
    />
  </div>
</template>
