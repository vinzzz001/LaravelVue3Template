<script setup lang="ts">
import {
  categoryStore,
  statusStore,
  ticketStore,
  userStore,
} from "/resources/js/store/factory";

//Set all data in the store, getting it from the database.
categoryStore.actions.getAll();
statusStore.actions.getAll();
ticketStore.actions.getAll();
userStore.actions.getAll();
</script>

<template>
  <p><RouterLink :to="{ name: 'login' }">Login</RouterLink></p>

  <RouterView />
</template>
