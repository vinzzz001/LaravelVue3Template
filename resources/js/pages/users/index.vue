<script setup lang="ts">
import userLogin from "../../components/users/login.vue";
</script>
<template>
  <userLogin />
  <router-link :to="{ name: 'Tickets' }">return</router-link>
</template>
