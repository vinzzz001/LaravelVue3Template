<script setup lang="ts">
import { RouterView } from "vue-router";
</script>

<template>
  <RouterView />
  <router-link :to="{ name: 'ticket.overview' }">return</router-link>
</template>
