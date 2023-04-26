<script setup lang="ts">
import { userStore } from "domains/users";
import { useRoute, useRouter } from "vue-router";
import { deepCopy } from "../../../helpers/copy";
import editForm from "../components/editForm.vue";

const route = useRoute();
const router = useRouter();

// @ts-ignore
const ticketId = parseInt(route.params.id) || 0;
userStore.actions.getById(ticketId);
const user = userStore.getters.byId(ticketId);

// const EditUser = async () => {
//   console.log(user.value);
//   //   await userStore.actions.EditUser(user.value);

//   //   router.push({ name: "login" });
// };
</script>
<template>
  <div v-if="user">
    {{ user }}
    <edit-form :user="user"></edit-form>
  </div>
</template>
