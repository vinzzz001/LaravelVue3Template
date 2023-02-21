<script setup lang="ts">
import { RouterView } from "vue-router";
import navbar from "./components/navbar/navbar.vue";
</script>

<!-- //todo: Create some CSS for this class.  -->
<template>
  <navbar></navbar>

  <div id="main-window">
    <router-view />
  </div>
</template>

<style scoped>
#main-window {
  max-width: 75%;
  margin: auto;
  text-align: center;
}
</style>
