<script setup lang="ts">
import { ref } from "vue";
import { useRoute } from "vue-router";

const route = ref(useRoute()).value; //@ts-ignore
</script>

<template>
  <h1>Response Page!</h1>
  <RouterView></RouterView>
</template>
