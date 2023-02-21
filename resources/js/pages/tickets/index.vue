<script setup lang="ts">
import { onBeforeMount } from "vue";
import {
  categoryStore,
  statusStore,
  ticketStore,
  userStore,
} from "/resources/js/store/factory";

//Set all data in the store, getting it from the database.
onBeforeMount(() => {
  categoryStore.actions.getAll();
  statusStore.actions.getAll();
  ticketStore.actions.getAll();
  userStore.actions.getAll();
});
</script>

<template>
  <RouterView />
</template>
