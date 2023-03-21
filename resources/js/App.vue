<script setup lang="ts">
import { RouterView } from "vue-router";
import navbar from "./components/navbar/navbar.vue";
</script>

<template>
  <navbar />

  <div id="main-window">
    <router-view />
  </div>
</template>

<!-- //todo: Create some better CSS for this class.  -->
<style scoped>
#main-window {
  max-width: 75%;
  margin: auto;
  text-align: center;
}
</style>
