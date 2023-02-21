<script setup lang="ts">
import { categoryStore } from "/resources/js/store/factory";

//Set all category data in the store, getting it from the database.
categoryStore.actions.getAll();
</script>

<template>
  <RouterView />
</template>
