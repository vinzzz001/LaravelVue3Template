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

<!-- //! This isn't the best solution, but because of the scoped style it shouldn't influence any other part of the project  -->
<style scoped>
#main-window {
  max-width: 75%;
  margin: auto;
  text-align: center;
}
</style>
