<script setup lang="ts">
import { RouterLink, useRoute } from "vue-router";
import { ticketStore } from "../../store/factory";
import { store as createAuthStore } from "/resources/js/store/authStore";

const route = useRoute();
const authStore = createAuthStore;
//@ts-ignore
const ticketId: number = parseInt(route?.params.id) || 0;
const ticket = ticketStore.getters.byId(ticketId) || {};
const me = authStore.getters.me;

ticketStore.actions.getById(ticketId);
</script>

<template>
  <h1>Show Page!</h1>
  <br />

  <pre> {{ ticket }}</pre>

  <template v-if="me.is_admin == true || me.id == ticket?.user_id">
    <router-link :to="{ name: 'TicketEdit', params: { id: <number>ticketId } }">
      Edit
    </router-link>
  </template>
  <br />

  <router-link :to="{ name: 'Tickets' }">return</router-link>
</template>
