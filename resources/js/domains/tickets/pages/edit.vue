<script setup lang="ts">
import { useRoute, useRouter } from "vue-router";
import { ticketStore } from "domains/tickets";
import ticketFormVue from "domains/tickets/components/editForm.vue";
import type { Ticket } from "domains/tickets/types";

const route = useRoute();
const router = useRouter();

// @ts-ignore //Typescript has difficulties with params.id since it could also be an array.
const ticketId = parseInt(route.params.id) || 0;
ticketStore.actions.getById(ticketId);
const ticket = ticketStore.getters.byId(ticketId);

const updateForm = async (ticket: Ticket) => {
  await ticketStore.actions.update(ticket.id, ticket);
  router.push({ name: "ticket.overview" });
};
</script>

<template>
  <h1>Ticket Edit Page</h1>

  <div v-if="ticketId > 0 && ticket">
    <ticket-form-vue
      :ticket="ticket"
      @submit-form="(ticket: Ticket) => updateForm(ticket)"
    />
  </div>
  <div v-else>
    <p>Ticket Not Found!</p>
  </div>

  <br />
</template>
