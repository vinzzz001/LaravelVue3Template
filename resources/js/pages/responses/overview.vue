<script setup lang="ts">
import { ref } from "vue";
import { useRoute } from "vue-router";

const route = ref(useRoute()).value; //@ts-ignore

//todo: create a 'get by attached id' function.
</script>

<template>
  <h1>Response Overview Page</h1>
  <RouterLink :to="{ name: 'router.show' }">show</RouterLink>
  <pre>{{}} </pre>
</template>
